require 'spreadsheet'
require 'active_support/inflector'
require 'nokogiri'




begin
  s = IO.read('data.txt')
  z = IO.read('zip_codes.txt')
  c = IO.read('stretch.txt')
  map = Nokogiri::XML(File.open('ma.svg'))
rescue Exception => msg
  puts msg
  return
end

city_data = z.split(/\n/)

zips = {}
city_data.each do |row|
  zip = row.match(/^\d{5}/)
  city = row.match(/(?<=\d{5} ).*(?= \()/)

  zips[zip[0]] = city[0].downcase unless zip.nil? || city.nil?
end

cities = zips.values.uniq
links = {}

#puts cities.inspect


towns_data = s.split(/\n/)

count = 0
towns_data.each do |row|
  next if row =~ /^[A-Z]{1}$/ || row =~ /Top of page/ || row.empty? ||
     row =~ /archaic/i || row =~ /extinct/i || row =~ /a.k.a/i 
  
  data = row.split(/ \/ /)

  if cities.include? data[0].downcase
    links[data[0].downcase] = data[1].downcase
  end

end

stretch = {}
stretch_data = c.split(/\n/)
stretch_data.each do |row|
  data = row.split(';')

  begin
    data[2].match(/(\d*)\/(\d*)\/(\d{2})/)
    
    adopt = Date.strptime("20#{$3}-#{$1}-#{$2}", "%Y-%m-%d")
  rescue
    puts "#20{$3}-#{$1}-#{$2}"
  end

  data[3].match(/(\d*)\/(\d*)\/(\d{4})/)

  eff = Date.strptime("#{$3}-#{$1}-#{$2}", "%Y-%m-%d")

  #.strftime("%b-%d %Y")

  stretch[data[0].downcase] = {adopted: adopt, effective: eff}

end

in_map = []

paths = map.css("path")
count = 0
paths.each do |path|
  if stretch.include?(path["id"].gsub(/_/, ' ').downcase)
    path["style"] = "fill:#66cc66;stroke-dasharray:none"
    in_map << path["id"].gsub(/_/, ' ').downcase
    count += 1
  else
    path["style"] = "fill:#f7f7c7;stroke-dasharray:none"
  end
end

stretch.keys.each do |k|
  puts k unless in_map.include? k
end

File.open("ma_new.svg", "w") do |f|
  f.write(map)
end

puts count

#puts map

#puts links


    

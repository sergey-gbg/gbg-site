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
text_info_zip = ''
zips = {}
city_data.each do |row|
  zip = row.match(/^\d{5}/)
  city = row.match(/(?<=\d{5} ).*(?= \()/)

  if !zips.key?(city[0].downcase)
    zips[city[0].downcase] = [zip[0]]
  else
    zips[city[0].downcase] << zip[0]
  end
    
    
end

# puts zips.inspect
cities = zips.keys
links = {}

#puts cities.inspect


towns_data = s.split(/\n/)

text_info = ''


count = 0
towns_data.each do |row|
  next if row =~ /^[A-Z]{1}$/ || row =~ /Top of page/ || row.empty? ||
     row =~ /archaic/i || row =~ /extinct/i || row =~ /a.k.a/i || row =~ /former/i 
  
  data = row.split(/ \/ /)

  if cities.include?(data[0].downcase) || cities.include?(data[1].downcase)

    mun = data[1].downcase
    mun = 'boston' if data[1].downcase =~ /annexed.*to.*boston/i
    
    links[data[0].downcase] = mun

    text_info += data[0].downcase + ',' + mun + "\n"
    zip = zips.map{ |k,v| v==data[0].downcase ? k : nil }.compact

    
  end

end

File.open("../CityMunicipality.csv", "w") do |f|
  f.write text_info
end

# File.open("CityZip.csv", "w") do |f|
#   f.write text_info_zip
# end

text_info = ''
text_info_zip = ''
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

  mun = data[0].downcase
  stretch[mun] = {adopted: adopt, effective: eff}

  link = links.map{ |k,v| v==mun ? k : nil }.compact

  # puts mun
  # puts link.inspect
  zip = []
  zip += zips[mun] unless zips[mun].nil?
  # puts zip.inspect

  links.each do |k,v| 
    if v == mun
      zip += zips[k] unless zips[k].nil?
    end
  end
  zip.compact
  puts mun if zip.empty?

  text_info += mun + ',' + eff.strftime("%b-%d %Y") + "\n"
  
end

File.open("../CityDate.csv", "w") do |f|
  f.write text_info
end

status = {}

links.values.uniq.each do |item|
  mun = item
  
  zip = []
  zip += zips[mun] unless zips[mun].nil?
  # puts zip.inspect

  links.each do |k,v| 
    if v == mun
      zip += zips[k] unless zips[k].nil?
    end
  end

  if stretch[mun]
    data = stretch[mun][:effective].strftime("%b-%d %Y")
  else
    data = "none"
  end
  status[mun] =  zip.inspect + ';' + data + "\n"
  
end

keys = status.keys.sort

keys.each do |key|
  text_info_zip += key + ';' + status[key]
end





File.open("../CityStatus.csv", "w") do |f|
  f.write text_info_zip
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



#puts map

#puts links


    

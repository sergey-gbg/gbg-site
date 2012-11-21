<?
//==List of functions for geotargeting==
//Define user's IP
function getRealIpAddr()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  
  return $ip;
}

//Define user's city by his IP 
function getCityByIp($ipaddress)
{
	$city = "";
	$license_key = "hKrySYTmrhso";
	$query = "http://geoip.maxmind.com/f?l=" . $license_key . "&i=" . $ipaddress;
	$url = parse_url($query);
	$host = $url["host"];
	$path = $url["path"] . "?" . $url["query"];
	$timeout = 1;
	$fp = fsockopen ($host, 80, $errno, $errstr, $timeout)
			or die('Can not open connection to server.');
	if ($fp) {
	  fputs ($fp, "GET $path HTTP/1.0\nHost: " . $host . "\n\n");
	  while (!feof($fp)) {
		$buf .= fgets($fp, 128);
	  }
	  $lines = explode("\n", $buf);
	  $data = $lines[count($lines)-1];
	  $arr = split(",", $data); 

		$city = $arr[2];
	  fclose($fp);
	}

	$city = getMunicipality($city);

	if(empty($city)) $city="Boston";
	
	return $city;
	
}

function getShortCityStatus($city){

	$info = "";		

	$data = getDataFromFile("CityDate.csv");
	
	$i = 0;
	foreach ($data as $value){
	
		if ($value[0] == strtolower($city)){
	
			$date = $value[1];
			$info = "In effect since " . $date;
			break;
		} 
	}	

	if(empty($info)) $info="Not in effect";
	
	return $info;
}

function getMunicipality($city){

	$info = "";		

	$data = getDataFromFile("CityMunicipality.csv");
	
	foreach ($data as $value){
	
		if ($value[0] == strtolower($city)){
	
			$info=$value[1];
			break;
		} 
	}	

	return ucfirst($info);
}


function getDataFromFile($name){

	$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/geo/" . $name, "r");
	while (($arr = fgetcsv($fd, 1024, ",")) !== FALSE) {
		$data[] = $arr;
	}

	return $data;
}





//Provide an information on the city status
function getCityStatus($city){
// Download data from the table: city | status | effective date.
	$arr = split(" ", $city); 
	$city = $arr[0];
	$info = "";		
	$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/geo/CityStatusDate.csv", "r");
	while (($arr = fgetcsv($fd, 1024, ";")) !== FALSE) {
		$data[] = $arr;
	}
	$i = 0;
	foreach ($data as $value){
	
		if ($value[0] == $city){
	
			$info="";
			$status = $value[2];
			$arr = split("adopted", $status);
			$date = $value[3];
			$info = "". $arr[0] . "adopted Stretch Code on" . $arr[1] . ". Effective date is " . $date;
			break;
			
		} 
	}	
	
	return $info;
}

function getInfoByCity($city){

	$info =  $city . " " . getCityStatus($city);
	return $info;
}




?>







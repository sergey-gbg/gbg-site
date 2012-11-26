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

	session_start();
	
	$city = $_SESSION["geo-city"];

	if (empty($city)) {
		$license_key = "t02mRhn5IlI6";
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

		$_SESSION["geo-city"] = $city;
	}	
	
	return $city;
	
}

function getShortCityStatus($city, $default = "Not in effect", $prefix = ""){

	$info = "";		

	$data = getDataFromFile("CityDate.csv");

	foreach ($data as $value){
	
		if (strtolower($value[0]) == strtolower($city)){
	
			$date = $value[1];
			$info = "In effect since " . $date;
			break;
		} 
	}	

	if (empty($info)) $info = $default;

	if (! empty($info)) $info = $prefix . $info;
	
	return $info;
}

function getMunicipality($city){

	$info = "";		

	$data = getDataFromFile("CityMunicipality.csv");
	
	foreach ($data as $value){
	
		if (strtolower($value[0]) == strtolower($city)){
	
			$info=$value[1];
			break;
		} 
	}	

	return ucfirst($info);
}


function getDataFromFile($name, $delimeter = ","){

	$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/geo/" . $name, "r");
	while (($arr = fgetcsv($fd, 1024, $delimeter)) !== FALSE) {
		$data[] = $arr;
	}

	return $data;
}

?>







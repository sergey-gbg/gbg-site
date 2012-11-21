<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<!-- ### Stylesheet ### -->
<link rel="stylesheet" type="text/css" href="/style/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
<link rel="stylesheet" href="/jquery/jtabs/jquery.tabs.css" type="text/css" media="print, projection, screen">

<!-- ### list of scripts for geotargeting -->
<? include($_SERVER["DOCUMENT_ROOT"]."/geo/functions.php"); ?>
<script src="/jquery/jtabs/jquery.js" type="text/javascript"></script>
<script src="/jquery/jtabs/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="/jquery/jtabs/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
 	$('#container-data').tabs({ fxAutoHeight: true });
});
</script>



<html>

<body id="check_code_form" onload="displayCity"> 
	
	<script type="text/javascript">
		
		function displayCity{
			var city = document.getElementById("geo-city");
			alert(city.value);
		}

		
		// function checkStatusByCity(){
		
		// 	var city = document.forms["checkcodeform"]["citylist"].value;
		// 	var city_msg = document.getElementById("city");
		// 	var msg = "";

		// 	if city == 'none'{
		// 		city_msg.innerHTML = "Please, select city or enter your zip code"
		// 	}
		// 	else{
		// 		city_msg.innerHTML = city;
		// 		msg = <?=getShortCityStatus($city, ,"The Stretch Energy Code ");?>
		// 	}
			
		// 	displayMessage(msg);
		// }

		// function checkStatusByZip(){
		
		// 	var zip = document.forms["checkcodeform"]["zipcode"].value;
			
		// 	checkStatusByCity();
			
		// }

		// function displayMessage(msg){
		// 	var msg = document.getElementById("msg");
		// 	msg.innerHTML = msg;
		// }
					
	</script>
		
	<div>test</div>



</body>
</html>
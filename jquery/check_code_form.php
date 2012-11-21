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

<body id="check_code_form"> 
	
	<script type="text/javascript">
	
		
		function checkStatusByCity(){
		
			var city = document.forms["checkcodeform"]["citylist"].value;
			var city_msg = document.getElementById("city");
			var msg = ""

			if city == 'none'{
				city_msg.innerHTML = "Please, select city or enter your zip code"
			}
			else{
				city_msg.innerHTML = city
				msg = <?=getShortCityStatus($city, ,"The Stretch Energy Code ");?>
			}
			
			displayMessage(msg)
		}

		function checkStatusByZip(){
		
			var zip = document.forms["checkcodeform"]["zipcode"].value;
			
			checkStatusByCity()
			
		}

		function displayMessage(msg){
			var msg = document.getElementById("msg");
			msg.innerHTML = msg
		}
					
	</script>
		


<form name="checkcodeform" id="checkcodeform" method="post" >
	<div class="contact_pop">

		<div id="container-data">
			<ul>
				<li><a href="#fragment-city"><span>City</span></a></li>
				<li><a href="#fragment-zip"><span>Zip</span></a></li>
			 
			</ul>
			<div id="fragment-city">
				
				<label for="citylist" style="width:100px; line-height: 16px;">Select your city</label>
				<select id="citylist" name="citylist" size="1"  style="width: 180px;"></select>
				<option value="none"> - - Select - -</option>
				<?$city_zip_data=getCityZipInfo()?>
				<?foreach ($city_zip_data as $value){?>
					<option value="<?=$value[1]?>"><?=$value[1]?></option>
				<?}?>

				<input class="contact_button" name="check_city" type="button" value="Check!" onClick="checkStatusByCity()"> 
			  
			</div>
			<div id="fragment-zip">
				<label for="zipcode" style="width:130px; line-height: 16px;">Enter your zip code:</label>
				<input  class="small" type="text" name="zipcode" maxlength="30" size="5" width="150px; line-height: 16px;">
				<input class="contact_button" name="check_zip" type="button" value="Check!" onClick="checkStatusByZip()"> 
			</div>

		</div>
		
<!-- 		<select id="zipcodelist" name="zipcodelist" size="0"  style="visibility:hidden;"></select>
		<?$city=getCityByIp(getRealIpAddr());?> -->
		<div id = "city">Please, select city or zip</div>
		<div class="city_info">
      <div id = "msg"><?=getShortCityStatus($city, "","The Stretch Energy Code ");?></div>
      <a href="#" class="poplight" style="font-size: 12px">(more info)</a>
    </div>
	  
	  <!--<p id="error">There were errors on the form, please make sure all fields are fill out correctly.</p>-->
	</div>
	

</form>


</body>
</html>
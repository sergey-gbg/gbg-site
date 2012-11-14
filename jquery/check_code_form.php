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

<body id="check_code_form" onLoad="loadCitiesList(); loadZipCodes();"> 
	
	<script type="text/javascript">
	
		function clear_color() {
			document.forms["checkcodeform"]["zipcode"].style.background = "white";
			
		}
		
		//Download the list of cities from DB
		function loadCitiesList() {
			
			var citylist = document.forms["checkcodeform"]["citylist"];
			var arr, selected, opt, i=0;
						
			// Download data from the table: city | status | effective date.
		<?
			$fd1 = fopen($_SERVER["DOCUMENT_ROOT"]."/geo/CityStatusDate.csv", "r");
			while (($arr = fgetcsv($fd1, 1024, ";")) !== FALSE) {
				$data[] = $arr;
			}
				
			$city = getCityByIp(getRealIpAddr());
			$arr = split(" ", $city); //in case the name of the city consists of 2 words
		    $city = $arr[0];
					
			foreach ($data as $value){?>
				<?if($city==$value[0]){?>selected = true;<?}else{?>selected = false;<?}?>
				citylist.options[i] = new Option("<?=$value[0]?>", "<?=$value[0]?>", selected, selected); 
				//citylist.appendChild(opt);
				i++;
			<?}
			fclose($fd1);?>
		}
		
		function loadZipCodes() {
		
			var zipcode=document.forms["checkcodeform"]["zipcodelist"];
			var i=0;
						
			<?
			$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/geo/ZipCodes.txt", "r");
			while (($array = fgetcsv($fd, 1024, " ")) !== FALSE) {
				$dat[] = $array;
			}
			foreach ($dat as $val){ 
			?>
				zipcode.options[i] = new Option("<?=$val[0]."/".$val[1]?>", "<?=$val[0]?>"); 
				i++;
				//zipcode.appendChild(option);

			<?}
			fclose($fd);?>
									
		}
		
			
		function checkCityStatus(city){
		
			var citystatus = new Array();
			var status_msg = "";
			
			var arr = city.split(" ", 2); //in case the name of the city consists of 2 words
		    city = arr[0];
			
			// Download data from the table: city | status | effective date.
			<?
				$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/geo/CityStatusDate.csv", "r");
				while (($arr = fgetcsv($fd, 1024, ";")) !== FALSE) {
					$data[] = $arr;
				}
				$i = 0;
				foreach ($data as $value){?>
					
					citystatus[<?=$i;?>] = new Array("city", "status", "date");
					citystatus[<?=$i;?>]["city"]="<?=$value[0];?>";
					citystatus[<?=$i;?>]["status"]="<?=$value[2];?>";
					citystatus[<?=$i;?>]["date"]="<?=$value[3];?>";
					<?$i = $i + 1;
				}
				fclose($fd);?>
				
			// Search of the city in the downloaded table.
			var size = <?=($i - 1)?>;
			for (i = 0; i < size; i++){
				if (citystatus[i]["city"] == city){
					arr = (citystatus[i]["status"]).split("adopted", 2);
					status_msg = "" + citystatus[i]["city"] + " " + arr[0] + "adopted Stretch Code on" + arr[1] + ". Effective date is " + citystatus[i]["date"];
					return status_msg;
				}
			}
				
			status_msg = "" + city + " have not adopted Stretch code yet. Please see homeowners page for more information.";
			return status_msg;
		}
		
		function checkStatusByZip(){
		
			var form = document.forms["checkcodeform"];
			var zipcode=form["zipcode"].value;
			var zipcodelist=form["zipcodelist"].value;
			var i, city= "";
			var zipcity, arr, size, i, found = false;
			var codeslist = form["zipcodelist"];
			var status_msg = "";
			var msg = document.getElementById("msg");
								
			if (!zipcode) { // zipcode is empty
				form["zipcode"].style.background = "pink";
				msg.style.color = "red";
  				msg.innerHTML = "Please provide a zipcode!";
  				return false;
				
			} 
			else {
			
				// Search of the zipcode in the table: zip code | city
				for (i = 0; i < codeslist.length; i++){
					if (codeslist[i].value == zipcode) {
						codeslist[i].selected = true;
						found = true;
						break;
					}
				}
				
				if(!found){
					status_msg = "Sorry, we have no information about zip code you entered";
					msg.style.color = "black";
					msg.innerHTML  = status_msg; 
					return false;
				}
			
				zipcity = codeslist[codeslist.selectedIndex].text;
				arr = zipcity.split("/", 2);
				city = arr[1]; 
			}
			
			msg.style.color = "black";
			msg.innerHTML  = checkCityStatus(city);
			return true;
		}
		
		function checkStatusByCity(){
		
			var city = document.forms["checkcodeform"]["citylist"].value;
			var msg = document.getElementById("msg");
			msg.style.color = "black";
			msg.innerHTML = checkCityStatus(city);
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
				<input class="contact_button" name="check_city" type="button" value="Check!" onClick="checkStatusByCity()"> 
			  
			</div>
			<div id="fragment-zip">
				<label for="zipcode" style="width:130px; line-height: 16px;">Enter your zip code:</label>
				<input  class="small" type="text" name="zipcode" maxlength="30" size="5" width="150px; line-height: 16px;">
				<input class="contact_button" name="check_zip" type="button" value="Check!" onClick="checkStatusByZip()"> 
			</div>

		</div>
		
		<select id="zipcodelist" name="zipcodelist" size="0"  style="visibility:hidden;"></select>
		<?$city=getCityByIp(getRealIpAddr());?>
		<div id="msg"><?=getInfoByCity($city);?></div>
	  
	  <!--<p id="error">There were errors on the form, please make sure all fields are fill out correctly.</p>-->
	</div>
	

</form>


</body>
</html>
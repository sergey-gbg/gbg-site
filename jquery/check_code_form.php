<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<!-- ### Stylesheet ### -->
<link rel="stylesheet" type="text/css" href="/style/style.css" />
<link rel="stylesheet" href="/jquery/jtabs/jquery.tabs.css" type="text/css" media="print, projection, screen">

<link rel="stylesheet" href="/jquery/bootstrap/bootstrap-tab.css" type="text/css">

<!-- ### list of scripts for geotargeting -->
<? include($_SERVER["DOCUMENT_ROOT"]."/geo/functions.php"); ?>
<script src="/jquery/jtabs/jquery.js" type="text/javascript"></script>
<script src="/jquery/jtabs/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="/jquery/jtabs/jquery.tabs.pack.js" type="text/javascript"></script>

<script src="/jquery/bootstrap/bootstrap-tab.js" type="text/javascript"></script>

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
				
			$city = "";
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
			status_msg = "Not in effect"
			for (i = 0; i < size; i++){
				if (citystatus[i]["city"] == city){
					arr = (citystatus[i]["status"]).split("adopted", 2);
					status_msg = "In effect since " + citystatus[i]["date"];
					return status_msg;
				}				
			}
				

			//status_msg = "" + city + " have not adopted Stretch code yet. Please see homeowners page for more information.";
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
			var city_info = document.getElementById("city");
			city_info.innerHTML = city;
		}

		$('#checkTab a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		})
					
	</script>
		
	
<form name="checkcodeform" id="checkcodeform" method="post" >

	<ul class="nav nav-tabs" id="checkTab">
	  <li class="active"><a href="#tab-city">City</a></li>
	  <li><a href="#tab-zip">Zip</a></li>	  
	</ul>
	 
	<div class="tab-content">
	  <div class="tab-pane active" id="tab-city">
	  	<label for="citylist" style="width:100px; line-height: 16px;">Select your city</label>
			<select id="citylist" name="citylist" size="1"></select>
			<input class="contact_button" name="check_city" type="button" value="Check!" onClick="checkStatusByCity()"> 
	  </div>
	  <div class="tab-pane" id="tab-zip">
	  	<label for="zipcode" style="width:130px; line-height: 16px;">Enter your zip code:</label>
			<input  class="small" type="text" name="zipcode" maxlength="30" size="5">
			<input class="contact_button" name="check_zip" type="button" value="Check!" onClick="checkStatusByZip()"> 
	  </div>	  
	</div>

	<select id="zipcodelist" name="zipcodelist" size="0"  style="visibility:hidden;"></select>
	<div id="city" style="font-size:15px;color:#0099cc;font-weight: bold;"></div>
	<div id="msg" style="font-size:15px;color:#0099cc;font-weight: bold;">No information avaliable</div>
	<a href="#" class="poplight" style="font-size: 12px">(more)</a>
		  

</form>


</body>
</html>
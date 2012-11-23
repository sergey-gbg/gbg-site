<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<? include($_SERVER["DOCUMENT_ROOT"]."/geo/functions.php"); ?>

<html>
<head>
	<link rel="stylesheet" href="/jquery/bootstrap/bootstrap.min.css" type="text/css">
	<script src="/jquery/bootstrap/jquery.js" type="text/javascript"></script>
	<script src="/jquery/bootstrap/bootstrap-tab.js" type="text/javascript"></script>
	
</head>

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
			var status_msg = "Not in effect";
			
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
			var city_msg = document.getElementById("city");
			city_msg.innerHTML = city;
		}
					
	</script>

	
<form name="checkcodeform" id="checkcodeform" method="post" >

	<ul class="nav nav-tabs" style="margin-bottom: 0px" id="checkTab">
	  <li class="active"><a href="#tabcity" data-toggle="tab">City</a></li>
	  <li><a href="#tabzip" data-toggle="tab">Zip</a></li>	  
	</ul>
	 
	<div class="tab-content">
	  <div class="tab-pane fade active in" id="tabcity">
	  	<label for="citylist">Select your city</label>
	  	<div class="form-inline">
  			<select id="citylist" type="text" style="margin-bottom: 0px" placeholder="City"></select>
			  <a href="#" class="btn" onClick="checkStatusByCity()">Check!</a>
			</div>	
	  </div>
	  <div class="tab-pane fade" id="tabzip">
	  	<label>Enter zip code</label>
	  	<div class="form-inline">
  			<input id="zipcode" type="text" class="input-medium" placeholder="Zip"></input>
			  <a href="#" class="btn" onClick="checkStatusByZip()">Check!</a>
			</div>
	  </div>	  
	</div>

	<div style="margin-top: 50px;font-size:16px;color:#666;font-style: italic;font-family: georgia;">
		<p>The Stretch Energy Code Status</p>
	</div>
	<div id="city" style="50px;font-size:16px;color:#666;font-style: italic;font-family: georgia;">
		Boston
	</div>

	<div id="msg" style="font-size:15px;color:#0099cc;font-weight: bold;">No information avaliable</div>
	<a href="#" class="poplight" style="font-size: 12px">(more)</a>
	<div>
	<select id="zipcodelist" name="zipcodelist" size="0"  style="visibility:hidden;"></select>
	</div>	  

</form>


</body>
</html>
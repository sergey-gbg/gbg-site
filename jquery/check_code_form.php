<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<!-- ### Stylesheet ### -->
<link rel="stylesheet" type="text/css" href="/style/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />

<!-- ### list of scripts for geotargeting -->
<? include($_SERVER["DOCUMENT_ROOT"]."/geo/functions.php"); ?>

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
				
			$city = getCityByIp($_SERVER['REMOTE_ADDR']);
					
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
		
			
		function validateForm() {
		
			var form = document.forms["checkcodeform"];
			var zipcode=form["zipcode"].value;
			var zipcodelist=form["zipcodelist"].value;
			var i, city= "";
			var zipcity, arr, size, i, found = false;
			var codeslist = form["zipcodelist"];
			var citystatus = new Array();
								
			/*if (!zipcode) { // zipcode is empty
				form["zipcode"].value = codeslist.value;
				zipcode=form["zipcode"].value;
				return false;
			}*/
			if (!zipcode) { // zipcode is empty
				//form["zipcode"].style.background = "pink";
  				//alert("Please provide a zipcode.");
  				//return false;
				
				city = document.forms["checkcodeform"]["citylist"].value;
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
					alert("Sorry, we have no information about zip code you entered");
					return true;
				}
			
				zipcity = codeslist[codeslist.selectedIndex].text;
				arr = zipcity.split("/", 2);
				city = arr[1]; 
			}
			
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
			size = <?=($i - 1)?>;
			for (i = 0; i < size; i++){
				if (citystatus[i]["city"] == city){
					arr = (citystatus[i]["status"]).split("adopted", 2);
					alert("" + citystatus[i]["city"] + " " + arr[0] + "adopted Stretch Code on" + arr[1] + ". Effective date is " + citystatus[i]["date"]);
					//alert("" + citystatus[i]["city"] + " " + citystatus[i]["status"] + ". Effective date is " + citystatus[i]["date"]);
					return true;
				}
			}
				
			alert("" + city + " have not adopted Stretch code yet. Please see homeowners page for more information.");
			return true;
			 
		}	
		
			
	</script>
		
	
<form name="checkcodeform" id="checkcodeform" method="post" >
<div class="contact_pop">

<table class="checkcodeform" border="0">
<tr>
<td>	  <label for="citylist" style="width:70px">City:</label></td> 
<td>   	  <select id="citylist" name="citylist" size="1"  style="width: 100px;"></select></td>
</tr>
<tr>	  
<td>	  <label for="zipcode" style="width:70px">Zip code:</label> </td>
<td>	  <input  class="small" type="text" name="zipcode" maxlength="30" size="5" width="100px"> </td>
 </tr> 
</table>
	  <input class="contact_button" name="submit" type="button" value="Check my city status" onClick="validateForm()">  
	  <select id="zipcodelist" name="zipcodelist" size="100"  style="visibility:hidden;"></select>
  
  <!--<p id="error">There were errors on the form, please make sure all fields are fill out correctly.</p>-->

</div>
</form>


</body>
</html>
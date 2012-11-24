<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<? include($_SERVER["DOCUMENT_ROOT"]."/geo/functions.php"); ?>

<html>
<head>
	<link rel="stylesheet" href="/jquery/bootstrap/bootstrap.min.css" type="text/css">
	<script src="/jquery/jquery.js" type="text/javascript"></script>
	<script src="/jquery/bootstrap/bootstrap-tab.js" type="text/javascript"></script>
	
</head>

<body id="check_code_form" onLoad="loadCitiesList();"> 
	
	<script type="text/javascript">

		var table_data = loadTable();

		function loadTable() {

			var status = new Array();
			<?$data = getDataFromFile('CityStatus.csv', ";");
				$i = 0;
				foreach ($data as $value){?>
					
					status[<?=$i;?>] = new Array("city", "zip", "date");
					status[<?=$i;?>]["city"]="<?=ucfirst($value[0]);?>";
					status[<?=$i;?>]["zip"]=<?=$value[1];?>;
					status[<?=$i;?>]["date"]="<?=$value[2];?>";
					<?$i = $i + 1;?>
				<?}?>
			return status;

		}

		
		//Download the list of cities from DB
		function loadCitiesList() {
			
			var citylist = document.forms["checkcodeform"]["citylist"];
			var city_msg = document.getElementById("geo-city");

			for (i = 0; i < table_data.length; i++){
				citylist.options[i] = new Option(table_data[i]["city"]); 		
			}			
			
		}
		
		
		function checkStatusByZip(){
		
			var form = document.forms["checkcodeform"];
			var zipcode = form["zipcode"].value;
			var city = form["citylist"].value;
			var msg = document.getElementById("code-info");
			var city_msg = document.getElementById("geo-city");
	
			var city_status_msg = "City Not Found";
			var zip_status_msg = "";
											
			if (!zipcode) { // zipcode is empty
				city_status_msg = "City Not Found";
 				zip_status_msg = "Please provide a zipcode!"; 				
			} 
			else 
			{
				zip_status_msg = "Sorry, we have no information about zip code you entered";

				for (i = 0; i < table_data.length; i++){
					if (table_data[i]["zip"].indexOf(zipcode) != -1) {
						zip_status_msg = "In effect since " + table_data[i]["date"];
						city_status_msg = table_data[i]["city"];
						break;
					}
				}				
			}
			
			msg.innerHTML  = zip_status_msg;
			city_msg.innerHTML = city_status_msg;
			
		}
		
		function checkStatusByCity(){
		
			var city = document.forms["checkcodeform"]["citylist"].value;
			var msg = document.getElementById("code-info");
			var city_msg = document.getElementById("geo-city");
			var status_msg = "Not in effect";

			for (i = 0; i < table_data.length; i++){
				if (table_data[i]["city"] == city && table_data[i]["date"] != "none"){
					status_msg = "In effect since " + table_data[i]["date"];
					break;
				}
			}

			msg.innerHTML = status_msg;
			city_msg.innerHTML = city;
		}
					
	</script>

	
<form name="checkcodeform" id="checkcodeform" method="post" style="margin-bottom: 0;font-size:16px;color:#666;font-family: georgia;">

	<ul class="nav nav-tabs" style="margin-bottom: 10px" id="checkTab">
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
  			<input id="zipcode" type="text" placeholder="Zip"></input>
			  <a href="#" class="btn" onClick="checkStatusByZip()">Check!</a>
			</div>
	  </div>	  
	</div>

	<div style="font-style: italic;">
	<div style="margin-top: 10px;">
		The Stretch Energy Code Status For:
	</div>
	<div id="geo-city" style: "margin-top: 5px">
		Boston
	</div>

	<div id="code-info" style="font-size:15px;color:#0099cc;font-weight: bold;">No information avaliable</div>
	<a href="#" class="poplight" style="font-size: 12px;color: #66cc66">(more)</a>
	</div>
</form>


</body>
</html>
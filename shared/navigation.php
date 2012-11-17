<!-- ### list of scripts for geotargeting -->
<? include_once($_SERVER["DOCUMENT_ROOT"]."/geo/functions.php"); ?>

<div class="left">
	<div class="square1">
		<div class="name">
      <a href="/"><img src="/images/logologo3.png" alt="Greater Boston Green"/></a>
		</div>
		<div class="estab">
			
		</div>
	<br style="clear:both;" />
	</div> <!-- end div.square1 -->
  
	<div class="square2">
		<div class="menu">
			<ul>         
        <li id="contractors"><a href="/architects-builders/">Architects & Builders</a></li>
        <li id="homeowners"><a href="/homeowners/">Homeowners</a></li>
        <li id="incentives"><a href="/incentives/">Incentives</a></li>        
        <li id="team"><a href="/team/">Our Team</a></li>          
			</ul>
		</div> <!-- end div.menu -->
	</div> <!-- end div.square2 -->
  
	<div class="square3">
		<div class="hotlinks">
			<a href="http://twitter.com/#!/gbgMA" title="GBG Twitter"> <div class="imghov" id="twithov"></div> </a>
			<a href="http://www.facebook.com/GreaterBostonGreen" title="GBG Facebook"> <div class="imghov" id="fbhov"> </div> </a>
		</div>

		<div class="contact">	
			<span class="phone"> 617-418-1444 </span>
			<span class="email"><a href="#?w=495" rel="popup_contact" class="poplight">Contact Us</a></span>
		</div>
		
		
	</div> <!-- end div.square3 -->
	
	<div class="map">
		<div class="green bold">new Stretch Code</div>
		<img src="/images/MA_map.png" alt="Massachusetts map" class="MA_map" >
					
		<div class="check_code" style="margin-top: -30px; position:absolute; z-index: 99; ">
			<a href="#?w=400" rel="popup_check_code" class="poplight" >Check your city now!</a>
		</div>
		
		<div class="blue bold" style="margin-top: 0px; position:absolute; z-index: 99;  font-size:10px; width: 262px;">
			<?$city=getCityByIp(getRealIpAddr());?> 
			<div><?=$city;?>:</div>
			<div><?=getShortCityStatus($city);?></div>
		</div>
	</div>
</div> <!-- end div.left -->

<!-- Client Login and Logo -->
<div class="right_header">
  <a href="https://gbg.affinitylive.com/extranet" target="_blank" id="logina">
    Client Login
  </a>
  <!--<img src="images/logo_small.png" alt="GBG Logo" class="logo"/> -->
</div>
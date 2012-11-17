<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">	
	
<html lang="en">

	<!-- Header -->
    <?php include($_SERVER["DOCUMENT_ROOT"]."/shared/header.php"); ?>
	
	<!-- ### list of scripts for geotargeting -->
	<? include_once($_SERVER["DOCUMENT_ROOT"]."/geo/functions.php"); ?>
	  
	
    <!-- ### Page Title ### -->
    <title>Greater Boston Green || Energy Efficiency, HERS Ratings and Energy Star Partner</title>

     </head>
    <!-- End Header -->
		
	<body id="mainform" >
	
		<div class="container">
			
			<!-- Site Navigation -->
			<?php include($_SERVER["DOCUMENT_ROOT"]."/shared/navigation.php"); ?>		

			<div class="right" id="fadehome">
			
				<div class="grey" > 
					<img src="/images/thehomepage2.png" alt="Massachusetts Energy Star Efficiency" style="margin: 0px 0px 30px 0px; " >
				
					<!--	
					<div id="homeslide" class="pics">
						
						 Add other images to get slideshow working 
						
					</div> --> <!-- end div.homeslide -->

					<!-- ### Commenting out Prev and Next buttons until slideshow is enabled ### 
					<div class="nav">
						<a id="prev" href="javascript:void(0);" title="Previous"><img src="images/prev2.png" alt="Previous Button"/></a> 
						<a id="next" href="javascript:void(0);" title="Next"><img src="images/next2.png" alt="Next Button"/></a>
					</div> -->

			
					<br style="clear:both;" />
				</div> <!-- end div.grey -->
					
								
	<div class="tagline" style="margin:30px 0 40px 0;"><h1>We are an <img src="/images/spark2.png" alt="" style="margin: -6px 6px 0px 0px;" >partner collaborating
						with architects, builders and homeowners in and around Boston to achieve all of your energy
						efficiency goals.</h1></div>
<div class="tagline"><h1>RESNET certified. We do HERS energy ratings. </h1></div>

				<div class="par">	
					<div class="par-left">
						
					</div>
					<div class="par-right"> 									
						<h2></h2>
					</div> <!-- end div.par-right -->
				<br style="clear:both;" />
				</div> <!-- end div.par -->
											
			<br style="clear:both;" />
			</div> <!-- end div.right -->
				
		<br style="clear:both;" />	
		</div> <!-- end div.container -->

		<?php include($_SERVER["DOCUMENT_ROOT"]."/shared/footer.php"); ?>

<!-- ### Script for Homepage Slideshow ### -->
<script>

$('#homeslide').cycle({
    fx:     'fade',
    speed:  800,
    timeout: 6000,
    next:   '#next',
    prev:   '#prev'
});

</script>	
 
<!-- ### Google Analytics ### -->
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-35139726-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
	
	</body>
</html>



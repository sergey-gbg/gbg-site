<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
		
	<!-- Header -->
    <?php include($_SERVER["DOCUMENT_ROOT"]."/shared/header.php"); ?>

    <!-- ### Page Title ### -->
    <title>Greater Boston Green || Energy Efficiency, HERS Ratings and Energy Star Partner</title>

    </head>
    <!-- End Header -->
		
	<body>

		<div class="container">
			
			<!-- Site Navigation -->
			<?php include($_SERVER["DOCUMENT_ROOT"]."/shared/navigation.php"); ?>

			<div class="right">	
					<img id="teamlight" src="/images/team/teamtop2.png" />
				<div class="grey"> 
					<!-- Pictures of Team Members -->
					<div class="teampics">
						<a href="javascript:void(0)" id="member1"><img id="mem1" src="/images/team/dmitry2.jpg" /></a>
	<a href="javascript:void(0)" id="member3"><img id="mem3" src="/images/team/karina2.jpg" /></a>						
<a href="javascript:void(0)" id="member2"><img id="mem2" src="/images/team/david2.jpg" /></a>
<a href="javascript:void(0)" id="member4"><img id="mem4" src="/images/team/serge2.jpg" /></a>					
					</div>
				<br style="clear:both;"/>
				</div>


				<div class="bio" id="bio1">
					<div class="member_name"><h1>Dmitry </h1></div>	
					<div class="member_title">Principal, Head Rater</div>
					<div class="member_subtitle">
						RESNET HERS Rater Certified<br/>
						BPI Certified Analyst<br/>
						Energy Star 3.0 Certified<br/>
						Lead Safety Training<br/>
					</div>
						Dmitry Sharshunskiy is founder of Greater Boston Green. Previously he was senior engineer at a Massachusetts technology firm. He has long been passionate about 
						energy efficiency. He is a RENEST certified energy rater and BPI building analyst, and is currently tinkering on a number of new projects to benefit the industry.
						
				</div> <!-- end div.bio1 -->

				<div class="bio" id="bio3" style="display:none">
					<div class="member_name"><h3>Karina</h3></div>	
					<div class="member_title">Account Manager</div>
					Karina keeps track of the books here at GBG.
					<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				</div> <!-- end div.bio3 -->

				<div class="bio" id="bio2" style="display:none">
					<div class="member_name"><h2>David</h2></div>	
					<div class="member_title">Energy Rater</div>
					<div class="member_subtitle">
						RESNET HERS Rater Certified<br/>
						Energy Star 3.0 Certified<br/>
					<br>
					<br>
					</div>
					With a background in the visual arts, David has been deeply driven by efficient design for much of his life. His work at Greater Boston Green provides a unique outlet to apply these skills, be it new layouts or new projects, 
						He is constantly engaged with helping homeowners and builders better understand home energy efficiency in today's ever-changing economy.
				</div> <!-- end div.bio2 -->
				
				<div class="bio" id="bio4" style="display:none">
					<div class="member_name"><h2>Sergey</h2></div>	
					<div class="member_title">Sr. Software Engineer</div>
					<div class="member_subtitle">
						
					<br>
					<br>
					</div>
					Sergey is our sr. software guru working on a number of projects to streamline the Home Energy Rating process for industry professionals and their clients. Sergey has a Masters in Mathematics and Computer Science.
				</div> <!-- end div.bio2 -->
			<div class="bottom">	
							<div class="newhead">
			Greater Boston Green is based in Needham, MA <br><br>Ring us at 617-418-1444

					</div>	
						<div class="newheadr">
			<img src="/images/map.PNG" alt="Needham map" >

					</div>	
		</div>
				<!-- End Biographies -->
		
			</div> <!-- end div.grey -->

			
		<br style="clear:both;" />	
		</div> <!-- end div.container -->
			
		<?php include($_SERVER["DOCUMENT_ROOT"]."/shared/footer.php"); ?>
	
	</body>
</html>

<!-- Script for Team Member Page -->
<script>
$(document).ready(function() {
	$('#team').css("background-color","#A4E1FE");
	$('#team_ref').css("background-color","#A4E1FE");
	$('#team').css("color","#fff");
});

// ### Animation functions for fade in and outs
var animateIn = function(){
		$(this).animate({opacity: ".6"}, 400);
	} ;
	
var animateOut = function(){
		$(this).animate({opacity: "1.0"}, 400);
	} ;

// ### Animation for fading team members in and out
$("#mem1").hover( animateIn, animateOut );
$("#mem2").hover( animateIn, animateOut );
$("#mem3").hover( animateIn, animateOut );
$("#mem4").hover( animateIn, animateOut );

// ### Functionality for changing bios
$('#member1').click( function (){
	$('#bio1').css("display","block");
	$('#bio2').css("display","none");
	$('#bio3').css("display","none");
	$('#bio4').css("display","none");
});

$('#member2').click( function (){
	$('#bio1').css("display","none");
	$('#bio2').css("display","block");
	$('#bio3').css("display","none");
	$('#bio4').css("display","none");
});

$('#member3').click( function (){
	$('#bio1').css("display","none");
	$('#bio2').css("display","none");
	$('#bio3').css("display","block");
	$('#bio4').css("display","none");
})

$('#member4').click( function (){
	$('#bio1').css("display","none");
	$('#bio2').css("display","none");
	$('#bio3').css("display","none");
	$('#bio4').css("display","block");
})

;( function (){
	$('#bio1').css("display","none");
	$('#bio2').css("display","none");
	$('#bio3').css("display","block");
});
</script>



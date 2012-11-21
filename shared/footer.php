<div class="footer">
  <div class="fleft">
    <img src="/images/foot.png" alt="Greater Boston Green logo"> 
    &copy; <? print(Date("Y")); ?>  
     <img src="/images/energyico.png" alt="Energy Star logo" style="margin: 0px 14px 0px 70px;"> 
		   <img src="/images/ypiico.png" alt="performance logo" style="margin: 0px 12px 0px 12px;">       
      <img src="/images/resnetico.png" alt="RESNET logo" style="margin: 0px 12px 0px 12px;"> 
       <img src="/images/massico.png" alt="Mass Save logo" style="margin: 0px 0px 0px 12px;"> 
  </div>
  <div class="fright">
   
		<a href="http://www.ipage.com/green-certified/greaterbostongreen.com" onClick="MyWindow=window.open('http://www.ipage.com/green-certified/greaterbostongreen.com','greenCertified','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=550,height=800,left=50,top=50'); return false;">
      <img src="http://www.ipage.com/green-certified/hosting-badge-3.png" alt="iPage Green Certified Hosting" style="float: right; margin: -10px 15px 0px 0px;"/>        
    </a>
  </div>
<br style="clear:both;">
</div> <!-- end div.footer -->

<!--###Popups -->

	<div id="popup_contact" class="popup_block">
	<img src="/images/contactcard4.png" alt="" >
    <div class="pop_head"><h6>Drop us a line</h6> </div>
    		
    			<iframe
              id="contact_form"
              name="contact_form"
              align="center"
              src="/jquery/contact_form.php"
              width="99%"
              frameborder="0"
              height="310px"
              marginheight="0"
              marginwidth="0">
          </iframe> 
	</div>
	
	<div id="popup_check_code" class="popup_block">
    <div class="pop_head"><h6>Select a city or input a zip code:</h6> </div>
	 		<iframe
              id="check_code_form"
              name="check_code_form"
              align="center"
              src="/jquery/check_code_form.php"  
              width="99%"
              frameborder="0"
              height="190px"
              marginheight="0"
              marginwidth="0"
			  >
          </iframe> 
	</div>

<script>
	$(document).ready(function() {
	//When you click on a link with class of poplight and the href starts with a # 
		$('a.poplight[href^=#]').click(function() {
    			var popID = $(this).attr('rel'); //Get Popup Name
    			var popURL = $(this).attr('href'); //Get Popup href to define size

    			//Pull Query & Variables from href URL
    			var query= popURL.split('?');
    			var dim= query[1].split('&');
    			var popWidth = dim[0].split('=')[1]; //Gets the first query string value
				
				//alert(document.getElementById("citylist").value);

    			//Fade in the Popup and add close button
    			$('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="/images/close_button.png" class="btn_close" title="Close Window" alt="Close" /></a>');

    			//Define margin for center alignment (vertical   horizontal) - we add 80px to the height/width to accomodate for the padding  and border width defined in the css
    			var popMargTop = ($('#' + popID).height() + 80) / 2;
    			var popMargLeft = ($('#' + popID).width() + 80) / 2;

    			//Apply Margin to Popup
    			$('#' + popID).css({
        		'margin-top' : -popMargTop,
        		'margin-left' : -popMargLeft
    			});

    			//Fade in Background
    			$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
				$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 

    			return false;
		});

		//Close Popups and Fade Layer
		$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...
          var frame = document.getElementById("check_code_form");
          var frameDoc = frame.contentDocument || frame.contentWindow.document;
          alert("test");
          
    			$('#fade , .popup_block').fadeOut(function() {
            $('#fade, a.close').remove();  //fade them both out
    			});
    				return false;
		});
	});
	
</script> <!-- ### End popup code -->

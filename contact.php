<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact VisitorsShop.com</title>
	<?php  require 'head.php' ?>
</head>
<body>

<!--==============================header=================================-->
<?php require 'header.php' ?> 
<!--==============================content================================-->
  <section id="content">
     <div class="container_24">
        <div class="grid_9">
        	<h2 class="top-6">How to Find Us</h2>
            <div class="map">
            	<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.ca/maps?hl=en&amp;q=20+trudelle+street+scarborough&amp;ie=UTF8&amp;hq=&amp;hnear=20+Trudelle+St,+Toronto,+Toronto+Division,+Ontario+M1J+1Z4&amp;gl=ca&amp;t=m&amp;z=14&amp;ll=43.740223,-79.243868&amp;output=embed"></iframe><br /><small><a href="http://maps.google.ca/maps?hl=en&amp;q=20+trudelle+street+scarborough&amp;ie=UTF8&amp;hq=&amp;hnear=20+Trudelle+St,+Toronto,+Toronto+Division,+Ontario+M1J+1Z4&amp;gl=ca&amp;t=m&amp;z=14&amp;ll=43.740223,-79.243868&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>              
            </div>
        </div>
        <div class="grid_5">
        	<dl class="dl1">
                <dt>
                    www.VisitorsShop.Com<br>      
                    JustEtc (Just et cetera) Technologies              
					Trudelle Street<br>
					Scarborough, Toronto, Ontario, Canada<br/>
					M1J 1Z1
				</dt>                
                <dd><span>Telephone:</span>+1 647 624 8509</dd>                
                <dd>E-mail: <a href="#" class="color-2">info@visitorsshop.com</a></dd>                
            </dl>
        </div>
        <div class="grid_9 prefix_1">
        	<h2 class="top-6">Contact Form</h2>
        	<form id="form" action='contact.php' method='POST'>
              <div class="success"><div class="success_txt">Contact form submitted!<br /><strong> We will be in touch soon.</strong></div></div>
              <fieldset>
                <label class="name">
                  <input type="text" value="Name" id='name' name='name'>
                    <span class="error error-empty">*This is not a valid name.</span><span class="empty error-empty">*This field is required.</span> </label>
                <label class="email">
                  <input type="text" value="E-mail" id='email' name='email'>
                    <span class="error error-empty">*This is not a valid email address.</span><span class="empty error-empty">*This field is required.</span> </label>
                <label class="phone">
                  <input type="tel" value="Phone" id='phone' name='phone'>
                    <span class="error error-empty">*This is not a valid phone number.</span><span class="empty error-empty">*This field is required.</span> </label>
                <label class="message">
                  <textarea id='message' name='message'>Message</textarea>
                  <span class="error">*The message is too short.</span> <span class="empty">*This field is required.</span> </label>
                  <div class="btns"><a data-type="reset" class="button" href="#">clear</a><a data-type="submit" class="button">send</a></div>
              </fieldset>
            </form> 
        </div>
        <div class="clear"></div>
      </div>  
  </section> 
<!--==============================footer=================================-->
<?php  require 'footer.php' ?>
</body>
</html>
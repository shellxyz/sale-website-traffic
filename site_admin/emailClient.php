<?php session_start(); if ($_SESSION['admin'] != 1) {echo ('Unauthorized Access'); exit;} ?>
<div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
	include 'leftMenu.php';
?>
</div>
<div style='width:1080px;position:absolute;left:160px;top:0px;'>
<br/>
<br/>

<?php

	if (  (isset($_POST['email']) && (isset($_POST['message'])) )){
		$email = $_POST['email'];
		$clientId = $_POST['clientId'];
		$headers = 'To: $email ' . "\r\n";
		$headers = 'From: Online Services Cloud - Traffic System <traffic_support@onlineservicescloud.com>' . "\r\n";

		$body = "Dear Customer,\n\n";
		$body .= $_POST['message'];


		require 'oursites.php';


		$country = $_POST['country'];


		$body .= "\n\nPlease check http://www.VisitorsShop.com/clientHome.php?clientId=$clientId for your campaign status.\n\nCampaign Details:\n\nURL: {$_POST['url']}\nVisitors Bought: {$_POST['visitsBought']}\nVisitors Allocated: {$_POST['allocatedVisits']} \nCountry: $country \nVisitor Remaining: {$_POST['remaining']}\nIs Active: {$_POST['isActive']}, 1 = Yes, 0 = No \n\nWe are always here to listen to you and help you out with any of your concerns. Contact our customer support at traffic_support@onlineservicescloud.com with any of your concerns at any time. We will be more than happy to assist you.\n\nRegards,\n$ourSites \n\n\n$disclaimer" ;
		$send = mail('traffic_support@onlineservicescloud.com', 'Regarding your campaigns with us', $body, $headers);
        $send = mail($email,'Regarding your campaigns with us',$body, $headers);
        if ($send){
        	echo ('Email sent successfully');
        }
	}

?>

<form action='emailClient.php' method='post'>
	<strong>Client Email:</strong><br/> <input type='text' id='email' name='email' value = '<?php echo $_POST['email']?>' size='50'><br/><br/>
	<strong>Message</strong>:<br/><textarea id='message' name='message' rows='10' cols='80'></textarea><br/><br/>
	<input type='submit' id='submit' name='submit' value='Email Client'>


	<input type='hidden' id='id' name='id' value="<?php echo $_POST['id']  ?>" size='5' readonly='true'>
    <input type='hidden' id='clientId' name='clientId' value="<?php echo $_POST['clientId']; ?>" size='5' readonly='true'>
    <input type='hidden' id='email' name='email' value="<?php echo $_POST['email'] ?>" size='30'>
    <input type='hidden' id='url' name='url' value='<?php echo $_POST['url']?>' size='60'>
    <input type='hidden' id='visitsBought' name='visitsBought' value="<?php echo $_POST['visitsBought']?>" size='10'>
    <input type='hidden' id='isBonus' name='isBonus' value="<?php echo $_POST['isBonus'] ?>" size='10'></strong>
    <input type='hidden' id='allocatedVisits' name='allocatedVisits' value="<?php echo $_POST['allocatedVisits']?>" size='10'>
    <input type='hidden' id='remaining' name='remaining' value="<?php echo $_POST['remaining']?>" size='10'>
    <input type='hidden' id='delivered' name='delivered' value="<?php echo $$delivered?>" size='10' readonly='true'>
    <input type='hidden' id='country' name='country' value="<?php echo $_POST['country']?>" size='10'>
    <input type='hidden' id='isActive' name='isActive' value="<?php echo $_POST['isActive']?>" size='10'>
    <input type='hidden' id='priority' name='priority' value="<?php echo $_POST['priority']?>" size='10'>
    <!--<input type='hidden' id='dateBought' name='dateBought' value="<?php echo $_POST['dateBought']?>" size='10'>-->
</form>

<?php
$email = $_POST['email'];

if (!$email) {exit;}

// we connect to example.com and port 3307
$link = mysql_connect('localhost', 'visitor_traffic', 'UEpmKvAqB=^)');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}


if (!mysql_select_db("visitor_traffic-database")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

$sql = " insert into clients (email) values ('$email')" ;
//echo $sql ;
$result = mysql_query($sql);
if ($result && mysql_insert_id($link) > 0){
	echo ("<strong>Client Added:".mysql_insert_id($link)."</strong>");
	$clientId=mysql_insert_id($link);
	// Additional headers
	$headers = 'To: $email ' . "\r\n";
	$headers = 'From: Online Services Cloud - Traffic System <traffic_support@onlineservicescloud.com>' . "\r\n";

	$disclaimer = "Disclaimer: We do not guarantee sales, sign ups, and clicks, as your site must sell itself and we can only send quality visitors	to your site. Though we try to send visitors from different unique IPs, there is no guarantee that it will be 100% unique. We used the term Unique to indicate that we will show your web-sites to many unique visitors/computers (we will try to scatter the traffic as much as possible and maintain 24 hour unique - but no guarantee). Mostly the visitors will be from many unique IPs (may or may not be all) in 24 hour period. We do not guarantee any percentage of uniqueness. Regarding traffic statistics: http://www.VisitorsShop.com/ is the only acceptable statistics. we know what we are doing. We keep track of the traffic on our own. Whenever we send a visitor (it can be a previous IP) to your site - if we can load your site, we deduct 1 visit. Third party counters may not be able to count all visits; hence, we do not accept their statistics. Visitors many times may close the window even before the tracking code is loaded. If the 3rd party tracking is done through JavaScript, tracking may not work if JavaScript is disabled at the visitors' Computers.";
	$body = "Dear Customer,\n\nYour user account with our Add Server is created. We will add your web-sites to our system soon. Please check http://www.VisitorsShop.com/clientHome.php?clientId=$clientId for your own traffic statistics, and http://www.VisitorsShop.com/ for the traffic queue. We are always here to listen to you and help you out with any of your concerns. Contact our customer support at traffic_support@onlineservicescloud.com with any of your concerns at any time. We will be more than happy to assist you.\n\nRegards,\nSayed\nBuy more traffic from us http://www.VisitorsShop.com \n We develop software as well http://www.justetc.net \n Play free online Games at http://games.onlineservicescloud.com \n Shop at http://mall.onlineservicescloud.com\n\n\n$disclaimer";

	$send = mail('traffic_support@onlineservicescloud.com', 'Your user account with our Add Server is created ', $body, $headers);
	$send = mail($email, 'Your user account with our Add Server is created ', $body, $headers);
	if ($send){
		echo ("Email sent successfully<br/>");
	}
}else{
	echo ("<strong>Errpr: Client Add</strong>");
}

mysql_close($link);


?>
</div>

<form action='addClient.php' method='post'>
	Client Email: <input type='text' id='email' name='email'>
	<input type='submit' id='submit' name='submit' value='Add Client'>
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
	$headers = 'From: Online Services Cloud <traffic_support@onlineservicescloud.com>' . "\r\n";

	require 'oursites.php';

	$disclaimer = "Disclaimer: We do not guarantee sales, sign ups, and clicks, as your site must sell itself and we can only send quality visitors	to your site. Though we try to send visitors from different unique IPs, there is no guarantee that it will be 100% unique. We used the term Unique to indicate that we will show your web-sites to many unique visitors/computers (we will try to scatter the traffic as much as possible and maintain 24 hour unique - but no guarantee). Mostly the visitors will be from many unique IPs (may or may not be all) in 24 hour period. We do not guarantee any percentage of uniqueness. Regarding traffic statistics: http://www.VisitorsShop.com/ is the only acceptable statistics. we know what we are doing. We keep track of the traffic on our own. Whenever we send a visitor (it can be a previous IP) to your site - if we can load your site, we deduct 1 visit. Third party counters may not be able to count all visits; hence, we do not accept their statistics. Visitors many times may close the window even before the tracking code is loaded. If the 3rd party tracking is done through JavaScript, tracking may not work if JavaScript is disabled at the visitors' Computers. Please check http://www.VisitorsShop.com/counterMismatch.php to understand internet traffic better.";
	$body = "Dear Customer,\n\nYour user account with our Add Server is created. We will add your web-sites to our system soon. Please check http://www.VisitorsShop.com/clientHome.php?clientId=$clientId for your own traffic statistics, and http://www.VisitorsShop.com/ for the traffic queue. We are always here to listen to you and help you out with any of your concerns. Contact our customer support at traffic_support@onlineservicescloud.com with any of your concerns at any time. We will be more than happy to assist you.\n\n \n\nRegards,\n$ourSites \n\n\n$disclaimer";
	$send = mail($email, 'Your user account with our Add Server is created ', $body, $headers);
	if ($send){
		echo ("Email sent successfully<br/>");
	}
}else{
	echo ("<strong>Error: Client Add</strong>");
}

mysql_close($link);


?>

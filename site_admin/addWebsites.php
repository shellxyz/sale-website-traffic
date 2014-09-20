<?php session_start(); if ($_SESSION['admin'] != 1) {echo ('Unauthorized Access'); exit;} ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit traffic clients</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="../commonfiles/css/style.css" />
    <script type='text/javascript' src='../commonfiles/js/datePicker.js'></script>
</head>
<body>
<div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
	include 'leftMenu.php';
?>
</div>
<div style='width:1080px;position:absolute;left:200px;top:0px;'>
<br/>
<?php
	// we connect to example.com and port 3307
	$link = mysql_connect('localhost', 'visitor_traffic', 'UEpmKvAqB=^)');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	if (!mysql_select_db("visitor_traffic-database")) {
	    echo "Unable to select mydbname: " . mysql_error();
	    exit;
	}

	$sql = " select * from clients order by id desc " ;
	//echo $sql ;
	$result = mysql_query($sql);

	if (!$result){echo "Error"; exit;}

	$numClients = mysql_num_rows($result);

	$i=0;
	$data = array();
	while ($i < $numClients){
		$row = mysql_fetch_assoc($result);
		$optionStr .= "<option value='{$row['id']}:{$row['email']}'>{$row['email']}\n";
		$data[$row['email']]['visits_bought'] = 100000;
		$i++;
	}
?>




<form action='addWebsites.php' method='post'>
<table>
	<tr>
		<td>
			<strong>Client Email:</strong>
		</td>
		<td>
			<!--

				onchange='fill_data(<?php echo  json_encode($data) ?>)'

			-->
			<select id='clientId' name='clientId' >
			    <option value=''>Select Client
				<?php echo $optionStr ?>
			</select>
		</td>
	</tr>


	<tr>
		<td>
			<strong>URL:</strong>
		</td>
		<td>
			<input type='text' id='url' name='url' size='60' value = 'http://' /> <input type='button' id='validate' name='validate' onclick = "validate_url()" value = 'Validate' >
		</td>
	</tr>




	<tr>
		<td>
			<strong>Visits Bought:</strong>
		</td>
		<td>
			<input type='text' id='visitsBought' name='visitsBought' size='60' value='1000'>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Allocated:</strong>
		</td>
		<td>
			<input type='text' id='allocatedVisits' name='allocatedVisits' size='20' value='1010'>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Remaining:</strong>
		</td>
		<td>
			<input type='text' id='remaining' name='remaining' size='20' value='1010'>
			<strong>5%: 5000 => 5250, 10000 => 10500, 20000 => 21000</strong>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Date Bought:</strong>
		</td>
		<td>
			<input type='text' id='dateBought' name='dateBought' size='20' value='<?php echo date('Y-m-d'); ?>'>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Is Our Site</strong>
		</td>
		<td>
			<input type='text' id='isJustEtc' name='isJustEtc' size='20' value='0'>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Is Active</strong>
		</td>
		<td>
			<input type='text' id='isActive' name='isActive' size='20' value='0'>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Is Bonus</strong>
		</td>
		<td>
			<input type='text' id='isBonus' name='isBonus' size='20' value='0'>
		</td>
	</tr>


	<tr>
		<td>
			<strong>Priority</strong>
		</td>
		<td>
			<input type='text' id='priority' name='priority' size='10' value='5'>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Country</strong>
		</td>
		<td>
			<input type='text' id='country' name='country' size='10' value='NA'>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Daily Maximum:</strong>
		</td>
		<td>
			<input type='text' id='daily_cap' name='daily_cap' size='10' value='1010'>
		</td>
	</tr>




	<tr>
		<td>
			<input type='submit' id='submit' name='submit' value='Add Web Site'>
		</td>
		<td>

		</td>
	</tr>



</form>

<script>

 function validate_url(){
 	var url_to_validate = document.getElementById('url').value;
 	window.open('indexTrafficSample.php?url='+url_to_validate,'','');
 }

 function fill_data(data){
 	alert(data);
 	var visitsBought = document.getElementById('visitsBought')
 	var selectedClient = document.getElementById('clientId').options[document.getElementById('clientId').selectedIndex].text;
 	alert(visitsBought);
 	visitsBought.value = '1 Million';
 }


</script>


<?php

$clientId = $_POST['clientId'];
$clientIds = split(":",$clientId);
$clientId = $clientIds[0];
$email = $clientIds[1];
//echo $email;

$url = $_POST['url'];
$visitsBought  = $_POST['visitsBought'];
$allocatedVisits = $_POST['allocatedVisits'];
$remaining = $_POST['remaining'];
$dateBought = $_POST['dateBought'];
$isActive = $_POST['isActive'];
$isBonus = $_POST['isBonus'];
$isJustEtc = $_POST['isJustEtc'];
$priority = $_POST['priority'];
$country = $_POST['country'];
$daily_cap = $_POST['daily_cap'];
if (!$clientId) {exit;}

$sql = " insert into web_sites (clientId, 	url, 	visitsBought, 	allocatedVisits, 	remaining, 	dateBought, isActive, isBonus, isJustEtc, priority, country, daily_cap) values ('$clientId', 	'$url', 	'$visitsBought', 	'$allocatedVisits', 	'$remaining', 	'$dateBought', '$isActive', '$isBonus', '$isJustEtc','$priority', '$country', $daily_cap )" ;
$result = mysql_query($sql);
if ($result && mysql_insert_id($link) > 0){


	echo ("<strong>Web Site Added</strong><br/>");

	$headers = 'To: $email ' . "\r\n";
	$headers = 'From: Online Services Cloud - Traffic System <traffic_support@onlineservicescloud.com>' . "\r\n";


	require 'oursites.php';

	$disclaimer = "Disclaimer: We do not guarantee any sales, sign ups, and clicks, as your site must sell itself and we can only send quality visitors	to your site. Though we try to send visitors from different unique IPs, there is no guarantee that it will be 100% unique. We used the term Unique to indicate that we will show your web-sites to many unique visitors/computers (we will try to scatter the traffic as much as possible and maintain 24 hour unique - but no guarantee). Mostly the visitors will be from many unique IPs (may or may not be all) in 24 hour period. We do not guarantee any percentage of uniqueness. Regarding traffic statistics: http://www.VisitorsShop.com/ is the final acceptable statistics. we know what we are doing. We keep track of the traffic on our own. Whenever we send a visitor to your site - if we can load your site, we deduct 1 visit. We bring traffic (country and category specific) from different sources to our web-pages such as http://onlineservicescloud.com/ebay/indexTrafficSample.php from where we load your site. In the same page, we count the visit. Hence, we can keep track of the traffic accurately. Third party counters may not be able to count all visits; hence, we do not accept their statistics. Visitors many times may close the window even before the tracking code is loaded. If the 3rd party tracking is done through JavaScript, tracking may not work if JavaScript is disabled at the visitors' Computers. Visitors may travel to another page by clicking a link even before the third party tracking code can get loaded and finished tracking. However, we are always here to listen to you. You can track your traffic as well on your own or using third party counters. Google Analytics may not work well with our traffic [as we use iframe in our pages, GA may not work well with Iframes].";
	$body = "Dear Customer,\n\nYour campaign is just initiated. You will start receiving visitors soon. Please check http://www.VisitorsShop.com/clientHome.php?clientId=$clientId for your own traffic statistics, and http://www.VisitorsShop.com/ for the traffic queue.\n\nCampaign Details:\n\nURL: $url \nVisitors Allocated: $allocatedVisits \nCountry: $country\n\nAlways, we are here to listen to you and help you out with any of your concerns. Contact our customer support at traffic_support@onlineservicescloud.com with any of your concerns at any time. We will be more than happy to assist you.\n\nRegards,\n $ourSites \n\n\n\n$disclaimer";

	//$send = mail($email,'Your campaign is initiated', $body, $headers);
	$send = mail('traffic_support@onlineservicescloud.com', 'Your campaign is initiated', $body, $headers);
	$send = mail($email,'Your campaign is initiated', $body, $headers);

	if ($send){
		echo "Email Sent to $email<br/>";
		//$send = mail('traffic_support@onlineservicescloud.com','Your campaign is initiated',$email."\n\n".$body);
	}
}else{
	echo ("<strong>Error: Client Add</strong>");
}

mysql_close($link);


?>
</table>
</form>
</div>


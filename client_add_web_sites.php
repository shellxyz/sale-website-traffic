<div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
	include 'clientLeftMenu.php';
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

	$sql = " select * from clients where id = {$_GET['clientId']} " ;
	//echo $sql ;
	$result = mysql_query($sql);

	if (!$result){echo "Error"; exit;}

	$numClients = mysql_num_rows($result);

	$i=0;
	$remaining_visit = 0;
	$visits_bought = 0;
	while ($i < $numClients){
		$row = mysql_fetch_assoc($result);
		$remaining_visit = $row['remaining_visit'];
		$visits_bought = $row['visits_bought'];

		$target_country = $row['target_country'];
		$optionStr .= "<option value='{$row['id']}:{$row['email']}'>{$row['email']}\n";
		$i++;
	}

	switch($target_country){
		default:
			$target_country_disp = $target_country;
			break;
	}
?>




<form action='<?php echo $_SERVER['SCRIPT_NAME'].'?'.$_SERVER['QUERY_STRING']; ?>' method='post'>
<table>
	<tr>
		<td>
			<strong>Client Email:</strong>
		</td>
		<td>
			<select id='clientId' name='clientId'>
				<?php echo $optionStr ?>
			</select>
		</td>
	</tr>


	<tr>
		<td>
			<strong>URL:</strong>
		</td>
		<td>
			<input type='text' id='url' name='url' size='60' value = 'http://' >
		</td>
	</tr>

	<tr>
		<td>
			<strong>Remaining Visits :</strong>
		</td>
		<td>
		   <?php echo $remaining_visit; ?>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Assign Visits :</strong>
		</td>
		<td>
		   <input type = 'text' id = 'assigned_visits' name = 'assigned_visits' value = '<?php echo $remaining_visit; ?>' size = '10' />
		</td>
	</tr>

	<tr>
		<td>
			<strong>Visits Bought:</strong>
		</td>
		<td>
		  <?php echo $visits_bought; ?>
		  <input type='hidden' id='visits_bought' name='visits_bought' value='<?php echo $visits_bought; ?>' readonly />
		</td>
	</tr>


	<tr>
		<td>
			<strong>Daily Maximum:</strong>
		</td>
		<td>
		   <input type = 'text' id = 'daily_cap' name = 'daily_cap' value = '<?php echo $remaining_visit; ?>' size = '10' />
		</td>
	</tr>

	<!-- tr>
		<td>
			<strong>Is JustEtc</strong>
		</td>
		<td>
			<input type='hidden' id='isJustEtc' name='isJustEtc' size='20' value='0'>
		</td>
	</tr-->

	<tr>
		<td>
			<strong>Activate</strong>
		</td>
		<td>
			<select id='isActive' name='isActive'>
				<option value='1'> Yes
				<option value='0'> No
			</select>
		</td>
	</tr>

	<!-- tr>
		<td>
			<strong>Is Bonus</strong>
		</td>
		<td>
			<input type='hidden' id='isBonus' name='isBonus' size='20' value='0' readonly>
		</td>
	</tr-->


	<tr>
		<td>
			<strong>Priority</strong>
		</td>
		<td>
			<input type='text' id='priority' name='priority' size='10' value='5' readonly>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Target Country</strong>
		</td>
		<td>
			<strong><?php echo $target_country_disp; ?></strong>

			<input type = 'hidden' id = 'country' name = 'country' value = '<?php echo $target_country_disp; ?>' >


		</td>
	</tr>

	<tr>
		<td>
			<strong>Date Bought:</strong>
		</td>
		<td>
			<input type='text' id='dateBought' name='dateBought' size='20' value='<?php echo date('Y-m-d'); ?>' readonly>
		</td>
	</tr>


	<!-- tr>
		<td>
			<strong>Allocated Visitors:</strong>
		</td>
		<td>
		You will be assigned 5% more visits than bought
		 <select id='allocatedVisits' name='allocatedVisits'>
		    	<option value = '1150'> 1150
		    	<option value = '5750'> 5,000
		    	<option value = '11500'> 10,000
		    	<option value = '23000'> 20,000
		    	<option value = '57500'> 50,000
		    	<option value = '115000'> 100K
		    	<option value = '500000'> 500K
		    	<option value = '1000000'> 1 Million
		    	<option value = '3000000'> 3 Million
		    	<option value = '5000000'> 5 Million
		    </select>
		</td>
	</tr>

	<tr>
		<td>
			<strong>Remaining Visitors:</strong>
		</td>
		<td>
			You will be assigned 5% more visits than bought
			<input type='text' id='remaining' name='remaining' size='20' value='1150'> (please insert 15% more than bought)>
		</td>
	</tr-->



	<tr>
		<td>
			<input type='submit' id='submit' name='submit' value='Add Web Site'>
		</td>
		<td>

		</td>
	</tr>



</form>

<?php

$clientId = $_POST['clientId'];
$clientIds = split(":",$clientId);
$clientId = $clientIds[0];
$email = $clientIds[1];
//echo $email;

$url = $_POST['url'];
$visits_bought  = $_POST['visits_bought'];
//$allocatedVisits = $visitsBought + $visitsBought*0.05; //$_POST['allocatedVisits'];
$allocatedVisits = $_POST['assigned_visits'];

$remaining = $allocatedVisits; //$visitsBought + $visitsBought*0.05; //$_POST['remaining'];
$dateBought = $_POST['dateBought'];
$clientActivated = $_POST['isActive'];
$isBonus = $_POST['isBonus'];
$isJustEtc = $_POST['isJustEtc'];
$priority = $_POST['priority'];
$country = $_POST['country'];
$daily_cap = $_POST['daily_cap'];

if (!$clientId) {exit;}

$sql = "
		insert into web_sites set
		clientId = '$clientId',
		url = '$url' ,
		visitsBought = '$visits_bought',
		allocatedVisits = '$allocatedVisits',
		remaining = '$remaining',
		dateBought = '$dateBought',
		clientActivated = '$clientActivated',
		isBonus = '$isBonus',
		isJustEtc = '$isJustEtc',
		priority = '$priority',
		country = '$country',
		daily_cap = $daily_cap

	";


//echo $sql;



$result = mysql_query($sql);
if ($result && mysql_insert_id($link) > 0){

	update_remaining_visit($clientId, $allocatedVisits, $link);

	if (trim($country)=='global'){
		$country = "North America";
	}else if ($country=='NA'){
		$country = "Canada";
	}
	echo ("<strong>Web Site Added</strong><br/>");
	require 'oursites.php';
	$disclaimer = "Disclaimer: We do not guarantee any sales, sign ups, and clicks, as your site must sell itself and we can only send quality visitors	to your site. Though we try to send visitors from different unique IPs, there is no guarantee that it will be 100% unique. We used the term Unique to indicate that we will show your web-sites to many unique visitors/computers (we will try to scatter the traffic as much as possible and maintain 24 hour unique - but no guarantee). Mostly the visitors will be from many unique IPs (may or may not be all) in 24 hour period. We do not guarantee any percentage of uniqueness. Regarding traffic statistics: http://www.VisitorsShop.com/ is the final acceptable statistics. we know what we are doing. We keep track of the traffic on our own. Whenever we send a visitor to your site - if we can load your site, we deduct 1 visit. We bring traffic (country and category specific) from different sources to our web-pages such as http://onlineservicescloud.com/ebay/indexTrafficSample.php from where we load your site. In the same page, we count the visit. Hence, we can keep track of the traffic accurately. Third party counters may not be able to count all visits; hence, we do not accept their statistics. Visitors many times may close the window even before the tracking code is loaded. If the 3rd party tracking is done through JavaScript, tracking may not work if JavaScript is disabled at the visitors' Computers. Visitors may travel to another page by clicking a link even before the third party tracking code can get loaded and finished tracking. However, we are always here to listen to you. You can track your traffic as well on your own or using third party counters. Google Analytics may not work well with our traffic [as we use iframe in our pages, GA may not work well with Iframes].";
	$body = "Dear Customer,\n\nYour campaign is just initiated. You will start receiving visitors soon. Please check http://www.VisitorsShop.com/clientHome.php?clientId=$clientId for your own traffic statistics, and http://www.VisitorsShop.com/ for the traffic queue.\n\nCampaign Details:\n\nURL: $url \nVisitors Allocated: $allocatedVisits \nCountry: $country\n\nAlways, we are here to listen to you and help you out with any of your concerns. Contact our customer support at traffic_support@onlineservicescloud.com with any of your concerns at any time. We will be more than happy to assist you.\n\nRegards,\n $ourSites \n\n\n\n$disclaimer";
	$headers = 'To: $email ' . "\r\n";
	$headers = 'From: Online Services Cloud - Traffic System <traffic_support@onlineservicescloud.com>' . "\r\n";
	$send = mail($email,'You just added websites to our Internet Traffic System', $body, $headers);
	if ($send){
		echo "Email Sent to $email<br/>";
		//$send = mail('traffic_support@onlineservicescloud.com','Your campaign is initiated',$email."\n\n".$body);
	}
}else{
	echo ("<strong>Error: Client Add</strong>");
}

mysql_close($link);


function update_remaining_visit($clientId, $allocatedVisits,$link){

	$update_str = " update clients set remaining_visit = remaining_visit - $allocatedVisits where id = '$clientId' ";
	$result = mysql_query($update_str);

	if ($result) return true;

	return false;

}


?>
</table>
</form>
</div>

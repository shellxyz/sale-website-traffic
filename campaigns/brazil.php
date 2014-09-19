<center>
<?php
	// we connect to example.com and port 3307
	$link = mysql_connect('localhost', 'db-user-traffic', 'traffic-user-password');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}


	if (!mysql_select_db("traffic-database")) {
	    echo "Unable to select mydbname: " . mysql_error();
	    exit;
	}

	$sql = " SELECT * FROM web_sites where remaining > 0 and isActive > 0 and isBonus = '0' and country in ('Brazil') and is_freezed = 0 order by priority desc, country desc, accessed asc limit 1 ";
	$result = mysql_query($sql);



	if ($result){
	   $num_rows  = mysql_num_rows($result);
	   if ($num_rows > 0){

			$url = array();
			require 'campaign_sites.php';

			$random = rand(0, count($url)-1);
			$justetcUrl = $url[$random];

?>

<iframe src='<?php echo $justetcUrl; ?>' width='95%' height='150'>
</iframe>

<table width='95%' border='0' cellspacing='0' cellpadding='0'>
<tr valign='top'>
	<td width='200' align='left'>
		<?php
			$url = mysql_result($result,0, "url");
			mysql_data_seek($result,0);
		?>
		<span><strong><a href='<?php echo $url; ?>'>Go to Sponsor Site</a><strong></span>
	</td>

	<td align='center'>
		<span ><strong><a href='http://www.VisitorsShop.com'>Buy Traffic from us and have your Website below</a><strong></span>
	</td>

	<td width='200' align='right'>
		<span><strong><a href='<?php echo $justetcUrl; ?>'>Skip this Add</a><strong></span>
	</td>
</tr>
</table>

<?php
         $i = 0;
         while ($i < $num_rows){
             $row = mysql_fetch_assoc($result);
             $i++;

         	 $height = '400';
             if ($i==$num_rows){
             	$height = '2000';
             }
             echo ("<iframe src='".$row['url']."'  width='95%' height='$height' border='0' ></iframe>");

             $current_timestamp = time();

             $sqlUpdate = "update web_sites set remaining = remaining - 1, accessed = $current_timestamp where id = {$row[id]}";
             $deduct = mysql_query($sqlUpdate);
         	 $remaining = $row['remaining'];
             if ($deduct){
             	$remaining = $row['remaining'];

             	$visitsBought  = $row['visitsBought'];
             	$country = $row['country'];
	             if ($country=='global'){
					$country = "North America";
				 }
				 $id = $row['id'];
				 $url = $row['url'];
				 $clientId = $row['clientId'];
				 $allocatedVisits  = $row['allocatedVisits'];


				 /* code to keep track of daily cap and perform associated operations */
				 $today_date = date("Y-m-d");
				 $db_date_today   = $row['date_today'];

				 $delivered_today = $row['delivered_today'];
				 $daily_cap = ($row['daily_cap'] == 0 )? 10000000: $row['daily_cap'];

             	 $update_str = " delivered_today = delivered_today + 1 ";
             	 $freeze_str = ", is_freezed = 0 ";

			 	 if ($delivered_today+1 >= $daily_cap){
			 		$freeze_str = " , is_freezed = 1 ";
			 	 }

				 if ($db_date_today != $today_date){
				 	$update_str = " delivered_today = 0 ";
				 	$freeze_str = ", is_freezed = 0 ";
				 }

				 $sql_daily_cap = " update web_sites set $update_str, date_today = '$today_date' $freeze_str where id = {$row[id]}";
             	 $update_daily_cap = mysql_query($sql_daily_cap);

             	 //echo "<br/>"."<br/>".$sql_daily_cap;


	             if ($remaining <= 1){
	             	$remaining = 0;

					require 'oursites.php';

	             	$disclaimer = "Disclaimer: We do not guarantee any sales, sign ups, and clicks, as your site must sell itself and we can only send quality visitors	to your site. Though we try to send visitors from different unique IPs, there is no guarantee that it will be 100% unique. We used the term Unique to indicate that we will show your web-sites to many unique visitors/computers (we will try to scatter the traffic as much as possible and maintain 24 hour unique - but no guarantee). Mostly the visitors will be from many unique IPs (may or may not be all) in 24 hour period. We do not guarantee any percentage of uniqueness. Regarding traffic statistics: http://www.onlineservicescloud.com/traffic is the final acceptable statistics. we know what we are doing. We keep track of the traffic on our own. Whenever we send a visitor to your site - if we can load your site, we deduct 1 visit. We bring traffic (country and category specific) from different sources to our web-pages such as http://onlineservicescloud.com/ebay/indexTrafficSample.php from where we load your site. In the same page, we count the visit. Hence, we can keep track of the traffic accurately. Third party counters may not be able to count all visits; hence, we do not accept their statistics. Visitors many times may close the window even before the tracking code is loaded. If the 3rd party tracking is done through JavaScript, tracking may not work if JavaScript is disabled at the visitors' Computers. Visitors may travel to another page by clicking a link even before the third party tracking code can get loaded and finished tracking. However, we are always here to listen to you. You can track your traffic as well on your own or using third party counters. Google Analytics may not work well with our traffic [as we use iframe in our pages, GA may not work well with Iframes].";
	             	$body = "Dear Customer,\n\nOne of Your campaigns just got finished. Please check http://www.onlineservicescloud.com/traffic/clientHome.php?clientId=$clientId for your campaign status.\n\nCampaign Details:\n\nURL: $url \nVisitors Bought: $visitsBought\nVisitors Allocated: $allocatedVisits \nCountry: $country\nVisitor Remaining: $remaining\n\nPlease take a short survey to help us to improve our service at: http://www.VisitorsShop.com/survey.php?clientId=$clientId&websiteId=$id  \n\nWe are always here to listen to you and help you out with any of your concerns. Contact our customer support at traffic_support@onlineservicescloud.com with any of your concerns at any time. We will be more than happy to assist you.\n\nRegards,\n$ourSites \n\n\n$disclaimer";
	             	$headers = 'To: $email ' . "\r\n";
					$headers = 'From: Online Services Cloud - Traffic System <traffic_support@onlineservicescloud.com>' . "\r\n";


		            $send = mail('traffic_support@onlineservicescloud.com','One of your campaigns just got finished',$body, $headers);
		            $send = mail($email,'One of your campaigns just got finished',$body, $headers);


	             }

             }
         }
   }
   else{

   	echo("
   		<script>
   		  window.location.href='http://www.VisitorsShop.com';
   		</script>
   		"

   	);


   }
}

mysql_close($link);


?>


</center>
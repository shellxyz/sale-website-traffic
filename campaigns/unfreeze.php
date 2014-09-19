<?php

	require_once("functions.php");

	$dbh = connect_traffic_db();
	$is_logged = log_daily_traffic();

	if (!($is_logged)){
		mail('traffic_support@onlineservicescloud.com','Traffic Logging Failed', 'Traffic Logging Failed');
		mail('rafiq198006@yahoo.com','Traffic Logging Failed', 'Traffic Logging Failed');
		echo 'Traffic Logging Failed';
	}

	$is_unfreezed = unfreeze_all_web_sites($dbh);
	if (!($is_unfreezed)){
		mail('traffic_support@onlineservicescloud.com','Unfreezing failed', 'Unfreezing failed');
		mail('rafiq198006@yahoo.com','Unfreezing failed', 'Unfreezing failed');
		echo 'Unfreezing failed';
	}

	function log_daily_traffic(){
		$log_sql = " insert into daily_traffic_history (client_id, web_site_id, date, traffic_delivered, url) SELECT clientId, id, date_today, delivered_today, url from web_sites where delivered_today > 0 ";
		$result = mysql_query($log_sql);

		if ($result) return true;
		return false;

	}

	function unfreeze_all_web_sites(){
		$today = date("Y-m-d");
		$unfreeze_sql = " update  `web_sites` set is_freezed = 0, date_today =  '$today', delivered_today = 0 ";
		$result = mysql_query($unfreeze_sql);

		if ($result) return true;
		return false;

	}

	echo 'success';
?>
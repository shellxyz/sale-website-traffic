<?php

	require_once "geo/geoip/geoip.inc";

	$country = "";
	$ip = "";
	$gi = "";
	$currentTime = ""; mktime();

	main();

	function main(){
		global $country, $ip, $currentTime;

		$currentTime = mktime();
	    $gi = geoip_open("geo/geoip/GeoIP.dat",GEOIP_STANDARD);
	    $ip = $_SERVER["REMOTE_ADDR"];
	    $country = geoip_country_code_by_addr($gi, $ip);
	    geoip_close($gi);
		setcookie("geo", $country, time()+15552000, "/", $base.$domain, 0); //6 month cookie
		connect();
		displayClientWebSite($ip, $country, $currentTime);
	}

	//logic to decide whether to display a site or not
	//also display a site
	function displayClientWebSite($ip, $country, $currentTime){
		//check if the ip is in our database
		$sqlCheckIp = " select * from vshop_ip_and_display_track where ip='$ip' order by accessed desc limit 1";
		$result = mysql_query($sqlCheckIp);
		if (!$result){
		}else{
			if (mysql_num_rows($result)>0){
				$row = mysql_fetch_assoc($result);
				$accessed = $row['accessed'];
				if (abs($currentTime-$accessed) >= 0){
					require 'geo/campaign.php';
					exit;
				}else{
				}
			}else{
				require 'geo/campaign.php';
				exit;
			}
		}
	}

	/*connect to database*/
	function connect(){
		// we connect to example.com and port 3307
		$link = mysql_connect('localhost', 'visitor_traffic', 'UEpmKvAqB=^)');
		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		}

		if (!mysql_select_db("visitor_traffic-database")) {
		    echo "Unable to select mydbname: " . mysql_error();
		    exit;
		}
	}

?>
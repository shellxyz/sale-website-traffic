<?php

	function connect_traffic_db(){


		$link = mysql_connect('localhost', 'db-user-traffic', 'traffic-user-password');
		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		}


		if (!mysql_select_db("traffic-database")) {
		    echo "Unable to select mydbname: " . mysql_error();
		    exit;
		}


		return $link;


	}
?>
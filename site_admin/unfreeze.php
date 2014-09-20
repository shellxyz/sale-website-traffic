<?php

	require_once("functions.php");
	
	$dbh = connect_traffic_db();
	unfreeze_all_web_sites($dbh);
	
	function unfreeze_all_web_sites(){
		$unfreeze_sql = "update  `web_sites` set 	is_freezed = 0 ";
		$result = mysql_query($unfreeze_sql);
	}

?>
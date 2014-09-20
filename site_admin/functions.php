<?php

	function get_client_emails(){

		$sql = " select id, email from clients order by id desc " ;
		$result = mysql_query($sql);

		if (!$result){echo "Error"; exit;}

		$numClients = mysql_num_rows($result);

		$i=0;
		while ($i < $numClients){
			$row = mysql_fetch_assoc($result);
			$optionStr .= "<option value='{$row['id']}:{$row['email']}'>{$row['email']}\n";
			$i++;
		}

		return $optionStr;
	}

	/*connect to database*/
	function db_connect(){
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
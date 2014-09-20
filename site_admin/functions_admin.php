<?php

	function get_client_emails($clientId='', $isSort=''){
		$sortStr = " order by id desc";
		if ( (!empty($isSort) && $isSort)){
			$sortStr = " order by email ";
		}

		$sql = " select * from clients $sortStr  " ;

		$result = mysql_query($sql);

		if (!$result){echo "Error"; exit;}

		$numClients = mysql_num_rows($result);

		$i=0;
		$selected = '';
		while ($i < $numClients){
			$row = mysql_fetch_assoc($result);
			if ($row['id'] == $clientId){
				$selected = 'selected';
			}else{
				$selected = '';
			}
			$optionStr .= "<option value='{$row['id']}:{$row['email']}' $selected >{$row['email']}\n";
			$i++;
		}

		return $optionStr;
	}

	/*connect to database*/
	function db_connect(){
		// we connect to example.com and port 3307
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

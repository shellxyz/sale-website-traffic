<?php
	foreach($_POST as $key=>$value){
		$fields[$key] = $value;
	}

	//var_dump($fields);

	$insertStr = "insert into survey set ";
	$arrLength = count($fields);
	foreach($fields as $key=>$value){

		if ($key!='submit'){
			$insertStr .= "$key = '$value', ";
		}
	}

	$length = strlen($insertStr);
	$insertStr = substr($insertStr, 0, $length - 2);

	//echo $insertStr;


	$link = mysql_connect('localhost', 'db-user-traffic', 'traffic-user-password');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}


	if (!mysql_select_db("traffic-database")) {
	    echo "Unable to select mydbname: " . mysql_error();
	    exit;
	}

	$result = mysql_query($insertStr);

	if ($result) {echo ('Operation Successful. Thank you for taking the survey'); exit;}
	else {echo("Operation Unsuccessful. Please try again or contact traffic_support@onlineservicescloud.com"); exit;}



?>

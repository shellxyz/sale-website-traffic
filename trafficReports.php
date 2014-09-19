<div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
	include 'clientLeftMenu.php';
?>
</div>

<div style='width:1080px;position:absolute;left:200px;top:0px;'>

<br/>
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

	//get the client id

	$clientid = $_GET['clientId'];

	if (!$clientid) {echo 'error. no client found.'; exit;}

	$sql = "select * from daily_traffic_history where client_id = $clientid order by url, date desc";
	$result = mysql_query($sql);

	if (!$result){
		echo "error in operzation. please try later";
		exit;
	}

	$num_rows = mysql_num_rows($result);

	if ($num_rows==0){
		echo "No data found";
		exit;
	}


	echo("

		<table cellpadding='10'>
			<tr>
				<td>
					<strong>URL</strong>
				</td>

				<td>
					<strong>Day</strong>
				</td>

				<td>
					<strong>Visit</strong>
				</td>

			</tr>


	");


	while ($row = mysql_fetch_assoc($result)  ) {
			echo (
			"
				<tr>
					<td>
			".
					   substr($row['url'], 0,60)."
					</td>

					<td>
						{$row['date']}
					</td>

					<td>
						{$row['traffic_delivered']}
					</td>

				</tr>

			"

			);


	}


	echo("
		</table>
		"
	);


?>
</div>


<div style = 'width:200px;position:absolute;left:0px;top:0px;'>
	<?php
		include 'leftMenu.php';
		$totalSum = 0;

		$row_count = isset($_POST['row_count'])?$_POST['row_count']:30;
		$offset = isset($_POST['offset'])?$_POST['offset']:0;


	?>
</div>

<div style='width:1080px;position:absolute;left:201px;top:200px;'>
	<form method = 'POST' action = "allClients.php" id = 'rows_offset' name = 'rows_offset' >
	   <table border='0' width='80%' align='center'>
		   	<tr>
		   		<td>
		    		How many rows?
		    	</td>

		    	<td>
					<select id = 'row_count' name = 'row_count' onchange = "rows_offset.submit()">
						<option value = '10' <?php if ($row_count == 10) echo 'selected' ?> >10</option>
						<option value = '30' <?php if ($row_count == 30) echo 'selected' ?> >30</option>
						<option value = '50' <?php if ($row_count == 50) echo 'selected' ?>>50</option>
						<option value = '75' <?php if ($row_count == 75) echo 'selected' ?>>75</option>
						<option value = '100' <?php if ($row_count == 100) echo 'selected' ?> >100</option>
						<option value = '150' <?php if ($row_count == 150) echo 'selected' ?>>150</option>
						<option value = '200' <?php if ($row_count == 200) echo 'selected' ?>>200</option>
						<option value = '300' <?php if ($row_count == 300) echo 'selected' ?>>300</option>
						<option value = '500' <?php if ($row_count == 500) echo 'selected' ?>>500</option>
						<option value = '1000' <?php if ($row_count == 1000) echo 'selected' ?>>1000</option>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					Where to start?
				</td>

				<td>
					<select id = 'offset' name = 'offset' onchange = "rows_offset.submit()">
						<option value = '0' <?php if ($offset == 10) echo 'selected' ?> >0</option>
						<option value = '50' <?php if ($offset == 50) echo 'selected' ?>>50</option>
						<option value = '100' <?php if ($offset == 100) echo 'selected' ?>>100</option>
						<option value = '200' <?php if ($offset == 200) echo 'selected' ?>>200</option>
						<option value = '300' <?php if ($offset == 300) echo 'selected' ?>>300</option>
						<option value = '500' <?php if ($offset == 500) echo 'selected' ?>>500</option>
						<option value = '1000' <?php if ($offset == 1000) echo 'selected' ?>>1000</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo ("<p>Showing $row_count rows starting from $offset</p>");
					 ?>
				</td>
			</tr>
		</table>
	</form>

<?php

	$link = mysql_connect('localhost', 'db-user-traffic', 'traffic-user-password');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}

	if (!mysql_select_db("traffic-database")) {
	    echo "Unable to select mydbname: " . mysql_error();
	    exit;
	}


	$sql = "

		SELECT * FROM web_sites
		where  (

		(url not like '%justetc%' )

		and

		(isJustEtc = 0 )

		)

		and remaining >= 0
		order by remaining desc, dateBought desc
		limit $offset, $row_count
	";


	$result = mysql_query($sql);

	 echo ("<table border='1' width='80%' align='center'>");
	         echo("<tr><td colspan='11'><strong><span style='color:red'>Traffic Statistics for Some Recent Clients </span></strong></td></tr>");
	         echo("<tr>
	             	<td><strong>Client<strong></td>
	             	<td><strong>URL<strong></td>
	             	<td><strong>Bought<strong></td>
	             	<td><strong>IsBonus<strong></td>
	             	<td><strong>Allocated<strong></td>
	             	<td><strong>Remaining<strong></td>
	             	<td><strong>Delivered<strong></td>
	             	<td><strong>C<strong></td>
	             	<td><strong>IsActive<strong></td>
	             	<td><strong>Client Active<strong></td>
	             	<td><strong>Date Added<strong></td>
	             </tr>");

	$remainingSum = 0;
	$usSum = 0;
	$cdnSum = 0;
	$globalSum = 0;


	if ($result){

	   $num_rows  = mysql_num_rows($result);
	   if ($num_rows > 0){
	         $i = 0;
	         while ($i < $num_rows){
	             $row = mysql_fetch_assoc($result);
	             $totalSum += $row['remaining'];
	             $clientId=$row['clientId'];
	             $clientId +=2000;
	             $isBonus = $row['isBonus'];
	             switch($isBonus){
	             	case 1: $bonusText = "Bonus";
	             		    break;
	             	default: $bonusText = "";
	             			 break;

	             }

	             $url = $row['url'];

	             $delivered = $row['allocatedVisits'] - $row['remaining'];

	             echo("<tr>
	             	<td>{$clientId}</td>
	             	<td><a href='$url' target='new'>".$url."</a></td>
	             	<td>{$row['visitsBought']}</td>
	             	<td><strong>{$bonusText}</strong></td>
	             	<td>{$row['allocatedVisits']}</td>
	             	<td>{$row['remaining']}</td>
	             	<td>{$delivered}</td>
	             	<td>".substr($row['country'],0,1). "</td>
	             	<td>{$row['isActive']}</td>
	             	<td>{$row['clientActivated']}</td>
	             	<td>{$row['dateBought']}</td>
	             </tr>");

	             $i++;

	             if (trim($row['isJustEtc'])=='0'){
	             	//$totalSum += $row['remaining'];
	             }else{
	             	$justetcSum += $row['remaining'];
	             }
	             switch(trim($row['country'])){

	             	case "USA":
	             		$usSum += $row['remaining'];
	             		break;
	             	case "Canada":
	             		$cdnSum += $row['remaining'];
	             		break;
	             	case "All":
	             	case "all":
	             		$globalSum += $row['remaining'];
	             		break;
	             }
	         }




	   }
	}
	mysql_close($link);
?>
</table>
</div>

<?php
	echo("
		<div style = 'position:relative;top:-1024px;'>

		");
						echo "<strong>Remaining Traffic:</strong>&nbsp;&nbsp;&nbsp;";
						echo "<strong>USA:</strong>$usSum, ";
						echo "<strong>Canada:</strong>$cdnSum, ";
						echo "<strong>Global:</strong>$globalSum, ";
						echo "<strong>All Client:</strong>$totalSum, ";
						echo "<strong>JustETC:</strong>$justetcSum, ";
						echo "<br/><br/>";
	echo("

		</div>
		");


?>

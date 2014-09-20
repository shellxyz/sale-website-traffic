<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Client home page</title>
	<link rel="stylesheet" href="commonfiles/css/style.css" />
	<?php
		require 'head.php';
	?>


</head>

<body>
<!--==============================header=================================-->
	<?php

		require 'header.php';

	 ?>
<!--==============================content================================-->
  <section id="content">
	<div class="container_24">
		<div style='padding-bottom:200px;'>

			<span id='clientHomeTxt'><strong>Please login to access your home page:</strong></span><br/><br/>
			<form action='<?php echo $_SERVER['SCRIPT_NAME'].'?'.$_SERVER['QUERY_STRING']; ?>' method='post' id='clientHome'>
			    <strong>User Name:</strong> <input type='text' id='username' name='username'> <br/>
				<strong>Password:&nbsp;&nbsp;&nbsp;</strong> <input type='password' id='password' name='password'> <br/><br/>
				<input type='submit' id='submit' name='submit' value='Login'> <br/>
			</form>

			<?php

				error_reporting(0);
			    $username = $_POST['username'];
				$password = $_POST['password'];
				$client_id = $_REQUEST['clientId'];


				$link = mysql_connect('localhost', 'visitor_traffic', 'UEpmKvAqB=^)');
				if (!$link) {
				    die('Could not connect: ' . mysql_error());
				}

				if (!(mysql_select_db("visitor_traffic-database"))) {
				    echo "Unable to select mydbname: " . mysql_error();
				    exit;
				}



				$isLoggedIn = $_SESSION['login'];
				if (!($isLoggedIn)){
					$sql = " select id from clients where email = '$username' and password = '$password' and id = '$client_id' ";
					$result = mysql_query($sql);

					if (!($result)) {echo ('error'); exit;}

					if (mysql_num_rows($result) < 1){
						echo ('<br/><br/>Login Failure<br/><br/>');
						require 'banners.php';
						require 'footer.php';
						exit;
					}

					$_SESSION['login'] = 1;
					$_SESSION['clientId'] = $client_id;

				}
			?>
		</div>

		<script>
			document.getElementById('clientHome').style.display = 'none';
			document.getElementById('clientHomeTxt').style.display = 'none';
		</script>


		<div style='width:190px;position:absolute;left:10px;top:120px;'>
			<?php
				include 'clientLeftMenu.php';
			?>
		</div>
		<div style='width:1080px;position:absolute;left:200px;top:120px;padding-bottom:200px;'>
			<br/>
			<br/>
			<?php

				// we connect to example.com and port 3307
				$truncateDate = date("Y-m-d",mktime(0, 0, 0, date("m"),date("d")-10,date("Y")));
				$clientId = $_GET['clientId'];
				$sql = " (SELECT * FROM web_sites  where clientid = '$clientId' order by dateBought desc, remaining desc)";
				//$sql1 = " SELECT * FROM web_sites  where ((dateBought >= '$truncateDate') ) and clientid = '$clientId' order by country desc";
				//echo $sql;
				$result = mysql_query($sql);

				 echo ("<table border='1' width='80%' align='center'>");
				         echo("<tr><td colspan='12'><strong><span style='color:red'>Your Traffic Statistics</span></strong></td></tr>");
				         echo("<tr>
				             	<td><strong>Client<strong></td>
				             	<td><strong>URL<strong></td>
				             	<td><strong>Visits Bought<strong></td>
				             	<td><strong>Is Bonus<strong></td>
				             	<td><strong>Visits Allocated<strong></td>
				             	<td><strong>Remaining<strong></td>
				             	<td><strong>Delivered<strong></td>
				             	<td><strong>Bonus Received<strong></td>
				             	<td><strong>C<strong></td>
				             	<td><strong>Date Added<strong></td>
				             	<td><strong>Activate<strong></td>
				             	<td><strong>Is Running?<strong></td>
				             </tr>");

				if ($result){

				   $num_rows  = mysql_num_rows($result);
				   if ($num_rows > 0){
				         $i = 0;

				         while ($i < $num_rows){
				             $row = mysql_fetch_assoc($result);
				             $clientId=$row['clientId'];


				             $clientId +=2000;
				             $isBonus = $row['isBonus'];
				             switch($isBonus){
				             	case 1: $bonusText = "Bonus";
				             		    break;
				             	default: $bonusText = "";
				             			 break;

				             }

				             $isActive = $row['isActive'];
				             $clientActivated  = $row['clientActivated'];

				             $url = $row['url'];

				             /*
				             if (strstr($row['url'],'justetc')){
				             	$url = $row['url'];
				             }else{
				             	$url = "<strong>". $row['url'] ."</strong>";

				             }
				            */

				             $delivered = $row['allocatedVisits'] - $row['remaining'];

				             echo("<tr>
				             	<td>{$clientId}</td>
				             	<td>".$url."</td>
				             	<td>{$row['visitsBought']}</td>
				             	<td><strong>{$bonusText}</strong></td>
				             	<td>{$row['allocatedVisits']}</td>
				             	<td>{$row['remaining']}</td>
				             	<td>{$delivered}</td>
				             	<td>{$row['bonusReceived']}</td>
				             	<td>".substr($row['country'],0,1). "</td>
				             	<td>{$row['dateBought']}</td>

				             	 <td>
				             	 ");


				             	 if ($_POST['activate']=='Activate' && $row['id'] == $_POST['id']){
				             	 	$sql = " update web_sites set clientActivated =  1 where id = {$_POST['id']} ";
				             	 	$success = mysql_query($sql);

				             	 	if ($success){
				             	 		$clientActivated = 1;
				             	 	}
				             	 }

				             	 if (!($clientActivated)){
					             	 echo("
					                	<form id = 'activateFrm' action='{$_SERVER['SCRIPT_NAME']}?{$_SERVER['QUERY_STRING']}' method='POST'>
					                		<input type='hidden' id='id' name='id' value='{$row['id']}' size='5'>
					                		<input type='hidden' id='username' name='username' value='{$username}' size='5'>
					                		<input type='hidden' id='password' name='password' value='{$password}' size='5'>
					                		<input type = 'submit' id = 'activate' name = 'activate' value = 'Activate' >
					                	</form>
					                ");
				             	 }

							echo("
				                </td>

				                <td>{$row['isActive']}</td>

				             </tr>");
				             $i++;
				         }
				   }
				}

				echo("</table>");
				mysql_close($link);
				//require 'banners.php';
			?>


		</div>
	</div>
  </section>
<!--==============================footer=================================-->


	<?php

		require 'footer.php';

	?>

</body>
</html>
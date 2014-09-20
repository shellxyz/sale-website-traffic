<?php 
	session_start(); if ($_SESSION['admin'] != 1) {echo ('Unauthorized Access'); exit;} 
	include('functions_admin.php');
	$link = db_connect();	
?>
<!doctype html> 
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit traffic clients</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="../commonfiles/css/style.css" />
    <script type='text/javascript' src='../commonfiles/js/datePicker.js'></script>
</head>
<body>
<div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
	include 'leftMenu.php';
?> 
</div>
<div style='width:1080px;position:absolute;left:200px;top:0px;'>
<br/>
<br/>

<?php

	$clientId = $_POST['clientId'];	
	$clientIds = explode(":",$clientId);	
	$clientId = $clientIds[0];
	$email = $clientIds[1]; 
	
	
	
?>


<div>
	<form method = 'POST' action = "clientHome.php" id = 'rows_offset' name = 'rows_offset' >
	   <table border='0' width='80%' align='center'>
			<tr>
				<td colspan='5'>
					<strong>Email:</strong> 
						<select id='clientId' name='clientId' onchange = "rows_offset.submit()">	
								<option value=''>Select client</option>		    			
								<?php echo get_client_emails(); ?>
						</select>
						<?php
							echo '<br/><br/><strong>'.$email.'</strong><br/>';
						 ?>
				</td>
			</tr>
		</table>
	</form>
</div>


<?php
// we connect to example.com and port 3307


$truncateDate = date("Y-m-d",mktime(0, 0, 0, date("m"),date("d")-10,date("Y")));
$sql = " (SELECT * FROM web_sites  where clientid = '$clientId' order by dateBought desc, remaining desc)";
//echo $sql;

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


?>
</div>


<div>
<span id='clientHomeTxt'><strong>Please login to access your home page:</strong></span><br/>
<form action='clientHome.php' method='post' id='clientHome'>
    User Name: <input type='text' id='username' name='password'> <br/>
	Password: <input type='password' id='password' name='password'> <br/>
	<input type='submit' id='submit' name='submit' value='Login'> <br/>
</form>

<?php

    $username = $_POST['username'];
	$password = $_POST['password'];

	$link = mysql_connect('localhost', 'visitor_traffic', 'UEpmKvAqB=^)');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}

	if (!(mysql_select_db("visitor_traffic-database"))) {
	    echo "Unable to select mydbname: " . mysql_error();
	    exit;
	}

	$sql = " select id from clients where email = '$username' and password = '$password' ";
	$result = mysql_query($sql);

	if (!($result)) {echo ('error'); exit;}

	if (mysql_num_rows($result) <= 0){
		echo ('Login Failure');
		exit;
	}

?>
</div>


<script>
	document.getElementById('frmLogin').style.display = 'none';
	document.getElementById('spnLoginText').style.display = 'none';
</script>

<?php
// we connect to example.com and port 3307


$truncateDate = date("Y-m-d",mktime(0, 0, 0, date("m"),date("d")-10,date("Y")));
$clientId = $_GET['clientId'];
$sql = " (SELECT * FROM web_sites  where clientid = '$clientId' order by dateBought desc, remaining desc)";
//$sql1 = " SELECT * FROM web_sites  where ((dateBought >= '$truncateDate') ) and clientid = '$clientId' order by country desc";
//echo $sql;
$result = mysql_query($sql);

 echo ("<table border='1' width='80%' align='center'>");
         echo("<tr><td colspan='9'><strong><span style='color:red'>Your Traffic Statistics</span></strong></td></tr>");
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

             </tr>");
             $i++;
         }




   }
}

echo("</table>");
mysql_close($link);


?>

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

$truncateDate = date("Y-m-d",mktime(0, 0, 0, date("m"),date("d")-60,date("Y")));
$sql = " SELECT * FROM web_sites  where ( (dateBought >= '$truncateDate') and (url not like '%justetc%'))  order by remaining desc, country desc";
//$sql1 = " SELECT * FROM web_sites  where ((dateBought >= '$truncateDate') ) order by country desc";
//echo $sql;
$result = mysql_query($sql);

 echo ("<table border='1' width='80%' align='center'>");
         echo("<tr><td colspan='9'><strong><span style='color:red'>Traffic Statistics for Some Recent Clients </span></strong></td></tr>");
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

$remainingSum = 0;
$usSum = 0;
$cdnSum = 0;
$globalSum = 0;
$totalSum = 0;

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
             	<td><a href='$url' target='new'>".$url."</a></td>
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



/*$result = mysql_query($sql1);
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



             $delivered = $row['allocatedVisits'] - $row['remaining'];

             echo("<tr>
             	<td>{$clientId}</td>
             	<td>".$url."</td>
             	<td>{$row['visitsBought']}</td>
             	<td><strong>{$bonusText}</strong></td>
             	<td>{$row['allocatedVisits']}</td>
             	<td>{$row['remaining']}</td>
             	<td>{$delivered}</td>
             	<td>".substr($row['country'],0,1). "</td>
             	<td>{$row['dateBought']}</td>

             </tr>");
             $i++;
         }
   }
}*/

echo("</table>");
mysql_close($link);


?>

<div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
	include 'leftMenu.php';
?>
</div>
<div style='width:1080px;position:absolute;left:160px;top:0px;'>
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
//grab data
$fields = array();
$email = 'traffic_support@onlineservicescloud.com';
foreach ($_POST as $key=>$value){
	$fields[$key] = $value;
}
$countArrElements = count($fields);
if ($countArrElements>0){
	$email = $fields['email'];
	unset($fields['edit']);
	unset($fields['delivered']);
	unset($fields['email']);
	$updateStr = " update web_sites set ";
	$updateStrBase = '';
	foreach($fields as $key=>$value){
		$updateStrBase .= "$key='$value', ";
	}
	$updateStr .= substr($updateStrBase,0,strlen($updateStrBase)-2);
	$updateStr .= " where id='{$fields['id']}'";
	//echo $updateStr;
	$resultEdit = mysql_query($updateStr);
		if ($resultEdit){
			echo ("Update Successfull <br/>");

		$country = $fields['country'];

		$statusText = "Remaining Credit: ".$fields['remaining']."\n".'Is Active: '.$fields['isActive']."\n".'Target Country:'.$country;//str_replace(',','\n',$updateStrBase);//implode("\n", $fields);
		$emailText = "Dear Customer,\n\nYour campaign with us has been changed. The associated URL is {$fields['url']}. The campaign may be updated for the following reasons\n\n1. To provide you bonus credits\n2. Upgrade the priority to boost traffic\n3. Activate/Deactivate the campaign\n4. For Maintenance\n\nPlease check your campaign status at: http://www.VisitorsShop.com/clientHome.php?clientId={$fields['clientId']}. \n\nYour current campaign status is as below\n\n$statusText\n\nIf you have any concerns please contact us at traffic_support@onlineservicescloud.com";
		//echo $emailText;

		// To send HTML mail, the Content-type header must be set
		//$headers  = 'MIME-Version: 1.0' . "\r\n";
		//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers = 'To: $email ' . "\r\n";
		$headers = 'From: Online Services Cloud - Traffic System <traffic_support@onlineservicescloud.com>' . "\r\n";

		$send = mail('traffic_support@onlineservicescloud.com', 'Your Campaign is Updated', $emailText, $headers);
		$send = mail($email, 'Your Campaign is Updated', $emailText, $headers);
		if ($send){
			echo ("Email sent successfully<br/>");
		}
	}
}
//edit database

$truncateDate = date("Y-m-d",mktime(0, 0, 0, date("m"),date("d")-10,date("Y")));
$sql = " SELECT web_sites.*, clients.email FROM web_sites  inner join clients on web_sites.clientId = clients.id order by remaining desc, dateBought desc, country desc  limit 30 ";
//$sql1 = " SELECT * FROM web_sites  where ((dateBought >= '$truncateDate') ) order by country desc";
//echo $sql;
$result = mysql_query($sql);
?>

<?php
echo ("<table border='1' width='80%' align='center' cellspacing='0' cellpadding='0'>");
         echo("<tr><td colspan='14'><strong><span style='color:red'>Traffic Statistics for Some Recent Clients </span></strong></td></tr>");
         echo("<tr>
             	<td><strong>Url Id<strong></td>
         		<td><strong>Client<strong></td>
         		<td><strong>Email<strong></td>
             	<td><strong>URL<strong></td>
             	<td><strong>Visits Bought<strong></td>
             	<td><strong>Is Bonus<strong></td>
             	<td><strong>Visits Allocated<strong></td>
             	<td><strong>Remaining<strong></td>
             	<td><strong>Delivered<strong></td>
             	<td><strong>C<strong></td>
             	<td><strong>Is Active<strong></td>
             	<td><strong>Priority<strong></td>
             	<td><strong>Date Added<strong></td>
             	<td><strong>Submit<strong></td>
             </tr>");

if ($result){

   $num_rows  = mysql_num_rows($result);
   if ($num_rows > 0){
         $i = 0;
         while ($i < $num_rows){
             $row = mysql_fetch_assoc($result);
             $clientIdO=$row['clientId'];
             $clientId = $clientIdO + 2000;
             $isBonus = $row['isBonus'];

             /*
             switch($isBonus){
             	case 1: $bonusText = "Bonus";
             		    break;
             	default: $bonusText = "";
             			 break;
             }
             */

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
             	<td>
             		<form id='editWebSites$clientIdO' name='editWebSites$clientIdO' action='edit.php' method='POST'>
             		<input type='text' id='id' name='id' value='{$row['id']}' size='5' readonly='true'>
             	</td>
             	<td>
             		<input type='text' id='clientId' name='clientId' value='{$clientIdO}' size='5' readonly='true'>
             	</td>

             	<td>
             		<input type='text' id='email' name='email' value='{$row['email']}' size='30'>
             	</td>

             	<td><input type='text' id='url' name='url' value='$url' size='60'></td>
             	<td><input type='text' id='visitsBought' name='visitsBought' value='{$row['visitsBought']}' size='10'></td>
             	<td><input type='text' id='isBonus' name='isBonus' value='{$isBonus}' size='10'></strong></td>
             	<td><input type='text' id='allocatedVisits' name='allocatedVisits' value='{$row['allocatedVisits']}' size='10'></td>
             	<td><input type='text' id='remaining' name='remaining' value='{$row['remaining']}' size='10'></td>
             	<td><input type='text' id='delivered' name='delivered' value='{$delivered}' size='10' readonly='true'></td>
             	<td><input type='text' id='country' name='country' value='{$row['country']}' size='10'></td>
             	<td><input type='text' id='isActive' name='isActive' value='{$row['isActive']}' size='10'></td>
             	<td><input type='text' id='priority' name='priority' value='{$row['priority']}' size='10'></td>
             	<td><input type='text' id='dateBought' name='dateBought' value='{$row['dateBought']}' size='10'></td>
                <td>
                	<input type='submit' id='edit' name='edit' value='Submit'>
                	</form>
                </td>
             </tr>");

             $i++;
         }
   }
}
echo("</table>");

mysql_close($link);


?>
</div>

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
<div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
	include 'leftMenu.php';

	$row_count = isset($_POST['row_count'])?$_POST['row_count']:30;
	$offset = isset($_POST['offset'])?$_POST['offset']:0;
	$country = ( isset($_POST['country']) && ($_POST['country'] != ''))?$_POST['country']:0;


	$country_search = '';


	if ($country=='0'){
		$country_search = 'country is not null';
	}else{
		$country_search = "country = '$country' ";
	}

	$clientId = $_POST['clientId'];
	$clientIds = split(":",$clientId);
	$clientId = $clientIds[0];
	$email = $clientIds[1];

	$client_select = '';
	if ($clientId){
		$client_select = " and clientId = '$clientId' ";
	}

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
	unset($fields['dateBought_d']);

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



		require 'oursites.php';

		$disclaimer = "Disclaimer: We do not guarantee sales, sign ups, and clicks, as your site must sell itself and we can only send quality visitors	to your site. Though we try to send visitors from different unique IPs, there is no guarantee that it will be 100% unique. We used the term Unique to indicate that we will show your web-sites to many unique visitors/computers (we will try to scatter the traffic as much as possible and maintain 24 hour unique - but no guarantee). Mostly the visitors will be from many unique IPs (may or may not be all) in 24 hour period. We do not guarantee any percentage of uniqueness. Regarding traffic statistics: http://www.VisitorsShop.com/ is the only acceptable statistics. we know what we are doing. We keep track of the traffic on our own. Whenever we send a visitor (it can be a previous IP) to your site - if we can load your site, we deduct 1 visit. Third party counters may not be able to count all visits; hence, we do not accept their statistics. Visitors many times may close the window even before the tracking code is loaded. If the 3rd party tracking is done through JavaScript, tracking may not work if JavaScript is disabled at the visitors' Computers. Your web-site will be displayed in our queue. Please advise if you do not want to display";


		$statusText = "Remaining Credit: ".$fields['remaining']."\n".'Is Active: '.$fields['isActive']."\n".'Target Country:'.$country;//str_replace(',','\n',$updateStrBase);//implode("\n", $fields);
		$emailText = "Dear Customer,\n\nYour campaign with us has been changed. The associated URL is {$fields['url']}. The campaign may be updated for the following reasons\n\n1. To provide you bonus credits\n2. Upgrade the priority to boost traffic\n3. Activate/Deactivate the campaign\n4. For Maintenance\n\nPlease check your campaign status at: http://www.VisitorsShop.com/clientHome.php?clientId={$fields['clientId']}. \n\nYour current campaign status is as below\n\n$statusText\n\nIf you have any concerns please contact us at traffic_support@onlineservicescloud.com\nRegards,\n$ourSites\n\n\n$disclaimer";
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
$sql = " SELECT web_sites.*, clients.email FROM web_sites  inner join clients on web_sites.clientId = clients.id
		where  (url like '%justEtc%' or isJustEtc='1')
		order by remaining desc, dateBought desc, country desc
		limit 100";



//$sql1 = " SELECT * FROM web_sites  where ((dateBought >= '$truncateDate') ) order by country desc";
//echo $sql;
$result = mysql_query($sql);
?>

<?php
echo ("<table border='0' width='80%' align='center' cellspacing='2' cellpadding='0'>");
         echo("<tr><td colspan='21'><strong><span style='color:red'>Traffic Statistics for our own sites </span></strong>");
         echo "<br/><br/><strong>".date("Y-m-d H:i:s A")."</strong>
         </td></tr>
         ";
         echo("
         	<tr>
         		<td colspan='21'>
         			<br/>
         			<strong> CL = Client, V = Validate,	Bot = Bought 	B = Is Bonus	C = Country A = Is Active,	CA = Client Activated, 	P = Priority,	S = Submit, 	E = Email Client, 	D = Deleted </strong>
         			<br/><br/>
         		</td>
         	</tr>
         ");

         echo("<tr>
             	<td><strong>ID<strong></td>
         		<td><strong>CL<strong></td>
         		<td><strong>Email<strong></td>
             	<td><strong>URL<strong></td>
             	<td><strong>V<strong></td>
             	<td><strong>Bot<strong></td>
             	<td><strong>B<strong></td>
             	<td><strong>Alloc<strong></td>
             	<td><strong>Remain<strong></td>
             	<td><strong>Sent<strong></td>
             	<td><strong>C<strong></td>
             	<td><strong>A<strong></td>
             	<td><strong>C<strong></td>
             	<td><strong>P<strong></td>
             	<td><strong>Cap<strong></td>
             	<td><strong>Today<strong></td>
             	<td><strong>F<strong></td>
             	<td><strong>Added<strong></td>
             	<td><strong>T<strong></td>
             	<td><strong>S<strong></td>
             	<td><strong>E<strong></td>
             	<td><strong>D<strong></td>
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
             $bought_d = substr($row['dateBought'],5);


             echo("
             	<tr valign='top'>
	             	<td>
	             		<form id='editWebSites$clientIdO' name='editWebSites$clientIdO' action='editClient.php' method='POST'>
	             		<input type='text' id='id' name='id' value='{$row['id']}' size='1' readonly='true'>
	             	</td>
	             	<td>
	             		<input type='text' id='clientId' name='clientId' value='{$clientIdO}' size='1' readonly='true'>
	             	</td>

	             	<td>
	             		<input type='text' id='email' name='email' value='{$row['email']}' size='20'>
	             	</td>
	             	<td><input type='text' id='url' name='url' value='$url' size='30'></td>
	             	<td><input type='button' id='validate' name='validate' onclick = \"validate_url('".$url."')\" value = 'V' ></td>
	             	<td><input type='text' id='visitsBought' name='visitsBought' value='{$row['visitsBought']}' size='5'></td>
	             	<td><input type='text' id='isBonus' name='isBonus' value='{$isBonus}' size='1'></strong></td>
	             	<td><input type='text' id='allocatedVisits' name='allocatedVisits' value='{$row['allocatedVisits']}' size='5'></td>
	             	<td><input type='text' id='remaining' name='remaining' value='{$row['remaining']}' size='5'></td>
	             	<td><input type='text' id='delivered' name='delivered' value='{$delivered}' size='5' readonly='true'></td>
	             	<td><input type='text' id='country' name='country' value='{$row['country']}' size='3'></td>
	             	<td><input type='text' id='isActive' name='isActive' value='{$row['isActive']}' size='1'></td>
	             	<td><input type='text' id='clientActivated' name='clientActivated' value='{$row['clientActivated']}' size='1'></td>
	             	<td><input type='text' id='priority' name='priority' value='{$row['priority']}' size='1'></td>
	             	<td><input type='text' id='daily_cap' name='daily_cap' value='{$row['daily_cap']}' size='1'></td>
	             	<td><input type='text' id='delivered_today' name='delivered_today' value='{$row['delivered_today']}' size='5'></td>
	             	<td><input type='text' id='is_freezed' name='is_freezed' value='{$row['is_freezed']}' size='1'></td>

	             	<td>
	             		<input type='text' id='dateBought_d' name='dateBought_d' value='$bought_d' size='5'>
	             		<input type='hidden' id='dateBought' name='dateBought' value='{$row['dateBought']}' size='5'>
	             	</td>
	             	<td>

	             		<input type='text' id='date_today' name='date_today' value='{$row['date_today']}' size='5'>
	             	</td>

	                <td>
	                	<input type='submit' id='edit' name='edit' value='S'>
	                	</form>
	                </td>

	                <td>
	                	<form action='emailClient.php' method='POST'>
	                		<input type='hidden' id='id' name='id' value='{$row['id']}' size='5' readonly='true'>
	                		<input type='hidden' id='clientId' name='clientId' value='{$clientIdO}' size='5' readonly='true'>
	                		<input type='hidden' id='email' name='email' value='{$row['email']}' size='30'>
	                		<input type='hidden' id='url' name='url' value='$url' size='60'>
	                		<input type='hidden' id='visitsBought' name='visitsBought' value='{$row['visitsBought']}' size='10'>
			             	<input type='hidden' id='isBonus' name='isBonus' value='{$isBonus}' size='10'></strong>
			             	<input type='hidden' id='allocatedVisits' name='allocatedVisits' value='{$row['allocatedVisits']}' size='10'>
			             	<input type='hidden' id='remaining' name='remaining' value='{$row['remaining']}' size='10'>
			             	<input type='hidden' id='delivered' name='delivered' value='{$delivered}' size='10' readonly='true'>
			             	<input type='hidden' id='country' name='country' value='{$row['country']}' size='10'>
			             	<input type='hidden' id='isActive' name='isActive' value='{$row['isActive']}' size='10'>
			             	<input type='hidden' id='clientActivated' name='clientActivated' value='{$row['clientActivated']}' size='10'>
			             	<input type='hidden' id='priority' name='priority' value='{$row['priority']}' size='10'>
			             	<input type='hidden' id='dateBought' name='dateBought' value='{$row['dateBought']}' size='10'>
	                		<input type='submit' id='edit' name='edit' value='E'>
	                	</form>
	                </td>

	                 <td>
	                	<form action='delete_web_site.php' method='POST'>
	                		<input type='hidden' id='id' name='id' value='{$row['id']}' size='5' readonly='true'>
	                		<input type='hidden' id='clientId' name='clientId' value='{$clientIdO}' size='5' readonly='true'>
	                		<input type='hidden' id='email' name='email' value='{$row['email']}' size='30'>
	                		<input type='hidden' id='url' name='url' value='$url' size='60'>
	                		<input type='hidden' id='visitsBought' name='visitsBought' value='{$row['visitsBought']}' size='10'>
			             	<input type='hidden' id='isBonus' name='isBonus' value='{$isBonus}' size='10'></strong>
			             	<input type='hidden' id='allocatedVisits' name='allocatedVisits' value='{$row['allocatedVisits']}' size='10'>
			             	<input type='hidden' id='remaining' name='remaining' value='{$row['remaining']}' size='10'>
			             	<input type='hidden' id='delivered' name='delivered' value='{$delivered}' size='10' readonly='true'>
			             	<input type='hidden' id='country' name='country' value='{$row['country']}' size='10'>
			             	<input type='hidden' id='isActive' name='isActive' value='{$row['isActive']}' size='10'>
			             	<input type='hidden' id='clientActivated' name='clientActivated' value='{$row['clientActivated']}' size='10'>
			             	<input type='hidden' id='priority' name='priority' value='{$row['priority']}' size='10'>
			             	<input type='hidden' id='dateBought' name='dateBought' value='{$row['dateBought']}' size='10'>
	                		<input type='submit' id='edit' name='edit' value='D'>

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

<script>
 function validate_url(url){
 	window.open('indexTrafficSample.php?url='+url,'','');
 }
</script>

</div>

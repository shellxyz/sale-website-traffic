<?php session_start(); if ($_SESSION['admin'] != 1) {echo ('Unauthorized Access'); exit;} ?>
<div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
	include 'leftMenu.php';
?>
</div>
<div style='width:1080px;position:absolute;left:160px;top:0px;'>
<br/>
<br/>

<?php

	if (isset($_POST['edit'])){

		$web_site_id = $_POST['id'];
		$url =  $_POST['url'];
		$email = $_POST['email'];
		$clientId = $_POST['clientId'];
		$headers = 'To: $email ' . "\r\n";
		$headers = 'From: Online Services Cloud - Traffic System <traffic_support@onlineservicescloud.com>' . "\r\n";

		$body = "Dear Customer,\n\n";
		$body .= " Your website $url has been deleted. Our record indicate that you have mistakenly added this site or you have created multiple instances of the same site, or you did not pay for the traffic. Please contact us with any of your concerns. ";

		require 'oursites.php';

		$success_delete = delete_web_site($web_site_id);

		if ($success_delete){
			echo 'Deletion Successful'.'<br/>';
			$body .= "\n\nPlease check http://www.VisitorsShop.com/clientHome.php?clientId=$clientId for all of your campaign status.\n\nWe are always here to listen to you and help you out with any of your concerns. Contact our customer support at traffic_support@onlineservicescloud.com with any of your concerns at any time. We will be more than happy to assist you.\n\nRegards,\n$ourSites \n\n\n$disclaimer" ;

			$send = mail('traffic_support@onlineservicescloud.com', 'Regarding your campaigns with us', $body, $headers);
	        $send = mail($email,'Regarding your campaigns with us',$body, $headers);

	        if ($send){
	        	echo ('Email sent successfully');
	        }
		}else{
			echo 'Deletion Unsuccessful';
		}
	}

?>



<?php

	function delete_web_site($web_site_id){

		// we connect to example.com and port 3307
		$link = mysql_connect('localhost', 'visitor_traffic', 'UEpmKvAqB=^)');
		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		}

		if (!mysql_select_db("visitor_traffic-database")) {
		    echo "Unable to select mydbname: " . mysql_error();
		    exit;
		}

		$sql = " delete from web_sites where id = $web_site_id " ;
		//echo $sql;


		$result = mysql_query($sql);

		if ($result && (mysql_affected_rows() > 0)) {
			return 1;
		}



		mysql_close($link);

		return 0;

	}


?>
</div>

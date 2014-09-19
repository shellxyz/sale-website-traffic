<?php
	$dbs = array('justedu6_clienttraffic','eof');
	$link = mysql_connect('ip-to-remote-db', 'db-user-traffic', 'traffic-user-password');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	if (!mysql_select_db("traffic-database")) {
	    echo "Unable to select mydbname: " . mysql_error();
	    exit;
	}
	$count = 0;
	$subject = "New Product: 1000 Global Visitors - $1.20";
	$msg = "Dear Customer, we have added a new product in the Internet Traffic Category. Now, you can buy 1000 global visitors only for $1.20. Check at: http://cgi.ebay.com/1000-Global-Visitors-Website-Traffic-Unique-Hits-/170627541339?pt=LH_DefaultDomain_0&hash=item27ba31a95b \n ";
	while ($dbs[$count] != 'eof'){
		$d = mysql_select_db($dbs[$count],$link);
		$query = "select distinct(email) from clients where id ='11' ";
		$result = mysql_query($query);

		if ($result == false)

			die('Error');

		$num_rows = 0;
		$num_rows = mysql_num_rows($result);
		if ($num_rows > 0 )
		{
			$countEmail = 0;
			while($countEmail < $num_rows)
			{
				$email = mysql_result($result,$countEmail,"email");
				echo($email. 'Success <br><br>');


				mail($email,$subject,$msg);
				$countEmail = $countEmail + 1;
			}
		}
		$count = $count + 1;
	}
?>

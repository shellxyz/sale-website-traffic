<?php session_start(); if ($_SESSION['admin'] != 1) {echo ('Unauthorized Access'); exit;} ?>
<br/><br/>
<ul>
	<li> <a href='/index.php'>Home</a>
	<li> <a href='index.php'>Admin Home</a>
 	<li> <a href='addClient.php'>Add Client</a>
 	<li> <a href='addWebsites.php'>Add Web-sites</a>
 	<li> <a href='editClient.php'>Edit Client</a>
 	<li> <a href='remainingTraffic.php'>Traffic to Deliver</a>
 	<li> <a href='adminTrafficStatistics.php'>Traffic Reports</a>
 	<li> <a href='allClients.php'>All Clients</a>
 	<li> <a href='campaigns.php'>Campaigns</a>
 	<li> <a href='editJustEtc.php'>Edit Our Sites</a> 
        <li> <a href='index.php?logout=1'>Logout</a> 
 </ul> 
 
 <p><strong>Client Administration</strong></p>
 <ul> 	
    <li> <a href='clientHome.php'>Client Home</a>
 	<li> <a href='client_add_web_sites.php'>Add Web-sites</a>
 </ul>
 

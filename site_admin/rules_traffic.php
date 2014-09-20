<?php session_start(); if ($_SESSION['admin'] != 1) {echo ('Unauthorized Access'); exit;} ?>
http://mall.onlineservicescloud.com/indexCountry.php: Supposed to be very country specific [one country]
http://onlineservicescloud.com/ebay/indexRotateUsa.php : Priority based, If USA client, else 
http://onlineservicescloud.com/ebay/onlyUsa.php: Only USA
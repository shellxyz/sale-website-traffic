<center>
<?php
$adbrite=1;
// we connect to example.com and port 3307
$link = mysql_connect('localhost', 'db-user-traffic', 'traffic-user-password');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}


if (!mysql_select_db("traffic-database")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

$sql = ' SELECT * FROM web_sites where remaining  > 0 and isActive > 0 and isJustEtc > 0 order by remaining  desc limit 1 ';
$result = mysql_query($sql);

if ($result){
   $num_rows  = mysql_num_rows($result);
   if ($num_rows > 0){
?>

<iframe src='indexBase.php' width='90%' height='600' >
</iframe>

<br/><span ><strong><a href='http://addserver.onlineservicescloud.com?fromTraffic=1'>Buy Traffic from us, Buy Website Visitors from us</a><strong></span><br/>

<?php
         $i = 0;
         while ($i < $num_rows){
             $row = mysql_fetch_assoc($result);
             $i++;
             echo ("<iframe src='".$row['url']."'  width='90%' height='2000' ></iframe>");
             $sqlUpdate = "update web_sites set remaining = remaining - 1 where id = {$row[id]}";
             $deduct = mysql_query($sqlUpdate);



         }
   }
   else{

   	echo("
   		<script>
   		  window.location.href='http://www.VisitorsShop.com';
   		</script>
   		"

   	);


   }
}

mysql_close($link);


?>
</center>

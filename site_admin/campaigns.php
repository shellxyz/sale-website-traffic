<?php session_start(); if ($_SESSION['admin'] != 1) {echo ('Unauthorized Access'); exit;} ?>
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

	$cwd = getcwd();
	$d = dir("../campaigns/");
	
	echo ("
		<div>
			<table align='center'>

					<tr>

				"
		);
		$i=0;
		while (false !== ($entry = $d->read()))
		{
		   
		   switch($entry){
			case ".":
			case "..":
			case "./":
			case "../":
			case "error_log":
			case "index.php":
			case "style.css":
			case "rightMenu.php":
			case "titleback.gif":
			case "functions.php":
			case "unfreeze.php":
			case "campaign_logic.php":
			case "onlyUsaDailyCapTest.php":
			case "onlyUsaOriginal.php":
				$entry='';
				continue;
				break;
		   }

		   echo("<td>");
		   echo "<h3><a href='../campaigns/".$entry."' target = 'new' >".$entry."</a></h3>";
		   echo("</td>");


		   if (fmod($i+1,1)==0)
			echo ("</tr><tr>");

		   $i++;
		}
		$d->close();
	echo ("</tr></table></div>");

?>
	
	
</div>

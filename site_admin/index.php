<?php
    session_start();
    if (  isset($_REQUEST['logout']) && (1==$_REQUEST['logout'])  ){
        $_SESSION['admin'] = '';
        session_destroy();
        header('Location:http://www.visitorsshop.com');
    }
?>
<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Administration Home</title>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="../commonfiles/css/style.css" />
        <script type='text/javascript' src='../commonfiles/js/datePicker.js'></script>
    </head>

    <body>
        <div>
            <span id='spnLoginText'><strong>Please login to access administration area:</strong></span><br/>
            <form action='index.php' method='post' id='frmLogin'>
                Password: <input type='password' id='password' name='password'> <br/>
                <input type='submit' id='submit' name='submit' value='Login'> <br/>
            </form>

            <?php
            if ($_SESSION['admin'] != '1') {
                $password = $_POST['password'];
                $sql = $_POST['sql'];

                if ((!$password)) {
                    exit;
                }

                if ($password != 'admin-user-password') {
                    exit;
                }

                $_SESSION['admin'] = 1;
            }
            ?>
        </div>


        <script>
            document.getElementById('frmLogin').style.display = 'none';
            document.getElementById('spnLoginText').style.display = 'none';
        </script>

        <div style='width:160px;position:absolute;left:0px;top:0px;'>
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

            $truncateDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 120, date("Y")));
            $sql = " (SELECT * FROM web_sites  where ((remaining > 0 and dateBought >= '$truncateDate') and (isJustEtc = 0) ) order by country desc, remaining desc)";
            $sql1 = " SELECT * FROM web_sites  where ((dateBought >= '$truncateDate') and isJustEtc = 0) order by country desc, remaining desc";
//echo $sql;
            $result = mysql_query($sql);
            ?>


            <?php
            echo ("<table border='1' width='80%' align='center'>");
            echo("<tr><td colspan='9'><strong><span style='color:red'>Traffic Statistics for Some Recent Clients </span></strong></td></tr>");
            echo("<tr>
             	<td><strong>Client<strong></td>
             	<td><strong>A<strong></td>
             	<td><strong>URL<strong></td>
             	<td><strong>Visits Bought<strong></td>
             	<td><strong>Is Bonus<strong></td>
             	<td><strong>Visits Allocated<strong></td>
             	<td><strong>Remaining<strong></td>
             	<td><strong>Delivered<strong></td>
             	<td><strong>C<strong></td>
             	<td><strong>Date Added<strong></td>
             </tr>");

            $remainingSum = 0;
            $usSum = 0;
            $cdnSum = 0;
            $globalSum = 0;
            $totalSum = 0;

            if ($result) {

                $num_rows = mysql_num_rows($result);
                if ($num_rows > 0) {
                    $i = 0;
                    while ($i < $num_rows) {
                        $row = mysql_fetch_assoc($result);
                        $clientId = $row['clientId'];
                        $clientId +=2000;
                        $isBonus = $row['isBonus'];
                        switch ($isBonus) {
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
             	<td>{$row['isActive']}</td>
             	<td><a href='$url' target='new'>" . $url . "</a></td>
             	<td>{$row['visitsBought']}</td>
             	<td><strong>{$bonusText}</strong></td>
             	<td>{$row['allocatedVisits']}</td>
             	<td>{$row['remaining']}</td>
             	<td>{$delivered}</td>
             	<td>" . substr($row['country'], 0, 1) . "</td>
             	<td>{$row['dateBought']}</td>
             </tr>");

                        $i++;
                    }
                }
            }



            $result = mysql_query($sql1);
            if ($result) {
                $num_rows = mysql_num_rows($result);
                if ($num_rows > 0) {
                    $i = 0;
                    while ($i < $num_rows) {
                        $row = mysql_fetch_assoc($result);
                        $clientId = $row['clientId'];
                        $clientId +=2000;
                        $isBonus = $row['isBonus'];
                        switch ($isBonus) {
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
             	<td>{$row['isActive']}</td>
             	<td>" . $url . "</td>
             	<td>{$row['visitsBought']}</td>
             	<td><strong>{$bonusText}</strong></td>
             	<td>{$row['allocatedVisits']}</td>
             	<td>{$row['remaining']}</td>
             	<td>{$delivered}</td>
             	<td>" . substr($row['country'], 0, 1) . "</td>
             	<td>{$row['dateBought']}</td>

             </tr>");
                        $i++;
                    }
                }
            }
            echo("
</table>
</div>
");
            mysql_close($link);
            ?>

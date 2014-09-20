<?php session_start(); if ($_SESSION['admin'] != 1) {echo ('Unauthorized Access'); exit;} ?>
<!doctype html> 
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Traffic statistics for the clients</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="../commonfiles/css/style.css" />
    <script type='text/javascript' src='../commonfiles/js/datePicker.js'></script>
    <script type='text/javascript' src='../commonfiles/js/jquery.tablesorter/jquery.tablesorter.js'></script>
    
	<script type='text/javascript'>
		$(document).ready(function() 
		    { 
		    	
		        $("#myTable").tablesorter();
		         
		    } 
		); 
	</script>
    
</head>
<body>
<?php 

	include('functions_admin.php');
	$link = db_connect();

?>
<div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
	include 'leftMenu.php';
?> 
</div>
<div style='width:1080px;position:absolute;left:200px;top:0px;'>
<br/>
<br/>
<p>Please select the date range for traffic statistics</p>
<form action='adminTrafficStatistics.php' method='POST'>
	<table width='100%' id='trafficStatistics'>
		<tr>
			<td>
				<table>
				<tr>
					<td>
					 	<label for="quickDates">Quick dates:</label>
						<select id='cmbQuickDates' name='cmbQuickDates'>
							<option value=''>Select</option>
							<option value='today'>Today</option>
							<option value='yesterday'>Yesterday</option>
							<option value='lastWeek'>Last week</option>
							<option value='thisMonth'>This month</option>
							<option value='lastMonth'>Last month</option>
							<option value='allTime'>All time</option>								
						</select>
					</td>
				</tr>
					
					<tr>
						<td align='center'>
							 	or
						</td>
					</tr>
					
					
					<tr>
						<td>
							 	<label for="from">From:</label>
								<input type="text" id="from" name="from" />
								<label for="to">to:</label>
								<input type="text" id="to" name="to" /> 
						</td>
					</tr>
					
					
					
					
					
					
					<tr>
						<td class="padding-top">
							<strong>Email:</strong> 
							<select id='clientId' name='clientId' onchange = "rows_offset.submit()">
						    	<option value=''>Select Client
						    	
									<?php
										$isSort = 1; 
										$clientId = '';
										echo get_client_emails($clientId, $isSort); 
									?>
							</select>
	
						</td>
					</tr>
					
					<tr>
						<td>
							
							<input type='checkbox' value='1' checked='checked'> Total 
							<input type='checkbox' value='1' checked='checked'> By everyday <br/>
	
						</td>
					</tr>
					
					<tr>
						<td>
							
							<input type='submit' value='Generate report'> 
							
	
						</td>
					</tr>
					
				</table>
			</td>
			
			<td>
			
			</td>
		</tr>
	</table>

	
	<br>
	
							 
</form>

	<div class='displayTrafficStatistics'>		
		<?php
		
			$dateFrom = "";
			$dateTo = "";
			
			if (   empty($_POST["cmbQuickDates"]) && empty($_POST['from'])  ){
				echo 'Please select a quick date or date range';
				exit();
			}
			
			if (  (!empty($_POST['from']) && empty($_POST['to']))){
				echo "Please select the to date";
				exit();
			}
			
			if (empty($_POST['clientId'])){
				echo 'Please select a client';
				exit();
			}
			
			$quickDates = $_POST["cmbQuickDates"];
			$dateFrom = $_POST['from'];
			//$dateFrom = str_replace("/","-",$dateFrom);
			
			$dateTo = $_POST['to'];
			//$dateTo = str_replace("/","-",$dateTo);
			
			if (!empty($quickDates)){
				
				if ($quickDates=="today"){
					$dateFrom = date("Y-m-d");
					$dateTo = date("Y-m-d", time() + 60 * 60 * 24);
				}else if ($quickDates=="yesterday"){
					$dateFrom = date("Y-m-d", time() - 60 * 60 * 24);
					$dateTo = date("Y-m-d");	
				}else if ($quickDates=="lastWeek"){
					$dateFrom = date("Y-m-d", time() - 7*60 * 60 * 24);
					$dateTo = date("Y-m-d");	
				}else if ($quickDates=="thisMonth"){
					$dateFrom = date("Y-m-1");
					$dateTo = date("Y-m-d",strtotime("+1 months"));
				}else if ($quickDates=="lastMonth"){
					$dateFrom = date("Y-m-d",strtotime("-1 months"));
					$dateTo = date("Y-m");
				}else if ($quickDates=="allTime"){
					$dateFrom = "all";
					$dateTo = "all";				
				}
				echo ("$dateFrom : $dateTo <br/> <br/>");	
							
			}
			
			if (empty($dateFrom) || empty($dateTo)  ){
				echo 'Please select a quick date or date range';
				exit();
			}
			
			$clientId = $_POST['clientId'];
			$client_id = split(":",$clientId);
			$client_id = $client_id[0];
			
			$dateFilter = "";
			if ($dateFrom != "all"){
				$dateFilter = " and ( dth.date >= '$dateFrom' and dth.date < '$dateTo') ";
			}			
			$sql = " select * from daily_traffic_history dth left join clients c on dth.client_id = c.id where dth.client_id = $client_id $dateFilter order by date desc";
			echo $sql;
			
			$result = mysql_query($sql);
			
			if (!$result) {
				
				echo "error";
				exit();
			}
			
			if (mysql_num_rows($result)==0){
				echo "no data";
				exit();
			}
			
			
			
			
			
		
		?>
		
		
		<table id="myTable" class="tablesorter" cellpadding='10' width='100%'> 
			<thead> 
				<tr class="headerBackground"> 
				    <th>Date</th> 
				    <th>Visitors Sent</th> 
				    <th>URL</th> 
				</tr> 
			</thead> 
			<tbody>
			
				<?php 
					$class = "oddRow";
					$i=1;
					while ($row = mysql_fetch_assoc($result)){
						
						$class = ($i%2 == 0)? "evenRow": "oddRow";
						$i++;
						
					
				?> 
					<tr class=<?= $class ?>> 
					    <td><?= $row['date'] ?></td> 
					    <td><?= $row['traffic_delivered'] ?></td> 
					    <td><?= $row['url'] ?></td>
					</tr>
				
				<?php
					}
				?>
			</tbody>
		</table>
			


			
			
	</div>

</div>


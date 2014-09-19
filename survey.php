<style>
	td{
		font-weight:bold;
	}
</style>

<div style='width:1024px;align:center'>
	<form action='surveyAction.php' id='frmSurvey' name='frmSurvey' method='POST'>
		<table>
			<tbody>
				<tr>
				<td colspan='2' style='font-size:20px;'>				
					Please take the survey and help us to improve our service				
				</td>
				</tr>				
			
				<tr>
					<td>
						<input type='hidden' id='clientId' name='clientId'  value=<?php echo$_GET['clientId']  ?>>
						<input type='hidden' id='websiteId' name='websiteId'  value=<?php echo$_GET['websiteId']  ?>>
					</td>
					<td>
						
					</td>
				</tr>
				
				
				<tr>
					<td>
						How satisfied are you with our overall service (rate between 1 to 10 where 1 = extremely dissatisfied, 10 = extremely satisfied)
					</td>
					<td>
						<input type='text' id='overallSatisfaction' name='overallSatisfaction' value='' size='5' />
					</td>
				</tr>
				
				<tr>
					<td>
						Are you satisfied with the price (Yes/No)?
					</td>
					<td>
						<input type = 'text' id='priceSatisfaction' name='priceSatisfaction' value='' size='5' />
					</td>
				</tr>
				
				<tr>
					<td>
						Is there anything that we could do better?
					</td>
					<td>
						<textarea id='toDo' name='toDo' cols='60' rows='5'></textarea>
					</td>
				</tr>

				<tr>
					<td>
						Are you willing to provide us a testimonial to be shown in our web-sites (Yes/No)?
					</td>
					<td>
						<input type = 'text' id='isTestimonial' name='isTestimonial' value='' size='5' />
					</td>
				</tr>

				<tr>
					<td>
						Your testimonial:
					</td>
					<td>
						<textarea id='testimonial' name='testimonial' cols='60' rows='5'></textarea>
					</td>
				</tr>


				<tr>
					<td>
						Are you willing to be a our Traffic Reseller
					</td>
					<td>
						<input type = 'text' id='isReseller' name='isReseller' value='' size='5' />
					</td>
				</tr>
				
				
				<tr>
					<td colspan='2'>
						<input type='submit' id='submit' name='submit' value='Submit Survey'>
					</td>
				</tr>

			</tbody>
		</table>
		
	</form>
</div>

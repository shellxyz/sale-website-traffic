<div>
	<table width='690' align='center'>
		<tr>
			<td align='center'>
				<iframe id='VisitorsShop.com.middle.left.336.280' class='ad_display_336' src='http://www.VisitorsShop.com/addelivery/addelivery.js.php?adHeight=280&adWidth=336&source=VisitorsShop.com.middle.left.336.280' style="border-style: none;width: 100%; height: 280px;" scrolling='no'>
				</iframe>
			</td>
			
			<td align='center'>
				<iframe id='VisitorsShop.com.middle.right.336.280' class='ad_display_336' src='http://www.VisitorsShop.com/addelivery/addelivery.js.php?adHeight=280&adWidth=336&source=VisitorsShop.com.middle.right.336.280' style="border-style: none;width: 100%; height: 280px;" scrolling='no'>
				</iframe>
			</td>
		</tr>
	</table>
</div>
	
	
<script type="text/javascript">
		
	var timer_is_on=0;	
	function timedCount(){
	
		var sponsor_left = document.getElementById('VisitorsShop.com.middle.left.336.280');
		var sponsor_right = document.getElementById('VisitorsShop.com.middle.right.336.280');
		var sponsor_left_menu = document.getElementById('VisitorsShop.com.left.160.600');
		
		
		
		if (sponsor_left){
			sponsor_left.src = 'http://www.VisitorsShop.com/addelivery/adserver/336_280.php';
		}
		
		if (sponsor_right){
			sponsor_right.src = 'http://www.VisitorsShop.com/addelivery/adserver/336_280.php';
		}
		
		if (sponsor_left){
			sponsor_left.src = 'http://www.VisitorsShop.com/addelivery/adserver/336_280.php';
		}
		
		if (sponsor_left_menu){
			sponsor_left_menu.src = 'http://www.VisitorsShop.com/addelivery/adserver/160_600.php';
		}
		
		
		setTimeout("timedCount()",30000);
	}
	
	function doTimer(){
		if (!timer_is_on){
	  		timer_is_on=1;
	  		timedCount();
	  	}
	}
	
	setTimeout("doTimer()",30000);
</script> 

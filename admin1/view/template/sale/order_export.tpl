<?php 
	$output='';
	 if ($orders) { 
		$output.='
		<table class="table" border0="1">
			<tr>
				<th>Order ID</th>
				<th>Customer</th>
				<th>Address</th>
				<th>Status</th>
				<th>Total</th>
				<th>Date Added</th>
				<th>Date Modified</th>
			</tr>
		';
		foreach ($orders as $order) {
			$output .='
				<tr>
					<td>'.$order["order_id"].'</td>
					<td>'.$order["customer"].'</td>
					<td>'.$order["address"].'</td>
					<td>'.$order["order_status"].'</td>
					<td>'.$order["total"].'</td>
					<td>'.$order["date_added"].'</td>
					<td>'.$order["date_modified"].'</td>
				</tr>
			
			
			';	
	 }
	 $output .='</table>';
	 header('Content-Type: application/xls');
	 header('Content-Disposition: attachment; filename=order_export.xls');
	 echo $output;
	 }	 
?>
		
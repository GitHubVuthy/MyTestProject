<?php 
	$output='';
	 if ($customers) { 
		$output.='
		<table class="table" border="1">
			<tr>
				<th>Customer Name</th>
				<th>Order Date </th>
				<th>Telephone</th>
				<th>Customer Group</th>
				<th>Status</th>
				<th>No. Order</th>
				<th>No. Product</th>
				<th>Total</th>
				
			</tr>
		';
		foreach ($customers as $customer) {
			$output .='
				<tr>
					<td>'.$customer["customer"].'</td>
					<td>'.$customer["date"].'</td>
					<td>'.$customer["telephone"].'</td>
					<td>'.$customer["customer_group"].'</td>
					<td>'.$customer["status"].'</td>
					<td>'.$customer["orders"].'</td>
					<td>'.$customer["products"].'</td>
					<td>'.$customer["total"].'</td>
					
				</tr>
			
			
			';	
	 }
	 $output .='</table>';
	 header('Content-Encoding: UTF-8');
	 header('Content-type: text/csv; charset=UTF-8');
	 header('Content-Type: application/xls');
	 header('Content-Disposition: attachment; filename=customer_order_export.xls');
	 echo $output;
	 }	 
?>
		<!-- foreach ($results as $result) {
			$data['customers'][] = array(
				'customer'       => $result['customer'],
				'telephone'       => $result['telephone'],
				
				'customer_group' => $result['customer_group'],
				'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'orders'         => $result['orders'],
				'products'       => $result['products'],
				'total'          => $this->currency->format($result['total'], $this->config->get('config_currency')),
				/*'edit'           => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, true)*/
			);
		} -->
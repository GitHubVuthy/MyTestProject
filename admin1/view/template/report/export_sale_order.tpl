<?php 
  $output='';
   if ($orders) { 
    $output.='
    <table class="table" border="1">
      <tr>
        <th>Date Start</th>
        <th>Date End</th>
        <th>NO. Orders</th>
        <th>No. Product</th>
        <th>Tax</th>
        <th>Total</th>
        
      </tr>
    ';
    foreach ($orders as $order) {
      $output .='
        <tr>
          <td>'.$order["date_start"].'</td>
           <td>'.$order["date_end"].'</td>
            <td>'.$order["orders"].'</td>
             <td>'.$order["products"].'</td>
              <td>'.$order["tax"].'</td>
               <td>'.$order["total"].'</td>
         
          
        </tr>
      
      
      ';  
   }
   $output .='</table>';
   header('Content-Encoding: UTF-8');
   header('Content-type: text/csv; charset=UTF-8');
   header('Content-Type: application/xls');
   header('Content-Disposition: attachment; filename=Export_Sales_order_export.xls');
   echo $output;
   }   
?>
   <!-- 
    foreach ($results as $result) {
      $data['orders'][] = array(
        'date_start' => date($this->language->get('date_format_short'), strtotime($result['date_start'])),
        'date_end'   => date($this->language->get('date_format_short'), strtotime($result['date_end'])),
        'orders'     => $result['orders'],
        'products'   => $result['products'],
        'tax'        => $this->currency->format($result['tax'], $this->config->get('config_currency')),
        'total'      => $this->currency->format($result['total'], $this->config->get('config_currency'))
      );
    }
 -->
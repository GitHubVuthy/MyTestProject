<?php 
  $output='';
   if ($products) { 
    $output.='
    <table class="table" border="1">
      <tr>
        <th>Product Name</th>
        <th>Model</th>
        <th>Quantity</th>
        <th>Total</th>
       
        
      </tr>
    ';
    foreach ($products as $product) {
      $output .='
        <tr>
          <td>'.$product["name"].'</td>
          <td>'.$product["model"].'</td>
          <td>'.$product["quantity"].'</td>
          <td>'.$product["total"].'</td>
         
          
        </tr>
      
      
      ';  
   }
   $output .='</table>';
   header('Content-Encoding: UTF-8');
   header('Content-type: text/csv; charset=UTF-8');
   header('Content-Type: application/xls');
   header('Content-Disposition: attachment; filename=Export_Product_Purchased.xls');
   echo $output;
   }   
?>
   <!-- 
    foreach ($results as $result) {
      $data['products'][] = array(
        'name'       => $result['name'],
        'model'      => $result['model'],
        'quantity'   => $result['quantity'],
        'total'      => $this->currency->format($result['total'], $this->config->get('config_currency'))
      );
    }
 -->
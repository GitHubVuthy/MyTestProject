<?php 
  $output='';
   if ($customers) { 
    $output.='
    <table class="table" border="1">
      <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Customer Group</th>
        <th>Telephone</th>
        <th>Address</th>
        <th>Date Added</th>
        
      </tr>
    ';
    foreach ($customers as $customer) {
      $output .='
        <tr>
          <td>'.$customer["customer_id"].'</td>
          <td>'.$customer["name"].'</td>
          <td>'.$customer["customer_group"].'</td>
          <td>'.$customer["telephone"].'</td>          
          <td>'.$customer["address"].'</td>
          <td>'.$customer["date_added"].'</td>
         
        </tr>
    
      ';  
   }
   $output .='</table>';
   header('Content-Type: application/xls');
   header('Content-Disposition: attachment; filename=customer_export.xls');
   echo $output;
   }   
?>

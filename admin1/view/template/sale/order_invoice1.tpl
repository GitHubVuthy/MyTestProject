<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<link href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="all" />

</head>
<body>
<div class="container" style="width:320px">

  <?php foreach ($orders as $order) { ?>
  <div style="page-break-after: always;">
  <table class="table">
    <tr>
      <td style="width: 50%;"><img src="view/image/white-garlic.jpg" style="width:100px"></td>
      <td style="width: 50%;" >
            <address>
            <strong><?php echo $order['store_name']; ?></strong><br />
            <?php echo $order['store_address']; ?>
            </address>
            <b><?php echo $text_telephone; ?></b> <?php echo $order['store_telephone']; ?><br />
            
       </td>     
    </tr>
    
      <tbody>
        <tr>
          
          <td style="width: 100%;"><b><?php echo $text_date_added; ?></b> <?php echo $order['date_added']; ?><br />
            <?php if ($order['invoice_no']) { ?>
            <b><?php echo $text_invoice_no; ?></b> <?php echo $order['invoice_no']; ?><br />
            <?php } ?>
            <b><?php echo $text_order_id; ?></b> <?php echo $order['order_id']; ?><br />
            <?php if ($order['shipping_method']) { ?>
            <b><?php echo $text_shipping_method; ?></b> <?php echo $order['shipping_method']; ?><br />
            <?php } ?></td>
        </tr>
      </tbody>
    </table>
    
    <table class="table table-hover">
      <thead>
        <tr class="info">
          <td><b>No</b></td>
          <td><b>Food Products</b></td>
          <td class="text-right"><b>Qty</b></td>
          <td class="text-right"><b><?php echo $column_price; ?></b></td>
          <td class="text-right"><b><?php echo $column_total; ?></b></td>
        </tr>
      </thead>
      <tbody>
      <?php $index=1?>
        <?php foreach ($order['product'] as $product) { ?>
        <tr>
        <td><?php echo "#". $index++?></td>
          <td><?php echo $product['name']; ?>
            <?php foreach ($product['option'] as $option) { ?>
            <br />
            &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
            <?php } ?></td>
          <td class="text-right"><?php echo $product['quantity']; ?></td>
          <td class="text-right"><?php echo $product['price']; ?></td>
          <td class="text-right"><?php echo $product['total']; ?></td>
        </tr>
        <?php } ?>
        <?php foreach ($order['total'] as $total) { ?>
        <tr>
          <td class="text-right" colspan="4"><b><?php echo $total['title'];  ?></b></td>
          <td class="text-right"><?php echo $total['text'];  ?></td>

        </tr>

        <?php } ?>
        
        <td class="text-right" colspan="4"> <strong style="font-size:14px"><?php echo $total['text']; echo " = $"; echo $total['text']/4,000; ?></strong></td>
      <tr>
        <td colspan="4" =""><strong>Shipping Address:</strong><?php echo $order['shipping_address']; ?>  
      <td/>
      </tr>
      <tr>
        <td colspan="4">
          <strong>Delivery: Panha</strong>
        </td>
      </tr>
      <tr>
        <td >
          FB:White Garlic
        </td>

        <td  >
          <strong style="font-size:10px">សូមអញ្ជើញពិសារ</strong>
        </td>
        <td >
          www.whitegarlic.net
        </td>
      </tr>


      </tbody>


    </table>
   
    
      
    <?php } ?>
  </div>
</div>
</body>
</html>
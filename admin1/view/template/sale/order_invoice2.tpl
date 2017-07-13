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
     <div class="row">
        <div style=" width:120px;float:left">
          <img src="view/image/white-garlic.jpg" style="width:100px">
        </div>
        
        <div style="width:200px;float:right">
            <strong><?php echo $order['store_name']; ?></strong><br />
            <?php echo $order['store_address']; ?><br/>
            <b><?php echo $text_telephone; ?></b> <?php echo $order['store_telephone']; ?><br />  
        </div>
      
      </div>
  
  <div style="page-break-after: always;">
  <table class="table">
   
    
      <tbody>
        <tr>
          
          <td ><b><?php echo $text_date_added; ?></b> <?php echo $order['date_added']; ?><br />
            <?php if ($order['invoice_no']) { ?>
            <b><?php echo $text_invoice_no; ?></b> <?php echo $order['invoice_no']; ?><br />
            <?php } ?>
            <b><?php echo $text_order_id; ?></b> <?php echo $order['order_id']; ?><br />
            <?php if ($order['shipping_method']) { ?>
            <b>Customer</b> <?php echo $order['customer']; ?><br />
            <b>Contact</b> <?php echo $order['telephone']; ?><br />
            <b>Order Time</b> <?php echo $order['comment']; ?><br />
            <strong>Shipping Address:</strong><?php echo $order['shipping_address']; ?>  <br/>
            <strong>Delivery: <?php echo $order['delivery']; ?></strong>
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
        <tr>
          <td class="text-right" colspan="4">
             <strong style="font-size:14px"><?php echo   $total['text']; echo " = $"; echo $total['text']/4,000; ?></strong>
          </td>
        </tr>
      <hr/>
      <br/>
      <p></p>
      <tr>
        <td class="text-right" colspan="2" >
          FB:White Garlic
        </td>

        <td colspan="2" class="text-right" >
          <strong style="font-size:12px">សូមអញ្ជើញពិសារ</strong>
        </td>
        <td class="text-right" >
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
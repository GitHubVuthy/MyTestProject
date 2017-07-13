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
<style media="print" type="text/css">

  
</style>
</head>
<body>
<div class="container" style="width:400px; font-size: 16px">
  <?php foreach ($orders as $order) { ?>
     <div class="row">
        <div style=" width:100px;float:left">
          <img src="view/image/white-garlic.jpg" style="width:90px">
        </div>
        
        <div style="width:300px;float:right">
          <center>
            <?php echo $order['store_address']; ?><br/><br/><br/>
            <b><?php echo $text_telephone; ?></b> <?php echo $order['store_telephone']; ?><br />  

          </center>
            
        </div>
      
      </div>
  <hr/>
  <div style="page-break-after: always;">
    <div class="row">
        <div style="width:60%;float:left;font-size:16px">
           
              <b>Customer:</b> <?php echo $order['customer']; ?><br />
              <b>Tel:</b> <?php echo $order['telephone']; ?><br />
             
			       <b>Comment: </b> <?php echo $order['comment']; ?><br />
              
        </div>
        <div style="width:40%;float:left">
          <?php if ($order['invoice_no']) { ?>
              <b>Invoice: </b> <?php echo $order['invoice_no']; ?><br />
              <?php } ?>
          <b>Date: </b> <?php echo $order['date_added']; ?><br />
           
              
             <!--  <strong>Delivery: <?php echo $order['delivery']; ?></strong><br/> -->
        </div>

     <!--  <b><?php echo $text_date_added; ?></b> <?php echo $order['date_added']; ?><br />
              <?php if ($order['invoice_no']) { ?>
              <b><?php echo $text_invoice; ?></b> <?php echo $order['invoice_no']; ?><br />
              <?php } ?>
              <?php if ($order['shipping_method']) { ?>
              <b>Customer</b> <?php echo $order['customer']; ?><br />
              <b>Telf</b> <?php echo $order['telephone']; ?><br />
              <b>Order Time</b> <?php echo $order['comment']; ?><br />
              <strong>Delivery: <?php echo $order['delivery']; ?></strong><br/>
              <strong>Shipping Address:</strong><?php echo $order['shipping_address']; ?>  
              <?php } ?> -->

      
    </div>
    <div class="row" style="100%; float:left; font-size:1៦px">
            <strong>Address: </strong><?php echo $order['shipping_address']; ?><BR/>   
        </div>
    <table class="table " style="margin-top:-30px">
      
        <tr style=" background-color:#333; color: #fff;font-size:12px;text-align:left   ">
          <th  ><b>No</b></td>
          <th ><b>Foods</b></td>
          <th ><b>Size</b></td>
          <th ><b>Qty</b></td>
          <th ><b>Price</b></td>
          <th ><b>Total</b></td>
        </tr>
      <tbody style="font-size:12px;text-align:left;  ">
      <?php $index=1?>
        <?php foreach ($order['product'] as $product) { ?>
        <tr>
          <td><?php echo "#". $index++?></td>
          <td><?php echo $product['name']; ?>
              <?php foreach ($product['option'] as $option) { ?>
          </td>
          <td class="text-right"><?php echo $option['value']; ?></td>
          <?php } ?>
          <td class="text-right"><?php echo $product['quantity']; ?></td>
          <td class="text-right"><?php echo $product['price']; ?></td>
          <td class="text-right"><?php echo $product['total']; ?></td>
        </tr>
        <?php } ?>
        <?php foreach ($order['total'] as $total) { ?>
        <tr >
          <td style="font-size:12px " class="text-right" colspan="3"><b><?php echo $total['title'];  ?></b></td>
          <td style="font-size:12px " colspan="3" class="text-right"><b><?php echo $total['text'];  ?> <?php echo " = $"; echo $total['dollars']; ?></b></td>
        </tr>

        <?php } ?>
        
      <hr/>
      </tbody>
    </table>
      
      <div style="width:150px;float:left">
        <strong>  FB:White Garlic  </strong>
      </div>

      <div style="width:200px;margin-left:10px;float:right">
        <strong>  www.whitegarlic.net  </strong>
      </div>
 
    <?php } ?>
  </div>
</div>
</body>
</html>
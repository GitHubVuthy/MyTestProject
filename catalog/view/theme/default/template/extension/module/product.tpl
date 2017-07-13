
 <div class="page-header">
 <h3 style="text-align:left;"><?php echo $heading_title?></h3>
 </div>
<div class="row">
 
  <?php foreach ($products as $product) { ?>
  <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a></div>
      <div class="s-desc" >
<span style="font-family:'Khmer OS Muol'; ">
  <h4 ><a style="color:#fff;font-weight: normal;font-size:12px; font-family:"Times New Roman" " href="<?php echo $product['href']; ?>"><?php echo $product['name']. " (ID: E".$product['product_id']. ")"; ?></a></h4>
</span>
</div>
</div>
</div>
  <?php } ?>
</div>



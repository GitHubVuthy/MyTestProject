<div class="col-sm-12">
 
 <div class="page-header">
 <h3 style="text-align:left;"><?php echo $heading_title?></h3>
 </div>
<div class="row">
  <?php foreach ($informations as $product) { ?>
  <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a></div>
      <div class="s-desc1" >
<span style="font-family:'Khmer OS Muol'; ">
  <h6><a style="font-weight: normal; font-family:"Times New Roman" " href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h6>
</span>
</div>
</div>
</div>
  <?php } ?>
</div>
</div>




 <div class="page-header">
 <h3 style="text-align:left;"><?php echo $heading_title?></h3>
 </div>
<div class="row">
 
  <?php foreach ($informations as $product) { ?>
  <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
   
  	<div class="row">
      	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a>
    	</div>
    	<div style="text-align:left; top:-5px" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
    		<h4 title="<?php echo $product['name']; ?>">	<?php echo $product['name']; ?></h4>
    	</div>
    	<hr/>
    
	</div>
</div>
  <?php } ?>

</div>


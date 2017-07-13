<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
    
      <div class="row">
  <?php foreach ($products as $product) { ?>
  <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <div class="image" >
        <a href="<?php echo $product['href']; ?>"><img  src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a>
      </div>
      <div class="s-desc" >
<span style="font-family:'Khmer OS Muol'; ">
  <h4 ><a style="color:#fff;font-weight: normal;font-size:12px; font-family:"Times New Roman" " href="<?php echo $product['href']; ?>"><?php echo $product['name']. " (ID: E".$product['product_id']. ")"; ?></a></h4>
 
</span>
</div>
  <div class="price">
     <h4 style="color:white; font-size:20px; font-weight:bold;"><?php echo $product['price']; ?></h4>
  </div>
    </div>
  </div>
  <?php } ?>
</div>

      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
      <?php if (!$categories && !$products) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?>
    <?php echo $column_right; ?></div>

<?php echo $footer; ?>

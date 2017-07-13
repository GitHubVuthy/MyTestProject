<?php echo $header; ?>
<div class="container">
 
  <div class="row">
    <h1><?php echo $message; ?></h1>
  <?php foreach ($informations as $related_info) { ?>
  <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <div class="image" >
        <a href="<?php echo $related_info['href']; ?>"><img  src="<?php echo $related_info['thumb']; ?>" alt="<?php echo $related_info['name']; ?>" title="<?php echo $related_info['name']; ?>"  /></a>
      </div>
      <div class="s-desc" >
<span style="font-family:'Khmer OS Muol'; ">
  <h4 ><a style="color:#fff;font-weight: normal;font-size:12px; font-family:"Times New Roman" " href="<?php echo $related_info['href']; ?>"><?php echo $related_info['name']. " (ID: E".$related_info['information_id']. ")"; ?></a></h4>
</span>
</div>
    </div>
  </div>
  <?php } ?>
</div>

    <!--   <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div> -->
     <!--  <?php if (!$categories && !$informations) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?> -->
      <?php echo $content_bottom; ?>
    <?php echo $column_right; ?></div>



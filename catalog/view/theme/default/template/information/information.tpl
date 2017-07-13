<?php echo $header; ?>
<div class="container">

  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1 style="text-align:left"><?php echo $heading_title; ?></h1>
      <!-- <p><?php echo "Viewed:". $viewed; ?></p> -->
      <?php echo $description; ?><?php echo $content_bottom; ?>

    
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5941f462baf31e99"></script>
            <!-- AddThis Button END -->
            
    </div>
    <?php echo $column_right; ?>


    <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style" data-url="<?php echo $share; ?>"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
    </div>
</div>
<?php echo $footer; ?>
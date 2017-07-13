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
      <?php if ($products_monday || $products_tuesday || $products_wednesday || $products_thursday 
              || $products_friday || $products_saturday || $products_sunday) { ?>
        <!-- <h2><?php echo $heading_title; ?></h2> -->
        <!-- <p><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></p>
        <div class="row">
          <div class="col-sm-3">
            <div class="btn-group hidden-xs">
              <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
              <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
            </div>
          </div>
          <div class="col-sm-1 col-sm-offset-2 text-right">
            <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
          </div>
          <div class="col-sm-3 text-right">
            <select id="input-sort" class="form-control col-sm-3" onchange="location = this.value;">
              <?php foreach ($sorts as $sorts) { ?>
              <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
              <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="col-sm-1 text-right">
            <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
          </div>
          <div class="col-sm-2 text-right">
            <select id="input-limit" class="form-control" onchange="location = this.value;">
              <?php foreach ($limits as $limits) { ?>
              <?php if ($limits['value'] == $limit) { ?>
              <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <br /> -->

        <?php if ($products_monday) { ?>
          <h2><?php echo $heading_title_monday; ?></h2>
          <br />
        <div class="row">
          <?php foreach ($products_monday as $product) { ?>

            <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
      <div class="featur-caption">
        <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
        <!-- <p><?php echo $product['description']; ?></p> -->
        <?php if ($product['rating']) { ?>
        <div class="rating">
          <?php for ($i = 1; $i <= 5; $i++) { ?>
          <?php if ($product['rating'] < $i) { ?>
          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
          <?php } else { ?>
          <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
          <?php } ?>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($product['price']) { ?>
        <p class="price1">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
          <?php } ?>
          <!-- <?php if ($product['tax']) { ?>
          <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
          <?php } ?> -->
        </p>
        <?php } ?>
      </div>
      <!-- <div class="button-group">
        <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
      </div>-->
    </div> 
  </div>
          <!-- <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
          
            <div class="product-thumb">
              <div class="image"><a href="<?php echo $product['href']; ?>"><img class="this-week-menu" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a></div>
              <div class="caption">
                <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name'] . '(' . $product['date'] .')' ; ?></a></h4>
                <p><?php echo $product['description']; ?></p>
                <?php if ($product['rating']) { ?>
                <div class="rating">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($product['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?>
                <?php if ($product['price']) { ?>
                <p class="price">
                  <?php if (!$product['special']) { ?>
                  <?php echo $product['price']; ?>
                  <?php } else { ?>
                  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                  <?php } ?>
                  <?php if ($product['tax']) { ?>
                  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                  <?php } ?>
                </p>
                <?php } ?>
              </div>
              <div class="button-group">
                <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div> -->
          <?php } ?>

        </div>
        <?php } ?>

        <!-- Tuesday -->
        <?php if ($products_tuesday) { ?>
        <h2><?php echo $heading_title_tuesday; ?></h2>
        <br />
        <div class="row">
          <?php foreach ($products_tuesday as $product) { ?>
              <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
      <div class="featur-caption">
        <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
        <!-- <p><?php echo $product['description']; ?></p> -->
        <?php if ($product['rating']) { ?>
        <div class="rating">
          <?php for ($i = 1; $i <= 5; $i++) { ?>
          <?php if ($product['rating'] < $i) { ?>
          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
          <?php } else { ?>
          <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
          <?php } ?>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($product['price']) { ?>
        <p class="price1">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
          <?php } ?>
          <!-- <?php if ($product['tax']) { ?>
          <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
          <?php } ?> -->
        </p>
        <?php } ?>
      </div>
      <!-- <div class="button-group">
        <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
      </div>-->
    </div> 
  </div>
          <?php } ?>
        </div>
        <?php } ?>
        <!-- End Tuesday -->

        <!-- Wenesday -->
        <?php if ($products_wednesday) { ?>
        <h2><?php echo $heading_title_wednesday; ?></h2>
        <br />
        <div class="row">
          <?php foreach ($products_wednesday as $product) { ?>
          <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="product-thumb">
              <div class="image"><a href="<?php echo $product['href']; ?>"><img class="image1" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a></div>
              <div class="featur-caption">
                <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                <!-- <p><?php echo $product['description']; ?></p> -->
                <?php if ($product['rating']) { ?>
                <div class="rating">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($product['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?>
                <?php if ($product['price']) { ?>
                <p class="price1">
                  <?php if (!$product['special']) { ?>
                  <?php echo $product['price']; ?>
                  <?php } else { ?>
                  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                  <?php } ?>
                  <!-- <?php if ($product['tax']) { ?>
                  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                  <?php } ?> -->
                </p>
                <?php } ?>
              </div>
              <!-- <div class="button-group">
                <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              </div> -->
            </div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        <!-- End Wenesday -->

        <!-- Thursday -->
        <?php if ($products_thursday) { ?>
        <h2><?php echo $heading_title_thursday; ?></h2>
        <br />
        <div class="row">
          <?php foreach ($products_thursday as $product) { ?>
          <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="product-thumb">
              <div class="image"><a href="<?php echo $product['href']; ?>"><img class="image1"  src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a></div>
              <div class="featur-caption">
                <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                <!-- <p><?php echo $product['description']; ?></p> -->
                <?php if ($product['rating']) { ?>
                <div class="rating">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($product['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?>
                <?php if ($product['price']) { ?>
                <p class="price1">
                  <?php if (!$product['special']) { ?>
                  <?php echo $product['price']; ?>
                  <?php } else { ?>
                  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                  <?php } ?>
                  <!-- <?php if ($product['tax']) { ?>
                  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                  <?php } ?> -->
                </p>
                <?php } ?>
              </div>
              <!-- <div class="button-group">
                <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              </div> -->
            </div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        <!-- End Thursday -->

        <!-- Friday -->
        <?php if ($products_friday) { ?>
        <h2><?php echo $heading_title_friday; ?></h2>
        <br />
        <div class="row">
          <?php foreach ($products_friday as $product) { ?>
          <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="product-thumb">
              <div class="image"><a href="<?php echo $product['href']; ?>"><img class="image1"  src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a></div>
              <div class="featur-caption">
                <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                <!-- <p><?php echo $product['description']; ?></p> -->
                <?php if ($product['rating']) { ?>
                <div class="rating">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($product['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?>
                <?php if ($product['price']) { ?>
                <p class="price1">
                  <?php if (!$product['special']) { ?>
                  <?php echo $product['price']; ?>
                  <?php } else { ?>
                  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                  <?php } ?>
                  <!-- <?php if ($product['tax']) { ?>
                  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                  <?php } ?> -->
                </p>
                <?php } ?>
              </div>
              <!-- <div class="button-group">
                <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              </div> -->
            </div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        <!-- End Friday -->

        <!-- Wenesday -->
        <?php if ($products_saturday) { ?>
        <h2><?php echo $heading_title_saturday; ?></h2>
        <br />
        <div class="row">
          <?php foreach ($products_saturday as $product) { ?>
          <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="product-thumb">
              <div class="image"><a href="<?php echo $product['href']; ?>"><img class="image1"  src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a></div>
              <div class="featur-caption">
                <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                <!-- <p><?php echo $product['description']; ?></p> -->
                <?php if ($product['rating']) { ?>
                <div class="rating">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($product['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?>
                <?php if ($product['price']) { ?>
                <p class="price1">
                  <?php if (!$product['special']) { ?>
                  <?php echo $product['price']; ?>
                  <?php } else { ?>
                  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                  <?php } ?>
                  <!-- <?php if ($product['tax']) { ?>
                  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                  <?php } ?> -->
                </p>
                <?php } ?>
              </div>
              <!-- <div class="button-group">
                <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              </div> -->
            </div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        <!-- End saturday -->

        <!-- sunday -->
        <?php if ($products_sunday) { ?>
        <h2><?php echo $heading_title_sunday; ?></h2>
        <br />
        <div class="row">
          <?php foreach ($products_sunday as $product) { ?>
          <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="product-thumb">
              <div class="image"><a href="<?php echo $product['href']; ?>"><img class="image1"  src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a></div>
              <div class="featur-caption">
                <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                <!-- <p><?php echo $product['description']; ?></p> -->
                <?php if ($product['rating']) { ?>
                <div class="rating">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($product['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?>
                <?php if ($product['price']) { ?>
                <p class="price1">
                  <?php if (!$product['special']) { ?>
                  <?php echo $product['price']; ?>
                  <?php } else { ?>
                  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                  <?php } ?>
                  <!-- <?php if ($product['tax']) { ?>
                  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                  <?php } ?> -->
                </p>
                <?php } ?>
              </div>
              <!-- <div class="button-group">
                <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              </div> -->
            </div>
          </div>
          <?php } ?>
        </div>
        <?php } else { ?>
        <p><?php echo $text_empty_sunday; ?></p>
        <div class="buttons">
          <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
        </div>
        <?php } ?>
        <!-- End sunday -->
    <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
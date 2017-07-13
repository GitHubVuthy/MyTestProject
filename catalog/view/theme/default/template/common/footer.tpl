<footer >
  <div class="container">
    <div class="row">
      <?php if ($informations) { ?>
      <div class="col-sm-3" style="font-family:'Khmer OS Content';​​">
        <h5 style="font-family:'Khmer OS moul';​​"><?php echo $text_information; ?></h5>
        <ul class="list-unstyled">
          <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
      <div class="col-sm-3" style="font-family:'Khmer OS Content';​​">
        <h5><?php echo $text_service; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_payment; ?></a></li>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_my_location; ?></a></li>
          
          <li><a href="comingsoon.PNG"><?php echo $text_food_request; ?></a></li>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_comment; ?></a></li>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_health_newpaper; ?></a></li>
        </ul>
      </div>
      <div class="col-sm-3">
        <h5><?php echo $text_facebook; ?></h5>
        <ul class="list-unstyled">
            <li><a href="https://www.facebook.com/pg/whitegarlicphonmpenh/about/?ref=page_internal">
                  <img src="<?php echo $whfa; ?>" title="<?php echo $text_facebook; ?>" alt="<?php echo $text_facebook; ?>" width="170" class="img-responsive" hidden-xs/> 
            </a></li>
        </ul>
      </div>
      <div class="col-sm-3">
        <ul class="list-unstyled">
          <li><a href="<?php echo $logo; ?>">
            <img src="<?php echo $logo; ?>" title="<?php echo $text_facebook; ?>" alt="<?php echo $text_facebook; ?>" width="150" class="img-responsive" hidden-xs/> 
          </a></li>
           <li>© White Garlic, Inc. </li>
        
        </ul>
      </div>
    </div>
    
  </div>
</footer>

<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->

<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->

</body></html>
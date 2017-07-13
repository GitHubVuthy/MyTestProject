<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/custom.css" rel="stylesheet">
<script src="catalog/view/javascript/jquery/jssor.slider-25.0.7.min.js" type="text/javascript"></script>
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>

   <style type="text/css">
    #sticky.stick {
    margin-top: 0 !important;
    position: fixed;
    top: 0;

   /* z-index: 10000000;
    border-radius: 0 0 0.5em 0.5em;
    color:red;
    width: 100%;*/
}


h3{
   font-family:'Khmer OS Muol';
}
/*.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 30;
    left: 100%;
    margin-top: -1px;
  } */
</style>
<script type="text/javascript">
    function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
        
    } else {
        $('#sticky').removeClass('stick');
        
    }
}

$(function() {
    $(window).scroll(sticky_relocate);
   
});
</script>
</head>

<body class="<?php echo $class; ?>">
<nav id="top">
  <div class="container">
   <!--  <?php echo $currency; ?> -->
    <?php echo $language; ?>
    <div id="top-links" class="nav pull-right">
      <ul class="list-inline">
        <li><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a> <span class="hidden-xs hidden-sm hidden-md"><?php echo $telephone; ?></span></li>
         <li><a href="<?php echo $line; ?>"><i>LINE:</i></a> <span class="hidden-xs hidden-sm hidden-md"><?php echo "White Garlic"; ?></span></li>
        <!-- <li class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-right">
            <?php if ($logged) { ?>
            <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
            <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
            <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
            <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
            <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
            <?php } else { ?>
            <li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
            <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_wishlist; ?></span></a></li>
        <li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_shopping_cart; ?></span></a></li>
        <li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_checkout; ?></span></a></li> -->
      </ul>
    </div>
  </div>
</nav>
<header>
  <div class="container " >
    <div class="row">
      <div class="col-xs-12 hidden-lg hidden-md hidden-sm background="<?php echo $bheader?>">
      <div class="col-sm-12">
        <div id="logo">
          <?php if ($logo) { ?>
          <a href="<?php echo $home; ?>"><img src="<?php echo $logo1; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
          <?php } else { ?>
          <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="col-xs-12 hidden-md hidden-sm hidden-xs background="<?php echo $bheader?>">
      <div class="col-sm-12">
        <div id="logo">
          <?php if ($logo) { ?>
          <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
          <?php } else { ?>
          <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
 
</header>
<div id="sticky-anchor"></div>
<div class="container-fluid" >

<div id ="sticky" >
  <nav id="menu" class="navbar" style="box-shadow:2px 2px 4px #000000; font-family:'Khmer OS Muol' ">
    <div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
      <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
     <ul class="nav navbar-nav">
	 <!-- <li><a href="<?php    echo $related_info; ?>"><?php echo "Related_information"; ?></a></li> -->
	<li><a href="<?php    echo $today_menu; ?>"><?php echo $text_today_menu; ?></a></li>

   <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text_weekly_food_menu; ?></a>
            <div class="dropdown-menu">
            <div class="dropdown-inner">
              
              <ul class="nav dropdown-inner">
             
                <li><a href="<?php echo $this_week_menu; ?>"><?php echo $text_this_week_menu; ?></a></li>  
                 <li><a href="<?php echo $next_week_menu; ?>"><?php echo $text_next_week_menu; ?></a></li>  
                <!--  <li><a href="<?php echo $video; ?>"><?php echo $text_video ?></a></li> -->
            
              </ul>
           </div>
         </li> 


    

<?php if ($categories) { ?>
    <?php foreach ($categories as $category) { ?>
    <?php if ($category['children']) { ?>
    <li class="dropdown">
     <a  href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>

      <div class="dropdown-menu">
        <div class="dropdown-inner">

          
          <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
          <ul class="nav dropdown-inner">
            <?php foreach ($children as $child) { ?>
              <li class="dropdown-submenu" >
                 <a  href="<?php echo $child['href']; ?>" ><?php echo $child['name']; ?></a>
               <?php if($child['grand_childs']){
                echo '<ul class="dropdown-menu sub-menu">';
              foreach($child['grand_childs'] as $grand_child){ ?>
                        <li>
                          <a class="test" href="<?php echo $grand_child['href']; ?>" ><?php echo $grand_child['name']; ?></a>
                        </li>
            <?php }
         echo '</ul>';
            }
            ?>
            </li>

            <?php } ?>

          </ul>
          <?php } ?>

        </div>
        
    </li>
    <?php } else { ?>
    <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
    <?php } ?>
    <?php } ?>
    <?php } ?> 

<?php if ($info_categories) { ?>
    <?php foreach ($info_categories as $info_category) { ?>
    <?php if ($info_category['children']) { ?>
    <li class="dropdown">
     <a tabindex="-1" href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $info_category['name']; ?></a>

      <div class="dropdown-menu">
        <div class="dropdown-inner">
          <ul class="nav dropdown-inner">
            <li><a href="<?php echo $by_block; ?>"><?php echo $text_block; ?></a></li>
            <li><a href="<?php echo $by_country; ?>"><?php echo $text_country; ?></a></li>
            <li><a href="<?php echo $by_cooking; ?>"><?php echo $text_cooking; ?></a></li>
            <li><a href="<?php echo $by_meat; ?>"><?php echo $text_meat; ?></a></li>
           
          <?php foreach (array_chunk($info_category['children'], ceil(count($info_category['children']) / $info_category['column'])) as $info_children) { ?>
            <?php foreach ($info_children as $info_child) { ?>

              <li class="dropdown-submenu" >
                 <a  href="<?php echo $info_child['href']; ?>" ><?php echo $info_child['name']; ?></a>

               <?php if($info_child['grand_childs']){
                echo '<ul class="dropdown-menu sub-menu">';
              foreach($info_child['grand_childs'] as $info_grand_child){ ?>
                        <li>
                          <a  href="<?php echo $info_grand_child['href']; ?>" ><?php echo $info_grand_child['name']; ?></a>
                        </li>
                       
            <?php }
                echo '</ul>';
            }
            ?>
            </li>
            <?php } ?>

         
          <?php } ?>
         <!--   <li><a href="<?php echo $video; ?>"><?php echo $text_video ?></a></li> -->
         </ul>
        </div>
       
    </li>
    <?php } else { ?>
    <li><a href="<?php echo $info_category['href']; ?>"><?php echo $info_category['name']; ?></a></li>

    <?php } ?>

    <?php } ?>
    <?php } ?>

     
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text_service; ?></a>
            <div class="dropdown-menu">
            <div class="dropdown-inner">
              
              <ul class="nav dropdown-inner">
           
                <li><a href="<?php echo $daily_food; ?>"><?php echo $text_daily_food ?></a></li>
                <li><a href="<?php echo $food_party; ?>"><?php echo $text_food_party ?></a></li>
                <li><a href="<?php echo $food_snack; ?>"><?php echo $text_food_snack ?></a></li>
                <li><a href="<?php echo $organic_cafeterias; ?>"><?php echo $text_organic_cafeterias ?></a></li>
                <li><a href="<?php echo $organic_fruit; ?>"><?php echo $text_organic_fruit ?></a></li>
                 <li><a href="<?php echo $organic_vegetables; ?>"><?php echo $text_organic_vegetables ?></a></li>
                <li><a href="<?php echo $food_magazine; ?>"><?php echo $text_food_magazine ?></a></li>
                <li><a href="<?php echo $course_cooking_for_tour; ?>"><?php echo $text_course_cooking_for_tour ?></a></li>
                <!--  <li><a href="<?php echo $video; ?>"><?php echo $text_video ?></a></li> -->
            
              </ul>
           </div>
         </li> 

         <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text_food_health; ?></a>
            <div class="dropdown-menu">
            <div class="dropdown-inner">
              
                 <ul class="nav dropdown-inner">
           
                <li><a href="<?php echo $benefites_of_vegetables; ?>"><?php echo $text_benefites_of_vegetables ?></a></li>
                <li><a href="<?php echo $food_for_heart_disease_people; ?>"><?php echo $text_food_for_heart_disease_people ?></a></li>
                <li><a href="<?php echo $foods_for_diabetes_people; ?>"><?php echo $text_foods_for_diabetes_people ?></a></li>
                <li><a href="<?php echo $food_for_pregnant_women; ?>"><?php echo $text_food_for_pregnant_women ?></a></li>
                <li><a href="<?php echo $food_for_women_childbirth; ?>"><?php echo $text_food_for_women_childbirth ?></a></li>
                <li><a href="<?php echo $meals_for_kids; ?>"><?php echo $text_meals_for_kids ?></a></li>
                
            
              </ul>
           </div>
         </li> 

         

          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" ><?php echo $text_about; ?></a>
            <div class="dropdown-menu">
            <div class="dropdown-inner">
              
                  <ul class="nav dropdown-inner">
           
                <li><a href="<?php echo $founder; ?>"><?php echo $text_founder ?></a></li>
                <li><a href="<?php echo $mission; ?>"><?php echo $text_mission ?></a></li>
                <li><a href="<?php echo $supplyer; ?>"><?php echo $text_supplyer ?></a></li>
                <li><a href="<?php echo $cooking; ?>"><?php echo $text_cooking ?></a></li>
                <li><a href="<?php echo $packing; ?>"><?php echo $text_packing ?></a></li>
                <li><a href="<?php echo $partner; ?>"><?php echo $text_partner ?></a></li>
                <li><a href="<?php echo $feedback; ?>"><?php echo $text_feedback ?></a></li>
                <li><a href="<?php echo $gallary; ?>"><?php echo $text_gallary ?></a></li>
            
              </ul>
           </div>
         </li>





  </ul>

    </div>

  </nav>

</div>











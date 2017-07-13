<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-delivery" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-delivery" class="form-horizontal">
		<?php /* First Name */ ?>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_fname; ?></label>
            <div class="col-sm-10">
              <input type="text" name="fname" value="<?php echo $fname; ?>" placeholder="<?php echo $entry_fname; ?>" id="input-name" class="form-control" />
              <?php if ($error_fname) { ?>
              <div class="text-danger"><?php echo $error_fname; ?></div>
              <?php } ?>
            </div>
          </div>     		  
		  <?php /* Last Name */ ?>
		  
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input_lname"><?php echo $entry_lname; ?></label>
            <div class="col-sm-10">
              <input type="text" name="lname" value="<?php echo $lname ;?>" " placeholder="<?php echo $entry_lname; ?>" id="input-lname" class="form-control" />
            </div>
          </div>
		  <?php /* Gender */ ?>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-gender"><?php echo $entry_gender; ?></label>
            <div class="col-sm-10">
				<select name="gender" style="width:400px;padding:9px">
					<option value="Male"><?php $gender ;?></option>
					<option Value="Female"><?php $gender ;?></option>
				</select>
              <input type="text" name="gender" value="<?php $gender ;?>" placeholder="<?php echo $entry_gender; ?>" id="input-gender" class="form-control" />
            </div>
          </div>
		  <?php /* DB */ ?>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-db"><?php echo $entry_db; ?></label>
            <div class="col-sm-10">
              <input type="text" name="db" value="<?php echo $db; ?>" placeholder="<?php echo $db; ?>" id="input-db" class="form-control" />
            </div>
          </div>
		  <?php /* Address*/ ?>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-address"><?php echo $entry_address; ?></label>
            <div class="col-sm-10">
              <input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control" />
            </div>
          </div>
		  
		  <?php /* Email*/ ?>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
            <div class="col-sm-10">
              <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
            </div>
          </div>
		  <?php /* Phone*/ ?>
		  <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-phone"><?php echo $entry_phone; ?></label>
            <div class="col-sm-10">
              <input type="text" name="phone" value="<?php echo $phone;?>"  placeholder="<?php echo $entry_phone; ?>" id="input-phone" class="form-control" />
			  <?php if ($error_phone) { ?>
              <div class="text-danger"><?php echo $error_phone; ?></div>
              <?php } ?>
     
            </div>
          </div>
		  
			<?php /* store_order*/ ?>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort; ?></label>
            <div class="col-sm-10">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
		  <?php /* status*/ ?>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <input type="text" name="status" value="<?php echo $status; ?>" placeholder="<?php echo $entry_status; ?>" id="input-status" class="form-control" />
            </div>
          </div>
		  <?php /* delivery_image*/ ?>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
            <div class="col-sm-10"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
              <input type="hidden" name="delivery_image" value="<?php echo $delivery_image; ?>" id="input-image" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
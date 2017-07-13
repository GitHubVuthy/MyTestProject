<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-adminProtection" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <img src="view/image/oc.png" width="80" height="80" style="margin-right:10px;"><h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  	<hr>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>

    <div class="" style="display:inline-block; border:0; margin-bottom:15px">
	<a target="_blank "href="https://www.siteguarding.com/en/protect-your-website"><img src="view/image/rek3.png" style="border:1px solid #ccc"></a>
	<a target="_blank "href="https://www.siteguarding.com/en/website-extensions"><img src="view/image/rek1.png" style="margin: 0 10px;border:1px solid #ccc"></a>
	<a target="_blank "href="https://www.siteguarding.com/en/secure-web-hosting"><img src="view/image/rek4.png" style="border:1px solid #ccc"></a>
	</div>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-adminProtection" class="form-horizontal">	
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="adminProtection_status" id="input-status" class="form-control">
                <?php if ($adminProtection_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>	
          </div>	
		</div>	
	</div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit_captcha; ?></h3>
      </div>
      <div class="panel-body">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-recaptcha"><?php echo $entry_recaptcha; ?></label>
            <div class="col-sm-10">
              <input type="checkbox" style="margin-top:0.7%;display: inline-block;" name="adminProtection_recaptcha" <?php if ($adminProtection_recaptcha) echo 'checked'; ?> id="input-recaptcha" class="form-control" /><span style="margin-left:1%;"><?php echo $link_captcha; ?><span>
              <?php if ($error_adminProtection_recaptcha) { ?>
              <div class="text-danger"><?php echo $error_adminProtection_recaptcha; ?></div>
              <?php } ?>
            </div>
          </div>			
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_recaptcha_key; ?></label>
            <div class="col-sm-10">
              <input type="text" name="adminProtection_recaptcha_key" value="<?php echo $adminProtection_recaptcha_key; ?>" placeholder="<?php echo $entry_recaptcha_key_place; ?>" id="input-recaptcha_key" class="form-control" />
              <?php if ($error_adminProtection_recaptcha_key) { ?>
              <div class="text-danger"><?php echo $error_adminProtection_recaptcha_key; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_recaptcha_private_key; ?></label>
            <div class="col-sm-10">
              <input type="text" name="adminProtection_recaptcha_private_key" value="<?php echo $adminProtection_recaptcha_private_key; ?>" placeholder="<?php echo $entry_recaptcha_private_key_place; ?>" id="input-recaptcha_private_key" class="form-control" />
              <?php if ($error_adminProtection_recaptcha_private_key) { ?>
              <div class="text-danger"><?php echo $error_adminProtection_recaptcha_private_key; ?></div>
              <?php } ?>
            </div>
          </div>


      </div>
    </div>
		
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit_secure; ?></h3>
      </div>
      <div class="panel-body">		
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-secure"><?php echo $entry_secure; ?></label>
            <div class="col-sm-10">
              <input type="checkbox" style="margin-top:0.7%;display: inline-block;" name="adminProtection_secure" <?php if ($adminProtection_secure) echo 'checked'; ?> id="input-secure" class="form-control" /><span style="margin-left:1%;"><?php echo $link_secret; ?><span>
              <?php if ($error_adminProtection_secure) { ?>
              <div class="text-danger"><?php echo $error_adminProtection_secure; ?></div>
              <?php } ?>
            </div>
          </div>			
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-secure_key"><?php echo $entry_secure_key; ?></label>
            <div class="col-sm-10">
              <input type="text" name="adminProtection_secure_key" value="<?php echo $adminProtection_secure_key; ?>" placeholder="<?php echo $entry_secure_key_place; ?>" id="input-secure_key" class="form-control" />
              <?php if ($error_adminProtection_secure_key) { ?>
              <div class="text-danger"><?php echo $error_adminProtection_secure_key; ?></div>
              <?php } ?>
            </div>
          </div>


      </div>
    </div>		
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit_extra; ?></h3>
      </div>
      <div class="panel-body">				
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-extra_white"><?php echo $entry_extra_white; ?></label>
            <div class="col-sm-10">
              <textarea style="width:50%;height:200px;resize:none;" name="adminProtection_extra_white" id="input-extra_white" class="form-control"><?php echo $adminProtection_extra_white; ?></textarea>
              <?php if ($error_adminProtection_extra_white) { ?>
              <div class="text-danger"><?php echo $error_adminProtection_extra_white; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-extra_black"><?php echo $entry_extra_black; ?></label>
            <div class="col-sm-10">
              <textarea style="width:50%;height:200px;resize:none;" name="adminProtection_extra_black" id="input-extra_black" class="form-control"><?php echo $adminProtection_extra_black; ?></textarea>
              <?php if ($error_adminProtection_extra_black) { ?>
              <div class="text-danger"><?php echo $error_adminProtection_extra_black; ?></div>
              <?php } ?> 
            </div>
          </div>


      </div>
    </div>
	
	
	
    </form>
    <div>
		<h4><?php echo $for_more_information; ?><a target="_blank" href="https://www.siteguarding.com/en/opencart-user-access-notification"><?php echo $link_click; ?></a></h4>
		<a target="_blank "href="http://www.siteguarding.com/livechat/index.html"><img src="view/image/livechat.png"></a>
		<h4><?php echo $for_any_questions; ?><a target="_blank" href="https://www.siteguarding.com/en/contacts"><?php echo $link_contact; ?></a></h4>
		<h4><a target="_blank" href="https://www.siteguarding.com/en"><?php echo $link_siteguarding; ?></a><?php echo $siteguarding; ?></h4>
		<hr>
	</div>	
  </div>
</div>
<?php echo $footer; ?>
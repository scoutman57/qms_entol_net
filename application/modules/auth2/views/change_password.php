<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<!-- Errors -->
<?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
<?php if($success_message) { echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>


<div class="col-lg-12">
<h3 class="title"><?php echo $page_title; ?></h3>
</div>

<div class="col-lg-12">
<?php $attrib = array('class' => 'form-horizontal'); echo form_open("auth/change_password", $attrib);?>
<div class="form-group">
  <label class="control-label col-xs-2" for="old_password"><?php echo $this->lang->line("old_pw"); ?></label>
  <div class="col-md-3 col-xs-11"> <?php echo form_input($old_password , '', 'class="form-control" id="old_password"');?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="new_password"><?php echo $this->lang->line("new_pw"); ?></label>
  <div class="col-md-3 col-xs-11"> <?php echo form_input($new_password , '', 'class="form-control" id="new_password"');?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="new_password_confirm"><?php echo $this->lang->line("confirm_pw"); ?></label>
  <div class="col-md-3 col-xs-11"> <?php echo form_input($new_password_confirm , '', 'class="form-control" id="new_password_confirm"');?> </div>
</div>
<?php echo form_input($user_id);?>
<div class="form-group">
  <div class="col-xs-offset-2 col-xs-10"> <?php echo form_submit('submit', $this->lang->line("change_password"), 'class="btn btn-primary"');?> </div>
</div>
<?php echo form_close();?> 
</div>
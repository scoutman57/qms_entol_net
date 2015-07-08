<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<!--<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>-->
<script class="include" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>


<!--common script for all pages-->
<!--<script src="<?php echo base_url();?>assets/js/common-scripts.js"></script>-->

<!--script for this page-->
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/js/morris-0.4.3.min.js"></script>

<script type="text/javascript">
$(function() {
	// $('form').form();
	$(".user-role .btn").click(function() {
    	$("#role").val($(this).val()); 
	});
	$("form").submit(function () { 
			if($("#role").val() == "") {
				alert("<?php echo $this->lang->line('select_user_role'); ?>");
				return false;
			}
			if ($("#password").val() != $("#password_confirm").val()) { 
				alert ('The passwords do not match!');
				return false; 
			} 
	}); 
});
</script>
<?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>

<h3 class="title"><?php echo $this->lang->line("create_user"); ?></h3>
<p><?php echo $this->lang->line("enter_user_info"); ?></p>
<?php $attrib = array('class' => 'form-horizontal'); echo form_open("auth/create_user", $attrib);?>
<div class="form-group">
  <label class="control-label col-xs-2" for="first_name"><?php echo $this->lang->line("first_name"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($first_name, '', 'class="form-control" pattern=".{2,55}" required="required" data-error="'.$this->lang->line("first_name").' '.$this->lang->line("is_required").'"');?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="last_name"><?php echo $this->lang->line("last_name"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($last_name, '', 'class="form-control" pattern=".{2,55}" required="required" data-error="'.$this->lang->line("last_name").' '.$this->lang->line("is_required").'"');?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="company"><?php echo $this->lang->line("company"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($company, '', 'class="form-control" required="required" data-error="'.$this->lang->line("company").' '.$this->lang->line("is_required").'"');?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="phone"><?php echo $this->lang->line("phone"); ?></label>
  <div class="col-xs-10"> <?php /* echo form_input($phone, '', 'class="form-control" required="required" data-error="'.$this->lang->line("phone").' '.$this->lang->line("is_required").'"'); */?> 
  <input type="tel" name="phone" class="form-control" pattern="[0-9]{7,15}" required="required" data-error="<?php echo $this->lang->line("phone").' '.$this->lang->line("is_required"); ?>" /></div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="email"><?php echo $this->lang->line("email_address"); ?></label>
  <div class="col-xs-10"> <?php /* echo form_input($email, '', 'class="form-control" required="required" data-error="'.$this->lang->line("date").' '.$this->lang->line("is_required").'"'); */?> 
  <input type="email" name="email" class="form-control" required="required" data-error="<?php echo $this->lang->line("email_address").' '.$this->lang->line("is_required"); ?>" /></div>
</div>
<!--
<div class="control-group">
  <label class="control-label" for="role"><?php echo $this->lang->line("user_role"); ?></label>
  <div class="controls">
      <div class="btn-group user-role" data-toggle="buttons-radio">
    <button type="button" value="1" class="btn"><?php echo $this->lang->line("owner"); ?></button>
    <button type="button" value="2" class="btn"><?php echo $this->lang->line("admin"); ?></button>
    <button type="button" value="3" class="btn"><?php echo $this->lang->line("purchaser"); ?></button>
    <button type="button" value="4" class="btn"><?php echo $this->lang->line("salesman"); ?></button>
    <button type="button" value="5" class="btn"><?php echo $this->lang->line("user"); ?></button>
    </div>
    <input type="hidden" name="role" id="role" value="<?php /* echo $group->group_id; */ ?>">
  </div>
</div>
-->
<div class="form-group">
  <label class="control-label col-xs-2" for="password"><?php echo $this->lang->line("pw"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($password , '', 'class="password form-control" id="password" pattern=".{8,55}" required="required" data-error="'.$this->lang->line("pw").' '.$this->lang->line("is_required").'"');?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="confirm_pw"><?php echo $this->lang->line("confirm_pw"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($password_confirm , '', 'class="password form-control" id="confirm_pw" pattern=".{8,55}" required="required" data-error="'.$this->lang->line("confirm_pw").' '.$this->lang->line("is_required").'"');?> </div>
</div>
<div class="form-group">
  <div class="col-xs-offset-2 col-xs-10"> <?php echo form_submit('submit', $this->lang->line("add_user"), 'class="btn btn-primary "');?> </div>
</div>
<?php echo form_close();?> 
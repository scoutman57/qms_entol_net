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
	$(".user-role .btn").click(function() {
    // whenever a button is clicked, set the hidden helper
    $("#role").val($(this).val());
}); 
});
</script>
<br>
<!-- Errors -->
<?php if($message) { echo "<div class=\"alert alert-danger\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
<?php if($success_message) { echo "<div class=\"alert alert-success\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>

<h1>Edit User</h1>
<p><?php echo $this->lang->line("update_user_info"); ?></p>
<?php $first_name = array(
              'name'        => 'first_name',
              'id'          => 'first_name',
			  'placeholder' => "First Name",
              'value'       => $user->first_name,
              'class'       => 'form-control'
            );
			$last_name = array(
              'name'        => 'last_name',
              'id'          => 'last_name',
              'value'       => $user->last_name,
              'class'       => 'form-control'
            );
			$company = array(
              'name'     => 'company',
              'id'          => 'company',
              'value'       => $user->company,
              'class'       => 'form-control',
            );
			$phone = array(
              'name'        => 'phone',
              'id'          => 'phone',
              'value'       => $user->phone,
              'class'       => 'form-control',
            );
			$email = array(
              'name'        => 'email',
              'id'          => 'email',
              'value'       => $user->email,
              'class'       => 'form-control',
            );
			
	?>
<?php $attrib = array('class' => 'form-horizontal'); echo form_open("auth/edit_user/".$id, $attrib);?>
<div class="form-group">
  <label class="control-label col-xs-2" for="first_name"><?php echo $this->lang->line("first_name"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($first_name);?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="last_name"><?php echo $this->lang->line("last_name"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($last_name);?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="company"><?php echo $this->lang->line("company"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($company);?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="phone"><?php echo $this->lang->line("phone"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($phone);?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="email"><?php echo $this->lang->line("email_address"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($email);?> </div>
</div>
<!--<div class="control-group">
  <label class="control-label" for="phone"><?php echo $this->lang->line("user_role"); ?></label>
  <div class="controls"> 

<label class="radio">
        <input type="radio" name="role" id="optionsRadios1" value="1" <?php //if($group->group_id == '1') { echo "checked=\"yes\""; } if(isset($_POST['submit']) && ($_POST['role'] == '1')) { echo "checked=\"yes\""; } ?>>
        <?php //echo $this->lang->line("owner_role"); ?> </label>
      <label class="radio">
        <input type="radio" name="role" id="optionsRadios2" value="2" <?php //if($group->group_id == '2') { echo "checked=\"yes\""; } if(isset($_POST['submit']) && ($_POST['role'] == '2')) { echo "checked=\"yes\""; } ?>>
        <?php //echo $this->lang->line("admin_role"); ?> </label>
      <label class="radio">
        <input type="radio" name="role" id="optionsRadios3" value="3" <?php //if($group->group_id == '3') { echo "checked=\"yes\""; } if(isset($_POST['submit']) && ($_POST['role'] == '3')) { echo "checked=\"yes\""; } ?>>
        <?php //echo $this->lang->line("purchaser_role"); ?> </label>
        <label class="radio">
        <input type="radio" name="role" id="optionsRadios4" value="4" <?php //if($group->group_id == '4') { echo "checked=\"yes\""; } if(isset($_POST['submit']) && ($_POST['role'] == '4')) { echo "checked=\"yes\""; } ?>>
        <?php //echo $this->lang->line("salesman_role"); ?> </label>
      <label class="radio">
        <input type="radio" name="role" id="optionsRadios5" value="5" <?php //if($group->group_id == '5') { echo "checked=\"yes\""; } if(isset($_POST['submit']) && ($_POST['role'] == '5')) { echo "checked=\"yes\""; } ?>>
        <?php //echo $this->lang->line("view_role"); ?> </label>
  </div>
</div>     
<div class="control-group">
  <label class="control-label" for="phone"><?php echo $this->lang->line("user_role"); ?></label>
  <div class="controls">
      <div class="btn-group user-role" data-toggle="buttons-radio">
    <button type="button" value="1" class="btn <?php if($groups->group_id == '1') { echo "active"; } if(isset($_POST['submit']) && ($_POST['role'] == '1')) { echo "active"; } ?>"><?php echo $this->lang->line("owner"); ?></button>
    <button type="button" value="2" class="btn <?php if($groups->group_id == '2') { echo "active"; } if(isset($_POST['submit']) && ($_POST['role'] == '2')) { echo "active"; } ?>"><?php echo $this->lang->line("admin"); ?></button>
    <button type="button" value="3" class="btn <?php if($groups->group_id == '3') { echo "active"; } if(isset($_POST['submit']) && ($_POST['role'] == '3')) { echo "active"; } ?>"><?php echo $this->lang->line("purchaser"); ?></button>
    <button type="button" value="4" class="btn <?php if($groups->group_id == '4') { echo "active"; } if(isset($_POST['submit']) && ($_POST['role'] == '4')) { echo "active"; } ?>"><?php echo $this->lang->line("salesman"); ?></button>
    <button type="button" value="5" class="btn <?php if($groups->group_id == '5') { echo "active"; } if(isset($_POST['submit']) && ($_POST['role'] == '5')) { echo "active"; } ?>"><?php echo $this->lang->line("user"); ?></button>
    </div>
    <input type="hidden" name="role" id="role" value="<?php echo $groups->group_id; ?>">
 </div>
</div>     
-->  

<div class="form-group">
  <label class="control-label col-xs-2" for="password"><?php echo $this->lang->line("pw"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($password , '', 'class="password form-control" id="password"');?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="confirm_pw"><?php echo $this->lang->line("confirm_pw"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($password_confirm , '', 'class="password form-control" id="confirm_pw"');?> </div>
</div>
<?php if ($this->ion_auth->is_admin()): ?>
<div class="form-group">
  <label class="control-label col-xs-2" for="default_group_user"><?php echo "Default Group"; ?></label>
  <div class="col-xs-10"> <?php echo form_dropdown('default_group_user',$default_group_user,(isset($_POST['default_group_user_attr']) ? $_POST['default_group_user_attr'] : $default_group_user_attr));?> </div>
</div>
<div class="form-group">
  <label class="col-xs-offset-2 col-xs-10" for="password"><h3><?php echo lang('edit_user_groups_heading');?></h3></label>
  <!--<h3><?php //echo lang('edit_user_groups_heading');?></h3>-->
  <?php foreach ($groups as $group):?>
	<div class="col-xs-offset-2 col-xs-10">
		<div class="checkbox">
			<label>
			<?php
				$gID=$group['id'];
				$checked = null;
				$item = null;
				foreach($currentGroups as $grp) {
					if ($gID == $grp->id) {
						$checked= ' checked="checked"';
					break;
					}
				}
			?>
			<input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
			<?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?>
			</label>
		</div>
	</div>
  <?php endforeach?>
</div>

<?php endif ?>
<?php echo form_hidden('id', $user->id);?>
<?php echo form_hidden($csrf); ?>

<div class="form-group">
  <div class="col-xs-offset-2 col-xs-10"> <?php echo form_submit('submit', $this->lang->line("update_user"), 'class="btn btn-primary"');?> </div>
</div>
<?php echo form_close();?>


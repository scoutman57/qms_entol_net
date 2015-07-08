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

<link href="<?php echo base_url();?>assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/fileinput.js" type="text/javascript"></script>

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

<div class="form-group">
  <label class="control-label col-xs-2" for="password"><?php echo $this->lang->line("pw"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($password , '', 'class="password form-control" id="password"');?> </div>
</div>
<div class="form-group">
  <label class="control-label col-xs-2" for="confirm_pw"><?php echo $this->lang->line("confirm_pw"); ?></label>
  <div class="col-xs-10"> <?php echo form_input($password_confirm , '', 'class="password form-control" id="confirm_pw"');?> </div>
</div>
<div class="form-group">
	<label class="control-label col-xs-2" for="photo">Photo</label>
  <div class="col-xs-10">
	<input id="file-0" class="file" type="file" multiple data-min-file-count="1">
	</div>
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
	<script>
    $("#file-0").fileinput({
        'allowedFileExtensions' : ['jpg', 'png','gif'],
    });
    $(document).ready(function() {
        $("#test-upload").fileinput({
            'showPreview' : false,
            'allowedFileExtensions' : ['jpg', 'png','gif'],
            'elErrorContainer': '#errorBlock'
        });
        /*
        $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
            alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
        });
        */
    });
	</script>

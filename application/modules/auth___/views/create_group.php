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

<h1><?php echo lang('create_group_heading');?></h1>
<p><?php echo lang('create_group_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php $attrib = array('class' => 'form-horizontal'); echo form_open("auth/create_group", $attrib);?>

		<div class="form-group">
			<label class="control-label col-xs-2" for="group_name"><?php echo lang('create_group_name_label', 'group_name');?> </label>
			<div class="col-xs-10"> <?php echo form_input($group_name , '', 'class="form-control" required="required" data-error="'.$this->lang->line("pw").' '.$this->lang->line("is_required").'"');?> </div>
		</div>
		<div class="form-group">
			<label class="control-label col-xs-2" for="description"><?php echo lang('create_group_desc_label', 'description');?></label>
			<div class="col-xs-10"> <?php echo form_input($description , '', 'class="form-control" required="required" data-error="'.$this->lang->line("confirm_pw").' '.$this->lang->line("is_required").'"');?> </div>
		</div>
		<div class="form-group">
			<div class="col-xs-offset-2 col-xs-10"> <?php echo form_submit('submit', $this->lang->line("create_group_submit_btn"), 'class="btn btn-primary "');?> </div>
		</div>

<?php echo form_close();?>
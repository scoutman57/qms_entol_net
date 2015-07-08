
        
    </div><!-- ./wrapper -->
<footer class="main-footer">
<div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
       <strong>Copyright &copy; 2014-2015 <a href="http://bcs-logistics.co.id">BCS Logistics</a>.</strong> All rights reserved.
</footer>
    <!-- jQuery 2.1.3 -->
	<!--script src="<?php //echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script-->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>   
	<script src="<?php echo base_url();?>xcrud/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>	
   <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	 <!-- Morris.js charts -->
    <script src="<?php echo base_url();?>assets/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url();?>assets/plugins/knob/jquery.knob.js" type="text/javascript"></script>
	    <!-- Slimscroll -->
    <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/select2.js"></script>
	<!-- XCRUD -->
	
	<script type="text/javascript">
jQuery(document).on("ready xcrudafterrequest", function(event, container) {
    if (container) {
        jQuery(container).find("select").select2({ width: '100%' });
    } else {
        jQuery(".xcrud").find("select").select2({ width: '100%' });
    }
});
jQuery(document).on("xcrudbeforedepend", function(event, container, data) {
    jQuery(container).find('select[name="' + data.name + '"]').select2("destroy");
});
jQuery(document).on("xcrudafterdepend", function(event, container, data) {
    jQuery(container).find('select[name="' + data.name + '"]').select2({ width: '100%' });
});
</script>
  </body>
</html>
          </section>
      </section>

      <!--main content end-->
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-6 col-xs-6 copyright">
						<div class="cpright">BCS-Logistics Copyright © 2014 • All rights reserved</div>
					</div>
				</div>
			</div>
		</div>
		<!--footer start

      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>-->
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <!--<script src="<?php //echo base_url();?>assets/js/jquery.js"></script>
    <script src="<?php //echo base_url();?>assets/js/jquery-1.8.3.min.js"></script>-->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="<?php echo base_url();?>assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="<?php echo base_url();?>assets/js/sparkline-chart.js"></script>    
	<script src="<?php echo base_url();?>assets/js/zabuto_calendar.js"></script>	

	<!-- XCRUD -->
	<script src="<?php echo base_url();?>assets/shCore.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/shBrushPhp.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/shBrushJScript.js" type="text/javascript"></script>

<link href="<?php echo base_url();?>assets/css/select2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/select2.js"></script>
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
	<script type="text/javascript">
		SyntaxHighlighter.all();
	</script> 
	<script src="<?php echo base_url();?>xcrud/plugins/bootstrap/js/bootstrap.min.js" ></script>
	<script>
		jQuery(document).ready(function($) {
			// jQuery('#nav-accordion').dcAccordion();
		});
		// jQuery(document).ready(function($) {
			// jQuery('#header_inbox_bar').dropdown();
		// });
	</script>    
	
	<script type="text/javascript">
        jQuery(document).ready(function () {
        // var unique_id = $.gritter.add({
            // // (string | mandatory) the heading of the notification
            // title: 'Welcome to Dashgum!',
            // // (string | mandatory) the text inside the notification
            // text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Developed by <a href="http://alvarez.is" target="_blank" style="color:#ffd777">Alvarez.is</a>.',
            // // (string | optional) the image to display on the left
            // image: 'assets/img/ui-sam.jpg',
            // // (bool | optional) if you want it to fade out on its own or just sit there
            // sticky: true,
            // // (int | optional) the time you want it to be alive for before fading out
            // time: '',
            // // (string | optional) the class name you want to apply to that specific message
            // class_name: 'my-sticky-class'
        // });

        return false;
        });
	</script>
	
	<script type="application/javascript">
        jQuery(document).ready(function () {
            jQuery("#date-popover").popover({html: true, trigger: "manual"});
            jQuery("#date-popover").hide();
            jQuery("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            jQuery("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            jQuery("#date-popover").hide();
            var nav = jQuery("#" + id).data("navigation");
            var to = jQuery("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>

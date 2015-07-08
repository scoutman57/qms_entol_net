	<script>
		jQuery(document).ready(function($) {
			// jQuery('#nav-accordion').dcAccordion();
		});
		// jQuery(document).ready(function($) {
			// jQuery('#header_inbox_bar').dropdown();
		// });
	</script>    
	
	<script type="text/javascript">
        $(document).ready(function () {
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
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
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
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>

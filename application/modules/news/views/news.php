<?php    	
	echo $content; 
		?>	
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(event,container){
    if(Xcrud.current_task == 'save')
    {
        Xcrud.show_message(container,'News Published ','success');
    }
});

</script>
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(){	
	jQuery("#youtube_url").change(function() {
		var youtube_url = jQuery("#youtube_url").val();
		console.log(youtube_url);
		jQuery.ajax({
			type: "POST",
			dataType: "text",
			data: { youtube_url:youtube_url },
			url: "<?php echo base_url();?>news/get_icon/",
			success: function(response) {
				jQuery('#icon').val(response);
			},
			error: function(response){
			}
		});	
	});
	jQuery("#youtube_url").change(function() {
		var youtube_url = jQuery("#youtube_url").val();
		console.log(youtube_url);
		jQuery.ajax({
			type: "POST",
			dataType: "text",
			data: { youtube_url:youtube_url },
			url: "<?php echo base_url();?>news/get_frame/",
			success: function(response) {
				jQuery('#frame').val(response);
			},
			error: function(response){
			}
		});	
	});
});	
</script>
<?php echo $content;  ?>
<link href="<?php echo base_url();?>assets/css/select2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/select2.js"></script>
<script type="text/javascript">
jQuery(document).on("xcrudbeforerequest", function(event, container) {
    if (container) {
        jQuery(container).find("select").select2("destroy");
    } else {
        jQuery(".xcrud").find("select").select2("destroy");
    }
});
jQuery(document).on("ready xcrudafterrequest", function(event, container) {
    if (container) {
        jQuery(container).find("select").select2({ width: '100%' });
    } else {
				// alert(container);
        jQuery(".xcrud").find("select").select2({ width: '100%' });
    }
});
jQuery(document).on("xcrudbeforedepend", function(event, container, data) {
    jQuery(container).find('select[name="' + data.name + '"]').select2("destroy");
});
jQuery(document).on("xcrudafterdepend", function(event, container, data) {
    jQuery(container).find('select[name="' + data.name + '"]').select2({ width: '100%' });
});

jQuery(document).on("xcrudafterrequest",function(){	
	//if(Xcrud.current_task == 'create')
	//{	
		jQuery("#project").change(function() {
			var f = jQuery(this).val();	
			// alert('ttttt');
			jQuery.ajax({
					 type: "POST",
					 dataType: "text",
					 url: "<?php echo base_url();?>trans_material_return/create_mr_no/"+f,
					 success: function(response) {
						// alert(response);
						jQuery('#mr_no').val(response);
					 },
					 error: function(response){
						alert("error");
					 },
					 complete: function(response){
					 // alert("complete");
					 }
					});	
		});	
	//}	
});	
</script>
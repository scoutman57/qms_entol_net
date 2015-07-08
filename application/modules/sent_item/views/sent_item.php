<section class="content-header"><h1>Sent Item<small>Sent Item</small></h1><ol class="breadcrumb"></section>  </br>
<?php    	
	echo $content; 
		?>	
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(event,container){
    if(Xcrud.current_task == 'remove')
    {
        Xcrud.show_message(container,'Message deleted ','error');
    }
});

</script>
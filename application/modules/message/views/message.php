<section class="content-header"><h1>Message<small>write</small></h1><ol class="breadcrumb"></section>  </br>
<?php    	
	echo $content; 
		?>	
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(event,container){
    if(Xcrud.current_task == 'save')
    {
        Xcrud.show_message(container,'Message Send ','success');
    }
});

</script>
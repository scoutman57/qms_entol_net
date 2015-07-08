</br>
 <h3 class="title">Purchase Requisition</h3>
 <ul class="nav nav-tabs">
<!-- Untuk Semua Tab.. pastikan a href=”#nama_id” sama dengan nama id di “Tap Pane” dibawah-->
  <li class="active"><a href="#pr" data-toggle="tab">Create & Edit</a></li> <!-- Untuk Tab pertama berikan li class=”active” agar pertama kali halaman di load tab langsung active-->
  <li><a href="#print" data-toggle="tab">Print PR</a></li>
  <li><a href="#outstandingpr" data-toggle="tab">Outstanding PR</a></li>

  </ul>
 <div class="tab-content">
  <div class="tab-pane active" id="pr" > <!-- Untuk pdf-->
  <div class="col-lg-12"></br>
    <?php   echo $content;   ?>
  <div class="col-lg-12">
			
		
</div>
	</div>		
  
  
  </div>
  <div class="tab-pane" id="print"> <!-- Untuk excell-->
  <iframe src="<?php echo "http://".$_SERVER['HTTP_HOST'];?>:8080/jasperserver/flow.html?_flowId=viewReportFlow&standAlone=true&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2Fss_print_pr&decorate=no&j_username=jasperadmin&j_password=jasperadmin&userLocale=id_ID" frameBorder="0" style="overflow:hidden;height:500;width:100%" height="500" width="100%"></iframe>	
	
  </div>
 <div class="tab-pane" id="outstandingpr">
  <div class="col-lg-12"></br>
 <?php
  echo $content3; ?>
	</div>		
	
  </div>
  
  </div>   
  
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(){	
jQuery("#status").change(function() {
var e = jQuery("#status").val();	
var f = jQuery('#project').val();	
	// alert('ttttt');
		jQuery.ajax({
				 type: "POST",
				 dataType: "text",
				 url: "<?php echo base_url();?>trans_purchase/create_no_pr/"+e+"/"+f,
				 success: function(response) {
					// alert(response);
					jQuery('#pr_no').val(response);
					//location.reload();
				 },
				 error: function(response){
					alert("error");
				 },
				 complete: function(response){
				 // alert("complete");
				 }
				});	
	});

});	
</script>
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(){	
jQuery("#project").change(function() {
	// alert('ttttt');
		jQuery.ajax({
				 type: "POST",
				 dataType: "text",
				 url: "<?php echo base_url();?>trans_purchase/no_urut/",
				 success: function(response) {
					// alert(response);
					jQuery('#no_urut').val(response);
				 },
				 error: function(response){
					alert("error");
				 },
				 complete: function(response){
				 // alert("complete");
				 //location.reload();
				 }
				});	
	});

});	
</script>
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(){	
jQuery("#prepared").change(function() {
var e = jQuery("#prepared").val();	
	// alert('ttttt');
		jQuery.ajax({
				 type: "POST",
				 dataType: "text",
				 url: "<?php echo base_url();?>trans_purchase/ambilprepared/"+e,
				 success: function(response) {
					// alert(response);
					jQuery('#request_by').val(response);
				 },
				 error: function(response){
					alert("error");
				 },
				 complete: function(response){
				 // alert("complete");
				 }
				});	
	});

});	
</script>
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(){	
jQuery("#material_id").change(function() {
	// alert('ttttt');
		jQuery.ajax({
				 type: "POST",
				 dataType: "text",
				 url: "<?php echo base_url();?>trans_purchase/buat_pr_id/",
				 success: function(response) {
					// alert(response);
					jQuery('#pr_id').val(response);
				 },
				 error: function(response){
					alert("error");
				 },
				 complete: function(response){
				 // alert("complete");
				// location.reload();
				 }
				});	
	});

});	
</script>


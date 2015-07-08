 <h3 class="title">Warehouse Receipt Slip  Non PR</h3>
 <ul class="nav nav-tabs">
<!-- Untuk Semua Tab.. pastikan a href=”#nama_id” sama dengan nama id di “Tap Pane” dibawah-->
  <li class="active"><a href="#grnpr" data-toggle="tab">WRS Non PR</a></li> <!-- Untuk Tab pertama berikan li class=”active” agar pertama kali halaman di load tab langsung active-->
  <li><a href="#printnonprgrn" data-toggle="tab">Print WRS</a></li>
  </ul>
 <div class="tab-content">
  <div class="tab-pane active" id="grnpr" > <!-- Untuk pdf-->
  <div class="col-lg-12"></br>
    <?php echo $content2;  ?>
  <div class="col-lg-12">
	
		
</div>
	</div>		
  
  
  </div>
  <div class="tab-pane" id="printnonprgrn"> <!-- Untuk excell-->
  <div class="col-lg-12"></br>
<iframe src="<?php echo "http://".$_SERVER['HTTP_HOST'];?>:8080/jasperserver/flow.html?_flowId=viewReportFlow&standAlone=true&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2FWarehouse_Receipt_Slip_Non_PR&decorate=no&j_username=jasperadmin&j_password=jasperadmin&userLocale=id_ID" frameBorder="0" style="overflow:hidden;height:500;width:100%" height="500" width="100%"></iframe>
  
  
	</div>		
	
  </div> 
  
  </div>       

<script type="text/javascript">

//jQuery(document).on("xcrudafterrequest",function(){
$(document).ready(function(){
   $(".xcrud").on("keyup","#qty,#price",function(){ 
  // alert('test');
      var f1 = parseFloat($("#qty").val());
      var f2 = parseFloat($("#price").val());
      if(!isNaN(f1) && !isNaN(f2)){
         $("#total").val(f2*f1);
      }
      else{
         $("#total").val("");
      }
   });
});
//});
</script>
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(){	
jQuery("#project_code").change(function() {
var r = jQuery("#project_code").val();	
	// alert(r);
		jQuery.ajax({
				 type: "POST",
				 dataType: "text",
				 data: { project_code:r },
				 url: "<?php echo base_url();?>grn_non_pr/generate_wrs/"+r,
				 success: function(response) {
					 // alert(response);
					jQuery('#lpb_no').val(response);
				 },
				 error: function(response){
					//alert("error");
				 },
				 complete: function(response){
				 // alert("complete");
				// location.reload();
				 }
				});	
	});

});	
</script>
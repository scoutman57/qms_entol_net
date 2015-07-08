 <h3 class="title">Warehouse Receipt Slip</h3>
 <ul class="nav nav-tabs">
<!-- Untuk Semua Tab.. pastikan a href=”#nama_id” sama dengan nama id di “Tap Pane” dibawah-->
  <li class="active"><a href="#grnpr" data-toggle="tab">WRS PR</a></li> <!-- Untuk Tab pertama berikan li class=”active” agar pertama kali halaman di load tab langsung active-->
  <li><a href="#print" data-toggle="tab">Print WRS</a></li>
  <li><a href="#view_wrs" data-toggle="tab">View WRS</a></li>
  <!--li><a href="#outstandingpr" data-toggle="tab">Outstanding PR</a></li-->
  </ul>
 <div class="tab-content">
  <div class="tab-pane active" id="grnpr" > <!-- Untuk pdf-->
  <div class="col-lg-12"></br>
    <?php echo $content;  ?>
  <div class="col-lg-12">
	
		
</div>
	</div>		
  
  
  </div>
  <div class="tab-pane" id="print"> <!-- Untuk excell-->
  <div class="col-lg-12"></br>
<iframe src="<?php echo "http://".$_SERVER['HTTP_HOST'];?>:8080/jasperserver/flow.html?_flowId=viewReportFlow&standAlone=true&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2FWarehouse_Receipt_Slip&decorate=no&j_username=jasperadmin&j_password=jasperadmin&userLocale=id_ID" frameBorder="0" style="overflow:hidden;height:500;width:100%" height="500" width="100%"></iframe>	
	</div>		
	
  </div>
  <div class="tab-pane" id="view_wrs">
  <div class="col-lg-12"></br>
 <?php
  echo $content4; ?>
	</div>		
	
  </div> 
  
  </div>       
<script type="text/javascript">
jQuery(document).ready(function(){
   jQuery(".xcrud").on("keyup","#qty,#price",function(){ 
      var f1 = parseFloat(jQuery("#qty").val());
      var f2 = parseFloat(jQuery("#price").val());
      if(!isNaN(f1) && !isNaN(f2)){
         jQuery("#total").val(f2*f1);
      }
      else{
         jQuery("#total").val("");
      }
   });
});
</script>
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(){	
	jQuery("#po").change(function() {
		var r = jQuery("#po").val();
		jQuery.ajax({
			type: "POST",
			dataType: "text",
			data: { po:r },
			url: "<?php echo base_url();?>grn/generate_wrs/",
			success: function(response) {
				jQuery('#lpb_no').val(response);
			},
			error: function(response){
			}
		});
	});
	jQuery("#po_item_id").change(function() {
		var po_item_id = jQuery("#po_item_id").val();
		console.log(po_item_id);
		jQuery.ajax({
			type: "POST",
			dataType: "text",
			data: { po_item_id:po_item_id },
			url: "<?php echo base_url();?>grn/get_unit/",
			success: function(response) {
				jQuery('#unit').val(response);
			},
			error: function(response){
			}
		});	
	});
});	
</script>

 <h3 class="title">Work Order</h3>
 <ul class="nav nav-tabs">
<!-- Untuk Semua Tab.. pastikan a href=”#nama_id” sama dengan nama id di “Tap Pane” dibawah-->
  <!-- Untuk Tab pertama berikan li class=”active” agar pertama kali halaman di load tab langsung active-->
  </ul>
 <div class="tab-content">
  <div class="tab-pane active" id="wo" > <!-- Untuk pdf-->
  <div class="col-lg-12"></br>
    <?php echo $content;  ?>
  <div class="col-lg-12">
	
		
</div>
	</div>	

<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(){
	if(Xcrud.current_task == 'create')
    {
		jQuery("#user_group").val('<?php echo GROUPDESC; ?>');
		jQuery("#nomor_unit").change(function() {
			var nomor_unit = jQuery("#nomor_unit").val();
			jQuery.ajax({
				type: "POST",
				dataType: "text",
				data: { nomor_unit:nomor_unit },
				url: "<?php echo base_url();?>wo/generate_wo/",
				success: function(response) {
					//alert(response);
					jQuery('#wo_no').val('');
					jQuery('#wo_no').val(response);
				},
				error: function(response){
					alert("Autogenerate WO Number Error");
				}
			});
			
			jQuery.ajax({
				type: "POST",
				dataType: "json",
				data: { nomor_unit:nomor_unit },
				url: "<?php echo base_url();?>wo/get_customer/",
				success: function(response) {
					//alert(response['pemilik']);
					
					jQuery('#project_code').val('');
					jQuery('#project_code').val(response['project_code']);
					jQuery('#vendor').val('');
					jQuery('#vendor').val(response['pemilik']);
					jQuery('#no_rangka').val('');
					jQuery('#no_rangka').val(response['no_rangka']);
					jQuery('#nama_tipe').val('');
					jQuery('#nama_tipe').val(response['nama_tipe']);
					jQuery('#no_lambung').val('');
					jQuery('#no_lambung').val(response['no_lambung']);
				},
				error: function(response){
					alert("Nomor Unit Error");
				}
			});	
		});
		
	}
	
	jQuery(".qty_price").change(function() {
		var qty = jQuery('#qty').val();
		var op_price = jQuery('#op_price').val();
		jQuery('#op_total').val(qty*op_price);
		
	});
});	

</script>

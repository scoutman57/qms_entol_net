<?php 
echo $content; 

?>
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(){	
	jQuery("#no_kontrak").change(function() {
		var e = jQuery('select[id=no_kontrak]').val();
		var f = jQuery('#no_kontrak').val();
		getcust(e);
	})
	jQuery("#nomor_unit").change(function() {	    
		jQuery.ajax({
				 type: "POST",
				 dataType: "text",
				 url: "/invoice/dn/getNamaSupir/"+jQuery("#nomor_unit").val(),
				 success: function(response) {
					jQuery('#kode_supir').val(response);
				 },
				 error: function(response){
					alert("error");
				 },
				 complete: function(response){
				 //alert("complete");
				 }
				});	
	})	
	jQuery("#kode_route").change(function() {	
		
		var e = jQuery('select[id=no_kontrak]').val();
		var f = jQuery("#kode_route").val();
		var f1 = jQuery("#kode_route :selected").text();
		var h = jQuery("#opt_tarif").val() ;
		gettarif(e,f,h);
	})	

	jQuery("#kode_satuan_berat").change(function() {		
		var e = jQuery('select[id=no_kontrak]').val();
		var f = jQuery("#kode_route").val();
		var h = jQuery("#opt_tarif").val() ;
		gettarif(e,f,h);
	})	

	jQuery("#kode_produk").change(function() {				
		var e = jQuery('select[id=no_kontrak]').val();
		var f = jQuery("#kode_route").val();
		var h = jQuery("#opt_tarif").val() ;
		gettarif(e,f,h);
	})	
	
	jQuery("#berat").change(function() {
		hitungtotal();
	})	
	jQuery("#kode_satuan_berat").change(function() {
		hitungtotal();
	})	
	jQuery("#jumlah").change(function() {
		hitungtotal();
	})	
	jQuery("#kode_satuan_jum").change(function() {
		hitungtotal();
	})	
	jQuery("#tarif_detail").change(function() {
		hitungtotal();
	})	
	jQuery("#kode_satuan_tarif").change(function() {
		hitungtotal();
	})	
	jQuery("#jum_multidrop").change(function() {
		if (jQuery("#jum_multidrop").val() > 0){
			jQuery("#tarif_header").val(0);
		} else {
			// alert(jQuery("#jum_multidrop").val());
			fn_opt_tarif();
		}
	})	
});
function fn_opt_kustomer(){
		var h = jQuery("input[id='opt_kustomer']:checked").val();

		if (h=='KS - Import'){
			jQuery("#kode_produk").val('SLAB');
			getdescust(h);
		} else if (h=='KS - Posco'){
			jQuery("#kode_produk").val('SLAB');
			getdescust(h);
		} else if (h=='KS - Delta'){
			getdescust(h);
		} else if (h=='KS - Domestik'){
			getdescust(h);
		} else {
			jQuery("#kode_produk").val();
		}
}
function fn_opt_tarif(){
		var e = jQuery('select[id=no_kontrak]').val();
		var f = jQuery("#kode_route").val() ;
		var h = jQuery("input[id='opt_tarif']:checked").val();
		gettarif(e,f,h);
}
function getdescust(h){
	jQuery.ajax({
			 type: "POST",
			 dataType: "text",
			 url: "/invoice/dn/getNoKontrakImport/"+h,
			 success: function(response) {
				// alert(response);
				jQuery('#no_kontrak').val(response);
				getcust(response);
				//console.log(response);
				//jQuery('#no_kontrak').val();
			 },
			 error: function(response){
				alert("error");
			 },
			 complete: function(response){
			 //alert("complete");
			 }
			});
}
function gettarif(f,h,i){		
	var s = jQuery("input[id='opt_kustomer']:checked").val();
	var t = jQuery('select[id=kode_produk]').val();
	var u = jQuery('select[id=nomor_unit]').val();
	//jQuery.ajax({
	//		 type: "POST",
	//		 dataType: "text",
	//		 url: "/invoice/dn/getTarif/"+f+"/"+h+"/"+i+"/"+s+"/"+t+"/"+u,
	//		 success: function(response) {
	//			 alert(response);
	//		 },
	//		 error: function(response){
	//			alert("error");
	//		 },
	//		 complete: function(response){
	//		 //alert("complete");
	//		 }
	
	//});
	jQuery.getJSON("/invoice/dn/getTarif/"+f+"/"+h+"/"+i+"/"+s+"/"+t+"/"+u, function(jd) {
		var x = jd.tarif;
		var y = jd.satuan_tarif;
		var z = jd.tarif_multidrop;
		var w = jd.tarif_lift_of;
		if (y == 'Rit'){
			jQuery('#tarif_header').val(x);
			jQuery('#tarif_multidrop').val(z);
			jQuery('#tarif_lift_of').val(w);
		} else if (y == 'Berat'){
			jQuery('#tarif_detail').val(x);
			hitungtotal();
		}
	});
}
function getcust(f){
	jQuery.ajax({
			 type: "POST",
			 dataType: "text",
			 url: "/invoice/dn/getCustByKontrak/"+f,
			 success: function(response) {
			 },
			 error: function(response){
				alert("error");
			 },
			 complete: function(response){
			 //alert("complete");
			 }
			});
}
function getproj(f){
	jQuery.ajax({
			 type: "POST",
			 dataType: "text",
			 url: "/invoice/dn/getProjByKontrak/"+f,
			 success: function(response) {
				// alert(response);
				if (response.length = 5){
					jQuery('#no_proyek').val(response);
					// jQuery("#no_proyek").prop("disabled", true);
					//console.log(response);
					//jQuery('#no_kontrak').val();
				} else {
					jQuery("#no_proyek option[value='']").removeAttr('disabled');
					// jQuery("#no_proyek").attr('disabled', false).trigger("liszt:updated");
					// jQuery("#no_proyek").val('').trigger("liszt:updated");
				}
			 },
			 error: function(response){
				// alert("error");				
			 },
			 complete: function(response){
			 //alert("complete");
			 }
			});
}
function hitungtotal(){
	var a = jQuery("#tarif_detail").val();
	var b = jQuery("#berat").val();
	var c = jQuery("#jumlah").val();
			jQuery('#total').val(a*b);
}
</script>


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

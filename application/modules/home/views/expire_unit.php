<script src="<?php echo base_url();?>assets/js/morris-0.4.3.min.js"></script>		
<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>


<!--common script for all pages-->
<script src="<?php echo base_url();?>assets/js/common-scripts.js"></script>

<!--script for this page-->
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

				</style>	<script type="text/javascript" src="<?php echo base_url();?>assets/js/tableExport.js"></script>
				<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.base64.js"></script>
				<script type="text/javascript" src="<?php echo base_url();?>assets/js/html2canvas.js"></script>
				<script type="text/javascript" src="<?php echo base_url();?>assets/js/jspdf/libs/sprintf.js"></script>
				<script type="text/javascript" src="<?php echo base_url();?>assets/js/jspdf/jspdf.js"></script>
				<script type="text/javascript" src="<?php echo base_url();?>assets/js/jspdf/libs/base64.js"></script>

<style type="text/css" class="init">
	tr.group,
	tr.group:hover {
	background-color: #ddd !important;
	}
	tfoot input {
			width: 100%;
			padding: 3px;
			box-sizing: border-box;
	}	
</style>

<script type="text/javascript" class="init">
$(document).ready(function() {
	$('#example').dataTable( {		
		"order": [[ 4, 'asc' ]],
		"displayLength": 10,
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"processing": true,
		"serverSide": true,
		"ajax": {
								"url": "<?php echo base_url();?>home/getdatatableajax",
								"type": "POST"
						},
		"columns": [
				{ className: "dt-center" , "width": "2%" },
				{ className: "dt-center" , "width": "2%" },
				{ className: "dt-center" , "width": "2%" },
				{ className: "dt-center" , "width": "2%" },
				{ className: "dt-center" , "width": "2%" },
				{ className: "dt-center" , "width": "2%" }
			],
		"dom": 'T<"clear">lfrtip',
		tableTools: {
				"sSwfPath": "<?php echo base_url();?>assets/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
		}
	} );
		
	// Order by the grouping
	$('#example tbody').on( 'click', 'tr.group', function () {
			var currentOrder = table.order()[0];
			if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
					table.order( [ 2, 'desc' ] ).draw();
			}
			else {
					table.order( [ 2, 'asc' ] ).draw();
			}
	} );

	$('#back').click(function(){
			parent.history.back();
			return false;
	});	
	
} );

	</script>
<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
</script>	
<h3 class="title"><?php echo $page_title;?></h3>
<p id="date_filter">
<div class="btn-group">
							<button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
							<ul class="dropdown-menu " role="menu">
								<li><a href="#" onClick ="$('#example').tableExport({type:'json',escape:'false'});"> <img src='<?php echo base_url();?>assets/icons/json.png' width='24px'> JSON</a></li>
								<li><a href="#" onClick ="$('#customers').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"> <img src='<?php echo base_url();?>assets/icons/json.png' width='24px'> JSON (ignoreColumn)</a></li>
								<li><a href="#" onClick ="$('#example').tableExport({type:'json',escape:'true'});"> <img src='<?php echo base_url();?>assets/icons/json.png' width='24px'> JSON (with Escape)</a></li>
								<li class="divider"></li>
								<li><a href="#" onClick ="$('#example').tableExport({type:'xml',escape:'false'});"> <img src='<?php echo base_url();?>assets/icons/xml.png' width='24px'> XML</a></li>
								<li><a href="#" onClick ="$('#example').tableExport({type:'sql'});"> <img src='<?php echo base_url();?>assets/icons/sql.png' width='24px'> SQL</a></li>
								<li class="divider"></li>
								<li><a href="#" onClick ="$('#example').tableExport({type:'csv',escape:'false'});"> <img src='<?php echo base_url();?>assets/icons/csv.png' width='24px'> CSV</a></li>
								<li><a href="#" onClick ="$('#example').tableExport({type:'txt',escape:'false'});"> <img src='<?php echo base_url();?>assets/icons/txt.png' width='24px'> TXT</a></li>
								<li class="divider"></li>				
								
								<li><a href="#" onClick ="$('#example').tableExport({type:'excel',escape:'false'});"> <img src='<?php echo base_url();?>assets/icons/xls.png' width='24px'> XLS</a></li>
								<li><a href="#" onClick ="$('#example').tableExport({type:'doc',escape:'false'});"> <img src='<?php echo base_url();?>assets/icons/word.png' width='24px'> Word</a></li>
								<li><a href="#" onClick ="$('#example').tableExport({type:'powerpoint',escape:'false'});"> <img src='<?php echo base_url();?>assets/icons/ppt.png' width='24px'> PowerPoint</a></li>
								<li class="divider"></li>
								<li><a href="#" onClick ="$('#example').tableExport({type:'png',escape:'false'});"> <img src='<?php echo base_url();?>assets/icons/png.png' width='24px'> PNG</a></li>
								<li><a href="#" onClick ="$('#example').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> <img src='<?php echo base_url();?>assets/icons/pdf.png' width='24px'> PDF</a></li>
								
								
							</ul>
						</div>		

</p>

<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No. Polisi</th>
                <th>Bussiness Unit</th>
                <th>Jenis Surat</th>
                <th>Tanggal Expire</th>
                <th>Hari</th>
                <th>Status</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>No. Polisi</th>
                <th>Bussiness Unit</th>
                <th>Jenis Surat</th>
                <th>Tanggal Expire</th>
                <th>Hari</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>
<br><br>		

<section class="content-header">
<h1>
Master Unit
<small>Unit</small>
</h1>
<ol class="breadcrumb">
</section>
</br>
 <ul class="nav nav-tabs">
<!-- Untuk Semua Tab.. pastikan a href=”#nama_id” sama dengan nama id di “Tap Pane” dibawah-->
  <li class="active"><a href="#vehicle" data-toggle="tab">Vehicle</a></li> <!-- Untuk Tab pertama berikan li class=”active” agar pertama kali halaman di load tab langsung active-->
  <li><a href="#unit_type" data-toggle="tab">Vehicle Type</a></li>
  <li><a href="#model_dan_product" data-toggle="tab">Model & Product</a></li>
  </ul>
 <div class="tab-content">
  <div class="tab-pane active" id="vehicle" > <!-- Untuk pdf-->
  <div class="col-lg-12"></br>
    <?php   
		echo $content;   
	?>
  <div class="col-lg-12">
			
		
</div>
	</div>		
  
  
  </div>
  <div class="tab-pane" id="unit_type"> <!-- Untuk excell-->
  <div class="col-lg-12"></br>
		<?php    	
			echo $content2; 
		?>	
	</div>		
	
  </div>
   <div class="tab-pane" id="model_dan_product"> <!-- Untuk excell-->
  <div class="col-lg-12"></br>
		<?php    	
			echo $content3; 
		?>	
	</div>		
	
  </div>
  
  </div> 

	<div class="no-border">
<?php foreach($results as $data) { ?>
 <section class="content-header"><h1><?php echo $data->judul;?><small>Inbox</small></h1><ol class="breadcrumb"></section>  </br>
          <!--div class="callout callout-info">
            <h4>Warning!</h4>
            <p>This documentation is under development. Some information may change as the progress of creating the documentation continues.</p>
          </div--> 
          <!-- Default box -->
		 <div  class="col-md-8">
          <div class="box box-info ">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $data->judul;?></h3> 
				<div>
					<small style="text-align:right">Author :<cite title="Source Title"> <?php echo $data->author;?> </cite>  <cite title="Source Title"></cite></small></div>
              <div class="box-tools pull-right" >
				
			   <!--button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button-->
               <?php if(access == "admin" ){ ?>  <button id="id_artikel" value="<?php echo $data->id;?>" onclick="edit_post()" class="btn btn-box-tool" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button> <?php } ?>
              </div>
            </div>
			<div class="box-header with-border">
			</div>
            <div class="box-body"> <span><img src="<?php echo base_url();?>uploads/<?php echo $data->gambar;?>" align="left" class="thumbnail" alt="User Image"/></span>
		<?php echo $data->artikel;?> 
           </div> <!-- /.box-body -->
		<?php }?>
            <div class="box-footer">
             <small style="text-align:center">Author :<cite title="Source Title"> <?php echo $data->author;?> </cite></small>
            </div>
			<div class="box-header with-border">
			<!-- Posicione esta tag no cabeçalho ou imediatamente antes da tag de fechamento do corpo. -->
			<script src="https://apis.google.com/js/platform.js" async defer>
			  {lang: 'id'}
			</script>

			<!-- Posicione esta tag onde você deseja que o botão +1 apareça. -->
			<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300"></div>
			</div>
			<div class="box-footer">
			<script src="https://apis.google.com/js/plusone.js"></script>
			<div class="g-comments" data-href="http://<?php
															$request_url = apache_getenv("HTTP_HOST") . apache_getenv("REQUEST_URI");
															echo $request_url;
															?>" data-width="900" data-first_party_property="BLOGGER" data-view_type="FILTERED_POSTMOD">
			</div>
			 <!--div class="fb-comments" data-href="http://<?php
															// $request_url = apache_getenv("HTTP_HOST") . apache_getenv("REQUEST_URI");
															// echo $request_url;
															?>" data-width="100%" data-numposts="5">
			  </div-->
			</div>
		
			 
          </div><!-- /.box -->
        </div>
	  <!-- quick email widget -->
	
	<!-- /Widget-->
	
	
	 <div class="col-md-4">
              <!-- PRODUCT LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"> Artikel Terkait</h3>
                  <div class="box-tools pull-right">
                    <!--button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
				  <?php		foreach ($test->result() as $row)
							{ ?>                           <!-- loop artikel terbaru-->
                    <li class="item">
                      <div class="product-img">
                        <img src="<?php echo base_url();?>uploads/<?php echo  $row->gambar_widget; ?>" alt="Bcs Art Image"/>
                      </div>
                      <div class="product-info"> 	
                        <a href="<?php echo base_url();?>timeline/baca_artikel?news_id=<?php echo $row->id_widget; ?>" class="product-title"><?php echo  $row->judul_widget; ?><span class="label label-warning pull-right"><?php echo  $row->tanggal_widget; ?></span></a>
                        <span class="product-description">
                <?php 			$str =$row->artikel_widget;
								$length = strlen($str);
								if ($length < 200) {
									$str .= str_repeat('&nbsp', 500 - $length);
								} else {
									$str = substr($str, 0,300);
								}
								echo htmlspecialchars_decode ($str)."...."; ?> 
                        </span>
                      </div>
                    </li><!-- /.item -->
				   <?php    } ?>											 <!-- endloop artikel terbaru-->
                  </ul>
                </div><!-- /.box-body --> diserahkan oleh
                
              </div><!-- /.box -->
            </div><!-- /.col -->
			 <!-- Calendar -->
		 <div class="col-md-4"> <!--carosoul -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Galery</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
 <?php		foreach ($carousel_indicators->result() as $indicators) { ?>   
                      <li data-target="#carousel-example-generic" data-slide-to="<?php echo $indicators->id; ?>" class="active"></li>
																<?php } ?>
                    </ol>
                    <div class="carousel-inner">
<?php		foreach ($carousel_indicators->result() as $carousel) { ?> 
                      <div class="item">
                        <img src="<?php echo base_url();?>uploads/<?php echo  $carousel->gambar; ?>" alt="First slide">
                        <div class="carousel-caption">
                       <?php echo  $carousel->judul; ?>
                        </div>
                      </div><?php } ?>
                      
                     
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div><!-- end carousoul botstrap  -->
<!-- /end calender-->		  
		 <div class="row">
          
            </div><!-- ./col -->
	
	</div><!-- ./col --> 
</section>

<script type="text/javascript">

function edit_post(){       	
	var y = document.getElementById("id_artikel").value;
	//alert(y);  
	window.location = "<?php echo base_url();?>news/edit_post/"+y;
	}  
</script>
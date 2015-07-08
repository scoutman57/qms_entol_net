 <!DOCTYPE html>
<html lang="en">
	<head><title>BCS - Logistics | Quality Management</title>
	<link rel="shortcut icon" href="images/favicon.png">
    <link href="<?php echo base_url();?>assets/css/entol.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/entol-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/docs.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/js/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/entol.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/entol-responsive.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/bootstrap-combobox.css" media="screen" rel="stylesheet" type="text/css">
	</head>
	 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
        <a class="brand" href="<?php echo base_url();?>"><img src ="<?php echo base_url();?>assets/img/templatemo_logo_new.png" width="70" height="30" title ='home'>   BCS - Logistics</a>
        <div class="container">
            <ul class="nav">
			 <li class="dropdown" id="menu1" > 
         <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" ><i class="icon-home"></i> BCS Logistics Quality Management  <b class="caret"></b></a>
					<ul class="dropdown-menu">
                     <li class="dropdown-submenu">
						<a  href="javascript:void(0)"><i class=" icon-tasks"></i> Bahasa </a>
						<ul class="dropdown-menu">
					 <li><a href="javascript:void(0)" id="bahasa_indonesia"> Bahasa Indonesia</a></li>
					  <li><a href="javascript:void(0)"id="English">  English</a></li>
					   <li><a href="javascript:void(0)"id="Italiano">  Italiano</a></li>
					    <li><a href="javascript:void(0)"id="Nederlands">  Nederlands</a></li>
						</ul>
						</li>
				
					  <li class="nav-header"> BCS - Logistics</li>
					  <li><a href="http://www.bcs-logistics.co.id/"> <i class=" icon-globe"></i> BCS - Logistics Site</a></li>
					  <li><a href="http://www.bcs-logistics.co.id/webmail"/> <i class=" icon-envelope"> </i> Webmail BCS - Logistics</a></li>
					  <li><a href="javascript:void(0)"> <i class="icon-info-sign"></i> Tentang BCS - Logistics</a></li>
					  <li><a href="javascript:void(0)"> <i class="icon-question-sign"></i> Bantuan</a></li>

			  </ul>
          </div>
        </div>
        </div>
    </div>
	

  <body>
<?php if($message) { echo "</br><div class=\"alert container alert-danger alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message .  "</div>"; } ?>
   <div id class="container" style="padding-top: 100px;" >
    <?php $attrib = array('class' => 'form-signin1','align'=>'left'); echo form_open("auth/login",$attrib);?>
         <?php echo form_input($identity, '', 'class="input-block-level-entol1" placeholder="'.$this->lang->line("email_address").'" autofocus="autofocus"');?></br>
           <?php echo form_input($password,  '', 'class="input-block-level-entol-password" placeholder="'.$this->lang->line("pw").'"');?>
		  <button class="btn btn-primary"  type="submit" onclick="javascript:submit_login()" >Masuk</button> 
          <label class="checkbox"> <input type="checkbox" value="remember-me"> <font color="grey" size= '-7' >  Ingatkan saya | Belum mendaftar ?
          </font></label>
	  <?php echo form_close();?></div></br>
	  <div id class="container" style=" padding-top: 120px;">
      <form action="registrasi/daftar-baru" method="pos" form class="form-signin1" align ="left" >
          <span class="form-signin-heading">Baru di BCS? Daftar </span></br></hr></hr>
          <input type="NUMBER" size="5" name="NIK"  id="NIK" placeholder="Nik Anda" class="input-xlarge"  required="true"></br>
		   <input type="text" class="input-block-level-entol1" placeholder="Email Anda" autocomplete="off"  name="EMAIL" ></br>
          <input type="Password" class="input-block-level-entol1" placeholder="Password" autocomplete="off" name="PASSWORD" ></br>
		  <button class="btn btn-warning" id="lg_ok"  type="submit" onclick="javascript:submit_login()" ><font color="Black" > Daftar Sekarang</font></button> 
          </label>
	  </form></div>
<div id class="container"  style="padding-top:-230px;"  align="right" > 
<span><img src ="http://localhost/self/assets/img/templatemo_logo_new.png" width="200" height="60"  > </span>
<h4> BCS Logistics Quality Management</h4> 
</div>	  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->


<div region="south" split="true" style=" padding-top: 180px;">
<div class="container"  split="true" style="height:10; " align="left" > 
 <font size= '-5'> All Contens are Copyright © 2012-2013 <a href="http://www.bcs-logistics.co.id" data-toggle="tooltip" title=" BCS Logistics Daily Reports " > BCS Logistics</a> System All rights reserved. </div>
</font></div>
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-transition.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-alert.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-modal.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-dropdown.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-scrollspy.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-tab.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-tooltip.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-popover.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-button.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-collapse.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-carousel.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-typeahead.js"></script>
<script src="<?php echo base_url();?>assets/js/entol-combobox.js" type="text/javascript"></script>
</body> </html>
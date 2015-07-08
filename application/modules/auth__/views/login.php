<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Invoice Monitoring System</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">

		  <?php $attrib = array('class' => 'form-login'); echo form_open("auth/login",$attrib);?>
			<h2 class="form-login-heading"><?php echo SITE_NAME;?></h2>
			<?php if($message) { echo "<div class=\"alert alert-danger alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
			<?php if($success_message) { echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>							
			
			<div class="login-wrap">
				<?php echo form_input($identity, '', 'class="form-control" placeholder="'.$this->lang->line("email_address").'" autofocus="autofocus"');?>
				<br>
				<?php echo form_input($password,  '', 'class="form-control" placeholder="'.$this->lang->line("pw").'"');?>
				<div class="checkbox">
					<label>
						<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> Remember me
					</label>
				</div>
				<label class="checkbox">
					<span class="pull-right">
						<a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
	
					</span>
				</label>
				<button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
				<hr>
				<div class="login-social-link centered">
				<p>or you can sign in via your social network</p>
					<button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
					<button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
				</div>
				<div class="registration">
					Don't have an account yet?<br/>
					<a data-toggle="modal" class="" href="login.html#myModalRegister">
						Create an account
					</a>
				</div>
	
			</div>
	
			  <!-- Modal -->
			  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
				  <div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							  <h4 class="modal-title">Forgot Password ?</h4>
						  </div>
						  <div class="modal-body">
							  <p>Enter your e-mail address below to reset your password.</p>
							  <input type="text" id="email" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
	
						  </div>
						  <div class="modal-footer">
							  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
							  <button class="btn btn-theme" type="button" onclick="SubmitData();">Submit</button>
						  </div>
					  </div>
				  </div>
			  </div>
			  <!-- modal -->
	
	
		  </form>	  	
	

						<!--
						<?php $attib = array('role' => 'form'); echo form_open("auth/login");?>
							<?php if($message) { echo "<div class=\"alert alert-danger alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
							<?php if($success_message) { echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>							
                            <fieldset>
                                <div class="form-group">
                                    <?php echo form_input($identity, '', 'class="form-control" placeholder="'.$this->lang->line("email_address").'" autofocus="autofocus"');?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_input($password,  '', 'class="form-control" placeholder="'.$this->lang->line("pw").'"');?>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> Remember me
                                    </label>
                                </div>

								<a href="auth/forgot_password"><?php echo $this->lang->line("forgot_pw"); ?></a>
								<?php echo form_submit('submit', $this->lang->line("login"), 'class="btn btn-primary pull-right"');?> 
                            </fieldset>
						<?php echo form_close();?>
						-->
               
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("<?php echo base_url();?>assets/img/login-bg.jpg", {speed: 500});
				function SubmitData(){
					alert($('#email').val());
					$('#myModal').modal('hide');
				}				
    </script>


  </body>
</html>
		
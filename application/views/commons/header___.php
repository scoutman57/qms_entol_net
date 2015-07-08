<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BCS- Logistics | Quality Management</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />   	
	<link href="<?php echo base_url();?>assets/css/select2.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <!--link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /-->
    <!-- Ionicons 2.0.0 -->
    <!--link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /-->    
    <!-- Theme style -->
    <link href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <!--link href="<?php echo base_url();?>assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" /-->
    <!-- Morris chart -->
    <link href="<?php echo base_url();?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
   <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url();?>home" class="logo"><b>BCS</b>Logistics</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
              
              <!-- Tasks: style can be found in dropdown.less -->
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="<?php echo base_url();?>profile" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url();?>uploads/<?php echo foto;?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo USER_NAME;?> </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url();?>uploads/<?php echo foto;?>" class="img-circle" alt="User Image" />
                    <p>
                     <?php echo USER_NAME;?> -<?php echo email;?>
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url();?>auth/change_password" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url();?>auth/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url();?>uploads/<?php echo foto;?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p> <a href="<?php echo base_url();?>profile"><?php echo USER_NAME;?></a></p>

              <a href="<?php echo base_url();?>profile"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="<?php echo base_url();?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
            <!--li class="treeview">
              <a href="#">
                <i class="fa fa-archive"></i>
                <span>Daily</span>
              </a>
              <ul class="treeview-menu">
                          <li class="<?php //echo ($activeTab == "daily") ? "active" : ""; ?>" ><a  href="<?php //echo base_url();?>dailyactivities"><i class="fa fa-circle-o"></i>Daily Activities</a></li>
                          </ul>
            </li-->
           

<?php if(access == "admin" ){ ?>      
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Document</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>dokumen"><i class="fa fa-circle-o"></i> Images Upload</a></li>
                <li><a href="<?php echo base_url();?>dokumen_file"><i class="fa fa-circle-o"></i> Document Upload</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Master</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>division"><i class="fa fa-circle-o"></i> Division</a></li>
                <li><a href="<?php echo base_url();?>users"><i class="fa fa-circle-o"></i> User</a></li>
              </ul>
            </li>
<?php }?>     <?php if(access == "user" ){ ?>      
         <li><a href="<?php echo base_url();?>dokumen_file"> <i class="fa fa-table"></i> Document File</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Master</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>division"><i class="fa fa-circle-o"></i> Division</a></li>
              </ul>
            </li>  
 <?php }?>  
 <?php if(access == "viewer" ){ ?>      
         <li><a href="<?php echo base_url();?>dokumen_file"> <i class="fa fa-table"></i> Document File</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Master</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>division"><i class="fa fa-circle-o"></i> Division</a></li>
              </ul>
            </li>  
 <?php }?>      
            
            <li class="header">LABELS</li>
            <!--li><a href="#"><i class="fa fa-circle-o text-danger"></i> Important</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-info"></i> Information</a></li-->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
     

        <!-- Main content -->
        <!-- /.content -->
      <!-- /.content-wrapper -->
     
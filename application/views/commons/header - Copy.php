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
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/morris-0.4.3.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/bootstrap-datetimepicker/datertimepicker.css" />
        
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/datatables/media/css/jquery.dataTables.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
		
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php echo base_url();?>" class="logo"><b>Invoice Monitoring System</b></a>
            <!--logo end-->
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
					<li><button type="button" class="logout" data-toggle="dropdown">
						<?php echo USER_NAME;?> 
						<span class="caret"></span></button>
						  <ul class="dropdown-menu">
							<li>
								<a href="<?php echo base_url();?>auth/change_password">Change Password</a>
							</li>
							<li>
								<a href="<?php echo base_url();?>auth/logout">Logout</a>
							</li>
						  </ul>
					</li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
			  <?php //include(dirname(__FILE__).'/menu.php') ?>
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo USER_NAME;?></h5>
              	  	
                  <li class="mt">
                      <a class=<?php echo ($activeMenu == "dashboard") ? "active" : ""; ?> href="<?php echo base_url();?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li id="test" class="sub-menu">
                      <a class=<?php echo ($activeMenu == "master") ? "active" : ""; ?> href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Master</span>
                      </a>
                      <ul class="sub">
                          <li class=<?php echo ($activeTab == "owner") ? "active" : ""; ?>><a  href="<?php echo base_url();?>owner">Master Owner</a></li>
                          <li class=<?php echo ($activeTab == "tipe_unit") ? "active" : ""; ?>><a  href="<?php echo base_url();?>tipe_unit">Master Tipe Unit</a></li>
                          <li class=<?php echo ($activeTab == "unit") ? "active" : ""; ?>><a  href="<?php echo base_url();?>unit">Master Unit</a></li>
                          <li class=<?php echo ($activeTab == "supir") ? "active" : ""; ?>><a  href="<?php echo base_url();?>supir">Master Supir</a></li>
                          <li class=<?php echo ($activeTab == "kapal") ? "active" : ""; ?>><a  href="<?php echo base_url();?>kapal">Master Kapal</a></li>
                          <li class=<?php echo ($activeTab == "kustomer") ? "active" : ""; ?>><a  href="<?php echo base_url();?>kustomer">Master Kustomer</a></li>
                          <li class=<?php echo ($activeTab == "produk") ? "active" : ""; ?>><a  href="<?php echo base_url();?>produk">Master Produk</a></li>
                          <li class=<?php echo ($activeTab == "kontrak") ? "active" : ""; ?>><a  href="<?php echo base_url();?>kontrak">Master Kontrak</a></li>
                          <li class=<?php echo ($activeTab == "proyek") ? "active" : ""; ?>><a  href="<?php //echo base_url();?>proyek">Master Proyek</a></li>
                          <li class=<?php echo ($activeTab == "route") ? "active" : ""; ?>><a  href="<?php echo base_url();?>route">Master Route</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a class=<?php echo ($activeMenu == "transportation") ? "active" : ""; ?> href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Transportation</span>
                      </a>
                      <ul class="sub">
                          <li class=<?php echo ($activeTab == "dn") ? "active" : ""; ?>><a  href="<?php echo base_url();?>dn">Surat Jalan</a></li>
                          <!--<li><a  href="<?php echo base_url();?>dn_retail">Surat Jalan Retail</a></li>-->
                          <li class=<?php echo ($activeTab == "invoice") ? "active" : ""; ?>><a  href="<?php echo base_url();?>invoice">Proses Invoice</a></li>
                          <li class=<?php echo ($activeTab == "inquiry") ? "active" : ""; ?>><a  href="<?php echo base_url();?>inquiry">Inquiry</a></li>
                          <li class=<?php echo ($activeTab == "ujo") ? "active" : ""; ?>><a  href="<?php echo base_url();?>ujo">UJO Tarif</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class=<?php echo ($activeMenu == "laporan") ? "active" : ""; ?> href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Laporan</span>
                      </a>
                      <ul class="sub">
												<li class=<?php echo ($activeTab == "rpt_rekap_sj") ? "active" : ""; ?>><a  href="<?php echo base_url();?>rpt_rekap_sj">Laporan Rekap Surat Jalan</a></li>
												<li class=<?php echo ($activeTab == "rpt_rekap_invoice") ? "active" : ""; ?>><a  href="<?php echo base_url();?>rpt_rekap_invoice">Laporan Rekap Commercial Invoice</a></li>
												<li class="sub-menu">
												<a  class=<?php echo ($activeTab == "status_proses_invoice" || $activeTab == "invoice_report") ? "active" : ""; ?> href="javascript:;" ><span>Status Proses Invoice</span> </a> 
													<ul class="sub">
													<li class=<?php echo ($activeTab == "status_proses_invoice") ? "active" : ""; ?>><a  href="<?php echo base_url();?>status_proses_invoice" >Status Proses Invoice</a></li>
													<li class=<?php echo ($activeTab == "invoice_report") ? "active" : ""; ?>><a  href="<?php echo base_url();?>invoice_report">Invoice Monitoring</a></li>  
													 </ul> 
												</li>
												<li class=<?php echo ($activeTab == "berita_acara_ks_delta") ? "active" : ""; ?>><a  href="<?php echo base_url();?>reports/berita_acara_ks_delta">Berita Acara KS Delta</a></li>
                      </ul>
                  </li>
				  <!--
                  <li class="mt">
                      <a class="" href="<?php //echo base_url();?>auth/lock_screen">
                          <i class="fa fa-tasks"></i>
                          <span>Lock Screen</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Setting</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="form_component.html">Form Components</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">Basic Table</a></li>
                          <li><a  href="responsive_table.html">Responsive Table</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Test</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php //echo base_url();?>">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                      </ul>
                  </li>
				  -->

              </ul>			  
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="RoboBlast" content="" />
        <meta name="O3n4nX" content="" />
        <link href="<?=base_url('assets/images/Blast_voice.png')?>" rel="shortcut icon" />
		<title>Atlasat Solusindo - RoboBlast</title>
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/styles.css')?>" />
		<link rel="stylesheet" href="<?=base_url('assets/dist/css/ionicons.min.css')?>">
		<link rel="stylesheet" href="<?=base_url('assets/dist/css/skins/_all-skins.min.css')?>">
		
		<!-- Bootstrap 4.3.1 -->
		<link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.css')?>">
		
		<!-- Jquery-UI -->
		<link rel="stylesheet" href="<?=base_url('assets/dist/css/jquery-ui.css')?>">

		<!-- Datatables CSS -->
		<link rel="stylesheet" href="<?=base_url('assets/dist/css/jquery.dataTables.css')?>">
		<link rel="stylesheet" href="<?=base_url('assets/dist/css/buttons.dataTables.css')?>">
		<link rel="stylesheet" href="<?=base_url('assets/dist/css/dataTables.bootstrap.css')?>">
		
		<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
		
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />-->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <script type="text/javascript" src="<?=base_url('assets/plugins/jQuery/jquery.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/plugins/jQueryUI/jquery-ui.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/dist/js/popper.js')?>"></script>

		<!-- AdminLTE App -->
		<script type="text/javascript" src="<?=base_url('assets/dist/js/adminlte.js')?>"></script>
    
		<!-- SlimScroll -->
		<script type="text/javascript" src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>   

        <!-- Bootstrap 4.3.1 -->
		<script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.js')?>"></script>
		
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url('assets/images/Blast_voice.png')?>" class="logoapps" width="30px" height="30px" alt="Logo Apps" />&nbsp;&nbsp;<span style="font-size: 18pt;">RoboBlast</span></a><button class="btn btn-link btn-lg order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
			<!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <!--<div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>-->
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
						<!--<a class="dropdown-item" href="#">Activity Log</a>-->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url() ?>index.php/Home/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
		<div id="layoutSidenav">
									
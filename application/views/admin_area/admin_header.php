<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from spruko.com/demo/adon/email-inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Jan 2019 08:59:07 GMT -->
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta content="Fully Responsive Bootstrap 4 Admin Dashboard Template" name="description">
	<meta content="Spruko" name="author">
	
	<!-- Title -->
	<title><?=$title?></title>
	
	<!--Style-->
	<link rel="stylesheet" href="<?=base_url()?>assets/style.css">	
	
	<!-- Favicon -->
	<link href="<?=base_url()?>assets/img/brand/favicon.png" rel="icon" type="image/png">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">

	<!-- Icons -->
	<link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet">

	<!--Bootstrap.min css-->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css">

	<!-- Adon CSS -->
	<link href="<?=base_url()?>assets/css/dashboard.css" rel="stylesheet" type="text/css">

	<!--JQuery-->
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
	
	<!-- Custom scroll bar css-->
	<link href="<?=base_url()?>assets/plugins/customscroll/jquery.mCustomScrollbar.css" rel="stylesheet" />

	<!-- Sidemenu Css -->
	<link href="<?=base_url()?>assets/plugins/toggle-sidebar/css/sidemenu.css" rel="stylesheet">

	<!--Select2 css-->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/select2.css">	
	
	<!-- CK Editor -->
	<script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>

	<!-- sweetalert css-->
	<link href="<?=base_url()?>assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />
	  
	<!-- Data table css -->
	<link href="<?=base_url()?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
	
	<script src="<?=base_url()?>assets/js/validator.js"></script>
	
	<!-- form Uploads -->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/fileuploads/css/dropify.css">
	
</head>
<body class="app sidebar-mini rtl" >
	<div id="global-loader" ></div>
	<div class="page">
		<div class="page-main">
			<!-- Sidebar menu-->
			<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			<aside class="app-sidebar ">
				<div class="sidebar-img">
					<a class="navbar-brand" href="<?=base_url('AdminArea')?>"><img alt="..." class="navbar-brand-img main-logo" src="assets/img/brand/logo-dark.png"> <img alt="..." class="navbar-brand-img logo" src="assets/img/brand/logo.png"></a>
					<ul class="side-menu">
						<li class="slide">
							<a class="side-menu__item" href="<?=base_url('AdminArea')?>"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fe fe-database"></i><span class="side-menu__label">Overview Data</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li>
									<a href="<?=base_url('UserData')?>" class="slide-item"><i class="side-menu__icon fe fe-user"></i>User Data</a>
								</li>
								<li>
									<a href="<?=base_url('GuestData')?>" class="slide-item"><i class="side-menu__icon fe fe-users"></i>Property Guest Data</a>
								</li>
								<li>
									<a href="<?=base_url('EventData')?>" class="slide-item"><i class="side-menu__icon fab fa-wpforms"></i>Event Data</a>
								</li>
								<li>
									<a href="<?=base_url('QuestionnaireData')?>" class="slide-item"><i class="side-menu__icon fe fe-send"></i>Questionnaire Data</a>
								</li>
							</ul>
						</li>
						<!--<li class="slide">
							<a class="side-menu__item" href="<?=base_url('Guest')?>"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Guests Data</span></a>
						</li>-->
					</ul>
				</div>
			</aside>
			<!-- Sidebar menu-->

			<!-- app-content-->
			<div class="app-content ">
				<div class="side-app">
					<div class="main-content">
						<!-- <div class="p-2 d-block d-sm-none navbar-sm-search">
							 Form 
							<form class="navbar-search navbar-search-dark form-inline ml-lg-auto">
								<div class="form-group mb-0">
									<div class="input-group input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-search"></i></span>
										</div><input class="form-control" placeholder="Search" type="text">
									</div>
								</div>
							</form>
						</div>-->
						<!-- Top navbar -->
						<nav class="navbar navbar-top  navbar-expand-md navbar-dark" id="navbar-main">
							<div class="container-fluid">
								<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>

								<!-- Brand -->
								<a class="navbar-brand pt-0 d-md-none" href="index.html">
									<img src="assets/img/brand/logo-dark.png" class="navbar-brand-img" alt="...">
								</a>
								<!-- Form 
								<form class="navbar-search navbar-search-dark form-inline ml-3  mr-lg-auto">
									<div class="form-group mb-0">
										<div class="input-group input-group-alternative">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-search"></i></span>
											</div><input class="form-control" placeholder="Search" type="text">
										</div>
									</div>
								</form> -->
								<!-- User -->
								<!-- User -->
								<ul class="navbar-nav align-items-center ">
									<li class="nav-item dropdown">
										<b>Admin <?=$this->session->userdata('admin_name')?></b>
									</li>
									<li class="nav-item d-none d-md-flex">
										<div class="dropdown d-none d-md-flex mt-2 ">
											<a class="nav-link full-screen-link  pr-0"><i class="fe fe-maximize-2 floating " id="fullscreen-button"></i></a>
										</div>
									</li>
								</ul>
							</div>
						</nav>
						<!-- Top navbar-->
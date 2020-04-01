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
	
	
	<!-- Global site tag (gtag.js) - Google Analytics 
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155369864-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-155369864-1');
	</script>
	-->
	
</head>
<body class="app sidebar-mini rtl" >
	<div id="global-loader" ></div>
	<div class="page">
		<div class="page-main">
			<!-- Sidebar menu-->
			<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			<aside class="app-sidebar ">
				<div class="sidebar-img">
					<a class="navbar-brand" href="<?=base_url()?>"><img alt="..." class="navbar-brand-img main-logo" src="<?=base_url()?>assets/img/brand/logo-dark.png"> <img alt="..." class="navbar-brand-img logo" src="<?=base_url()?>assets/img/brand/logo.png"></a>
					<ul class="side-menu">
						<li class="slide">
							<a class="side-menu__item" href="<?=base_url('Dashboard')?>"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="<?=base_url('Guest')?>"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Guests Data</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fe fe-mail"></i><span class="side-menu__label">Email</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li>
									<a href="<?=base_url('EmailInbox')?>" class="slide-item"><i class="side-menu__icon fe fe-inbox"></i>&nbsp Email Inbox</a>
								</li>
								<li>
									<a href="<?=base_url('EmailOutbox')?>" class="slide-item"><i class="side-menu__icon fe fe-send"></i>&nbsp Email Outbox</a>
								</li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="<?=base_url('Event')?>"><i class="side-menu__icon fab fa-wpforms"></i><span class="side-menu__label">Event</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="<?=base_url('Questionnaire')?>"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Questionnaire</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Account</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li>
									<a href="<?=base_url('Account/edit_profile')?>" class="slide-item"><i class="side-menu__icon fe fe-edit"></i>Edit Property Profile</a>
								</li>
								<li>
									<a href="<?=base_url('Account/change_password')?>" class="slide-item"><i class="side-menu__icon fe fe-lock"></i>Change Password</a>
								</li>								
								<li>
									<a href="<?=base_url('Account/email_account')?>" class="slide-item"><i class="side-menu__icon fe fe-at-sign"></i>Email Account</a>
								</li>
							</ul>
						</li>
						<li>
							<a class="side-menu__item" href="<?=base_url('API')?>"><i class="side-menu__icon fas fa-book"></i><span class="side-menu__label">Integration API</span></a>
						</li>
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
										<a aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0 mr-md-2 pl-1" data-toggle="dropdown" href="#" role="button">
											<div class="media align-items-center">
												<span class="avatar avatar-sm rounded-circle"><img alt="Image placeholder" src="<?=base_url()?>images/property_logo/<?=$this->session->userdata('property_logo')?>"></span>

											</div>
										</a>
										<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
											<div class=" dropdown-header noti-title text-center border-bottom pb-3">
												<h3 class="text-capitalize text-dark mb-1"> <?=$this->session->userdata('property_name');?></h3>
											</div>
											<a class="dropdown-item" href="<?=base_url('Account/edit_profile')?>"><i class="ni ni-single-02"></i> <span>My profile</span></a>
											<a class="dropdown-item" href="<?=base_url('Account/change_password')?>"><i class="ni ni-settings-gear-65"></i> <span>Change Password</span></a>
											<div class="dropdown-divider"></div><a class="dropdown-item" href="<?=base_url('Login/logout')?>"><i class="ni ni-user-run"></i> <span>Logout</span></a>
										</div>
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
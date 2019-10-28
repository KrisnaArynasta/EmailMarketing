<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from spruko.com/demo/adon/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Jan 2019 08:59:19 GMT -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Fully Responsive Bootstrap 4 Admin Dashboard Template">
	<meta name="author" content="Creative Tim">

	<!-- Title -->
	<title>PEMS - Login</title>

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

	<!-- Single-page CSS -->
	<link href="<?=base_url()?>assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

</head>

<body class="bg-gradient-primary">
	<div class="limiter">
		<div class="container-login100">
				
			<div class="wrap-login100 p-5">
				<?php 
					$attributes = array('class' => 'login100-form validate-form', 'id' => 'formLogin'); 
					echo form_open("Login/login",$attributes); 
				?>
					<div class="logo-img text-center pb-3">
						<img src="<?=base_url()?>assets/img/brand/logo-dark1.png" alt="logo-img">
					</div>
					<span class="login100-form-title">
						User Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn btn-primary">
							Login
						</button>
					</div>

					<div class="text-center pt-1">
						<a class="txt2" href="register.html">
							Create new Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Adon Scripts -->
	<!-- Core -->
	<script src="<?=base_url()?>assets/plugins/jquery/dist/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/js/popper.js"></script>
	<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

</body>

<!-- Mirrored from spruko.com/demo/adon/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Jan 2019 08:59:19 GMT -->
</html>
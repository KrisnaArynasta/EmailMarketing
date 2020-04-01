<?php 
	foreach($data_questionnaire as $questionaire){
		$send_questionnaire_id = $questionaire->send_questionnaire_id;
		$questionnaire_id = $questionaire->id_qnr;
		$questionnaire_name = $questionaire->questionnaire_name;
		$questionnaire_send_on = $questionaire->questionnaire_send_on;
		$questionnaire_date_create = $questionaire->questionnaire_date_create;
		$questionnaire_message = $questionaire->questionnaire_message;
		$property_name = $questionaire->property_name;
	}
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta content="Fully Responsive Bootstrap 4 Admin Dashboard Template" name="description">
	<meta content="Spruko" name="author">
	
	<!-- Title -->
	<title><?=$questionnaire_name?></title>
	
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

<!-- Page content -->
<body class="app sidebar-mini rtl" >

<div class="container-fluid pt-8">
	
	<div class="email-app card shadow">
		<div class="inbox p-0">		
			<div class="card-body" style="padding:20px 50px 20px 50px">
				<div class="page-header mt-0 p-3">
					<h2 class="mb-sm-0"><small style="display:none">Questions of Questionnaire</small> <b><?=$questionnaire_name?></b> </h3>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item">
							<small>Questionnaire By:</small> 
							<br>
							<b><?=$property_name?></b>
						</li>
					</ol>

				</div>
				
				<!-- QUESTION AND OPTION DISPLAY !-->
				<div class="col-md-12">	
					<?php 
						$attributes = array('class' => 'login100-form validate-form', 'id' => 'inputQuestionnaireResult'); 
						echo form_open("Questionnaire/insert_questionnaire_result",$attributes); 
					?>
						<input type="hidden" id="send_questionnaire_id" name="send_questionnaire_id" value="<?=$send_questionnaire_id?>">
						<input type="hidden" id="questionnaire_id" name="questionnaire_id" value="<?=$questionnaire_id?>">
						<input type="hidden" id="questionnaire_name" name="questionnaire_name" value="<?=$questionnaire_name?>">
					
						<?php 
							//buat nyimpen id question baru dari looping option
							$last_question_id = 0;
							//buat pembeda antar radio dari masing-masing question
							$option_id = 0;
							
							foreach($data_questionnaire as $question_row){
								$now_question_id=$question_row->question_id;
								
								if($now_question_id != $last_question_id){
									$last_question_id = $now_question_id;
									$option_id++;
						?>		
									<div style="margin-top:20px; border-top:1px #000 solid">
									
									<p><?=$question_row->question?></p>
									<ul style="list-style-type:none;">
										<li>
											<input type="radio" value="<?=$question_row->question_option_id?>" name="option<?=$option_id?>" required>									
											<?=$question_row->question_option_value?>
										</li>
									</ul>
									
						<?php	}else{ ?>
										<ul style="list-style-type:none;">
											<li>
												<input type="radio" value="<?=$question_row->question_option_id?>" name="option<?=$option_id?>" required>
												<?=$question_row->question_option_value?>
											</li>
										</ul>
						<?php
								}
							}	
						?>
										</div>	
										
						<input type="hidden" id="option_count" name="option_count" value="<?=$option_id?>">	
						
						<div class="container-login100-form-btn">
							<button class="btn btn-default mt-4 mb-4 ml-4">
								Submit
							</button>
						</div>	
					</div>
				</div>			
			</div>			
		</div>
	</div>
</div>	


							<!-- Footer -->
							<footer class="footer">
								<div class="row align-items-center justify-content-xl-between">
									<div class="col-xl-6">
										<div class="copyright text-center text-xl-left text-muted">
											<p class="text-sm font-weight-500">Copyright 2020 © Property Email Marketing Solution</p>
										</div>
									</div>
									<div class="col-xl-6">
										<p class="float-right text-sm font-weight-500">Questionnaire Created With : <a href="#">PEMS</a></p>
									</div>
								</div>
							</footer>
							<!-- Footer -->

	<!-- Back to top -->
	<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

	<!-- Adon Scripts -->
	<!-- Core -->
	<script src="<?=base_url()?>assets/plugins/jquery/dist/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/js/popper.js"></script>
	<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/chart-circle/circle-progress.min.js"></script>

	<!--Select2 js-->
	<script src="<?=base_url()?>assets/plugins/select2/select2.full.js"></script>	
	
	<!-- Custom scroll bar Js-->
	<script src="<?=base_url()?>assets/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js"></script>
	
	<!-- Adon JS -->
	<script src="<?=base_url()?>assets/js/custom.js"></script>
	<script src="<?=base_url()?>assets/js/select2.js"></script>
	
	<!-- jquery-ui min js -->
	<script src="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	
</body>

</html>

<!-- Page content -->

<!-- file uploads js -->
<script src="<?=base_url()?>assets/plugins/fileuploads/js/dropify.min.js"></script>

<!-- sweet alert table js -->
<script src="<?=base_url()?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?=base_url()?>assets/js/sweet-alert.js"></script>
<script src="<?=base_url()?>assets/js/custom.js"></script>

<!-- Date Picker-->
<script src="<?=base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

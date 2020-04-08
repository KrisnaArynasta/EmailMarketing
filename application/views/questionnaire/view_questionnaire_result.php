<?php
  $title['title']="PEMS - Questionnaire Result";
  $this->load->view('header',$title);
?>

<script>

	// VARIABEL GLOBAL BUAT DAPETIN DATA INPUT QUESTIONNAIRE, INI DI PAKE KALO BATAL NGEDIT QUESTIONNAIRE JADI VALUE SEBELUMNYA BISA DI DAPETIN
	var q_nm;
	var q_sd;
	var q_ep;
	
	$(document).ready(function(){
		 $('#wait').hide();
		 $('#loading-wrap').hide();	

		CKEDITOR.replace('question_email_preview',{toolbarStartupExpanded : false} );	
	});
		
</script>
<!-- Data table css -->
<link href="assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
<!-- Data table css -->

<!-- Page content -->

<?php 
	foreach($data_questionnaire as $questionaire){
		$questionnaire_id = $questionaire->id_qnr;
		$questionnaire_name = $questionaire->questionnaire_name;
		$questionnaire_send_on = $questionaire->questionnaire_send_on;
		$questionnaire_date_create = $questionaire->questionnaire_date_create;
		$questionnaire_message = $questionaire->questionnaire_message;
	}
?>

<div class="container-fluid pt-8">
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0"><small style="display:none">Questions of Questionnaire</small> <b><?=$questionnaire_name?></b> </h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Questionnaire / Question</li>
		</ol>

	</div>	
	<div class="email-app card shadow">
		<div class="inbox p-0">		
			<div class="card-body" style="padding:20px 50px 20px 50px">
				<div class="row">
					<!-- QUESTIONNAIRE INFO !-->
					<div class="col-md-12">
					<form id="inputQuestionnaire" action="" method="POST">
						<div class="row">
							<input type="hidden" name="questionnaire_id" id="questionnaire_id" value="<?=$questionnaire_id?>">
							<div class="col-md-12">     
								<div class="form-group form-alert" id="lat-valid">
									<label class="form-label" >Questionnaire Name</label>
									<input type="text" name="questionnaire_name" id="questionnaire_name" style="margin-right:5px;" class="form-control" readonly value="<?=$questionnaire_name?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-alert" id="lng-evalid">
									<label class="form-label" >Questionnaire Create On</label>
									<input type="text" class="form-control" readonly value="<?=$questionnaire_date_create?>">
								</div>
							</div>					
							<div class="col-md-6">
								<div class="form-group form-alert" id="lng-evalid">
									<label class="form-label" >Questionnaire Send On</label>
									<input type="text" name="questionnaire_send_date" id="questionnaire_send_date" class="form-control" readonly value="<?=$questionnaire_send_on?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-alert">
									<label class="form-label">Message in email</label>
									<textarea style="height;450px" class="form-control" name="question_email_preview" id="question_email_preview" readonly><?=$questionnaire_message?></textarea>
								</div>
							</div>
						</div>
					</form>	
					</div>
					<!-- QUESTION AND OPTION DISPLAY !-->
					<div class="col-md-12">	
						<?php 
							$last_question_id = 0;
							foreach($data_questionnaire as $question_row){
								$now_question_id=$question_row->question_id;
								
								//CEK APAKAH QUESTION UDH DIJAWAB 
								if($question_row->result){
									$bar_score = (($question_row->result)/($question_row->result_total))*100;
								}else{
									$bar_score=0;
									$question_row->result=0;
									$question_row->result_total=0;
								}
								
								if($now_question_id != $last_question_id){
									$last_question_id = $now_question_id;
						?>		
								<div style="margin-top:20px; border-top:1px #000 solid">
									
									<p><?=$question_row->question?></p>
									<div class="row">
										<!-- OPTION VALUE!-->
										<div class="col-md-2">
											<li style="margin-left:50px;"><?=$question_row->question_option_value?></li>
										</div>	
										<!-- OPTION SCORE BAR!-->
										<div class="col-md-10" >
											<div style="<?=($bar_score>0)?'width:'.$bar_score.'%;background-color:#ad59ff;border-bottom:2px solid #7537ae;border-right:2px solid #7537ae;border-top:2px solid #7537ae;':'background-color:#fff;'?>color:#000;">
												(<?=$question_row->result?>/<?=$question_row->result_total?>)
											</div>
										</div>
									</div>	
									
						<?php	}else{ ?>
									<div class="row mt-1 mb-1">
										<!-- OPTION VALUE!-->
										<div class="col-md-2">
											<li style="margin-left:50px;"><?=$question_row->question_option_value?></li>
										</div>	
										<!-- OPTION SCORE BAR!-->
										<div class="col-md-10" >
											<div style="<?=($bar_score>0)?'width:'.$bar_score.'%;background-color:#ad59ff;border-bottom:2px solid #7537ae;border-right:2px solid #7537ae;border-top:2px solid #7537ae;':'background-color:#fff;'?>color:#000;">
												(<?=$question_row->result?>/<?=$question_row->result_total?>)
											</div>
										</div>
									</div>	
						<?php
								}
								
							}
						?>
								</div>	
					</div>	
				</div>			
			</div>			
		</div>
	</div>
	
</div>


<?php
	$questionnaire_id_modal['questionnaire_id']=$questionnaire_id;
	$this->load->view('questionnaire/question_modal',$questionnaire_id_modal);
	$this->load->view('modal');
	$this->load->view('footer');
?>


<!-- Page content -->

<!-- file uploads js -->
<script src="<?=base_url()?>assets/plugins/fileuploads/js/dropify.min.js"></script>

<!-- sweet alert table js -->
<script src="<?=base_url()?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?=base_url()?>assets/js/sweet-alert.js"></script>
<script src="<?=base_url()?>assets/js/custom.js"></script>

<!-- Date Picker-->
<script src="<?=base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

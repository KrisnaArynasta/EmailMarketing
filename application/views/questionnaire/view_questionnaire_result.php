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

		//CKEDITOR.replace('question_email_preview');		 
	});
	
	// ENABLE FORM EDIT QUESTIONNAIRE PAS KLIK BUTTON EDIT
	function enable_edit(){
		// BUAT NYIMPEN VALUE AWAL DARI INPUT KE VARIABEL GLOBAL
		q_nm = $("#questionnaire_name").val();
		q_sd = $("#questionnaire_send_date").val();
		q_ep = CKEDITOR.instances['question_email_preview'].getData();
		
		// BUAT ENABLE SEMUA INPUT
		$("#questionnaire_name").prop('readonly', false);
		$("#questionnaire_send_date").datepicker();		
		CKEDITOR.instances['question_email_preview'].setReadOnly(false);
		
		// BUAT NAMPILIN DAN NYEMBUNYIIN TOMBOL
		$("#edit_questionnaire_button").hide();
		$("#save_questionnaire_button").show();
		$("#discard_questionnaire_button").show();
	}
	
	// DISABLE FORM EDIT QUESTIONNAIRE PAS KLIK BUTTON DISCARD
	function disable_edit(){
		// BUAT SET VALUE LAMA KE INPUT KLO GK JADI NGEDIT
		$("#questionnaire_name").val(q_nm);
		$("#questionnaire_send_date").val(q_sd);
		CKEDITOR.instances['question_email_preview'].setData(q_ep);
		
		// BUAT DISABLE SEMUA INPUT
		$("#questionnaire_name").prop('readonly', true);
		$("#questionnaire_send_date").prop('readonly', true);
		$( "#questionnaire_send_date" ).datepicker( "option", "disabled", true );
		CKEDITOR.instances['question_email_preview'].setReadOnly(true);
		
		// BUAT NAMPILIN DAN NYEMBUNYIIN TOMBOL
		$("#edit_questionnaire_button").show();
		$("#save_questionnaire_button").hide();
		$("#discard_questionnaire_button").hide();
	}
	
	// UPDATE QUESTIONNAIRE
	function save_questionnaire(){
		
		CKEDITOR.instances['question_email_preview'].updateElement();
		$("#inputQuestionnaire").serialize();
		
		$('.loading-wrap').show();		
		$.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Questionnaire/update_questionnaire",
			datatype : "json", 
			data: $("#inputQuestionnaire").serialize(), 
			success: function(data) {
				$('.loading-wrap').hide();
				if(data=="success"){
					swal({title:"Succsess", text:"Successfully update questionnaire data", type:"success"},
					function(){ 
						location.reload();
					});
					$('.confirm').addClass('sweet-alert-success');
				}else{
					swal({title:"Failed", text:"Failed tto update questionnaire data", type:"error"});
				}
			}
		});		
	}
	
	//	DELETE QUESTION
	function delete_question(question_id){
		swal({
			title: "Delete Question ?",
			text: "Are you sure want to delete this question ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Delete",
			closeOnConfirm: false
		}, function() {
		  
		  $.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"Questionnaire/delete_question",
				datatype : "json", 
				data:{id:question_id,delete_sts:1},
				success: function(data) {
					if(data=="success"){
						swal({title:"Question Deleted!", text:"this question has been deleted in your questionnaire", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Delete Question!", text:"fail to delete the question", type:"success"});
					}	
				}
			}); 
		});
	}

	
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
											<div style="<?=($bar_score>0)?'width:'.$bar_score.'%;background-color:#ad59ff;':'background-color:#fff;'?>color:#000;border-bottom:2px solid #7537ae;border-right:2px solid #7537ae;border-top:2px solid #7537ae;">
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
											<div style="<?=($bar_score>0)?'width:'.$bar_score.'%;background-color:#ad59ff;':'background-color:#fff;'?>color:#000;border-bottom:2px solid #7537ae;border-right:2px solid #7537ae;border-top:2px solid #7537ae;">
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

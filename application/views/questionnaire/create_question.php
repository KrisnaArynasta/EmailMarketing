<?php
  $title['title']="PEMS - Create Question";
  $this->load->view('header',$title);
?>

<script>
	$(document).ready(function(){
		 $('#wait').hide();
		 $('#loading-wrap').hide();	

		CKEDITOR.replace('question_email_preview');		 
	});
	
	// SAVE question
	function save_question(id){
		
		$('.loading-wrap').show();		
		$.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Questionnaire/insert_question",
			datatype : "json", 
			data: $("#inputQuestion").serialize(), 
			success: function(data) {
				$('.loading-wrap').hide();
				if(data=="success"){
					swal({title:"Succsess", text:"Successfully create your account, please login to access your dashboard", type:"success"},
					function(){ 
						window.location.href = "<?php echo base_url(); ?>"+"Questionnaire/create_question/"+id;
					});
					$('.confirm').addClass('sweet-alert-success');
				}else{
					swal({title:"Failed", text:"Failed to create account, please try again latter", type:"error"});
				}
			}
		});		
	}
	
	function add_question(){
		$("#question_cons").html(`<div class="col-md-12">
									<div class="col-md-12">
									<div class="form-group form-alert">
										<label class="form-label">Question</label>
										<textarea class="form-control empty-validator" onfocusout="" id="question" name="question" rows="3" placeholder="e.g Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25...."></textarea>
									</div>
								</div>	
								<div class="col-md-12">
									<label class="form-label">Option</label>
									<div id="option_cons">
										<div class="form-group form-alert">
											<div class="row" style="margin-left:30px">
												<input type="radio" checked>
												<div class="col-md-9"><input class="form-control empty-validator" onfocusout="" id="option_text" name="option_text" rows="3" placeholder="e.g Perfect...."></div>
												<div class="col-md-1"><button class="btn btn-icon btn-outline-primary btn-block" type="button" onclick="add_option()"><span class="btn-inner--icon"><i class="fe fe-plus" style="margin-left: -7px;"></i></span></button></div>		
											</div>
										</div>
									</div>		
								</div>		
							</div>`);	
		
			$('#question').modal('show');	
	}
	
	//ADD OPTION 
	function add_option(){
			var option_value = $("#option_text").val();
			$("#option_text").val("");
			var element = 	'<div class="form-group form-alert">'
								+'<div class="row" style="margin-left:30px" id="input_option">'
									+'<input type="radio" checked>'
									+'<div class="col-md-9"><input class="form-control empty-validator" onfocusout="" id="option" name="option[]" rows="3" placeholder="e.g Perfect...." value="'+option_value+'"></div>'
									+'<div class="col-md-1" style="display:"><button class="btn btn-icon btn-outline-danger btn-block" type="button" onclick="remove_option(this)"><span class="btn-inner--icon"><i class="fe fe-minus" style="margin-left: -7px;"></i></span></button></div>'
								+'</div>'
							+'</div>';
			$("#option_cons").append($(element));
	}
	
	function remove_option(v){
			$(v).parent().parent().parent().remove();
	}
	

	
</script>
<!-- Data table css -->
<link href="assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
<!-- Data table css -->

<!-- Page content -->

<?php 
	foreach($data_questionnaire as $questionaire){
		$questionnaire_id = $questionaire->questionnaire_id;
		$questionnaire_name = $questionaire->questionnaire_name;
		$questionnaire_send_on = $questionaire->questionnaire_send_on;
		$questionnaire_date_create = $questionaire->questionnaire_date_create;
		$questionnaire_message = $questionaire->questionnaire_message;
	}
?>

<div class="container-fluid pt-8">
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0"><small>Questions of Questionnaire</small> <b><?=$questionnaire_name?></b> </h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Questionnaire / Question</li>
		</ol>

	</div>	
	<div class="email-app card shadow">
		<div class="inbox p-0">		
			<div class="card-body">
			
			<!-- QUESTIONNAIRE INFO !-->
				<div class="row">
					<div class="col-md-12">     
						<div class="form-group form-alert" id="lat-valid">
							<label class="form-label" >Questionnaire Name</label>
							<input type="text" style="margin-right:5px;" class="form-control" readonly value="<?=$questionnaire_name?>">
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
							<input type="text" class="form-control" readonly value="<?=$questionnaire_send_on?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group form-alert">
							<label class="form-label">Message in email to send</label>
							<textarea class="form-control" readonly id="question_email_preview" name="question_email_preview"><?=$questionnaire_message?></textarea>
						</div>
					</div>
				</div>
			
				<!-- BUTTON CREATE QUESTION !-->
				<button class="btn btn-icon btn-outline-primary mt-1 mb-1" type="button" onclick="add_question()">
					<span class="btn-inner--icon"><i class="fe fe-plus"></i></span>
					<span class="btn-inner--text">Add Question</span>
				</button>
				
				<!-- QUESTION AND OPTION DISPLAY !-->
				<div class="col-md-12">	
					<?php 
						$last_question_id = 0;
						foreach($data_questionnaire as $question_row){
							$now_question_id=$question_row->question_id;
							if($now_question_id != $last_question_id){
								$last_question_id = $now_question_id;
					?>		
							<div style="margin-top:20px; border-top:1px #000 solid">
								<p><?=$question_row->question?></p>
								<li style="margin-left:50px;"><?=$question_row->question_option_value?></li>
								
					<?php	}else{ ?>
								<li style="margin-left:50px;"><?=$question_row->question_option_value?></li>
					<?php
							}
							
						}
					?>
				</div>	
			</div>			
		</div>
	</div>
	
</div>

<div class="modal fade" id="question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title header_event_email" id="largeModalLabel" style="opacity:0.6">Create Question </h2>
				<button type="button" class="btn-small btn-danger ml-auto" data-dismiss="modal">x</button>
				</button>
			</div>
			<div class="modal-body" id="modalBodyEvent">
				<form id="inputQuestion" action="" method="POST">
					<input type="hidden" name="questionnaire_id" id="questionnaire_id" value="<?=$questionnaire_id?>">
					<div class="row" id="question_cons">
						<!-- SET ON JAVASCRIPT FUNCTION!-->
					</div>					
			</div>
			<div class="modal-footer">
				<button class="btn btn-icon btn-outline-primary mt-1 mb-1" type="button" onclick="save_question(<?=$questionnaire_id?>)">
					<span class="btn-inner--icon"><i class="fe fe-save"></i></span>
					<span class="btn-inner--text">Save</span>
				</button>
			</div>
			</form>	
		</div>
	</div>
</div>

<?php
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

<!-- pagination -->
<script>

   $(document).ready(function(){
   
        $("#event_date").datepicker({
		  dateFormat: 'yy-mm-dd',
	        minDate: 1,
    
			onSelect: function(selected) {
			var minEnd = new Date($("#event_date").datepicker("getDate"));
			minEnd.setDate(minEnd.getDate() + 1);
	          $("#send_on").datepicker("option","minDate", minEnd)
	        }

        });
        
		
		$("#send_on").datepicker({
		  dateFormat: 'yy-mm-dd',  
	        onSelect: function(selected) {
	           $("#event_date").datepicker("option","maxDate", selected)
			}
		});
    
	
	});

</script>

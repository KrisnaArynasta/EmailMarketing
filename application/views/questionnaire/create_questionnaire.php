<?php
  $title['title']="PEMS - Create Questionnaire";
  $this->load->view('header',$title);
?>

<script>
	$(document).ready(function(){
		 $('#wait').hide();
		 $('#loading-wrap').hide();

		CKEDITOR.replace('question_email');
		
	});
		
</script>
<!-- Data table css -->
<link href="assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
<!-- Data table css -->

<!-- Page content -->
<div class="container-fluid pt-8">
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0">Your Event</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Event</li>
		</ol>

	</div>
	<div class="email-app card shadow">
		<div class="inbox p-0">		
			<div class="card-body">
				<?php 
					$attributes = array('class' => 'login100-form validate-form', 'id' => 'inputQuestionnaire'); 
					echo form_open("Questionnaire/insert_questionnaire",$attributes); 
				?>
					<div class="row">
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Questionnaire Name</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="question_name" name="question_name" placeholder="e.g Questionnaire About Your Stay" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-alert" id="lng-evalid">
								<label class="form-label" >Questionnaire Send On</label>
								<input type="text" class="form-control empty-validator" id="send_on" name="send_on" placeholder="e.g 2020-01-01" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group form-alert">
								<label class="form-label">Message in email to send</label>
								<textarea class="form-control empty-validator" onfocusout="" id="question_email" name="question_email" rows="3" placeholder="e.g Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25...."></textarea>
							</div>
						</div>
						<div class="col-md-12 mt-4">  
							<button class="btn btn-icon btn-outline-primary btn-block mt-1 mb-1" type="submit">
								<span class="btn-inner--icon"><i class="fe fe-save"></i></span>
								<span class="btn-inner--text">Save And Create Question</span>
							</button>
						</div>	
					</div>
				</form>		
			</div>			
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

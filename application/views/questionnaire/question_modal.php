<script>

	//EDIT QUESTION
	function edit_question(id){	
		$.ajax({
			url: "<?=base_url('')?>"+"Questionnaire/view_question_by_id/"+id,
			method: "get",
			dataType: 'json',
			success: function(data){
				$('#edit_question_id').val(id);
				$('#edit_question_text').val(data.data_edit[0].question);
				
				//LOOPING DATA OPTION BUAT D TAMPILIN D FORM
				var i = 0;
				$("#edit_option_cons").empty();	
				if(data.data_edit[0].question_option_id){
					while (i < data.data_edit.length) {
						$("#edit_option_cons").append('<div class="form-group form-alert">'
								+'<div class="row" style="margin-left:30px" id="input_option">'
									+'<input type="radio" checked>'
									+'<div class="col-md-9"><input class="form-control empty-validator" onfocusout="" id="option" name="option[]" rows="3" placeholder="e.g Perfect...." value="'+data.data_edit[i].question_option_value+'"></div>'
									+'<div class="col-md-1" style="display:"><button class="btn btn-icon btn-outline-danger btn-block" type="button" onclick="remove_option(this)"><span class="btn-inner--icon"><i class="fe fe-minus" style="margin-left: -7px;"></i></span></button></div>'
								+'</div>'
							+'</div>');
						i+=1;
					}
				}
				
				$('#edit_question').modal('show');	
			}
		});		
	}

	// UPDATE QUESTION AND OPTION
	function update_question(id){
		
		$('.loading-wrap').show();		
		$.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Questionnaire/update_question",
			datatype : "json", 
			data: $("#editQuestion").serialize(), 
			success: function(data) {
				$('.loading-wrap').hide();
				if(data=="success"){
					swal({title:"Succsess", text:"Successfully update the question and option", type:"success"},
					function(){ 
						window.location.href = "<?php echo base_url(); ?>"+"Questionnaire/create_question/"+id;
					});
					$('.confirm').addClass('sweet-alert-success');
				}else{
					swal({title:"Failed", text:"Failed to update the question", type:"error"});
				}
			}
		});		
	}

	// SAVE QUESTION AND OPTION
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
					swal({title:"Succsess", text:"Successfully create a new question", type:"success"},
					function(){ 
						window.location.href = "<?php echo base_url(); ?>"+"Questionnaire/create_question/"+id;
					});
					$('.confirm').addClass('sweet-alert-success');
				}else{
					swal({title:"Failed", text:"Failed to create a new question", type:"error"});
				}
			}
		});		
	}
	
	//ADD OPTION INPUT
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
	
	//EDIT OPTION INPUT
	function edit_add_option(){
			var option_value = $("#edit_option_text").val();
			$("#edit_option_text").val("");
			var element = 	'<div class="form-group form-alert">'
								+'<div class="row" style="margin-left:30px" id="input_option">'
									+'<input type="radio" checked>'
									+'<div class="col-md-9"><input class="form-control empty-validator" onfocusout="" id="option" name="option[]" rows="3" placeholder="e.g Perfect...." value="'+option_value+'"></div>'
									+'<div class="col-md-1" style="display:"><button class="btn btn-icon btn-outline-danger btn-block" type="button" onclick="remove_option(this)"><span class="btn-inner--icon"><i class="fe fe-minus" style="margin-left: -7px;"></i></span></button></div>'
								+'</div>'
							+'</div>';
			$("#edit_option_cons").append($(element));
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
		
			$('#input_question').modal('show');	
	}

</script>

<!-- MODAL ADD QUESTION!-->
<div class="modal fade" id="input_question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- MODAL EDIT QUESTION!-->
<div class="modal fade" id="edit_question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title header_event_email" id="largeModalLabel" style="opacity:0.6">Edit Question </h2>
				<button type="button" class="btn-small btn-danger ml-auto" data-dismiss="modal">x</button>
				</button>
			</div>
			<div class="modal-body" id="modalBodyEvent">
				<form id="editQuestion" action="" method="POST">
					<input type="hidden" name="edit_question_id" id="edit_question_id">
					<div class="row" id="question_cons">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group form-alert">
									<label class="form-label">Question</label>
									<textarea class="form-control empty-validator" onfocusout="" id="edit_question_text" name="edit_question_text" rows="3" placeholder="e.g Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25...."></textarea>
								</div>
							</div>	
							<div class="col-md-12">
								<label class="form-label">Option</label>
									<div class="form-group form-alert">
										<div class="row" style="margin-left:30px">
											<input type="radio" checked>
											<div class="col-md-9"><input class="form-control empty-validator" onfocusout="" id="edit_option_text" name="edit_option_text" rows="3" placeholder="e.g Perfect...."></div>
											<div class="col-md-1"><button class="btn btn-icon btn-outline-primary btn-block" type="button" onclick="edit_add_option()"><span class="btn-inner--icon"><i class="fe fe-plus" style="margin-left: -7px;"></i></span></button></div>		
										</div>
									</div>	
									<div id="edit_option_cons">
									
									</div>									
							</div>		
						</div>
					</div>					
			</div>
			<div class="modal-footer">
				<button class="btn btn-icon btn-outline-primary mt-1 mb-1" type="button" onclick="update_question(<?=$questionnaire_id?>)">
					<span class="btn-inner--icon"><i class="fe fe-save"></i></span>
					<span class="btn-inner--text">Save</span>
				</button>
			</div>
			</form>	
		</div>
	</div>
</div>
<script>	
	function view_email_questionnaire(questionnaire_id){	
		
		$('.loading-wrap').show();
		$.ajax({
			url: "<?=base_url('Questionnaire/view_questionnaire_email/')?>"+questionnaire_id,
			method: "get",
			dataType: 'json',
			success: function(data){
        					
				var user_id 					= (data.data_detail[0].user_id);
				var property_name 				= (data.data_detail[0].property_name);
				var property_address 			= (data.data_detail[0].property_address);
				var property_website 			= (data.data_detail[0].property_website);
				var property_logo 				= (data.data_detail[0].property_logo);
				var questionnaire_name 			= (data.data_detail[0].questionnaire_name);
				var questionnaire_message		= (data.data_detail[0].questionnaire_message);
				var questionnaire_status_active = (data.data_detail[0].questionnaire_status_active);
				
				if(property_website){ 
					property_website = '<a href="'+property_website+'">'+property_website+'</a>';
				}else{
					property_website = '';
				}
				
				if(property_address){ 
					property_address = property_address+'<br>';
				}else{
					property_address = '';
				}
				
				if(property_logo){ 
					property_logo = '<div class="col-md-6"><img width="20%" src="<?=base_url()?>images/property_logo/'+property_logo+'"></div>';
				}else{
					property_logo = '<div class="col-md-6"><h2><b>'+property_name+'</b></h2></div>';
				}
				
				$(".header_event_email").html('Email Tamplate For '+questionnaire_name);
				
				$("#modalBodyEvent").html('<div class="col-md-12" style="border-bottom:1px solid #0000003b; padding-bottom:10px">'
												+'<div class="row">'
												+property_logo
												+'<div class="col-md-6 text-right" style="top: 0.6rem;"><h4>'+property_name+'<br>'
												+'<small>'+property_address
												+property_website
												+'</small></h4></div>'
												+'</div>'
											+'</div>'
											+'<br>'
											+'<p>Dear Mr/Mrs [Your guest name will apply Here]</p>'
											+'<br>'
											+'<p class="mb-0 mt-4">'+questionnaire_message+'</p>'
											+'<br>'
											+'<p class="mb-0 mt-4">Questionnaire link: [Your Questionnaire Lin will display here]</p>'
										);
						
				$('#emailQuestionnaireModal').modal('show');
			}
		});
	}
</script>
	
<div class="modal fade" id="emailQuestionnaireModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title header_event_email" id="largeModalLabel" style="opacity:0.6"></h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalBodyEvent">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
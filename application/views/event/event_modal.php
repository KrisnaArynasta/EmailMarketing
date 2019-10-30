<script>	
	function view_email_event(event_id){	
		//$('#emailEventModal').modal('show');	
		
		$('.loading-wrap').show();
		$.ajax({
			url: "<?=base_url('Event/view_event_email/')?>"+event_id,
			method: "get",
			dataType: 'json',
			success: function(data){
        		$('.loading-wrap').hide();
				
				var user_id 			= (data.data_detail[0].user_id);
				var property_name 		= (data.data_detail[0].property_name);
				var property_address 	= (data.data_detail[0].property_address);
				var property_website 	= (data.data_detail[0].property_website);
				var property_logo 		= (data.data_detail[0].property_logo);
				var event_name 			= (data.data_detail[0].event_name);
				var event_date 			= (data.data_detail[0].event_date);
				var event_description	= (data.data_detail[0].event_description);
				var event_message 		= (data.data_detail[0].event_message);
				var message_send_before = (data.data_detail[0].message_send_before);
				var event_main_photo	= (data.data_detail[0].event_main_photo);
				var event_status_active = (data.data_detail[0].event_status_active);
				var manometer_lng		= (data.data_detail[0].manometer_lng);
				
				event_date = new Date(event_date);
				event_date = event_date.toString();
				event_date = event_date.substring(0,15); 
				
				if(property_website){ 
					property_website = '<a href="'+property_website+'">'+property_website+'</a>';
				}else{
					property_website = '';
				}
				
				if(property_logo){ 
					property_logo = '<div class="col-md-6"><img width="20%" src="<?=base_url()?>images/property_logo/'+property_logo+'"></div>';
				}else{
					property_logo = '<div class="col-md-6"><h2><b>'+property_name+'</b></h2></div>';
				}
				
				$(".header_event_email").html('Email Tamplate For '+event_name+' Event');
				
				$("#modalBodyEvent").html('<div class="col-md-12" style="border-bottom:1px solid #0000003b; padding-bottom:10px">'
												+'<div class="row">'
												+property_logo
												+'<div class="col-md-6 text-right" style="top: 0.6rem;"><h4>'+property_name+'<br>'
												+'<small>'+property_address+'<br>'
												+property_website
												+'</small></h4></div>'
												+'</div>'
											+'</div>'
											+'<strong><h2 class="mb-4 mt-4" align="center">'+event_name+'<br><small>'+event_date+'</small></h2></strong>'
											+'<div class="col-md-12">'
												+'<img class="col-md-12" src="<?=base_url()?>images/event_photos/event_main_photos/'+event_main_photo+'">'
											+'</div>'
											+'<p class="mb-0 mt-4">'+event_message+'</p>'
											+'<div class="col-md-12">'
												+'<h4 align="center" style="margin-top:40px; border-top:1px solid #0000003b; padding-top:10px" >Event&apos;s Photo(s)</h4>'
												+'<div class="row" id="eventPhotos">'
													
												+'</div>'
											+'</div>'
										);
										
				var i = 0;
				$("#DataRiwayat").empty();	
				if(data.data_detail[0].event_photo_id){
					while (i < data.data_detail.length) {
						$("#eventPhotos").append('<img width="24%" style="margin:1px" src="<?=base_url()?>images/event_photos/events_photos/'+data.data_detail[i].event_photo+'">'	
													
								);
						i+=1;
					}
				}
				
	
				$('#emailEventModal').modal('show');
			}
		});
	}
</script>
	
<div class="modal fade" id="emailEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
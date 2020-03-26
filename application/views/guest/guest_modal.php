<script>	
	function save_guest(){
		//$('#wait').show();
		//$('#loading-wrap').show();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Guest/save_guest",
        datatype : "json", 
        data: $("#addGuestForm").serialize(), 
        success: function(data) {
			if(data){
				swal({title:"New Guest Data Added", text:"successfully add new guest data", type:"success"},
				function(){ 
					location.reload(); 
				});
				$('.confirm').addClass('sweet-alert-success');
			}else{
				swal({title:"Failed!", text:"Failed to add a new guest data", type:"error"});
			}
		   }
		 });
	}

	function edit_guest(id){	
		
		
		//$('.loading-wrap').show();
		$.ajax({
			url: "<?=base_url('Guest/view_guest_by_id/')?>"+id,
			method: "get",
			dataType: 'json',
			success: function(data){
        		//$('.loading-wrap').hide();
				$('#edit_guest_id').val(data.data_edit[0].guest_id);
				$('#edit_hotel_id').val(data.data_edit[0].guest_user_id);
				$('#edit_guest_name').val(data.data_edit[0].guest_name);
				$('#edit_guest_email').val(data.data_edit[0].guest_email);
				$('#edit_guest_country').val(data.data_edit[0].guest_country);
				
				$('#editGuest').modal('show');	
			}
		});
	}

	function update_email_account(){
		//$('#wait').show();
		//$('#loading-wrap').show();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Guest/update_guest",
        datatype : "json", 
        data: $("#editGuestForm").serialize(), 
        success: function(data) {
			if(data){
				swal({title:"Guest data Updated", text:"successfully updating guest data", type:"success"},
				function(){ 
					location.reload(); 
				});
				$('.confirm').addClass('sweet-alert-success');
			}else{
				swal({title:"Failed!", text:"Failed to updating guest data", type:"error"});
			}
		   }
		 });
	}
	
</script>
	
<div class="modal fade" id="addGuest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title header_event_email" id="largeModalLabel" style="opacity:0.6">New Guest Data</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalBodyEvent">
				<form id="addGuestForm" action="" method="POST">
					<div class="row">
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Guest Hotel ID</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="hotel_id" name="hotel_id" placeholder="e.g NB001" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Guest Name</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="guest_name" name="guest_name" placeholder="e.g Jimmy Sulivan" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Guest Email Address</label>
								<input type="email" style="margin-right:5px;" class="form-control empty-validator" id="guest_email" name="guest_email" placeholder="e.g jimmysulivan@gmail.com" onchange="" onfocusout="">
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Guest Country</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="guest_country" name="guest_country" placeholder="e.g USA" onchange="" onfocusout="">
							</div>
						</div>	
					</div>	
				
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-danger" type="button" data-dismiss="modal">Discard</button>
				<button class="btn btn-outline-primary" type="button" onclick="save_guest()">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editGuest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title header_event_email" id="largeModalLabel" style="opacity:0.6">Edit Email Account</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalBodyEvent">
				<form id="editGuestForm" action="" method="POST">
					<input type="hidden" id="edit_guest_id" name="edit_guest_id">
					<div class="row">
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Guest Hotel ID</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="edit_hotel_id" name="edit_hotel_id" placeholder="e.g NB001" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Guest Name</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="edit_guest_name" name="edit_guest_name" placeholder="e.g Jimmy Sulivan" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Guest Email Address</label>
								<input type="email" style="margin-right:5px;" class="form-control empty-validator" id="edit_guest_email" name="edit_guest_email" placeholder="e.g jimmysulivan@gmail.com" onchange="" onfocusout="">
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Guest Country</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="edit_guest_country" name="edit_guest_country" placeholder="e.g USA" onchange="" onfocusout="">
							</div>
						</div>	
					</div>	
				
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-danger" type="button" data-dismiss="modal">Discard</button>
				<button class="btn btn-outline-primary" type="button" onclick="update_email_account()">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>
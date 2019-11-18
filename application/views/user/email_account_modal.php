<script>	
	function save_email_account(){
		//$('#wait').show();
		//$('#loading-wrap').show();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Account/save_email_account",
        datatype : "json", 
        data: $("#addEmailForm").serialize(), 
        success: function(data) {
			if(data){
				swal({title:"Email Account Registered", text:"successfully register an email account", type:"success"},
				function(){ 
					location.reload(); 
				});
				$('.confirm').addClass('sweet-alert-success');
			}else{
				swal({title:"Failed!", text:"Failed to register a new email account", type:"error"});
			}
		   }
		 });
	}

	// function view_email_event(event_id){	
		// //$('#emailEventModal').modal('show');	
		
		// $('.loading-wrap').show();
		// $.ajax({
			// url: "<?=base_url('Event/view_event_email/')?>"+event_id,
			// method: "get",
			// dataType: 'json',
			// success: function(data){
        		// $('.loading-wrap').hide();
				
	// }
</script>
	
<div class="modal fade" id="createEmailAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title header_event_email" id="largeModalLabel" style="opacity:0.6"></h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalBodyEvent">
				<form id="addEmailForm" action="" method="POST">
					<div class="row">
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Email</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="account_email" name="account_email" placeholder="e.g info@sweethotel.com" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Password</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="account_password" name="account_password" placeholder="type your email password" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >IMAP Host</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="imap_host" name="imap_host" placeholder="e.g {imap.gmail.com:993/imap/ssl}INBOX" onchange="" onfocusout="">
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >SMTP Host</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="smtp_host" name="smtp_host" placeholder="e.g ssl://smtp.googlemail.com" onchange="" onfocusout="">
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Email Sending Limit</label>
								<input type="number" style="margin-right:5px;" class="col-md-4 form-control empty-validator" id="sending_limit" name="sending_limit" placeholder="e.g 250" onchange="" onfocusout="">
							</div>
						</div>	
					</div>	
				
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-primary" type="button" onclick="save_email_account()">Save</button>
				<button class="btn btn-outline-danger" type="button" data-dismiss="modal">Discard</button>
			</div>
			</form>
		</div>
	</div>
</div>
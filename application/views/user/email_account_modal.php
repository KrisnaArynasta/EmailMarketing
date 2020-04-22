<script>	

	function save_local_email(){
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Account/save_local_email",
        datatype : "json", 
        data: $("#addEmailLocalForm").serialize(), 
        success: function(data) {
			if(data=="success"){
				swal({title:"Local Email Registered", text:"successfully register a local email", type:"success"},
				function(){ 
					location.reload(); 
				});
				$('.confirm').addClass('sweet-alert-success');
			}else{
				swal({title:"Failed!", text:"Failed to register a new local email", type:"error"});
			}
		   }
		 });
	}

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

	function edit_email_account(id){	
		
		
		//$('.loading-wrap').show();
		$.ajax({
			url: "<?=base_url('Account/view_email_account_by_id/')?>"+id,
			method: "get",
			dataType: 'json',
			success: function(data){
        		//$('.loading-wrap').hide();
				$('#edit_account_email_id').val(data.data_edit[0].email_sender_id);
				$('#edit_account_email').val(data.data_edit[0].email);
				$('#edit_account_password').val(data.data_edit[0].password);
				$('#edit_imap_host').val(data.data_edit[0].inbox_host);
				$('#edit_smtp_host').val(data.data_edit[0].sender_host);
				$('#edit_sending_limit').val(data.data_edit[0].limit_email);
				
				$('#editEmailAccount').modal('show');	
			}
		});
	}

	function update_email_account(){
		//$('#wait').show();
		//$('#loading-wrap').show();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Account/update_email_account",
        datatype : "json", 
        data: $("#editEmailForm").serialize(), 
        success: function(data) {
			if(data){
				swal({title:"Email Account Updated", text:"successfully updating email account", type:"success"},
				function(){ 
					location.reload(); 
				});
				$('.confirm').addClass('sweet-alert-success');
			}else{
				swal({title:"Failed!", text:"Failed to updating email account", type:"error"});
			}
		   }
		 });
	}
	
</script>
	
<div class="modal fade" id="createLocalEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title header_event_email" id="largeModalLabel" style="opacity:0.6">Create Local Email</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalBodyEvent">
				<form id="addEmailLocalForm" action="" method="POST">
					<div class="row">
						<div class="col-md-12">     
							<div class="input-group">
								<input id="local_email" name="local_email" type="text" class="form-control" size="64" maxlength="64" placeholder="Enter your username" email-full-length="254" required="required">
								<span id="" class="p-2" style="background-color: #eee;border: 1px solid #ccc;font-size:14.5px" title="@krisnaarynasta.com">
									<span class="text-truncate domain-text">@krisnaarynasta.com</span>
								</span>
							</div>
						</div>	
					</div>	
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-danger" type="button" data-dismiss="modal">Discard</button>
				<button class="btn btn-outline-primary" type="button" onclick="save_local_email()">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>	
	
<div class="modal fade" id="createEmailAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title header_event_email" id="largeModalLabel" style="opacity:0.6">Register Email Account</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalBodyEvent">
				<form id="addEmailForm" action="" method="POST">
					<div class="row">
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Your Email</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="account_email" name="account_email" placeholder="e.g info@sweethotel.com" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Your Password</label>
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
								<input type="number" style="margin-right:5px;" class="col-md-4 form-control empty-validator" id="sending_limit" name="sending_limit" placeholder="e.g 250" onchange="" onfocusout=""><small>*See your limit sending email using SMTP.</small>
							</div>
						</div>	
					</div>	
				    <small>*Note for gmail account :
						<ul>
							<li>login to your gmail account and Enable imap on the seting menu.</li>
							<li>Non-activate less secure apps <a href="https://www.google.com/settings/security/lesssecureapps">here.</a></li>
							<li>Go to: <a href="https://accounts.google.com/b/0/DisplayUnlockCaptcha">https://accounts.google.com/b/0/DisplayUnlockCaptcha</a> and enable access.</li>
						</ul>
					</small>	
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-danger" type="button" data-dismiss="modal">Discard</button>
				<button class="btn btn-outline-primary" type="button" onclick="save_email_account()">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editEmailAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title header_event_email" id="largeModalLabel" style="opacity:0.6">Edit Email Account</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalBodyEvent">
				<form id="editEmailForm" action="" method="POST">
				
				<input type="hidden" id="edit_account_email_id" name="edit_account_email_id">
				
					<div class="row">
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Your Email</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="edit_account_email" name="edit_account_email" placeholder="e.g info@sweethotel.com" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Your Password</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="edit_account_password" name="edit_account_password" placeholder="type your email password" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >IMAP Host</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="edit_imap_host" name="edit_imap_host" placeholder="e.g {imap.gmail.com:993/imap/ssl}INBOX" onchange="" onfocusout="">
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >SMTP Host</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="edit_smtp_host" name="edit_smtp_host" placeholder="e.g ssl://smtp.googlemail.com" onchange="" onfocusout="">
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Email Sending Limit</label>
								<input type="number" style="margin-right:5px;" class="col-md-4 form-control empty-validator" id="edit_sending_limit" name="edit_sending_limit" placeholder="e.g 250" onchange="" onfocusout="">
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
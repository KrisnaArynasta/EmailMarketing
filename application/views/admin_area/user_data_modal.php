<script>	

	function view_detail_user(id){	
		
		
		//$('.loading-wrap').show();
		$.ajax({
			url: "<?=base_url('UserData/view_detail_user/')?>"+id,
			method: "get",
			dataType: 'json',
			success: function(data){
				
				if(data.data_user[0].property_logo){ 
					property_logo = '<img width="70px" src="<?=base_url()?>images/property_logo/'+data.data_user[0].property_logo+'">';
				}else{
					property_logo = 'This Property Has No Logo';
				}
				
				if(data.data_user[0].admin_name){ 
					admin = data.data_user[0].admin_name;
				}else{
					admin = 'Not Aproved Yet!';
				}
				
				if(!data.data_user[0].admin_id_approver){ 
					button = '<button onclick="javascript:conformAktif('+data.data_user[0].user_id+');" class="col-md-12 btn btn-outline-primary" type="button">Acivated User</button>';
				}else{
					button = '<button onclick="javascript:conformDiaktif('+data.data_user[0].user_id+');" class="col-md-12 btn btn-outline-danger" type="button">Deacivated User</button>';
				}
				
        		//$('.loading-wrap').hide();
				$('#email').val(data.data_user[0].email);
				$('#name').val(data.data_user[0].property_name);
				$('#address').val(data.data_user[0].property_address);
				$('#website').val(data.data_user[0].property_website);
				$('#logo').html(property_logo);
				$('#api').val(data.data_user[0].API_key);
				$('#secret').val(data.data_user[0].secret_key);
				$('#admin').val(admin);
				$('#button-approve').html(button);
				
				$('#userDetail').modal('show');	
			}
		});
	}

	function conformAktif(user_id){
		swal({
			title: "Activate User Account ?",
			//text: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Activate",
			closeOnConfirm: false
		}, function() {
		  
		  $.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"UserData/user_status",
				datatype : "json", 
				data:{id:user_id,aktif_sts:1},
				success: function(data) {
					if(data){
						swal({title:"User Account Actived!", text:"this account now allowed to login", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Activating User Account!", text:"failed to activate user account", type:"error"});
					}	
				}
			}); 
		});
	}
	
	function conformDiaktif(user_id){
		swal({
			title: "Disable User Account ?",
			//text: email+" will not load or send email from or to your guest",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Disable",
			closeOnConfirm: false
		}, function() {
			$.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"UserData/user_status",
				datatype : "json", 
				data:{id:user_id,aktif_sts:0},
				success: function(data) {
					if(data){
						swal({title:"User Account Deactivated!", text:"this account now disallowed to login", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Deactivating User Account!", text:"failed to disable user account", type:"error"});
				   }	
				}
			}); 
		});
	}
	
</script>


<div class="modal fade" id="userDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
								<label class="form-label" >Email</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="email" name="email" readonly>
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Property Name</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="name" name="name" readonly>
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Property Address</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="address" name="address" readonly>
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Property Website</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="website" name="website" readonly>
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >API Key</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="api" name="api" readonly>
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Secret Key</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="secret" name="secret"readonly>
							</div>
						</div>	
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Aproved By</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="admin" name="admin" readonly>
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Property Logo</label>
								<div id="logo"><!-- SET ON AJAX!--> </div>
							</div>
						</div>						
						<div class="col-md-12" id="button-approve">     
							
						</div>
					</div>	
				
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-danger" type="button" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>
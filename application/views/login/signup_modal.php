<script>
	function openForm(){
		$('#registerModal').modal('show');
	}
	
	//REGISTER
	function save_user(){

		$('.loading-wrap').show();		
		$.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Login/register",
			datatype : "json", 
			data: $("#register").serialize(), 
			success: function(data) {
				$('.loading-wrap').hide();
				if(data=="success"){
					swal({title:"Succsess", text:"Successfully create your account, please login to access your dashboard", type:"success"},
					function(){ 
						window.location.href = "<?php echo base_url(); ?>"+"Event";
					});
					$('.confirm').addClass('sweet-alert-success');
				}else{
					swal({title:"Failed", text:"Failed to create account, please try again latter", type:"error"});
				}
			}
		});		
	}	
</script>
	
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-primary shadow border-0 mb-0">

					<div class="card-body px-lg-5 py-lg-5">
						<div class="text-center text-white mb-4 h2">
							<b>Joint with us now!</b>
						</div>
						<form id="register" action="POST">
							<div class="form-group mb-3">
								<div class="form-group">
									<label class="form-label text-white">Email</label>
									<input type="text" class="form-control" name="email" placeholder="Login Email" required>
								</div>
							</div>
							<div class="form-group">
								<div class="form-group text-white">
									<label class="form-label">Password</label>
									<input type="password" class="form-control" name="password" placeholder="Login Password" required>
								</div>
							</div>
							<div class="form-group">
								<div class="form-group text-white">
									<label class="form-label">Re-Password</label>
									<input type="password" class="form-control" name="repassword" placeholder="Re-Type Login Password" required>
								</div>
							</div>
							<div class="form-group">
								<div class="form-group text-white">
									<label class="form-label">Property Name</label>
									<input type="text" class="form-control" name="property_name" placeholder="Property Name" required> 
								</div>
							</div>
							<div class="form-group">
							   <div class="g-recaptcha" data-sitekey="6Lf2jMAUAAAAAEjWwTRh9oagZHeiDoLRRFpohkTC"></div>
							</div>
							<div class="text-center">
								<button type="button" class="btn btn-white my-4" style="color: #00000096;" onclick="save_user()" >Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

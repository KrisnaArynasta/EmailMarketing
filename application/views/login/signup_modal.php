<script>
	function openForm(){
		$('#registerModal').modal('show');
	}
	
	//REGISTER
	function save_event(){

		$('.loading-wrap').show();		
		$.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Hotel/tambah_hotel",
			datatype : "json", 
			data: $("#register").serialize(), 
			success: function(data) {
				$('.loading-wrap').hide();
				if(data=="success"){
					swal({title:"Event Created!", text:"successfully add new event", type:"success"},
					function(){ 
						window.location.href = "<?php echo base_url(); ?>"+"Event";
					});
					$('.confirm').addClass('sweet-alert-success');
				}else if(data=="main photo is empty"){
					swal({title:"Main Photo Cannot Be Empty!", text:"Failed add new event", type:"error"});
				}else{
					swal({title:"Failed add new event!", text:"Failed add new event", type:"error"});
				}
			}
		});		
	}	
</script>
		
	<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title" id="exampleModalLabel">Joint with us now!</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="register">
					<div class="modal-body">
						<div class="form-group">
							<label class="form-label">Email</label>
							<input type="text" class="form-control" name="email" placeholder="Text..">
						</div>
						<div class="form-group">
							<label class="form-label">Password</label>
							<input type="text" class="form-control" name="password" placeholder="Text..">
						</div>
							<div class="form-group">
							<label class="form-label">Re-Password</label>
							<input type="text" class="form-control" name="repassword" placeholder="Text..">
						</div>
						<div class="form-group">
							<label class="form-label">Property Name</label>
							<input type="text" class="form-control" name="property_name" placeholder="Text..">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>
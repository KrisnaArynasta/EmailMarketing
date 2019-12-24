<?php
  $title['title']="PEMS - Property Profile";
  $this->load->view('header',$title);
?>

<script>
	$(document).ready(function(){
		 $('#wait').hide();
		 $('#loading-wrap').hide();
			
	});
	
	
	// SAVE PROFILE
	function change_password(){
		
		var old_password = $('#old_password_hidden').val();
		var old_password_type = $('#old_password').val();
		var new_password = $('#new_password').val();
		var retype_password = $('#retype_password').val();
		
		var form = new FormData(document.getElementById("inputEvent"));

		if(old_password!=old_password_type){
			swal({title:"Error!", text:"The old password you entered was incorrect.", type:"error"});		
		}else if(new_password!=retype_password){
			swal({title:"Error!", text:"Re-type new password do not match.", type:"error"});
		}else{
		
			$('.loading-wrap').show();		
			$.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"Account/change_password_update/",
				mimeType: "multipart/form-data",
				datatype : "json", 
				data: form, 
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false, 			// To send DOMDocument or non processed data file it is set to false
				success: function(data) {
					$('.loading-wrap').hide();
					if(data){
						swal({title:"Password Changed", text:"successfully change your password", type:"success"},
						function(){ 
							window.location.href = "<?php echo base_url(); ?>"+"Login/logout";
							//location.reload(); 
						});
						$('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Error!", text:"Failed to change password", type:"error"});
					}
				}
			});		
		}	
	}
</script>
<!-- Data table css -->
<link href="assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
<!-- Data table css -->

<!-- Page content -->
<div class="container-fluid pt-8">
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0">Changed Password</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Account / Changed Password</li>
		</ol>

	</div>
	<div class="email-app card shadow">
		<div class="inbox p-0">
		
			<div class="card-body">
				<form id="inputEvent" action="" method="POST" enctype="multipart/form-data">
					<div class="row">
						<input type="hidden" value="<?=$this->session->userdata('user_password')?>" name="old_password_hidden" id="old_password_hidden">					
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Old Password</label>
								<input type="password" style="margin-right:5px;" class="form-control empty-validator" id="old_password" name="old_password" placeholder="Type your old password" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >New Password</label>
								<input type="password" style="margin-right:5px;" class="form-control empty-validator" id="new_password" name="new_password" placeholder="Type your new password" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Re-type New Password</label>
								<input type="password" style="margin-right:5px;" class="form-control empty-validator" id="retype_password" name="retype_password" placeholder="Re-type your new password" onchange="" onfocusout="">
							</div>
						</div>
						<div class="col-md-12 mt-4">  
							<button class="btn btn-icon btn-outline-primary btn-block mt-1 mb-1" type="button" onclick="change_password()">
								<span class="btn-inner--icon"><i class="fe fe-save"></i></span>
								<span class="btn-inner--text">Simpan</span>
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

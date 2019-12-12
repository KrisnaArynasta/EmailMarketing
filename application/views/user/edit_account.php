<?php
  $title['title']="PEMS - Property Profile";
  $this->load->view('header',$title);
?>

<script>
	$(document).ready(function(){
		 $('#wait').hide();
		 $('#loading-wrap').hide();
		
		$("#propertyLogo").dropify();
			
	});
	
	
	// SAVE PROFILE
	function save_event(){

		var form = new FormData(document.getElementById("inputEvent"));

		$('.loading-wrap').show();		
		$.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Account/update/",
			mimeType: "multipart/form-data",
			datatype : "json", 
			data: form, 
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false, 			// To send DOMDocument or non processed data file it is set to false
			success: function(data) {
				$('.loading-wrap').hide();
				if(data){
					swal({title:"Update Success", text:"successfully update property profile", type:"success"},
					function(){ 
						//window.location.href = "<?php echo base_url(); ?>"+"Account";
						location.reload(); 
					});
					$('.confirm').addClass('sweet-alert-success');
				}else{
					swal({title:"Failed!", text:"Failed to update your account", type:"error"});
				}
			}
		});		
	}	
</script>
<!-- Data table css -->
<link href="assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
<!-- Data table css -->

<!-- Page content -->
<div class="container-fluid pt-8">
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0">Property Profile</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Account</li>
		</ol>

	</div>
	<div class="email-app card shadow">
		<div class="inbox p-0">
		
			<div class="card-body">
				<form id="inputEvent" action="" method="POST" enctype="multipart/form-data">
					<div class="row">
						<?php foreach($data_edit as $user){?>
						
							<input type="hidden" value="<?=$user->user_id?>" name="user_id" id="user_id">
							<input type="hidden" value="<?=$user->property_logo?>" name="property_logo_old" id="property_logo_old">
						
							<div class="col-md-12">     
								<div class="form-group form-alert" id="lat-valid">
									<label class="form-label" >Login Email</label>
									<input type="text" value="<?=$user->email?>" style="margin-right:5px;" class="form-control empty-validator" id="user_email" name="user_email" onchange="" onfocusout="" readonly>
								</div>
							</div>
							<div class="col-md-12">     
								<div class="form-group form-alert" id="lat-valid">
									<label class="form-label" >Property Name</label>
									<input type="text" value="<?=$user->property_name?>" style="margin-right:5px;" class="form-control empty-validator" id="property_name" name="property_name" placeholder="e.g Nyuh Bengkok Tree House" onchange="" onfocusout="">
								</div>
							</div>
							<div class="col-md-12">     
								<div class="form-group form-alert" id="lat-valid">
									<label class="form-label" >Property Website</label>
									<input type="text" value="<?=$user->property_website?>" style="margin-right:5px;" class="form-control empty-validator" id="property_web" name="property_web" placeholder="e.g https://www.nyuhbengkok-treehouse.com" onchange="" onfocusout="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-alert">
									<label class="form-label">Property Address</label>
									<textarea class="form-control empty-validator" onfocusout="" id="property_address" name="property_address" rows="3" placeholder="e.g Sental Kangin, Ped Village, Nusa Penida, Indonesia (80771)...."><?=$user->property_address?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-alert">
									<label class="form-label">Property Logo</label>
									<input type="file" class="dropify" id="propertyLogo" name="property_logo" data-default-file="<?=base_url()?>images/property_logo/<?=$user->property_logo?>" data-max-file-size="3M" data-height="300"/>
								</div>
							</div>	
						<?php } ?>								
						<div class="col-md-12 mt-4">  
							<button class="btn btn-icon btn-outline-primary btn-block mt-1 mb-1" type="button" onclick="save_event()">
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


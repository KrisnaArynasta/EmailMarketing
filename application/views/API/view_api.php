<?php
  $title['title']="PEMS - Guests";
  $this->load->view('header',$title);
?>

<script>

</script>
<!-- Data table css -->
<link href="assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
<!-- Data table css -->

<!-- Page content -->
<div class="container-fluid pt-8">
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0">Integration and Documentation</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Integration API</li>
		</ol>	
	</div>
	<div class="card shadow">
		<div class="card-header" style="padding:0">
			<ul class="col-md-12 nav nav-tabs" id="myTab2" role="tablist" style="border-bottom: none;padding-right:0">
				<li class="col-md-6 nav-item" style="padding:0">
					<a class="nav-link active show" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-selected="true">Integration Key</a>
				</li>
				<li class="col-md-6 nav-item" style="padding:0">
					<a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-selected="false">Documentation</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
		<div class="tab-content" id="myTab2Content">
			<div class="tab-pane fade active show text-sm" id="home2" role="tabpanel" aria-labelledby="home-tab2">
			<label class="form-label" >
				Put this API Key and Secret Key at your header request. <br>take a look at decomentation tab, to see how to use the API Key and Secret Key with full documentation request
			</label>
			
				<form id="inputEvent" action="" method="POST" enctype="multipart/form-data">
					<div class="row">
						<input type="hidden" value="<?=$this->session->userdata('user_password')?>" name="old_password_hidden" id="old_password_hidden">					
						<div class="col-md-12">    
							<div class="row">
							<?php foreach($data_key as $data_key){ ?>
								<div class="col-md-6">  
									<div class="form-group form-alert" id="lat-valid">
										<label class="form-label" >API Key</label>
										<input type="text" style="margin-right:5px;" class="form-control empty-validator" readonly value="<?=$data_key->API_key?>">
									</div>
								</div>	
								<div class="col-md-6">  
									<div class="form-group form-alert" id="lat-valid">
										<label class="form-label" >Secret Key</label>
										<input type="text" style="margin-right:5px;" class="form-control empty-validator" readonly value="<?=$data_key->secret_key?>">
									</div>
								</div>	
							<?php }?>	
							</div>	
						</div>
					</div>	
				</form>	
			</div>
			<div class="tab-pane fade text-sm" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
				No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.
			</div>
		</div>
		
				
		</div>
	</div>
</div>

<!-- Data table js -->
<script src="<?=base_url()?>assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatable/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/js/datatable.js"></script>

<!-- sweet alert table js -->
<script src="<?=base_url()?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?=base_url()?>assets/js/sweet-alert.js"></script>
<script src="<?=base_url()?>assets/js/custom.js"></script>

<?php
	$this->load->view('modal');
	$this->load->view('footer');
?>


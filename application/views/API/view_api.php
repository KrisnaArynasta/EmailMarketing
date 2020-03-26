<?php
  $title['title']="PEMS - Integration and Documentation";
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
			<ul class="col-md-12 nav nav-tabs" id="myTab2" role="tablist" style="border-bottom: none;padding-right:0;">
				<li class="col-md-6 nav-item" style="padding:0">
					<a style="color:#515050" class="nav-link active show" id="integration-tab1" data-toggle="tab" href="#integration" role="tab" aria-selected="true"><b>Integration Key</b></a>
				</li>
				<li class="col-md-6 nav-item" style="padding:0">
					<a style="color:#515050" class="nav-link" id="doc-tab1" data-toggle="tab" href="#doc" role="tab" aria-selected="false"><b>Documentation</b></a>
				</li>
			</ul>
		</div>
		<div class="card-body">
		<div class="tab-content" id="myTab2Content">
			
			<div class="tab-pane fade active show text-sm" id="integration" role="tabpanel" aria-labelledby="integration-tab1">
							<div id="accordion">
					<div class="accordion">
						<div class="accordion-header" data-toggle="collapse" data-target="#panel-body-1">
							<h4>REQUIRED HEADER</h4>
						</div>
						<div class="accordion-body collapse show border border-top-0 text-sm" id="panel-body-1" data-parent="#accordion">
							<label class="form-label">
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
														<label class="form-label" ><b>API Key:</b></label>
														<input type="text" style="margin-right:5px;" class="form-control empty-validator" readonly value="<?=$data_key->API_key?>">
													</div>
												</div>	
												<div class="col-md-6">  
													<div class="form-group form-alert" id="lat-valid">
														<label class="form-label" ><b>Secret Key:</b></label>
														<input type="text" style="margin-right:5px;" class="form-control empty-validator" readonly value="<?=$data_key->secret_key?>">
													</div>
												</div>	
											<?php }?>	
											</div>	
										</div>
									</div>	
								</form>		
						</div>
					</div>
					<div class="accordion">
						<div class="accordion-header " data-toggle="collapse" data-target="#panel-body-2">
							<h4>REQUIRED KEY DATA</h4>
						</div>
						<div class="accordion-body collapse border border-top-0 text-sm" id="panel-body-2" data-parent="#accordion">
							<div>
								<h5><b>Method : POST</b></h5>
								Send these following data to integrate a new guest data <br>
								take a look at decomentation tab, to see how to put key data and it value with full documentation request
								<table class="table col-md-6 table-bordered">
								  <thead>
									<tr>
									  <th scope="col">Key</th>
									  <th scope="col">Value</th>
									</tr>
								  </thead>
									<tr>
										<td>guest_user_id</td>
										<td>(Insert Your Guest Hotel ID)</td>
									</tr>
									<tr>
										<td>guest_name</td>
										<td>(Insert Your Guest Name)</td>
									</tr>
									<tr>
										<td>guest_email</td>
										<td>(Insert Your Guest Email)</td>
									</tr>
									<tr>
										<td>guest_country</td>
										<td>(Insert Your Guest Hotel Country)</td>
									</tr>
								</table>
							</div>
							<div style="margin-top:40px">
								<h5><b>Method : PUT</b></h5>
								Send these following data to update or deactivate or activate a guest data <br>
								take a look at decomentation tab, to see how to put key data and it value with full documentation request
								<table class="table col-md-6 table-bordered">
								  <thead>
									<tr>
									  <th scope="col">Key</th>
									  <th scope="col">Value</th>
									</tr>
								  </thead>
									<tr>
										<td>guest_user_id</td>
										<td>(Insert Your Guest Hotel ID)</td>
									</tr>
									<tr>
										<td>guest_name</td>
										<td>(Insert Your Guest Name)</td>
									</tr>
									<tr>
										<td>guest_email</td>
										<td>(Insert Your Guest Email)</td>
									</tr>
									<tr>
										<td>guest_country</td>
										<td>(Insert Your Guest Hotel Country)</td>
									</tr>
									<tr>
										<td>role</td>
										<td>(update/deactivate/activate)</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade text-sm" id="doc" role="tabpanel" aria-labelledby="doc-tab1">
				you need to insert this code to your system code to integrate your system with PEMS. 
				if you do not have access, please contact your system developer. <br>
				why you need to do this ? <br>
				because it will make your system automaticlly send the new or updated guest data on your system to our server. 
				this will help you update your guest data on PEMS. 
				you will no longer integrate it manualy and will save you time a lot.
				
				<div class="card-body" style="padding:0px; margin-top:40px">
					<ul class="nav nav-tabs" id="myTab2" role="tablist">
						<li class="nav-item">
							<a class="nav-link" id="php-tab2" data-toggle="tab" href="#php" role="tab" aria-selected="true">PHP (cURL)</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="nodejs-tab2" data-toggle="tab" href="#nodejs" role="tab" aria-selected="false">NodeJS (Native)</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="ajax-tab2" data-toggle="tab" href="#ajax" role="tab" aria-selected="false">Jquery AJAX</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="java-tab2" data-toggle="tab" href="#java" role="tab" aria-selected="false">Java (OK HTTP)</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="clib-tab2" data-toggle="tab" href="#clib" role="tab" aria-selected="false">C (LibCurl)</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="crest-tab2" data-toggle="tab" href="#crest" role="tab" aria-selected="false">C# (RestSharp)</a>
						</li>	
						<li class="nav-item">
							<a class="nav-link" id="python-tab2" data-toggle="tab" href="#python" role="tab" aria-selected="false">Python 3 (http.client)</a>
						</li>			
						<li class="nav-item">
							<a class="nav-link" id="rubby-tab2" data-toggle="tab" href="#rubby" role="tab" aria-selected="false">Rubby (NET::Http)</a>
						</li>							
					</ul>
					<div class="tab-content tab-bordered" id="myTab2Content">
						<div class="tab-pane fade text-sm" id="php" role="tabpanel" aria-labelledby="php-tab2">
							<?php $this->load->view('API/doc_php');?>
						</div>
						<div class="tab-pane fade text-sm" id="nodejs" role="tabpanel" aria-labelledby="nodejs-tab2">
							<?php $this->load->view('API/doc_nodejs');?>
						</div>
						<div class="tab-pane fade text-sm" id="ajax" role="tabpanel" aria-labelledby="ajax-tab2">
							<?php $this->load->view('API/doc_ajax');?>
						</div>
						<div class="tab-pane fade text-sm" id="java" role="tabpanel" aria-labelledby="java-tab2">
							<?php $this->load->view('API/doc_java');?>
						</div>
						<div class="tab-pane fade text-sm" id="clib" role="tabpanel" aria-labelledby="clib-tab2">
							<?php $this->load->view('API/doc_c');?>
						</div>
						<div class="tab-pane fade text-sm" id="crest" role="tabpanel" aria-labelledby="crest-tab2">
							<?php $this->load->view('API/doc_c#');?>
						</div>
						<div class="tab-pane fade text-sm" id="python" role="tabpanel" aria-labelledby="python-tab2">
							<?php $this->load->view('API/doc_python');?>
						</div>
						<div class="tab-pane fade text-sm" id="rubby" role="tabpanel" aria-labelledby="rubby-tab2">
							<?php $this->load->view('API/doc_ruby');?>
						</div>						
					</div>
				</div>
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


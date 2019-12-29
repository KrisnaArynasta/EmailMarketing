<?php
  $title['title']="PEMS - Admin Area";
  $this->load->view('admin_area/admin_header',$title);
?>

<script>

</script>

<!-- Data table css -->
<link href="assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
<!-- Data table css -->

<!-- Page content -->
<div class="container-fluid pt-8">
	<div class="page-header mt-0 p-3">
		<h3 class="mb-sm-0">Admin Dashboard</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol>

	</div>
	
	<!-- NOTOFICATION -->
	<?php foreach ($data_proved_user as $data_proved_user){
		if($data_proved_user->result != 0){ ?>
			<a href="<?=base_url('UserData')?>">
				<div class="page-header mt-0 p-3 alert alert-danger mb-20" role="alert">
					<strong>Check it out!</strong> 
					<?=$data_proved_user->result;?>  New Users Need to be Checked
				</div>
			</a>	
	<?php 
			} 	
		}
	?>
	
	<div class="email-app card shadow">
		<div class="inbox p-0">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6 col-lg-6 col-xl-3 ">
						<div class="card shadow text-center">
							<div class="card-body">
								<div class="text-center mx-auto server">
									 <i class="fab fas fa-user icon text-primary"></i>
								</div>
								<div class="text mt-2">
									<?php foreach ($data_user as $data_user) {?>
									<h1 class="mb-0"><?=$data_user->result?></h1>
									<label class="text-muted">Users <br>Active</label>
									<?php } ?>
								</div>
								<div class="options mt-3">
									<a href="<?=base_url('EmailOutbox')?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i> View Details</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-xl-3">
						<div class="card shadow text-center">
							<div class="card-body">
								<div class="mx-auto server">
									<i class="fas fa-calendar-alt icon text-info"></i>
								</div>
								<div class="text mt-2">
									<?php foreach ($data_event as $data_event) {?>
									<h1 class="mb-0"><?=$data_event->result?></h1>
									<label class="text-muted">Event <br>Created</label>
									<?php } ?>
								</div>
								<div class="options mt-3">
									<a href="<?=base_url('Event')?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-search"></i> View Details</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-xl-3">
						<div class="card shadow text-center">
							<div class="card-body">
								<div class="mx-auto server">
									<i class="fas fa-list-alt icon text-success"></i>
								</div>
								<div class="text mt-2">
									<?php foreach ($data_questionnaire as $data_questionnaire) {?>
									<h1 class="mb-0"><?=$data_questionnaire->result?></h1>
									<label class="text-muted">Questionnaire  <br>Created</label>
									<?php } ?>
								</div>
								<div class="options mt-3">
									<a href="javascript:;" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-search"></i> View Details</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-xl-3">
						<div class="card shadow text-center">
							<div class="card-body">
								<div class="mx-auto server">
									<i class="fas fa-address-book icon text-cyan"></i>
								</div>
								<div class="text mt-2">
									<?php foreach ($data_guest as $data_guest) {?>
									<h1 class="mb-0"><?=$data_guest->result?></h1>
									<label class="text-muted">Guest Data  <br>Integrated</label>
									<?php } ?>
								</div>
								<div class="options mt-3">
									<a href="<?=base_url('Guest')?>" class="btn bg-cyan btn-sm" style="color: #fff;"><i class="glyphicon glyphicon-search"></i> View Details</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
			
		</div>
	</div>
</div>

<?php
	$this->load->view('event/event_modal');
	$this->load->view('modal');
	$this->load->view('admin_area/admin_footer');
?>

<!-- Page content -->

<!-- sweet alert table js -->
<script src="<?=base_url()?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?=base_url()?>assets/js/sweet-alert.js"></script>
<script src="<?=base_url()?>assets/js/custom.js"></script>

<!-- pagination -->
<script>
	$('.page-link').each(function (index, value) {
		link = $(this).children(":first").attr('href');
		pagination_page = $(this).children(":first").attr('data-ci-pagination-page');
		html = $(this).children(":first").html()
		if(link != null){
			$(this).wrap('<a href="'+link+'"'+'data-ci-pagination-page="'+pagination_page+'" ></a>');
			$(this).empty();
			$(this).html(html);
		}
	});
</script>

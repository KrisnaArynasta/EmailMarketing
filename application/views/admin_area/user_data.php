<?php
  $title['title']="PEMS -Users Data";
  $this->load->view('admin_area/admin_header',$title);
  $this->load->view('admin_area/user_data_modal');
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
		<h3 class="mb-sm-0">Users Data</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Users Data</li>
		</ol>	
	</div>
	<div class="card shadow">
		<div class="card-header">
			<div class="row">
				<div class="col-md-6">
					<h2 class="mb-0">Users Data</h2>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered w-100 text-nowrap" style="text-align:center;">
					<thead>
						<tr>
							<th class="wd-15p">User Email</th>
							<th class="wd-15p">Property Name</th>
							<th class="wd-15p">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data_user as $row_user){?>
						<?=($row_user->user_status_active==0)?"<tr style='opacity:0.5;border:2px solid #1ff' title='Not Active User'>":"<tr>"?>
							<td><?=$row_user->email?></td>
							<td><?=$row_user->property_name?></td>
							<td><a href="javascript:view_detail_user(<?=$row_user->user_id?>);"><i class="fe fe-eye"></i></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
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
	$this->load->view('event/event_modal');
	$this->load->view('modal');
	$this->load->view('admin_area/admin_footer');
?>


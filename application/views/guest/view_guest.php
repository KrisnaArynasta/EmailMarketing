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
		<h3 class="mb-sm-0">Your Guests</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Guests</li>
		</ol>	
	</div>
	<div class="card shadow">
		<div class="card-header">
			<div class="row">
				<div class="col-md-6">
					<h2 class="mb-0">Guests Data</h2>
				</div>
				<div class="col-md-6">
					<button class="btn btn-primary float-right" type="file">Insert Bulk Data</button>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered w-100 text-nowrap" style="text-align:center;">
					<thead>
						<tr>
							<th class="wd-15p">Guest ID</th>
							<th class="wd-15p">Guest Name</th>
							<th class="wd-15p">Guest Email</th>
							<th class="wd-20p">Country</th>
							<th class="wd-15p">Last Update</th>
							<th class="wd-15p">Inserted on</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($guest_data as $row_geuest){?>
						<?=(!$row_geuest->guest_active_status)?"<tr style='opacity:0.5' title='Not Active Guest'>":"<tr>"?>
							<td><?=$row_geuest->guest_user_id?></td>
							<td><?=$row_geuest->guest_name?></td>
							<td><?=$row_geuest->guest_email?></td>
							<td><?=$row_geuest->guest_country?></td>
							<td><?=$row_geuest->guest_last_update?></td>
							<td><?=$row_geuest->guest_insert_date?></td>
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
	$this->load->view('modal');
	$this->load->view('footer');
?>


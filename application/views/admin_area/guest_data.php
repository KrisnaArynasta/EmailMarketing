<?php
  $title['title']="PEMS - Property Guest Data";
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
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0">Guest Data</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Guest Data</li>
		</ol>	
	</div>
	<div class="card shadow">
		<div class="card-header">
			<div class="row">
				<div class="col-md-6">
					<h2 class="mb-0">Guest Data</h2>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered w-100 text-nowrap" style="text-align:center;">
					<thead>
						<tr>
							<th class="wd-15p">Property Origin</th>
							<th class="wd-15p">Guest Name</th>
							<th class="wd-15p">Guest Email</th>
							<th class="wd-15p">Guest Country</th>
							<th class="wd-15p">Subscribe Status</th>
							<th class="wd-15p">Active Status</th>
							<th class="wd-15p">Inserted On</th>
							<th class="wd-15p">Last Modify</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data_guest as $row_guest){?>
						<tr>
							<td><?=$row_guest->property_name?></td>
							<td><?=$row_guest->guest_name?></td>
							<td><?=$row_guest->guest_email?></td>
							<td><?=$row_guest->guest_country?></td>
							<td><?=($row_guest->guest_subscribe_status==0)?"No Longer Subscribed":"Subscribe"?></td>
							<td><?=($row_guest->guest_active_status==0)?"Not Active":"Active"?></td>
							<td><?=$row_guest->guest_insert_date?></td>
							<td><?=$row_guest->guest_last_update?></td>
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


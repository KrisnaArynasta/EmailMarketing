<?php
  $title['title']="PEMS - Event Data";
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
		<h3 class="mb-sm-0">Event Data</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Event Data</li>
		</ol>	
	</div>
	<div class="card shadow">
		<div class="card-header">
			<div class="row">
				<div class="col-md-6">
					<h2 class="mb-0">Event Data</h2>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered w-100 text-nowrap" style="text-align:center;">
					<thead>
						<tr>
							<th class="wd-15p">Create By</th>
							<th class="wd-15p">Event Name</th>
							<th class="wd-15p">Event Send On</th>
							<th class="wd-15p">Sent Status</th>
							<th class="wd-15p">Active Status</th>
							<th class="wd-15p">Delete Status</th>
							<th class="wd-15p">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data_event as $row_event){
							$send_on = date('Y-m-d', strtotime($row_event->event_date.' - '.$row_event->message_send_before.'days'));
						?>
						<tr>
							<td><?=$row_event->property_name?></td>
							<td><?=$row_event->event_name?></td>
							<td><?=$send_on?></td>
							<td><?=($send_on < date('Y-m-d')? "Sent" : "Waiting")?></td>
							<td><?=($row_event->event_status_active==0)?"Not Active":"Active"?></td>
							<td><?=($row_event->event_status_delete==0)?"Available":"Deleted"?></td>
							<td><a title="View Email Template" href="javascript:view_email_event(<?=$row_event->event_id?>);"><i class="fe fe-eye"></i></a></td>
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
	$this->load->view('admin_area/admin_footer');
?>


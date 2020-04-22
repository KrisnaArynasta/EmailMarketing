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
							<th class="wd-15p">Questionnaire Name</th>
							<th class="wd-15p">Questionnaire Created On</th>
							<th class="wd-15p">Questionnaire Send On</th>
							<!--<th class="wd-15p">Email Message</th>!-->
							<th class="wd-15p">Total Receiver</th>
							<th class="wd-15p">Total Responden</th>
							<th class="wd-15p">Delete Status</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data_questionnaire as $row_questionnaire){
						?>
						<tr>
							<td><?=$row_questionnaire->property_name?></td>
							<td><?=$row_questionnaire->questionnaire_name?></td>
							<td><?=$row_questionnaire->questionnaire_date_create?></td>
							<td><?=$row_questionnaire->questionnaire_send_on?><?=($row_questionnaire->questionnaire_send_on < date('Y-m-d'))?" (Sent)":" (Waiting)"?></td>
							<!--<td><?=$row_questionnaire->questionnaire_message?></td>!-->
							<td><?=$row_questionnaire->send_count?></td>
							<td><?=($row_questionnaire->count_responnd)?$row_questionnaire->count_responnd:"0"?></td>
							<td><?=($row_questionnaire->questionnaire_status_delete==0)?"Available":"Deleted"?></td>
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


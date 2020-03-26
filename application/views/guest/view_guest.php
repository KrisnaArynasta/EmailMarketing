<?php
  $title['title']="PEMS - Guests";
  $this->load->view('header',$title);
?>

<script>
function conformAktif(id, name){
		swal({
			title: "Activate Guest "+name+"?",
			text: name+" will be an active user to receive email if subscribing",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Activate",
			closeOnConfirm: false
		}, function() {
		  
		  $.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"Guest/guest_active_status",
				datatype : "json", 
				data:{id:id,aktif_sts:1},
				success: function(data) {
					if(data){
						swal({title:"Guest Actived!", text:+name+" has become an active user", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Failed!", text:"failed to activate guest", type:"error"});
					}	
				}
			}); 
		});
	}
	
	function conformDiaktif(id, name){
		swal({
			title: "Deactivated "+name+"?",
			text: name+" will be a non-active user and will not receive any event email",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Deactivated",
			closeOnConfirm: false
		}, function() {
			$.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"Guest/guest_active_status",
				datatype : "json", 
				data:{id:id,aktif_sts:0},
				success: function(data) {
					if(data){
						swal({title:"Email Account Deactivated!", text:+name+" has become a non-active user", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Failed!", text:"failed to deactivated guest", type:"error"});
				   }	
				}
			}); 
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
					<button class="btn btn-primary float-right" style="margin-right:10px" data-toggle="modal" data-target="#addGuest"><i class="fe fe-plus"></i> New Guest</button>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered w-100 text-nowrap" style="text-align:center;">
					<thead>
						<tr>
							<th class="wd-15p">Guest Hotel ID</th>
							<th class="wd-15p">Guest Name</th>
							<th class="wd-15p">Guest Email</th>
							<th class="wd-20p">Country</th>
							<th class="wd-20p">Subscribe Status</th>
							<th class="wd-15p">Last Update</th>
							<th class="wd-15p">Inserted on</th>
							<th class="wd-15p">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($guest_data as $row_guest){?>
						<?=(!$row_guest->guest_active_status)?"<tr style='background-color:#d00909;color:#fff' title='Not Active Guest'>":"<tr>"?>
							<td><?=$row_guest->guest_user_id?></td>
							<td><?=$row_guest->guest_name?></td>
							<td><?=$row_guest->guest_email?></td>
							<td><?=$row_guest->guest_country?></td>
							<td><?=($row_guest->guest_subscribe_status)?"Subscribe":"Unsubscribed"?></td>
							<td><?=$row_guest->guest_last_update?></td>
							<td><?=$row_guest->guest_insert_date?></td>
							<td>
								<center>
										<a href="javascript:edit_guest(<?=$row_guest->guest_id?>)" title="Edit Guest Data"><i class="fe fe-edit"></i></a>
									<?php if(!$row_guest->guest_active_status){?>
										<a href="javascript:conformAktif(<?=$row_guest->guest_id?>,'<?=$row_guest->guest_name?>')" title="Active Guest"><i class="fe fe-check-square"></i></a>													
									<?php } else{ ?>
										<a href="javascript:conformDiaktif(<?=$row_guest->guest_id?>,'<?=$row_guest->guest_name?>')" title="Non-activate Guest"><i class="fe fe-slash"></i></a>													
									<?php } ?>
								</center>
							</td>
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
	$this->load->view('Guest/guest_modal');
	$this->load->view('footer');
?>


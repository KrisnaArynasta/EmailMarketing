<?php
  $title['title']="PEMS - E-mail Accounts";
  $this->load->view('header',$title);
?>

<script>
	$(document).ready(function(){
		 $('#wait').hide();
		 $('#loading-wrap').hide();
			
	});
	
	function conformAktif(email_id, email){
		swal({
			title: "Activate Email Account "+email+"?",
			text: email+" will load or send email from or to your guest",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Activate",
			closeOnConfirm: false
		}, function() {
		  
		  $.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"Account/email_account_status",
				datatype : "json", 
				data:{id:email_id,aktif_sts:1},
				success: function(data) {
					if(data){
						swal({title:"Email Account Actived!", text:"this email account now will load or send email from or to your guest", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Activating Email Account!", text:"failed to activate email account", type:"error"});
					}	
				}
			}); 
		});
	}
	
	function conformDiaktif(email_id, email){
		swal({
			title: "Disable Email Account "+email+"?",
			text: email+" will not load or send email from or to your guest",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Disable",
			closeOnConfirm: false
		}, function() {
			$.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"Account/email_account_status",
				datatype : "json", 
				data:{id:email_id,aktif_sts:0},
				success: function(data) {
					if(data){
						swal({title:"Email Account Deactivated!", text:"this email account now will not load or send email from or to your guest", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Deactivating Email Account!", text:"failed to disable email account", type:"error"});
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
		<h3 class="mb-sm-0">Property Email Accounts</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Account</li>
		</ol>

	</div>
	<div class="card shadow">
		<div class="card-header">
			<h2 class="mb-0">Data Email Account</h2>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered w-100 text-nowrap" style="text-align:center;">
					<thead>
						<tr>
							<th class="wd-15p">E-mail<br>Account</th>
							<th class="wd-15p">E-mail<br>Password</th>
							<th class="wd-20p">IMAP<br>Host</th>
							<th class="wd-15p">SMTP<br>Host</th>
							<th class="wd-15p">Sending<br>Limit</th>
							<th class="wd-25p">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data as $row_email){?>
						<?=(!$row_email->email_status_active)?"<tr style='background-color:#a8a8a81f;'>":"<tr>"?>
							<td><?=$row_email->email?></td>
							<td>
								<?=substr($row_email->password,0,strlen(($row_email->password)-1))?>
								<?php for($c=1;$c<strlen($row_email->password);$c++){echo "&#8226";}?>
							</td>
							<td><?=$row_email->inbox_host?></td>
							<td><?=$row_email->sender_host?></td>
							<td><?=$row_email->limit_email?></td>
							<td>
								<!-- EDIT ICON !-->
								<a href="javascript:edit_email_account(<?=$row_email->email_sender_id?>)"><span class="btn-inner--icon"><i class="fe fe-edit-3"></i></span></a>
								<!-- AKTIVATING ICON !-->
								<?php if(!$row_email->email_status_active){?>
									<a class="icon-gray" href="javascript:conformAktif(<?=$row_email->email_sender_id?>, '<?=$row_email->email?>');"><i class="fe fe-check-square"></i></a>													
								<?php } else{ ?>
									<a class="icon-warning" href="javascript:conformDiaktif(<?=$row_email->email_sender_id?>, '<?=$row_email->email?>');"><i class="fe fe-x-square"></i></a>												
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Button Tambah Melayang !-->
<button class="float btn btn-icon btn-add btn-info mt-1 mb-1" data-tooltip="tooltip" data-placement="left" title="" data-original-title="Create new email account" data-toggle="modal" data-target="#createEmailAccount">
	<span class="btn-inner--icon"><i class="fe fe-plus"></i></span>
</button>


<!-- Page content -->

<!-- file uploads js -->
<script src="<?=base_url()?>assets/plugins/fileuploads/js/dropify.min.js"></script>
<!-- Data table js -->
<script src="<?=base_url()?>assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatable/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/js/datatable.js"></script>

<!-- sweet alert table js -->
<script src="<?=base_url()?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?=base_url()?>assets/js/sweet-alert.js"></script>
<script src="<?=base_url()?>assets/js/custom.js"></script>

<?php
	$this->load->view('user/email_account_modal');
	$this->load->view('modal');
	$this->load->view('footer');
?>





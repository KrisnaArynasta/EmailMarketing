<?php
  $title['title']="PEMS - Your Event";
  $this->load->view('header',$title);
?>

<script>
	$(document).ready(function(){
		$('#wait').hide();
		$('#loading-wrap').hide();
	});
	
	function conformAktif(event_id, event_name){
		swal({
			title: "Activate Event "+event_name+"?",
			text: event_name+" event emails will send to your guests on the send date",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Activate",
			closeOnConfirm: false
		}, function() {
		  
		  $.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"Event/aktif",
				datatype : "json", 
				data:{id:event_id,aktif_sts:1},
				success: function(data) {
					if(data=="success"){
						swal({title:"Event Actived!", text:"this event email will send to your guests on the send date", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Event Actived!", text:"fail to activating event", type:"success"});
					}	
				}
			}); 
		});
	}
	
	function conformDiaktif(event_id, event_name){
		swal({
			title: "Disable Event "+event_name+"?",
			text: event_name+" event emails will not send to your guests",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Disable",
			closeOnConfirm: false
		}, function() {
			$.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"Event/aktif",
				datatype : "json", 
				data:{id:event_id,aktif_sts:0},
				success: function(data) {
					if(data=="success"){
						swal({title:"Event Dactivated!", text:"this event email will not send to your guests", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Event Deactivated!", text:"fail to disable event", type:"success"});
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
		<h3 class="mb-sm-0">Your Event</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Event</li>
		</ol>

	</div>
	<div class="email-app card shadow">
		<div class="inbox p-0">
		
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Form  -->
							<?php 
								$attributes = array('class' => 'form-group', 'id' => 'formCari'); 
								echo form_open("Event",$attributes); 
							?>
							<div class="form-group mb-0">
								<div class="input-group">
									<input type="text" class="form-control" name="search" placeholder="Find event or event description">
                    				<button type="submit" class="input-group-text search-button pointer"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>
		
			<div class="card-body">
				<div class="row">
					<?php  
						// cek data event ada atau tidak 	
						if( !empty($event)){
							// dapetin event dari tbl_event							
							foreach($event as $row_event){
							$send_on = date('Y-m-d', strtotime($row_event->event_date.' - '.$row_event->message_send_before.'days'));
					?>				
						<div class="col-lg-4 col-sm-12" style="opacity:<?=($send_on < date('Y-m-d')? 0.4 : 1)?>">
							<div class="card shadow">
								<a data-tooltip="tooltip" data-placement="top" title="" data-original-title="View Email Tamplate" href="javascript:view_email_event(<?=$row_event->event_id?>);">
									<img class="card-img-top img-fluid" src="<?=base_url()?>images/event_photos/event_main_photos/<?=$row_event->event_main_photo?>" alt="Failed to load image" style="object-fit: cover;height: 250px;">
								</a>
								<div class="card-body">
									<div class="col-md-12" style="margin:0; padding:0">
												<center>
												<!-- EDIT ICON !-->
												<a class="tooltipped" data-position="top" data-tooltip="Edit Event" href="<?=base_url('Event/')?>edit/<?=$row_event->event_id?>"><span class="btn-inner--icon"><i class="fe fe-edit-3"></i></span></a>
												<!-- AKTIVATING ICON !-->
												<?php if(!$row_event->event_status_active){?>
													<span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Activate Event"><a class="icon-gray" href="javascript:conformAktif(<?=$row_event->event_id?>, '<?=$row_event->event_name?>');"><i class="fe fe-check-square"></i></a></span>														
												<?php } else{ ?>
													<span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Non-activate Event"><a class="icon-warning" href="javascript:conformDiaktif(<?=$row_event->event_id?>, '<?=$row_event->event_name?>');"><i class="fe fe-x-square"></i></a></span>														
												<?php } ?>
												<!-- DELETE ICON !-->
												<?php if(!$row_event->event_status_delete){?>
													<span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Delete Event"><a class="icon-gray" href="javascript:deleteEvent(<?=$row_event->event_id?>, '<?=$row_event->event_name?>');"><i class="fe fe-trash-2"></i></a></span>														
												<?php } ?>
												<h3 class="card-title"><?=$row_event->event_name?></h3>
												</center>
										
									</div>	
									<a data-tooltip="tooltip" data-placement="top" title="" data-original-title="View Email Tamplate" href="javascript:view_email_event(<?=$row_event->event_id?>);" style="color:#000000c9">
										<p class="card-text">
											<?php if(strlen($row_event->event_description)<80) echo $row_event->event_description."<br><br>"; 
													else echo substr($row_event->event_description, 0, 80)."...";?>
										</p>
										<div class="col-md-12" style="opacity:0.6">
											<div class="row">
												<div class="col-md-6"><small>
													Event Date<br><b><?=$row_event->event_date?></b>
												</small></div>
												<div class="col-md-6 float-right text-right"><small>
													Send On<br><b><?=$send_on?></b>
												</small></div>
											
											</div>
										</div>
									</a>	
								</div>
							</div>
						</div>
					<?php 
						} 
					?>
							<div class="col-md-12">
					<?php 
						// link paging
						if (isset($links)) {
								echo "<div class='col-md-12'>".$links."</div>";
							}
						// jika data event tidak ada  
						} else  { ?>
							<div class="col-md-12">
								<b><h3 style='opacity:0.4; text-align:center; margin-top:50px'>You Dont Have Any Event Yet!</h3></b> <br>
							</div>	
					<?php } ?>
							</div>	
					<!-- Button Tambah Melayang !-->
					<a href="<?=base_url('Event/create')?>">
						<button class="float btn btn-icon btn-add btn-info mt-1 mb-1" data-tooltip="tooltip" data-placement="left" title="" data-original-title="Create new event">
							<span class="btn-inner--icon"><i class="fe fe-plus"></i></span>
						</button>
					</a>
				</div>
			</div>			
		</div>
	</div>
</div>

<?php
	$this->load->view('event/event_modal');
	$this->load->view('modal');
	$this->load->view('footer');
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

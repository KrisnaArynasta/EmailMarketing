<?php
  $title['title']="PEMS - Your Event";
  $this->load->view('header',$title);
?>

<script>
	$(document).ready(function(){
		$('#wait').hide();
		$('#loading-wrap').hide();
	});

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
								echo form_open("TekananManometer",$attributes); 
							?>
							<div class="form-group mb-0">
								<div class="input-group">
									<input type="text" class="form-control" name="cari" placeholder="Find event or event description">
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
					?>				
						<div class="col-lg-4 col-sm-12">
							<div class="card shadow">
								<img class="card-img-top img-fluid" src="<?=base_url()?>images/event_photos/event_main_photos/<?=$row_event->event_main_photo?>" alt="Failed to load image" style="object-fit: cover;height: 250px;">
								<div class="card-body">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<h4 class="card-title"><?=$row_event->event_name?></h4>
											</div>
											<div class="col-md-4">
												<a class="tooltipped" data-position="top" data-tooltip="Edit Event" href="<?=base_url('Event/')?>edit/<?=$row_event->event_id?>"><span class="btn-inner--icon"><i class="fe fe-edit"></i></span></a>
												<?php if(!$row_event->event_status_active){?>
													<span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Activate Event"><a class="icon-gray" href="javascript:conformAktif(<?=$row_event->event_id?>);"><i class="fe fe-eye"></i></a></span>														
												<?php } else{ ?>
													<span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Non-activate Event"><a class="icon-warning" href="javascript:conformDiaktif(<?=$row_event->event_id?>);"><i class="fe fe-eye-off"></i></a></span>														
												<?php } ?>
											</div>
										</div>	
									</div>	
									<p class="card-text">
										<?php if(strlen($row_event->event_description)<80) echo $row_event->event_description."<br><br>"; 
												else echo substr($row_event->event_description, 0, 80)."...";?>
									</p>
									<div class="col-md-12" style="opacity:0.6">
										<div class="row">
											<div class="col-md-6"><div class="row"><small>
												Event Date<br><b><?=$row_event->event_date?></b>
											</small></div></div>
											<div class="col-md-6"><div class="row"><small>
												Send On<br><b><?=$row_event->event_date?></b>
											</small></div></div>
										
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php 
						} 
					?>
					
					<?php 
						// link paging
						if (isset($links)) {
								echo $links;
							}
						// jika data event tidak ada  
						} else  { ?>
							<div class="col-md-12">
								<b><h3 style='opacity:0.4; text-align:center; margin-top:50px'>You Dont Have Any Event Yet!</h3></b> <br>
							</div>	
					<?php } ?>
					
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

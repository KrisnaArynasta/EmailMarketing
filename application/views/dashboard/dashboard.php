<?php
  $title['title']="PEMS - Dashboard";
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
		<h3 class="mb-sm-0">Preview Your Activity</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol>

	</div>
	<div class="email-app card shadow">
		<div class="inbox p-0">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6 col-lg-6 col-xl-3 ">
						<div class="card shadow text-center">
							<div class="card-body">
								<div class="text-center mx-auto server">
									 <i class="fab fa-telegram-plane icon text-primary"></i>
								</div>
								<div class="text mt-2">
									<?php foreach ($data_outbox as $data_outbox) {?>
									<h1 class="mb-0"><?=$data_outbox->result?></h1>
									<label class="text-muted">Email <br>Sent Today</label>
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
									<label class="text-muted">Event  <br>Waiting to Send</label>
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
									<h1 class="mb-0">3</h1>
									<label class="text-muted">Questionnaire  <br>Respond</label>
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

		<div class="card-body">
			<h2 align="center">Your Last Inbox</h2>
			<ul class="mail_list list-group list-unstyled">
			<?php 
				// dapetin email dari tbl_inbox								
				foreach($data_inbox as $row_email){
			?>					
				<li class="list-group-item <?=($row_email->seen_status ? 'read-email' : 'unread')?>">
					<div class="media">
						<div class="media-body">
							<div class="media-heading">
								<div class="mr-2" style=" font-weight: bold;">
									<?=$row_email->inbox_subject?>
									<small style="font-style: italic; font-size:11px"> 
										<?=$row_email->inbox_guest_name?>
									</small>
									<?=($row_email->answered_status ? "<span class='badge bg-success text-white'>Answered</span>" : "")?>
								</div>
								<small class="float-right text-muted">
									<time class="hidden-sm-down" datetime="2017">
										<?=$row_email->inbox_date?>
									</time>
									<i class="zmdi zmdi-attachment-alt ml-2"></i> 
								</small>
							</div>
							<p class="msg">To : <?=$row_email->inbox_to?></p>
						</div>
					</div>
				</li>					
			<?php 
				} 
			?>
			</ul>
			<div style="margin-top:20px" align="center"> <a  href="<?=base_url('EmailInbox')?>">See More ...</a></div>
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

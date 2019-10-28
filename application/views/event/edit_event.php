<?php
  $title['title']="PEMS - Edit Event";
  $this->load->view('header',$title);
?>

<script>

	$(document).ready(function(){
		 $('#wait').hide();
		 $('#loading-wrap').hide();

		CKEDITOR.replace('event_email');
		$("#edit_event_main_photo").dropify();
		$("#edit_event_photos").dropify();
		$("#event_date").datepicker();
		$("#send_on").datepicker();
	});
	
	function update_event(){
		
		for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
		
		var form = new FormData(document.getElementById("inputEvent"));
		form.append('event_main_photo',$('#event_main_photo')[0].files[0]);
		form.append('event_name ',$('#event_name').val());
		form.append('event_date ',$('#event_date').val());
		form.append('send_on ',$('#send_on').val());
		form.append('event_desc ',$('#event_desc').val());
		form.append('event_email ',CKEDITOR.instances.event_email.getData());
	
		$('.loading-wrap').show();		
		$.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Event/insert/",
			mimeType: "multipart/form-data",
			datatype : "json", 
			data: form, 
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false, 			// To send DOMDocument or non processed data file it is set to false
			success: function(data) {
				$('.loading-wrap').hide();
				if(data=="success"){
					swal({title:"Event Created!", text:"successfully add new event", type:"success"},
					function(){ 
						window.location.href = "<?php echo base_url(); ?>"+"Event";
					});
					$('.confirm').addClass('sweet-alert-success');
				}else if(data=="photo is empty"){
					swal({title:"Main Photo Cannot Be Empty!", text:"Failed add new event", type:"error"});
				}else{
					swal({title:"Failed add new event!", text:"Failed add new event", type:"error"});
				}
			}
		})		
	}
	
</script>
<!-- Data table css -->
<link href="assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
<!-- Data table css -->

<!-- Page content -->
<div class="container-fluid pt-8">
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0">Edit Event</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Event</li>
		</ol>

	</div>
	<div class="email-app card shadow">
		<div class="inbox p-0">
		
			<div class="card-body">
				<form id="inputEvent" action="" method="POST" enctype="multipart/form-data">
					<div class="row">
					<?php foreach($data_edit as $event){?>
						<div class="col-md-12">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Event Name</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="event_name" name="event_name" placeholder="e.g Christmas" onchange="" onfocusout="" value="<?=$event->event_name?>">
							</div>
						</div>
						<div class="col-md-6">     
							<div class="form-group form-alert" id="lat-valid">
								<label class="form-label" >Event Date</label>
								<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="event_date" name="event_date" placeholder="e.g 2019-12-25" onchange="" onfocusout="" value="<?=$event->event_date?>">
							</div>
						</div>
						<div class="col-md-6" >
							<div class="form-group form-alert" id="lng-evalid">
								<label class="form-label" >Send Email On</label>
								<input type="text" class="form-control empty-validator" id="send_on" name="send_on" placeholder="e.g 2019-08-01" onchange="" onfocusout="" value="<?=date_format(date_sub(date_create($event->event_date),date_interval_create_from_date_string("$event->message_send_before days")),"Y-m-d")?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group form-alert">
								<label class="form-label">Event Description</label>
								<textarea class="form-control empty-validator" onfocusout="" id="event_desc" name="event_desc" rows="3" placeholder="e.g Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25...."><?=$event->event_description?></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group form-alert">
								<label class="form-label">Message to Send</label>
								<textarea class="form-control empty-validator" onfocusout="" id="event_email" name="event_email" rows="3" placeholder="e.g Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25...."><?=$event->event_message?></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-alert">
								<label class="form-label">Event Main Photo</label>
								<input type="file" class="dropify" id="edit_event_main_photo" name="edit_event_main_photo" data-max-file-size="1M" data-height="300"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-alert">
								<label class="form-label">Current Main Photo</label>
								<img class="card-img-top img-fluid" src="<?=base_url()?>images/event_photos/<?=$event->event_main_photo?>" alt="Failed to load image">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group form-alert">
								<label class="form-label">Event Photos</label>
								<div class="col-md-4">
									<input type="file" class="dropify" id="edit_event_photos" name="edit_event_photos" data-max-file-size="1M" />
								</div>	
							</div>
						</div>							
						<div class="col-md-12 mt-4">  
							<button class="btn btn-icon btn-outline-primary btn-block mt-1 mb-1" type="button" onclick="save_event()">
								<span class="btn-inner--icon"><i class="fe fe-save"></i></span>
								<span class="btn-inner--text">Simpan</span>
							</button>
						</div>
					<?php }?>
					</div>
				</form>		
			</div>			
		</div>
	</div>
</div>

<?php
	$this->load->view('modal');
	$this->load->view('footer');
?>


<!-- Page content -->

<!-- file uploads js -->
<script src="<?=base_url()?>assets/plugins/fileuploads/js/dropify.min.js"></script>

<!-- sweet alert table js -->
<script src="<?=base_url()?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?=base_url()?>assets/js/sweet-alert.js"></script>
<script src="<?=base_url()?>assets/js/custom.js"></script>

<!-- Date Picker-->
<script src="<?=base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- pagination -->
<script>

   $(document).ready(function(){
   
        $("#event_date").datepicker({
		  dateFormat: 'yy-mm-dd',
	        minDate: 1,
    
			onSelect: function(selected) {
			var minEnd = new Date($("#event_date").datepicker("getDate"));
			minEnd.setDate(minEnd.getDate() + 1);
	          $("#send_on").datepicker("option","minDate", minEnd)
	        }

        });
        
		
		$("#send_on").datepicker({
		  dateFormat: 'yy-mm-dd',  
	        onSelect: function(selected) {
	           $("#event_date").datepicker("option","maxDate", selected)
			}
		});
    
	
	});

</script>

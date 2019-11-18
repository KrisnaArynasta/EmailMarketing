<?php
  $title['title']="PEMS - Edit Event";
  $this->load->view('header',$title);
?>

<script>
	$(document).ready(function(){
		 $('#wait').hide();
		 $('#loading-wrap').hide();

		CKEDITOR.replace( 'event_email' );
		
		$("#edit_event_main_photo").dropify();
		//$("#edit_event_photos").dropify();
		$("#event_date").datepicker();
		$("#send_on").datepicker();
		
		$(".dropify-event").dropify();
		var drEvent = $('.dropify-event').dropify();

        drEvent.on('dropify.afterClear', function(event, element){
            $(this).parents('.input-field').remove();
        });
		
		//PHOTO MULTI INPUTS
		function newInput(e){
			var element = 	"<div class='col-md-4 mt-4 input-field'>"+
								"<input type='file' class='new-input dropify-event' id='event_photos' name='edit_event_photos[]' data-max-file-size='3M' />"+
							"</div>";
			$("#event_photos_parent").append($(element));

			$(e).removeClass('new-input');
			
			var drEvent = $('.dropify-event').dropify();
			drEvent.on('dropify.afterClear', function(event, element){
				$(this).parents('.input-field').remove();
			});

			$('.new-input').change(function(){
				newInput(this);
			});
		}
		
		$('.new-input').change(function(){
			newInput(this);
		});
			
	});
	
	
	// UPDATE EVENT
	function update_event(){
		
		for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
		
		var form = new FormData(document.getElementById("updateEvent"));

		$('.loading-wrap').show();		
		$.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Event/update/",
			mimeType: "multipart/form-data",
			datatype : "json", 
			data: form, 
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false, 			// To send DOMDocument or non processed data file it is set to false
			success: function(data) {
				$('.loading-wrap').hide();
				if(data=="success"){
					swal({title:"Event Updated!", text:"successfully update event", type:"success"},
					function(){ 
						window.location.href = "<?php echo base_url(); ?>"+"Event";
					});
					$('.confirm').addClass('sweet-alert-success');
				}else if(data=="main photo is empty"){
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
		<div class="card-body">
			<form id="updateEvent" action="" method="POST" enctype="multipart/form-data">
				<div class="row">
				<?php foreach($data_edit as $event){?>
					<!-- DAPETIN NAMA FOTO MAIN EVENT LAMA BUAT NANTI DI HAPUS D CONTROLLER !-->
					<input type="hidden" id="old_main_photo" name="old_main_photo" value="<?=$event->event_main_photo?>">	
					
					<input type="hidden" id="event_id" name="event_id" value="<?=$event->event_id?>">	
					
					<div class="col-md-12">     
						<div class="form-group form-alert" id="lat-valid">
							<label class="form-label" >Event Name</label>
							<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="event_name" name="edit_event_name" placeholder="e.g Christmas" onchange="" onfocusout="" value="<?=$event->event_name?>">
						</div>
					</div>
					<div class="col-md-6">     
						<div class="form-group form-alert" id="lat-valid">
							<label class="form-label" >Event Date</label>
							<input type="text" style="margin-right:5px;" class="form-control empty-validator" id="event_date" name="edit_event_date" placeholder="e.g 2019-12-25" onchange="" onfocusout="" value="<?=$event->event_date?>">
						</div>
					</div>
					<div class="col-md-6" >
						<div class="form-group form-alert" id="lng-evalid">
							<label class="form-label" >Send Email On</label>
							<input type="text" class="form-control empty-validator" id="send_on" name="edit_send_on" placeholder="e.g 2019-08-01" onchange="" onfocusout="" value="<?=date_format(date_sub(date_create($event->event_date),date_interval_create_from_date_string("$event->message_send_before days")),"Y-m-d")?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group form-alert">
							<label class="form-label">Event Description</label>
							<textarea class="form-control empty-validator" onfocusout="" id="event_desc" name="edit_event_desc" rows="3" placeholder="e.g Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25...."><?=$event->event_description?></textarea>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group form-alert">
							<label class="form-label">Message to Send</label>
							<textarea class="form-control empty-validator" onfocusout="" id="event_email" name="edit_event_email" rows="3" placeholder="e.g Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25...."><?=$event->event_message?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-alert">
							<label class="form-label">Event Main Photo</label>
							<input type="file" class="dropify" id="edit_event_main_photo" name="edit_event_main_photo" data-default-file="<?=base_url()?>images/event_photos/event_main_photos/<?=$event->event_main_photo?>" data-max-file-size="3M" data-height="300"/>
						</div>
					</div>
					<?php }?>
					<div class="col-md-12">
						<div class="form-group form-alert">
							<label class="form-label">Event Photos</label>
							<div id="event_photos_parent" class="row"> 
								<?php foreach($data_edit_event_photos as $event_photo){?>
									<div class="col-md-4 mt-4 input-field">
										<!-- DAPETIN NAMA FOTO EVENT LAMA BUAT NANTI DI HAPUS D CONTROLLER !-->
										<input type="hidden" id="old_event_photo" name="old_event_photo[]" value="<?=$event_photo->event_photo?>">
										<input type="hidden" id="old_event_photo" name="old_event_photo_id[]" value="<?=$event_photo->event_photo_id?>">
										<input type="file" class="new-input dropify-event" id="edit_event_photos" name="edit_event_photos[]" data-default-file="<?=base_url()?>images/event_photos/events_photos/<?=$event_photo->event_photo?>" data-max-file-size="3M" />
									</div>
								<?php }?>
								<div class="col-md-4 mt-4 input-field">
									<input type="file" class="new-input dropify-event" id="edit_event_photos" name="edit_event_photos[]" data-max-file-size="3M" />
								</div>
							</div>					
						</div>
					</div>						
					<div class="col-md-12 mt-4">  
						<button class="btn btn-icon btn-outline-primary btn-block mt-1 mb-1" type="button" onclick="update_event()">
							<span class="btn-inner--icon"><i class="fe fe-save"></i></span>
							<span class="btn-inner--text">Save</span>
						</button>
					</div>
				</div>
			</form>		
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

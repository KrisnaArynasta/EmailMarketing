<?php
  $title['title']="PEMS - Inbox";
  $this->load->view('header',$title);
?>

<script>

	$(document).ready(function(){
	 $('#wait').hide();
	 $('#loading-wrap').hide();
	 
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
		CKEDITOR.replace( 'email_builder' );
	  });

	function get_email_body(inbox_id){

		$.ajax({
			type: "GET", 
			url: "<?php echo base_url(''); ?>"+"EmailInbox/load_email_body/"+inbox_id,
			dataType : "json", 
			success: function(data) {			 
				//cek kalo body emailnya ada
				if(data.data_email_body.inbox_body){
					email_body = $.parseHTML(data.data_email_body.inbox_body);
					$("#mail-body").html(email_body);
				}else{
					$("#mail-body").html("<h3 style='opacity:0.2'>Email has no content body</h3>");
				}
				// set ck editor untuk texarea body email kosong
				CKEDITOR.instances.email_builder.setData("");

				$("#largeModalLabel").text(data.data_email_body.inbox_guest_name);
				$("#emailTime").text(data.data_email_body.inbox_date);
				$("#emailSingle").modal();
				
				// set inout type di form reply email
				$("#to").val(data.data_email_body.inbox_from);
				$("#guest_id").val(data.data_email_body.guest_id);
				$("#subject").val("Re: "+data.data_email_body.inbox_subject);
			}

	   });
	}
	
	function send_email(){
		
		for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
		
		to = $("#to").val();
		guest_id = $("#guest_id").val();
		sender = $("#sender").val();
		subject = $("#subject").val();
		msg = CKEDITOR.instances.email_builder.getData();
		
		if(to=="")alert('Please fill To field!')
		else if(sender=="")alert('Please fill Sender field!')
		else if(subject=="")alert('Please fill Subject field!')
		else if(msg=="")alert('Please fill Email Message field!')
		else{
			
			$('#replayEmail').hide();
			$('#emailSingle').hide();
			$('#wait').show();
			$('#loading-wrap').show();
		  
			//alert("gst email : "+to+"\n sender id : "+sender+"\n"+subject+"\n"+msg);
		  
			$.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"EmailSenderAuto/input_to_outbox/",
				datatype : "json", 
				data: $("#formSendEmail").serialize(), 
				success: function(data) {
					if(data=="success"){
						swal({title:"Success", text:"Email sent!", type:"success"},
						function(){ 
							location.reload(); 
						});
						$('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Failed!", text:"Failed to send email", type:"error"});
					}
				}
			}); 
		}
	}
	
</script>

<!-- Page content -->
<div class="container-fluid pt-8">
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0">Email Inbox</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Email Inbox</li>
		</ol>

	</div>
	<div class="email-app card shadow">
		<div class="inbox p-0">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Email Account Receiver</label>
							<select id="e2" class="form-control" multiple="multiple" data-placeholder="Select a State" style="width:100%">
								<option>Alabama</option>
								<option>Alaska</option>
								<option>California</option>
								<option>Delaware</option>
								<option>Tennessee</option>
								<option>Texas</option>
								<option>Washington</option>
							</select>
						</div>
					</div>
				</div>
			</div>	

		<ul class="mail_list list-group list-unstyled">
			<?php 
				// dapetin email dari tbl_inbox								
				foreach($data_inbox_email as $row_email){
			?>					
					<a href="javascript:get_email_body('<?=$row_email->inbox_id?>');"> 
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
					</a>					
			<?php 
				} 
			?>
				<div class="modal fade" id="emailSingle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<small>From: &nbsp;</small><h3 id="largeModalLabel"></h3>&nbsp; - &nbsp;<p id="emailTime"></p>								
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>							
							<div class="modal-body">
								<p class="mb-0" id="mail-body"></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#replayEmail">Reply</button>
							</div>
						</div>
					</div>
				</div>												

				<div class="modal fade" id="replayEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h3 id="largeModalLabel">Compose Mail</h3>						
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>							
							<div class="modal-body">

									<form id="formSendEmail" action="" method="POST">
									
										<input type="hidden" id="guest_id" name="guest_id">
									
										<div class="form-row mb-4">
											<label for="to" class="col-3 col-sm-2 col-md-3 col-lg-2 col-form-label">To:</label>
											<div class="col-9 col-sm-10 col-md-9 col-lg-10">
												<input type="email" class="form-control" id="to" name="to" placeholder="Type mail-id" readonly>
											</div>
										</div>
										<div class="form-row mb-4">
											<label for="sender" class="col-3 col-sm-2 col-md-3 col-lg-2 col-form-label">Sender:</label>
											<div class="col-9 col-sm-10 col-md-9 col-lg-10">
												<select class="form-control" id="sender" name="sender">
													<?php 
														// dapetin email dari tbl_inbox								
														foreach($data_email_sender as $data_email_sender){
													?>	
														<option value="<?=$data_email_sender->email_sender_id?>"><?=$data_email_sender->email?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-row mb-4">
											<label class="col-3 col-sm-2 col-md-3 col-lg-2 col-form-label">Subject</label>
											<div class="col-9 col-sm-10 col-md-9 col-lg-10">
												<input type="email" class="form-control" id="subject" name="subject" placeholder="Type Subject">
											</div>
										</div>
										<div class="row">
											<div class="toolbar" role="toolbar" style="width:100%">
												<div class="form-group mt-3 ">
													<textarea class="form-control" name="email_builder" id="email_builder" rows="10" cols="80">
														
													</textarea>
												</div>
											</div>	
										</div>
									</form>
								
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
								<button type="button" class="btn btn-success" onclick="send_email()">Send</button>
							</div>
						</div>
					</div>
				</div>	
				
				
			</ul>
		</div>
	</div>

<?php
	$this->load->view('footer');
	$this->load->view('modal');
?>	
	

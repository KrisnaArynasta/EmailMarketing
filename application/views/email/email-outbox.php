<?php
  $title['title']="PEMS - Outbox";
  $this->load->view('header',$title);
?>

<script>

	$(document).ready(function(){
	 $('#wait').hide();
	 $('#loading-wrap').hide();
	
	  });

	function get_email_body(outbox_id){

		$.ajax({
			type: "GET", 
			url: "<?php echo base_url(''); ?>"+"EmailOutbox/load_email_body/"+outbox_id,
			dataType : "json", 
			success: function(data) {			 
				//cek kalo body emailnya ada
				if(data.data_email_body.message_send){
					email_body = $.parseHTML(data.data_email_body.message_send);
					$("#mail-body").html(email_body);
				}else{
					$("#mail-body").html("<h3 style='opacity:0.2'>Email has no content body</h3>");
				}

				$("#largeModalLabel").text(data.data_email_body.email_send_to);
				$("#emailTime").text(data.data_email_body.send_date+" "+data.data_email_body.send_time);
				$("#emailSingle").modal();

			}

	   });
	}
	
</script>

<!-- Page content -->
<div class="container-fluid pt-8">
	<div class="page-header mt-0  p-3">
		<h3 class="mb-sm-0">Email Outbox</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Email Outbox</li>
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
								echo form_open("EmailOutbox",$attributes); 
							?>
							<div class="form-group mb-0">
								<div class="input-group">
									<input type="text" class="form-control" name="search" placeholder="Find email by the message or subject or receiver">
                    				<button type="submit" class="input-group-text search-button pointer"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>	

		<ul class="mail_list list-group list-unstyled">
			<?php 
			if(!empty($email_outbox)){
			// link paging				
					foreach($email_outbox as $row_email){
				?>					
					<a href="javascript:get_email_body('<?=$row_email->outbox_id?>');"> 
						<li class="list-group-item read-email">
							<div class="media">
								<div class="media-body">
									<div class="media-heading">
										<div class="mr-2" style=" font-weight: bold;">
											<p class="msg">To : <?=$row_email->email_send_to?></p>
											<?=$row_email->outbox_subject?>
											<?=($row_email->event_id ? "<span class='badge bg-success text-white'>".$row_email->event_name."</span>" : "<span class='badge bg-primary text-white'>Direct Message</span>")?>
										</div>
										<small class="float-right text-muted">
											<time class="hidden-sm-down" datetime="2017">
												<?=$row_email->send_date?> <?=$row_email->send_time?>
											</time>
											<i class="zmdi zmdi-attachment-alt ml-2"></i> 
										</small>
									</div>
									<!--
									<p class="msg" >
										<?php //if(strlen($row_email->message_send)<80) echo $row_email->message_send."<br><br>"; 
										//else echo substr($row_email->message_send, 0, 80)."...";?>
									</p>
									!-->
								</div>
							</div>
						</li>
					</a>					
			<?php 
					} 
					if (!isset($links)) { ?>
						<div class="col-md-12">
							<b><h3 style='opacity:0.4; text-align:center; margin-top:50px'>You Dont Have Any Outbox Yet!</h3></b> <br>
						</div>
					<?php
					// jika data outbox tidak ada  
					} else  { 
						echo "<div class='col-md-12'>".$links."</div>";
					}		
				}
			?>				
			</ul>
		</div>
	</div>

	<div class="modal fade" id="emailSingle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<small>To: &nbsp;</small><h3 id="largeModalLabel"></h3>&nbsp; - &nbsp;<p style="font-size:14px" id="emailTime"></p>								
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
	
<?php
	$this->load->view('footer');
	$this->load->view('modal');
?>	
	

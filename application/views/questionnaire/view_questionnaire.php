<?php
  $title['title']="PEMS - Your Questionnaire";
  $this->load->view('header',$title);
?>

<script>
	$(document).ready(function(){
		$('#wait').hide();
		$('#loading-wrap').hide();
	});
	
		function delete_questionnaire(questionnaire_id, questionnaire_name){
		swal({
			title: "Delete Questionnaire "+questionnaire_name+"?",
			text: questionnaire_name+" will deleted on your questionnaire list",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Delete",
			closeOnConfirm: false
		}, function() {
		  
		  $.ajax({
				type: "POST", 
				url: "<?php echo base_url(); ?>"+"Questionnaire/delete_questionnaire",
				datatype : "json", 
				data:{id:questionnaire_id,delete_sts:1},
				success: function(data) {
					if(data=="success"){
						swal({title:"Questionnaire Deleted!", text:"this questionnaire has been deleted in your list", type:"success"},
						function(){ 
							   location.reload();
						   }
					   );
					   $('.confirm').addClass('sweet-alert-success');
					}else{
						swal({title:"Failled!", text:"fail to delete the questionnaire", type:"success"});
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
		<h3 class="mb-sm-0">Your Questionnaire</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Questionnaire</li>
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
								echo form_open("Questionnaire",$attributes); 
							?>
							<div class="form-group mb-0">
								<div class="input-group">
									<input type="text" class="form-control" name="search" placeholder="Find by questionnaire name">
                    				<button type="submit" class="input-group-text search-button pointer"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>
		
			<div class="card-body">
				<div id="generic_price_table">
					<div class="row">
						<?php  
							// cek data questionnair ada atau tidak 	
							if( !empty($questionnaire)){
								// dapetin questionnair dari tbl_questionnair							
								foreach($questionnaire as $row_questionnaire){
						?>				
							<div class="col-lg-4">
								<!--PRICE CONTENT START-->
								<div class="generic_content clearfix card shadow">

									<!--HEAD PRICE DETAIL START-->
									<div class="generic_head_price clearfix">

										<!--HEAD CONTENT START-->
										<div class="generic_head_content clearfix" style="margin: 0 0 20px 0;">
											<!--HEAD START-->
											<div class="head_bg"></div>
											<div class="head">
												<span><b><?=$row_questionnaire->questionnaire_name?></b></span>
											</div>
											<!--//HEAD END-->
										</div>
										<!--//HEAD CONTENT END-->

										<!--SEND ON START-->
										<div class="generic_price_tag clearfix" style="padding:0">
											<span class="price">
												<br>
												<small>Send On :</small>
												<br>
												<?=$row_questionnaire->questionnaire_send_on?>
											</span>
										</div>
										<!--//SEND ON END-->
									</div>
									<!--//HEAD SEND ON DETAIL END-->

									<!--FEATURE LIST START-->
									<div class="generic_feature_list">
										<a title="Edit Questionnaire" href="<?=base_url("Questionnaire/create_question/".$row_questionnaire->questionnaire_id)?>"><i class="fe fe-edit-3"></i></a>
										<a title="Delete Questionnaire" href="javascript:delete_questionnaire(<?=$row_questionnaire->questionnaire_id?>,'<?=$row_questionnaire->questionnaire_name?>');"><i class="fe fe-trash-2"></i></a>
										<br>
										<p>
											<?php if(strlen($row_questionnaire->questionnaire_message)<80) echo $row_questionnaire->questionnaire_message."<br><br>"; 
												else echo substr($row_questionnaire->questionnaire_message, 0, 100)."...";?>
										</p>
									</div>
									<!--//FEATURE LIST END-->

									<!--BUTTON START-->
									<div class="mb-4">
										<a href="javascript:view_email_questionnaire(<?=$row_questionnaire->questionnaire_id?>);"><button class="btn btn-default mt-1 mb-1">View Email</button></a>
										<a href="<?=base_url("Questionnaire/questionnair_result/".$row_questionnaire->questionnaire_id)?>"><button class="btn btn-primary mt-1 mb-1">View Result (<?=($row_questionnaire->count_responnd)?$row_questionnaire->count_responnd:0;?>)</button> </a>
									</div>
									<!--//BUTTON END-->
								</div>
								<!--//PRICE CONTENT END-->
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
							// jika data questionnair tidak ada  
							} else  { ?>
								<div class="col-md-12">
									<b><h3 style='opacity:0.4; text-align:center; margin-top:50px'>You Dont Have Any Questionnaire Yet!</h3></b> <br>
								</div>	
						<?php } ?>
								</div>	
						<!-- Button Tambah Melayang !-->
						<a href="<?=base_url('Questionnaire/create')?>">
							<button class="float btn btn-icon btn-add btn-info mt-1 mb-1" data-tooltip="tooltip" data-placement="left" title="" data-original-title="Create new questionnair">
								<span class="btn-inner--icon"><i class="fe fe-plus"></i></span>
							</button>
						</a>
					</div>
				</div>			
			</div>			
		</div>
	</div>
</div>

<?php
	$this->load->view('questionnaire/questionnaire_modal');
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

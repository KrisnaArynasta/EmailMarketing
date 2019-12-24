 <!--
<div id="loading-wrap">
	<img src="<?=base_url()?>images/icon/loading-flat.gif" id="wait" alt="Loading" />
</div>	
-->

	  <!-- Modal Sukses -->
<div class="modal fade" id="myModalSuccess" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">>
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <!-- Modal content-->
	  <div class="modal-content">
			<div class="modal-body custom-body">
				<img align="center" src="<?=base_url()?>images/icon/success.png" class="img-responsive center-block"  width="30%">
					<h2 align="center">Berhasil</h2>
					
			</div>
			<div class="modal-footer">
					<button type="button" class="close" data-dismiss="modal"">
						OK 
					</button>
			</div>
	  </div>
  
	</div>
</div>
	
<!-- Modal Error -->
<div class="modal fade" id="myModalFail" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">>
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">

	  <!-- Modal content-->
	  <div class="modal-content">
		<!-- <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
	   
		</div> -->
		<div class="modal-body custom-body">
			<img src="<?=base_url()?>images/icon/error.png" style="width: 150px; height: 150px;" class="img-responsive center-block">
				<h2 align="center">Error!</h2>
				<p align="center">Gagal Melakukan Aksi</p>
		</div>
		<div class="modal-footer">
				<button type="button" class="close" 
				   data-dismiss="modal">
					OK 
				</button>
		</div>
	  </div>
	  
	</div>
</div>
 
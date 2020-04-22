	<!--Style-->
	<link rel="stylesheet" href="<?=base_url()?>assets/style.css">	

	<!-- Icons -->
	<link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet">

	<!--Bootstrap.min css-->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css">
	
	<!--JQuery-->
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

	  
	<!-- Data table css -->
	<link href="<?=base_url()?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
	
	<script src="<?=base_url()?>assets/js/validator.js"></script>

<div class="content-wrapper">
    <section class="content">



	<!-- Master -->
	


	<!-- Form Obat -->
	<div class="col-md-6">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Tampilan Obat Yang Tersedia</h3>
			</div>
			<table id="lookup" class="table table-bordered">
				
				<thead>
					<tr>
						<th>No</th>
						<th>Obat</th>
						<th>Jumlah Stok</th>
						<th>Satuan Obat</th>
						<th>Obat Yang Dipesan</th>
						<!-- <th>Aksi</th> -->
					</tr>
				</thead>
				<form action="" method="POST" id="data_list_obat">
				<tbody>
					<?php 
						 $no = 0;
						 $count_data=0;

						 for($i=0;$i<4;$i++){
							$no++;
							$count_data++;
						
					?>
					<tr>						
						<td><?php echo $no; ?></td>
						<input type="hidden"  name="id_srUnit_form[]" id="id_srUnit_form<?php echo $count_data ?>" value="id_srUnit_form<?php echo $count_data ?>">
						<td><input type="text" size="8" readonly class="form-control" name="nama_obat_form[]" id="nama_obat_form<?php echo $count_data ?>" value="nama_obat_form<?php echo $count_data ?>"></td>						
						<td><input type="text" size="5" readonly class="form-control" name="qty_stok_form[]" id="qty_stok_form<?php echo $count_data ?>" value="qty_stok_form<?php echo $count_data ?>"></td>						
						<td><input type="text" size="5" readonly class="form-control" name="nama_konversi_form[]" id="nama_konversi_form<?php echo $count_data ?>" value="nama_konversi_form<?php echo $count_data ?>"></td>
						<td><input type="text"   class="form-control" id="qty_obat<?php echo $count_data ?>" name="qty_obat[]"></td>					
					</tr>
						
                <?php
                    }
                ?>
				<input type="hidden"  class="form-control" name="count_data[]"  id ="count_data" value="<?php echo $count_data ;?>" >
				</tbody>
				</form>
			</table>
			<td>
				<button f class='btn btn-tambah btn-success btn-lg'  onclick="add()">TAMBAH</button>
			</td>
		</div>
	</div>


	<!-- Detail -->
	<div class="col-md-6">
		<div class="box box-warning box-solid"> 
				<div class="box-header with-border">
				<h3 class="box-title">Obat yang Dipesan</h3>
				</div>
				<div id="list"></div>
	</div>
	</div>
	</div>

	
       
</div>
</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>


<script type="text/javascript"> 

function add(){
 var form = new FormData();
  form.append('count_data',$('#count_data').val());
  for(var i=1;i<=$('#count_data').val();i++){
  form.append('id_srUnit_form['+i+']',$('#id_srUnit_form'+i).val());
  form.append('nama_obat_form['+i+']',$('#nama_obat_form'+i).val());
  form.append('qty_stok_form['+i+']',$('#qty_stok_form'+i).val());
  form.append('nama_konversi_form['+i+']',$('#nama_konversi_form'+i).val());
  form.append('qty_obat['+i+']',$('#qty_obat'+i).val());
  }
  // alert($('#count_data').val());
  // // alert($('#id_srUnit_form1').val());

  $.ajax({
  type: "POST", 
  url: "<?php echo base_url() ?>/index.php/Srunit/add_ajax",
  datatype : "json", 
  data: form,
  contentType: false,    
  cache: false,         
  processData:false,     
  success:function(data)
  {
   load();
  }
  }); 
}





</script>


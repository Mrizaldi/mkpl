<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-lg">
		<h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>   
		<div class="card">
			<div class="card-body">
				<!-- <?php if (validation_errors()):  ?>
				<div class="alert alert-danger" role="alert">
					<?php echo validation_errors(); ?>
				</div>
				<?php endif; ?> -->
				<form action="" method="post">
					 <div class="form-group">
					    <label for="clientName">Nama</label>
					    <input type="text" class="form-control" id="clientName" placeholder="" name="clientName">    
					    <small class="form-text text-danger"><?php echo form_error('clientName'); ?></small>
					 </div>
					 <div class="form-group">
					    <label for="clientPhone">No Telp</label>
					    <input type="text" class="form-control" id="clientPhone" placeholder="" name="clientPhone">
					    <small class="form-text text-danger"><?php echo form_error('clientPhone'); ?></small>
					  </div>
					 <div class="form-group">
					   <label for="clientAddress">Alamat</label>
					   <input type="text" class="form-control" id="clientAddress" placeholder="" name="clientAddress">
					   <small class="form-text text-danger"><?php echo form_error('clientAddress'); ?></small>
					 </div>
					 <div class="form-group">
					    <label for="clientCompany">Perusahaan</label>
					    <input type="text" class="form-control" id="clientCompany" placeholder="" name="clientCompany">
					    <small class="form-text text-danger"><?php echo form_error('clientCompany'); ?></small>
					 </div>
					 <a href="<?php echo base_url(); ?>client" class="btn btn-primary">Kembali</a>
					 <button type="submit" class="btn btn-primary float-right">Tambah</button>
				</form>
			</div>
		</div>

		</div>
	</div>
</div>
</div>
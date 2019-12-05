 <div class="container-fluid">
	<div class="row mt-3 mb-4">
		<div class="col-lg">
		<h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>   
			<div class="card">
				<div class="card-body">
				<!-- <?php if (validation_errors()):  ?>
				<div class="alert alert-danger" role="alert">
					<?php echo validation_errors(); ?>
				</div>
				<?php endif; ?> -->
					<form action="<?= base_url('employee/tambah'); ?>" method="post">
						 <div class="form-group">
						    <label for="nama">Nama</label>
						    <input type="text" class="form-control" id="nama" placeholder="" name="nama">    
						    <small class="form-text text-danger"><?php echo form_error('nama'); ?></small>
						 </div>
						 <div class="form-group">
						   <label for="email">E-mail</label>
						   <input type="text" class="form-control" id="email" placeholder="" name="email">
						   <small class="form-text text-danger"><?php echo form_error('email'); ?></small>
						 </div>					 
						 <div class="form-group">
						    <label for="telepon">Telepon</label>
						    <input type="text" class="form-control" id="telepon" placeholder="" name="telepon">
						    <small class="form-text text-danger"><?php echo form_error('telepon'); ?></small>
						 </div>
						 <div class="form-group">
						   <label for="password">Password</label>
						   <input type="password" class="form-control" id="password" placeholder="" name="password" value="dsi123">
						   <small class="form-text text-success">Hint : Default password = dsi123</small>
						   <small class="form-text text-danger"><?php echo form_error('password'); ?></small>
						 </div>
						 <div class="form-group">
						 	<label for="role">Role</label>
						    <select class="form-control" id="role" name="role">
						      <?php foreach ($role as $r):?>
						      	<option value="<?=$r['id']; ?>"><?=$r['role']; ?></option>
						      <?php endforeach; ?>
						    </select>
						 </div>
						 <a href="<?php echo base_url(); ?>employee" class="btn btn-primary">Kembali</a>
						 <button type="submit" class="btn btn-primary float-right">Tambah</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
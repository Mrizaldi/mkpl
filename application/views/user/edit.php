  <div class="container-fluid">
	<div class="row mt-3 mb-3">
		<div class="col-lg">
		<h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>   
		<div class="card">
			<div class="card-body">
				<!-- <?php if (validation_errors()):  ?>
				<div class="alert alert-danger" role="alert">
					<?php echo validation_errors(); ?>
				</div>
				<?php endif; ?> -->
				<?php echo form_open_multipart('user/edit');?>
					<div class="form-group row">
					    <label for="email" class="col-2 col-form-label">Email</label>
					    <div class="col-10">
					    <input type="email" class="form-control" id="email" placeholder="" readonly="" value="<?=$user['email'];?>" name = "email">
					    </div>
					</div>
					<div class="form-group row">
					    <label for="name" class="col-2 col-form-label">Nama</label>
					    <div class="col-10">
					    <input type="name" class="form-control" id="name" placeholder="Nama Lengkap"value="<?=$user['name'];?>" name="name">
					    <small class="form-text text-danger"><?php echo form_error('name'); ?></small>
					    </div>
					</div>
					<div class="form-group row">
					    <div class="col-lg-2">
					    	Picture
					    </div>
					    <div class="col-lg-10">
					    	<div class="row">
					    	<div class="col-sm-3">
					    		<img src="<?= base_url('assets/img/profile/').$user['image'];?>" class="img-thumbnail">
					    	</div>
					    	<div class="col-sm-9">
					    		<div class="custom-file">
								 <input type="file" class="custom-file-input" id="image" name="image">
								 <label class="custom-file-label" for="image">Choose file</label>
								</div>
					    	</div>
					    	</div>
					    </div>
					</div>
					<div class="form-group row">
					    <label for="telepon" class="col-2 col-form-label">Telepon</label>
					    <div class="col-10">
					    <input type="text" class="form-control" id="telepon" placeholder="" value="<?=$user['phone'];?>" name="telepon">
					    <small class="form-text text-danger"><?php echo form_error('name'); ?></small>
					    </div>
					</div>
					 <!-- <div class="form-group">
					    <label for="nama">Nama</label>
					    <input type="text" class="form-control" id="nama" placeholder="" name="nama">    
					    <small class="form-text text-danger"><?php echo form_error('nama'); ?></small>
					 </div>
					 <div class="form-group">
					    <label for="telepon">Telepon</label>
					    <input type="text" class="form-control" id="telepon" placeholder="" name="telepon">
					    <small class="form-text text-danger"><?php echo form_error('telepon'); ?></small>
					 </div>
					 <div class="form-group">
					   <label for="email">E-mail</label>
					   <input type="text" class="form-control" id="email" name="email">
					   <small class="form-text text-danger"><?php echo form_error('email'); ?></small>
					 </div>					 
					 <div class="form-group">
					 	<label for="client">Role</label>
					    <select class="form-control" id="role" name="role">
					      <option value="Project Manager">Project Manager</option>
					      <option value="Programmer">Programmer</option>
					      <option value="Tester">Tester</option>
					    </select>
					 </div> -->
					 <a href="<?php echo base_url(); ?>employee" class="btn btn-primary">Kembali</a>
					 <button type="submit" class="btn btn-primary float-right">Simpan</button>
				</form>
			</div>
		</div>

		</div>
	</div>
</div>
</div>
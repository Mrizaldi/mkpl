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
				<form action="" method="post">
					 <div class="form-group">


                      <input type="hidden" name="id" value="<?= $user['id'];?>">

					    <label for="nama">Nama</label>
					    <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="<?= $user['name'];?>">    
					    <small class="form-text text-danger"><?php echo form_error('nama'); ?></small>
					 </div>
					 <div class="form-group">
					   <label for="email">E-mail</label>
					   <input type="text" class="form-control" id="email" placeholder="" name="email" value="<?= $user['email'];?>">
					   <small class="form-text text-danger"><?php echo form_error('email'); ?></small>
					 </div>					 
					 <div class="form-group">
					    <label for="telepon">Telepon</label>
					    <input type="text" class="form-control" id="telepon" placeholder="" name="telepon" value="<?= $user['phone'];?>">
					    <small class="form-text text-danger"><?php echo form_error('telepon'); ?></small>
					 </div>
					 <div class="form-group">
					 <label for="role">Role</label>
					    <select class="form-control" id="role" name="role">
                           <!-- <option value=""></option> -->
					      <?php foreach ($role as $r):?>
					      	<option <?php if($r['id']==$user['role_id']){echo "selected ";} ?>value="<?=$r['id'];?>"><?=$r['role'];?></option>
					      <?php endforeach; ?>
					    </select>
					</div>
					 <a href="<?php echo base_url(); ?>employee" class="btn btn-primary">Kembali</a>
					 <button type="submit" class="btn btn-primary float-right">Update</button>
				</form>
			</div>
		</div>

		</div>
	</div>
</div>
</div>
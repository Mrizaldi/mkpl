<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-lg">
		<h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>   
		<!-- <div class="row"> -->
    		<?php echo $this->session->flashdata('message'); ?>
    	<!-- </div> -->
		<div class="card mb-4">
			<div class="card-body">
				<!-- <?php if (validation_errors()):  ?>
				<div class="alert alert-danger" role="alert">
					<?php echo validation_errors(); ?>
				</div>
				<?php endif; ?> -->
				<form action="<?= base_url('project/tambah'); ?>" method="post">
					 <div class="form-group">
					    <label for="nama">Nama</label>
					    <input type="text" class="form-control" id="nama" placeholder="" name="nama">    
					    <small class="form-text text-danger"><?php echo form_error('nama'); ?></small>
					 </div>
					 <div class="row">
						 <div class="form-group col-6">
						   <label for="startdate">Start Date</label>
						   <input type="date" class="form-control" id="startdate" placeholder="" name="startdate" value="<?=date("Y-m-d");?>">
						   <small class="form-text text-danger"><?php echo form_error('startdate'); ?></small>
						 </div>
						 <div class="form-group col-6">
						    <label for="enddate">End Date</label>
						    <input type="date" class="form-control" id="enddate" placeholder="" name="enddate">
						    <small class="form-text text-danger"><?php echo form_error('enddate'); ?></small>
						 </div>
					 </div>
					 <div class="form-group">
					    <label for="description">Description</label>
					    <textarea class="form-control" id="description" placeholder="" name="description" rows="5"></textarea>
					    <small class="form-text text-danger"><?php echo form_error('description'); ?></small>
					 </div>
					 <div class="form-group">
					    <label for="alamat">Progress (%)</label>
					    <input type="text" class="form-control" id="progress" placeholder="" name="progress" value="0">
					    <small class="form-text text-danger"><?php echo form_error('progress'); ?></small>
					 </div>
					 <div class="form-group">
					    <label for="client">Client</label>
					    <select class="form-control" id="client" name="client">
					      <!-- <option value="Laki-laki">BKD</option>
					      <option value="Perempuan">BANK</option> -->
					      <?php foreach ($client as $c): ?>
					      	<option value="<?=$c['id'];?>"><?=$c['clientName'];?></option>
					      <?php endforeach; ?>
					    </select>
					    <small class="form-text text-danger"><?php echo form_error('client'); ?></small>
					  </div>
					  <div class="form-group">
					    <label for="pm">PM</label>
					    <select class="form-control" id="pm" name="pm">
					      <!-- <option value="Adi">Adi</option>
					      <option value="Ika">Ika</option> -->
					      <?php foreach ($emp as $e): if ($e['role_id'] == 3) : ?>
					      	<option value="<?=$e['id'];?>"><?=$e['name'];?></option>
					      <?php endif; endforeach; ?>
					    </select>
					    <small class="form-text text-danger"><?php echo form_error('pm'); ?></small>
					  </div>
					 <a href="<?php echo base_url(); ?>project" class="btn btn-primary">Kembali</a>
					 <button type="submit" class="btn btn-primary float-right">Buat</button>
				</form>
			</div>
		</div>

		</div>
	</div>
</div>
</div>
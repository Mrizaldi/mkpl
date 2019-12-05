<div class="container-fluid">
	<div class="row">
		<div class="col">
		<span class="h3 mb-4 text-gray-800"><?=$title;?></span>   
		<span><a href="<?php echo base_url(); ?>project" class="btn btn-primary float-right">Kembali</a></span>
		<?php echo $this->session->flashdata('message'); ?>
		</div>
	</div>		
	<div class="row mt-3">
		<div class="col-lg mb-4">
		<div class="card">
			<div class="card-body">
				<!-- <?php if (validation_errors()):  ?>
				<div class="alert alert-danger" role="alert">
					<?php echo validation_errors(); ?>
				</div>
				<?php endif; ?> -->
				<form action="" method="post">
  					 <input type="hidden" class="form-control" name="id" value="<?=$project['id'];?>">    
					 <div class="form-group">
					    <label for="nama">Nama</label>
					    <input type="text" readonly="" class="form-control" id="nama" placeholder="" name="nama" value="<?=$project['projName'];?>">    
					    <small class="form-text text-danger"><?php echo form_error('nama'); ?></small>
					 </div>
					 <div class="row">
						 <div class="form-group col-6">
						   <label for="startdate">Start Date</label>
						   <input type="date" class="form-control" id="startdate" placeholder="" name="startdate" value="<?=$project['projStartDate'];?>">
						   <small class="form-text text-danger"><?php echo form_error('startdate'); ?></small>
						 </div>
						 <div class="form-group col-6">
						    <label for="enddate">End Date</label>
						    <input type="date" class="form-control" id="enddate" placeholder="" name="enddate" value="<?=$project['projEndDate'];?>">
						    <small class="form-text text-danger"><?php echo form_error('enddate'); ?></small>
						 </div>
					 </div>
					 <div class="form-group">
					    <label for="description">Description</label>
					    <textarea class="form-control" id="description" placeholder="" name="description" rows="5"><?=$project['projDescription'];?></textarea>
					    <small class="form-text text-danger"><?php echo form_error('description'); ?></small>
					 </div>
					 <div class="form-group">
					    <label for="progress">Progress (%)</label>
					    <input type="textarea" class="form-control" id="progress" placeholder="" name="progress" value="<?=$project['projProgress'];?>">
					    <small class="form-text text-danger"><?php echo form_error('progress'); ?></small>
					 </div>
					 <div class="form-group">
					    <label for="client">Client</label>
					    <select class="form-control" id="client" name="client">
					      <?php foreach ($client as $c): ?>
					      	<option <?php if ($c['id']==$project['clientId']) {echo "selected ";} ?>value="<?=$c['id'];?>"><?=$c['clientName'];?></option>
					      <?php endforeach; ?>
					    </select>
					    <small class="form-text text-danger"><?php echo form_error('client'); ?></small>
					  </div>
					  <div class="form-group">
					    <label for="pm">PM</label>
					    <select class="form-control" id="pm" name="pm">
					      <?php foreach ($emp as $e): if ($e['role_id'] == 3) :?>
					      	<option value="<?=$e['id'];?>" <?php if($e['id']==$project['pm']){echo " selected ";} ?>><?=$e['name'];?></option>
					      <?php endif; endforeach; ?>
					    </select>
					    <small class="form-text text-danger"><?php echo form_error('pm'); ?></small>
					  </div>					 
					 <button type="submit" class="btn btn-primary float-right">Update</button>
				</form>
			</div>
		</div>

		</div>
	</div>
</div>
</div>
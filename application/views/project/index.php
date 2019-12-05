<div class="container-fluid">
	<div class="row mt-3">
		<div class="col">
			<h1 class="h3 text-gray-800"><?=$title;?></h1>  
        </div>		
    </div>    
    <?php if (is_admin_or_support($user['role_id'])):?>
    <div class="row">
    	<div class="col">
    		<a href="<?php echo base_url() ?>project/tambah" class="btn btn-primary mt-3">Buat Project</a>
    	</div>
    </div>
	<?php endif; ?>
	<!-- <div class="row"> -->
    	<?php echo $this->session->flashdata('message'); ?>
    <!-- </div> -->
    <div class="row mt-3">
        <!-- /.container-fluid -->
        <table class="table table-hover">
		  <thead>
		    <tr>
		      <th scope="col">No.</th>
		      <th scope="col">Nama</th>
		      <th scope="col">Client</th>
		      <th scope="col">Start Date</th>
		      <th scope="col">End Date</th>
		      <th scope="col">Deskripsi</th>
		      <th scope="col">Progress</th>
		      <th scope="col">PM</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
				<?php $i = 1;?>
				    <?php foreach ($project as $p): ?>
					    <tr>
					      <th scope="row"><?=$i; ?></th>
					      <td><?=$p['projName'];?></td>
					      <td><?php
					      		foreach ($client as $c) {
					      			if ($p['clientId'] == $c['id']) {
					      				echo $c['clientName'];
					      			}
					      		}
					      	   ?>
					      </td>
					      <td><?=$p['projStartDate'];?></td>
					      <td><?=$p['projEndDate'];?></td>
					      <td><?=$p['projDescription'];?></td>
					      <td><?=$p['projProgress'].'%';?></td>
					      <td><?php
					      		foreach ($emp as $e) {
					      			if ($p['pm'] == $e['id']) {
					      				echo $e['name'];
					      			}
					      		}
					      	   ?>
					      </td>
					      <td>
					      	<a href="<?php echo base_url('project/view/').$p['id']; ?>" class="badge badge-primary ml-1">Details</a>
					      	<?php if (is_pm_or_above($user['role_id'])):?>
					      	<?php if(is_this_project_mine($p['pm'])): ?>
					      	<a href="<?php echo base_url('project/update/').$p['id']; ?>" class="badge badge-success ml-1">Update</a>
					      	<?php endif; ?>					      	
					      	<?php if (is_admin_or_support($user['role_id'])):?>
					      	<a href="<?php echo base_url('project/delete/').$p['id']; ?>" class="badge badge-danger ml-1" onclick="return confirm('Hapus data?')">Delete</a>
					      	<?php endif; ?>
					      	<?php endif; ?>
					      </td>
					    </tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
    </div>
</div>     
</div>


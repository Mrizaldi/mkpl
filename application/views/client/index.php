<div class="container-fluid">
	<div class="row mt-3">
		<div class="col">
			<h1 class="h3 text-gray-800"><?=$title;?></h1>  
        </div>		
    </div>    
    <?php if (is_admin_or_support($user['role_id'])):?>
    <div class="row">
    	<div class="col">
    		<a href="<?php echo base_url() ?>client/tambah" class="btn btn-primary mt-3">Tambah Client</a>
    	</div>
    </div>
    <?php endif; ?>
    <div class="row mt-3">		
        <table class="table table-hover">
		  <thead>
		    <tr>
		      <th scope="col">No.</th>
		      <th scope="col">Nama</th>
		      <th scope="col">Telepon</th>
		      <th scope="col">Alamat</th>
		      <th scope="col">PIC</th>
		      <?php if (is_admin_or_support($user['role_id'])): ?>
		      <th scope="col">Action</th>
		  	  <?php endif ?>
		    </tr>
		  </thead>
		  <tbody>
				<?php $i = 1;?>
				    <?php foreach ($client as $c) : ?>
					    <tr>
					      <th scope="row"><?=$i; ?></th>
					      <td><?php echo $c['clientName']; ?></td>
					      <td><?php echo $c['clientPhone']; ?></td>
					      <td><?php echo $c['clientAddress']; ?></td>
					      <td><a href="<?php echo base_url(); ?>client/details/<?php echo $c['id']; ?>" class="badge badge-primary float" data-id="<?php echo $c['id']; ?>">View</a></td>
					      <?php if (is_admin_or_support($user['role_id'])): ?>
					      <td>
			  				<a href="<?php echo base_url(); ?>client/update/<?php echo $c['id']; ?>" class="badge badge-success float" data-id="<?php echo $c['id']; ?>">Update</a>
					      	<a href="<?php echo base_url(); ?>client/hapus/<?php echo $c['id']; ?>" class="badge badge-danger float ml-2" onclick="return confirm('Hapus data?')">Delete</a>
					      </td>
					      <?php endif; ?>
					    </tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
</div>
<!-- End of Main Content -->

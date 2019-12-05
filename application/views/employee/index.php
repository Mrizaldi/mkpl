<div class="container-fluid">
	<div class="row mt-3">
		<div class="col">
			<h1 class="h3 text-gray-800"><?=$title;?></h1>  
        </div>		
    </div>
    <?php if (is_admin_or_support($user['role_id'])):?>
    <div class="row">
    	<div class="col">
    		<a href="<?php echo base_url() ?>employee/tambah" class="btn btn-primary mt-3">Tambah Akun Employee</a>
    	</div>
    </div>    
    <!-- <div class="row"> -->
    	<?php echo $this->session->flashdata('message'); ?>
    <!-- </div>     -->
    <?php endif; ?>
    <div class="row mt-3">		
        <table class="table table-hover">
		  <thead>
		    <tr>
		      <th scope="col">No.</th>
		      <th scope="col">Nama</th>
		      <th scope="col">E-mail</th>
		      <th scope="col">Phone</th>
		      <th scope="col">Role</th>
		      <th scope="col">Tgl Masuk</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
				<?php $i = 1;?>
				    <?php foreach ($emp as $e) : ?>
					    <tr>
					      <th scope="row"><?=$i; ?></th>
					      <td><?php echo $e['name']; ?></td>
					      <td><?php echo $e['email']; ?></td>
					      <td><?php echo $e['phone']; ?></td>
					      <td><?php 
					      	foreach ($role as $r) {
					      		if ($e['role_id'] == $r['id']) {
					      			echo $r['role'];
					      		}
					      	}
					      ?></td>
					      <td><?php echo date('d F Y',$e['date_created']);?></td>
					      <td>
			  				<a href="<?php echo base_url(); ?>employee/details/<?php echo $e['id']; ?>" class="badge badge-primary float-left ml-3" data-id="<?php echo $e['id']; ?>">Details</a>
			  				<?php if (is_admin_or_support($user['role_id'])):?>


                            <a href="<?php echo base_url(); ?>Employee/Update/<?php echo $e['id']; ?>" class="badge badge-success float-left ml-3" data-id="<?php echo $e['id']; ?>">Update</a>
			  				

			  				<a href="<?php echo base_url(); ?>employee/hapus/<?php echo $e['id']; ?>" class="badge badge-danger float-left ml-3" onclick="return confirm('Hapus data?')">Delete</a>
			  				<?php endif; ?>
					      </td>
					    </tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<!-- End of Main Content -->
</div>

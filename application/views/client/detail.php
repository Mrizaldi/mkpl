<div class="container-fluid mb-3">
	<div class="row mt-3">
		<div class="col">
			<span class="h4 text-gray-800"><?=$title;?></span>  
			<span><a href="<?php echo base_url(); ?>client" class="btn btn-primary float-right">Kembali</a></span>
		</div>		
	</div>
	<!-- data client -->
	<div class="row mt-3">
		<div class="col-lg">
			<div class="card">					
				<div class="card-body  text-left ">
					<div class="form-group row">
						<label for="email" class="col-2 col-form-label">Nama Perusahaan </label>
						<div class="col-10">
							<input class="form-control" placeholder="" readonly="" value="<?= $client['clientName'];?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-2 col-form-label">Kontak Perusahaan </label>
						<div class="col-10">
							<input class="form-control" placeholder="" readonly="" value="<?= $client['clientPhone'];?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-2 col-form-label">Alamat Perusahaan </label>
						<div class="col-10">
							<input class="form-control" placeholder="" readonly="" value="<?= $client['clientAddress'];?>">
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
			<!-- Form PIC statis -->
			<?php if (is_admin_or_support($user['role_id'])): ?>
				<div class="row mt-3">
					<div class="col-lg">
					<div class="card">
						<div class="card-header">
							Form Tambah PIC
						</div>
						<div class="card-body">
							<form action="<?= base_url('Pic/tambah'); ?>" method="post">
								<input type="hidden" class="form-control" id="id" placeholder="" name="id">
								<!-- <div class="form-group">
									<small class="form-text text-success">Nama Client</small>
									<label type ="text" id="clientId" class="form-control" ><?=$client['clientName'];?></label>
								</div> -->
								<div class="form-group">
									<div class="row">
										<div class="col-2">
											<label for="picName">Nama PIC</label>
										</div>
										<div class="col-10">
											<input type="text" class="form-control" id="picName" placeholder="" name="picName">    
											<small class="form-text text-danger"><?php echo form_error('picName'); ?></small>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-2">
											<label for="picPhone">Kontak PIC</label>
										</div>
										<div class="col-10">
											<input type="text" class="form-control" id="picPhone" placeholder="" name="picPhone">
											<small class="form-text text-danger"><?php echo form_error('picPhone'); ?></small>
										</div>
									</div>																	
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-2">
											<label for="picMail">Email PIC</label>
										</div>
										<div class="col-10">
											<input type="text" class="form-control" id="picMail" placeholder="" name="picMail">
											<small class="form-text text-danger"><?php echo form_error('picMail'); ?></small>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-2">
											<label for="picPosition">Position</label>
										</div>
										<div class="col-10">
											<input type="text" class="form-control" id="picPosition" placeholder="" name="picPosition" >
											<small class="form-text text-danger"><?php echo form_error('picPosition'); ?></small>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="clientId"></label>
									<input type="hidden" readonly=""class="form-control" id="clientId" placeholder="" name="clientId" value="<?= $client['id'];?>">
								</div>					 
								<span class="btn btn-secondary float-right batal ml-2">Batal</span>
								<button type="submit" class="btn btn-primary float-right">Tambah</button>
							</form>
						</div>
					</div>
					</div>
				</div>
			<?php endif; ?>
			<!-- end form PIC Statis -->

				<!-- Loop tabel aja -->
				<div class="row mt-3">	
					<div class="col">
						<span class="h4">Daftar PIC</span>
					</div>		
				</div>	
				<div class="row mt-3">					
			        <table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col">No.</th>
					      <th scope="col">Nama</th>
					      <th scope="col">Telepon</th>
					      <th scope="col">Email</th>
					      <th scope="col">Jabatan</th>
					      <?php if (is_admin_or_support($user['role_id'])): ?>
					      <th scope="col">Action</th>
					  	  <?php endif ?>
					    </tr>
					  </thead>
					  <tbody>
							<?php $i = 1;?>
							    <?php foreach ($pic as $p) : ?>
								    <tr>
								      <td scope="row"><?=$i; ?></td>
								      <td><?= $p['picName'];?></td>
								      <td><?= $p['picPhone'];?></td>
								      <td><?= $p['picMail'];?></td>
								      <td><?= $p['picPosition'];?></td>								      
								      <?php if (is_admin_or_support($user['role_id'])): ?>
								      <td>
										<a href="#" data-toggle="modal" data-target="#newPicModal" class="viewPic" data-id="<?=$p['id'];?>" data-client="<?=$client['id'];?>"> <span class="badge badge-success float-left ml-2">Edit</span></a>
										<a onclick="return confirm('Hapus data?')" class="badge badge-danger float-left ml-2" href="<?php echo base_url(); ?>pic/hapus/<?php echo $client['id'] . '/' . $p['id']; ?>">Hapus</a>
								      </td>
								  <?php endif; ?>
								    </tr>
								<?php $i++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			<!-- End loop tabel -->
		</div>
	</div>	
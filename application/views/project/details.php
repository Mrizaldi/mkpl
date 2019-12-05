<div class="container-fluid mb-3">
	<div class="row mt-3 mb-3">
		<div class="col">
			<span class="h4">Kanban Board & Dokumen Projek <?=$project['projName'];?></span>			
			<span><a href="<?=base_url('project'); ?>" class="btn btn-primary float-right">Kembali</a></span>
		</div>
	</div>
	<?php echo $this->session->flashdata('message'); ?>
	<?php if($user['role_id'] < 4): ?>	
	<?php if(is_this_project_mine($project['pm'])): ?>
	<?php echo form_open_multipart('project/create2')?>
	    <input type="hidden" name="idproject" value="<?= $project['id'];   ?>">
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-10">
					<div class="custom-file  " >
						<input type="file" class="custom-file-input" id="filename2" name="filename2">
						<label class="custom-file-label" for="filename2">Document</label>
					</div>
				</div>
				<div class="col-2">
					<button type="submit" class="btn btn-primary float-right btn-block"><i class="fas fa-plus fa-fw"></i> Dokumen</button>
				</div>
			</div>
		</div>
	</form>
	<?php endif; ?>
	<?php endif; ?>
    <!--  -->
	<div class="row">
	<?php if(!empty($document)){foreach ($document as $frow) { ?>
		<div class="file-box">
			<div class="box-content">
				<?php if($user['role_id'] < 4): ?>
				<a class="float-right">
					<form action="<?= base_url().'project/delete2/'.$frow['id']; ?>" method="post">
					<input type="hidden" name="projId" id="projId" value="<?=$project['id']; ?>">
					<button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</form>
				</a>
			<?php endif; ?>
				<div class="row">
					<div class="col" style="height: 50px; overflow:hidden;">
						<?= $frow['filename'];?>
					</div>
				</div>
				<div class="preview" align="center">
					<i class="fas fa-4x fa-file-alt"  ></i>
				</div>
				<a href="<?= base_url().'project/download/'.$frow['id']; ?>" class="btn btn-outline-info" ><i class="fas fa-download"></i></a>
			</div>
		</div>
	<?php }}else{ ?>
			<div class="col">
				<span class="h4">Dokumen Belum Ditambahkan</span>
			</div>
	<?php } ?>
	</div>
	<!--  -->
	<?php if (is_pm_or_above($user['role_id'])):?>
		<?php if(is_this_project_mine($project['pm'])): ?>
			<div class="row mt-3">
				<div class="col">
					<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newBoardModal" id="newboard">New Board</a>
				</div>
			</div>
		<?php endif; ?>					      			
	<?php endif; ?>
	<!--  -->
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<div class="row my-3 mx-1">
					<?php if (!$board): ?>
						<div class="col">
							<h4 align="center">Board Belum Ditambahkan</h4>
						</div>
					<?php endif ?>
					<?php foreach ($board as $b):?>
						<div class="col">
							<div class="card">
								<div class="card-header">
									<?=$b['name'];?>
									<?php if(is_pm_or_above($user['role_id'])): ?>
									<a class="float-right">
										<form action="<?php echo base_url('board/delete/').$b['id']; ?>" method="post">
										<input type="hidden" name="projId" id="projId" value="<?=$project['id']; ?>">
										<input type="hidden" name="boardId" id="boardId" value="<?=$b['id']; ?>">
										<button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</form>
									</a>
									<?php endif; ?>
								</div>
								<div class="card-body">
									<?php foreach($task as $t): if($t['status']==$b['id']):?>
										<div class="card mt-1">
												<div class="card-body">
													<strong><?=$t['name']; ?></strong><br>
													<strong>Deadline : </strong><?=$t['endDate']; ?><br>
													<strong>Assignee : </strong>
													<?php foreach ($emp as $e){
														if ($e['id'] == $t['empId']) {
															echo $e['name'];
														}
													}?>
													<br>
												</div>
												<div class="card-footer" align="right">
													<?php if(!is_pm_or_above($user['role_id'])): ?>
														<?php if(is_this_task_mine($t['empId'])): ?>
															<a href="#" data-toggle="modal" data-target="#newTaskModal" class="viewTask" data-id="<?=$t['id'];?>" data-proj="<?=$project['id'];?>" data-mine="1"><span class="badge badge-success">View</span></a>
														<?php else: ?>
															<a href="#" data-toggle="modal" data-target="#newTaskModal" class="viewTask" data-id="<?=$t['id'];?>" data-proj="<?=$project['id'];?>" data-mine="0"><span class="badge badge-primary">View</span></a>
														<?php endif; ?>
													<?php else: ?>
														<a href="#" data-toggle="modal" data-target="#newTaskModal" class="viewTask" data-id="<?=$t['id'];?>" data-proj="<?=$project['id'];?>" data-mine="1"><span class="badge badge-primary">View</span></a>
													<?php endif; ?>
												</div>
										</div>
									<?php endif; endforeach; ?>
									<!--  -->
									<?php if (is_pm_or_above($user['role_id'])):?>
										<?php if(is_this_project_mine($project['pm'])): ?>
											<div align="center" class="mt-2">
												<a href="#" class="btn btn-sm btn-secondary tambahTask" data-toggle="modal" data-target="#newTaskModal"><span class="fas fa-plus"></span></a>
											</div>
										<?php endif; ?>					      	
									<?php endif; ?>
									<!--  -->
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div> 
			</div>
		</div>
	</div>
</div>
</div>

<!-- Modal For New Board -->

<div class="modal fade" id="newBoardModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Board</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url('board/tambah');?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" class="form-control" id="projId" placeholder="" name="projId" value="<?= $project['id'];?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nama" placeholder="Board name" name="nama">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary newboard">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal for new task -->

<div class="modal fade" id="newTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="taskModalLabel">Add New Task</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('task/tambah'); ?>" method="post">
					<div class="form-group">
						<input type="hidden" readonly="" id="projId" placeholder="" name="projId" value="<?= $project['id'];?>">
						<label for="projName">Nama Project</label>
						<label type ="text" id="projName" class="form-control" ><?=$project['projName'];?></label>
					</div>
					<div class="form-group">
						<input type="hidden" readonly="" class="form-control" id="taskId" placeholder="" name="taskId">
					</div>
					<div class="form-group">
						<label for="nama">Nama Task</label>
						<input type="text" class="form-control nama" id="nama" placeholder="" name="nama">    
						<small class="form-text text-danger"><?php echo form_error('nama'); ?></small>
					</div>
					<div class="row">
						<div class="form-group col-6">
						   <!-- <label for="startdate">Start Date Project</label> -->
						   <input type="hidden" readonly="" class="form-control" id="startdateprj" placeholder="" name="startdateprj" value="<?=$project['projStartDate'];?>">
						   <small class="form-text text-danger"><?php echo form_error('startdateprj'); ?></small>
						 </div>
						 <div class="form-group col-6">
						    <!-- <label for="enddate">End Date Project</label> -->
						    <input type="hidden" readonly="" class="form-control" id="enddateprj" placeholder="" name="enddateprj" value="<?=$project['projEndDate'];?>">
						    <small class="form-text text-danger"><?php echo form_error('enddateprj'); ?></small>
						 </div>
					</div>
					<div class="row">
						<div class="form-group col-6">
						   <label for="startdate">Start Date</label>
						   <input type="date" class="form-control" id="startdate" placeholder="" name="startdate" value="<?=$project['projStartDate'];?>">
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
						<label for="status">Status</label>
						<select class="form-control" id="status" name="status">
					    <?php foreach ($board as $b):?>
					    	<option value="<?=$b['id']; ?>"><?=$b['name'];?></option>
					    <?php endforeach; ?>
					</select>
					<small class="form-text text-danger"><?php echo form_error('status'); ?></small>
				</div>
				<div class="form-group">
					<label for="asignee">Assignee</label>
					<select class="form-control" id="assignee" name="assignee">
						<?php foreach ($emp as $e):if($e['role_id'] > 3):?>
							<option value="<?=$e['id']; ?>">
								<?php foreach ($role as $r) {
									if ($e['role_id'] == $r['id']) {
										echo $r['role'];
									}
								} ?> - 								
								<?=$e['name'];?>
							</option>
						<?php endif; endforeach; ?>
					</select>
					<small class="form-text text-danger"><?php echo form_error('assignee'); ?></small>
				</div>
				<div class="modal-footer">
					<?php if(is_pm_or_above($user['role_id'])): ?>
					<a href="#" class="btn btn-danger float-right" data-id="<?=$project['id'];?>">Hapus Task</a>
					<?php endif; ?>
					<button type="submit" class="btn btn-primary float-right">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<!-- Modal for detail task -->

<!--  -->
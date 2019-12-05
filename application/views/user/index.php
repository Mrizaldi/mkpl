        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Hello <?=$user['name'];?></h1>
          <div class="row">
            <div class="col-lg-6">
              <?=$this->session->flashdata('message');?>
            </div>
          </div>
          <div class="row">
          <div class="col-6">
            <div class="card mb-3" style="max-width: 100%;">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="<?php echo base_url('assets/img/profile/') . $user['image'];?>" class="card-img" alt="img profile">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $user['name'];?></h5>
                    <p class="card-text">Email : <?php echo $user['email'];?></p>
                    <!-- <p class="card-text">Phone : <?php echo $user['phone'];?></p> -->
                    <p class="card-text">Jabatan : <?php echo $role['role'];?></p>
                    <p class="card-text"><small class="text-muted">Bergabung sejak <?php echo date('d F Y',$user['date_created']);?></small></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6"></div>
          </div> 
          <!--  -->
          <?php if($_SESSION['user']['role_id']>2): ?>
            <?php if($_SESSION['user']['role_id'] != 3): ?>
            <div class="row">
              <div class="col">
                <div class="card mb-3" style="width: 100%;">
                  <div class="card-header">
                    My Task
                  </div>
                  <div class="card-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Start Date</th>
                          <th scope="col">End Date</th>
                          <th scope="col">Deskripsi</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;?>
                            <?php foreach ($emptask as $et): ?>
                              <tr>
                                <th scope="row"><?=$i; ?></th>
                                <td><?=$et['name'];?></td>
                                <td><?=$et['startDate'];?></td>
                                <td><?=$et['endDate'];?></td>
                                <td><?=$et['deskripsi'];?></td>
                                <td>
                                  <?php
                                    foreach ($board as $b) {
                                      if ($et['status'] == $b['id']) {
                                        echo $b['name'];
                                      }
                                    }
                                  ?>
                                </td> 
                                <td>
                                  <a href="<?php echo base_url('project/view/').$et['projId']; ?>" class="badge badge-primary ml-1">View Kanboard</a>
                                </td>                             
                              </tr>
                          <?php $i++; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?php else: ?>
              <div class="row">
              <div class="col">
                <div class="card mb-3" style="width: 100%;">
                  <div class="card-header">
                    My Project
                  </div>
                  <div class="card-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Client</th>
                          <th scope="col">Start Date</th>
                          <th scope="col">End Date</th>
                          <th scope="col">Progress</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;?>
                            <?php foreach ($empproj as $ep): ?>
                              <tr>
                                <tr>
                                  <th scope="row"><?=$i; ?></th>
                                  <td><?=$ep['projName'];?></td>
                                  <td><?php
                                      foreach ($client as $c) {
                                        if ($ep['clientId'] == $c['id']) {
                                          echo $c['clientName'];
                                        }
                                      }
                                       ?>
                                  </td>
                                  <td><?=$ep['projStartDate'];?></td>
                                  <td><?=$ep['projEndDate'];?></td>
                                  <td><?=$ep['projProgress'].'%';?></td>
                                  <td>
                                    <a href="<?php echo base_url('project/view/').$ep['id']; ?>" class="badge badge-primary ml-1">Details</a>
                                    <a href="<?php echo base_url('project/update/').$ep['id']; ?>" class="badge badge-success ml-1">Update</a>
                                  </td>
                                </tr>
                          <?php $i++; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endif; ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

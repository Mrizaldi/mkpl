        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Profil <?=$emp['name'];?> </h1>
          <div class="row">
            <div class="col-6">
              <div class="card mb-3" style="width: 100%;">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="<?php echo base_url('assets/img/profile/') . $emp['image'];?>" class="card-img" alt="img profile">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $emp['name'];?></h5>
                      <p class="card-text">Email : <?php echo $emp['email'];?></p>
                      <!-- <p class="card-text">Phone : <?php echo $user['phone'];?></p> -->
                      <p class="card-text">Jabatan : <?php foreach($role as $r){
                                                        if($emp['role_id'] == $r['id']){
                                                          echo $r['role'];
                                                        }
                                                      }?></p>
                      <p class="card-text"><small class="text-muted">Bergabung sejak <?php echo date('d F Y',$user['date_created']);?></small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--  -->         
            <div class="col-6">
              
            </div>   
          </div>
          <!--  -->
          <?php if($emp['role_id']>2): ?>
            <?php if($emp['role_id'] != 3): ?>
            <div class="row">
              <div class="col">
                <div class="card mb-3" style="width: 100%;">
                  <div class="card-header">
                    Employee Task
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
                    Employee Project
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

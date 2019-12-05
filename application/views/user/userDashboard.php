        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h3>My Dashboard</h3>          
          <div class="row">
              <!-- Pending Requests Card Example -->
              <div class="col-xl-6 col-md-6 mb-2" style="height: auto;">
                <div class="">
                  <div class="card border-left-warning shadow h-100 py-2 mt-3">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">MY PROJECTS</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$num_project; ?></div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-project-diagram fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--  -->
                  <div class="card border-left-info shadow h-100 py-2 my-3">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Tasks</div>
                          <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_task; ?></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--  -->
                  <div class="py-2 px-2">
                  <div class="row">
                    <div class="col-4">
                      <div class="card border-left-info shadow h-100">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">To Do Task</div>
                              <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= count($todoTask); ?></div>
                                </div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-pencil-alt fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="card border-left-info shadow h-100">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">In Progress Task</div>
                              <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= count($inprogressTask); ?></div>
                                </div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-cog fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="card border-left-info shadow h-100">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Done Task</div>
                              <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= count($doneTask); ?></div>
                                </div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
<!-- PM - Project Informasi pm dan projek employee -->
         <div class="col-xl-6 col-md-6 mb-2" style="height: auto; overflow: hidden;">
          <div class="">
          <div class="card border-left-info shadow h-100 py-2 mt-3">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PM Project</div>
                  <!-- <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_task; ?></div>
                    </div>
                  </div> -->
                </div>
                <div class="col-auto">
                  <i class="fas far fa-user-tie fa-2x text-gray-300"></i>
                </div>
              </div>
              <div class="overflow-auto my-2" style="height: 250px; overflow: hidden;">
                <?php foreach ($project as $p) :?>
                  <a href="<?= base_url('project/view/') . $p['id']; ?>" style="text-decoration: none;">
                  <div class="card my-2 border-primary">
                    <div class="card-footer">
                      <?php 
                        foreach ($projectpm as $pm) {
                          if ($p['pm']==$pm['id']) {
                            echo $pm['name'] . " - ";
                          }
                        }
                        echo $p['projName'] . "<br>";
                      ?>
                    </div>
                  </div>
                  </a>
                <?php endforeach;?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>

        

          <div class="row mt-2 mb-1">
            <!--  -->
            <div class="col-lg-4">
              <div class="card shadow mb-2">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">New Task</h6>
                  </div>
                  <div class="card-body">
                      <?php $i = 0; ?>
                      <?php foreach ($todoTask as $tt): ?>
                        <a href="<?= base_url('project/view/') . $tt['projId']; ?>" style="text-decoration: none;">
                          <div class="card my-2 border-primary">
                            <div class="card-footer">
                              <?=$tt['name']. " <br> Due Date : " . $tt['endDate'] ?>
                            </div>
                          </div>
                        </a>
                      <?php endforeach; ?>
                  </div>
               </div>
              </div>
              <!--  -->
              <div class="col-lg-4">
              <div class="card shadow mb-2">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">In Progress Task</h6>
                  </div>
                  <div class="card-body">
                      <?php $i = 0; ?>
                      <?php foreach ($inprogressTask as $tt): ?>
                        <a href="<?= base_url('project/view/') . $tt['projId']; ?>" style="text-decoration: none;">
                          <div class="card my-2 border-primary">
                            <div class="card-footer">
                              <?=$tt['name']. " <br> Due Date : " . $tt['endDate'] ?>
                            </div>
                          </div>
                        </a>
                      <?php endforeach; ?>
                  </div>
               </div>
              </div>
              <!--  -->
              <div class="col-lg-4">
                <div class="card shadow">
                  <div class="card-header mb-2">
                    <h6 class="m-0 font-weight-bold text-primary">Finished Task</h6>
                  </div>
                  <div class="card-body">
                      <?php $i = 0; ?>
                      <?php foreach ($doneTask as $tt): ?>
                        <a href="<?= base_url('project/view/') . $tt['projId']; ?>" style="text-decoration: none;">
                          <div class="card my-2 border-primary">
                            <div class="card-footer">
                              <?=$tt['name']. " <br> Due Date : " . $tt['endDate'] ?>
                            </div>
                          </div>
                        </a>
                      <?php endforeach; ?>
                  </div>
                </div>
              </div>
          </div>
          <!--  -->
          <input type="hidden" id="empid" name="empid" value="<?=$_SESSION['user']['emp_id'];?>">
          <div  class="row mb-3 mt-2">
            <div class="col">
                <div class="card shadow">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gantt Chart Task</h6>
                  </div>
                  <div class="card-body">
                    <div id="chart_task_employee"></div>
                  </div>                  
                </div>
              </div>
          </div>
        
      </div>
    </div>
      <!-- End of Main Content -->
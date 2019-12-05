        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h3 class="">My Dashboard</h3>          
          <div class="row">
              <!-- Pending Requests Card Example -->
              <div class="col-xl-6 col-md-6 mb-4" style="height: 350px;">
                <div class="">
                  <div class="card border-left-warning shadow h-100 py-2 mt-3">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">MY PROJECTS</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_project; ?></div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-project-diagram fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--  -->
                  <div class="card border-left-info shadow h-100 py-2 mt-3">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Project Tasks</div>
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
                  <div class="row">
                    <div class="col">
                      <div class="card border-left-info shadow h-100 py-2 mt-3">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">In Progress Project</div>
                              <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $inprogressprj; ?></div>
                                </div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card border-left-info shadow h-100 py-2 mt-3">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Done Project</div>
                              <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $doneprj; ?></div>
                                </div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<!-- Earnings (Monthly) Card Example -->
         <div class="col-xl-6 col-md-6 mb-2" style="height: auto; overflow: hidden;">
          <div class="">
          <div class="card border-left-info shadow h-100 py-2 mt-3">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">My Project</div>
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
                <?php foreach ($project2 as $p) :?>
                  <a href="<?= base_url('project/view/') . $p['id']; ?>" style="text-decoration: none;">
                  <div class="card my-2 border-primary">
                    <div class="card-footer">
                      <?php 
                        echo $user['name'] . ' - ' . $p['projName'] . "<br>";
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

        


        

          <div class="row mt-2">
            <div class="col-lg">
              <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                  </div>
                  <div class="card-body">
                      <?php $i = 0; ?>

                 

                      <?php foreach ($project2 as $p): ?>
                        <h4 class="small"><strong><?=$p['projName'];?></strong><span> | Due Date : <?=$p['projEndDate'];?></span><span class="float-right"><?=$p['projProgress'].'%';?></span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?=$p['projProgress'].'%';?>" aria-valuenow="<?=$p['projProgress'].'%';?>" aria-valuemin="0" aria-valuemax="100">                              
                            </div>
                        </div>
                      <?php $i++; if($i == 5){break;}endforeach; ?>
                  </div>
               </div>
              </div>


          </div>






          <div  class="row mb-4">
            <div class="col">
                <div class="card shadow">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gantt Chart Project</h6>
                  </div>
                  <div class="card-body">
                      <div id="chart_projectpm"></div>
                  </div>                  
                </div>
              </div>
          </div>

      <!-- End of Main Content -->
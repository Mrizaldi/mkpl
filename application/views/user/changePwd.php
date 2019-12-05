        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>
          <div class="row">
            <div class="col-lg-6">
              <?=$this->session->flashdata('message');?>
            </div>
          </div>
          <div class="row">
            <div class="col-lg">
              <div class="card">
                <div class="card-body">
                <form action="<?= base_url('user/changepwd');?>" method="post">
                  <div class="form-group">
                    <label for="currentpassword">Current Password</label>
                    <input type="password" class="form-control form-control-user" id="currentpassword" placeholder="" name="currentpassword">
                    <?php echo form_error('currentpassword','<small class="text-danger pl-3">','</small>'); ?>
                  </div>  
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="newpwd1">New Password</label>
                      <input type="password" class="form-control form-control-user" id="newpwd1" placeholder="" name="newpwd1">
                      <?php echo form_error('newpwd1','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="newpwd1">Repeat Password</label>
                      <input type="password" class="form-control form-control-user" id="newpwd2" placeholder="" name="newpwd2">
                      <?php echo form_error('newpwd2','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Change Password</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

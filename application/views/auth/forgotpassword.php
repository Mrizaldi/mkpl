    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-7 col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Lupa Password ?</h1>
                                    </div>
                                    <?php echo $this->session->flashdata('message'); ?>
                                    <form class="user" action="<?php echo base_url('auth/forgotpassword'); ?>" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
                                            <?php echo form_error('email','<small class="text-danger pl-3">','</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth'); ?>">Kembali ke Login</a>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


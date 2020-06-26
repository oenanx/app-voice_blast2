        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><img src="<?=base_url('assets/images/Blast_voice.png')?>" width="64px" height="64px" alt="Logo Apps" />&nbsp;&nbsp;<span class="text-center" style="color:red;"><b>RoboBlast</b></span>&nbsp;Login</h3></div>
                                    <div class="card-body">
                                        <form action="<?php echo base_url() ?>index.php/Home" method="post">
											<div class="form-group has-feedback">
												<input name="username" type="text" required class="form-control form-control-sm" placeholder="User name" autofocus>
												<span class="glyphicon glyphicon-user form-control-feedback"></span>
											</div>
											<div class="form-group has-feedback">
												<input name="password" type="password" required class="form-control form-control-sm" placeholder="Password">
												<span class="glyphicon glyphicon-lock form-control-feedback"></span>
											</div>
											<span id="notif"></span>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"></div>
 										<?php if(isset($error)) { echo $error; }; ?>
                                    </div>
                                    <div class="card-footer text-center">
										<div class="col-xs-4">
											<button type="submit" class="btn btn-danger btn-block btn-flat btn-sm">Log In</button>
										</div>
                                       </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

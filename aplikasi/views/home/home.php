<script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
    
	<div id="layoutSidenav_content">
		<main>
			<!--<div class="col-md-10">-->
				<div class="card card-danger">
					<div class="card-header with-border">
						<h4 class="card-title">Selamat datang di Aplikasi RoboBlast Atlasat,</h4>
					</div><!-- /.card-header -->
				
					<div class="card-body">
						<div class="page-wrapper">
							<div class="page-body">
								<div class="row">
									<div class="col-md-12 col-xl-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h2>&nbsp;<?php foreach($all->result() as $rowall):?><?php echo $rowall->tot_call;?><?php endforeach;?></h2>

												<p><h4 class="m-b-20">&nbsp;Total Call All</h4></p>
											</div>
											<iconify-icon data-icon="ic:outline-call" data-align="right" style="width: 72px; height: 72px;"></iconify-icon>&nbsp;&nbsp;&nbsp;<iconify-icon data-icon="flat-color-icons:missed-call" data-align="right" style="width: 72px; height: 72px;"></iconify-icon>&nbsp;&nbsp;&nbsp;<iconify-icon data-icon="ic:outline-call-end" data-align="right" style="width: 72px; height: 72px;"></iconify-icon>
										</div>
									</div>
									
									<div class="col-md-12 col-xl-3">
										<div class="small-box bg-success">
											<div class="inner">
												<h2>&nbsp;<?php foreach($ppo->result() as $rowppo):?><?php echo $rowppo->tot_open;?><?php endforeach;?></h2>

												<p><h4 class="m-b-20">&nbsp;Total Call Completed</h4></p>
											</div>
											<iconify-icon data-icon="ic:outline-call" data-align="right" style="width: 72px; height: 72px;"></iconify-icon>
										</div>
									</div>
									
									<div class="col-md-12 col-xl-3">
										<div class="small-box bg-warning">
											<div class="inner">
												<h2>&nbsp;<?php foreach($gro->result() as $rowgro):?><?php echo $rowgro->tot_open2;?><?php endforeach;?></h2>

												<p><h4 class="m-b-20">&nbsp;Total Call Busy</h4></p>
											</div>
											<div class="icon">
												<iconify-icon data-icon="flat-color-icons:missed-call" data-align="right" style="width: 72px; height: 72px;"></iconify-icon>
											</div>
										</div>
									</div>
									
									<div class="col-md-12 col-xl-3">
										<div class="small-box bg-danger">
											<div class="inner">
												<h2>&nbsp;<?php foreach($vco->result() as $rowvco):?><?php echo $rowvco->tot_open3;?><?php endforeach;?></h2>

												<p><h4 class="m-b-20">&nbsp;Total Call Failed</h4></p>
											</div>
											&nbsp;<iconify-icon data-icon="ic:outline-call-end" data-align="right" style="width: 72px; height: 72px;"></iconify-icon>
										</div>
									</div>
								</div>
							</div>
						</div>
							<!-- <div align="center" class="post">
								<a href="< ?=base_url()?>" class="navbar-brand">
									<img src="< ?=base_url('assets/images/bgotp.jpg')?>" class="logoapps" width="480px" height="240px" alt="Logo Apps" />
								</a>
							</div> -->
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			<!--</div>-->
		</main>

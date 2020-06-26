		<div class="col-md-3">
			<div class="card card-danger">  <!-- /.card-login area -->
				<div class="card-header with-border">
					<h3 class="card-title">Login</h3>
				</div>
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
				</div><!-- /.card-body -->
				
				<div class="card-footer">
					<div class="col-xs-4">
						<button type="submit" class="btn btn-danger btn-block btn-flat btn-sm">Log In</button>
					</div><!-- /.col -->
				</div>
				</form>
				<?php if(isset($error)) { echo $error; }; ?>
			</div><!-- /.card -->

		</div>

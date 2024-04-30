<div class="auth-wrapper">
	<div class="auth-content container">
		<div class="card">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="card-body">
						<img src="../assets/images/logo-dark.png" alt="" class="img-fluid mb-4">
						<h4 class="mb-3 f-w-400">Login into your account</h4>
						<form action=<?php echo _WEB_ROOT . '/login/handle_login' ?> method="post">

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="feather icon-user"></i></span>
								</div>
								<input required name="account" type="text" class="form-control" placeholder="Enter account">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="feather icon-lock"></i></span>
								</div>
								<input required name="password" type="password" class="form-control" placeholder="Enter password">
							</div>

							<div>
								<p style="color:red">
									<?php if (isset($_SESSION['login_error'])) {
										echo $_SESSION['login_error'];
									} ?>
								</p>
							</div>

							<div class="form-group text-left mt-2">
								<div class="checkbox checkbox-primary d-inline">
									<input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
									<label for="checkbox-fill-a1" class="cr"> Save credentials</label>
								</div>
							</div>
							
							<button class="btn btn-primary mb-4">Login</button>

						</form>

						<p class="mb-2 text-muted">Forgot password? <a href="#" class="f-w-400">Reset</a></p>

					</div>
				</div>
				<div class="col-md-6 d-none d-md-block">
					<img src="./assest/images/login/auth-bg.jpg" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="../assets/js/vendor-all.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>


<!-- <div class="footer-fab">
	<div class="b-bg">
		<i class="fas fa-question"></i>
	</div>
	<div class="fab-hover">
		<ul class="list-unstyled">
			<li><a href="../doc/index-bc-package.html" target="_blank" data-text="UI Kit" class="btn btn-icon btn-rounded btn-info m-0"><i class="feather icon-layers"></i></a></li>
			<li><a href="../doc/index.html" target="_blank" data-text="Document" class="btn btn-icon btn-rounded btn-primary m-0"><i class="feather icon feather icon-book"></i></a></li>
		</ul>
	</div>
</div> -->
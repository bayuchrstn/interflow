<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login - Interflow Administrator</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>assets_admin/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>assets_admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>assets_admin/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>assets_admin/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>assets_admin/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>assets_admin/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->


</head>

<body class="bg-slate-800">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="login-form ">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<img src="<?= base_url(); ?>assets_admin/media/logos/originals/logo-interflow.png">
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" class="form-control" placeholder="Username" name="username" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							<div id="logerror"></div>
							<div class="form-group d-flex align-items-center">

								<!-- <a href="login_password_recover.html" class="ml-auto">Forgot password?</a> -->
							</div>

							<div class="form-group">
								<button id="btn-login" type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="form-group text-center text-muted content-divider">
								<!-- <span class="px-2">Don't have an account?</span> -->
							</div>

							<div class="form-group">
								<!-- <a href="#" class="btn btn-light btn-block">Sign up</a> -->
							</div>
						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

	<!-- Core JS files -->
	<script src="<?= base_url() ?>assets_admin/global_assets/js/main/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets_admin/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>assets_admin/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?= base_url() ?>assets_admin/global_assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="<?= base_url() ?>assets_admin/js/app.js"></script>
	<script src="<?= base_url() ?>assets_admin/global_assets/js/demo_pages/login.js"></script>
	<script src="<?= base_url() ?>assets_admin/global_assets/js/plugins/forms/validation/validate.min.js"></script>
	<script src="<?= base_url() ?>assets_admin/global_assets/js/demo_pages/form_validation.js"></script>
	<!-- /theme JS files -->
	<script>
		$(document).ready(function() {
			$('.login-form').validate();
			$(document).on('click', '#btn-login', function() {
				var url = "<?= base_url() ?>Login/user_login";
				if ($('.login-form').valid()) {
					$.ajax({
						type: "POST",
						url: url,
						data: $(".login-form").serialize(), // serializes the form's elements.
						beforeSend: function() {
							$('#logerror').html('<img src="<?= base_url() ?>assets_admin/global_assets/images/AjaxLoader.gif" align="middle"> Please wait...').bind();
						}
					}).done(function(data) {
						if (data == 1)

							window.location.href = "<?= base_url() ?>Login/login_auth";
						else $('#logerror').html('Username / Password salah, <br> atau akun sudah nonaktif.').delay(8000).fadeOut(); 
						$('#logerror').addClass("error"); // The username or password you entered is incorrect.
					});

				}
				return false;
			});
		});
	</script>
</body>

</html>
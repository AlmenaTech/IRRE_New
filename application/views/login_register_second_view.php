<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="<?php echo base_url(); ?>">
	<link rel="stylesheet" href="./themes/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./themes/assets/fonts/css/font-awesome.css">
	<link rel="stylesheet" href="./themes/assets/css/custom/login_register_ver_2.css">
	<link rel="stylesheet" href="./themes/assets/components/css/button.css">
	<link rel="stylesheet" href="./themes/assets/css/utilities/utility.css">
	<link rel="stylesheet" href="./themes/assets/fonts/css/font-awesome.min.css">
	<script src="./themes/assets/js/jquery.js"></script>
	<script src="./themes/assets/js/bootstrap.js"></script>
</head>
<body class="container-fluid login-register-container">
	<div class="row ">
		<div class="col-md-6 col-sm-6 col-xs-12  login-container" >
			<div class="login-body">
				<a class="btn button-style-2">Login</a>
				<div class="or-container m-top-20"><p>OR</p></div>
				<div class="google-login">
					<a href="<?php echo $google_auth['url']; ?>" class="text-center">
					<i class="fa fa-google-plus"></i> Login With Google</a>
				</div>
				<div class="twitter-login m-top-5">
					<a href="<?php echo $twitter_auth['twitter_login_url']; ?>" class="text-center">
					<i class="fa fa-twitter"></i> Login With Twitter</a>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12  register-container">
			<div class="register-body">
				<a class="btn button-style-3"> Sign Up</a>
				<!-- <div class="or-container m-top-20"><p>OR</p></div>
				<div class="google-login">
					<a href="<?php echo $google_auth['url']; ?>" class="m-right-20 g-plus-ico">
					<i class="fa fa-google-plus"></i> Sign Up With Google</a>
				</div>
				<div class="twitter-login">
					<a href="<?php echo $twitter_auth['twitter_login_url']; ?>" class="m-right-20 g-plus-ico">
					<i class="fa fa-twitter"></i>  Sign Up With Twitter</a>
				</div> -->
			</div>
		</div>
	</div>
	
</body>
</html>
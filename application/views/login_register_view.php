<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="<?php echo base_url(); ?>">
	<link rel="stylesheet" href="./themes/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./themes/assets/fonts/css/font-awesome.css">
	<link rel="stylesheet" href="./themes/assets/css/custom/login_register.css">
	<link rel="stylesheet" href="./themes/assets/css/utilities/utility.css">
	<link rel="stylesheet" href="./themes/assets/fonts/css/font-awesome.min.css">
	<script src="./themes/assets/js/jquery.js"></script>
	<script src="./themes/assets/js/bootstrap.js"></script>
</head>
<body class="container-fluid">
<?php //print_r($_SESSION['token_data']); ?>
	<div class="row">
		<div class="col-md-12 login-container">
			<div class="col-md-12  text-center">
				<a href="javascript:void(0)" class="btn login-btn m-top-40">Login</a>
			</div>
			<div class="col-md-12  text-center">
				<div class="m-top-20">
					<a href="<?php //echo $google_auth_url; ?>" class="m-right-20 g-plus-ico"><i class="fa fa-google-plus"></i></a>
					<a href="<?php echo $twitter_auth_url; ?>" class="m-right-20 twitter-ico"><i class="fa fa-twitter"></i></a>
					<a href="javascript:void(0)" class="linkedin-ico"><i class="fa fa-linkedin"></i></a>
				</div>
			</div>
		</div>
		<div class="col-md-12 register-container">
			
			<div class="col-md-12  text-center">
				<a href="javascript:void(0)" class="btn register-btn m-top-60" >Register</a>
			</div>
			<div class="col-md-12  text-center">
				<div class="m-top-20">
					<a href="javascript:void(0)" class="m-right-20 g-plus-ico"><i class="fa fa-google-plus"></i></a>
					<a href="javascript:void(0)" class="m-right-20 twitter-ico"><i class="fa fa-twitter"></i></a>
					<a href="javascript:void(0)" class="linkedin-ico"><i class="fa fa-linkedin"></i></a>
				</div>
			</div>
		</div>
	</div>
	<a href="javascript:void(0)" class="btn home-btn" ><i class="fa fa-arrow-left"></i> Back To Home</a>
</body>
</html>
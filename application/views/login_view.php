<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="<?php echo base_url(); ?>">
	<link rel="stylesheet" href="./themes/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./themes/assets/fonts/css/font-awesome.css">
	
	<link rel="stylesheet" href="./themes/assets/css/custom/login.css">
	
	
	<script src="./themes/assets/js/jquery.js"></script>
	<script src="./themes/assets/js/bootstrap.js"></script>
</head>
<body class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 login_div_containe">
			<div class="col-md-4  col-sm-6 col-xs-10  login_div">
				<div class="row login_header">
					<h4>Register</h4>
				</div>
				<div class="col-md-12">
					
					<?php 
						if(isset($error_msg))
						{
					?>
							<div class="alert alert-warning">
								
									<?php echo $error_msg; ?>
									
							</div>
					<?php
						}
					?>
				</div>
				<?php echo form_open(base_url().'login'); ?>
				<div class="form-group">
					<label>UserID :</label>
					<input type="text" name="login_id" class="form-control" placeholder="Enter login id"
							value="<?php echo set_value('login_id') ?>">
					<span class="text-danger" ><?php echo form_error('login_id'); ?></span>
				</div>

				<div class="form-group">
					<label>Password :</label>
					<input type="password" name="user_pass" class="form-control password" placeholder="Enter password" value="">
					<span class="text-danger" ><?php echo form_error('user_pass'); ?></span>
				</div>
				<div class="form-group">
					
					<input type="submit" name="" class="btn login_btn" value="Login">
				</div>
				
				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</body>
<script src="./themes/assets/js/common/sha256.min.js"></script>
<script src="./themes/assets/js/custom/login.js"></script>
</html>
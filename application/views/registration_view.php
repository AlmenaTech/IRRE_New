<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="<?php echo base_url(); ?>">
	<link rel="stylesheet" href="./themes/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./themes/assets/fonts/css/font-awesome.css">
	
	<link rel="stylesheet" href="./themes/assets/css/custom/registration.css">
	<link rel="stylesheet" href="./themes/assets/css/utilities/utility.css">
	
	<script src="./themes/assets/js/jquery.js"></script>
	<script src="./themes/assets/js/bootstrap.js"></script>
</head>
<body class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 login_div_containe">
			<div class="col-md-6  col-sm-6 col-xs-10  login_div">
				<div class="row login_header">
					<h4>Register</h4>
				</div>
				<div class="col-md-12">
					<?php if(isset($success_msg)){ ?> 
						<div class="alert alert-success"><?php echo $success_msg; ?></div>	
					<?php } ?>
					<?php if(isset($err_msg)){ ?> 
						<div class="alert alert-success"><?php echo $err_msg; ?></div>	
					<?php } ?>
				</div>
				<?php echo form_open(current_url()) ?>
				<div class="row pad-bottom-20 ">
					<div class="col-md-6 col-md-offset-3">
						<label>Register As: </label>
						<select name="stake_type" class="form-control border-rad">
							<option value="">-- Select --</option>
							<?php foreach($stakes as $stake){ ?> 
								<option value="<?php echo $stake['irre_stake_id_pk']; ?>" <?php echo set_select('stake_type',$stake['irre_stake_id_pk']); ?>><?php echo $stake['stake_name']; ?></option>
							<?php } ?>
						</select>
						<?php echo form_error('stake_type'); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>First Name:</label>
							<input type="text" name="fname" class="form-control" placeholder="Enter first name"
									value="<?php echo set_value('fname') ?>">
							<span class="text-danger" ><?php echo form_error('fname'); ?></span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Middle Name :</label>
							<input type="text" name="mname" class="form-control" placeholder="Enter middle name"
									value="<?php echo set_value('mname') ?>">
							<span class="text-danger" ><?php echo form_error('mname'); ?></span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Last Name :</label>
							<input type="text" name="lname" class="form-control" placeholder="Enter last name"
									value="<?php echo set_value('lname') ?>">
							<span class="text-danger" ><?php echo form_error('lname'); ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Mail ID :</label>
							<input type="text" name="email" class="form-control" placeholder="Enter mail id"
									value="<?php echo set_value('email') ?>">
							<span class="text-danger" ><?php echo form_error('email'); ?></span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Password :</label>
							<input type="password" name="password" class="form-control password" placeholder="Enter password" value="">
							<span class="text-danger" ><?php echo form_error('password'); ?></span>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							
							<input type="submit" name="" class="btn login_btn" value="Register">
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</body>
<script src="./themes/assets/js/common/sha256.min.js"></script>
<script src="./themes/assets/js/custom/registration.js"></script>
</html>
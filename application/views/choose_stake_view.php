<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo base_url(); ?>">
	<link rel="stylesheet" href="./themes/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./themes/assets/fonts/css/font-awesome.css">
	<link rel="stylesheet" href="./themes/assets/css/custom/stake_view.css">
	<link rel="stylesheet" href="./themes/assets/css/utilities/utility.css">
	<link rel="stylesheet" href="./themes/assets/fonts/css/font-awesome.min.css">
	<script src="./themes/assets/js/jquery.js"></script>
	<script src="./themes/assets/js/bootstrap.js"></script>
</head>
<body class="container-fluid">
	<section class="box">
		<?php echo form_open('login_register/setup_profile'); ?>
		<div class="row">
			<div class="stakes-container col-md-5 col-sm-5 col-xs-8">
				<div class="stakes-body col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<h3 class="text-center">Choose Your Role</h3>
					</div>
					<?php if($this->session->flashdata('err_msg')){ ?> 
						<h5 class="alert alert-danger"><?php echo $this->session->flashdata('err_msg'); ?></h5>
					<?php } ?>
					<?php foreach($stakes as $stake){ ?> 
						<div class="col-md-12 col-sm-12 col-xs-12 stakes-content">
							<div class="col-md-1 col-sm-1 col-xs-1" ><input type="radio" name="stake_type" value="<?php echo $stake['irre_stake_id_pk']; ?>"></div>
							<div class="col-md-10 col-sm-10 col-xs-10"><h4 ><?php echo $stake['stake_name']; ?></h4></div>
						</div>
					<?php } ?>
					<div class="col-md-12 col-sm-12 col-xs-12 stakes-content">
						<div class="col-md-12 col-sm-12 col-xs-12"><input type="submit" class="btn setup-btn" value="Set Up" ></div>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</section>
</body>
</html>
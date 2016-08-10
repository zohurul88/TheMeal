<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

</head>
<body>

<div id="container">
	<div id="body">
		<div class="container">
		<div class="row">
		<div class="col-md-6 col-md-offset-3" style="margin-top:50px; padding:20px; border:1px solid #efefef">
	<?php echo form_open('admin/attempet', array('id' => "user-create")); ?>
		<?php echo validation_errors(); ?> 
	<div id="alert" class="alert " role="alert" style="display:none;"></div>
				  <div class="form-group">
			      <label for="email">Email</label>
			      <input type="text" name="email" class="form-control email" id="email" placeholder="Enter Email">
			    </div>
 					<div class="form-group">
			      <label for="pass">Password</label>
			      <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
			    </div>
			    <button type="submit" class="btn btn-default">Login</button>
	  <?php echo form_close(); ?>
	  	</div>
	  </div>
		</div>
	</div>
</div>
</body>
</html>
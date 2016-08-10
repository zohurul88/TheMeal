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
	<?php echo form_open('admin/newuser', array('id' => "user-create")); ?>
		<?php echo validation_errors(); ?>
	<div id="alert" class="alert " role="alert" style="display:none;"></div>
				   <div class="form-group">
			      <label for="name">Name:</label>
			      <input type="text" class="form-control not-required" name="name" id="name" placeholder="Enter Name">
			    </div>

			    <div class="form-group">
			      <label for="email">Email</label>
			      <input type="text" name="email" class="form-control email" id="email" placeholder="Enter Email">
			    </div>

				 <!-- <div class="form-group">
			      <label for="gender">Select Gender:</label>
			       <select class="form-control" id="gender" name="gender">
			       	<option selected>Select Gender</option>
						    <option value="1">Mail</option>
						    <option value="2">Female</option>
						  </select>
			    </div> -->
 					<div class="form-group">
			      <label for="pass">Password</label>
			      <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
			    </div>
			    <button type="submit" class="btn btn-default">Submit</button>
	  <?php echo form_close(); ?>
	  	</div>
	  </div>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
	$("#user-create").submit(function(){
		var hasError=false;
		$(this).find("input").each(function(){
			if($(this).val()==""){
				$(this).parent("div").addClass("has-error");
				hasError=true;
			}else if($(this).hasClass("email") && !validateEmail($(this).val()))
			{
				$(this).parent("div").addClass("has-error");
				hasError=true;
			}
		});
		if(!hasError)
		{
			$.ajax({
				url: $(this).attr("action"),
				case: false,
				type: "POST",
				dataType: "json",
				data: $(this).serialize(),
				beforeSend: function (request)
        {
          request.setRequestHeader("Authority", "<?php echo md5(session_id()) ?>");
        },
				success: function(res)
				{
					if(typeof res.status !== "undefined")
					{
						if(res.status==403)
						{

						}
						else if(res.status==200)
						{
							$("#alert").removeClass().addClass("alert alert-success").text("New User "+res.data['fullname']+" Has Added").fadeIn().delay(5000).slideUp();
						}else if(res.status==500)
						{

						}
					}
				}
			});
		}else{
			$("#alert").removeClass().addClass("alert alert-danger").text("Look Like you miss Something").fadeIn().delay(5000).slideUp();
		}
		return false;
	});

	$("input").focus(function(){
		$(this).parent("div").removeClass("has-error");
	});

	function validateEmail(email)
	{
	    var re = /\S+@\S+\.\S+/;
	    return re.test(email);
	}
})
</script>


</body>
</html>
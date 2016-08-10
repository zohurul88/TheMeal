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
			<table class="table">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
				<?php foreach ($users as $user): ?>
					<tr>
						<td><?php echo $user->id; ?></td>
						<td><?php echo $user->fullname; ?></td>
						<td><?php echo $user->email; ?></td>
						<td><a class="delete user-<?php echo $user->id; ?>" data-id="<?php echo $user->id; ?>" href="<?php echo base_url("index.php/admin/delete/".$user->id); ?>">Delete</a></td>
					</tr>
				<?php endforeach; ?>
			</table>
	  </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$("a.delete").click(function(e){
			e.preventDefault();
			var parent=$(this).parents("tr");
			if(confirm('Are You Sure?'))
				{
					parent.addClass("alert alert-danger")
					$.ajax({
					url: $(this).attr("href"),
					case: false,
					type: "POST",
					dataType: "json",
					data: $(this).data(),
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
							parent.slideUp(500);
							setTimeout(function(){
								parent.remove();
							},600)
							}else if(res.status==500)
							{

							}
						}
					}
				});
				}
		})
	});
</script>
</body>
</html>
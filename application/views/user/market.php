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
			<table class="table">
				<tr>
					<th>Name</th>
					<th>Day</th>
					<th>Action</th>
				</tr>
				<?php 
				foreach ($markets as $market):
					$user=$users[$market->user_id];
				 ?>
					<tr class="market">
					<td><?php echo $user->fullname; ?></td>
					<td class="day"><?php echo $dayList[$market->day]; ?></td>
					<td>
						<button class="btn btn-default market-edit">Edit</button>
					</td>
				</tr>
				<?php
					unset($users[$market->user_id]);
					unset($dayList[$market->day]);
				 endforeach; ?>
			</table>
			<table class="table">
				<?php 
				foreach ($users as $user): 
				 ?>
					<tr class="market">
					<td><?php echo $user->fullname; ?></td>
					<td><select >
						<?php echo implode("",array_map(function($k,$v){ 
							return sprintf('<option value="%s">%s</option>',$k,$v);
							}, array_keys($dayList),$dayList)); ?> 
					</select></td>
					<td>
						<a data-user="<?php echo $user->id; ?>" href="<?php echo base_url('index.php/market/add'); ?>" class="btn btn-default market-update">Update</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
	  </div>
		</div>
	</div>
</div> 
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$(".market-update").click(function(e){
			e.preventDefault();
			var dataSnd={day:$(this).parents(".market").find("select").val(),user:$(this).data('user')}
			$.ajax({
				url: $(this).attr("href"),
				case: false,
				type: "POST",
				dataType: "json",
				data: dataSnd,
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
							window.location.reload();
						}else if(res.status==500)
						{

						}
					}
				}
			});
		});
	});
</script>
</body>
</html>
<?php 
global $current_user;
get_currentuserinfo();	
$username = $current_user->user_login;	
$login_email = $current_user->user_email;
?>

<div class="panel panel-default">
  <div class="panel-heading text-center">Login details</div>
  
  <table class="table table-bordered">
	  <tbody>
		<tr>
			<th width="40%">Username:</th>
			<td><?php echo $username; ?></td>
		</tr>
		<tr>
			<th>Login email:</th>
			<td><?php echo $login_email; ?></td>
		</tr>
	  </tbody>
  </table>

</div>	
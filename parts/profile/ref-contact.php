<?php 
global $current_user;
get_currentuserinfo();	
$primary_contact = $current_user->display_name;	
$contact_email = $current_user->user_email;
$username = $current_user->user_login;
$company = get_user_meta($current_user->ID, 'company_name', true);	
?>

<table class="table table-bordered text-center">
  <tbody>
	  <tr>
		  <th width="50%" class="text-center">Company</th>
		  <th width="50%" class="text-center">Contact name</th>
	  </tr>
	  <tr>
		  <td><strong><?php echo $company; ?></strong></td>
		  <td><strong><?php echo $primary_contact; ?></strong></td>
	  </tr>
	  <tr>
		  <th class="text-center">Account email</th>
		  <th class="text-center">Account username</th>
	  </tr>
	   <tr>
		  <td class="text-center"><strong><?php echo $contact_email; ?></strong></th>
		  <td class="text-center"><strong><?php echo $username; ?></strong></th>
	  </tr>
</tbody>
</table>
 <?php 
global $current_user;
get_currentuserinfo();
$user_id = $current_user->ID;
$username = $current_user->user_login;	
$login_email = $current_user->user_email;
$client_personal_raw = get_user_meta($user_id, 'client_personal', true);	
$client_personal = unserialize($client_personal_raw);
$client_contact_raw = get_user_meta($user_id, 'client_contact', true);	
$client_contact = unserialize($client_contact_raw);	
$client_address_raw = get_user_meta($user_id, 'client_address', true);	
$client_address = unserialize($client_address_raw);	 
?>
 <table class="table table-bordered text-center">
  <tbody>
	  <tr>
		  <th width="50%" class="text-center">Username</th>
		  <th width="50%" class="text-center">Primary Contact</th>
	  </tr>
	  <tr>
		  <td><?php echo $username; ?></td>
		  <td><?php echo $client_personal['title']; ?> <?php echo $client_personal['forename']; ?> <?php echo $client_personal['surname']; ?></td>
	  </tr>
	  <tr>
		  <th class="text-center">Account email</th>
		  <th class="text-center">Contact email</th>
	  </tr>
	   <tr>
		  <td><?php echo $login_email; ?></td>
		  <td><?php echo $client_contact['email']; ?></td>
	  </tr>
	  <tr>
		  <th class="text-center">Contact numbers</th>
		  <th class="text-center">Address</th>
	  </tr>
	   <tr>
		  <td>
			<?php echo (!empty($client_contact['tel'])) ? "Tel: ".$client_contact['tel']."<br>" : ""; ?> 
			<?php echo (!empty($client_contact['mobile'])) ? "Mobile: ".$client_contact['mobile'] : " - "; ?>
		  </td>
		  <td>
			<?php if (!empty($client_address)) { ?>
			<?php foreach ($client_address as $part) { ?>
			<?php echo ( empty($part) ) ? "" : $part."<br/>"; ?>									  
			<?php } ?>	 
			<?php } ?>
		  </td>
	  </tr>
  </tbody>
</table>
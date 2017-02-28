<?php 
global $current_user;
get_currentuserinfo();
$user_id = $current_user->ID;
$client_address_raw = get_user_meta($user_id, 'client_address', true);	
$client_address = unserialize($client_address_raw);	 
?>

<div class="panel panel-default">
  <div class="panel-heading text-center">Address details</div>
	<div class="panel-body address-txt">
	<?php if (!empty($client_address)) { ?>
		<?php foreach ($client_address as $part) { ?>
		<?php echo ( empty($part) ) ? "" : $part."<br/>"; ?>									  
		<?php } ?>	 
	<?php } ?>
	</div>
	
</div>	
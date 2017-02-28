<?php 
if(is_user_logged_in()) {
$user_id = get_current_user_id();	
$user_type = get_user_meta( $user_id, 'user_type', true); 
}
$freephone_num = "0800 169 5925";	
$office_num = "0191 293 1500";
?>
<div id="global-tel-num">
	<div class="container-fluid">
		<i class="fa fa-phone fa-3x"></i>
		<div class="number font-slab-serif">
			
			<?php if ($user_type == 'ref') { ?>
			Call <span class="caps bold">TLW</span> on <a href="tel:<?php echo str_replace(' ', '', $office_num); ?>" title="Call our office"><?php echo $office_num; ?></a>
			<?php } else { ?>
			Call us <span class="caps bold">free</span> on <a href="tel:<?php echo str_replace(' ', '', $freephone_num); ?>" title="Call us now"><?php echo $freephone_num; ?></a>
			<?php } ?>
			
		</div>
		<i class="fa fa-mobile-phone fa-4x"></i>
	</div>
	<div class="overlay"></div>
</div>
<?php
$dashboard_pg = get_page_by_path( 'dashboard' );
$your_claim_pg = get_page_by_path( 'your-claim' );	
$account_pg = get_page_by_path( 'account-details' );	
?>

<div class="intro">
<?php the_content(); ?>	
</div>
<div class="banner-links">	
	<div class="row">
		<div class="col-xs-6">
		<a href="<?php echo get_permalink($dashboard_pg->ID ); ?>" class="btn btn-block btn-lg">
			<i class="fa fa-dashboard"></i>
			<?php echo get_the_title($dashboard_pg->ID); ?>
		</a>
		</div>
		<div class="col-xs-6">
		<a href="<?php echo get_permalink($your_claim_pg->ID ); ?>" class="btn btn-block btn-lg">
			<i class="fa fa-folder-open"></i>
			<?php echo get_the_title($your_claim_pg->ID); ?>
		</a>
		</div>
		<div class="col-xs-6">
		<a href="<?php echo get_permalink($account_pg->ID ); ?>" class="btn btn-block btn-lg">
			<i class="fa fa-vcard"></i>
			<?php echo get_the_title($account_pg->ID); ?>
		</a>
		</div>
		<div class="col-xs-6">
		<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg">
			<i class="fa fa-power-off"></i>
				Log Out
		</a>
		</div>
	</div>
</div>	

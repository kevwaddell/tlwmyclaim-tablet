<?php
$dashboard_pg = get_page_by_path( 'dashboard' );
$cases_pg =  get_option('page_for_posts');	
$account_pg = get_page_by_path( 'account-details' );	
$banner_intro = get_field( 'hp_banner_ref_intro', 'options' );	
?>
<div class="intro">
<?php echo $banner_intro; ?>
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
		<a href="<?php echo get_permalink($cases_pg); ?>" class="btn btn-block btn-lg">
			<i class="fa fa-folder-open"></i>
			<?php echo get_the_title($cases_pg); ?> Archive
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
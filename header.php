<?php get_template_part( 'parts/header/head', 'html' ); ?>


<?php if ( is_user_logged_in() ) { 
$user_id = get_current_user_id();	
$user_firstname = get_user_meta( $user_id, 'first_name', true ); 
$user_lastname = get_user_meta( $user_id, 'last_name', true ); 	
$user_type = get_user_meta( $user_id, 'user_type', true); 
//echo '<pre class="debug">';print_r($user_type);echo '</pre>';
$account_pg = get_page_by_path( 'your-account' );
$contact_pg = get_page_by_path( 'contact-us');
?>
<div id="main-nav" class="pg-nav nav-closed">
	<div class="pag-nav-inner">
	<button id="close-nav-btn" class="btn btn-block"><span class="sr-only">Close navigation</span><i class="fa fa-chevron-right"></i></button>
	<?php if (current_user_can('administrator')) { ?>
	<?php wp_nav_menu(array( 'container_class' => 'admin-links', 'theme_location' => 'admin-menu', 'fallback_cb' => false ) ); ?>
	<?php } else { ?>
		<?php if ($user_type == 'ref') { ?>
		<?php wp_nav_menu(array( 'container_class' => 'ref-links', 'theme_location' => 'referer-menu', 'fallback_cb' => false ) ); ?>	
		<?php } else { ?>
		<?php wp_nav_menu(array( 'container_class' => 'user-links', 'theme_location' => 'user-menu', 'fallback_cb' => false ) ); ?>	
		<?php } ?>
	<?php } ?>
	</div>
</div>
<?php } ?>

<div id="page" class="site">
			
	<header id="masthead">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-3">
				<?php if (is_user_logged_in()) { ?>

				<div class="user-name">
					<a href="<?php echo get_permalink( $account_pg->ID ); ?>"><i class="fa fa-user-circle"></i> 
						<strong>
						<?php 
						$user_name = $user_firstname. " " .$user_lastname;
						if ($user_type == 'ref') { 
						$user_name = get_user_meta( $user_id, 'company_name', true ); 
						}	
						?>
						<?php echo $user_name; ?>
						</strong>
					</a>
				</div>
				
				<?php } ?>
				</div>
				<div class="col-xs-6">
					<div class="logo">
						<a href="<?php echo get_option('home'); ?>/" class="text-hide">
							<?php bloginfo('name'); ?>
						</a>
						<span><?php bloginfo('description'); ?></span>
					</div>	
				</div>
				<div class="col-xs-3">
					<?php if (is_user_logged_in()) { ?>
					<button id="nav-btn" class="btn btn-lg pull-right"><i class="fa fa-bars fa-lg"></i><span class="sr-only">Navigation menu</span></button>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php get_template_part( 'parts/global/col', 'strip' ); ?>
	</header>
	
	<main id="main" class="site-main" role="main">
		
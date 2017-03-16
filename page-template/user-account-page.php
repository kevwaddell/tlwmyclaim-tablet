<?php 
/*
Template Name: User Account Page
*/
?>
<?php if ( is_user_logged_in() ) { ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
		<?php
		$user_id = $current_user->ID;
		$user_type = get_user_meta( $user_id, 'user_type', true); 
		$contact_pg = get_page_by_path( 'contact-us');
		$dashboard_pg = get_page_by_path( 'dashboard' );
		$cases_pg =  get_option('page_for_posts');
		$claim_pg = get_page_by_path( 'your-claim');	
		?>
		
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="jumbotron wht-border-bottom">
			<div class="container-fluid">
			<?php the_content(); ?>	
			</div>
		</div>
		<article id="user-account-info" <?php post_class(); ?>>

			<section class="account-info-panels">
				<div class="container-fluid">
					<div class="row">
					<div class="col-md-10 col-md-offset-1">
					<?php echo do_shortcode( "[theme-my-login]" ) ?>	
					</div>	
					</div>
				</div>
			</section>
			
			<div class="rule"></div>
			
			<div class="container-fluid">
			<a href="<?php echo get_permalink($dashboard_pg->ID ); ?>" class="red-btn btn btn-block btn-lg">
					<i class="fa fa-dashboard"></i>
					<?php echo get_the_title($dashboard_pg->ID); ?>
				</a>
				<?php if ($user_type == 'ref') { ?>
				<a href="<?php echo get_permalink($cases_pg); ?>" class="red-btn btn btn-block btn-lg">
					<i class="fa fa-folder-open"></i>
					<?php echo get_the_title($cases_pg); ?> Archive
				</a>
				<?php } ?>
				<?php if ($user_type == 'client') { ?>
				<a href="<?php echo get_permalink($claim_pg->ID); ?>" class="red-btn btn btn-block btn-lg">
					<i class="fa fa-folder-open"></i>
					<?php echo get_the_title($claim_pg->ID); ?>
				</a>
				<?php } ?>
				<a href="<?php echo get_permalink( $contact_pg->ID ); ?>" class="red-btn btn btn-block btn-lg">
					<i class="fa fa-envelope fa-lg"></i>
					<?php echo get_the_title($contact_pg->ID); ?>
				</a>
				<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg">
					<i class="fa fa-power-off fa-lg"></i>
					Log Out
			</a>
			</div>
			
		</article><!-- #post-## -->

		<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>

<?php } else { ?>
<?php 
$index_id = get_option( 'page_on_front' );
$url = get_permalink( $index_id  );
wp_safe_redirect( $url );
exit;
?>
<?php }	?>
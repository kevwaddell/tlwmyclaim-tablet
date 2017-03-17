<?php get_header(); ?>
<?php $banner_img = get_field( 'hp_banner_img', 'options' ); ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
		
		<article <?php post_class('front-page'); ?>>
			
			<?php if (is_user_logged_in()) { 
			global $current_user;
			$user_id = $current_user->ID;
			$user_type = get_user_meta( $user_id, 'user_type', true);
			$account_pg = get_page_by_path( 'account-details' );	
			?>
			
			<div class="hp-banner jumbotron wht-border-bottom" style="background-image: url(<?php echo $banner_img; ?>)">
				<div class="container-fluid">
				
				<?php if ($user_type == 'client') { ?>
				<?php get_template_part( 'parts/banners/client', 'banner' ); ?>				
				<?php } ?>
				
				<?php if ($user_type == 'ref') { ?>
				<?php get_template_part( 'parts/banners/ref', 'banner' ); ?>	
				<?php } ?>
				
				<?php if ($user_type == 'admin') { 	?>
				<?php get_template_part( 'parts/banners/admin', 'banner' ); ?>	
				<?php } ?>
				
			</div>
			
			<?php } else {
			$login_pg = get_page_by_path( 'login' );
			$banner_intro = get_field( 'hp_banner_intro', 'options' );
			?>
			
			<div class="hp-banner jumbotron wht-border-bottom" style="background-image: url(<?php echo $banner_img; ?>)">
				<div class="container-fluid">
					<div class="intro">
					<?php echo $banner_intro; ?>
					</div>
					<div class="banner-links">
						<div class="row">
							<div class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3">
								<a href="<?php echo get_permalink( $login_pg->ID ); ?>" class="btn btn-block btn-lg"><i class="fa fa-sign-in"></i>Login now</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php }	?>
	
		</article><!-- #post-## -->
	
	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
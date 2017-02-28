<?php 
/*
Template Name: User Account Page
*/
?>
<?php if ( is_user_logged_in() ) { ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

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
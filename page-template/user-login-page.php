<?php 
/*
Template Name: User Login Forms
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="login-form" <?php post_class(); ?>>
				
				<div class="jumbotron wht-border-bottom">
					<div class="container-fluid">
					<?php the_content(); ?>	
					</div>
				</div>
				
				<section class="user-login-forms">
					<div class="container-fluid">
						<?php echo do_shortcode( "[theme-my-login]" ) ?>		
					</div>
				</section>
				
		</article><!-- #post-## -->

		<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
<?php get_header(); ?>

	<div class="container-fluid">
	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
							
			</article><!-- #post-## -->
		
		
		<?php endwhile; ?>

	<?php endif; ?>
	</div>

<?php get_footer(); ?>
<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
	<div class="jumbotron wht-border-bottom text-center">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<h1><?php the_title(); ?></h1>	
				</div>
			</div>
		</div>
	</div>
	<article <?php post_class(); ?>>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="entry">
						<?php the_content(); ?>	
					</div>
				</div>
			</div>
		</div>						
	</article><!-- #post-## -->
		
	<?php endwhile; ?>

<?php endif; ?>


<?php get_footer(); ?>
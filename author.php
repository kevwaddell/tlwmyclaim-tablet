<?php if ( is_user_logged_in() && current_user_can( 'administrator' ) ) { ?>

<?php get_header(); ?>

<article <?php post_class('author-page'); ?>>
	
<section class="account-info-panels">
	
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
			<?php if ( have_posts() ) : the_post(); ?>
			<?php 
			$client_personal_raw = get_user_meta($post->post_author, 'client_personal', true);
			$client_personal = unserialize($client_personal_raw);
			$client_contact_raw = get_user_meta($post->post_author, 'client_contact', true);
			$client_contact = unserialize($client_contact_raw);
			$client_address_raw = get_user_meta($post->post_author, 'client_address', true);	
			$client_address = unserialize($client_address_raw);
			//echo '<pre class="debug">';print_r($client_address);echo '</pre>';
			?>
				<div class="panel panel-default">
					
			 		<div class="panel-heading text-center">Client details</div>	
			
					<table class="table table-bordered text-center">
						<tbody>
							<tr>
								<th width="50%" class="text-center">Primary Contact:</th>
								<th width="50%" class="text-center">Contact email:</th>
							</tr>
							<tr>
								<td><?php echo $client_personal[title]; ?> <?php echo $client_personal[forename]; ?> <?php echo $client_personal[surname]; ?></td>
								<td><a href="mailto:<?php echo $client_contact['email']; ?>"><?php echo $client_contact['email']; ?></td></td>
							</tr>
							<tr>
								<th class="text-center">Contact numbers:</th>
								<th class="text-center">Address:</th>
							</tr>
							<tr>
								<td>
									Tel: <?php echo (!empty($client_contact[tel])) ? $client_contact[tel]:" - "; ?><br>
									Mobile: <?php echo (!empty($client_contact[mobile])) ? $client_contact[mobile]:" - "; ?>
								</td>
								<td class="address-txt">
								  <?php foreach ($client_address as $k => $part ) { ?>
								  <?php echo ( $k == 'postcode' ) ? $part : $part."<br/>"; ?>
								  <?php } ?>
								 </td>
						  	</tr>
						</tbody>
		
					</table>
						
				</div>	
		
			<?php endif; ?>
	
		<?php rewind_posts(); ?>
		<?php if ( have_posts() ) : ?>
	
				<div class="panel panel-default">
					
				<div class="panel-heading text-center">Current Cases</div>	
				
					<table class="table table-bordered text-center">
						<thead>
							<tr>
								<td colspan="6">Status: <span class="label label-success">Open</span> <span class="label label-warning">Closed</span></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th width="33%" class="text-center">Case reference</th>
								<th width="33%" class="text-center">Case Status</th>
								<th width="34%" class="text-center"><i class="fa fa-eye fa-lg"></i></th>
							</tr>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php 
							$case_status = get_post_meta( $post->ID, 'case_status', true );
							$case_ref = get_post_meta( $post->ID, 'case_ref', true);
							?>
							<tr class="<?php echo ($case_status == "open") ? 'success':'warning'; ?>">
							  	<td class="text-center"><?php echo $case_ref; ?></td>
							  	<td class="text-center caps"><span class="label label-<?php echo ($case_status == "open") ? 'success':'warning'; ?>"><?php echo $case_status; ?></span></td>
							  	<td><a href="<?php the_permalink($claim->ID); ?>" class="btn btn-default btn-block">View case details <i class="fa fa-angle-right pull-right"></i></a></td>
							</tr><!-- #post-## -->
					
						
						<?php endwhile; ?>
						</tbody>
					</table>
					
				</div>
		<?php endif; ?>
	
			</div><!-- End column -->
			
		</div>	<!-- End row -->
		
	</div> <!-- End container -->

	</section>
	
</article>
<?php get_footer(); ?>

<?php } else { ?>
<?php 
$index_id = get_option( 'page_on_front' );
$url = get_permalink( $index_id  );
wp_safe_redirect( $url );
exit;
?>
<?php }	?>
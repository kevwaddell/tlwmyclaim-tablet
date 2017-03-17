<?php if ( is_user_logged_in() && current_user_can( 'administrator' ) ) { ?>

<?php get_header(); ?>

<article <?php post_class('author-page'); ?>>
	
<section class="account-info-panels">
	
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
			<?php if ( have_posts() ) : the_post(); ?>
			<?php 
			$cases_pg =  get_option('page_for_posts');
			$clients_pg = get_page_by_path( 'clients' );
			$referrers_pg = get_page_by_path( 'referrers' );
	
			$client_personal_raw = get_user_meta($post->post_author, 'client_personal', true);
			$client_personal = unserialize($client_personal_raw);
			$client_contact_raw = get_user_meta($post->post_author, 'client_contact', true);
			$client_contact = unserialize($client_contact_raw);
			$client_address_raw = get_user_meta($post->post_author, 'client_address', true);	
			$client_address = unserialize($client_address_raw);
			//echo '<pre class="debug">';print_r($client_address);echo '</pre>';
			$user_data = get_userdata( $post->post_author );
			$login_email = $user_data->user_email;
			$username = $user_data->user_login;
			?>
				<div class="panel panel-default">
					
			 		<div class="panel-heading text-center">Client details</div>	
			
					<table class="table table-bordered text-center">
						<tbody>
						  <tr>
							  <th width="50%" class="text-center">Username:</th>
							  <th width="50%" class="text-center">Primary Contact:</th>
						  </tr>
						   <tr>
							  <td><?php echo $username; ?></td>
							  <td><?php echo $client_personal['title']; ?> <?php echo $client_personal['forename']; ?> <?php echo $client_personal['surname']; ?></td>
						  </tr>
						  <tr>
							  <th class="text-center">Account email</th>
							  <th class="text-center">Contact email</th>
						  </tr>
						  <tr>
							  <td><?php echo $login_email; ?></td>
							  <td><?php echo $client_contact['email']; ?></td>
						  </tr>
						   <tr>
							  <th class="text-center">Contact numbers</th>
							  <th class="text-center">Address</th>
						  </tr>
						  <tr>
							  <td>
								<?php echo (!empty($client_contact['tel'])) ? "Tel: ".$client_contact['tel']."<br>" : ""; ?> 
								<?php echo (!empty($client_contact['mobile'])) ? "Mobile: ".$client_contact['mobile'] : " - "; ?>
							  </td>
							  <td>
								<?php if (!empty($client_address)) { ?>
								<?php foreach ($client_address as $k => $part) { ?>
								<?php echo ( empty($part) || $k == 'postcode') ? $part."" : $part."<br>"; ?>									  
								<?php } ?>	 
								<?php } ?>
							  </td>
						  </tr>
						 </tbody>
					</table>
						
				</div>	
		
			<?php endif; ?>
	
		<?php rewind_posts(); ?>
		<?php if ( have_posts() ) : ?>
				<div class="rule"></div>
				<div class="panel panel-default">
					
				<div class="panel-heading text-center">Current Cases</div>	
				
					<table class="table table-bordered text-center">
						<thead>
							<tr>
								<td colspan="4">Status: <span class="label label-success">Open</span> <span class="label label-warning">Closed</span></td>
							</tr>
						</thead>
						<tbody>
							<tr>
							<th width="25%" class="text-center">Case reference</th>
							<th width="15%" class="text-center">Case Status</th>
							<th class="text-center">Case type</th>
							<th width="60" class="text-center"><i class="fa fa-folder-open"></i></th>
							</tr>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php 
							$case_status = get_post_meta( $post->ID, 'case_status', true );	
							$case_ref = get_post_meta( $post->ID, 'case_ref', true);
							$claim_details_raw = get_post_meta( $post->ID, 'claim_details', true );
							$claim_details = unserialize($claim_details_raw);
							$referer = get_post_meta( $post->ID, 'src_company', true);
							?>
							<tr class="<?php echo ($case_status == "open") ? 'success':'warning'; ?>">
							  	<td class="text-center"><?php echo $case_ref; ?></td>
							  	<td class="text-center"><span class="caps label label-<?php echo ($case_status == "open") ? 'success':'warning'; ?>"><?php echo $case_status; ?></td></td>
								<td class="text-center"><?php echo $claim_details['claim-type']; ?></td>
							  	<td><a href="<?php echo get_permalink($claim->ID); ?>" class="btn btn-<?php echo ($case_status == "open") ? 'success':'warning'; ?> btn-block"><span class="sr-only">View claim details</span> <i class="fa fa-chevron-right"><i></a></td>
							</tr><!-- #post-## -->
			
						
						<?php endwhile; ?>
						</tbody>
					</table>
					
				</div>
				<div class="rule"></div>
				<div class="btns-group">
					<a href="<?php echo get_permalink($cases_pg); ?>" class="red-btn btn btn-block btn-lg">
					<i class="fa fa-folder-open"></i>
					<?php echo get_the_title($cases_pg); ?> archive
					</a>
					<a href="<?php echo get_permalink($clients_pg->ID ); ?>" class="red-btn btn btn-block btn-lg">
					<i class="fa fa-users"></i>
					<?php echo get_the_title($clients_pg->ID); ?> archive
					</a>
					<a href="<?php echo get_permalink($referrers_pg->ID ); ?>" class="red-btn btn btn-block btn-lg">
						<i class="fa fa-building"></i>
						<?php echo get_the_title($referrers_pg->ID); ?> archive
					</a>
					<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg">
						<i class="fa fa-power-off fa-lg"></i>
						Log Out
					</a>
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
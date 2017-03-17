<?php 
$user_id = get_current_user_id();	
?>
<?php if ($post->post_author == $user_id || current_user_can( 'administrator' ) ) { ?>
<?php get_header(); ?>
<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
		<?php 
		$account_pg = get_page_by_path( 'account-details' );
		$contact_pg = get_page_by_path( 'contact-us');
		$dashboard_pg = get_page_by_path( 'dashboard' );
		$cases_pg =  get_option('page_for_posts');
		$clients_pg = get_page_by_path( 'clients' );
		$referrers_pg = get_page_by_path( 'referrers' );
		?>
		<?php
		$case_progress_raw = get_post_meta( $post->ID, 'case_progress', true );
		$case_progress = unserialize($case_progress_raw);
		$fee_earner_raw = get_post_meta( $post->ID, 'fee_earner', true );
		$fee_earner = unserialize($fee_earner_raw);
		$claim_details_raw = get_post_meta( $post->ID, 'claim_details', true );
		$claim_details = unserialize($claim_details_raw);
		//echo '<pre class="debug">';print_r($claim_details);echo '</pre>';
		$case_ref = get_post_meta( $post->ID, 'case_ref', true);
		
		$client_personal_raw = get_user_meta($post->post_author, 'client_personal', true);
		$client_personal = unserialize($client_personal_raw);
		$client_contact_raw = get_user_meta($post->post_author, 'client_contact', true);
		$client_contact = unserialize($client_contact_raw);
		$case_status = get_post_meta( $post->ID, 'case_status', true);
		?>
		<div class="jumbotron wht-border-bottom">
			<div class="container-fluid text-center">
				<h1>Claim details for<br><?php echo $client_personal[title]; ?> <?php echo $client_personal[forename]; ?> <?php echo $client_personal[surname]; ?></h1>
				<p><strong>Claim Ref: <?php echo $case_ref; ?></strong></p>
			</div>
		</div>
		<article id="user-account-info" <?php post_class(); ?>>
			<section class="claims-list">
				
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
						
						<?php if ( current_user_can( 'administrator' ) ) { ?>
						<div class="status-label caps status-<?php echo $case_status; ?> block text-center">
							Case status: <strong><?php echo $case_status; ?></strong>
							<i class="fa fa-folder-<?php echo ($case_status == 'open') ? 'open':''; ?> fa-lg"></i>
						</div>
						<?php } ?>
												
						<div class="alert alert-warning text-center case-progress">
					 		<?php 
						 	//$case_progress = array_reverse($case_progress); 
						 	$date = date('l jS F, Y', strtotime( str_replace('/','-',$case_progress[0]['date']) ) );
						 	$status = $case_progress[0]['status'];
						 	?>
						 	<div class="icon bg-lines">
							 	<i class="fa fa-hourglass-half"></i>
							 	<div class="icon-label">Recent Progress</div>
						 	</div>
						 	
							<div class="status-date"><?php echo $date; ?></div>
							<div class="case-status"><i class="fa fa-check-circle txt-col-orange-dk fa-lg"></i> <?php echo $status; ?></div>
							
						</div>

						<?php if ( current_user_can( 'administrator' ) ) { ?>

						<div class="panel panel-default">
				
					 		<div class="panel-heading text-center">Contact details</div>	
					
							<table class="table table-bordered text-center">
								<tbody>
									<tr>
										<th class="text-center">Name:</th>
										<th class="text-center">Email:</th>
								  	</tr>
								  		<tr>
									  		<td><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php echo $client_personal[title]; ?> <?php echo $client_personal[forename]; ?> <?php echo $client_personal[surname]; ?></a></td>
									  		<td><a href="mailto:<?php echo $client_contact['email']; ?>"><?php echo $client_contact['email']; ?></a></td>
								  		</tr>
								  	<tr>
										<th class="text-center">Tel:</th>
										<th class="text-center">Mobile:</th>
								  	</tr>	
								  	<tr>
										<td><?php echo (!empty($client_contact[tel])) ? $client_contact[tel]:" - "; ?></td>
										<td><?php echo (!empty($client_contact[mobile])) ? $client_contact[mobile]:" - "; ?></td>
								  	</tr>	
								</tbody>
							</table>
								
						</div>	
						<?php } ?>
							
						<div class="panel panel-default">
				
					 		<div class="panel-heading text-center">Claim details</div>	
					
							<table class="table table-bordered text-center">
								<tbody>
									<tr>
										<th width="50%" class="text-center">Claim Reference:</th>
										<th width="50%" class="text-center">Date created:</th>
								  	</tr>
								  	<tr>
										<td><?php echo $case_ref; ?></td>
										<td><?php echo $case_progress[0]['date']; ?></td>
							  		</tr>	
									<tr>
										<th class="text-center">Claim type</th>
										<th class="text-center">Date of accident</th>
								  	</tr>
								  	<tr>
										<td><?php echo $claim_details['claim-type']; ?></td>
										<td><?php echo $claim_details['accident-date']; ?></td>
								  	</tr>
								  	<tr>
									  	<th class="text-center">Case handler</th>
										<th class="text-center">Case handler Email</th>
								  	</tr>
								  	<tr>
										<td><?php echo $fee_earner['name']; ?></td>
										<td><a href="mailto:<?php echo $fee_earner['email']; ?>"><?php echo $fee_earner['email']; ?></a></td>
								  	</tr>	
								</tbody>
							</table>
								
						</div>	
							
						<?php if ( current_user_can( 'administrator' ) ) { ?>
						<a href="<?php echo get_author_posts_url($post->post_author); ?>" class="red-btn btn btn-block btn-lg">
							Client profile
							<i class="fa fa-vcard fa-lg"></i>
						</a>

						<?php } ?>
						
						<?php if (count($case_progress) > 0) { ?>
						<div class="panel panel-default">
						
							<div class="panel-heading text-center">Case history</div>	
			
							<table class="table table-bordered text-center">
								<thead>
									<tr>
										<td colspan="3">Status: <span class="label label-success">Complete</span> <span class="label label-warning">In progress</span></td>
									</tr>
								</thead>
								<tbody>
								  	<tr>
									  	<th width="40" class="text-center"><i class="fa fa-info-circle"></i></th>
									  	<th width="44.5%" class="text-center">Date</th>
									  	<th class="text-center">Status</th>
								  	</tr>
								  	<?php 
									//array_shift($case_progress);	
									foreach ($case_progress as $k => $status) {
									$date = date('l jS F, Y', strtotime( str_replace('/','-',$status['date']) ) ) ;
								  	?>
								  	<tr class="<?php echo ($k == 0) ? 'warning' : 'success'; ?>">
									  	<td class="text-center"><i class="fa <?php echo ($k == 0) ? 'fa-hourglass-half text-warning' : 'fa-check-circle text-success'; ?>"></i></td>
									  	<td class="text-center"><?php echo $date; ?></td>
									  	<td class="text-center"><?php echo $status['status']; ?></td>	
								  	</tr>	
								  	<?php } ?>
								  	
								</tbody>
							</table>
						
						</div>
						<?php } ?>
							
						<?php if ( !current_user_can( 'administrator' ) ) { ?>
						<button id="contact-handler-btn" class="orange-btn btn btn-block btn-lg"><i class="fa fa-comments fa-lg"></i>Message case handler</button>
						<?php } ?>
						<div class="rule"></div>
						
						<?php if ( !current_user_can( 'administrator' ) ) { ?>
						<a href="<?php echo get_permalink( $dashboard_pg->ID ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-dashboard fa-lg"></i><?php echo get_the_title($dashboard_pg->ID); ?></a>
						<a href="<?php echo get_permalink( $account_pg->ID ); ?>" class="red-btn btn btn-block btn-lg">Account details<i class="fa fa-vcard"></i></a>
						<a href="<?php echo get_permalink( $contact_pg->ID ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-envelope fa-lg"></i><?php echo get_the_title($contact_pg->ID); ?></a>
						<?php } ?>
						<?php if ( current_user_can( 'administrator' ) ) { ?>
						<a href="<?php echo get_author_posts_url($post->post_author); ?>" class="red-btn btn btn-block btn-lg">
							Client profile<i class="fa fa-vcard"></i>
						</a>
						<a href="<?php echo get_permalink($cases_pg); ?>" class="red-btn btn btn-block btn-lg">
							<?php echo get_the_title($cases_pg); ?> archive <i class="fa fa-folder-open"></i>
						</a>
						<a href="<?php echo get_permalink($clients_pg->ID ); ?>" class="red-btn btn btn-block btn-lg">
							<?php echo get_the_title($clients_pg->ID); ?> archive <i class="fa fa-users"></i>
						</a>
						<a href="<?php echo get_permalink($referrers_pg->ID ); ?>" class="red-btn btn btn-block btn-lg">
							<?php echo get_the_title($referrers_pg->ID); ?> archive <i class="fa fa-building"></i>
						</a>
						<?php } ?>
						<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-power-off fa-lg"></i>Log Out</a>
											
					</div><!-- end of col -->
					</div><!-- end of row -->
				</div><!-- end of container -->
				
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
<?php 
/*
Template Name: Referrers List page
*/
?>

<?php if ( is_user_logged_in() && current_user_can( 'administrator' )  ) { ?>

<?php get_header(); ?>

<?php $users_args = array(
	'role'         => 'subscriber',
	'meta_key'     => 'user_type',
	'meta_value'   => 'ref',
	'orderby'      => 'display_name'
 ); 
$users = get_users( $users_args ); 
//$users = false;
//echo '<pre class="debug">';print_r($users);echo '</pre>';

$cases_pg =  get_option('page_for_posts');
$clients_pg = get_page_by_path( 'clients' );
$home_pg = get_option('page_on_front');	
?>


<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
					
		<div class="jumbotron wht-border-bottom">
			<div class="container-fluid">
			<?php the_content(); ?>	
			</div>
		</div>
		
		<article <?php post_class(); ?>>
			<div class="container-fluid">	
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<?php if (!empty($users)) { ?>
						<section id="users-list">
								
								<div class="panel panel-default">	
					
								<div class="panel-heading text-center">Referrers</div>	
					
									<table class="table table-bordered text-center">
									<thead>
										<tr>
											<td colspan="3">Case status: <span class="label label-success">Open</span> <span class="label label-warning">Closed</span></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th width="35%" class="text-center">Company</th>
											<th width="35%" class="text-center">Main contact</th>
											<th width="25%" class="text-center">Number of cases</th>
									  	</tr>
									  	
									  	<?php foreach ($users as $user) { 
										$company = get_user_meta($user->ID, 'company_name', true);
										$user_data = get_userdata($user->ID);
										//echo '<pre>';print_r($user_data);echo '</pre>';
										
										$claims_args = array(
										'posts_per_page' => -1,
										'post_type'		=> 'post',
										'post_status'	=>	'private',
										'meta_key'	=> 'src_ref',
										'meta_value'	=> $user_data->user_nicename
										);
										$claims = get_posts( $claims_args );
										$open = 0;
										$closed = 0;
										//echo '<pre class="debug">';print_r($claims);echo '</pre>';
									  	?>
									  	<tr>
											<td class="text-center" style="vertical-align: middle;"><?php echo $company; ?></td>
											<td class="text-center" style="vertical-align: middle;"><?php echo $user_data->display_name; ?></td>
											<td class="text-center" style="vertical-align: middle;">
											  <?php foreach ($claims as $claim) { 
											   $case_status = get_post_meta( $claim->ID, 'case_status', true);
											   		if ($case_status == 'open') {
												   	$open++;	
											   		}
											   		
											   		if ($case_status == 'closed') {
												   	$closed++;	
											   		}
											   }
											  ?>
											 <span class="label label-success"><?php echo $open; ?></span> 
											 <span class="label label-warning"><?php echo $closed; ?></span>
												</div>
											</td>
									  	</tr>
									  	<?php } ?>
									  	
									</tbody>
								</table>
								
							</div>
							
						</section>
						<?php } else { ?>
			
						<div class="well well-lg well-message text-center">
							<h2>Sorry</h2>
							<p>There are no referrers at the moment.</p>
						</div>
				
						<?php } ?>
						
						<div class="rule"></div>
						<div class="btns-group">
							<a href="<?php echo get_permalink($home_pg); ?>" class="red-btn btn btn-block btn-lg">
							Home <i class="fa fa-home"></i>
							</a>
							<a href="<?php echo get_permalink($cases_pg); ?>" class="red-btn btn btn-block btn-lg">
							<?php echo get_the_title($cases_pg); ?> archive <i class="fa fa-folder-open"></i>
							</a>
							<a href="<?php echo get_permalink($clients_pg->ID ); ?>" class="red-btn btn btn-block btn-lg">
							<?php echo get_the_title($clients_pg->ID); ?> archive <i class="fa fa-users"></i>
							</a>
							<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg">
								Log Out <i class="fa fa-power-off fa-lg"></i>
							</a>
						</div>

					</div>
				</div>
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
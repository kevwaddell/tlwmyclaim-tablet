<?php
global $user_id;
$current_user = wp_get_current_user();
$user_data = get_userdata($user_id);
$contact_pg = get_page_by_path( 'contact-us');	
$account_pg = get_page_by_path( 'account-details' );
$cases_pg =  get_option('page_for_posts');
//echo '<pre class="debug">';print_r($user_data);echo '</pre>';	

$claims_args = array(
'posts_per_page' => -1,
'post_type'		=> 'post',
'post_status'	=>	'private',
'meta_key'	=> 'src_ref',
'meta_value'	=> $current_user->user_login
);
$claims = get_posts( $claims_args );

$open = 0;
$closed = 0;

	foreach ($claims as $claim) {
	
	$case_status = get_post_meta( $claim->ID, 'case_status', true);
	//echo '<pre class="debug">';print_r($case_status);echo '</pre>';
	
		if ($case_status == 'open') {
			$open++;
		}
									   		
		if ($case_status == 'closed') {
			$closed++;	
		}
	}	
	
//echo '<pre class="debug">';print_r($open_cases);echo '</pre>';
//echo '<pre class="debug">';print_r($closed_cases);echo '</pre>';
?>

<div class="row">
	<div class="col-xs-6">
		<div class="alert alert-success text-center dashboard-alert">
			<div class="alert-heading text-center">Open Cases <i class="fa fa-folder-open"></i></div>
			<div class="alert-number text-center"><?php echo $open; ?></div>
		</div>
	</div>
	
	<div class="col-xs-6">
		<div class="alert alert-danger text-center dashboard-alert">
			<div class="alert-heading text-center">Closed Cases <i class="fa fa-folder"></i></div>
			<div class="alert-number"><?php echo $closed; ?></div>
		</div>
	</div>
</div>
<div class="rule"></div>
<a href="<?php echo get_permalink( $cases_pg ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-folder-open fa-lg"></i><?php echo get_the_title( $cases_pg ); ?> archive</a>
<a href="<?php echo get_permalink( $account_pg->ID ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-vcard fa-lg"></i><?php echo get_the_title( $account_pg->ID ); ?></a>
<a href="<?php echo get_permalink( $contact_pg->ID ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-vcard fa-lg"></i><?php echo get_the_title( $contact_pg->ID ); ?></a>
<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-power-off fa-lg"></i>Log Out</a>
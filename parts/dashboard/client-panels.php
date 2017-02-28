<?php 
global $current_user;
$user_id = $current_user->ID;
$username = $current_user->user_login;	
$login_email = $current_user->user_email;
$client_personal_raw = get_user_meta($user_id, 'client_personal', true);	
$client_personal = unserialize($client_personal_raw);
$client_contact_raw = get_user_meta($user_id, 'client_contact', true);	
$client_contact = unserialize($client_contact_raw);	
$account_pg = get_page_by_path( 'your-account' );
$contact_pg = get_page_by_path( 'contact-us');
$claim_pg = get_page_by_path( 'your-claim');
?>
<?php 
	$current_claims_args = array(
		'posts_per_page' => 1,
		'post_type'		=> 'post',
		'post_status'	=>	'private',
		'meta_key'	=> 'case_status',
		'meta_value'	=> 'open',
		'author'	=> $user_id,
		'orderby'	=> 'date'
	);
	$current_claims = get_posts( $current_claims_args );
	?>
<?php if (!empty($current_claims)) { ?>
<?php
$case_progress_raw = get_post_meta( $current_claims[0]->ID, 'case_progress', true );
$case_progress = unserialize($case_progress_raw);
$fee_earner_raw = get_post_meta( $current_claims[0]->ID, 'fee_earner', true );
$fee_earner = unserialize($fee_earner_raw);
$case_ref = get_post_meta( $current_claims[0]->ID, 'case_ref', true);
$case_status = get_post_meta( $current_claims[0]->ID, 'case_status', true);
$claim_details_raw = get_post_meta( $current_claims[0]->ID, 'claim_details', true );
$claim_details = unserialize($claim_details_raw);
?>

<div class="alert alert-info text-center case-progress">
		<?php 
 	$case_progress = array_reverse($case_progress); 
 	$date = date('l jS F, Y', strtotime( str_replace('/','-',$case_progress[0]['date']) ) );
 	$status = $case_progress[0]['status'];
 	?>
 	<div class="icon">
	 	<i class="fa fa-hourglass-half fa-3x"></i>
	 	<div class="icon-label">Progress report</div>
 	</div>
 	
	<div class="status-date"><?php echo $date; ?></div>
	<div class="case-details"><span>Case type: <?php echo $claim_details['claim-type']; ?></span>|<span>Case Ref: <?php echo $case_ref; ?></span></div>
	<div class="case-status"><?php echo $status; ?></div>
	<a href="<?php echo get_permalink( $claim_pg->ID ); ?>" class="red-btn btn btn-default btn-block btn-lg"><i class="fa fa-folder-open fa-lg"></i>View case details</a>
</div>
<?php } ?>

<?php
$claims_args = array(
	'posts_per_page' => -1,
	'post_type'		=> 'post',
	'post_status'	=>	'private',
	'author'	=> $user_id,
	'orderby'	=> 'date'
);
$claims = get_posts( $claims_args );
?>

<?php if (!empty($claims)) { ?>
<div class="panel panel-default">
	<div class="panel-heading text-center">Your claims</div>	
	<table class="table table-bordered">
	<tbody>
		<tr>
		<th width="30%" class="text-center">Case reference</th>
		<th width="20%" class="text-center">Case Status</th>
		<th width="45%" class="text-center">Case Type</th>
		<th width="5%" class="text-center"><i class="fa fa-cogs"></i></th>
		</tr>
		<?php foreach ($claims as $claim) { 
		$case_status = get_post_meta( $claim->ID, 'case_status', true );
		$case_ref = get_post_meta( $claim->ID, 'case_ref', true);
		$claim_details_raw = get_post_meta( $claim->ID, 'claim_details', true );
		$claim_details = unserialize($claim_details_raw);
		?> 
		<tr class="<?php echo ($case_status == 'open') ? 'success':'danger'; ?>">
			<td class="text-center"><?php echo $case_ref; ?></td>
			<td class="text-center"><?php echo strtoupper($case_status); ?></td>
		  	<td class="text-center"><?php echo $claim_details['claim-type']; ?></td>
		  	<td><a href="<?php echo get_permalink($claim->ID); ?>" class="btn btn-<?php echo ($case_status == 'open') ? 'success':'danger'; ?> btn-block"><span class="sr-only">View progress</span> <i class="fa fa-chevron-right"><i></a></td>
	  	</tr>	
		<?php } ?>
	</tbody>
</table>

</div>
<?php } ?>

<a href="<?php echo get_permalink( $account_pg->ID ); ?>" class="red-btn btn btn-default btn-block btn-lg"><i class="fa fa-vcard fa-lg"></i>View Your Account details</a>
<a href="<?php echo get_permalink( $contact_pg->ID ); ?>" class="red-btn btn btn-default btn-block btn-lg"><i class="fa fa-envelope fa-lg"></i><?php echo get_the_title($contact_pg->ID); ?></a>
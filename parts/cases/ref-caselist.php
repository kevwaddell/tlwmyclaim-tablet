<tbody>
	<tr>
		<th width="30%" class="text-center">Client name:</th>
		<th class="text-center">Progress status:</th>
		<th width="30%" class="text-center">Case handler:</th>
  	</tr>
  	<?php while ( have_posts() ) : the_post(); ?>
  	<?php
	$case_progress_raw = get_post_meta( $post->ID, 'case_progress', true );
	$case_progress = unserialize($case_progress_raw);
	$client_personal_raw = get_user_meta($post->post_author, 'client_personal', true);
	$client_personal = unserialize($client_personal_raw); 
	$fee_earner_raw = get_post_meta($post->ID, 'fee_earner', true);	
	$fee_earner = unserialize($fee_earner_raw);
	$case_status = get_post_meta( $post->ID, 'case_status', true);
	//echo '<pre class="debug">';print_r($case_status);echo '</pre>';
  	?>
  	<tr class="<?php echo ($case_status == "open") ? 'success':'warning'; ?>">
	  	<td><?php echo $client_personal[title]; ?> <?php echo $client_personal[forename]; ?> <?php echo $client_personal[surname]; ?></td>
	  	<td><?php echo $case_progress[count($case_progress) - 1][date]; ?>: <?php echo $case_progress[count($case_progress) - 1][status]; ?></td>
	  	<td><?php echo $fee_earner[name]; ?></td>
  	</tr>
  	<?php endwhile; ?>
</tbody>
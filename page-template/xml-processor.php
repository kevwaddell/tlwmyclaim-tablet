<?php 
/*
Template Name: XML Processor
*/
?>

<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$xml_files = glob($path."/tlw-XMLProcessor/*.xml");
//echo '<pre class="debug">';print_r($xml_files);echo '</pre>';
if ( empty($xml_files) ) {
echo "There are no files to process\n";	
} else {
	if (count($xml_files) == 1) {
	echo "There is ". count($xml_files) ." file to be processed<br>\n";	
	} else {
	echo "There are ". count($xml_files) ." files to be processed<br>\n";	
	}
echo "*---------------------------------------*<br>\n";
echo "<br>********------START OF PROCESSING-------*******<br>\n";
	foreach ($xml_files as $k => $file) {
	$file_num = $k +1;
	echo "<br>––––––– FILE $file_num PROCESSING ––––––––<br>\n";
	$xmlFile = file_get_contents($file);
	$xmlBody = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $xmlFile);
	$caseDetailsXML = simplexml_load_string($xmlBody);
	$caseDetails = json_decode(json_encode((array)$caseDetailsXML), TRUE);
	
	//Check if user email exsists
	$first_name =  $caseDetails['forename'];
	$last_name = $caseDetails['surname'];
	$tlw_ref = $caseDetails['solicitor-reference'];
	$user_email = $caseDetails['email'];
	$user_id = email_exists( $user_email );
	
	//Fee Earsner Details
	$fee_earner = array();
	$fee_earner['name'] = $caseDetails['fee-earner'];
	$fee_earner['email'] = $caseDetails['fee-earner-email'];
	
	//Case progress
	$case_update = $caseDetails['case-status'];	 
	
	// Client Personal Details
	$client_personal = array();
	$client_personal['title'] = $caseDetails['title'];
	$client_personal['forename'] = $first_name;
	$client_personal['surname'] = $last_name;
	$client_personal['date-of-birth'] = $caseDetails['date-of-birth'];
	$client_personal['national-insurance-number'] = $caseDetails['national-insurance-number'];
	
	// Client Address
	$client_address = array();
	$client_address['address1'] = (is_array($caseDetails['address1'])) ? "" : $caseDetails['address1'];
	$client_address['address2'] = (is_array($caseDetails['address2'])) ? "" : $caseDetails['address2'];
	$client_address['address3'] = (is_array($caseDetails['address3'])) ? "" : $caseDetails['address3'];
	$client_address['postcode'] = $caseDetails['postcode'];
	
	//Client contact details
	$client_contact = array();
	$client_contact['email'] = $caseDetails['email'];
	$client_contact['tel'] = $caseDetails['telephone'];
	$client_contact['mobile'] = $caseDetails['mobile'];		
	
	//Claim details		
	$claim_details = array();	
	$claim_details['claim-type'] = $caseDetails['Claim-type'];
	if ($caseDetails['accident-date']) {
	$claim_details['accident-date'] = $caseDetails['accident-date'];	
	}
	
	echo "<br>*---------------------------------------*<br>\n";
		if ($user_id) {
		echo "User exists!<br>\n";
		echo "User ID: ".$user_id."<br>\n";	
		$client_personal_raw = get_user_meta($user_id, 'client_personal', true);	
		$client_address_raw = get_user_meta($user_id, 'client_address', true);	
		$client_contact_raw = get_user_meta($user_id, 'client_contact', true);
		
		$src_ref = get_user_meta($user_id, 'src_ref', true);
		$case_ref = $caseDetails['solicitor-reference'];
		$new_case = true;
		
			//Check if personal details have changed
			if (serialize($client_personal) != $client_personal_raw) {
			update_user_meta( $user_id, 'client_personal', serialize($client_personal), $client_personal_raw );
			echo "*---------------------------------------*<br>\n";
			echo "Client Personal details updated\n";	
			}
			
			//Check if address has changed
			if (serialize($client_address) != $client_address_raw) {
			update_user_meta( $user_id, 'client_address', serialize($client_address), $client_address_raw );
			echo "*---------------------------------------*<br>\n";
			echo "Client Address details updated\n";	
			}
			
			//Check if contact details have changed
			if (serialize($client_contact) != $client_contact_raw) {
			update_user_meta( $user_id, 'client_contact', serialize($client_contact), $client_contact_raw );
			echo "*---------------------------------------*<br>\n";
			echo "Client Contact details updated\n";	
			}
			
			$claims_args = array(
			'posts_per_page' => -1,
			'post_type'		=> 'post',
			'post_status'	=> 'private',
			'author'	=> $user_id,
			'meta_key'	=> 'case_status',
			'meta_value' => 'open'
			);
			$claims = get_posts( $claims_args );
			
			echo "*---------------------------------------*<br>\n";
			echo "CHECKING FOR CLAIM… ".$case_ref."<br>\n";
			//echo '<pre class="debug">';print_r($claims);echo '</pre>';
			
			foreach ($claims as $claim) {
			
				if ( $claim->post_name == sanitize_title($case_ref) ) {
					$new_case = false;		
					echo "*---------------------------------------*<br>\n";
					echo "Case exists<br>\n";
					$case_progress_raw = get_post_meta( $claim->ID, 'case_progress', true );
					$case_progress = unserialize($case_progress_raw);
					$case_progress[] = array('date'=> date('d/m/Y'), 'status' => $case_update );
					
					update_post_meta( $claim->ID, 'case_progress', serialize($case_progress), $case_progress_raw );	
					echo "*---------------------------------------*<br>\n";
					echo "Updated claim progress<br>\n";
					//echo '<pre class="debug">';print_r($case_progress);echo '</pre>';
					
					$fee_earner_raw = get_post_meta( $claim->ID, 'fee_earner', true );
					
					if (serialize($fee_earner) != $fee_earner_raw) {
					update_post_meta( $claim->ID, 'fee_earner', serialize($fee_earner),$fee_earner_raw );
					echo "*---------------------------------------*<br>\n";
					echo "Updated Fee Earner<br>\n";	
					//echo '<pre class="debug">';print_r(unserialize($fee_earner_raw));echo '</pre>';
					//echo '<pre class="debug">';print_r($fee_earner);echo '</pre>';
					}
					
					$claim_details_raw = get_post_meta( $claim->ID, 'claim_details', true );
					
					if (serialize($claim_details) != $claim_details_raw) {
					update_post_meta( $claim->ID, 'claim_details', serialize($claim_details), $claim_details_raw );
					echo "*---------------------------------------*<br>\n";
					echo "Updated claim details<br>\n";	
					//echo '<pre class="debug">';print_r(unserialize($fee_earner_raw));echo '</pre>';
					//echo '<pre class="debug">';print_r($fee_earner);echo '</pre>';
					}
				
				}
			}
			
			if ($new_case) {
			echo "*---------------------------------------*<br>\n";
			echo "Case does not exist<br>\n";
			echo "*---------------------------------------*<br>\n";
			echo "Creating new case…<br>\n";
				
			$new_case_args['post_author']= $user_id;
		 	$new_case_args['post_type']= 'post';
		 	$new_case_args['post_status']= 'private';
		 	$new_case_args['post_name']	= sanitize_title($case_ref);
		 	$new_case_args['post_title'] = wp_strip_all_tags($case_ref);
		 	
		 	//echo '<pre class="debug">';print_r($new_case_args);echo '</pre>';
		 	
		 	$new_case_id = wp_insert_post($new_case_args);
		 	//$new_case_id = true;
			 	
			 	if ($new_case_id) {
				 	$case_progress = array();
				 	$case_progress[] = array('date'=> date('d/m/Y'), 'status' => $case_update );
				 	echo "*---------------------------------------*<br>\n";
					echo "- New case created<br>\n";
					add_post_meta( $new_case_id, 'case_ref', $case_ref, true );
					echo "- Case reference added<br>\n";	
					add_post_meta( $new_case_id, 'case_status', "open", true );
					echo "- Case status added<br>\n";
					add_post_meta( $new_case_id, 'case_progress', serialize($case_progress), true );
					echo "- Case progress added<br>\n";	
					add_post_meta( $new_case_id, 'fee_earner', serialize($fee_earner), true );
					echo "- Fee Earner data added<br>\n";	
					add_post_meta( $new_case_id, 'claim_details', serialize($claim_details), true );
					echo "- Claim details data added<br>\n";	
				
					if ( !empty($caseDetails['source-company']) ) {
						$src_company = $caseDetails['source-company'];
						$src_ref =  sanitize_title($caseDetails['source-company']);
						
						if (!empty($caseDetails['source-reference'])) {
						$src_ref = sanitize_title($caseDetails['source-reference']);
						}
						
						add_post_meta( $new_case_id, 'src_company', $src_company, true );
						add_post_meta( $new_case_id, 'src_ref', $src_ref, true );	
						
						$ref_id = username_exists( $src_ref );
						
						if ($ref_id) {
						add_post_meta( $new_case_id, 'src_ref_id', $ref_id, true );		
						}
						
						//echo '<pre class="debug">';print_r($src_ref);echo '</pre>';
						
						echo "- Source company and reference added<br>\n";	
					}
	
			 	} // If case was created
			 	
			} //If new case needs to be created
	
		
		} else {
			
			echo "User does not exists!<br>\n";
			// User data for user account creation
			$random_password = wp_generate_password( 12, true, true );
			$user_case_ref = strtolower($caseDetails['solicitor-reference']);
			$user_name = strtolower(substr($first_name, 0, 1)).strtolower($last_name)."_".$user_case_ref;
			echo "*---------------------------------------*<br>\n";
			echo "CREATING NEW USER…<br>\n";
			
			$userdata = array(
			 'user_login'  =>  $user_name,
			 'user_pass'	=> $random_password,
			 'user_email'	=> $user_email,
			 'first_name'	=> $first_name,
			 'last_name'	=> $last_name,
			 'nickname'		=> $first_name,
			 'display_name'	=> $first_name. " " .$last_name
			);	
			
			//echo '<pre class="debug">';print_r($userdata);echo '</pre>';
			 
			$user_id = wp_insert_user( $userdata );
			
			//$user_id = true;
			
			if ( ! is_wp_error( $user_id ) ) {

			echo "*---------------------------------------*<br>\n";
			echo "New user created<br>\n";
			add_user_meta( $user_id, "client_personal", serialize($client_personal), true );
			echo "*---------------------------------------*<br>\n";
			echo "Client personal details added<br>\n";
			add_user_meta( $user_id, "client_address", serialize($client_address), true );
			echo "Client address details added<br>\n";
			add_user_meta( $user_id, "client_contact", serialize($client_contact), true );
			echo "Client contact details added<br>\n";
			echo "*---------------------------------------*<br>\n";
			add_user_meta( $user_id, "_user_type", "field_581c5aad45023", true );
			add_user_meta( $user_id, "user_type", "client", true );
			echo "Client user type added<br>\n";
			wp_send_new_user_notifications( $user_id );
			echo "*---------------------------------------*<br>\n";
			echo "User email notification sent<br>\n";
			
		 	if ( !empty($caseDetails['solicitor-reference']) ) {
	
			 	$case_args['post_author']= $user_id;
			 	$case_args['post_type']= 'post';
			 	$case_args['post_status']= 'private';
			 	$case_args['post_name']	= sanitize_title($caseDetails['solicitor-reference']);
			 	$case_args['post_title'] = wp_strip_all_tags($caseDetails['solicitor-reference']);

			 	//echo '<pre class="debug">';print_r($case_args);echo '</pre>';
			 	
			 	$case_id = wp_insert_post($case_args);
			 	
			 	//$case_id = true;
			 	
			 	if ($case_id) {
				 	echo "*---------------------------------------*<br>\n";
				 	echo "Creating new case…<br>\n";
				 	echo "*---------------------------------------*<br>\n";
					echo "New case created<br>\n";
					add_post_meta( $case_id, 'case_ref', $caseDetails['solicitor-reference'], true );
					echo "Case reference added<br>\n";	
					add_post_meta( $case_id, 'case_status', "open", true );
					echo "Case status added<br>\n";	
					$case_progress = array();
					$case_progress[] = array('date'=> date('d/m/Y'), 'status' => $case_update );
					add_post_meta( $case_id, 'case_progress', serialize($case_progress), true );
					echo "Case progress added<br>\n";	
					add_post_meta( $case_id, 'fee_earner', serialize($fee_earner), true );
					echo "Fee Earner data added<br>\n";	
					add_post_meta( $case_id, 'claim_details', serialize($claim_details), true );
					echo "Claim details data added<br>\n";
				
					if ( !empty($caseDetails['source-company']) ) {
						
						$src_company = $caseDetails['source-company'];
						$src_ref = sanitize_title($caseDetails['source-company']);
						if (!empty($caseDetails['source-reference'])) {
						$src_ref = sanitize_title($caseDetails['source-reference']);
						}
						
						add_post_meta( $case_id, 'src_company', $src_company, true );
						add_post_meta( $case_id, 'src_ref', $src_ref, true );	
						
						$ref_id = username_exists( $src_ref );
						
						if ($ref_id) {
						add_post_meta( $case_id, 'src_ref_id', $ref_id, true );		
						}
						
						echo "Source company added<br>\n";	
					}
	
			 	} // If case was created
			 		
		 	} // If has case reference
	
			} else {
			echo "*---------------------------------------*<br>\n";	
			echo "There was an error creating the new user<br>\n";
			} // Check if new user created
			
		}// check if user exists
	
	//echo '<pre class="debug">';print_r($caseDetails);echo '</pre>';
		echo "*---------------------------------------*<br>\n";
		echo "<br>––––––– FILE $file_num PROCCESSED ––––––––<br>\n";
		
		unlink($file);
		$xml_file = explode($_SERVER['DOCUMENT_ROOT']."/tlw-XMLProcessor/", $file);
		//pre($file[1]);
		echo "<br>*---------------------------------------*<br>\n";
		echo "XML file <strong>". $xml_file[1]. "</strong> has been removed!<br>\n";

	} // Check each file and process
	
	echo "<br>********------END OF PROCESSING-------*******<br>\n";
}
?>
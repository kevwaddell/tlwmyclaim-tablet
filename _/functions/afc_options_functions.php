<?php 
/*
*  AFC Options Page
*/

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

if( function_exists('acf_add_options_sub_page') ) {

	acf_add_options_sub_page('Global');
	acf_add_options_sub_page('Homepage');
	acf_add_options_sub_page('Site footer');
	
}

 ?>
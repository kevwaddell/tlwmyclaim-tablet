<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head id="myclaim-tlwsolicitors-co-uk" data-template-set="tlw-solicitors-myclaim-theme">
	
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<meta name="viewport" content="user-scalable=no,initial-scale=1,minimum-scale=1,maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=yes">
		   
	<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/_/img/touch-icon-iphone.png" /> 
	<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/_/img/touch-icon-ipad.png" /> 
	<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/_/img/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/_/img/touch-icon-ipad-retina.png" />
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_directory'); ?>/_/img/apple-start-up-img.png" />

	
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/_/img/favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_head(); ?>

</head>
<?php
if (is_page()) {
$page = get_page($post->ID);
$page_class = $page->post_name.'-pg';		
}
if (is_single()) {
$page_class = 'case-details-pg';	
}
if (is_home()) {
$page_class = 'cases-pg';	
}	
if (is_author()) {
$page_class = 'clients-pg';	
}		
?>
<body <?php body_class($page_class); ?>>
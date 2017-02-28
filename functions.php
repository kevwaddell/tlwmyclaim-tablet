<?php
if ( ! function_exists( 'tlwmyclaim_setup' ) ) :

	function tlwmyclaim_setup() {
	
		add_theme_support( 'title-tag' );
	
		add_theme_support( 'post-thumbnails' );
	
		register_nav_menus( array(
			'user-menu' => __( 'User Menu',      'tlwmyclaim' ),
			'footer-menu'  => __( 'Footer Menu', 'tlwmyclaim' ),
			'admin-menu'  => __( 'Admin Menu', 'tlwmyclaim' ),
			'referer-menu'  => __( 'Referer Menu', 'tlwmyclaim' )
		) );
		
	if ( function_exists( 'register_sidebar' ) ) {
		
		$login_sb_args = array(
		'name'          => "User actions",
		'id'            => "user-actions",
		'description'   => 'Actions for logged in Users',
		'class'         => 'user-links',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '' 
		);
		register_sidebar( $login_sb_args );
	}

}
endif; // tlwmyclaim_setup
add_action( 'after_setup_theme', 'tlwmyclaim_setup' );	
	
function tlwmyclaim_scripts() {
	// Load stylesheets.
	wp_enqueue_style( 'bootstrap-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', array(), '3.3.6', 'screen' );
	wp_enqueue_style( 'tlwmyclaim-style', get_stylesheet_directory_uri().'/_/css/styles.css', array('bootstrap-style'), filemtime( get_stylesheet_directory().'/_/css/styles.css' ), 'screen' );
	
	// Load JS
	wp_enqueue_script( 'jQuery');
	wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
	wp_enqueue_script( 'tlwmyclaim-script', get_template_directory_uri() . '/_/js/min/functions-min.js', array( 'jquery', 'bootstrap-js' ), filemtime( get_stylesheet_directory().'/_/js/functions.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'tlwmyclaim_scripts' );

/* AFC OPTIONS FUNCTIONS */
include (STYLESHEETPATH . '/_/functions/afc_options_functions.php');

function tlw_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Cases';
    $submenu['edit.php'][5][0] = 'Cases';
    $submenu['edit.php'][10][0] = 'Add Case';
    $submenu['edit.php'][16][0] = 'Case Tags';
}
function tlw_change_post_object() {
    global $wp_post_types;
    //echo '<pre class="debug">';print_r($wp_post_types);echo '</pre>';
    $wp_post_types['post']->menu_icon = "dashicons-category";
    
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Cases';
    $labels->singular_name = 'Cases';
    $labels->add_new = 'Add Case';
    $labels->add_new_item = 'Add Case';
    $labels->edit_item = 'Edit Case';
    $labels->new_item = 'Case';
    $labels->view_item = 'View Case';
    $labels->search_items = 'Search Cases';
    $labels->not_found = 'No Cases found';
    $labels->not_found_in_trash = 'No Cases found in Trash';
    $labels->all_items = 'All Cases';
    $labels->menu_name = 'Cases';
    $labels->name_admin_bar = 'Cases';
    
}
 
add_action( 'admin_menu', 'tlw_change_post_label' );
add_action( 'init', 'tlw_change_post_object' );

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    pre.debug {
      position: fixed;
      right: 30px;
      top: 30px;
      z-index: 2000;
      height: 80%;
      width: 400px;
      overflow: scroll;
      padding: 20px;
      background: #000;
      color: lime;
    } 
  </style>';
}

function wpse120418_unregister_taxonomies() {
    register_taxonomy( 'category', array() );
    register_taxonomy( 'post_tag', array() );
    unregister_widget( 'WP_Widget_Categories' );
}
add_action( 'init', 'wpse120418_unregister_taxonomies' );

function user_name_shortcode() {
	global $current_user;
	get_currentuserinfo();
	
	$username = $current_user->user_login;

   return $username;
}

function register_shortcodes(){
   add_shortcode('user_name', 'user_name_shortcode');
}

add_action( 'init', 'register_shortcodes');

remove_action('init', 'wp_admin_bar_init');

function hide_admin_bar_from_front_end(){
  return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );
?>
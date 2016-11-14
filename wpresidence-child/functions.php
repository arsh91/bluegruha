<?php
if (!session_id()) {
    session_start();
}
require_once 'libs/pin_management.php';
require_once 'libs/ajax_functions.php';
require_once 'libs/3rdparty.php';

$use_mimify     =   get_option('wp_estate_use_mimify','');
$mimify_prefix  =   '';
if($use_mimify==='yes'){
	$mimify_prefix  =   '.min';    
}


add_action('wp_enqueue_scripts', 'mapfunctionsChanges');
function mapfunctionsChanges(){
	wp_deregister_script('mapfunctions');
	wp_register_script('mapfunctions', get_stylesheet_directory_uri().'/js/google_js/mapfunctions'.$mimify_prefix .'.js');

	wp_deregister_script('googlecode_regular');
	wp_register_script('googlecode_regular', get_stylesheet_directory_uri().'/js/google_js/google_map_code'.$mimify_prefix .'.js');

	wp_deregister_script('ajaxcalls');
	wp_register_script('ajaxcalls', get_stylesheet_directory_uri().'/js/ajaxcalls'.$mimify_prefix .'.js');

	wp_deregister_script('bootstrap-select');
	wp_register_script('bootstrap-select',  get_stylesheet_directory_uri() .'/js/bootstrap-select.min'.$mimify_prefix.'.js'); 

	wp_deregister_script('bootstrap-multiselect');
	wp_register_script('bootstrap-multiselect',  get_stylesheet_directory_uri() .'/js/bootstrap-multiselect'.$mimify_prefix.'.js'); 

	wp_deregister_script('custom-js');
	wp_register_script('custom-js',  get_stylesheet_directory_uri() .'/js/custom'.$mimify_prefix.'.js');
	
	wp_deregister_script('google_map_submit');
	wp_register_script('google_map_submit', get_stylesheet_directory_uri().'/js/google_js/google_map_submit'.$mimify_prefix .'.js');
	
	/*css include*/
	wp_deregister_style('bootstrap-css');
	wp_register_style('bootstrap-css',  get_stylesheet_directory_uri() .'/css/bootstrap.min'.$mimify_prefix.'.css');
	wp_deregister_style('bootstrap-multiselect-css');
	wp_register_style('bootstrap-multiselect-css',  get_stylesheet_directory_uri() .'/css/bootstrap-multiselect'.$mimify_prefix.'.css');
	wp_deregister_style('bootstrap-select-css');
	wp_register_style('bootstrap-select-css',  get_stylesheet_directory_uri() .'/css/bootstrap-select.min'.$mimify_prefix.'.css');
		wp_deregister_style('custom-style-css');
	wp_register_style('custom-style-css',  get_stylesheet_directory_uri() .'/css/style'.$mimify_prefix.'.css');

}

add_filter( 'wp_image_editors', 'change_graphic_lib');

function change_graphic_lib($array) {
	return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick');
}

function get_universities(){
	global $wpdb;
	$result = $wpdb->get_results("SELECT name as value, domain as domain, id FROM wp_universities");
	return $result;
}

?>
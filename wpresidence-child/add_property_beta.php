<?php
// Template Name: Add Property Beta
// Wp Estate Pack

get_header();
$options=wpestate_page_details($post->ID);

wp_enqueue_style( 'bootstrap-css',  get_template_directory_uri() . '/css/bootstrap.min.css' );  
wp_enqueue_style( 'bootstrap-multiselect-css',  get_template_directory_uri() . '/css/bootstrap-multiselect.css' );  
wp_enqueue_style( 'bootstrap-select-css',  get_template_directory_uri() . '/css/bootstrap-select.min.css' );  
wp_enqueue_style( 'custom-style-css',  get_template_directory_uri() . '/css/style.css' );  


///////////////////////////////////////////////////////////////////////////////////////////
/////// Html Form Code below
///////////////////////////////////////////////////////////////////////////////////////////
?> 

<div id="cover"></div>
<div class="row">
    <?php get_template_part('templates/breadcrumbs'); ?>

    <div class="col-md-3">
       <?php  get_template_part('templates/user_menu');  ?>
    </div>  
	<div class="col-md-9">
		<?php get_template_part('templates/ajax_container'); ?>

		<?php  get_template_part('templates/property_form');  ?> 

    </div>
     
<?php
	 wp_enqueue_script('bootstrap-select',  get_template_directory_uri() .'/js/bootstrap-select.min.js',array('jquery'), '1.0', true); 
	 wp_enqueue_script('bootstrap-multiselect',  get_template_directory_uri() .'/js/bootstrap-multiselect.js',array('jquery'), '1.0', true); 
	 wp_enqueue_script('custom-js',  get_template_directory_uri() .'/js/custom.js',array('jquery'), '1.0', true); 
?>
<?php get_footer();?>

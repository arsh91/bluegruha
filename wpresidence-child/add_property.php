<?php
// Template Name: Add Property
// Wp Estate Pack

get_header();
$options=wpestate_page_details($post->ID);

wp_enqueue_style( 'bootstrap-css',  get_template_directory_uri() . '/css/bootstrap.min.css' );  
wp_enqueue_style( 'bootstrap-multiselect-css',  get_template_directory_uri() . '/css/bootstrap-multiselect.css' );  
wp_enqueue_style( 'bootstrap-select-css',  get_template_directory_uri() . '/css/bootstrap-select.min.css' );  
wp_enqueue_style( 'custom-style-css',  get_template_directory_uri() . '/css/style.css' );  

if( isset( $_GET['listing_edit'] ) && is_numeric( $_GET['listing_edit'] ) ){
    ///////////////////////////////////////////////////////////////////////////////////////////
    /////// If we have edit load current values
    ///////////////////////////////////////////////////////////////////////////////////////////
    $edit_id                        =  intval ($_GET['listing_edit']);
	
	$the_post= get_post( $edit_id); 

    if( $current_user->ID != $the_post->post_author ) {
        exit('You don\'t have the rights to edit this');
    }

}

if( 'POST' == $_SERVER['REQUEST_METHOD'] && ($_POST['term_id']==47 || $_POST['term_id']==48)) {
	$errors = saveProperty();
	
	if($errors){
		foreach($errors as $key=>$value){
			$show_err.=$value.'</br>';
		}
	}
}elseif( 'POST' == $_SERVER['REQUEST_METHOD'] && $_POST['term_id']==49) {
	savePropertyToRent();
}

///////////////////////////////////////////////////////////////////////////////////////////
/////// Html Form Code below
///////////////////////////////////////////////////////////////////////////////////////////
?> 

<div id="cover"></div>
<div class="row">
    <?php //get_template_part('templates/breadcrumbs'); ?>

    <?php
	if(!wp_is_mobile() && is_user_logged_in()){ ?>
		<div class="col-md-3">
		   <?php get_template_part('templates/user_menu'); ?>
		</div>
	<?php } ?>
	<div class="col-md-9">
		<?php get_template_part('templates/ajax_container'); ?>

		<?php  get_template_part('templates/property_form');  ?> 

    </div>
     
<?php
	 wp_enqueue_script('bootstrap-select',  get_template_directory_uri() .'/js/bootstrap-select.min.js',array('jquery'), '1.0', true); 
	 wp_enqueue_script('bootstrap-multiselect',  get_template_directory_uri() .'/js/bootstrap-multiselect.js',array('jquery'), '1.0', true); 
	 wp_enqueue_script('custom-js',  get_template_directory_uri() .'/js/custom.js',array('jquery'), '1.0', true); 
?>
</div>
<?php get_footer();?>

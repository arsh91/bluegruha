<?php
if (!session_id()) {
    session_start();
}
require_once 'libs/pin_management.php';
require_once 'libs/ajax_functions.php';
require_once 'libs/ajax_upload.php';
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
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////file upload ajax - profile and user dashboard
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if( is_page_template('user_dashboard_profile.php') || is_page_template('user_dashboard_add.php')   ){
		$max_file_size  = 100 * 1000 * 1000;
        $is_profile=0;
        if ( is_page_template('user_dashboard_profile.php') ){
            $is_profile=1;    
        }
        
        $plup_url = add_query_arg( array(
            'action' => 'me_upload',
            'base'  =>$is_profile,
            'nonce' => wp_create_nonce('aaiu_allow'),
        ), admin_url('admin-ajax.php') );
        $max_images = intval   ( get_option('wp_estate_prop_image_number','') );
		wp_deregister_script('ajax-upload');
        wp_register_script('ajax-upload', get_stylesheet_directory_uri().'/js/ajax-upload'.$mimify_prefix.'.js',array('jquery','plupload-handlers'), '1.0', true);
    }
	
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

function checkEmailWithDomain($email, $uni_id){
	global $wpdb;
	if($email && $uni_id){
		$result = $wpdb->get_results("SELECT domain FROM wp_universities WHERE id = $uni_id");
		if(!empty($result)){
			$emailArr = explode('@', $email);
			if($result[0]->domain != $emailArr[1]){
				return false;
			}
		}
	}
	return true;
}

function submit_uni_property(){
	$errors = array();
	if ( !isset($_POST['new_estate']) || !wp_verify_nonce($_POST['new_estate'],'submit_new_estate') ){
	   exit('Sorry, your not submiting from site'); 
	}
	if(!isset($_POST['property_university']) || empty($_POST['property_university'])){
		$errors['property_university'] = 1;
	}
	
	if(!isset($_POST['property_address']) || empty($_POST['property_address'])){
		$errors['property_address'] = 1;
	}
	if(!isset($_POST['agent_email']) || empty($_POST['agent_email'])){
		$errors['agent_email'] = 1;
	}else{
		if(!in_array($_POST['agent_email'], $_SESSION['varified_emails'])){
			if(isset($_SESSION['contact_otp'])){
				if ( isset($_POST['otp'])) {
					if($_SESSION['contact_otp'] != $_POST['otp']){
						$errors['otp'] = 1;
					}else{
						unset($_SESSION['contact_otp']);
						$_SESSION['varified_emails'][] = $_POST['agent_email'];
					}
				}else{
					$errors['otp'] = 2;
				}
			}
		}
	}
	if(empty($errors)){
		global $wpdb;
        $post_id                        =   '';
		$apartment_name 				=	wp_kses( $_POST['apartment_name'],$allowed_html);
        $university                      =   wp_kses( $_POST['property_university'],$allowed_html);
		if($apartment_name != ''){
			$post_title                   =   $university.', '. $apartment_name;
		}else{
			$post_title                   =   $university ;
		}
		$checkVerfiedAd					=	false;
		$universityId					=	sanitize_text_field($_POST['hdproperty_university']);
		if(!isset($_POST['hdproperty_university']) || empty($_POST['hdproperty_university'])){
			$wpdb->insert('wp_universities', 
				array(
					'name'          => $property_university
				)
			); 
			$universityId = $wpdb->insert_id;
		}else{
			$checkVerfiedAd = checkEmailWithDomain(sanitize_text_field($_POST['agent_email']), $universityId);
		}
        $userId = email_exists(wp_filter_nohtml_kses( $_POST['agent_email']));
		if(!$userId){
			$user_name 					=  $user_email = wp_filter_nohtml_kses( $_POST['agent_email']);
			$user_password 				= wp_generate_password( $length=12, $include_standard_special_chars=false );
			$userId         			= wp_create_user( $user_name, $user_password, $user_email );
			wp_update_user(
				array(
					'ID'          =>    $userId,
					'nickname'    =>    $user_email,
					'display_name'=>	 wp_filter_nohtml_kses( $_POST['agent_name']),
					'description'=>		wp_filter_nohtml_kses( $_POST['agent_phone'])
				)
			);
			wp_send_new_user_notifications($userId);
		}
		$post_author					= $userId;
		$post_content 	            	=   wp_filter_nohtml_kses( $_POST['description']);
        $property_address               =   wp_kses( $_POST['property_address'],$allowed_html);
        $property_county                =   wp_kses( $_POST['property_county'],$allowed_html);
    //    $property_state                 =   wp_kses( $_POST['property_state'],$allowed_html);
        $property_zip                   =   wp_kses( $_POST['property_zip'],$allowed_html);
        $country_selected               =   wp_kses( $_POST['property_country'],$allowed_html);     
        $prop_stat                      =   wp_kses( $_POST['property_status'],$allowed_html);
        $property_status                =   '';
		$paid_submission_status = esc_html ( get_option('wp_estate_paid_submission','') );
		$new_status             = 'pending';
		$admin_submission_status= esc_html ( get_option('wp_estate_admin_submission','') );
		if($admin_submission_status=='no' && $paid_submission_status!='per listing'){
		   $new_status='publish';  
		}
		$post = array(
			'post_title'	=> $post_title,
			'post_content'	=> $post_content,
			'post_status'	=> $new_status, 
			'post_type'     => 'estate_property' ,
			'post_author'   => $post_author
		);
		$post_id =  wp_insert_post($post );  
		if( $paid_submission_status == 'membership'){ // update pack status
			wpestate_update_listing_no($current_user->ID);                
			//if($prop_featured==1){
			 //   wpestate_update_featured_listing_no($current_user->ID); 
			//}
		}
		if($post_id) {
			// uploaded images
			if ($_POST['attachid']==''){
				$order=0;
				$attchs=explode(',',$_POST['attachid']);
				$last_id='';
				foreach($attchs as $att_id){
					if( !is_numeric($att_id) ){

					}else{
						if($last_id==''){
							$last_id=  $att_id;  
						}
						$order++;
						wp_update_post( array(
									'ID' => $att_id,
									'post_parent' => $post_id,
									'menu_order'=>$order
								));
					}
				}
				if( is_numeric($_POST['attachthumb']) && $_POST['attachthumb']!=''  ){
					set_post_thumbnail( $post_id, wp_kses(esc_html($_POST['attachthumb']),$allowed_html )); 
				}else{
					set_post_thumbnail( $post_id, $last_id );
				}
			}
            //end uploaded images
            if( !isset($_POST['roomie_gender']) ) {
				$prop_category=0;           
			}else{
				$prop_category  =   intval($_POST['roomie_gender']);
			}
			$prop_category                  =   get_term( $prop_category, 'property_category');
			if(isset($prop_category->term_id)){
				$prop_category_selected         =   $prop_category->term_id;
			}
            if( isset($prop_category->name) ){
                wp_set_object_terms($post_id,$prop_category->name,'property_category'); 
            }
			if( !isset($_POST['term_id']) ) {
				$prop_action_category=0;           
			}else{
				$prop_action_category  =   intval($_POST['term_id']);
			}
			$prop_action_category           =   get_term( $prop_action_category, 'property_action_category');  
			if(isset($prop_action_category->term_id)){
				 $prop_action_category_selected  =   $prop_action_category->term_id;
			}
            if ( isset ($prop_action_category->name) ){
                wp_set_object_terms($post_id,$prop_action_category->name,'property_action_category'); 
            }
            if( isset($property_city) && $property_city!='none' ){
                if($property_city == -1 ){
                    $property_city='';
                }
                wp_set_object_terms($post_id,$property_city,'property_city'); 
            }  
            if( isset($property_area) && $property_area!='none' ){
                wp_set_object_terms($post_id,$property_area,'property_area'); 
            }  
            if( isset($property_county_state) && $property_county_state!='none' ){
                if($property_county_state == -1){
                    $property_county_state='';
                }
                wp_set_object_terms($post_id,$property_county_state,'property_county_state'); 
            }
            if($property_area!=''){
                $terms= get_term_by('name', $property_area, 'property_area');
                //print_R($terms);
                if($terms!=''){
                    $t_id=$terms->term_id;
                    $term_meta=array('cityparent'=>$property_city);
                    add_option( "taxonomy_$t_id", $term_meta ); 
                }
            }
			$university_id                 	=   wp_kses( esc_html($universityId),$allowed_html);
			$property_price                 =   wp_kses( esc_html($_POST['rent']),$allowed_html);
			$property_label                 =   wp_kses( esc_html($_POST['title']),$allowed_html);
			$bathroom_type                 	=   wp_kses( esc_html($_POST['bath_type']),$allowed_html);
			$bedroom_type                 	=   wp_kses( esc_html($_POST['bedroom_type']),$allowed_html);
			$security_amount                =   wp_kses( esc_html($_POST['security_amount']),$allowed_html);
			$available_from                	=   wp_kses( esc_html($_POST['available_from']),$allowed_html);
			$amenities                		=   wp_kses( esc_html($_POST['amenities']),$allowed_html);
			$language                		=   wp_kses( esc_html($_POST['language']),$allowed_html);
			$property_latitude              =   floatval( $_POST['property_latitude']); 
			$property_longitude             =   floatval( $_POST['property_longitude']); 
			$google_view                    =   wp_kses( esc_html( $_POST['property_google_view']),$allowed_html); 
			$option_video                   =   '';
			$video_values                   =   array('vimeo', 'youtube');
			$video_type                     =   wp_kses( esc_html($_POST['embed_video_type']),$allowed_html); 
			$google_camera_angle            =   wp_kses( esc_html($_POST['google_camera_angle']),$allowed_html); 
			$has_errors                     =   false;
			$errors                         =   array();
            update_post_meta($post_id, 'sidebar_agent_option', 'global');
            update_post_meta($post_id, 'local_pgpr_slider_type', 'global');
            update_post_meta($post_id, 'local_pgpr_content_type', 'global');
            update_post_meta($post_id, 'prop_featured', 0);
            update_post_meta($post_id, 'property_address', $property_address);
            update_post_meta($post_id, 'property_county', $property_county);
            update_post_meta($post_id, 'property_zip', $property_zip);
            update_post_meta($post_id, 'property_state', $property_state);
            update_post_meta($post_id, 'property_country', $country_selected);
            update_post_meta($post_id, 'property_status', $prop_stat);
            update_post_meta($post_id, 'university_id', $university_id);
            update_post_meta($post_id, 'property_university', $university);
            update_post_meta($post_id, 'property_price', $property_price);
            update_post_meta($post_id, 'property_latitude', $property_latitude);
            update_post_meta($post_id, 'property_longitude', $property_longitude);
            update_post_meta($post_id, 'property_google_view',  $google_view);
            update_post_meta($post_id, 'google_camera_angle', $google_camera_angle);
            update_post_meta($post_id, 'pay_status', 'not paid');
            update_post_meta($post_id, 'page_custom_zoom', 16);
			if($checkVerfiedAd){
				update_post_meta($post_id, 'verifiedAd', 1);
			}
		   /* //$sidebar =  get_option( 'wp_estate_blog_sidebar', true); 
            $sidebar = get_option('wp_estate_property_sidebar_name',true);
            update_post_meta($post_id, 'sidebar_option', $sidebar);
            // $sidebar_name   = get_option( 'wp_estate_blog_sidebar_name', true); 
            $sidebar_name          =   get_option('wp_estate_property_sidebar_name',true);
            update_post_meta($post_id, 'sidebar_select', $sidebar_name);
             */
            if('yes' ==  esc_html ( get_option('wp_estate_user_agent','') )){
                $user_id_agent            =   get_the_author_meta( 'user_agent_id' , $current_user->ID  );
                update_post_meta($post_id, 'property_agent', $user_id_agent);
            }
            // get user dashboard link
            $redirect = get_dashboard_link();
            $arguments=array(
                'new_listing_url'   => get_permalink($post_id),
                'new_listing_title' => $submit_title
            );
            wpestate_select_email_type(get_option('admin_email'),'new_listing_submission',$arguments);
            wp_reset_query();
            wp_redirect( $redirect);
            exit;
        }
	}
}

?>
<?php
// Index Page
// Wp Estate Pack
get_header('single');
global $current_user;
global $feature_list_array;
global $propid ;
global $show_compare_only;
$show_compare_only  =   'no';
$current_user       =   wp_get_current_user();
wp_estate_count_page_stats($post->ID);

$propid                     =   $post->ID;
$options                    =   wpestate_page_details($post->ID);
$gmap_lat                   =   esc_html( get_post_meta($post->ID, 'property_latitude', true));
$gmap_long                  =   esc_html( get_post_meta($post->ID, 'property_longitude', true));
$unit                       =   esc_html( get_option('wp_estate_measure_sys', '') );
$currency                   =   esc_html( get_option('wp_estate_currency_symbol', '') );
$use_floor_plans            =   intval( get_post_meta($post->ID, 'use_floor_plans', true) );      


if (function_exists('icl_translate') ){
    $where_currency             =   icl_translate('wpestate','wp_estate_where_currency_symbol', esc_html( get_option('wp_estate_where_currency_symbol', '') ) );
    $property_description_text  =   icl_translate('wpestate','wp_estate_property_description_text', esc_html( get_option('wp_estate_property_description_text') ) );
    $property_details_text      =   icl_translate('wpestate','wp_estate_property_details_text', esc_html( get_option('wp_estate_property_details_text') ) );
    $property_features_text     =   icl_translate('wpestate','wp_estate_property_features_text', esc_html( get_option('wp_estate_property_features_text') ) );
    $property_adr_text          =   icl_translate('wpestate','wp_estate_property_adr_text', esc_html( get_option('wp_estate_property_adr_text') ) );    
}else{
    $where_currency             =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
    $property_description_text  =   esc_html( get_option('wp_estate_property_description_text') );
    $property_details_text      =   esc_html( get_option('wp_estate_property_details_text') );
    $property_features_text     =   esc_html( get_option('wp_estate_property_features_text') );
    $property_adr_text          =   stripslashes ( esc_html( get_option('wp_estate_property_adr_text') ) );
}


$agent_id                   =   '';
$content                    =   '';
$userID                     =   $current_user->ID;
$user_option                =   'favorites'.$userID;
$curent_fav                 =   get_option($user_option);
$favorite_class             =   'isnotfavorite'; 
$favorite_text              =   __('add to favorites','wpestate');
$feature_list               =   esc_html( get_option('wp_estate_feature_list') );
$feature_list_array         =   explode( ',',$feature_list);
$pinteres                   =   array();
$property_city              =   get_the_term_list($post->ID, 'property_city', '', ', ', '') ;
$property_area              =   get_the_term_list($post->ID, 'property_area', '', ', ', '');
$property_category          =   get_the_term_list($post->ID, 'property_category', '', ', ', '') ;
$property_action            =   get_the_term_list($post->ID, 'property_action_category', '', ', ', '');   
$slider_size                =   'small';
$thumb_prop_face            =   wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'property_full');
$roomie_gender				=	esc_html( get_post_meta($post->ID, 'roomie_gender', true));
if($curent_fav){
    if ( in_array ($post->ID,$curent_fav) ){
        $favorite_class =   'isfavorite';     
        $favorite_text  =   __('favorite','wpestate');
    } 
}

if (has_post_thumbnail()){
    $pinterest = wp_get_attachment_image_src(get_post_thumbnail_id(),'property_full_map');
}


if($options['content_class']=='col-md-12'){
    $slider_size='full';
}
?>


<?php
// custom template loading

$wp_estate_global_page_template               = intval  ( get_option('wp_estate_global_property_page_template') );
$wp_estate_local_page_template                = intval  ( get_post_meta($post->ID, 'property_page_desing_local', true));
if($wp_estate_global_page_template!=0 || $wp_estate_local_page_template!=0 ){
    global $wp_estate_global_page_template;
    global $wp_estate_local_page_template;
    global $options;
    get_template_part('templates/property_desing_loader');
}

$propertyDetail = get_post($propid);
$catDetail = get_the_terms($propid, 'property_action_category');
$genderCatDetail = get_the_terms($propid, 'property_category');

?>

<div class="row">
	<a href="<?php echo home_url('','login');?>" class="headerBtn submitProperty" href="javascript:void(0)">Back</a>
	
</div>
<div class="modal-header">	
	<h3 class="modal-title"><i class="fa fa-building" aria-hidden="true"></i> <?php echo get_post_meta($propid, 'property_label', true); ?></h3>
</div>
<div class="row mobileDetailPage" id="detailPage">
	<div class="col-md-8">
		<div class="innerContainer propertDetailContainer">	
			<h3>				
				<?php echo get_post_meta($propid, 'apartment_name', true);
					$universityName = get_post_meta($propid, 'property_university', true);
					if($universityName != ''){ ?> - 
						<span>
							<?php 
								echo  $universityName;
							?>
						</span>
					<?php } ?>
			</h3>
			<div class="propertySpecs">
				<div class="specsProperty">
					<?php 
						if($catDetail[0]->term_id == 47 || $catDetail[0]->term_id == 48){ ?>
							<span class="col-xs-4"><i class="fa fa-bed" aria-hidden="true"></i><?php echo get_post_meta($propid, 'bedroom_type', true); ?> Bedroom</span>
							<span class="col-xs-4"><i class="fa fa-bath" aria-hidden="true"></i><?php echo get_post_meta($propid, 'bathroom_type', true); ?> Bathroom</span>
							<span class="col-xs-4">
								<?php
									if($roomie_gender == 'Male'){
										$tag='fa-male';
									}else if($roomie_gender == 'Female'){
										$tag='fa-female';
									}else{
										$tag = 'fa-globe';
									}
								?>
								<i class="fa <?php echo $tag; ?>" aria-hidden="true"></i> 
								<?php echo $roomie_gender; ?> Roomie
							</span>
					<?php }else{ ?>
							<span class="col-xs-4"><i class="fa fa-bed" aria-hidden="true"></i><?php echo get_post_meta($propid, 'property_bedrooms', true); ?> Bedroom(s)</span>
							<span class="col-xs-4"><i class="fa fa-bath" aria-hidden="true"></i><?php echo get_post_meta($propid, 'property_bathrooms', true); ?> Bathroom(s)</span>
							<span class="col-xs-4"><i class="fa fa-area-chart" aria-hidden="true"></i><?php echo get_post_meta($propid, 'property_size', true); ?> Sq Ft</span>
					<?php } ?>
				</div>
			</div>
			
			<div class="propertyPrice priceModal">
				<div class="amount">$<?php echo get_post_meta($propid, 'property_price', true); ?><div class='permonth'>per month</div></div>
				<span>From: <strong><?php echo date ('j M Y', strtotime(get_post_meta($propid, 'available_from', true))); ?></strong></span>
			</div>
			
			<div class="locationAddress"><i class="fa fa-map-marker" aria-hidden="true"></i>
			<?php echo get_post_meta($propid, 'property_address', true); ?>, <?php echo get_post_meta($propid, 'property_zip', true); ?>
			</div>
			<div class="shareWidget">
				<span>Share at :</span>
				
				<a href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink($propid); ?>&amp;t=<?php echo urlencode(get_the_title($propid)); ?>" target="_blank" class="share_facebook fbIco desk"><i class="fa fa-facebook " aria-hidden="true">facebook</i></a>
                <a href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink($propid); ?>&amp;t=<?php echo urlencode(get_the_title($propid)); ?>" target="_blank" class="share_facebook fbIco mob"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
				
				<a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title($propid) .' '. get_the_permalink($propid)); ?>" class="share_tweet twIco desk" target="_blank"><i class="fa fa-twitter">Twitter</i></a>
                <a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title($propid) .' '. get_the_permalink($propid)); ?>" class="share_tweet twIco mob" target="_blank"><i class="fa fa-twitter-square"></i></a>
				
				<?php
				if ( wp_is_mobile() ) { 
				?>
					<a style="border-color:#5CBE4A; color:#5CBE4A;" data-text="<?php echo get_the_title($propid); ?>" data-link="<?php echo get_the_permalink($propid); ?>" class="whatsapp w3_whatsapp_btn w3_whatsapp_btn_large desk" href="whatsapp://send?text=<?php echo get_the_title($propid); ?> - <?php echo get_the_permalink($propid); ?>"><i class="fa fa-whatsapp" aria-hidden="true">whatsapp</i></a>
                    <a style="border-color:#5CBE4A; color:#5CBE4A;" data-text="<?php echo get_the_title($propid); ?>" data-link="<?php echo get_the_permalink($propid); ?>" class="whatsapp w3_whatsapp_btn w3_whatsapp_btn_large mob" href="whatsapp://send?text=<?php echo get_the_title($propid); ?> - <?php echo get_the_permalink($propid); ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
				<?php } ?>
			</div>
			<div class="actionItems">
				<span class="no_views dashboad-tooltip" data-original-title="<?php _e('Number of Page Views','wpestate');?>"><i class="fa fa-eye" aria-hidden="true"></i><?php echo intval( get_post_meta($propid, 'wpestate_total_views', true) );?></span>
				<span id="print_page" data-propid="<?php print $propid;?>" class = "print_btn"><i class="fa fa-print"></i> Print</span>
				<?php
					$language = get_post_meta($propid, 'language', true);
					if($language){
				?>
					<span class="language">Language: <strong><?php echo $language; ?></strong></span>
				<?php } ?>
				
				<?php
					$secDeposit = get_post_meta($propid, 'security_amount', true);
					if($secDeposit){
				?>
					<span class="price"><strong>$ <?php echo $secDeposit; ?></strong> Security Deposit</span>
				<?php } ?>
			</div>
			<p class="description"><?php echo $propertyDetail->post_content; ?></p>
			
			<?php 
				$amenities = json_decode(get_post_meta($propid, 'amenities', true));
				if(is_array($amenities)){
				
			?>
					<div class="heading"><h6>Amenities:</h6></div>
					<div class="amenitiesDetails">
						<span>
							<?php echo implode(', ', $amenities);	?>
						</span>
					</div>
				<?php } ?>
			<?php get_template_part('templates/listingslider'); ?>			
		</div>
	</div>
	<div class="col-md-4">
		<div class="rightSidebar">
			
			<h4>Advertiser Information</h4>
			<div class="ownerInfo">
				<?php 
					$name = get_the_author_meta('display_name',$propertyDetail->post_author);
					if(!$name){
						$name = get_the_author_meta('first_name',$propertyDetail->post_author);
					}
				?>
				<h5><?php echo  $name; ?></h5>
				<?php 
					//$mobile = get_the_author_meta('mobile',$propertyDetail->post_author);
					//if($mobile){
				?>
					<!--<span><i class="fa fa-phone" aria-hidden="true"></i><?php //echo $mobile; ?></span>-->
				<?php// } ?>
				<!--<span><i class="fa fa-envelope" aria-hidden="true"></i><?php //echo get_the_author_meta('user_email',$propertyDetail->post_author); ?></span>-->
			</div>
		
			<div class = 'agent_contact_form_modal'>
				<h4><?php _e('Contact Advertiser', 'wpestate'); ?></h4>
				<?php get_template_part('templates/agent_contact'); ?>
			</div>
			<!--<form>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Your Name">
					<input type="email" class="form-control" placeholder="Email">
					<input type="text" class="form-control" placeholder="Contact Number">
					<textarea class="form-control" placeholder="I am interested in your property!"></textarea>
					<input type="submit" value="Send Message" class="form-control btn-success" />
				  </div>
			</form>-->
		</div>
	</div>
<?php  //include(locate_template('sidebar.php')); ?>
</div> 
<script>
/*function goBack(){
	setTimeout(function(){history.back();}, 500);
}
*/
</script>
<?php get_footer(); ?>
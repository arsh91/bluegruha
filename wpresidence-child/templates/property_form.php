<?php

global $submit_title;
global $submit_description;
global $prop_category;
global $prop_action_category;       
global $property_city;      
global $property_area;
global $property_address;
global $property_county;
global $property_zip;
global $property_state;
global $country_selected; 
global $property_status; 
global $property_price; 
global $property_label; 
global $property_label_before; 
global $property_size; 
global $property_lot_size; 
global $property_year;
global $property_rooms;    
global $property_bedrooms;      
global $property_bathrooms; 
global $option_video; 
global $embed_video_id; 
global $property_latitude; 
global $property_longitude;
global $google_view_check; 
global $prop_featured_check;
global $google_camera_angle;  
global $action;
global $edit_id;
global $show_err;
global $feature_list_array;
global $prop_category_selected;
global $prop_action_category_selected;
global $userID;
global $user_pack;
global $prop_featured;                
global $current_user;
global $custom_fields_array;
global $option_slider;
global $form_no;

$universities_list = get_universities();
$actions = get_terms(array('taxonomy'=>'property_action_category','hide_empty'=>false,'order'=>'DESC'));
?>
<div class="innerContainer">
	<h2>Please Select your Property Type</h2>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs row" role="tablist">
		<?php
			foreach($actions as $key=>$val){
		?>
				<li class="col-md-4" ><a href="#<?php echo $val->slug; ?>" aria-controls="<?php echo $val->slug; ?>" role="tab" data-toggle="tab" data-term="<?php echo $val->term_taxonomy_id; ?>"><i class="fa <?php echo $val->description; ?>" aria-hidden="true"></i><?php echo $val->name; ?></a></li>
		<?php
			}
		?>
	</ul>
	<hr />
	<!-- Tab panes -->
	<div class="tab-content">
		<?php
		   if($show_err){
			   print '<div class="alert alert-danger">'.$show_err.'</div>';
		   }
		?>
		<div role="tabpanel" class="tab-pane fade commonForm" id="university-housing">
			<form class="formContainer row university" method="post" action="" enctype="multipart/form-data" id="new_uni_post" name="new_post">
				
				<?php 
				$form_no = 1;
				get_template_part('templates/submit_templates/select_university'); 
				get_template_part('templates/submit_templates/room_details'); ?>
				<div class="form-group col-md-12 full-width profile-page image-section-add-property image_container">
					<?php //include(locate_template('templates/submit_templates/property_images.php')); ?>
				</div>
				<?php 
				get_template_part('templates/submit_templates/location_section');
				get_template_part('templates/submit_templates/contact_details');
				get_template_part('templates/submit_templates/post_ad_type'); ?>
				<input id="uni_list" value='<?php echo json_encode($universities_list, JSON_PARTIAL_OUTPUT_ON_ERROR); ?>' type="hidden" />
				<input name="term_id" value="" type="hidden" />
			</form>
		</div>
		<div role="tabpanel" class="tab-pane fade commonForm" id="room-to-rent">
			<form class="formContainer row mt-0 room" method="post" action="" enctype="multipart/form-data" id="new_room_post" name="new_post">
				<?php
					$form_no = 2;
					get_template_part('templates/submit_templates/room_details'); 
				?>
				<div class="form-group col-md-12 full-width profile-page image-section-add-property image_container">
					<?php //include(locate_template('templates/submit_templates/property_images.php')); ?>
				</div>
				<?php 
				get_template_part('templates/submit_templates/location_section');
				get_template_part('templates/submit_templates/contact_details');				
				get_template_part('templates/submit_templates/post_ad_type'); ?>
				<input name="term_id" value="" type="hidden" />
			</form>
		</div>
		<div role="tabpanel" class="tab-pane fade commonForm" id="property-to-rent">
			<form class="formContainer row property mt-0" method="post" action="" enctype="multipart/form-data" id="new_property_post" name="new_post">
							
				<?php 
				$form_no = 3;
				get_template_part('templates/submit_templates/property_to_rent_detail'); ?>
				<div class="form-group col-md-12 full-width profile-page image-section-add-property image_container">
					<?php //include(locate_template('templates/submit_templates/property_images.php')); ?>
				</div>
				<?php 
				get_template_part('templates/submit_templates/location_section');
				get_template_part('templates/submit_templates/contact_details');				
				get_template_part('templates/submit_templates/post_ad_type'); ?>
				<input name="term_id" value="" type="hidden" />
			</form>
		</div>
	</div>
</div>
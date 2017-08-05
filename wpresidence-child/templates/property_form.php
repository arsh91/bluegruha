<?php
global $edit_id;
global $form_no;
$prop_action_category_array     =   get_the_terms($edit_id, 'property_action_category');
if(isset($prop_action_category_array[0])){
	$prop_action_category_selected           =   $prop_action_category_array[0]->term_id;
}


$universities_list = get_universities();
?>
<div class="innerContainer">
	<h2>Please Select your Property Type</h2>
	<!-- Nav tabs -->
	<?php
			if(!$prop_action_category_selected){ ?>
				<ul class="nav nav-tabs row" role="tablist">
					<?php
					$actions = get_terms(array('taxonomy'=>'property_action_category','hide_empty'=>false,'order'=>'DESC', 'exclude'=>47));
					foreach($actions as $key=>$val){
					?>
							<li class="col-md-4" ><a href="#<?php echo $val->slug; ?>" aria-controls="<?php echo $val->slug; ?>" role="tab" data-toggle="tab" data-term="<?php echo $val->term_taxonomy_id; ?>"><i class="fa <?php echo $val->description; ?>" aria-hidden="true"></i><?php echo $val->name; ?></a></li>
					<?php
					} ?>
				</ul>
		<?php }else{ ?>
			<ul class="nav nav-tabs row active" role="tablist">
				<li class="col-md-4 active"><a data-term="<?php echo $prop_action_category_selected; ?>"><i class="fa <?php echo $prop_action_category_array[0]->description; ?>" aria-hidden="true"></i><?php echo $prop_action_category_array[0]->name; ?></a></li>
			</ul>
		<?php } ?>
	<hr />
	<!-- Tab panes -->
	<div class="tab-content">
		<?php
		   if($show_err){
			   print '<div class="alert alert-danger">'.$show_err.'</div>';
		   }
		?>
		<div role="tabpanel" class="tab-pane fade commonForm <?php echo ($prop_action_category_array[0]->slug=='university-housing' ? 'active in' : ''); ?>" id="university-housing">
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
				<input name="term_id" type="hidden" value="<?php echo $prop_action_category_selected; ?>" />
			</form>
		</div>
		<div role="tabpanel" class="tab-pane fade commonForm <?php echo ($prop_action_category_array[0]->slug=='room-to-rent' ? 'active in' : ''); ?>" id="room-to-rent">
			<form class="formContainer row mt-0 room" method="post" action="" enctype="multipart/form-data" id="new_room_post" name="new_post">
				<?php
					$form_no = 2;
					get_template_part('templates/submit_templates/room_details'); 
				if(!$edit_id){ ?>
					<div class="form-group col-md-12 full-width profile-page image-section-add-property image_container">
						<?php //include(locate_template('templates/submit_templates/property_images.php')); ?>
					</div>
					<?php
					get_template_part('templates/submit_templates/location_section');
					get_template_part('templates/submit_templates/contact_details');
				}
				get_template_part('templates/submit_templates/post_ad_type'); ?>
				<input name="term_id" type="hidden" value="<?php echo $prop_action_category_selected; ?>" />
			</form>
		</div>
		<div role="tabpanel" class="tab-pane fade commonForm <?php echo ($prop_action_category_array[0]->slug=='property-to-rent' ? 'active in' : ''); ?>" id="property-to-rent">
			<form class="formContainer row property mt-0" method="post" action="" enctype="multipart/form-data" id="new_property_post" name="new_post">
							
				<?php 
				$form_no = 3;
				get_template_part('templates/submit_templates/property_to_rent_detail'); 
				if(!$edit_id){ ?>
					<div class="form-group col-md-12 full-width profile-page image-section-add-property image_container">
						<?php //include(locate_template('templates/submit_templates/property_images.php')); ?>
					</div>
					<?php 
					get_template_part('templates/submit_templates/location_section');
					get_template_part('templates/submit_templates/contact_details');
				}					
				get_template_part('templates/submit_templates/post_ad_type'); ?>
				<input name="term_id" type="hidden" value="<?php echo $prop_action_category_selected; ?>" />
			</form>
		</div>
	</div>
</div>
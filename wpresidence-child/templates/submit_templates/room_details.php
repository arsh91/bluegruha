<?php
global $edit_id;
global $form_no;
global $the_post;

$bedroom_type = esc_html( get_post_meta($edit_id, 'bedroom_type', true));
$bathroom_type = esc_html( get_post_meta($edit_id, 'bathroom_type', true));
$property_price = esc_html( get_post_meta($edit_id, 'property_price', true));
$roomie_gender = esc_html( get_post_meta($edit_id, 'roomie_gender', true));
$security_amount = esc_html( get_post_meta($edit_id, 'security_amount', true));
$available_from = esc_html( get_post_meta($edit_id, 'available_from', true));
$amenities = esc_html( get_post_meta($edit_id, 'amenities', true));
$language = esc_html( get_post_meta($edit_id, 'language', true));
$measure_sys            = esc_html ( get_option('wp_estate_measure_sys','') ); 

$categories = get_terms(array('taxonomy'=>'property_category','hide_empty'=>false,'order'=>'ASC'));
?>
<div class="col-md-12 headingPanel">
	<h3>Please Enter Your Room Details</h3>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Bedroom type *</label>
	<div class="options" id="bedRoom">
		<div class="radio">
			<label>
				<input type="radio" name="bedroom_type" value = "Private" <?php echo($bedroom_type=='') ? 'checked':($bedroom_type=='Private') ?'checked' : ''; ?>><i class="fa fa-user" aria-hidden="true"></i>Private
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="bedroom_type" value = "Shared" <?php echo($bedroom_type=='Shared') ?'checked' : ''; ?>><i class="fa fa-users" aria-hidden="true"></i>Shared
			</label>
		</div>
	</div>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Bathroom type *</label>
	<div class="options" id="bathRoom">
		<div class="radio">
			<label>
				<input type="radio" name="bath_type" value = "Private" <?php echo($bathroom_type=='') ? 'checked':($bathroom_type=='Private') ?'checked' : ''; ?>><i class="fa fa-user" aria-hidden="true"></i>Private
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="bath_type" value = "Shared" <?php echo($bathroom_type=='Shared') ?'checked' : ''; ?>><i class="fa fa-users" aria-hidden="true"></i>Shared
			</label>
		</div>
	</div>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Room Rent *</label>
	<input type="text" class="form-control room_rent" placeholder="Per Month" name = "rent" id = "room_rent" value="<?php echo $property_price; ?>"/>

</div>
<div class="form-group col-md-6">
	<label class="control-label">Gender Preference *</label>
	<div class="options" id="gender">
	
		<div class="radio">
			<label>
				<input name="roomie_gender" value="Male" type="radio" <?php echo($roomie_gender=='') ? 'checked':($roomie_gender=='Male') ?'checked' : ''; ?> /><i class="fa fa-male" aria-hidden="true"></i>Male
			</label>
		</div>
		<div class="radio">
			<label>
				<input name="roomie_gender" value="Female" type="radio" <?php echo($roomie_gender=='Female') ?'checked' : ''; ?> /><i class="fa fa-female" aria-hidden="true"></i>Female		
			</label>
		</div>
		<div class="radio">
			<label>
				<input name="roomie_gender" value="Any" type="radio" <?php echo($roomie_gender=='Any') ?'checked' : ''; ?> /><i class="fa fa-globe" aria-hidden="true"></i>Any		
			</label>
		</div>
		
		<?php
			// $tmp = 0;
			// foreach($categories as $key=>$val){
				// $checked = '';
				// if($tmp == 0){
					// $checked = 'checked';
					// $tmp = 1;
				// }
		?><!--
			<div class="radio">
				<label>
					<input type="radio" name="roomie_gender" value="<?php //echo $val->term_taxonomy_id; ?>" <?php //echo $checked; ?> /><i class="fa <?php //echo $val->description; ?>" aria-hidden="true"></i><?php //echo $val->name; ?>
				</label>
			</div>-->
		<?php //} ?>
	</div>
</div>
<?php
	if (!wp_is_mobile()) { ?>
		<div class="form-group col-md-6">
			<label class="control-label">Security Deposit</label>
			<input type="text" class="form-control" name = "security_amount" value="<?php echo $security_amount; ?>" />
		</div>
<?php } ?>
<div class="form-group col-md-6">
	<label class="control-label">Available From</label>
	<input type="text" class="form-control" name="available_from" id="available_from<?php echo $form_no; ?>" value="<?php echo $available_from;?>" />
	<?php echo wpestate_date_picker_translation_return('available_from'.$form_no); ?>
</div>

<div class="form-group col-md-6">
	<label class="control-label">Amenities</label>
	<select id="amenities" multiple="multiple" name ="amenities[]">
		<option value="Washer/Dryer" <?php echo (strstr($amenities, 'Washer'))?'selected':'';?>>Washer/Dryer</option>
		<option value="Garage" <?php echo (strstr($amenities, 'Garage'))?'selected':'';?>>Garage</option>
		<option value="Swimming pool" <?php echo (strstr($amenities, 'Swimming pool'))?'selected':'';?>>Swimming pool</option>
		<option value="Gym/Fitness center" <?php echo (strstr($amenities, 'Fitness center'))?'selected':'';?>>Gym/Fitness center</option>
	</select>
</div>
<?php
	if (!wp_is_mobile()) { ?>
		<div class="form-group col-md-6">
			<label class="control-label">Language Preference</label>
			<input type="text" class="form-control" name="language" value="<?php echo $language; ?>">
		</div>
	<?php } ?>

<div class="col-md-12 headingPanel">
	<h3>Other details</h3>
</div>

<div class="form-group col-md-12 title-field">
	<label class="control-label">Title *</label>
	<input type="text" class="form-control prop_title" name="title" id="prop_title" value="<?php echo $the_post->post_title; ?>"/>
</div>
<div class="form-group col-md-12 full-width">
	<label class="control-label">Room Description</label>
	<textarea rows="4" class="form-control" placeholder="Please brief your room details " name="description"><?php echo $the_post->post_content; ?></textarea>
</div>
<!--
<div class="form-group col-md-12 highlight room_to_rent_field" style="display:none;">
	<label class="control-label">Room Tag *</label>
	<input type="text" class="form-control" placeholder="Tag a university, school, company or other location for easy search ability">
	<em>Tagging your room will help your ad show up when users search with the particular keywords</em>
</div>
-->
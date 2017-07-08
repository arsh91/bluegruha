<?php
global $unit;
global $property_size;
global $property_lot_size;
global $property_rooms;
global $property_bedrooms;
global $property_bathrooms;
global $custom_fields_array;
global $owner_notes;
global $form_no;

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
				<input type="radio" name="bedroom_type" value = "Private" checked><i class="fa fa-user" aria-hidden="true"></i>Private
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="bedroom_type" value = "Shared"><i class="fa fa-users" aria-hidden="true"></i>Shared
			</label>
		</div>
	</div>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Bathroom type *</label>
	<div class="options" id="bathRoom">
		<div class="radio">
			<label>
				<input type="radio" name="bath_type" value = "Private" checked><i class="fa fa-user" aria-hidden="true"></i>Private
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="bath_type" value = "Shared" ><i class="fa fa-users" aria-hidden="true"></i>Shared
			</label>
		</div>
	</div>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Room Rent *</label>
	<input type="text" class="form-control room_rent" placeholder="Per Month" name = "rent" id = "room_rent" />

</div>
<div class="form-group col-md-6">
	<label class="control-label">Gender Preference *</label>
	<div class="options" id="gender">
		<?php
			$tmp = 0;
			foreach($categories as $key=>$val){
				$checked = '';
				if($tmp == 0){
					$checked = 'checked';
					$tmp = 1;
				}
		?>
			<div class="radio">
				<label>
					<input type="radio" name="roomie_gender" value="<?php echo $val->term_taxonomy_id; ?>" <?php echo $checked; ?> /><i class="fa <?php echo $val->description; ?>" aria-hidden="true"></i><?php echo $val->name; ?>
				</label>
			</div>
		<?php } ?>
	</div>
</div>
<?php
	if (!wp_is_mobile()) { ?>
		<div class="form-group col-md-6">
			<label class="control-label">Security Deposit</label>
			<input type="text" class="form-control" name = "security_amount">
		</div>
<?php } ?>
<div class="form-group col-md-6">
	<label class="control-label">Available From</label>
	<input type="text" class="form-control" name="available_from" id="available_from<?php echo $form_no; ?>">
	<?php echo wpestate_date_picker_translation_return('available_from'.$form_no); ?>
</div>

<div class="form-group col-md-6">
	<label class="control-label">Amenities</label>
	<select id="amenities" multiple="multiple" name ="amenities[]">
		<option value="Washer/Dryer">Washer/Dryer</option>
		<option value="Garage">Garage</option>
		<option value="Swimming pool">Swimming pool</option>
		<option value="Gym/Fitness center">Gym/Fitness center</option>
	</select>
</div>
<?php
	if (!wp_is_mobile()) { ?>
		<div class="form-group col-md-6">
			<label class="control-label">Language Preference</label>
			<input type="text" class="form-control" name="language">
		</div>
	<?php } ?>

<div class="col-md-12 headingPanel">
	<h3>Other details</h3>
</div>

<div class="form-group col-md-12 title-field">
	<label class="control-label">Title *</label>
	<input type="text" class="form-control prop_title" name="title" id="prop_title" />
</div>
<div class="form-group col-md-12 full-width">
	<label class="control-label">Room Description</label>
	<textarea rows="4" class="form-control" placeholder="Please brief your room details " name="description"></textarea>
</div>
<!--
<div class="form-group col-md-12 highlight room_to_rent_field" style="display:none;">
	<label class="control-label">Room Tag *</label>
	<input type="text" class="form-control" placeholder="Tag a university, school, company or other location for easy search ability">
	<em>Tagging your room will help your ad show up when users search with the particular keywords</em>
</div>
-->
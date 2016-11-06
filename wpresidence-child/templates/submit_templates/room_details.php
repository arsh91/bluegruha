<?php
global $unit;
global $property_size;
global $property_lot_size;
global $property_rooms;
global $property_bedrooms;
global $property_bathrooms;
global $custom_fields_array;
global $owner_notes;
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
				<input type="radio" name="bedroom_type" value = "Separate" checked><i class="fa fa-user" aria-hidden="true"></i>Seprate
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
				<input type="radio" name="bath_type" value = "Separate" checked><i class="fa fa-user" aria-hidden="true"></i>Seprate
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
	<label class="control-label">Room Rent</label>
	<input type="text" class="form-control" placeholder="Per Month" name = "rent">
</div>
<div class="form-group col-md-6">
	<label class="control-label">Security Deposit</label>
	<input type="text" class="form-control" name = "security_amount">
</div>
<div class="form-group col-md-6">
	<label class="control-label">Available From</label>
	<input type="text" class="form-control" name="available_from" id="available_from">
	<?php echo wpestate_date_picker_translation_return('available_from'); ?>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Amenities</label>
	<select id="amenities" multiple="multiple" name ="amenities">
		<option value="Washer">Washer</option>
		<option value="Garage">Garage</option>
		<option value="Aircon">Aircon</option>
	</select>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Roomie Gender *</label>
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
					<input type="radio" name="roomie_gender" value="<?php echo $val->term_taxonomy_id; ?>" <?php echo $checked; ?>><i class="fa <?php echo $val->description; ?>" aria-hidden="true"></i><?php echo $val->name; ?>
				</label>
			</div>
		<?php } ?>
	</div>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Language</label>
	<input type="text" class="form-control" name="language">
</div>

<div class="col-md-12 headingPanel">
	<h3>Other details</h3>
</div>

<div class="form-group col-md-12 full-width">
	<label class="control-label">Room Description (optional)</label>
	<textarea rows="4" class="form-control" placeholder="Please brief your room details " name="description"></textarea>
</div>
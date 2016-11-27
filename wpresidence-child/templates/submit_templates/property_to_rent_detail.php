<?php
global $form_no;
?>
<div class="col-md-12 headingPanel">
	<h3 class="mt-0">Please Enter Your Property Details</h3>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Property type *</label>
	<select class="selectpicker" name='property_type' id="property_type">
		<option>Single Family Home</option>
		<option>Apartment</option>
		<option>Other</option>
	</select> 
</div>
<div class="form-group col-md-6">
	<label class="control-label">Property Rent *</label>
	<input type="text" class="form-control" placeholder="Per Month" name="rent" id="rent">
</div>

<div class="form-group col-md-6">
	<label class="control-label">Bedroom(s) *</label>
	<div class="options roomCount" id="bedroomCount">
		<input type="hidden" name="bedrooms" id="bedrooms"/>
		<a href="javascript:void(0)" data-val="1">1</a>
		<a href="javascript:void(0)" data-val="2">2</a>
		<a href="javascript:void(0)" data-val="3">3</a>
		<a href="javascript:void(0)" data-val="4">4</a>
		<a href="javascript:void(0)" data-val="4+">4+</a>
	</div>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Bathroom(s) *</label>
	<div class="options roomCount" id="bathroomCount">
		<input name="bathrooms" type="hidden" id="bathrooms"/>
		<a href="javascript:void(0)" data-val="1">1</a>
		<a href="javascript:void(0)" data-val="2">2</a>
		<a href="javascript:void(0)" data-val="3">3</a>
		<a href="javascript:void(0)" data-val="4">4</a>
		<a href="javascript:void(0)" data-val="4+">4+</a>
	</div>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Total Area</label>
	<input type="text" class="form-control" placeholder="In sq feet" name="area">
</div>
<div class="form-group col-md-6">
	<label class="control-label">Security Deposit</label>
	<input type="text" class="form-control" placeholder="" name="security_amount">
</div>
<div class="form-group col-md-6">
	<label class="control-label">Available From</label>
	<input type="text" class="form-control" name="available_from" id="available_from<?php echo $form_no; ?>">
	<?php echo wpestate_date_picker_translation_return('available_from'.$form_no); ?>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Amenities</label>
	<select id="amenities" multiple="multiple" name ="amenities">
		<option value="Washer/Dryer">Washer/Dryer</option>
		<option value="Garage">Garage</option>
		<option value="Swimming pool">Swimming pool</option>
		<option value="Gym/Fitness center">Gym/Fitness center</option>
	</select>
</div>

<div class="col-md-12 headingPanel">
	<h3>Other details</h3>
</div>

<div class="form-group col-md-12 title-field">
	<label class="control-label">Title *</label>
	<input type="text" class="form-control" name="title" id="prop_title"/>
</div>
<div class="form-group col-md-12 full-width">
	<label class="control-label">Property Description (optional)</label>
	<textarea rows="4" class="form-control" placeholder="Please brief your room details " name="description"></textarea>
</div>
<!--
<div class="form-group col-md-12 highlight">
<label class="control-label">Property Tag *</label>
<input type="text" placeholder="Tag a university, school, company or other location for easy search ability" class="form-control">
<em>Tagging your Property will help your ad show up when users search with the particular keywords</em>
</div>
-->
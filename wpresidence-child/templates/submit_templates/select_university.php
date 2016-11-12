<?php 
	global $university;
?>
<div class="form-group col-md-12 highlight">
	<label class="control-label">Select your university *</label>
	<input type="text" class="form-control" placeholder="Start typing the name of your university" value="<?php echo $university; ?>" name="property_university" id = "property_university" autocomplete="off"/>
	<i class="no-property-found">No Property Found</i>
	<img src="<?php echo get_template_directory_uri() ?>/img/loader.gif" class="uni_loader" />
	
	<input type="hidden" id="hdproperty_university" name="hdproperty_university" value="" />
</div>
<?php 
	global $university;
?>
<div class="form-group col-md-12 highlight">
	<label class="control-label">Select your university *</label>
	<input type="text" class="form-control" placeholder="Start typing the name of your university" value="<?php echo $university; ?>" name="property_university" id = "property_university" autocomplete="off"/>
	<em class="uni_not_found_msg">Hmm. Looks like we missed your university. We will get on to it immediately. Please do go ahead with your ad.</em>
	
	<input type="hidden" id="hdproperty_university" name="hdproperty_university" value="" />
</div>
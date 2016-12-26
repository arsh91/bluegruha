<?php
global $edit_id;
global $current_user;
$disabled = '';
$class = 'postUniAdd';
if(!isset($current_user->data->ID)){
		$disabled = 'disabled';
		$class = 'postUniAdd disabled_contact_btn';
}
?>
<div class="form-group col-md-12 addTypeCon">
	<label class="control-label">Add Type</label>
	<div id="addType" class="addType">
		<div class="radio">
		  <label>
			<input type="radio" id="free" name="addType" value="free" checked><small class="customRadio"></small>Free
		  </label>
		</div>
		<div class="radio">
		  <label>
			<input type="radio" id="featured" name="addType" value="featured"><small class="customRadio"></small>Featured - <span>$5 (one time fee)</span>
		  </label>
		</div>
	</div>
</div>
<div class="col-md-12 buttonContainer">
	<input type="submit" id="postUniAdd" class="<?php echo $class; ?>" value="Post your free add" name="add_property" <?php echo $disabled; ?> />
	<div class="tooltipCustom">
		<ul id="freeAd">
			<li>Valid upto 7 days</li>
			<li>Limited Contact Details</li>
			<li>Ordinary Listing</li>
			<li>No Similar Promotions</li>
		</ul>
		<ul id="featuredAd">
			<li>Valid upto 30 days</li>
			<li>Shared Contact Details</li>
			<li>Featured Listing</li>
			<li>Similar Promotions</li>
		</ul>
	</div>
</div>
<input type="hidden" name="edit_id" value="<?php print $edit_id;?>">
<input type="hidden" name="images_todelete" id="images_todelete" value="">
<?php wp_nonce_field('submit_new_estate','new_estate'); ?>
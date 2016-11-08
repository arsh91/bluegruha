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
			<form class="formContainer row university" method="post" action="" enctype="multipart/form-data" id="new_post" name="new_post">
				
				<?php get_template_part('templates/submit_templates/select_university'); ?>
				<?php get_template_part('templates/submit_templates/room_details'); ?>
				
				<div class="form-group col-md-12 full-width profile-page">
					<?php include(locate_template('templates/submit_templates/property_images.php')); ?>
				</div>
				
				<?php get_template_part('templates/submit_templates/location_section'); ?>
				
				<?php get_template_part('templates/submit_templates/contact_details'); ?>
				
				<div class="form-group col-md-12 addTypeCon">
					<label class="control-label">Add Type</label>
					<div id="addType" class="addType">
						<div class="radio">
							<label>
								<input type="radio" id="free" name="addType" checked><small class="customRadio"></small>Free
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="featured" name="addType"><small class="customRadio"></small>Featured - <span>$5 (one time fee)</span>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-12 buttonContainer">
					<input name="action" value="submit_property" type="hidden" />
					<input name="term_id" value="" type="hidden" />
					<input type="submit" id="postAdd" class="postAdd" value="Post your free add" name="add_property" />
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
			</form>
		</div>

		<div role="tabpanel" class="tab-pane fade commonForm" id="room-to-rent">
			<form class="formContainer row mt-0 room">
				  <div class="col-md-12 headingPanel">
					<h3 class="mt-0">Please Enter Your Room Details</h3>
				  </div>
				  <div class="form-group col-md-6">
					<label class="control-label">Bedroom type *</label>
					<div class="options" id="bedRoom">
						<div class="radio">
						  <label>
							<input type="radio" name="optionsBedroom" checked><i class="fa fa-user" aria-hidden="true"></i>Seprate
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="optionsBedroom"><i class="fa fa-users" aria-hidden="true"></i>Shared
						  </label>
						</div>
					</div>
				  </div>
				  <div class="form-group col-md-6">
					<label class="control-label">Bathroom type *</label>
					<div class="options" id="bathRoom">
						<div class="radio">
						  <label>
							<input type="radio" name="optionsBathroom" checked><i class="fa fa-user" aria-hidden="true"></i>Seprate
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="optionsBathroom"><i class="fa fa-users" aria-hidden="true"></i>Shared
						  </label>
						</div>
					</div>
				  </div>
				  <div class="form-group col-md-6">
					<label class="control-label">Room Rent</label>
					  <input type="text" class="form-control" placeholder="Per Month">
				  </div>
				  <div class="form-group col-md-6">
					<label class="control-label">Security Deposit</label>
					<input type="text" class="form-control">
				  </div>
				  <div class="form-group col-md-6">
					<label class="control-label">Available From</label>
					<input type="text" class="form-control">
				  </div>
				  <div class="form-group col-md-6">
					  <label class="control-label">Amenities</label>
					  <select id="amenities" multiple="multiple">
						<option value="Washer">Washer</option>
						<option value="Garage">Garage</option>
						<option value="Aircon">Aircon</option>
					  </select>
				  </div>
				  <div class="form-group col-md-6">
					<label class="control-label">Roomie Gender *</label>
					<div class="options" id="gender">
						<div class="radio">
						  <label>
							<input type="radio" name="roomieGender" checked><i class="fa fa-venus-mars" aria-hidden="true"></i>Any
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="roomieGender"><i class="fa fa-female" aria-hidden="true"></i>Female
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="roomieGender"><i class="fa fa-male" aria-hidden="true"></i>Male
						  </label>
						</div>
					</div>
				  </div>
				<div class="form-group col-md-6">
					<label class="control-label">Language</label>
					<input type="text" class="form-control">
				</div>
				<div class="col-md-12 headingPanel">
					<h3>Other details</h3>
				</div>
				<div class="form-group col-md-12 full-width">
					<label class="control-label">Room Description (optional)</label>
					<textarea rows="4" class="form-control" placeholder="Please brief your room details "></textarea>
				</div>
				<div class="form-group col-md-12 full-width">
					<label class="control-label">Upload Photos</label>
					<input type="text" class="form-control" placeholder="Browse Images">
				</div>
				<div class="form-group col-md-12 highlight">
					<label class="control-label">Room Tag *</label>
					<input type="text" class="form-control" placeholder="Tag a university, school, company or other location for easy search ability">
					<em>Tagging your room will help your ad show up when users search with the particular keywords</em>
				</div>
				
				<div class="col-md-12 headingPanel">
					<h3>Location Address</h3>
				</div>
				
				<div class="col-md-12 locationWrapper">
					<div class="locationContainer">
						<div class="form-group full-width">
							<label class="control-label">Location Address</label>
							<input type="text" placeholder="Enter home or street address" class="form-control">
						</div>
						<div class="form-group full-width">
							<label class="control-label">Apartment name</label>
							<input type="text" placeholder="Enter your Apartment name" class="form-control">
						</div>
						<div class="map">Map will appear here</div>
					</div>
				</div>
				
				<div class="col-md-12 headingPanel">
					<h3>Please Enter Your Contact Details</h3>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Name</label>
					<input type="text" class="form-control" placeholder="John Doe">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Phone Number</label>
					<input type="text" class="form-control" placeholder="(555)555-5555">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Email</label>
					<input type="email" class="form-control">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Verification</label>
					<button class="verification">Verify your email</button>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">OTP</label>
					<input type="text" class="form-control" placeholder="Please enter your OTP">
				</div>
				<div class="form-group col-md-12 addTypeCon">
					<label class="control-label">Add Type</label>
					<div id="addType" class="addType">
						<div class="radio">
						  <label>
							<input type="radio" id="free" name="addType" checked><small class="customRadio"></small>Free
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" id="featured" name="addType"><small class="customRadio"></small>Featured - <span>$5 (one time fee)</span>
						  </label>
						</div>
					</div>
				</div>
				<div class="col-md-12 buttonContainer">
					<button id="postAdd" class="postAdd">Post your free add</button>
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
			</form>
		</div>
					<div role="tabpanel" class="tab-pane fade commonForm" id="property-to-rent">
						<form class="formContainer row property mt-0">
							<div class="col-md-12 headingPanel">
								<h3 class="mt-0">Please Enter Your Property Details</h3>
							  </div>
							  <div class="form-group col-md-6">
								<label class="control-label">Property type *</label>
								<select class="selectpicker">
									<option>Single Family Home</option>
									<option>Apartment</option>
									<option>Other</option>
								</select> 
							  </div>
							  <div class="form-group col-md-6">
								<label class="control-label">Total Area</label>
								 <input type="text" class="form-control" placeholder="In sq feet">
							  </div>
							  <div class="form-group col-md-6">
								<label class="control-label">Bedroom(s) *</label>
								<div class="options roomCount" id="bedroomCount">
									<a href="javascript:void(0)">1</a>
									<a href="javascript:void(0)">2</a>
									<a href="javascript:void(0)">3</a>
									<a href="javascript:void(0)">4</a>
									<a href="javascript:void(0)">4+</a>
								</div>
							  </div>
							  <div class="form-group col-md-6">
								<label class="control-label">Bathroom(s) *</label>
								<div class="options roomCount" id="bathroomCount">
									<a href="javascript:void(0)">1</a>
									<a href="javascript:void(0)">2</a>
									<a href="javascript:void(0)">3</a>
									<a href="javascript:void(0)">4</a>
									<a href="javascript:void(0)">4+</a>
								</div>
							  </div>
							  <div class="form-group col-md-6">
								<label class="control-label">Property Rent</label>
								  <input type="text" class="form-control" placeholder="Per Month">
							  </div>
							  <div class="form-group col-md-6">
								<label class="control-label">Security Deposit</label>
								  <input type="text" class="form-control" placeholder="In sq feet">
							  </div>
							  <div class="form-group col-md-6">
								<label class="control-label">Available From</label>
								<input type="text" class="form-control">
							  </div>
							  <div class="form-group col-md-6">
							  <label class="control-label">Amenities</label>
								  <select id="amenitiesRoom" multiple="multiple">
									<option value="Washer">Washer</option>
									<option value="Garage">Garage</option>
									<option value="Aircon">Aircon</option>
								</select>
							</div>
							
							<div class="col-md-12 headingPanel">
								<h3>Other details</h3>
							</div>
							
							<div class="form-group col-md-12 full-width">
								<label class="control-label">Property Description (optional)</label>
								<textarea rows="4" class="form-control" placeholder="Please brief your Property details "></textarea>
							</div>
							<div class="form-group col-md-12 full-width">
								<label class="control-label">Upload Photos</label>
								<input type="text" class="form-control" placeholder="Browse Images">
							</div>
							<div class="form-group col-md-12 highlight">
								<label class="control-label">Property Tag *</label>
								<input type="text" placeholder="Tag a university, school, company or other location for easy search ability" class="form-control">
								<em>Tagging your Property will help your ad show up when users search with the particular keywords</em>
							</div>
							
							<div class="col-md-12 headingPanel">
								<h3>Location Address</h3>
							</div>
							
							<div class="col-md-12 locationWrapper">
								<div class="locationContainer">
									<div class="form-group full-width">
										<label class="control-label">Location Address</label>
										<input type="text" placeholder="Enter home or street address" class="form-control">
									</div>
									<div class="form-group full-width">
										<label class="control-label">Apartment name</label>
										<input type="text" placeholder="Enter your Apartment name" class="form-control">
									</div>
									<div class="map">Map will appear here</div>
								</div>
							</div>
							
							<div class="col-md-12 headingPanel">
								<h3>Please Enter Your Contact Details</h3>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Name</label>
								<input type="text" class="form-control" placeholder="John Doe">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Phone Number</label>
								<input type="text" class="form-control" placeholder="(555)555-5555">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Email</label>
								<input type="email" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Verification</label>
								<button class="verification">Verify your email</button>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">OTP</label>
								<input type="text" class="form-control" placeholder="Please enter your OTP">
							</div>
							<div class="form-group col-md-12 addTypeCon">
								<label class="control-label">Add Type</label>
								<div id="addType" class="addType">
									<div class="radio">
									  <label>
										<input type="radio" id="free" name="addType" checked><small class="customRadio"></small>Free
									  </label>
									</div>
									<div class="radio">
									  <label>
										<input type="radio" id="featured" name="addType"><small class="customRadio"></small>Featured - <span>$5 (one time fee)</span>
									  </label>
									</div>
								</div>
							</div>
							<div class="col-md-12 buttonContainer">
								<button id="postAdd" class="postAdd">Post your free add</button>
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
						</form>
					</div>
				  </div>
			</div>
		</div>
	</div>
	</div>
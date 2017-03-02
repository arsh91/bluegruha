<?php

global $current_user;
global $feature_list_array;
global $propid ;
global $show_compare_only;
$show_compare_only  =   'no';
$current_user       =   wp_get_current_user();
$propid = $_POST['propId'];

$propertyDetail = get_post($propid);
$catDetail = get_the_terms($propid, 'property_action_category');
$genderCatDetail = get_the_terms($propid, 'property_category');
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h1 class="modal-title"><i class="fa fa-building" aria-hidden="true"></i> <?php echo get_post_meta($propid, 'property_label', true); ?></h1>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-8">
			<div class="innerContainer propertDetailContainer">
			
				<h2>
					<?php echo get_post_meta($propid, 'apartment_name', true);
						$universityName = get_post_meta($propid, 'property_university', true);
						if($universityName != ''){ ?> - 
							<span>
								<?php 
									echo  $universityName;
								?>
							</span>
						<?php } ?>
				</h2>
				<div class="propertySpecs">
					<div class="specsProperty">
						<?php 
							if($catDetail[0]->term_id == 47 || $catDetail[0]->term_id == 48){ ?>
								<span><i class="fa fa-bed" aria-hidden="true"></i><?php echo get_post_meta($propid, 'bedroom_type', true); ?> Bedroom</span>
								<span><i class="fa fa-bath" aria-hidden="true"></i><?php echo get_post_meta($propid, 'bathroom_type', true); ?> Bathroom</span>
								<span><i class="fa <?php echo $genderCatDetail[0]->description; ?>" aria-hidden="true"></i> <?php echo $genderCatDetail[0]->name; ?> Roomie</span>
						<?php }else{ ?>
								<span><i class="fa fa-bed" aria-hidden="true"></i><?php echo get_post_meta($propid, 'property_bedrooms', true); ?> Bedroom(s)</span>
								<span><i class="fa fa-bath" aria-hidden="true"></i><?php echo get_post_meta($propid, 'property_bathrooms', true); ?> Bathroom(s)</span>
								<span><i class="fa fa-area-chart" aria-hidden="true"></i><?php echo get_post_meta($propid, 'area', true); ?> Sq Ft</span>
						<?php } ?>
					</div>
				</div>
				
				<div class="propertyPrice priceModal">
					<div class="amount">$<?php echo get_post_meta($propid, 'property_price', true); ?><div class='permonth'>per month</div></div> 
					<span>Available From: <strong><?php echo get_post_meta($propid, 'available_from', true); ?></strong></span>
				</div>
				
				<div class="locationAddress"><i class="fa fa-map-marker" aria-hidden="true"></i>
				<?php echo get_post_meta($propid, 'property_address', true); ?>, <?php echo get_post_meta($propid, 'property_zip', true); ?>
				</div>
				<div class="shareWidget">
					<span>Share at :</span>
					
					<a href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink($propid); ?>&amp;t=<?php echo urlencode(get_the_title($propid)); ?>" target="_blank" class="share_facebook fbIco"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
					
					<a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title($propid) .' '. get_the_permalink($propid)); ?>" class="share_tweet twIco" target="_blank"><i class="fa fa-twitter"></i>Twitter</a>
					
					<a href="https://plus.google.com/share?url=<?php echo get_the_permalink($propid); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" class="share_google gpIco"><i class="fa fa-google-plus" aria-hidden="true"></i>Google+</a>
				</div>
				<div class="actionItems">
					<span class="no_views dashboad-tooltip" data-original-title="<?php _e('Number of Page Views','wpestate');?>"><i class="fa fa-eye" aria-hidden="true"></i><?php echo intval( get_post_meta($propid, 'wpestate_total_views', true) );?></span>
					<span id="print_page" data-propid="<?php print $propid;?>" class = "print_btn"><i class="fa fa-print"></i> Print</span>
					<?php
						$secDeposit = get_post_meta($propid, 'security_amount', true);
						if($secDeposit){
					?>
						<span class="price"><strong>$ <?php echo $secDeposit; ?></strong> Security Deposit</span>
					<?php } ?>
				</div>
				<p class="description"><?php echo $propertyDetail->post_content; ?></p>
				
				<?php 
					$amenities = json_decode(get_post_meta($propid, 'amenities', true));
					if(is_array($amenities)){
					
				?>
						<h6>Amenities:</h6>
						<div class="amenitiesDetails">
							<span>
								<?php echo implode(', ', $amenities);	?>
							</span>
						</div>
					<?php } ?>
				<?php get_template_part('templates/listingslider'); ?>			
			</div>
		</div>
		<div class="col-md-4">
			<div class="rightSidebar">
				
				<h4>Advertiser Information</h4>
				<div class="ownerInfo">
					<?php 
						$name = get_the_author_meta('display_name',$propertyDetail->post_author);
						if(!$name){
							$name = get_the_author_meta('first_name',$propertyDetail->post_author);
						}
					?>
					<h5><?php echo  $name; ?></h5>
					<?php 
						$mobile = get_the_author_meta('mobile',$propertyDetail->post_author);
						if($mobile){
					?>
						<span><i class="fa fa-phone" aria-hidden="true"></i><?php echo  $mobile; ?></span>
					<?php } ?>
					<span><i class="fa fa-envelope" aria-hidden="true"></i><?php echo get_the_author_meta('user_email',$propertyDetail->post_author); ?></span>
				</div>
			
				<div class = 'agent_contact_form_modal'>
					<h4><?php _e('Contact Advertiser', 'wpestate'); ?></h4>
					<?php get_template_part('templates/agent_contact'); ?>
				</div>
				<!--<form>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Your Name">
						<input type="email" class="form-control" placeholder="Email">
						<input type="text" class="form-control" placeholder="Contact Number">
						<textarea class="form-control" placeholder="I am interested in your property!"></textarea>
						<input type="submit" value="Send Message" class="form-control btn-success" />
					  </div>
				</form>-->
			</div>
		</div>
	</div>
</div>
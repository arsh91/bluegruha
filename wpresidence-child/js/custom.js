jQuery(document).ready(function() {
    jQuery(".innerContainer .nav-tabs li a").click(function() {
		jQuery('.innerContainer .nav-tabs').addClass("active");
		jQuery('.innerContainer .nav-tabs li').removeClass("col-md-6");
		var termId= jQuery(this).data('term');
		jQuery('input[name=term_id]').val(termId);
		setTimeout(function(){
			initialize();
			google.maps.event.trigger(map, "resize");
        },1000)
	});
	
	jQuery(".formContainer .options .radio label input[type='radio']").each(function() {
		if(jQuery(this).is(':checked')){
			jQuery(this).parent('label').addClass('activeRadio');
		}
	});
	
    jQuery(".formContainer.university .options#bedRoom .radio label input[type='radio']").click(function() {
		jQuery('.formContainer.university .options#bedRoom .radio label').removeClass('activeRadio');
		jQuery(this).parent('label').addClass('activeRadio');
	});
	
    jQuery(".formContainer.university .options#bathRoom .radio label input[type='radio']").click(function() {
		jQuery('.formContainer.university .options#bathRoom .radio label').removeClass('activeRadio');
		jQuery(this).parent('label').addClass('activeRadio');
	});
	
	jQuery(".formContainer.room .options#bedRoom .radio label input[type='radio']").click(function() {
		jQuery('.formContainer.room .options#bedRoom .radio label').removeClass('activeRadio');
		jQuery(this).parent('label').addClass('activeRadio');
	});
	
    jQuery(".formContainer.room .options#bathRoom .radio label input[type='radio']").click(function() {
		jQuery('.formContainer.room .options#bathRoom .radio label').removeClass('activeRadio');
		jQuery(this).parent('label').addClass('activeRadio');
	});
	
	jQuery(".formContainer.university .options#gender .radio label input[type='radio']").click(function() {
		jQuery('.formContainer.university .options#gender .radio label').removeClass('activeRadio');
		jQuery(this).parent('label').addClass('activeRadio');
	});
	
	jQuery(".formContainer.university #addType .radio label input[type='radio']#featured").click(function() {
		jQuery('.university #postUniAdd').text('Post your featured add').addClass('featuredAdd');
		jQuery('.university ul#freeAd').hide();
		jQuery('.university ul#featuredAd').show();
	});
	
	jQuery(".formContainer.university #addType .radio label input[type='radio']#free").click(function() {
		jQuery('.university #postUniAdd').text('Post your free add').removeClass('featuredAdd');
		jQuery('.university ul#freeAd').show();
		jQuery('.university ul#featuredAd').hide();
	});
	
	jQuery(".formContainer.property #addType .radio label input[type='radio']#featured").click(function() {
		jQuery('.property #postUniAdd').text('Post your featured property').addClass('featuredAdd');
		jQuery('.property ul#freeAd').hide();
		jQuery('.property ul#featuredAd').show();
	});
	
	jQuery(".formContainer.property #addType .radio label input[type='radio']#free").click(function() {
		jQuery('.property #postUniAdd').text('Post your free add').removeClass('featuredAdd');
		jQuery('.property ul#freeAd').show();
		jQuery('.property ul#featuredAd').hide();
	});
	
	jQuery(".formContainer.room .options#gender .radio label input[type='radio']").click(function() {
		jQuery('.formContainer.room .options#gender .radio label').removeClass('activeRadio');
		jQuery(this).parent('label').addClass('activeRadio');
	});
	
	jQuery(".formContainer.room #addType .radio label input[type='radio']#featured").click(function() {
		jQuery('.room #postUniAdd').text('Post your featured Room').addClass('featuredAdd');
		jQuery('.room ul#freeAd').hide();
		jQuery('.room ul#featuredAd').show();
	});
	
	jQuery(".formContainer.room #addType .radio label input[type='radio']#free").click(function() {
		jQuery('.room #postUniAdd').text('Post your free add').removeClass('featuredAdd');
		jQuery('.room ul#freeAd').show();
		jQuery('.room ul#featuredAd').hide();
	});
	
	jQuery("#bedroomCount a").click(function() {
		jQuery("#bedroomCount a").removeClass('selected');
		jQuery(this).addClass('selected');
	});
	
	jQuery("#bathroomCount a").click(function() {
		jQuery("#bathroomCount a").removeClass('selected');
		jQuery(this).addClass('selected');
	});
	
	// var uni_list = jQuery('#uni_list').val();
	// jQuery( "#property_university" ).autocomplete({
		// source: uni_list
	// });
	// jQuery("#property_university").autocomplete({
		// source: function(req, response) {
			// var re = jQuery.ui.autocomplete.escapeRegex(req.term);
			// var matcher = new RegExp("^" + re, "i");
			// response(jQuery.grep(uni_list, function(item) {
				// return matcher.test(item.value);
			// }));
		// },
		// select: function(event, ui) {
			// alert('here');
		// }
	// });
	
	
	// university form validations
	
	function checkMandatory(var obj){
		if(obj){
			var val = jQuery(obj).val();
			if(!val){
				jQuery(obj).addClass('requried');
			}else{
				jQuery(obj).removeClass('requried');
			}
		}
		return true;
	}
	jQuery('#property_university').blur(function(){
		checkMandatory(this);
	});
	
	jQuery('#room_rent').blur(function(){
		checkMandatory(this);
	});
	
	jQuery('#prop_title').blur(function(){
		checkMandatory(this);
	});
	
	jQuery('#property_address').blur(function(){
		checkMandatory(this);
	});
	
	jQuery('#agent_user_email').blur(function(){
		checkMandatory(this);
	});
	jQuery('#agent_name').blur(function(){
		checkMandatory(this);
	});
	
	
});
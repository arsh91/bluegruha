jQuery(document).ready(function() {
    jQuery(".innerContainer .nav-tabs li a").click(function() {
		jQuery('.innerContainer .nav-tabs').addClass("active");
		jQuery('.innerContainer .nav-tabs li').removeClass("col-md-6");
		var termId= jQuery(this).data('term');
		jQuery('input[name=term_id]').val(termId);
		var contId = '#'+jQuery(this).attr('aria-controls');
		ajaxurl     =   ajaxcalls_vars.admin_url + 'admin-ajax.php';
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				'action'            :   'get_location_section',
			},
			success: function (data) {  
				jQuery('.add_property_location').empty();
				jQuery(contId+' .add_property_location').html(data);
				jQuery('.property_address').unbind('blur').bind('blur', function(){
					checkMandatory(this);
				});
				setTimeout(function(){
					initialize();
					google.maps.event.trigger(map, "resize");
					
					if ( google_map_submit_vars.enable_auto ==='yes' ){  
						autocomplete = new google.maps.places.Autocomplete(
						  /** @type {HTMLInputElement} */(document.getElementById('property_address')),
							{   types: ['geocode'],
								"partial_match" : true
							}
						);
						
						var input = document.getElementById('property_address');
						google.maps.event.addDomListener(input, 'keydown', function(e) { 
							if (e.keyCode == 13) { 
								e.stopPropagation(); 
								e.preventDefault();
							}
						});
						
						google.maps.event.addListener(autocomplete, 'place_changed', function(event) {
							var place = autocomplete.getPlace();
							fillInAddress(place);
							removeMarkers();
							codeAddress();  
						});
					}						
					
				},400);		
			},
			error: function (errorThrown) {}
		});
		
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				'action'            :   'get_image_section',
			},
			success: function (data) {  
				jQuery('.image_container').empty();
				jQuery(contId+' .image_container').html(data);		
			},
			error: function (errorThrown) {}
		});
		//var mapCont = '<div id="googleMapsubmit"></div>';
		//jQuery(contId+' .map').html(mapCont);
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
		var val = jQuery(this).data('val');
		jQuery(this).parent().find('input[name=bedrooms]').val(val);
	});
	
	jQuery("#bathroomCount a").click(function() {
		jQuery("#bathroomCount a").removeClass('selected');
		jQuery(this).addClass('selected');
		var val = jQuery(this).data('val');
		jQuery(this).parent().find('input[name=bathrooms]').val(val);
	});
	
	
	// university form validations
	
	function checkMandatory(obj){
		if(obj){
			var val = jQuery(obj).val();
			if(val == ''){
				jQuery(obj).addClass('required');
				jQuery('<i class="validation_msg">is Required.</i>').insertAfter(jQuery(obj));
			}else{
				jQuery(obj).removeClass('required');
				jQuery(obj).parent().find('.validation_msg').remove();
			}
		}
		return true;
	}
	jQuery('#property_university, .room_rent, .prop_title, .property_address, .agent_name, .agent_user_email').blur(function(){
		checkMandatory(this);
	});
	
	jQuery('form#new_uni_post, form#new_room_post').submit(function(e){
		var err = 0;
		var obj = jQuery(this);
		if(obj.attr('id') == 'new_uni_post'){
			if(jQuery('#property_university').val() == ''){
				err = 1;
				jQuery('#property_university').addClass('required');
				jQuery('<i class="validation_msg">is Required.</i>').insertAfter(jQuery('#property_university'));
				jQuery('html, body').animate({
					scrollTop: jQuery("#property_university").offset().top-100
				}, 2000);
			}
		}
		if(obj.closest('form').find('#room_rent').val() == ''){
			
			obj.closest('form').find('#room_rent').addClass('required');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(obj.closest('form').find('#room_rent'));
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#room_rent").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(obj.closest('form').find('#prop_title').val() == ''){
			
			obj.closest('form').find('#prop_title').addClass('required');
			var elem = obj.closest('form').find('#prop_title');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(elem);
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#prop_title").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		
		if(obj.closest('form').find('#property_address').val() == ''){
			
			obj.closest('form').find('#property_address').addClass('required');
			var elem = obj.closest('form').find('#property_address');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(elem);
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#property_address").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(obj.closest('form').find('#agent_name').val() == ''){
			
			obj.closest('form').find('#agent_name').addClass('required');
			var elem = obj.closest('form').find('#agent_name');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(elem);
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#agent_name").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(obj.closest('form').find('#agent_user_email').val() == ''){
			
			obj.closest('form').find('#agent_user_email').addClass('required');
			var elem = obj.closest('form').find('#agent_user_email');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(elem);
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#agent_user_email").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		
		if(err){
			e.preventDefault();
		}
		
		return true;
	});	
	
	jQuery('form#new_property_post').submit(function(e){
		var err = 0;
		var obj = jQuery(this);
		if(obj.closest('form').find('#property_type').val() == ''){
			
			obj.closest('form').find('#property_type').addClass('required');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(obj.closest('form').find('#property_type'));
			jQuery('html, body').animate({
				scrollTop: obj.closest('form').find("#property_type").offset().top-100
			}, 2000);
			err = 1;
		}
		if(obj.closest('form').find('#rent').val() == ''){
			
			obj.closest('form').find('#rent').addClass('required');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(obj.closest('form').find('#rent'));
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#rent").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(obj.closest('form').find('#bedrooms').val() == ''){
			
			obj.closest('form').find('#bedrooms').addClass('required');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(obj.closest('form').find('#bedrooms'));
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#bedrooms").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(obj.closest('form').find('#bathrooms').val() == ''){
			
			obj.closest('form').find('#bathrooms').addClass('required');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(obj.closest('form').find('#bathrooms'));
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#bathrooms").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(obj.closest('form').find('#prop_title').val() == ''){
			
			obj.closest('form').find('#prop_title').addClass('required');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(obj.closest('form').find('#prop_title'));
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#prop_title").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(obj.closest('form').find('#property_address').val() == ''){
			
			obj.closest('form').find('#property_address').addClass('required');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(obj.closest('form').find('#property_address'));
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#property_address").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(obj.closest('form').find('#agent_name').val() == ''){
			
			obj.closest('form').find('#agent_name').addClass('required');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(obj.closest('form').find('#agent_name'));
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#agent_name").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(obj.closest('form').find('#agent_user_email').val() == ''){
			
			obj.closest('form').find('#agent_user_email').addClass('required');
			jQuery('<i class="validation_msg">is Required.</i>').insertAfter(obj.closest('form').find('#agent_user_email'));
			if(!err){
				jQuery('html, body').animate({
					scrollTop: obj.closest('form').find("#agent_user_email").offset().top-100
				}, 2000);
			}
			err = 1;
		}
		if(err){
			e.preventDefault();
		}
		
		return true;
	});
	
	var university_list = JSON.parse(jQuery('#uni_list').val());
	jQuery( "#property_university" ).autocomplete({
		source: university_list,
		response:function(event, ui){
			if (ui.content.length === 0) {
				jQuery('.uni_not_found_msg').show();
			}else{
				jQuery('.uni_not_found_msg').hide();
			}
		},
		change: function( event, ui ) {
			jQuery('#hdproperty_university').val(ui.item.id);
			jQuery('#agent_user_email').val(ui.item.domain);
		}
	});
	
	// Overrides the default autocomplete filter function to search only from the beginning of the string
    jQuery.ui.autocomplete.filter = function (array, term) {
        var matcher = new RegExp("^" + jQuery.ui.autocomplete.escapeRegex(term), "i");
        return jQuery.grep(array, function (value) {
            return matcher.test(value.label || value.value || value);
        });
    };
	
});
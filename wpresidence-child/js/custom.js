jQuery(document).ready(function() {
    jQuery(".innerContainer .nav-tabs li a").click(function() {
		jQuery('.innerContainer .nav-tabs').addClass("active");
		jQuery('.innerContainer .nav-tabs li').removeClass("col-md-6");
		var termId= jQuery(this).data('term');
		jQuery('input[name=term_id]').val(termId);
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
		jQuery('.university #postAdd').text('Post your featured add').addClass('featuredAdd');
		jQuery('.university ul#freeAd').hide();
		jQuery('.university ul#featuredAd').show();
	});
	
	jQuery(".formContainer.university #addType .radio label input[type='radio']#free").click(function() {
		jQuery('.university #postAdd').text('Post your free add').removeClass('featuredAdd');
		jQuery('.university ul#freeAd').show();
		jQuery('.university ul#featuredAd').hide();
	});
	
	jQuery(".formContainer.property #addType .radio label input[type='radio']#featured").click(function() {
		jQuery('.property #postAdd').text('Post your featured property').addClass('featuredAdd');
		jQuery('.property ul#freeAd').hide();
		jQuery('.property ul#featuredAd').show();
	});
	
	jQuery(".formContainer.property #addType .radio label input[type='radio']#free").click(function() {
		jQuery('.property #postAdd').text('Post your free add').removeClass('featuredAdd');
		jQuery('.property ul#freeAd').show();
		jQuery('.property ul#featuredAd').hide();
	});
	
	jQuery(".formContainer.room .options#gender .radio label input[type='radio']").click(function() {
		jQuery('.formContainer.room .options#gender .radio label').removeClass('activeRadio');
		jQuery(this).parent('label').addClass('activeRadio');
	});
	
	jQuery(".formContainer.room #addType .radio label input[type='radio']#featured").click(function() {
		jQuery('.room #postAdd').text('Post your featured Room').addClass('featuredAdd');
		jQuery('.room ul#freeAd').hide();
		jQuery('.room ul#featuredAd').show();
	});
	
	jQuery(".formContainer.room #addType .radio label input[type='radio']#free").click(function() {
		jQuery('.room #postAdd').text('Post your free add').removeClass('featuredAdd');
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
});
<?php 
global $post;
global $adv_search_type;
$adv_search_what            =   get_option('wp_estate_adv_search_what','');
$show_adv_search_visible    =   get_option('wp_estate_show_adv_search_visible','');
$close_class                =   '';

if($show_adv_search_visible=='no'){
    $close_class='adv-search-1-close';
}

$extended_search    =   get_option('wp_estate_show_adv_search_extended','');
$extended_class     =   '';

if ($adv_search_type==2){
     $extended_class='adv_extended_class2';
}

if ( $extended_search =='yes' ){
    $extended_class='adv_extended_class';
    if($show_adv_search_visible=='no'){
        $close_class='adv-search-1-close-extended';
    }
       
}

?>

 <script type="text/javascript">
	//<![CDATA[
                jQuery(document).ready(function(){
                        jQuery("#available-from").datepicker({
                                dateFormat : "yy-mm-dd"
                        },jQuery.datepicker.regional["xx"]);
                });
        //]]>
 </script>

<div class="child-adv-search adv-search-1 <?php echo esc_html($close_class.' '.$extended_class);?>" id="adv-search-1" > 
    <div id="adv-search-header-1"> <?php _e('Advanced Search','wpestate');?></div>   
    <form role="search" method="get"   action="<?php esc_url(print $adv_submit); ?>" >
        <?php
        if (function_exists('icl_translate') ){
            print do_action( 'wpml_add_language_form_field' );
        }
        ?>   
        
        
        <div class="adv1-holder filterContainer">
            <?php
            $custom_advanced_search= get_option('wp_estate_custom_advanced_search','');
            if ( $custom_advanced_search == 'yes'){
                foreach($adv_search_what as $key=>$search_field){
					if($search_field != 'none'){
						$style = ($search_field=='categories') ?'display:none;':'';
						echo "<div class='inputContainer $search_field' style='$style'>";
							wpestate_show_search_field('mainform',$search_field,$action_select_list,$categ_select_list,$select_city_list,$select_area_list,$key,$select_county_state_list);
						echo '</div>';
					}
                }
            }else{
                $search_form = wpestate_show_search_field_classic_form('main',$action_select_list,$categ_select_list ,$select_city_list,$select_area_list);
                print $search_form;
            }

            if($extended_search=='yes'){
               show_extended_search('adv');
            }
            ?>
        </div>
       
        <input name="submit" type="submit" class="wpresidence_button" id="advanced_submit_2" value="<?php _e('SEARCH PROPERTIES','wpestate');?>">
        <?php if ($adv_search_type!=2) { ?>
        <div id="results">
            <?php _e('We found ','wpestate'); ?> <span id="results_no">0</span> <?php _e('results.','wpestate'); ?>  
            <span id="showinpage"> <?php _e('Do you want to load the results now ?','wpestate');?> </span>
        </div>
        <?php } ?>
		<input type = 'hidden' name = 'google_city' value = '' id = 'google_srch_city'/>
		<input type = 'hidden' name = 'google_county' value = '' id = 'google_srch_county' />
    </form>   
       <div style="clear:both;"></div>
</div>
<script>
	jQuery(function () {
	  jQuery('[data-toggle="tooltip"]').tooltip()
	});
	
	jQuery('.checkboxContainer input[type=checkbox]').click(function(){
		var selGender = '';
		if(jQuery('input[name=adv_categ_male]').is(':checked')){
			selGender +='male';
		}
		if(jQuery('input[name=adv_categ_female]').is(':checked')){
			selGender +='|female';
		}
		if(jQuery('input[name=adv_categ_neutral]').is(':checked')){
			selGender +='|any';
		}
		selGender = selGender.replace(/^\||\|$/g,'');
		if(selGender == ''){
			selGender = 'All';
		}
		jQuery('input[name=selGender]').val(selGender);
	});
	jQuery('.increment').click(function() {
		var val;
		jQuery('#counter, #property-bedrooms').val(function(i, val) { 
			if(val > 4){
				return 'All';
			}
			if(val == 'All'){
				val = 0;
			}
			return parseInt(val) + 1;
		});
		jQuery('#property-bedrooms').trigger("input");
		jQuery('#property-bedrooms').data('value', val);
	});
	
	jQuery('.decrement').click(function() {
		var val;
		jQuery('#counter, #property-bedrooms').val(function(i, val) { 
			if(val < 2){
				return 'All';
			}
			if(val == 'All'){
				val = 6;
			}
			return parseInt(val) - 1;
		});
		jQuery('#property-bedrooms').trigger("input");
		jQuery('#property-bedrooms').data('value', val);
	});
	
</script>
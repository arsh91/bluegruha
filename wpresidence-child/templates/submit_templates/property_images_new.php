<?php
global $action;
global $edit_id;
$images='';
$thumbid='';
$attachid='';
$floor_link                     =   get_dasboard_floor_plan();
$floor_link                     =   esc_url_raw ( add_query_arg( 'floor_edit', $edit_id, $floor_link) ) ;
$use_floor_plans                =   get_post_meta($edit_id, 'use_floor_plans', true);
   
if ($action=='edit'){
    wp_reset_postdata();wp_reset_query();
    $arguments = array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'post_status' =>'any',
        'post_parent' => $edit_id,
        'orderby' => 'menu_order',
        'order' => 'ASC'
      );
    

    $post_attachments = get_posts($arguments);
    $post_thumbnail_id = $thumbid = get_post_thumbnail_id( $edit_id );
 

   
    foreach ($post_attachments as $attachment) {
        $preview =  wp_get_attachment_image_src($attachment->ID, 'user_picture_profile');    
        
        if($preview[0]!=''){
            $images .=  '<div class="uploaded_images" data-imageid="'.$attachment->ID.'"><img src="'.$preview[0].'" alt="thumb" /><i class="fa fa-trash-o"></i>';
            if($post_thumbnail_id == $attachment->ID){
                $images .='<i class="fa thumber fa-star"></i>';
            }
        }else{
            $images .=  '<div class="uploaded_images" data-imageid="'.$attachment->ID.'"><img src="'.get_template_directory_uri().'/img/pdf.png" alt="thumb" /><i class="fa fa-trash-o"></i>';
            if($post_thumbnail_id == $attachment->ID){
                $images .='<i class="fa thumber fa-star"></i>';
            }
        }
        
        
        $images .='</div>';
        $attachid.= ','.$attachment->ID;
    }
}

?>
	<div class="col-md-12 headingPanel">
		<h3>Listing Media</h3>
	</div>
	<div class="submit_container col-md-12">
	<!--<div class="submit_container_header"><?php //_e('Listing Media','wpestate');?></div>-->
		<div id="upload-container">                 
			<div id="aaiu-upload-container">                 
				<div id="aaiu-upload-imagelist">
					<ul id="aaiu-ul-list" class="aaiu-upload-list"></ul>
				</div>

				<div id="imagelist">
				<?php 
					if($images!=''){
						print $images;
					}
				
					if ( isset($_POST['attachid']) && $_POST['attachid']!=''){
						$attchs=explode(',',$_POST['attachid']);
						$attachid='';
						foreach($attchs as $att_id){
							if( $att_id!='' && is_numeric($att_id) ){
								$attachid .= $att_id.',';
								$preview =  wp_get_attachment_image_src($att_id, 'user_picture_profile');    
			
								if($preview[0]!=''){
									$images .=  '<div class="uploaded_images" data-imageid="'.$att_id.'"><img src="'.$preview[0].'" alt="thumb" /><i class="fa fa-trash-o"></i>';
								   
								}else{
									$images .=  '<div class="uploaded_images" data-imageid="'.$att_id.'"><img src="'.get_template_directory_uri().'/img/pdf.png" alt="thumb" /><i class="fa fa-trash-o"></i>';
								   
								}
								$images .='</div>';
							}
					
						}
						print $images;
					}
					
				?>  
				</div>
			  
				<button id="aaiu-uploader"  class="wpresidence_button wpresidence_success">
					<?php _e('Select Media','wpestate');?>
				</button>
				<input type="hidden" name="attachid" id="attachid" value="<?php echo esc_html($attachid);?>">
				<input type="hidden" name="attachthumb" id="attachthumb" value="<?php echo esc_html($thumbid);?>">
				<?php 
				//_e('* At least 1 image is required for a valid submission.Minimum size is 500/500px.','wpestate');
				$max_images=intval   ( get_option('wp_estate_prop_image_number','') );
				if($max_images!=0){ ?>
					<p class="full_form full_form_image">
				<?php
					printf( __(' You can upload maximum %s images','wpestate'),$max_images);
				?>
				</p>
				<?php
				}
				//_e('** Double click on the image to select featured.','wpestate');print '</br>';
				//_e('*** Change images order with Drag & Drop.','wpestate');print '</br>';
				//_e('**** PDF files upload supported as well.','wpestate');?>
			</div>  
		</div>
		<?php
		if ($action=='edit'){
		?>
			<a href="<?php echo esc_url($floor_link);?>" class="wpb_button manage_floor wpb_btn-success wpb_btn-large vc_button" target="_blank"><?php _e('manage floorplans','wpestate');?></a>

		<?php
		}
		?>
		</div>
	</div>
<script type="text/javascript">
    var current_no_up;
    jQuery(document).ready(function($) {
    "use strict";
	delete_binder();
    var array_cut;
    var should_warn=0;
    current_no_up=  parseInt( $('.uploaded_images ').length,10);
    array_cut=0;
 
    //wpestate_allow_upload(current_no_up,ajax_vars.max_images);
  
    if (typeof(plupload) !== 'undefined') {
            var uploader = new plupload.Uploader(ajax_vars.plupload);
            uploader.init();
            uploader.bind('FilesAdded', function (up, files) {
            
                //current_no_up=current_no_up+ajax_vars.max_images;
            
                
                if(ajax_vars.max_images>0){ // if is not unlimited
                    if(current_no_up===0){
                        array_cut=ajax_vars.max_images;
                        if(files.length>ajax_vars.max_images){
                            current_no_up=array_cut;
                        }else{
                            current_no_up=files.length;
                        }
                    }else{
                        if (current_no_up>=ajax_vars.max_images){
                            array_cut=-1;
                        }else{
                            array_cut=ajax_vars.max_images-current_no_up;
                            if(files.length>array_cut){
                                current_no_up=current_no_up+array_cut;
                            }else{
                                current_no_up=current_no_up+files.length;
                            }
                          
                        }
                    }
                  
                  
                    if(array_cut>0 ){
                        up.files.slice(0,array_cut);
                        files.slice(0,array_cut);   
                        var i = array_cut;
                        while (files.length>array_cut){
                            up.files.pop();
                            files.pop();  
                            should_warn=1;
                        }
                    }
                    
                    if(should_warn===1){
                        $('.image_max_warn').remove();
                        $('#imagelist').before('<div class="image_max_warn" style="width:100%;float:left;">'+ajax_vars.warning_max+'</div>');
                    }
                    
                    if( array_cut==-1 ){
                        $('.image_max_warn').remove();
                        $('#imagelist').before('<div class="image_max_warn" style="width:100%;float:left;">'+ajax_vars.warning_max+'</div>');
                        files=[];
                        up=[];
                        return;
                    }

                }
                
                $.each(files, function (i, file) {
                        $('#aaiu-upload-imagelist').append(
                        '<div id="' + file.id + '">' +
                        file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
                        '</div>');
                });

                up.refresh(); // Reposition Flash/Silverlight
                uploader.start();
               
            });

            uploader.bind('UploadProgress', function (up, file) {
                $('#' + file.id + " b").html(file.percent + "%");
            });

            // On erro occur
            uploader.bind('Error', function (up, err) {
				if(err.code == '-600'){
					$('#aaiu-upload-imagelist').append("<div> Please upload image size of less than 2MB.</div>");
				}else{
					$('#aaiu-upload-imagelist').append("<div>Error: " + err.code +
						", Message: " + err.message +
						(err.file ? ", File: " + err.file.name : "") +
						"</div>"
					);   
				}
                up.refresh(); // Reposition Flash/Silverlight
            });



            uploader.bind('FileUploaded', function (up, file, response) {
                var result = $.parseJSON(response.response);
                $('#image_warn').remove();
                $('#' + file.id).remove();
                if (result.success) {               
                                       
                    var all_id=$('#attachid').val();
                    all_id=all_id+","+result.attach;
                    $('#attachid').val(all_id);
                            
                    if (result.html!==''){
                        if(ajax_vars.is_floor === '1'){
                            $('#no_plan_mess').remove();
                            $('#imagelist').append('<div class="uploaded_images floor_container" data-imageid="'+result.attach+'"><input type="hidden" name="plan_image_attach[]" value="'+result.attach+'"><input type="hidden" name="plan_image[]" value="'+result.html+'"><img src="'+result.html+'" alt="thumb" /><i class="fa deleter fa-trash-o"></i>'+to_insert_floor+'</div>');
                    
                        }else{
                            $('#imagelist').append('<div class="uploaded_images" data-imageid="'+result.attach+'"><img src="'+result.html+'" alt="thumb" /><i class="fa deleter fa-trash-o"></i> </div>');
                        }
                        
                    }else{
                        $('#imagelist').append('<div class="uploaded_images" data-imageid="'+result.attach+'"><img src="'+ajax_vars.path+'/img/pdf.png" alt="thumb" /><i class="fa deleter fa-trash-o"></i> </div>');
                    
                    }
                    $( "#imagelist" ).sortable({
                        revert: true,
                        update: function( event, ui ) {
                            var all_id,new_id;
                            all_id="";
                            $( "#imagelist .uploaded_images" ).each(function(){
                                
                                new_id = $(this).attr('data-imageid'); 
                                if (typeof new_id != 'undefined') {
                                    all_id=all_id+","+new_id; 
                                   
                                }
                               
                            });
                          
                            $('#attachid').val(all_id);
                        },
                    });
 
                       
                    delete_binder();
                    thumb_setter();
                    max_image_checker_remove();
                }else{
                    
                    if (result.image){ 
                        $('#imagelist').before('<div id="image_warn" style="width:100%;float:left;">'+ajax_vars.warning+'</div>');
                    }
                }
            });
            
            
            jQuery('#aaiu-uploader').click(function (e) {
                uploader.splice();
                uploader.refresh();
            });
     
            $('#aaiu-uploader2').click(function (e) {
                uploader.start();
                e.preventDefault();
            });
                  
            $('#aaiu-uploader-floor').click(function (e) {
                e.preventDefault();
                $('#aaiu-uploader').trigger('click');
            });      
            uploader.splice();
            uploader.refresh();
                     
 }
    uploader.splice();
    uploader.refresh();
 });

function max_image_checker_remove(){

}

 function thumb_setter(){
  
    jQuery('#imagelist img').dblclick(function(){
    
        jQuery('#imagelist .uploaded_images .thumber').each(function(){
            jQuery(this).remove();
        });

        jQuery(this).parent().append('<i class="fa thumber fa-star"></i>')
        jQuery('#attachthumb').val(   jQuery(this).parent().attr('data-imageid') );
    });   
 }
 
 
 
 function delete_binder(){
    jQuery('#imagelist i.fa-trash-o').unbind('click');
    jQuery('#imagelist i.fa-trash-o').click(function(){
        var curent='';
        var remove='';
        var img_remove= jQuery(this).parent().attr('data-imageid')
        current_no_up=current_no_up-1;
       
        jQuery(this).parent().remove();

        jQuery('#imagelist .uploaded_images').each(function(){
            remove  =   jQuery(this).attr('data-imageid');
            curent  =   curent+','+remove; 
         
        });
        jQuery('#attachid').val(curent); 
          
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action'            :   'wpestate_delete_file',
                'attach_id'     :   img_remove,
                
            },
            success: function (data) {     
               // console.log(data);

            },
            error: function (errorThrown) {  console.log(errorThrown);}
        });//end ajax     
      
    });
           
 }
</script>
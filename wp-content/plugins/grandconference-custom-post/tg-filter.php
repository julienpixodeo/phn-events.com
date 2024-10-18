<?php
//Add upload form to page
if (is_admin()) {
  $current_admin_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);

  if ($current_admin_page == 'post' || $current_admin_page == 'post-new')
  {
 
    /** Need to force the form to have the correct enctype. */
    function grandconference_add_post_enctype() {
      echo "<script type=\"text/javascript\">
        jQuery(document).ready(function(){
        jQuery('#post').attr('enctype','multipart/form-data');
        jQuery('#post').attr('encoding', 'multipart/form-data');
        });
        </script>";
    }
 
    add_action('admin_head', 'grandconference_add_post_enctype');
  }
}

add_action( 'edit_form_after_title', 'grandconference_content_builder_enable');

function grandconference_content_builder_enable ($post) 
{
	//Check if enable content builder
	$ppb_enable = get_post_meta($post->ID, 'ppb_enable');
	$enable_builder_class = '';
	$enable_classic_builder_class = '';
	
	if(!empty($ppb_enable))
	{
		$enable_builder_class = 'hidden';
		$enable_classic_builder_class = 'visible';
	}
	
	//Check if user edit page
	$page_id = '';
	
	if (isset($_GET['action']) && $_GET['action'] == 'edit')
	{
		$page_id = $post->ID;
	}

	//Display only on page and portfolio
	if($post->post_type == 'page' OR $post->post_type == 'portfolios')
	
    echo '<a href="javascript:;" id="enable_builder" class="'.esc_attr($enable_builder_class).'" data-page-id="'.esc_attr($page_id).'"><i class="fa fa-th-list"></i>'.esc_html__('Edit in Content Builder', 'grandconference' ).'</a>';
    echo '<a href="javascript:;" id="enable_classic_builder" class="'.esc_attr($enable_classic_builder_class).'"><i class="fa fa-edit"></i>'.esc_html__('Edit in Classic Editor', 'grandconference' ).'</a>';
}

if ( ! function_exists( 'grandconference_theme_kirki_update_url' ) ) {
    function grandconference_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_template_directory_uri() . '/modules/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'grandconference_theme_kirki_update_url' );

add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Title_Control extends WP_Customize_Control {
		public $type = 'title';
		public function render_content() { 
			echo $this->label;
		}
	}
	// Register our custom control with Kirki
	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['title'] = 'Kirki_Controls_Title_Control';
		return $controls;
	} );

} );

//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

/**
*	Setup AJAX portfolio content builder function
**/
add_action('wp_ajax_grandconference_ppb', 'grandconference_ppb');
add_action('wp_ajax_nopriv_grandconference_ppb', 'grandconference_ppb');

function grandconference_ppb() {
	if(is_admin() && isset($_GET['shortcode']) && !empty($_GET['shortcode']))
	{
		require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
		
		if(isset($ppb_shortcodes[$_GET['shortcode']]) && !empty($ppb_shortcodes[$_GET['shortcode']]))
		{
			$selected_shortcode = $_GET['shortcode'];
			$selected_shortcode_arr = $ppb_shortcodes[$_GET['shortcode']];
			
			//get action value
			$ppb_builder_remove_id = '';
			if(isset($_GET['builder_action']) && isset($_GET['builder_action']) == 'add')
			{
				$ppb_builder_remove_id = $_GET['rel'];
			}
?>
			<!-- Display button for this content -->
			<div class="ppb_inline_title_bar">
				<h2><?php echo esc_html($selected_shortcode_arr['title']); ?></h2>
			</div>
			
			<div class="ppb_inline_wrap">
			    <a id="save_<?php echo esc_attr($_GET['rel']); ?>" data-parent="ppb_inline_<?php echo esc_attr($selected_shortcode); ?>" class="button ppb_inline_save" href="javascript:;"><?php esc_html_e('Update', 'grandconference' ); ?></a>
			    
			    <a class="button" href="javascript:;" onClick="cancelContent('<?php echo esc_attr($ppb_builder_remove_id); ?>');"><?php esc_html_e('Cancel', 'grandconference' ); ?></a>
			    
			</div>
			
			<div id="ppb_inline_<?php echo esc_attr($selected_shortcode); ?>" data-shortcode="<?php echo esc_attr($selected_shortcode); ?>" class="ppb_inline">
			<div class="ppb_inline_option_wrap">
				<?php
					if(isset($selected_shortcode_arr['title']) && $selected_shortcode_arr['title']!='Divider')
					{
				?>
				<div class="ppb_inline_option">
					
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_title"><?php esc_html_e('Title', 'grandconference' ); ?></label><br/>
						<span class="label_desc"><?php esc_html_e('Enter Title for this content', 'grandconference' ); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input type="text" id="<?php echo esc_attr($selected_shortcode); ?>_title" name="<?php echo esc_attr($selected_shortcode); ?>_title" data-attr="title" value="Title" class="ppb_input"/>
					</div>
				</div>
				<br/>
				<?php
					}
					else
					{
				?>
				<input type="hidden" id="<?php echo esc_attr($selected_shortcode); ?>_title" name="<?php echo esc_attr($selected_shortcode); ?>_title" data-attr="title" value="<?php echo esc_attr($selected_shortcode_arr['title']); ?>" class="ppb_input"/>
				<?php
					}
				?>
				
				<?php
					$num_attr = count($selected_shortcode_arr['attr']);
					$i_count = 0;
				
					foreach($selected_shortcode_arr['attr'] as $attr_name => $attr_item)
					{
						$last_class = '';
						if(++$i_count === $num_attr)
						{
							$last_class = 'last';
						}
					
						if(!isset($attr_item['title']))
						{
							$attr_title = ucfirst($attr_name);
						}
						else
						{
							$attr_title = $attr_item['title'];
						}
					
						if($attr_item['type']=='jslider')
						{
				?>
				<div class="ppb_inline_option">
				
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="range" class="ppb_input" min="<?php echo esc_attr($attr_item['min']); ?>" max="<?php echo esc_attr($attr_item['max']); ?>" step="<?php echo esc_attr($attr_item['step']); ?>" value="<?php echo esc_attr($attr_item['std']); ?>" /><output for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" onforminput="value = foo.valueAsNumber;"></output><br/>
					</div>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="jslider"/>
				</div>
				<br/>
				<?php
						}
				
						if($attr_item['type']=='file')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text"  class="ppb_input ppb_file" />
						<a id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" type="button" class="metabox_upload_btn button" rel="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>">Upload</a>
						<img id="image_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="ppb_file_image" />
					</div>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="file"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='select')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<select name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="ppb_input">
						<?php
								foreach($attr_item['options'] as $attr_key => $attr_item_option)
								{
						?>
								<option value="<?php echo esc_attr($attr_key); ?>"><?php echo ucfirst($attr_item_option); ?></option>
						<?php
								}
						?>
						</select>
					</div>	
					<br style="clear:both"/>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="select"/>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="select"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='select_multiple')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<select name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="ppb_input" multiple="multiple">
						<?php
								foreach($attr_item['options'] as $attr_key => $attr_item_option)
								{
									if(!empty($attr_item_option))
									{
						?>
									<option value="<?php echo esc_attr($attr_key); ?>"><?php echo ucfirst($attr_item_option); ?></option>
						<?php
									}
								}
						?>
						</select>
					</div>
					<br style="clear:both"/>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="select_multiple"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='margin')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<strong><?php esc_html_e('top', 'grandconference' ); ?></strong>&nbsp;
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_top" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_top" type="text" class="ppb_input type_margin" />&nbsp;px&nbsp;
						&nbsp;
						<strong><?php esc_html_e('bottom', 'grandconference' ); ?></strong>&nbsp;
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_bottom" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_bottom" type="text" class="ppb_input type_margin" />&nbsp;px&nbsp;
						<br/>
						<strong><?php esc_html_e('left', 'grandconference' ); ?></strong>&nbsp;
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_left" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_left" type="text" class="ppb_input type_margin" />&nbsp;px&nbsp;
						&nbsp;
						<strong><?php esc_html_e('right', 'grandconference' ); ?></strong>&nbsp;
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_right" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_right" type="text" class="ppb_input type_margin" />&nbsp;px&nbsp;
					
						<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="margin"/>
					</div>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='text')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text" class="ppb_input" />
					
						<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="text"/>
					</div>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='date')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="date" class="ppb_input" />
					
						<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="text"/>
					</div>
				</div>
				<br/>
				<?php
						}
								
						if($attr_item['type']=='colorpicker')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text" class="ppb_input color_picker" />
						<div id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo esc_js($selected_shortcode); ?>_<?php echo esc_js($attr_name); ?>').click()" style="background-color:<?php echo esc_attr($attr_item['std']); ?>;background-image: url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png);margin-top:3px">&nbsp;</div><br style="clear:both"/>
					</div>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="colorpicker"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='textarea')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<textarea name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" cols="" rows="3" class="ppb_input type_textarea"></textarea>
					</div>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="textarea"/>
				</div>
				<br/>
				<?php
						}
					}
				?>
				
				<?php
					if($attr_item['type']=='visual_editor')
					{
				?>
					<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_content"><?php esc_html_e('Content', 'grandconference' ); ?></label><br/>
						<span class="label_desc"><?php esc_html_e('You can enter text, HTML for its content', 'grandconference' ); ?></span><br/><br/>
						
						<textarea id="<?php echo esc_attr($selected_shortcode); ?>_content" name="<?php echo esc_attr($selected_shortcode); ?>_content" cols="" rows="5" class="ppb_input <?php if($_GET['builder_action'] == 'add') { ?>ppb_textarea<?php } ?>"></textarea>
						
						<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="content"/>
					</div>
				<?php
					}
				?>
				
				<?php
					if(isset($selected_shortcode_arr['content']) && $selected_shortcode_arr['content'])
					{
				?>
					<div class="ppb_inline_option <?php echo esc_attr($last_class); ?> content_option">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_content"><?php esc_html_e('Content', 'grandconference' ); ?></label><br/>
						<span class="label_desc"><?php esc_html_e('You can enter text, HTML for its content', 'grandconference' ); ?></span><br/><br/>
						
						<textarea id="<?php echo esc_attr($selected_shortcode); ?>_content" name="<?php echo esc_attr($selected_shortcode); ?>_content" cols="" rows="5" class="ppb_input <?php if($_GET['builder_action'] == 'add') { ?>ppb_textarea<?php } ?>"></textarea>
						
						<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="content"/>
					</div>
				<?php
					}
				?>
			</div>
		</div>
		
		<script>
		jQuery(document).ready(function(){
			var formfield = '';
			
			ppbSetUnsaveStatus();
			
			if(jQuery('body').hasClass('ppb_duplicated'))
			{
				jQuery('.fancybox-inner .ppb_inline_wrap').addClass('duplicated');
			}
	
			jQuery('.metabox_upload_btn').click(function() {
			    jQuery('.fancybox-overlay').css('visibility', 'hidden');
			    jQuery('.fancybox-wrap').css('visibility', 'hidden');
		     	formfield = jQuery(this).attr('rel');
			    
			    var send_attachment_bkp = wp.media.editor.send.attachment;
			    wp.media.editor.send.attachment = function(props, attachment) {
			     	jQuery('#'+formfield).val(attachment.url);
			     	jQuery('#image_'+formfield).attr('src', attachment.url);
			
			        wp.media.editor.send.attachment = send_attachment_bkp;
			        jQuery('.fancybox-overlay').css('visibility', 'visible');
			     	jQuery('.fancybox-wrap').css('visibility', 'visible');
			    }
			
			    wp.media.editor.open();
		     	return false;
		    });
		
			jQuery("#ppb_inline :input").each(function(){
				if(typeof jQuery(this).attr('id') != 'undefined')
				{
					 jQuery(this).attr('value', '');
				}
			});
			
			var currentItemData = jQuery('#<?php echo esc_js($_GET['rel']); ?>').data('ppb_setting');
			var currentItemOBJ = jQuery.parseJSON(currentItemData);
			
			jQuery.each(currentItemOBJ, function(index, value) { 
			  	if(typeof jQuery('#'+index) != 'undefined' && jQuery('#'+index).length > 0)
				{
					jQuery('#'+index).val(decodeURI(value));
					
					if(jQuery('#'+index).is('textarea') && jQuery('#'+index).hasClass('ppb_input') && !jQuery('#'+index).hasClass('type_textarea'))
					{
					    jQuery('#'+index).html(decodeURI(value));
					    jQuery('#'+index).wp_editor();
					}
					
					if(jQuery('#'+index).is('textarea') && jQuery('#'+index).hasClass('ppb_input') && jQuery('#'+index).hasClass('type_textarea'))
					{
					    jQuery('#'+index).html(decodeURI(value));
					}
					
					//Check if color picker
					if(jQuery('#'+index).hasClass('color_picker'))
					{
						var inputID = jQuery('#'+index).attr('id');
						jQuery('#'+inputID+'_bg').css('backgroundColor', jQuery('#'+index).val());
					}
					
					//Check if input file
					if(jQuery('#type_'+index).val()=='file')
					{
						jQuery('#image_'+index).attr('src', value);
					}
					
					//Check if input video
					if(jQuery('#type_'+index).val()=='video')
					{
						jQuery('#video_view_'+index).attr('href', value);
					}
					
					//Check if multiple select
					if(jQuery('#type_'+index).val()=='select_multiple')
					{
						var data = value + '';
						var data_array = data.split(",");
						jQuery('#'+index).val(data_array);
					}
				}
			});
			
			jQuery('.color_picker').each(function()
			{	
			    var inputID = jQuery(this).attr('id');
			    
			    jQuery(this).ColorPicker({
			    	color: jQuery(this).val(),
			    	onShow: function (colpkr) {
			    		jQuery(colpkr).fadeIn(200);
			    		return false;
			    	},
			    	onHide: function (colpkr) {
			    		jQuery(colpkr).fadeOut(200);
			    		return false;
			    	},
			    	onChange: function (hsb, hex, rgb, el) {
			    		jQuery('#'+inputID).val('#' + hex);
			    		jQuery('#'+inputID+'_bg').css('backgroundColor', '#' + hex);
			    	}
			    });	
			    
			    jQuery(this).css('width', '200px');
			    jQuery(this).css('float', 'left');
			});
			
			var el, newPoint, newPlace, offset;
 
			 jQuery("input[type='range']").change(function() {
			 
			   el = jQuery(this);
			   
			   width = el.width();
			   newPoint = (el.val() - el.attr("min")) / (el.attr("max") - el.attr("min"));
			   el.next("output").text(el.val());
			 })
			 .trigger('change');
			
			jQuery("#save_<?php echo esc_js($_GET['rel']); ?>").click(function(){
				//Save undo data to localstorage
				ppbAddHistory('undo');
			
				tinyMCE.triggerSave();
			
			    var targetItem = '<?php echo esc_js($_GET['rel']); ?>';
			    var parentInline = jQuery(this).attr('data-parent');
			    var currentItemData = jQuery('#'+targetItem).find('.ppb_setting_data').val();
			    var currentShortcode = jQuery('#'+parentInline).attr('data-shortcode');
			    
			    var itemData = {};
			    itemData.id = targetItem;
			    itemData.shortcode = currentShortcode;
			    
			    jQuery("#"+parentInline+" :input.ppb_input").each(function(){
			     	if(typeof jQuery(this).attr('id') != 'undefined')
			     	{	
			    	 	if(jQuery(this).attr('multiple') != 'multiple')
			     		{
			    	 		itemData[jQuery(this).attr('id')] = encodeURI(jQuery(this).val());
			    	 	}
			    	 	else
			    	 	{
				    	 	itemData[jQuery(this).attr('id')] = jQuery(this).val();
			    	 	}
			    	 	
				    	 if(jQuery(this).attr('data-attr') == 'title')
				    	 {
				    	 	//Set saved module title
				    	 	var shortcodeName = jQuery('#'+targetItem).find('.title').find('.shortcode_title').html();
				    	 	
				    	 	var updatedShortcodeTitle = '<div class="shortcode_title">'+shortcodeName+'</div>'+decodeURI(jQuery(this).val());
				    	 	
				    	  	jQuery('#'+targetItem).find('.title').html(updatedShortcodeTitle);
				    	  	
				    	  	if(jQuery('#'+targetItem).find('.ppb_unsave').length==0)
				    	  	{
				    	  		ppbSetUnsaveStatus();
				    	  	}
				    	 }
			     	}
			    });
			    
			    var currentItemDataJSON = JSON.stringify(itemData);
			    jQuery('#'+targetItem).data('ppb_setting', currentItemDataJSON);
			    
			    //If in live mode
				if(isLiveMode())
				{
					//Save all content
					ppbSaveAll();
					
					//Set preview frame data
					ppbSetPreviewData();
						
					//Reload preview frame
					ppbReloadPreview();
				}
			    
			    refreshBuilderBlockEvents();
			    
			    jQuery.fancybox.close();
			});
			
			jQuery.fancybox.hideLoading();
		});
		</script>
<?php
		}
	}
	
	die();
}

/**
*	Setup AJAX portfolio content builder preview function
**/
add_action('wp_ajax_grandconference_ppb_preview', 'grandconference_ppb_preview');
add_action('wp_ajax_nopriv_grandconference_ppb_preview', 'grandconference_ppb_preview');

function grandconference_ppb_preview() {
	if(is_admin() && isset($_GET['page_id']) && !empty($_GET['page_id']) && isset($_GET['rel']) && !empty($_GET['rel']))
	{
		$page_id = $_GET['page_id'];
		$page_title = $_GET['title'];
		$ppb_form_item = $_GET['rel'];
		$preview_url = get_permalink($page_id);
		$preview_url.= '?ppb_preview=true&rel='.$ppb_form_item;
?>
	<iframe id="ppb_preview_frame" src="<?php echo esc_url($preview_url); ?>"></iframe>
<?php
	}
	die();
}

/**
*	Setup AJAX portfolio content builder preview page function
**/
add_action('wp_ajax_grandconference_ppb_preview_page', 'grandconference_ppb_preview_page');
add_action('wp_ajax_nopriv_grandconference_ppb_preview_page', 'grandconference_ppb_preview_page');

function grandconference_ppb_preview_page() {
	if(is_admin() && isset($_GET['page_id']) && !empty($_GET['page_id']))
	{
		$page_id = $_GET['page_id'];
		$page_title = get_the_title($page_id);
		$preview_url = get_permalink($page_id);
		$preview_url.= '?ppb_preview_page=true';
?>
	<iframe id="ppb_preview_frame" src="<?php echo esc_url($preview_url); ?>"></iframe>
<?php
	}
	die();
}


/**
*	Setup content builder set data for preview page function
**/
add_action('wp_ajax_grandconference_ppb_preview_page_set_data', 'grandconference_ppb_preview_page_set_data');
add_action('wp_ajax_nopriv_grandconference_ppb_preview_page_set_data', 'grandconference_ppb_preview_page_set_data');

function grandconference_ppb_preview_page_set_data() {
	
	if(is_admin() && isset($_POST['page_id']) && !empty($_POST['page_id']))
	{
		$page_id = $_POST['page_id'];
		$data = mb_convert_encoding($_POST['data'],'UTF-8','UTF-8');
		$data = json_decode($_POST['data']);
		$data_order = $_POST['data_order'];
		
		//Set data order to WordPress cache
		set_transient('grandconference_'.$page_id.'_data_order', $data_order, 3600 );
		
		//Convert order data to array
		$ppb_form_item_arr = array();
		if(!empty($data_order))
		{
		    $ppb_form_item_arr = explode(',', $data_order);
		}
		
		if(isset($ppb_form_item_arr[0]) && !empty($ppb_form_item_arr[0]))
		{
		    $data_arr = array();
		    $size_arr = array();
		
		    foreach($ppb_form_item_arr as $key => $ppb_form_item)
		    {
		    	if(isset($_POST[$ppb_form_item.'_data']))
		    	{
			    	$data_arr[$ppb_form_item] = $_POST[$ppb_form_item.'_data'];
			    	$size_arr[$ppb_form_item] = $_POST[$ppb_form_item.'_size'];
		    	}
		    }
		}
		
		set_transient('grandconference_'.$page_id.'_data', $data_arr, 3600 );
		set_transient('grandconference_'.$page_id.'_size', $size_arr, 3600 );
?>
	
<?php
	}
	die();
}


/**
*	Setup preview demo page function
**/
add_action('wp_ajax_grandconference_ppb_demo_preview', 'grandconference_ppb_demo_preview');
add_action('wp_ajax_nopriv_grandconference_ppb_demo_preview', 'grandconference_ppb_demo_preview');

function grandconference_ppb_demo_preview() {
	if(is_admin() && isset($_POST['key']) && !empty($_POST['key']))
	{
		require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
		
		if(isset($ppb_shortcodes[$_POST['key']]))
		{
			$page_title = $ppb_shortcodes[$_POST['key']]['title'];
			$preview_url = $ppb_shortcodes[$_POST['key']]['url'];
?>
	<div class="ppb_inline_wrap preview">
	    <h2><?php esc_html_e('Preview', 'grandconference' ); ?> <?php echo urldecode($page_title); ?></h2>
	    <a class="button button-primary" href="javascript:;" onClick="jQuery.fancybox.close();"><?php esc_html_e('Close', 'grandconference' ); ?></a>
	</div>	
	<iframe id="ppb_preview_frame" src="<?php echo esc_url($preview_url); ?>"></iframe>
<?php
		}
	}
	die();
}


/**
*	Setup live preview element function
**/
add_action('wp_ajax_grandconference_ppb_get_live_preview', 'grandconference_ppb_get_live_preview');
add_action('wp_ajax_nopriv_grandconference_ppb_get_live_preview', 'grandconference_ppb_get_live_preview');

function grandconference_ppb_get_live_preview() {

	if(is_admin() && isset($_POST['data']) && !empty($_POST['data']) && isset($_POST['size']) && !empty($_POST['size']))
	{
		$ppb_form_item = $_POST['rel'];
		$ppb_form_item_size = $_POST['size'];
		$ppb_form_item_data = $_POST['data'];
		$ppb_form_item_data = mb_convert_encoding($ppb_form_item_data,'UTF-8','UTF-8');
		$ppb_form_item_data_obj = json_decode(stripslashes($ppb_form_item_data));
	    $ppb_shortcode_content_name = $_GET['shortcode'];
	    $ppb_shortcode_code = '';
	    
	    /*print '<pre>';
	    print_r($ppb_form_item_data_obj);
	    print '</pre>';*/
	    
	    $ppb_shortcodes = array();
		require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
	    
	    if(isset($ppb_form_item_data_obj->$ppb_shortcode_content_name))
	    {
	        $ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size.'" ';
	        
	        //Get shortcode title
	        $ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
	        if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
	        {
	        	$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
	        }
	        
	        //Get shortcode attributes
	        if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
	        {
	        	$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
	        	
	        	foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
	        	{
	        		$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
	        		
	        		if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
	        		{
	        			$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
	        		}
	        	}
	        }
	
	        $ppb_shortcode_code.= ']'.rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_content_name).'[/'.$ppb_form_item_data_obj->shortcode.']';
	    }
	    else
	    {
	        $ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size.'" ';
	        
	        //Get shortcode title
	        $ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
	        if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
	        {
	        	$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
	        }
	        
	        //Get shortcode attributes
	        if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
	        {
	        	$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
	        	
	        	foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
	        	{
	        		$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
	        		
	        		if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
	        		{
	        			$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
	        		}
	        	}
	        }
	        
	        $ppb_shortcode_code.= ']';
	    }
	    
	    echo do_shortcode($ppb_shortcode_code);
	}
	die();
}


/**
*	Save current as template function
**/
add_action('wp_ajax_grandconference_ppb_set_template', 'grandconference_ppb_set_template');
add_action('wp_ajax_nopriv_grandconference_ppb_set_template', 'grandconference_ppb_set_template');

function grandconference_ppb_set_template() {
	if(is_admin() && isset($_POST['template_name']) && !empty($_POST['template_name']) && isset($_GET['page_id']) && !empty($_GET['page_id']) && strlen($_POST['template_name']) >= 3)
	{
		//Get page ID
		$page_id = $_GET['page_id'];
		
		//get list of my templates in array
		$my_current_templates = get_option(GRANDCONFERENCE_SHORTNAME."_my_templates");
		
		//set new template ID and name
		$new_template_name = sanitize_text_field($_POST['template_name']);
		$new_template_id = $page_id.'_'.time();
		$my_current_templates[$new_template_id] = $new_template_name;
		
		//Update my template list
		update_option( GRANDCONFERENCE_SHORTNAME."_my_templates", $my_current_templates );
		
		//Save current page builder content to my template
		$ppb_form_data_order = get_post_meta($page_id, 'ppb_form_data_order');
		$export_options_arr = array();

		if(!empty($ppb_form_data_order))
		{
		    $export_options_arr['ppb_form_data_order'] = $ppb_form_data_order;

		    //Get each builder module data
		    $ppb_form_item_arr = explode(',', $ppb_form_data_order[0]);
		
		    foreach($ppb_form_item_arr as $key => $ppb_form_item)
		    {
		    	$ppb_form_item_data = get_post_meta($page_id, $ppb_form_item.'_data');
		    	$export_options_arr[$ppb_form_item.'_data'] = $ppb_form_item_data;
		    	
		    	$ppb_form_item_size = get_post_meta($page_id, $ppb_form_item.'_size');
		    	$export_options_arr[$ppb_form_item.'_size'] = $ppb_form_item_size;
		    }
		}
		
		update_option( GRANDCONFERENCE_SHORTNAME."_template_".$new_template_id, json_encode($export_options_arr) );
		
		//return template ID
		echo intval($new_template_id);
	}
	
	die();
}


/**
*	Remove current template function
**/
add_action('wp_ajax_grandconference_ppb_remove_template', 'grandconference_ppb_remove_template');
add_action('wp_ajax_nopriv_grandconference_ppb_remove_template', 'grandconference_ppb_remove_template');

function grandconference_ppb_remove_template() {
	if(is_admin() && isset($_GET['template_id']) && !empty($_GET['template_id']))
	{
		//get list of my templates in array
		$my_current_templates = get_option(GRANDCONFERENCE_SHORTNAME."_my_templates");
		$template_id = $_GET['template_id'];
		
		if(isset($my_current_templates[$template_id]))
		{
			//Remove template from array
			unset($my_current_templates[$template_id]);
			
			//Remove from my template list
			update_option( GRANDCONFERENCE_SHORTNAME."_my_templates", $my_current_templates );
			
			//Remove template data
			delete_option( GRANDCONFERENCE_SHORTNAME."_template_".$template_id );
			
			//display to AJAX response
			echo 1;
		}
	}
	
	die();
}


/**
*	Save page builder custom fields
**/
add_action('wp_ajax_grandconference_ppb_save_page_builder', 'grandconference_ppb_save_page_builder');
add_action('wp_ajax_nopriv_grandconference_ppb_save_page_builder', 'grandconference_ppb_save_page_builder');

function grandconference_ppb_save_page_builder() {
	if(is_admin() && isset($_POST['data_order']) && isset($_GET['page_id']) && !empty($_GET['page_id']))
	{
		$page_id = $_GET['page_id'];
		
		 //Get builder item
	    $ppb_form_data_order = $_POST['data_order'];
	    $ppb_form_item_arr = array();
	    
	    if(isset($ppb_form_data_order))
	    {
	    	$ppb_form_item_arr = explode(',', $ppb_form_data_order);
	    }
	    
	    if(!empty($ppb_form_item_arr))
	    {
	    	update_post_meta($page_id, 'ppb_form_data_order', $ppb_form_data_order);
	    
	    	foreach($ppb_form_item_arr as $key => $ppb_form_item)
	    	{
	    		if(isset($_POST[$ppb_form_item.'_data']) && $_POST[$ppb_form_item.'_data'] != 'undefined')
		    	{
	    			update_post_meta($page_id, $ppb_form_item.'_data', $_POST[$ppb_form_item.'_data']);
	    		}
	    		
	    		if(isset($_POST[$ppb_form_item.'_size']) && $_POST[$ppb_form_item.'_size'] != 'undefined')
	    		{
	    			update_post_meta($page_id, $ppb_form_item.'_size', $_POST[$ppb_form_item.'_size']);
	    		}
	    	}
	    }
	}
	
	die();
}


/**
*	Save page custom fields
**/
add_action('wp_ajax_grandconference_ppb_save_page_custom_field', 'grandconference_ppb_save_page_custom_field');
add_action('grandconference_ppb_save_page_custom_field', 'grandconference_ppb_save_page_custom_field');

function grandconference_ppb_save_page_custom_field() {
	if(is_admin() && isset($_GET['page_id']) && !empty($_GET['page_id']) && isset($_POST['field']) && !empty($_POST['field']) && isset($_POST['data']))
	{
		echo intval($page_id);
		$page_id = $_GET['page_id'];
		update_post_meta($page_id, $_POST['field'], $_POST['data']);
	}
	
	die();
}
?>
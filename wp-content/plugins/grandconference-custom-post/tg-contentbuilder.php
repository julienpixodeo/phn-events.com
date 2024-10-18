<?php
function ppb_text_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'width' => '100',
		'padding' => 30,
		'bgcolor' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	
	if($size!='one')
	{
		$return_html.= '<div class="standard_wrapper">';
	}

	//Set main shortcode div content
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_text"';
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).' !important;';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(rawurldecode($width)).'%">';
	}
	$return_html.= do_shortcode(grandconference_apply_content($content));
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	if($size!='one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_text', 'ppb_text_func');


function ppb_text_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'width' => '100',
		'padding' => 30,
		'bgcolor' => '',
		'fontcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	
	if($size!='one')
	{
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_text"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).' !important;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= do_shortcode(grandconference_apply_content($content));
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	if($size!='one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_text_fullwidth', 'ppb_text_fullwidth_func');


function ppb_text_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'width' => '100',
		'padding' => 30,
		'textalign' => 'left',
		'background' => '',
		'background_position' => '',
		'parallax' => 0,
		'bgcolor' => '#000000',
		'opacity' => 100,
		'fontcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	
	switch($size)
	{
		case 'one_half':
			$size = 'one_half_bg';
		break;
		
		case 'one_half last':
			$size = 'one_half_bg last';
		break;
		
		case 'one_third':
			$size = 'one_third_bg';
		break;
		
		case 'one_third last':
			$size = 'one_third_bg last';
		break;
		
		case 'two_third':
			$size = 'two_third_bg';
		break;
		
		case 'two_third last':
			$size = 'two_third_bg last';
		break;
		
		case 'one_fourth':
			$size = 'one_fourth_bg';
		break;
		
		case 'one_fourth last':
			$size = 'one_fourth_bg last';
		break;
	}

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_text_image ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
		$custom_css.= 'background-image:url('.esc_url($background).');';
	}
	
	if(!empty($parallax))
	{
		$return_html.= 'parallax ';
	}
	
	if(!empty($background_position))
	{
		$custom_css.= 'background-position: center '.esc_attr($background_position).';';
	}
	
	$return_html.= '"';
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).' !important;';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$custom_bgcolor_css = '';
	if(!empty($bgcolor))
	{
	    $ori_bgcolor = $bgcolor;
	    $opacity = $opacity/100;
	    $bgcolor = grandconference_hex_to_rgb($bgcolor);
	
	    $custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
	    $custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    $custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    
	    $return_html.= '<div class="overlay_background" style="'.esc_attr($custom_bgcolor_css).'"></div>';
	}
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if($size == 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(rawurldecode($width)).'%">';
	}
	$return_html.= do_shortcode(grandconference_apply_content($content));
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	$return_html.= '</div></div>';
	
	if($size == 'one')
	{	
		$return_html.= '</div>';
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_text_image', 'ppb_text_image_func');


function ppb_text_sidebar_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'slug' => '',
		'subtitle' => '',
		'sidebar' => '',
		'sidebar_layout' => 'left',
		'padding' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$sidebar_class = '';
	if($sidebar_layout == 'left')
	{
		$sidebar_class = 'left_sidebar';
	}
	
	$return_html = '<div '.$sec_id.' class="one withsmallpadding" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.rawurldecode($custom_css).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner"><div class="inner_wrapper">';
	
	$return_html.= '<div class="sidebar_content '.esc_attr($sidebar_class).'">';
	
	$return_html.= do_shortcode(grandconference_apply_content($content)).'</div>';
	
	//Display Sidebar
	$return_html.= '<div class="sidebar_wrapper '.esc_attr($sidebar_class).'"><div class="sidebar"><div class="content"><ul class="sidebar_widget">';
	$return_html.= grandconference_get_dynamic_sidebar(rawurldecode($sidebar));
	$return_html.= '</ul></div></div></div>';
	
	$return_html.= '</div></div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_text_sidebar', 'ppb_text_sidebar_func');


function ppb_header_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'bgcolor' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'width' => '100',
		'padding' => 30,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));

	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	if($size != 'one')
	{
		$return_html.= '<div class="standard_wrapper">';
	}

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_header ';
	
	if(!empty($layout) && $layout == 'fullwidth')
	{
		$return_html.= 'fullwidth ';
	}

	$return_html.= '"';
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($titlecolor))
	{
		$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if($size == 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($width))
	{
		$return_html.= '<div style="';
		
		if($textalign == 'center' OR $width < 100)
		{
			$return_html.= 'margin:auto;';
		}
		
		$return_html.= 'width:'.esc_attr(rawurldecode($width)).'%">';
	}
	
	//Add title and content
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
	}
	
	if(!empty($subtitle))
	{
		$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode($subtitle).'</div>';
	}
	
	if(!empty($content))
	{
		$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
	}
	
	$return_html.= '</div>';
	
	if($size == 'one')
	{
		$return_html.= '</div>';
	}
	
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	if($size != 'one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_header', 'ppb_header_func');


function ppb_header_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'width' => '100',
		'padding' => 30,
		'background' => '',
		'background_position' => '',
		'bgcolor' => '#000000',
		'opacity' => 100,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'parallax' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	if($size != 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_header ';
	
	if(!empty($parallax))
	{
		$return_html.= 'parallax ';
	}
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
		$custom_css.= 'background-image:url('.esc_url($background).');';
	}
	
	if(!empty($background_position))
	{
		$custom_css.= 'background-position: center '.esc_attr($background_position).';';
	}

	$return_html.= '"';
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$custom_bgcolor_css = '';
	if(!empty($bgcolor))
	{
	    $ori_bgcolor = $bgcolor;
	    $opacity = $opacity/100;
	    $bgcolor = grandconference_hex_to_rgb($bgcolor);
	
	    $custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
	    $custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    $custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    
	    $return_html.= '<div class="overlay_background" style="'.esc_attr($custom_bgcolor_css).'"></div>';
	}
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if($size == 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($width))
	{
		$return_html.= '<div style="';
		
		if($textalign == 'center' OR $width < 100)
		{
			$return_html.= 'margin:auto;';
		}
		
		$return_html.= 'width:'.esc_attr(rawurldecode($width)).'%">';
	}
	
	//Add title and content
	if(!empty($title))
	{
		if(!empty($titlecolor))
		{
			$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
		}
		
		$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
	}
	
	if(!empty($subtitle))
	{
		$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode($subtitle).'</div>';
	}
	
	if(!empty($content))
	{
		$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
	}
	
	$return_html.= '</div>';
	
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	if($size != 'one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_header_image', 'ppb_header_image_func');


function ppb_divider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'builder_id' => '',
	), $atts));

	//Set begin wrapper div for live builder
	$return_html= grandconference_live_builder_begin_wrapper($builder_id, 'ppb_divider');
	
	$return_html.= '<div class="divider '.esc_attr($size).'">&nbsp;</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);

	return $return_html;

}

add_shortcode('ppb_divider', 'ppb_divider_func');


function ppb_gallery_slider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'gallery' => '',
		'autoplay' => 0,
		'caption' => 0,
		'timer' => 5,
		'padding' => 0,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= do_shortcode('[tg_gallery_slider gallery_id="'.esc_attr($gallery).'" size="original" autoplay="'.esc_attr($autoplay).'" caption="'.esc_attr($caption).'" timer="'.esc_attr($timer).'" fullwidth="1"]');
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_slider', 'ppb_gallery_slider_func');


function ppb_gallery_slider_fixed_width_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'gallery' => '',
		'autoplay' => 0,
		'caption' => 0,
		'timer' => 5,
		'padding' => 0,
		'bgcolor' => '',
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper nopadding"><div class="inner">';
	
	$return_html.= do_shortcode('[tg_gallery_slider gallery_id="'.esc_attr($gallery).'" size="original" autoplay="'.esc_attr($autoplay).'" caption="'.esc_attr($caption).'"  timer="'.esc_attr($timer).'"]');
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_slider_fixed_width', 'ppb_gallery_slider_fixed_width_func');


function ppb_gallery_grid_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'gallery_id' => '',
		'layout' => 'contain',
		'columns' => 4,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'pagination' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	if(!is_numeric($columns))
	{
		$columns = 4;
	}
	
	$custom_css = '';
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_gallery_grid '.esc_attr($size).'" style="'.$custom_css.'">';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$images_arr = get_post_meta($gallery_id, 'wpsimplegallery_gallery', true);
	$all_photo_count = count($images_arr);
	
	$images_arr = grandconference_resort_gallery_img($images_arr);
	$current_photo_count = count($images_arr);
	
	$custom_id = time().rand();
	
	$wrapper_class = '';
	$grid_wrapper_class = '';
	$column_class = '';
	
	switch($columns)
	{
		case 2:
			$wrapper_class = 'two_cols';
			$grid_wrapper_class = 'classic2_cols';
			$column_class = 'one_half gallery2';
		break;
		
		case 3:
			$wrapper_class = 'three_cols';
			$grid_wrapper_class = 'classic3_cols';
			$column_class = 'one_third gallery3';
		break;
		
		case 4:
			$wrapper_class = 'four_cols';
			$grid_wrapper_class = 'classic4_cols';
			$column_class = 'one_fourth gallery4';
		break;
		
		case 5:
			$wrapper_class = 'five_cols';
			$grid_wrapper_class = 'classic5_cols';
			$column_class = 'one_fifth gallery5';
		break;
	}

	if(!empty($images_arr))
	{
		if($layout == 'contain')
		{
			$return_html.= '<div class="standard_wrapper">';
		}
	
		$return_html.= '<div id="'.$custom_id.'" class="portfolio_filter_wrapper gallery '.esc_attr($wrapper_class).' ' .esc_attr($layout).'" data-columns="'.esc_attr($columns).'">';
		
		$i = 0;
		foreach($images_arr as $key => $image)
		{
			$image_url = wp_get_attachment_image_src($image, 'original', true);
			$small_image_url = wp_get_attachment_image_src($image, 'grandconference-gallery-list', true);
			
			$image_caption = get_post_field('post_excerpt', $image);
			$image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
			
			$tg_lightbox_enable_caption = kirki_get_option('tg_lightbox_enable_caption');
			
			$return_html.= '<div class="element grid  ' .esc_attr($grid_wrapper_class).'">';
			$return_html.= '<div class="'.esc_attr($column_class).' static filterable gallery_type animated'.esc_attr($key+1).'">';
			$return_html.= '<a class="fancy-gallery" href="'.esc_url($image_url[0]).'" ';
			
			if(!empty($tg_lightbox_enable_caption)) 
			{
			    $return_html.= 'data-caption="'.esc_attr($image_caption).'" ';
			}
			
			$return_html.= '>';
			$return_html.= '<img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($image_alt).'"/>';
			
			//Get image purchase URL
			$grandconference_purchase_url = get_post_meta($image, 'grandconference_purchase_url', true);
			
			if(!empty($grandconference_purchase_url))
			{
			    $return_html.= '<a href="'.esc_url($grandconference_purchase_url).'" title="'.esc_html__('Purchase', 'grandconference-custom-post' ).'" class="button tooltip"><i class="fa fa-shopping-cart"></i></a>';
			}
			
			$return_html.= '</a>';
			$return_html.= '</div>';
			$return_html.= '</div>';
			
			$i++;
		}
		
		$return_html.= '</div>';
		
		//Check if has pagination
	    if($all_photo_count > $current_photo_count && !empty($pagination))
	    {
	    	$return_html.= '<br class="clear"/>';
	    
			switch($columns)
			{
				case 1:
					$tg_gallery_pagination = kirki_get_option('tg_gallery_pagination_one');
				break;
				
				case 2:
				default:
					$tg_gallery_pagination = kirki_get_option('tg_gallery_pagination_two');
				break;
				
				case 3:
					$tg_gallery_pagination = kirki_get_option('tg_gallery_pagination_three');
				break;
				
				case 4:
					$tg_gallery_pagination = kirki_get_option('tg_gallery_pagination_four');
				break;
				
				case 5:
					$tg_gallery_pagination = kirki_get_option('tg_gallery_pagination_five');
				break;
			}
			
			$return_html.= '<a href="javascript:;" id="infinite_load_more_'.$custom_id.'" class="infinite_load_more" data-start="'.intval($current_photo_count).'" data-items="'.intval($tg_gallery_pagination).'">'.esc_html__('Load more', 'grandconference-custom-post' ).'</a>';
			
			$return_html.= '<div id="infinite_loading_'.$custom_id.'" class="infinite_loading"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></div>';
		}
		
		if($layout == 'contain')
		{
			$return_html.= '</div>';
		}
	}
	else
	{
		$return_html.= esc_html__( 'Empty gallery item. Please make sure you have upload image to it or check the short code.', 'grandconference-custom-post' );
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_grid', 'ppb_gallery_grid_func');


function ppb_image_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'image' => '',
		'height' => 400,
		'display_caption' => 1,
		'background_position' => 'center',
		'padding' => 0,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));

	if(!is_numeric($height))
	{
		$height = 400;
	}
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' ppb_image_fullwidth" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="one withbg"';
	
	if(!empty($image))
	{
		$return_html.= ' style="background-image:url('.esc_url($image).');background-size:cover;background-position:center '.esc_attr($background_position).';height:'.esc_attr($height).'px;position:relative;"';
	}
	
	$return_html.= '>';
	$return_html.= '</div>';
	
	if(!empty($display_caption))
	{
		//Get image meta data
		$image_id = grandconference_get_image_id($image);
		$image_caption = get_post_field('post_excerpt', $image_id);
		
		if(!empty($image_caption))
		{
			$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
		}
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_fullwidth', 'ppb_image_fullwidth_func');


function ppb_image_parallax_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slug' => '',
		'image' => '',
		'height' => 80,
		'display_caption' => 1,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	if(!is_numeric($height))
	{
		$height = 80;
	}
	
	if($height > 100)
	{
		$height = 100;
	}
	
	$image_id = '';
	
	//Set begin wrapper div for live builder
	$return_html = grandconference_live_builder_begin_wrapper($builder_id);

	$return_html.= '<div '.$sec_id.' class="parallax ';
	$return_html.= '" ';
	
	if(!empty($image))
	{
		$custom_css.= 'background-image: url('.esc_url($image).');';
	}
		
	if(!empty($height))
	{
		$custom_css.= 'height:'.$height.'vh; ';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'"';
	}
	
	$return_html.= '>';
	
	$return_html.= '</div>';
	
	if(!empty($display_caption))
	{
		//Get image meta data
		$image_id = grandconference_get_image_id($image);
		$image_caption = get_post_field('post_excerpt', $image_id);
		
		if(!empty($image_caption))
		{
			$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
		}
	}

	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);

	return $return_html;
}

add_shortcode('ppb_image_parallax', 'ppb_image_parallax_func');


function ppb_image_fixed_width_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'image' => '',
		'display_caption' => 1,
		'padding' => 0,
		'lightbox' => 0,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' ppb_image_fixed_width" ';
	
	$custom_css.= 'padding-top:'.esc_attr($padding).'px;padding-bottom'.esc_attr($padding).'px;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($image))
	{
		$image_id = grandconference_get_image_id($image);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
		$return_html.= '<div class="image_classic_frame"><div class="image_wrapper">';
		
		if(!empty($lightbox))
		{
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame">';
		}
		
		$return_html.= '<img src="'.esc_url($image).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
		
		if(!empty($lightbox))
		{
			$return_html.= '</a>';
		}
		
		$return_html.= '</div>';
	}
	
	if(!empty($display_caption))
	{
		//Get image meta data
		$image_id = grandconference_get_image_id($image);
		$image_caption = get_post_field('post_excerpt', $image_id);
		
		if(!empty($image_caption))
		{
			$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
		}
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_fixed_width', 'ppb_image_fixed_width_func');


function ppb_content_half_bg_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'background' => '',
		'background_parallax' => '',
		'background_position' => '',
		'padding' => 30,
		'bgcolor' => '#000000',
		'opacity' => 100,
		'fontcolor' => '',
		'align' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'parallax' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$bgcolor = '#ffffff';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_content_half_bg ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
		$custom_css.= 'background-image:url('.esc_url($background).');';
	}
	
	$parallax_stellar = '';
	if(!empty($parallax))
	{
		$return_html.= 'parallax ';
		$parallax_stellar.= 'data-stellar-ratio="1.3"';
	}
	
	if(!empty($background_position))
	{
		$custom_css.= 'background-position: center '.esc_attr($background_position).';';
	}
	
	$return_html.= '"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($title) OR !empty($subtitle) OR !empty($content))
	{
		$custom_bgcolor_css = '';
		if(!empty($bgcolor))
		{
			$ori_bgcolor = $bgcolor;
			$opacity = $opacity/100;
			$bgcolor = grandconference_hex_to_rgb($bgcolor);
		
			$custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
			$custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
			$custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
		}
		
		$custom_css_fontcolor = '';
		$custom_css_bordercolor = '';
		$custom_css_fontitlecolor = '';
		
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
		}
	
		if($align == 'left')
		{
			$return_html.= '<div class="one_half_bg" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'" '.$parallax_stellar.'>';
		}
		else
		{
			$return_html.= '<div class="one_half_bg floatright" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'" '.$parallax_stellar.'>';
		}
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_content_half_bg', 'ppb_content_half_bg_func');


function ppb_content_center_bg_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'background' => '',
		'background_parallax' => '',
		'background_position' => '',
		'padding' => 30,
		'height' => 600,
		'bgcolor' => '#000000',
		'opacity' => 100,
		'fontcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'parallax' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$bgcolor = '#ffffff';
	}
	
	if(empty($height))
	{
		$height = 600;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_content_center_bg ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
		$custom_css.= 'background-image:url('.esc_url($background).');';
	}
	
	$parallax_stellar = '';
	if(!empty($parallax))
	{
		$return_html.= 'parallax ';
		$parallax_stellar.= 'data-stellar-ratio="1.3"';
	}
	
	if(!empty($background_position))
	{
		$custom_css.= 'background-position: center '.esc_attr($background_position).';';
	}
	
	if(!empty($height))
	{
		$custom_css.= 'height:'.intval($height).'px;';
	}
	
	$return_html.= '"';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if(!empty($title) OR !empty($subtitle) OR !empty($content))
	{
		$custom_bgcolor_css = '';
		if(!empty($bgcolor))
		{
			$ori_bgcolor = $bgcolor;
			$opacity = $opacity/100;
			$bgcolor = grandconference_hex_to_rgb($bgcolor);
		
			$custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
			$custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
			$custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
		}
		
		$custom_css_fontcolor = '';
		$custom_css_bordercolor = '';
		$custom_css_fontitlecolor = '';
		
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
		}
	
		$return_html.= '<div class="one_third" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).';padding:'.esc_attr($padding).'px;" '.$parallax_stellar.'>';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		$return_html.= '</div>';
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_content_center_bg', 'ppb_content_center_bg_func');


function ppb_image_half_fixed_width_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'image' => '',
		'align' => 1,
		'padding' => 0,
		'bgcolor' => '',
		'fontcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$custom_css_fontcolor = '';
	$custom_css_fontitlecolor = '';
	
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
	}
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if($align=='left')
	{
		$return_html.= '<div class="one_half">';
		if(!empty($image))
		{
			$image_id = grandconference_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last content_middle" style="padding:'.esc_attr($padding).'px;">';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		//Add title and content
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_half content_middle textright" style="padding:'.esc_attr($padding).'px;">';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		//Add title and content
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last">';
		if(!empty($image))
		{
			$image_id = grandconference_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_half_fixed_width', 'ppb_image_half_fixed_width_func');


function ppb_image_half_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'image' => '',
		'height' => 500,
		'align' => 1,
		'padding' => 0,
		'bgcolor' => '',
		'fontcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'parallax' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($height))
	{
		$height = 500;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$content_custom_css = '';
	if($align=='left')
	{
		$return_html.= '<div class="one_half_bg';
		
		if(!empty($parallax))
		{
			$return_html.= ' parallax';
		}
		
		$return_html.= '"';
		
		if(!empty($image))
		{
			$return_html.= ' style="background-image:url('.esc_url($image).');height:'.esc_attr($height).'px;"';
		}
		$return_html.= '></div>';
		
		$content_custom_css.= 'style="padding:'.esc_attr($padding).'px;"';
		$return_html.= '<div class="one_half_bg" '.$content_custom_css.'>';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		
		$return_html.= '</div>';
	}
	else
	{	
		$content_custom_css.= 'style="padding:'.esc_attr($padding).'px;"';
		$return_html.= '<div class="one_half_bg textright" '.$content_custom_css.'>';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
	
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half_bg';
		
		if(!empty($parallax))
		{
			$return_html.= ' parallax';
		}
		
		$return_html.= '"';
		
		if(!empty($image))
		{
			$return_html.= ' style="background-image:url('.esc_url($image).');height:'.esc_attr($height).'px;"';
		}
		$return_html.= '></div>';
	}
	
	$return_html.= '<br class="clear"/>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_half_fullwidth', 'ppb_image_half_fullwidth_func');


function ppb_image_two_third_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'image' => '',
		'height' => 500,
		'align' => 1,
		'parallax' => 0,
		'bgcolor' => '',
		'fontcolor' => '',
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($height))
	{
		$height = 500;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="ppb_image_two_third_fullwidth '.esc_attr($size).'" ';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$content_custom_css = '';
	if($align=='left')
	{
		$return_html.= '<div class="two_third_bg';
		
		if(!empty($parallax))
		{
			$return_html.= ' parallax';
		}
		
		$return_html.= '"';
		if(!empty($image))
		{
			$return_html.= ' style="background-image:url('.esc_url($image).');height:'.esc_attr($height).'px;"';
		}
		$return_html.= '></div>';
		
		$return_html.= '<div class="one_third_bg" style="height:'.esc_attr($height).'px;">';
		
		$return_html.= '<div class="center_wrapper"><div class="inner_content">';
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		//Add title and content
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		
		$return_html.= '</div>';
		$return_html.= '</div>';
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_third_bg textright" style="height:'.esc_attr($height).'px;">';
		
		$return_html.= '<div class="center_wrapper"><div class="inner_content">';
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		//Add title and content
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
	
		$return_html.= '</div>';
		$return_html.= '</div>';
		$return_html.= '</div>';
		
		$return_html.= '<div class="two_third_bg';
		
		if(!empty($parallax))
		{
			$return_html.= ' parallax';
		}
		
		$return_html.= '"';
		if(!empty($image))
		{
			$return_html.= ' style="background-image:url('.esc_url($image).');height:'.esc_attr($height).'px;"';
		}
		$return_html.= '></div>';
	}
	
	$return_html.= '<br class="clear"/>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_two_third_fullwidth', 'ppb_image_two_third_fullwidth_func');


function ppb_two_cols_images_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'display_caption' => 1,
		'padding' => 0,
		'lightbox' => 0,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' ppb_two_cols_images" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';

	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper standard_wrapper"><div class="inner">';
	
	$return_html.= '<div class="one_half">';
	if(!empty($image1))
	{
		$image_id = grandconference_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    if(!empty($lightbox))
		{	
	    	$return_html.= '<a href="'.esc_url($image1).'" class="img_frame">';
	    }
	    	$return_html.= '<img src="'.esc_url($image1).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    	
	    if(!empty($lightbox))
		{
	    	$return_html.= '</a>';
	    }
	    
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<div class="one_half last">';
	if(!empty($image2))
	{
		$image_id = grandconference_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    if(!empty($lightbox))
		{	
	    	$return_html.= '<a href="'.esc_url($image2).'" class="img_frame">';
	    }
	    	$return_html.= '<img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    	
	    if(!empty($lightbox))
		{
	    	$return_html.= '</a>';
	    }
	    
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div></div>';
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_two_cols_images', 'ppb_two_cols_images_func');


function ppb_two_cols_images_no_space_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'height' => 600,
		'parallax' => 0,
		'display_caption' => 1,
		'padding' => 0,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css = '';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner" style="padding:0;">';
	
	if(!empty($image1) && !empty($height))
	{
		$return_html.= '<div class="one_half_bg';
		
		if(!empty($parallax))
		{
			$return_html.= ' parallax';
		}
		
		$return_html.= '"';
		$return_html.= 'style="background-image:url(\''.$image1.'\');height:'.$height.'px;"';
		$return_html.= '>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	
	if(!empty($image2) && !empty($height))
	{
		$return_html.= '<div class="one_half_bg';
		
		if(!empty($parallax))
		{
			$return_html.= ' parallax';
		}
		
		$return_html.= '"';
		$return_html.= 'style="background-image:url(\''.$image2.'\');height:'.$height.'px;"';
		$return_html.= '>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_two_cols_images_no_space', 'ppb_two_cols_images_no_space_func');


function ppb_three_cols_images_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'image3' => '',
		'display_caption' => 1,
		'lightbox' => 0,
		'padding' => 0,
		'bgcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="ppb_three_cols_images '.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//First image
	$return_html.= '<div class="one_third">';
	if(!empty($image1))
	{
		$image_id = grandconference_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    if(!empty($lightbox))
		{
	    	$return_html.= '<a href="'.esc_url($image1).'" class="img_frame">';
	    }
	    $return_html.= '<img src="'.esc_url($image1).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    
	    if(!empty($lightbox))
		{
			$return_html.= '</a>';
		}
	    $return_html.= '</div>';
	    
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Second image
	$return_html.= '<div class="one_third">';
	if(!empty($image2))
	{
		$image_id = grandconference_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    if(!empty($lightbox))
		{
	    	$return_html.= '<a href="'.esc_url($image2).'" class="img_frame">';
	    }
	    $return_html.= '<img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    
	    if(!empty($lightbox))
		{
			$return_html.= '</a>';
		}
	    
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Third image
	$return_html.= '<div class="one_third last">';
	if(!empty($image3))
	{
		$image_id = grandconference_get_image_id($image3);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	    $return_html.= '<div class="image_classic_frame"><div class="image_wrapper">';
	    
	    if(!empty($lightbox))
		{
	    	$return_html.= '<a href="'.esc_url($image3).'" class="img_frame">';
	    }
	    $return_html.= '<img src="'.esc_url($image3).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    
	    if(!empty($lightbox))
		{
			$return_html.= '</a>';
		}
	    
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image3);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div></div>';
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_three_cols_images', 'ppb_three_cols_images_func');


function ppb_three_images_block_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image_portrait' => '',
		'image_portrait_align' => 'left',
		'image2' => '',
		'image3' => '',
		'display_caption' => 1,
		'lightbox' => 0,
		'padding' => 0,
		'bgcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($image_portrait_align))
	{
		$image_portrait_align = 'left';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="ppb_three_images_block '.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	if($image_portrait_align=='left')
	{
		//First column
		$return_html.= '<div class="one_half">';
		if(!empty($image_portrait))
		{
			$image_id = grandconference_get_image_id($image_portrait);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		
		    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
		    
		    if(!empty($lightbox))
			{
		    	$return_html.= '<a href="'.esc_url($image_portrait).'" class="img_frame">';
		    }	
		    $return_html.= '<img src="'.esc_url($image_portrait).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
		    if(!empty($lightbox))
			{
		    	$return_html.= '</a>';
		    }
		    
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = grandconference_get_image_id($image_portrait);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		$return_html.= '</div>';
		
		//Second column
		$return_html.= '<div class="one_half last">';
		if(!empty($image2))
		{
			$image_id = grandconference_get_image_id($image2);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		
		    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
		    
		    if(!empty($lightbox))
			{
		    	$return_html.= '<a href="'.esc_url($image2).'" class="img_frame">';
		    }	
		    $return_html.= '<img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
		    if(!empty($lightbox))
			{
		    	$return_html.= '</a>';
		    }
		    
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = grandconference_get_image_id($image2);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		if(!empty($image3))
		{
			$image_id = grandconference_get_image_id($image3);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		
		    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
		    
		    if(!empty($lightbox))
			{
		    	$return_html.= '<a href="'.esc_url($image3).'" class="img_frame">';
		    }	
		    $return_html.= '<img src="'.esc_url($image3).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
		    if(!empty($lightbox))
			{
		    	$return_html.= '</a>';
		    }
		    
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = grandconference_get_image_id($image3);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	else
	{
		//First column
		$return_html.= '<div class="one_half">';
		if(!empty($image2))
		{
			$image_id = grandconference_get_image_id($image2);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		
		    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
		    
		    if(!empty($lightbox))
			{
		    	$return_html.= '<a href="'.esc_url($image2).'" class="img_frame">';
		    }	
		    $return_html.= '<img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
		    if(!empty($lightbox))
			{
		    	$return_html.= '</a>';
		    }
		    
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = grandconference_get_image_id($image2);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		if(!empty($image3))
		{
			$image_id = grandconference_get_image_id($image3);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		
		    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
		    
		    if(!empty($lightbox))
			{
		    	$return_html.= '<a href="'.esc_url($image3).'" class="img_frame">';
		    }	
		    $return_html.= '<img src="'.esc_url($image3).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
		    if(!empty($lightbox))
			{
		    	$return_html.= '</a>';
		    }
		    
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = grandconference_get_image_id($image3);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '</div>';
		
		//Second column
		$return_html.= '<div class="one_half last">';
		if(!empty($image_portrait))
		{
			$image_id = grandconference_get_image_id($image_portrait);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		
		    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
		    
		    if(!empty($lightbox))
			{
		    	$return_html.= '<a href="'.esc_url($image_portrait).'" class="img_frame">';
		    }	
		    $return_html.= '<img src="'.esc_url($image_portrait).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
		    if(!empty($lightbox))
			{
		    	$return_html.= '</a>';
		    }
		    
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = grandconference_get_image_id($image_portrait);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '<div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_three_images_block', 'ppb_three_images_block_func');


function ppb_four_images_block_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'image3' => '',
		'image4' => '',
		'display_caption' => 1,
		'lightbox' => 0,
		'padding' => 0,
		'bgcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="ppb_four_images_block '.esc_attr($size).'" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//First image
	$return_html.= '<div class="one_half grid4">';
	if(!empty($image1))
	{
		$image_id = grandconference_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    if(!empty($lightbox))
		{
	    	$return_html.= '<a href="'.esc_url($image1).'" class="img_frame">';
	    }
	    $return_html.= '<img src="'.esc_url($image1).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    if(!empty($lightbox))
		{
	    	$return_html.= '</a>';
	    }
	    
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Second image
	$return_html.= '<div class="one_half last grid4">';
	if(!empty($image2))
	{
		$image_id = grandconference_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    if(!empty($lightbox))
		{
	    	$return_html.= '<a href="'.esc_url($image2).'" class="img_frame">';
	    }
	    $return_html.= '<img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    if(!empty($lightbox))
		{
	    	$return_html.= '</a>';
	    }
	    
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<br class="clear"/>';
	
	//Third image
	$return_html.= '<div class="one_half grid4">';
	if(!empty($image3))
	{
		$image_id = grandconference_get_image_id($image3);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    if(!empty($lightbox))
		{
	    	$return_html.= '<a href="'.esc_url($image3).'" class="img_frame">';
	    }
	    $return_html.= '<img src="'.esc_url($image3).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    if(!empty($lightbox))
		{
	    	$return_html.= '</a>';
	    }
	    
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image3);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Fourth image
	$return_html.= '<div class="one_half last grid4">';
	if(!empty($image4))
	{
		$image_id = grandconference_get_image_id($image4);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    if(!empty($lightbox))
		{
	    	$return_html.= '<a href="'.esc_url($image4).'" class="img_frame">';
	    }
	    $return_html.= '<img src="'.esc_url($image4).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    if(!empty($lightbox))
		{
	    	$return_html.= '</a>';
	    }
	    
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = grandconference_get_image_id($image4);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="ppb_image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '</div>';
	$return_html.= '</div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_four_images_block', 'ppb_four_images_block_func');


function ppb_metro_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'image3' => '',
		'image4' => '',
		'image5' => '',
		'height' => 600,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	$return_html.= '<div '.$sec_id.' class="ppb_metro '.esc_attr($size).'" ';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if(!empty($image1))
	{
		//First image
		$return_html.= '<div class="one_half_bg nopadding" style="background:url('.esc_url($image1).');height:'.intval($height).'px;"></div>';
	}
	
	if(!empty($image2))
	{
		$return_html.= '<div class="one_half_bg nopadding">';
		
		$return_html.= '<div class="one_half_bg" style="background:url('.esc_url($image2).');height:'.intval($height/2).'px;"></div>';
		
		if(!empty($image3))
		{
			$return_html.= '<div class="one_half_bg" style="background:url('.esc_url($image3).');height:'.intval($height/2).'px;"></div>';
		}
		
		if(!empty($image4))
		{
			$return_html.= '<div class="one_half_bg" style="background:url('.esc_url($image4).');height:'.intval($height/2).'px;"></div>';
		}
		
		if(!empty($image5))
		{
			$return_html.= '<div class="one_half_bg" style="background:url('.esc_url($image5).');height:'.intval($height/2).'px;"></div>';
		}
		
	    $return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_metro', 'ppb_metro_func');


function ppb_session_filterable_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'filterable' => 'yes',
		'title_bgcolor' => '#007AFF',
		'title_fontcolor' => '#ffffff',
		'columns' => 2,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
		'widget_id' => '',
	), $atts));
	
	//Get multiple session speakers thumbnails display option
	$tg_speaker_multiple_thumbs = get_theme_mod('tg_speaker_multiple_thumbs');
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	if(empty($columns))
	{
		$columns = 2;
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_session_filterable '.$size.' withsmallpadding ';
	
	$return_html.= '" ';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if(empty($widget_id)) {
		$custom_id = time().rand();
	}
	else {
		$custom_id = $widget_id;
	}
	
	$return_html.= '<div class="standard_wrapper">';
	
	//Check if display filterable
	if($filterable == 'yes')
	{
		//Get all portfolio sets
		$sessiontopics_arr = get_terms('sessiontopic', 'hide_empty=0&hierarchical=0&parent=0&orderby=name&order=ASC');
		    
		if(!empty($sessiontopics_arr))
		{
			$return_html.= '<ul id="session_filter_'.$custom_id.'" class="session_filters">';
			
			$return_html.= '<li>
			    <a class="themelink active" href="javascript:;" data-filter="" title="'.esc_html__('All Topics', 'grandconference-custom-post' ).'">'.esc_html__('All Topics', 'grandconference-custom-post' ).'</a>
			</li>';
				
			foreach($sessiontopics_arr as $key => $sessiontopic)
			{
			    $return_html.= '<li>
					<a class="themelink" href="javascript:;" data-filter="'.esc_attr($sessiontopic->slug).'" title="'.esc_attr($sessiontopic->name).'">'.$sessiontopic->name.'</a>
				</li>';
			}
	
			$return_html.= '</ul>';
		}
		
		$return_html.= '<a href="javascript:;" class="themelink session_expand_all do_expand themeborder" id="session_expand_'.$custom_id.'" data-expand-title="'.esc_html__('Expand All', 'grandconference-custom-post' ).'" data-collapse-title="'.esc_html__('Collapse All', 'grandconference-custom-post' ).'">'.esc_html__('Expand All', 'grandconference-custom-post' ).' +</a>';
	}
	
	//Get all session days
	$session_days_arr = get_terms('scheduleday', 'hide_empty=0&hierarchical=0&parent=0&orderby=name');
	
	$custom_css_title_fontcolor = 'color:'.$title_fontcolor.';';
	$custom_css_title_bgcolor = 'background:'.$title_bgcolor.';';
	
	if(!empty($widget_id))
	{
		$custom_css_title_fontcolor = '';
		$custom_css_title_bgcolor = '';
	}
	
	$columns_class = "one_half";
	if($columns > 2)
	{
		$columns_class = "one_third";
		$columns = 3;
	}
	
	if(!empty($session_days_arr))	
	{
		$return_html.= '<div id="'.esc_attr($custom_id).'" class="scheduleday_content">';
		
		foreach ($session_days_arr as $key => $session_day) 
		{
			$return_html.= '<ul class="scheduleday_wrapper themeborder '.esc_attr($columns_class).' ';
			if(($key+1)%$columns == 0)
			{
				$return_html.= 'last';
			}
			$return_html.= '">';
	
			$return_html.= '<li class="scheduleday_title" style="'.esc_attr($custom_css_title_bgcolor).'">';
			$return_html.= '<div class="scheduleday_title_icon"><span class="ti-calendar" style="'.esc_attr($custom_css_title_fontcolor).'"></span></div>';
			$return_html.= '<div class="scheduleday_title_content"><h4 style="'.esc_attr($custom_css_title_fontcolor).'">'.$session_day->name.'</h4>';
			if(!empty($session_day->description))
			{
				$return_html.= '<div class="scheduleday_desc" style="'.esc_attr($custom_css_title_fontcolor).'">'.$session_day->description.'</div>';
			}
			$return_html.= '</div><br class="clear"/></li>';
			
			//Get sessions from this day
			$args_sorting = grandconference_get_default_session_sorting();
			
			$args = array(
			    'numberposts' => -1,
			    'post_type' => array('session'),
			    'suppress_filters' => false,
			    'orderby' => $args_sorting['orderby'],
			    'meta_key' => 'session_start_time',
			    'order' => $args_sorting['order'],
			    'scheduleday' => $session_day->slug
			);
			
			$sessions_arr = get_posts($args);
			
			if(!empty($sessions_arr) && is_array($sessions_arr))
			{
				foreach($sessions_arr as $session)
				{
					//Get session topic
					$session_topic_list = wp_get_post_terms($session->ID, 'sessiontopic', array("fields" => "all"));
					$session_topic_class = '';
					if(!empty($session_topic_list))
					{
						foreach($session_topic_list as $session_topic)
						{
							$session_topic_class.= $session_topic->slug.' ';
						}
					}
					
					$speaker_class = '';
					$return_html.= '<li class="themeborder '.esc_attr($session_topic_class).'"';
					
					//Get speakers list
					$session_speakers = get_post_meta($session->ID, 'session_speakers', true);
					$session_speakers_class = '';
					if(is_array($session_speakers) && count($session_speakers) > 1 && !empty($tg_speaker_multiple_thumbs))
					{
						$session_speakers_class = 'multiple_speaker_thumbs';
					}
					
					$return_html.= '><div class="session_content_wrapper expandable" data-expandid="excerpt_'.esc_attr($session->ID).'">';
					
					//If have multiple speakers
					if(is_array($session_speakers) && count($session_speakers) > 1)
					{
						$speaker_class = 'has_speaker_thumb';
						
						$return_html.= '<div class="session_speaker_thumb '.esc_attr($session_speakers_class).'">';
						$i = 1;
						
						foreach($session_speakers as $session_speaker) {
							$session_speaker_ID = $session_speaker;
							
							if($i > 3) {
								break;
							}
							
							if(has_post_thumbnail($session_speaker_ID, 'thumbnail'))
							{
								$image_id = get_post_thumbnail_id($session_speaker_ID);
								$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
								
								if(isset($image_url[0]))
								{
									$speaker_name = get_the_title($session_speaker_ID);
									$return_html.= '<img src="'.esc_url($image_url[0]).'" alt="'.esc_attr($speaker_name).'"/>';
									
									$i++;
								}
							}
						}
						
						$return_html.= '</div>';
					}
					else 
					{
						if(!empty($session_speakers) && isset($session_speakers[0]))
						{
							$session_speaker_ID = $session_speakers[0];
							
							if(has_post_thumbnail($session_speaker_ID, 'thumbnail'))
							{
						    	$image_id = get_post_thumbnail_id($session_speaker_ID);
						    	$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
						    	
								if(isset($image_url[0]))
								{
									$speaker_name = get_the_title($session_speaker_ID);
									$return_html.= '<div class="session_speaker_thumb"><img src="'.esc_url($image_url[0]).'" alt="'.esc_attr($speaker_name).'"/></div>';
									
									$speaker_class = 'has_speaker_thumb';
								}
							}
						}
						else
						{
							$tg_break_icon = get_theme_mod('tg_break_icon');
							
							if(empty($tg_break_icon)) {
								$return_html.= '<div class="session_speaker_icon"><span class="ti-timer"></span></div>';
							}
							else {
								$return_html.= '<div class="session_speaker_icon"><img src="'.esc_url($tg_break_icon).'" alt="'.esc_attr($session->post_title).'"/></div>';
							}
							
							$speaker_class = 'has_speaker_thumb';
						}
					}
					
					//Get session info.
					$session_title = $session->post_title;
					$session_start_time = get_post_meta($session->ID, 'session_start_time', true);
					$session_end_time = get_post_meta($session->ID, 'session_end_time', true);
					
					$return_html.= '<div class="session_content '.$speaker_class.'">';
					
					if(!empty($session_start_time))
					{
						$return_html.= '<div class="session_start_time">'.$session_start_time;
							
						if(!empty($session_end_time))
						{
							$return_html.= '&nbsp;-&nbsp;'.$session_end_time;
						}
						
						$return_html.= '</div>';
					}
					
					if(!empty($session_title))
					{
						$return_html.= '<div class="session_title"><h6>'.$session_title.'</h6></div>';
					}
					
					if(!empty($session_speakers))
					{
						$return_html.= '<div class="session_speakers">'.esc_html__("By", 'grandconference-custom-post');
						$i = 0;
						$len = count($session_speakers);
						
						foreach($session_speakers as $session_speaker)
						{
							$speaker_name = get_the_title($session_speaker);
							$speaker_link = get_permalink($session_speaker);
							
							$return_html.= '&nbsp;<strong><a href="'.esc_url($speaker_link).'">'.$speaker_name.'</a></strong>&nbsp;';
							
							$speaker_desciption = get_post_meta($session_speaker, 'speaker_desciption', true);
							if(!empty($speaker_desciption))
							{
								$return_html.= $speaker_desciption;
							}							
						
							if($i != $len - 1)
							{
								$return_html.= ',';
							}
							
							$i++;
						}
						
						$return_html.= '</div>';
					}
					
					$return_html.= '</div><br class="clear"/>';
					
					$return_html.= '</div>';
					
					$session_excerpt = $session->post_excerpt;
					
					if(!empty($session_excerpt))
					{
						$return_html.= '<div id="excerpt_'.esc_attr($session->ID).'" class="session_content_extend hide session_content_wrapper"><div class="session_content '.$speaker_class.'">';
						
						if(!empty($session_excerpt))
						{
							$return_html.= '<div class="session_excerpt">'.$session_excerpt.'</div>';
						}
						
						if(!empty($session_topic_list))
						{
							$return_html.= '<div class="session_title_list"><span class="ti-bookmark"></span>';
							foreach($session_topic_list as $session_topic)
							{
								$return_html.= '<div class="session_title_item">'.$session_topic->name.'</div>';
							}
							
							$return_html.= '</div>';
						}
						
						$session_location = get_post_meta($session->ID, 'session_location', true);
						if(!empty($session_location))
						{
							$return_html.= '<div class="session_location themeborder"><div class="session_location_label skin_color">'.esc_html__("Where", 'grandconference-custom-post').'</div>';
							
							$return_html.= '<div class="session_location_content">'.esc_html($session_location).'</div>';
							
							$return_html.= '</div>';
						}
					
						$return_html.= '</div><br class="clear"/></div>';
					}
					
					$return_html.= '</li>';
				}
			}
			else
			{
				$return_html.= '<li><div class="session_content_wrapper">'.esc_html__("We haven't found any session that matches you're criteria", 'grandconference-custom-post').'</div></li>';
			}
			
			$return_html.= '</ul>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//If initiate from Elementor then no need to include these scripts
	if(empty($widget_id)) {
		wp_enqueue_script("masonry", get_template_directory_uri()."/js/masonry.pkgd.min.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		wp_enqueue_script("script-custom-session-masonry".$custom_id, admin_url('admin-ajax.php')."?action=grandconference_script_custom_session_masonry&id=".$custom_id.'&filter='.$filterable, false, GRANDCONFERENCE_THEMEVERSION, true);
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_session_filterable', 'ppb_session_filterable_func');


function ppb_session_filterable_sidebar_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'filterable' => 'yes',
		'title_bgcolor' => '#007AFF',
		'title_fontcolor' => '#ffffff',
		'sidebar' => '',
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
		'widget_id' => '',
	), $atts));
	
	//Get multiple session speakers thumbnails display option
	$tg_speaker_multiple_thumbs = get_theme_mod('tg_speaker_multiple_thumbs');
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_session_filterable_sidebar '.$size.' withsmallpadding ';
	
	$return_html.= '" ';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if(empty($widget_id)) {
		$custom_id = time().rand();
	}
	else {
		$custom_id = $widget_id;
	}
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner"><div class="inner_wrapper">';
	
	$return_html.= '<div class="sidebar_wrapper left_sidebar session-content"><div class="sidebar"><div class="content">';
	
	//Check if display filterable
	if($filterable == 'yes')
	{
		$sessiontopics_arr = get_terms('sessiontopic', 'hide_empty=0&hierarchical=0&parent=0&orderby=name&order=ASC');
		    
		if(!empty($sessiontopics_arr))
		{
			$return_html.= '<ul id="session_filter_'.$custom_id.'" class="session_filters">';
			
			$return_html.= '<li>
			    <a class="themelink active" href="javascript:;" data-filter="" title="'.esc_html__('All Topics', 'grandconference-custom-post' ).'">'.esc_html__('All Topics', 'grandconference-custom-post' ).'</a>
			</li>';
				
			foreach($sessiontopics_arr as $key => $sessiontopic)
			{
			    $return_html.= '<li>
					<a class="themelink" href="javascript:;" data-filter="'.esc_attr($sessiontopic->slug).'" title="'.esc_attr($sessiontopic->name).'">'.$sessiontopic->name.'</a>
				</li>';
			}
	
			$return_html.= '</ul>';
		}
		
		$return_html.= '<a href="javascript:;" class="themelink session_expand_all do_expand themeborder" id="session_expand_'.$custom_id.'" data-expand-title="'.esc_html__('Expand All', 'grandconference-custom-post' ).'" data-collapse-title="'.esc_html__('Collapse All', 'grandconference-custom-post' ).'">'.esc_html__('Expand All', 'grandconference-custom-post' ).' +</a>';
	}
	
	if(!empty($sidebar))
	{
		//Display Sidebar
		$return_html.= '<ul class="sidebar_widget">';
		$return_html.= grandconference_get_dynamic_sidebar(rawurldecode($sidebar));
		$return_html.= '</ul>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Get all session days
	$session_days_arr = get_terms('scheduleday', 'hide_empty=0&hierarchical=0&parent=0&orderby=name');
	
	if(empty($widget_id)) {
		$custom_css_title_fontcolor = 'color:'.$title_fontcolor.';';
		$custom_css_title_bgcolor = 'background:'.$title_bgcolor.';';
	}
	else 
	{
		$custom_css_title_fontcolor = '';
		$custom_css_title_bgcolor = '';
	}
	
	if(!empty($session_days_arr))	
	{
		$return_html.= '<div id="'.esc_attr($custom_id).'" class="sidebar_content left_sidebar">';
		
		foreach ($session_days_arr as $key => $session_day) 
		{
			$return_html.= '<ul class="scheduleday_wrapper themeborder">';
	
			$return_html.= '<li class="scheduleday_title" style="'.esc_attr($custom_css_title_bgcolor).'">';
			$return_html.= '<div class="scheduleday_title_icon"><span class="ti-calendar" style="'.esc_attr($custom_css_title_fontcolor).'"></span></div>';
			$return_html.= '<div class="scheduleday_title_content"><h4 style="'.esc_attr($custom_css_title_fontcolor).'">'.$session_day->name.'</h4>';
			if(!empty($session_day->description))
			{
				$return_html.= '<div class="scheduleday_desc" style="'.esc_attr($custom_css_title_fontcolor).'">'.$session_day->description.'</div>';
			}
			$return_html.= '</div><br class="clear"/></li>';
			
			//Get sessions from this day
			$args_sorting = grandconference_get_default_session_sorting();
			
			$args = array(
			    'numberposts' => -1,
			    'post_type' => array('session'),
			    'suppress_filters' => false,
			    'orderby' => $args_sorting['orderby'],
			    'meta_key' => 'session_start_time',
			    'order' => $args_sorting['order'],
			    'scheduleday' => $session_day->slug
			);
			
			$sessions_arr = get_posts($args);
			
			if(!empty($sessions_arr) && is_array($sessions_arr))
			{
				foreach($sessions_arr as $session)
				{
					//Get session topic
					$session_topic_list = wp_get_post_terms($session->ID, 'sessiontopic', array("fields" => "all"));
					$session_topic_class = '';
					if(!empty($session_topic_list))
					{
						foreach($session_topic_list as $session_topic)
						{
							$session_topic_class.= $session_topic->slug.' ';
						}
					}
					
					$speaker_class = '';
					$return_html.= '<li class="themeborder '.esc_attr($session_topic_class).'"';
					
					//Get speakers list
					$session_speakers = get_post_meta($session->ID, 'session_speakers', true);
					$session_speakers_class = '';
					if(is_array($session_speakers) && count($session_speakers) > 1 && !empty($tg_speaker_multiple_thumbs))
					{
						$session_speakers_class = 'multiple_speaker_thumbs';
					}
					
					$return_html.= '><div class="session_content_wrapper expandable" data-expandid="excerpt_'.esc_attr($session->ID).'">';
					
					//If have multiple speakers
					if(is_array($session_speakers) && count($session_speakers) > 1)
					{
						$speaker_class = 'has_speaker_thumb';
						
						$return_html.= '<div class="session_speaker_thumb '.esc_attr($session_speakers_class).'">';
						$i = 1;
						
						foreach($session_speakers as $session_speaker) {
							$session_speaker_ID = $session_speaker;
							
							if($i > 3) {
								break;
							}
							
							if(has_post_thumbnail($session_speaker_ID, 'thumbnail'))
							{
								$image_id = get_post_thumbnail_id($session_speaker_ID);
								$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
								
								if(isset($image_url[0]))
								{
									$speaker_name = get_the_title($session_speaker_ID);
									$return_html.= '<img src="'.esc_url($image_url[0]).'" alt="'.esc_attr($speaker_name).'"/>';
									
									$i++;
								}
							}
						}
						
						$return_html.= '</div>';
					}
					else 
					{
						if(!empty($session_speakers) && isset($session_speakers[0]))
						{
							$session_speaker_ID = $session_speakers[0];
							
							if(has_post_thumbnail($session_speaker_ID, 'thumbnail'))
							{
								$image_id = get_post_thumbnail_id($session_speaker_ID);
								$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
								
								if(isset($image_url[0]))
								{
									$speaker_name = get_the_title($session_speaker_ID);
									$return_html.= '<div class="session_speaker_thumb"><img src="'.esc_url($image_url[0]).'" alt="'.esc_attr($speaker_name).'"/></div>';
									
									$speaker_class = 'has_speaker_thumb';
								}
							}
						}
						else
						{
							$tg_break_icon = get_theme_mod('tg_break_icon');
							
							if(empty($tg_break_icon)) {
								$return_html.= '<div class="session_speaker_icon"><span class="ti-timer"></span></div>';
							}
							else {
								$return_html.= '<div class="session_speaker_icon"><img src="'.esc_url($tg_break_icon).'" alt="'.esc_attr($session->post_title).'"/></div>';
							}
							
							$speaker_class = 'has_speaker_thumb';
						}
					}
					
					//Get session info.
					$session_title = $session->post_title;
					$session_start_time = get_post_meta($session->ID, 'session_start_time', true);
					$session_end_time = get_post_meta($session->ID, 'session_end_time', true);
					
					$return_html.= '<div class="session_content '.$speaker_class.'">';
					
					if(!empty($session_start_time))
					{
						$return_html.= '<div class="session_start_time">'.$session_start_time;
							
						if(!empty($session_end_time))
						{
							$return_html.= '&nbsp;-&nbsp;'.$session_end_time;
						}
						
						$return_html.= '</div>';
					}
					
					if(!empty($session_title))
					{
						$return_html.= '<div class="session_title"><h6>'.$session_title.'</h6></div>';
					}
					
					if(!empty($session_speakers))
					{
						$return_html.= '<div class="session_speakers">'.esc_html__("By", 'grandconference-custom-post');
						$i = 0;
						$len = count($session_speakers);
						
						foreach($session_speakers as $session_speaker)
						{
							$speaker_name = get_the_title($session_speaker);
							$speaker_link = get_permalink($session_speaker);
							
							$return_html.= '&nbsp;<strong><a href="'.esc_url($speaker_link).'">'.$speaker_name.'</a></strong>&nbsp;';
							
							$speaker_desciption = get_post_meta($session_speaker, 'speaker_desciption', true);
							if(!empty($speaker_desciption))
							{
								$return_html.= $speaker_desciption;
							}
							
							if($i != $len - 1)
							{
								$return_html.= ',';
							}
							
							$i++;
						}
						
						$return_html.= '</div>';
					}
					
					$return_html.= '</div><br class="clear"/>';
					
					$return_html.= '</div>';
					
					$session_excerpt = $session->post_excerpt;
					
					if(!empty($session_excerpt))
					{
						$return_html.= '<div id="excerpt_'.esc_attr($session->ID).'" class="session_content_extend hide session_content_wrapper"><div class="session_content '.$speaker_class.'">';
						
						if(!empty($session_excerpt))
						{
							$return_html.= '<div class="session_excerpt">'.$session_excerpt.'</div>';
						}
						
						if(!empty($session_topic_list))
						{
							$return_html.= '<div class="session_title_list"><span class="ti-bookmark"></span>';
							foreach($session_topic_list as $session_topic)
							{
								$return_html.= '<div class="session_title_item">'.$session_topic->name.'</div>';
							}
							
							$return_html.= '</div>';
						}
						
						$session_location = get_post_meta($session->ID, 'session_location', true);
						if(!empty($session_location))
						{
							$return_html.= '<div class="session_location themeborder"><div class="session_location_label skin_color">'.esc_html__("Where", 'grandconference-custom-post').'</div>';
							
							$return_html.= '<div class="session_location_content">'.esc_html($session_location).'</div>';
							
							$return_html.= '</div>';
						}
					
						$return_html.= '</div><br class="clear"/></div>';
					}
					
					$return_html.= '</li>';
				}
			}
			else
			{
				$return_html.= '<li><div class="session_content_wrapper">'.esc_html__("We haven't found any session that matches you're criteria", 'grandconference-custom-post').'</div></li>';
			}
			
			$return_html.= '</ul>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div></div>';
	
	//If initiate from Elementor then no need to include these scripts
	if(empty($widget_id)) {
		wp_enqueue_script("masonry", get_template_directory_uri()."/js/masonry.pkgd.min.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		wp_enqueue_script("script-custom-session-sidebar".$custom_id, admin_url('admin-ajax.php')."?action=grandconference_script_custom_session_sidebar&id=".$custom_id.'&filter='.$filterable, false, GRANDCONFERENCE_THEMEVERSION, true);
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_session_filterable_sidebar', 'ppb_session_filterable_sidebar_func');


function ppb_session_tab_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'width' => '100',
		'filterable' => 'yes',
		'title_fontcolor' => '#ffffff',
		'bgcolor' => '',
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
		'widget_id' => '',
	), $atts));
	
	//Get multiple session speakers thumbnails display option
	$tg_speaker_multiple_thumbs = get_theme_mod('tg_speaker_multiple_thumbs');
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_session_tab '.$size.' withsmallpadding ';
	
	$return_html.= '" ';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	if(!empty($bgcolor))
	{
		$custom_css.= 'background:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if(empty($widget_id)) {
		$custom_id = time().rand();
	}
	else {
		$custom_id = $widget_id;
	}
	
	$return_html.= '<div class="standard_wrapper">';
	
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(rawurldecode($width)).'%">';
	}
	
	//Check if display filterable
	if($filterable == 'yes')
	{
		$sessiontopics_arr = get_terms('sessiontopic', 'hide_empty=0&hierarchical=0&parent=0&orderby=name&order=ASC');
		    
		if(!empty($sessiontopics_arr))
		{
			$return_html.= '<ul id="session_filter_'.$custom_id.'" class="session_filters">';
			
			$return_html.= '<li>
			    <a class="themelink active" href="javascript:;" data-filter="" title="'.esc_html__('All Topics', 'grandconference-custom-post' ).'">'.esc_html__('All Topics', 'grandconference-custom-post' ).'</a>
			</li>';
				
			foreach($sessiontopics_arr as $key => $sessiontopic)
			{
			    $return_html.= '<li>
					<a class="themelink" href="javascript:;" data-filter="'.esc_attr($sessiontopic->slug).'" title="'.esc_attr($sessiontopic->name).'">'.$sessiontopic->name.'</a>
				</li>';
			}
	
			$return_html.= '</ul>';
		}
		
		$return_html.= '<a href="javascript:;" class="themelink session_expand_all do_expand themeborder" id="session_expand_'.$custom_id.'" data-expand-title="'.esc_html__('Expand All', 'grandconference-custom-post' ).'" data-collapse-title="'.esc_html__('Collapse All', 'grandconference-custom-post' ).'">'.esc_html__('Expand All', 'grandconference-custom-post' ).' +</a>';
	}
	
	//Get all session days
	$session_days_arr = get_terms('scheduleday', 'hide_empty=0&hierarchical=0&parent=0&orderby=name');
	
	if(empty($widget_id)) {
		$custom_css_title_fontcolor = 'color:'.$title_fontcolor.';';
	}
	else 
	{
		$custom_css_title_fontcolor = '';
	}
	
	if(!empty($session_days_arr))	
	{
		$return_html.= '<div id="'.esc_attr($custom_id).'">';
		
		$return_html.= '<ul class="scheduleday_wrapper tab">';
		
		//Display day tab
		foreach ($session_days_arr as $key => $session_day) 
		{
			$active_class = '';
			if($key == 0)
			{
				$active_class = 'active';
				$return_html.= '<li data-tab="'.esc_attr($session_day->slug).'" class="scheduleday_title '.esc_attr($active_class).'">';
			}
			else
			{
				$return_html.= '<li data-tab="'.esc_attr($session_day->slug).'" class="scheduleday_title '.esc_attr($active_class).'">';
			}
			
			$return_html.= '<div class="scheduleday_title_content"><h4 style="'.esc_attr($custom_css_title_fontcolor).'">'.$session_day->name.'</h4>';
			if(!empty($session_day->description))
			{
				$return_html.= '<div class="scheduleday_desc" style="'.esc_attr($custom_css_title_fontcolor).'">'.$session_day->description.'</div>';
			}
			$return_html.= '</div><br class="clear"/></li>';
		}
		
		$return_html.= '</ul>';
		
		foreach ($session_days_arr as $key => $session_day) 
		{
			$return_html.= '<ul id="'.esc_attr($session_day->slug).'" class="scheduleday_wrapper themeborder tab_content';
			
			if($key > 0)
			{
				$return_html.= ' hide';
			}
			
			$return_html.= '">';
			
			//Get sessions from this day
			$args_sorting = grandconference_get_default_session_sorting();
			
			$args = array(
			    'numberposts' => -1,
			    'post_type' => array('session'),
			    'suppress_filters' => false,
			    'orderby' => $args_sorting['orderby'],
			    'meta_key' => 'session_start_time',
			    'order' => $args_sorting['order'],
			    'scheduleday' => $session_day->slug
			);
			
			$sessions_arr = get_posts($args);
			
			if(!empty($sessions_arr) && is_array($sessions_arr))
			{
				foreach($sessions_arr as $session)
				{
					//Get session topic
					$session_topic_list = wp_get_post_terms($session->ID, 'sessiontopic', array("fields" => "all"));
					$session_topic_class = '';
					if(!empty($session_topic_list))
					{
						foreach($session_topic_list as $session_topic)
						{
							$session_topic_class.= $session_topic->slug.' ';
						}
					}
					
					$speaker_class = '';
					$return_html.= '<li class="themeborder '.esc_attr($session_topic_class).'"';
					
					//Get speakers list
					$session_speakers = get_post_meta($session->ID, 'session_speakers', true);
					$session_speakers_class = '';
					if(is_array($session_speakers) && count($session_speakers) > 1 && !empty($tg_speaker_multiple_thumbs))
					{
						$session_speakers_class = 'multiple_speaker_thumbs';
					}
					
					$return_html.= '><div class="session_content_wrapper expandable" data-expandid="excerpt_'.esc_attr($session->ID).'">';
					
					//If have multiple speakers
					if(is_array($session_speakers) && count($session_speakers) > 1)
					{
						$speaker_class = 'has_speaker_thumb';
						
						$return_html.= '<div class="session_speaker_thumb '.esc_attr($session_speakers_class).'">';
						$i = 1;
						
						foreach($session_speakers as $session_speaker) {
							$session_speaker_ID = $session_speaker;
							
							if($i > 3) {
								break;
							}
							
							if(has_post_thumbnail($session_speaker_ID, 'thumbnail'))
							{
								$image_id = get_post_thumbnail_id($session_speaker_ID);
								$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
								
								if(isset($image_url[0]))
								{
									$speaker_name = get_the_title($session_speaker_ID);
									$return_html.= '<img src="'.esc_url($image_url[0]).'" alt="'.esc_attr($speaker_name).'"/>';
									
									$i++;
								}
							}
						}
						
						$return_html.= '</div>';
					}
					else 
					{
						if(!empty($session_speakers) && isset($session_speakers[0]))
						{
							$session_speaker_ID = $session_speakers[0];
							
							if(has_post_thumbnail($session_speaker_ID, 'thumbnail'))
							{
								$image_id = get_post_thumbnail_id($session_speaker_ID);
								$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
								
								if(isset($image_url[0]))
								{
									$speaker_name = get_the_title($session_speaker_ID);
									$return_html.= '<div class="session_speaker_thumb"><img src="'.esc_url($image_url[0]).'" alt="'.esc_attr($speaker_name).'"/></div>';
									
									$speaker_class = 'has_speaker_thumb';
								}
							}
						}
						else
						{
							$tg_break_icon = get_theme_mod('tg_break_icon');
							
							if(empty($tg_break_icon)) {
								$return_html.= '<div class="session_speaker_icon"><span class="ti-timer"></span></div>';
							}
							else {
								$return_html.= '<div class="session_speaker_icon"><img src="'.esc_url($tg_break_icon).'" alt="'.esc_attr($session->post_title).'"/></div>';
							}
							
							$speaker_class = 'has_speaker_thumb';
						}
					}
					
					//Get session info.
					$session_title = $session->post_title;
					$session_start_time = get_post_meta($session->ID, 'session_start_time', true);
					$session_end_time = get_post_meta($session->ID, 'session_end_time', true);
					
					$return_html.= '<div class="session_content '.$speaker_class.'">';
					
					if(!empty($session_start_time))
					{
						$return_html.= '<div class="session_start_time">'.$session_start_time;
							
						if(!empty($session_end_time))
						{
							$return_html.= '&nbsp;-&nbsp;'.$session_end_time;
						}
						
						$return_html.= '</div>';					}
					
					if(!empty($session_title))
					{
						$return_html.= '<div class="session_title"><h6>'.$session_title.'</h6></div>';
					}
					
					if(!empty($session_speakers))
					{
						$return_html.= '<div class="session_speakers">'.esc_html__("By", 'grandconference-custom-post');
						$i = 0;
						$len = count($session_speakers);
						
						foreach($session_speakers as $session_speaker)
						{
							$speaker_name = get_the_title($session_speaker);
							$speaker_link = get_permalink($session_speaker);
							
							$return_html.= '&nbsp;<strong><a href="'.esc_url($speaker_link).'">'.$speaker_name.'</a></strong>&nbsp;';
							
							$speaker_desciption = get_post_meta($session_speaker, 'speaker_desciption', true);
							if(!empty($speaker_desciption))
							{
								$return_html.= $speaker_desciption;
							}							
						
							if($i != $len - 1)
							{
								$return_html.= ',';
							}
							
							$i++;
						}
						
						$return_html.= '</div>';
					}
					
					$return_html.= '</div><br class="clear"/>';
					
					$return_html.= '</div>';
					
					$session_excerpt = $session->post_excerpt;
					
					if(!empty($session_excerpt))
					{
						$return_html.= '<div id="excerpt_'.esc_attr($session->ID).'" class="session_content_extend hide session_content_wrapper"><div class="session_content '.$speaker_class.'">';
						
						if(!empty($session_excerpt))
						{
							$return_html.= '<div class="session_excerpt">'.$session_excerpt.'</div>';
						}
						
						if(!empty($session_topic_list))
						{
							$return_html.= '<div class="session_title_list"><span class="ti-bookmark"></span>';
							foreach($session_topic_list as $session_topic)
							{
								$return_html.= '<div class="session_title_item">'.$session_topic->name.'</div>';
							}
							
							$return_html.= '</div>';
						}
						
						$session_location = get_post_meta($session->ID, 'session_location', true);
						if(!empty($session_location))
						{
							$return_html.= '<div class="session_location themeborder"><div class="session_location_label skin_color">'.esc_html__("Where", 'grandconference-custom-post').'</div>';
							
							$return_html.= '<div class="session_location_content">'.esc_html($session_location).'</div>';
							
							$return_html.= '</div>';
						}
					
						$return_html.= '</div><br class="clear"/></div>';
					}
					
					$return_html.= '</li>';
				}
			}
			else
			{
				$return_html.= '<li><div class="session_content_wrapper">'.esc_html__("We haven't found any session that matches you're criteria", 'grandconference-custom-post').'</div></li>';
			}
			
			$return_html.= '</ul>';
		}
		
		$return_html.= '</div>';
	}
	
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//If initiate from Elementor then no need to include these scripts
	if(empty($widget_id)) {
		wp_enqueue_script("script-custom-session-tab".$custom_id, admin_url('admin-ajax.php')."?action=grandconference_script_custom_session_tab&id=".$custom_id.'&filter='.$filterable, false, GRANDCONFERENCE_THEMEVERSION, true);
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_session_tab', 'ppb_session_tab_func');


function ppb_speaker_grid_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'items' => 10,
		'speakercat' => '',
		'columns' => 5,
		'effect' => '',
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 10;
	}
	$all_items = $items;
	
	if(!is_numeric($columns))
	{
		$columns = 5;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_speaker_grid '.$size.' nopadding ';
	
	$return_html.= '" ';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper page_main_content sidebar_content full_width fixed_column">';
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'post_type' => array('speaker'),
	    'suppress_filters' => false,
	    'orderby' => 'menu_order',
	    'order' => 'ASC',
	);
	
	if(!empty($speakercat))
	{
		$args['speakercat'] = $speakercat;
	}
	
	$portfolios_arr = get_posts($args);
	
	$custom_id = time().rand();
	$column_class = '';
	$image_size = 'grandconference-gallery-list';
	$header_tag = 'h4';
	
	switch($columns)
	{
		case 2:
			$column_class = 'one_half_bg';
			$image_size = 'grandconference-blog';
			$header_tag = 'h3';
		break;
		
		case 3:
			$column_class = 'one_third_bg';
			$image_size = 'grandconference-blog';
		break;
		
		case 4:
			$column_class = 'one_fourth_bg';
		break;
		
		case 5:
			$column_class = 'one_fifth_bg';
		break;
	}
	
	if(!empty($portfolios_arr) && is_array($portfolios_arr))
	{
		$return_html.= '<div id="'.$custom_id.'" data-columns="'.esc_attr($columns).'">';
	
		foreach($portfolios_arr as $key => $portfolio)
		{
			$image_url = '';
			$portfolio_ID = $portfolio->ID;
					
			if(has_post_thumbnail($portfolio_ID, 'original'))
			{
			    $image_id = get_post_thumbnail_id($portfolio_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
			    
			    $small_image_url = wp_get_attachment_image_src($image_id, $image_size, true);
			}
			
			$permalink_url = get_permalink($portfolio_ID);
			
			if(!empty($image_url[0]))
			{
				//Begin display HTML
				$return_html.= '<div class="element grid '.esc_attr($column_class).'">';
				$return_html.= '<a class="speaker_grid_link" href="'.esc_url($permalink_url).'">';
				$return_html.= '<img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolio->post_title).'" class="'.esc_attr($effect).'"/>';
				$return_html.= '<div class="speaker_info_wrapper">';
				$return_html.= '<'.esc_attr($header_tag).'>'.get_the_title($portfolio_ID).'</'.esc_attr($header_tag).'>';
				
				$speaker_desciption = get_post_meta($portfolio_ID, 'speaker_desciption', true);
				if(!empty($speaker_desciption))
				{
					$return_html.= '<div class="speaker_desc">'.esc_attr($speaker_desciption).'</div>';
				}
				
				$return_html.= '</div>';
				$return_html.= '</a>';

				$return_html.= '</div>';
				
				if(($key+1)%$columns == 0)
				{
					$return_html.= '<br class="clear"/>';
				}
			}
		}
		
		$return_html.= '</div>';
	}
	else
	{
		$return_html.= '<div class="search_noresult"><span class="ti-info-alt"></span>'.esc_html_e("We haven't found any speaker that matches you're criteria", 'grandconference-custom-post').'</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_speaker_grid', 'ppb_speaker_grid_func');


function ppb_speaker_classic_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'items' => 10,
		'speakercat' => '',
		'columns' => 5,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 10;
	}
	$all_items = $items;
	
	if(!is_numeric($columns))
	{
		$columns = 5;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_speaker_classic '.$size.' nopadding ';
	
	$return_html.= '" ';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper page_main_content sidebar_content full_width fixed_column">';
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'post_type' => array('speaker'),
	    'suppress_filters' => false,
	    'orderby' => 'menu_order',
	    'order' => 'ASC',
	);
	
	if(!empty($speakercat))
	{
		$args['speakercat'] = $speakercat;
	}
	
	$portfolios_arr = get_posts($args);
	
	$custom_id = time().rand();
	$column_class = '';
	$image_size = 'grandconference-gallery-list';
	$header_tag = 'h4';
	
	switch($columns)
	{
		case 2:
			$column_class = 'one_half_bg';
			$image_size = 'grandconference-blog';
			$header_tag = 'h3';
		break;
		
		case 3:
			$column_class = 'one_third_bg';
			$image_size = 'grandconference-blog';
		break;
		
		case 4:
			$column_class = 'one_fourth_bg';
		break;
		
		case 5:
			$column_class = 'one_fifth_bg';
		break;
	}
	
	if(!empty($portfolios_arr) && is_array($portfolios_arr))
	{
		$return_html.= '<div id="'.$custom_id.'" data-columns="'.esc_attr($columns).'">';
	
		foreach($portfolios_arr as $key => $portfolio)
		{
			$image_url = '';
			$portfolio_ID = $portfolio->ID;
					
			if(has_post_thumbnail($portfolio_ID, 'original'))
			{
			    $image_id = get_post_thumbnail_id($portfolio_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
			    
			    $small_image_url = wp_get_attachment_image_src($image_id, $image_size, true);
			}
			
			$permalink_url = get_permalink($portfolio_ID);
			
			if(!empty($image_url[0]))
			{
				//Begin display HTML
				$return_html.= '<div class="element grid '.esc_attr($column_class).'">';
				$return_html.= '<a class="speaker_grid_link" href="'.esc_url($permalink_url).'">';
				$return_html.= '<img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolio->post_title).'"/>';
				$return_html.= '</a>';
				$return_html.= '<div class="speaker_info_wrapper">';
				$return_html.= '<'.esc_attr($header_tag).'>'.get_the_title($portfolio_ID).'</'.esc_attr($header_tag).'>';
				
				$speaker_desciption = get_post_meta($portfolio_ID, 'speaker_desciption', true);
				if(!empty($speaker_desciption))
				{
					$return_html.= '<div class="speaker_desc">'.esc_attr($speaker_desciption).'</div>';
				}
				
				$return_html.= '</div>';
				$return_html.= '</div>';
				
				if(($key+1)%$columns == 0)
				{
					$return_html.= '<br class="clear"/>';
				}
			}
		}
		
		$return_html.= '</div>';
	}
	else
	{
		$return_html.= '<div class="search_noresult"><span class="ti-info-alt"></span>'.esc_html_e("We haven't found any speaker that matches you're criteria", 'grandconference-custom-post').'</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_speaker_classic', 'ppb_speaker_classic_func');


function ppb_blog_grid_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'cat' => '',
		'items' => '',
		'padding' => '',
		'custom_css' => '',
		'link_title' => '',
		'link_url' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	
	$return_html.= '<div '.$sec_id.' class="ppb_blog_grid '.$size.' nopadding"';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.rawurldecode($custom_css).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper"><div class="inner"><div class="inner_wrapper">';
	
	if(!is_numeric($items))
	{
		$items = 3;
	}
	
	//Get blog posts
	$args = array(
	    'numberposts' => $items,
	    'order' => 'DESC',
	    'orderby' => 'post_date',
	    'post_type' => array('post'),
	    'suppress_filters' => false,
	);

	if(!empty($cat))
	{
		$args['category'] = $cat;
	}
	$posts_arr = get_posts($args);
	
	if(!empty($posts_arr) && is_array($posts_arr))
	{
		$return_html.= '<div class="blog_grid_wrapper sidebar_content full_width ppb_blog_posts">';
	
		foreach($posts_arr as $key => $ppb_post)
		{
			$animate_layer = $key+7;
			$current_order = $key+1;
			$image_thumb = '';
										
			if(has_post_thumbnail($ppb_post->ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($ppb_post->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
			}
			
			$last_class = '';
			if($current_order%3 == 0)
			{
				$last_class = 'last';
			}
			
			$return_html.= '<div id="post-'.$ppb_post->ID.'" class="post type-post hentry status-publish '.esc_attr($last_class).'">
			<div class="post_wrapper grid_layout">';
			
			$return_html.= '<div class="post_header grid">';
				
			$return_html.= '
				<div class="post_detail single_post">
				    <span class="post_info_date">
				    	<a href="'.esc_url(get_permalink($ppb_post->ID)).'" title="'.get_the_title($ppb_post->ID).'">'.get_the_time(GRANDCONFERENCE_THEMEDATEFORMAT, $ppb_post->ID).'</a>
				    </span>
				</div>
				<h6><a href="'.esc_url(get_permalink($ppb_post->ID)).'" title="'.get_the_title($ppb_post->ID).'">'.get_the_title($ppb_post->ID).'</a></h6>
			</div>';
			
			 //Get post featured content
		    $post_ft_type = get_post_meta($ppb_post->ID, 'post_ft_type', true);
		    
		    switch($post_ft_type)
		    {
		    	case 'Image':
		    	default:
		        	if(!empty($image_thumb))
		        	{
		        		$small_image_url = wp_get_attachment_image_src($image_id, 'grandconference-blog', true);
		
		    	    $return_html.= '<div class="post_img small static">
		    	    	<a href="'.esc_url(get_permalink($ppb_post->ID)).'">
		    	    		<img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($ppb_post->post_title).'" class=""/>
		                </a>
		    	    </div>';
		    		}
		    	break;
		    	
		    	case 'Vimeo Video':
		    		$post_ft_vimeo = get_post_meta($ppb_post->ID, 'post_ft_vimeo', true);
		
					$return_html.= do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="670" height="377"]').'<br/>';
		    	break;
		    	
		    	case 'Youtube Video':
		    		$post_ft_youtube = get_post_meta($ppb_post->ID, 'post_ft_youtube', true);

		    		$return_html.= do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="670" height="377"]').'<br/>';
		    	break;
		    	
		    } //End switch
		    
		    $return_html.= '<div class="post_header_wrapper">';
				
			$return_html.= grandconference_substr(grandconference_get_excerpt_by_id($ppb_post->ID), 80);
			    		    
			$return_html.= '
				<div class="post_button_wrapper">
			    	<a class="readmore" href="'.esc_url(get_permalink($ppb_post->ID)).'">'.esc_html__('Read More', 'grandconference-custom-post' ).'<span class="ti-angle-right"></span></a>
					</div>
			</div>';
		    
		    $return_html.= '    
				</div>
			</div>';
		$clear_br = '';

		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	if(!empty($link_title) && !empty($link_url))
	{
		$return_html.= '<br class="clear"/><div class="blog_recent_link">
		<a href="'.esc_url($link_url).'" class="button">'.rawurldecode($link_title).'</a>
	</div>';
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div></div>';
	
	return $return_html;
}

add_shortcode('ppb_blog_grid', 'ppb_blog_grid_func');


function ppb_fullwidth_button_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'padding' => 30,
		'slug' => '',
		'title' => '',
		'bgcolor' => '',
		'fontcolor' => '#000',
		'button_text' => '',
		'link_url' => '',
		'button_bgcolor' => '',
		'button_fontcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	//Set begin wrapper div for live builder
	$return_html= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' ppb_fullwidth_button" ';
	
	$custom_css = '';
	
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="padding:'.$padding.'px 0 '.$padding.'px 0;'.rawurldecode($custom_css).'" ';
	}
	
	$return_html.= '>';
	
	$return_html.= '<div class="standard_wrapper">';
	
	if(!empty($title))
	{
		$return_html.= '<h2 class="title" style="color:'.esc_attr($fontcolor).';">'.rawurldecode($title).'</h2>';
	}
	
	$custom_css = '';
	if(!empty($button_text))
	{
		if(!empty($button_bgcolor))
		{
			$custom_css.= 'background-color:'.$button_bgcolor.';border-color:'.$button_bgcolor.';';
		}
		
		if(!empty($button_fontcolor))
		{
			$custom_css.= 'color:'.$button_fontcolor.';';
		}
	
		$return_html.= '<a href="'.esc_url($link_url).'" class="button" ';
		
		if(!empty($custom_css))
		{
			$return_html.= 'style="'.$custom_css.'"';
		}
		
		$return_html.= '>'.rawurldecode($button_text).'</a>';
	}
	
	$return_html.= '</div>';
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);

	return $return_html;

}

add_shortcode('ppb_fullwidth_button', 'ppb_fullwidth_button_func');


function ppb_ticket_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'skin' => 'normal',
		'items' => 3,
		'cat' => '',
		'columns' => '3',
		'highlightcolor' => '#001d2c',
		'button_bgcolor' => '',
		'padding' => 30,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
		'widget_id' => '',
	), $atts));

	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' ppb_ticket withsmallpadding"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	//Get ticket items
	$args = array(
	    'numberposts' => -1,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('ticket'),
	    'suppress_filters' => false,
	);
	
	$ticket_arr = get_posts($args);
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	
	switch($columns)
	{
		case 2:
			$count_column = 2;
			$columns_class = 'one_half_bg';
		break;
		
		case 3:
		default:
			$count_column = 3;
			$columns_class = 'one_third_bg';
		break;
		
		case 4:
			$count_column = 4;
			$columns_class = 'one_fourth_bg';
		break;
	}
	
	$custom_header = '';
	$custom_button = '';
	$custom_border = '';
	$custom_recommend = '';
	if(empty($widget_id))
	{
		$custom_header = 'color:'.$highlightcolor.';';
		$custom_button = 'background:'.$button_bgcolor.';border-color:'.$button_bgcolor.';color:#fff;';
		$custom_border = 'border-color:'.$highlightcolor.';';
		$custom_recommend = 'background:'.$highlightcolor.';border-color:'.$highlightcolor.';';
	}

	if(!empty($ticket_arr) && is_array($ticket_arr))
	{
		$return_html.= '<div class="ticket_content_wrapper '.$skin.'">';
		$last_class = '';
	
		foreach($ticket_arr as $key => $ticket)
		{
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			else
			{
				$last_class = '';
			}
			
			//Check if featured
			$priing_featured_class = '';
			$priing_button_class = '';
			$custom_border = '';
			$custom_recommend = '';
			$ticket_plan_featured = get_post_meta($ticket->ID, 'ticket_featured', true);
			
			if(!empty($ticket_plan_featured))
			{
				$priing_featured_class = 'featured';
				$custom_border = 'border-color:'.$highlightcolor.';';
				$custom_recommend = 'background:'.$highlightcolor.';border-color:'.$highlightcolor.';';
			}
			
			if(!empty($widget_id))
			{
				$custom_border = '';
				$custom_recommend = '';
			}
			
			$return_html.= '<div class="ticket '.esc_attr($columns_class).' '.esc_attr($priing_featured_class).' '.esc_attr($last_class).'" style="'.esc_attr($custom_border).'">';
			
			if(!empty($ticket_plan_featured))
			{
				$return_html.= '<div class="ticket_wrapper_recommend" style="'.esc_attr($custom_recommend).'">'.esc_html__('Recommended', 'grandconference-custom-post' ).'</div>';
			}
			
			$return_html.= '<div class="ticket_wrapper_border"><ul class="ticket_wrapper">';
			
			$return_html.= '<li class="title_row '.esc_attr($priing_featured_class).'" style="'.esc_attr($custom_header).'"><h3 style="'.esc_attr($custom_header).'">'.$ticket->post_title.'</h3>';
			
			if(!empty($ticket->post_excerpt))
			{
				$return_html.= '<div class="ticket_desc">'.$ticket->post_excerpt.'</div>';
			}
			
			$return_html.= '</li>';
			
			//Get ticket features
			$ticket_plan_features = get_post_meta($ticket->ID, 'ticket_plan_features', true);
			$ticket_plan_features = trim($ticket_plan_features);
			$ticket_plan_features_arr = explode("\n", $ticket_plan_features);
			$ticket_plan_features_arr = array_filter($ticket_plan_features_arr, 'trim');
			
			foreach ($ticket_plan_features_arr as $feature) {
			    $return_html.= '<li class="bordercolor">'.$feature.'</li>';
			}
			
			//Check price
			$ticket_plan_currency = get_post_meta($ticket->ID, 'ticket_plan_currency', true);
			$ticket_plan_price = get_post_meta($ticket->ID, 'ticket_plan_price', true);
			$ticket_plan_time = get_post_meta($ticket->ID, 'ticket_plan_time', true);
			
			$return_html.= '<li class="price_row bordercolor">';
			$return_html.= '<strong>'.$ticket_plan_currency.'</strong>';
			$return_html.= '<em class="exact_price">'.$ticket_plan_price.'</em>';
			$return_html.= '<em class="time">'.$ticket_plan_time.'</em>';
			$return_html.= '</li>';
			
			//Get button
			$ticket_button_text = get_post_meta($ticket->ID, 'ticket_button_text', true);
			$ticket_button_url = get_post_meta($ticket->ID, 'ticket_button_url', true);
			
			$return_html.= '<li class="button_row '.esc_attr($priing_featured_class).'">';
			
			//Get ticket booking method
		    $ticket_booking_method = get_post_meta($ticket->ID, 'ticket_booking_method', true);
		    
		    switch($ticket_booking_method)
		    {
			    case 'woocommerce_product':
			    default:
			    	$ticket_booking_product = get_post_meta($ticket->ID, 'ticket_booking_product', true);
			    	
			    	if(class_exists('Woocommerce'))
					{
						$return_html.= '<button data-product="'.esc_attr($ticket_booking_product).'" data-processing="'.esc_html__('Please wait...', 'grandconference-custom-post' ).'" data-url="'.admin_url('admin-ajax.php').esc_attr("?action=grandconference_add_to_cart&product_id=".$ticket_booking_product).'" class="ticket_add_to_cart button"  style="'.esc_attr($custom_button).'">'.$ticket_button_text.'</button>';
					}
				break;
				
				case 'external':
					$ticket_booking_url = get_post_meta($ticket->ID, 'ticket_booking_url', true);
					
					$return_html.= '<button onclick="location.href=\''.esc_url($ticket_booking_url).'\'" class="button" style="'.esc_attr($custom_button).'">'.$ticket_button_text.'</button>';
				break;
			}
			
			$return_html.= '</li>';
			
			$return_html.= '</ul></div>';
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_ticket', 'ppb_ticket_func');


function ppb_countdown_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'date' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'width' => '100',
		'padding' => 30,
		'background' => '',
		'background_position' => '',
		'bgcolor' => '#000000',
		'opacity' => 100,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'parallax' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	if($size != 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_countdown_image ';
	
	if(!empty($parallax))
	{
		$return_html.= 'parallax ';
	}
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
		$custom_css.= 'background-image:url('.esc_url($background).');';
	}
	
	if(!empty($background_position))
	{
		$custom_css.= 'background-position: center '.esc_attr($background_position).';';
	}

	$return_html.= '"';
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$custom_bgcolor_css = '';
	if(!empty($bgcolor))
	{
	    $ori_bgcolor = $bgcolor;
	    $opacity = $opacity/100;
	    $bgcolor = grandconference_hex_to_rgb($bgcolor);
	
	    $custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
	    $custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    $custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    
	    $return_html.= '<div class="overlay_background" style="'.esc_attr($custom_bgcolor_css).'"></div>';
	}
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if($size == 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(rawurldecode($width)).'%">';
	}
	
	//Add title and content
	if(!empty($title))
	{
		if(!empty($titlecolor))
		{
			$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
		}
		
		$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
	}
	
	if(!empty($subtitle))
	{
		$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode($subtitle).'</div>';
	}
	
	if(!empty($date))
	{
		$custom_id = time().rand();
		
		$return_html.= '<div class="ppb_header_content"><div id="clock'.esc_attr($custom_id).'" data-date="'.esc_attr($date).'"></div></div>';
	}
	
	$return_html.= '</div>';
	
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	wp_enqueue_script("countdown", get_template_directory_uri()."/js/jquery.countdown.js", false, GRANDCONFERENCE_THEMEVERSION, true);
	wp_enqueue_script("script-custom-countdown", admin_url('admin-ajax.php')."?action=grandconference_script_custom_countdown&id=clock".$custom_id, false, GRANDCONFERENCE_THEMEVERSION, true);
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	if($size != 'one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_countdown_image', 'ppb_countdown_image_func');


function ppb_team_column_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'columns' => 4,
		'title' => '',
		'items' => 4,
		'cat' => '',
		'order' => 'default',
		'layout' => 'contain',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_team_column" ';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper page_main_content sidebar_content full_width fixed_column photoframe">';
	
	$team_order = 'ASC';
	$team_order_by = 'menu_order';
	switch($order)
	{
		case 'default':
			$team_order = 'ASC';
			$team_order_by = 'menu_order';
		break;
		
		case 'newest':
			$team_order = 'DESC';
			$team_order_by = 'post_date';
		break;
		
		case 'oldest':
			$team_order = 'ASC';
			$team_order_by = 'post_date';
		break;
		
		case 'title':
			$team_order = 'ASC';
			$team_order_by = 'title';
		break;
		
		case 'random':
			$team_order = 'ASC';
			$team_order_by = 'rand';
		break;
	}
	
	//Check display columns
	$wrapper_class = '';
	$grid_wrapper_class = '';
	$column_class = '';
	
	switch($columns)
	{
		case 2:
			$wrapper_class = 'two_cols';
			$grid_wrapper_class = 'classic2_cols';
			$column_class = 'one_half gallery2';
		break;
		
		case 3:
			$wrapper_class = 'three_cols';
			$grid_wrapper_class = 'classic3_cols';
			$column_class = 'one_third gallery3';
		break;
		
		case 4:
			$wrapper_class = 'four_cols';
			$grid_wrapper_class = 'classic4_cols';
			$column_class = 'one_fourth gallery4';
		break;
		
		case 5:
			$wrapper_class = 'five_cols';
			$grid_wrapper_class = 'classic5_cols';
			$column_class = 'one_fifth gallery5';
		break;
	}
	
	$custom_id = time().rand();
	
	//Get team items
	$args = array(
	    'numberposts' => $items,
	    'order' => $team_order,
	    'orderby' => $team_order_by,
	    'post_type' => array('team'),
	);
	
	if(!empty($cat))
	{
		$args['teamcats'] = $cat;
	}
	$team_arr = get_posts($args);
	
	if(!empty($team_arr) && is_array($team_arr))
	{
		if($layout == 'contain')
		{
			$return_html.= '<div class="standard_wrapper">';
		}
	
		$return_html.= '<div id="'.$custom_id.'" class="portfolio_filter_wrapper gallery '.esc_attr($wrapper_class).'" data-columns="'.esc_attr($columns).'">';
	
		foreach($team_arr as $key => $member)
		{
			$image_url = '';
			$member_ID = $member->ID;
					
			if(has_post_thumbnail($member_ID, 'grandconference-gallery-list'))
			{
			    $image_id = get_post_thumbnail_id($member_ID);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'grandconference-gallery-list', true);
			}
			
			//Begin display HTML
			$return_html.= '<div class="element grid photoframe fixed_columns '.esc_attr($grid_wrapper_class).' animated'.($key+1).'">';
			$return_html.= '<div class="'.esc_attr($column_class).' classic filterable">';
			
			if(!empty($small_image_url[0]))
			{
				$return_html.= '<div class="post_img">';
				$return_html.= '<img class="team_pic" src="'.esc_url($small_image_url[0]).'" alt=""/>';
				
				$member_facebook = get_post_meta($member_ID, 'member_facebook', true);
				$member_twitter = get_post_meta($member_ID, 'member_twitter', true);
				$member_google = get_post_meta($member_ID, 'member_google', true);
				$member_linkedin = get_post_meta($member_ID, 'member_linkedin', true);
	            
	            if(!empty($member_facebook) OR !empty($member_twitter) OR !empty($member_google) OR !empty($member_linkedin))
				{
				    $return_html.= '<ul class="social_wrapper team">';
				    
				    if(!empty($member_twitter))
				    {
				        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Twitter" target="_blank" class="tooltip" href="https://twitter.com/'.$member_twitter.'"><i class="fa fa-twitter"></i></a></li>';
				    }
		 
				    if(!empty($member_facebook))
				    {
				        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Facebook" target="_blank" class="tooltip" href="https://facebook.com/'.$member_facebook.'"><i class="fa fa-facebook"></i></a></li>';
				    }
				    
				    if(!empty($member_google))
				    {
				        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Google+" target="_blank" class="tooltip" href="'.$member_google.'"><i class="fa fa-google-plus"></i></a></li>';
				    }
				        
				    if(!empty($member_linkedin))
				    {
				        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Linkedin" target="_blank" class="tooltip" href="'.$member_linkedin.'"><i class="fa fa-linkedin"></i></a></li>';
				    }
				    
				    $return_html.= '</ul>';
				}
				
				$return_html.= '</div>';
			}
			
			$team_position = get_post_meta($member_ID, 'team_position', true);
			
			$return_html.= '<div class="portfolio_info_wrapper center">';
            $return_html.= '<h4>'.$member->post_title.'</h4>';
            if(!empty($team_position))
            {
            	$return_html.= '<div class="page_tagline">'.$team_position.'</div>';
            }

			$return_html.= '</div>';
			$return_html.= '</div>';
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
		
		if($layout == 'contain')
		{
			$return_html.= '</div>';
		}
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_team_column', 'ppb_team_column_func');


function ppb_promo_box_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'button_text' => '',
		'button_url' => '',
		'background_color' => '',
		'builder_id' => '',
	), $atts));
	
	$return_html = '<div class="one skinbg" ';
	
	if(!empty($background_color))
	{
		$return_html.= 'style="background:'.esc_attr($background_color).'"';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper promo_box_wrapper">';
	$return_html.= do_shortcode('[tg_promo_box title="'.$title.'" button_text="'.rawurldecode($button_text).'" button_url="'.esc_url($button_url).'" button_style="button transparent"]'.$content.'[/tg_promo_box]');
	$return_html.='</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_promo_box', 'ppb_promo_box_func');


function ppb_testimonial_slider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slug' => '',
		'items' => '',
		'cat' => '',
		'bgcolor' => '',
		'fontcolor' => '',
		'background' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
		'widget_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	if(empty($widget_id))
	{
		wp_enqueue_script("flexslider", get_template_directory_uri()."/js/flexslider/jquery.flexslider-min.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		wp_enqueue_script("script-testimonials-flexslider", admin_url('admin-ajax.php')."?action=grandconference_script_testimonials_flexslider", false, GRANDCONFERENCE_THEMEVERSION, true);
	}
	
	$testimonials_order = 'ASC';
	$testimonials_order_by = 'menu_order';
	
	//Get testimonial items
	$args = array(
	    'numberposts' => $items,
	    'order' => $testimonials_order,
	    'orderby' => $testimonials_order_by,
	    'post_type' => array('testimonials'),
	);
	
	if(!empty($cat))
	{
		$args['testimonialcats'] = $cat;
	}
	$testimonial_arr = get_posts($args);
	
	$return_html = '';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
	}
	
	$return_html.= '" ';
	
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}

	if(!empty($background))
	{
		$custom_css.= 'background-image:url('.esc_url($background).');background-size:cover; ';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div class="page_content_wrapper" style="text-align:center"><div class="inner">';
	
	if(!empty($testimonial_arr) && is_array($testimonial_arr))
	{
		$return_html.= '<div class="testimonial_slider_wrapper">';
		$return_html.= '<div class="flexslider" data-height="750">';
		$return_html.= '<ul class="slides">';
		
		foreach($testimonial_arr as $key => $testimonial)
		{
			$testimonial_ID = $testimonial->ID;
		
			//Get testimonial meta
			$testimonial_name = get_post_meta($testimonial_ID, 'testimonial_name', true);
			
			$return_html.= '<li>';
			$return_html.= '<div class="testimonial_slider_wrapper">';
			
			if(!empty($testimonial->post_content))
			{
				$return_html.= $testimonial->post_content;
			}
			
			if(!empty($testimonial_name))
			{
				$return_html.= '<div class="testimonial_slider_meta">';
				
				//Get customer picture
				if(has_post_thumbnail($testimonial_ID, 'thumbnail'))
				{
				    $image_id = get_post_thumbnail_id($testimonial_ID);
				    $small_image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
				}
				
				if(!empty($small_image_url[0]))
				{
					$return_html.= '<div class="testimonial_image">';
					$return_html.='<img class="team_pic" src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($testimonial_name).'"/>';
					$return_html.= '</div>';
				}
				
				$return_html.= '<h6 ';
				
				if(!empty($fontcolor))
				{
				    $return_html.= 'style="color:'.esc_attr($fontcolor).'"';
				}
				
				$return_html.= '>'.$testimonial_name.'</h6>';
				
				$return_html.= '</div>';
			}
			
			$return_html.= '</div>';
			$return_html.= '</li>';
		}
		
		$return_html.= '</ul>';
		$return_html.= '</div>';
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_testimonial_slider', 'ppb_testimonial_slider_func');


function ppb_testimonial_column_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'columns' => 2,
		'items' => 4,
		'cat' => '',
		'fontcolor' => '',
		'bgcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	if(!is_numeric($columns))
	{
		$columns = 2;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_testimonial_column"';
	
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$testimonials_order = 'ASC';
	$testimonials_order_by = 'menu_order';
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	
	switch($columns)
	{	
		case 2:
			$count_column = 2;
			$columns_class = 'one_half';
		break;
		
		case 3:
		default:
			$count_column = 3;
			$columns_class = 'one_third';
		break;
		
		case 4:
			$count_column = 4;
			$columns_class = 'one_fourth';
		break;
	}
	
	//Get testimonial items
	$args = array(
	    'numberposts' => $items,
	    'order' => $testimonials_order,
	    'orderby' => $testimonials_order_by,
	    'post_type' => array('testimonials'),
	);
	
	if(!empty($cat))
	{
		$args['testimonialcats'] = $cat;
	}
	$testimonial_arr = get_posts($args);
	
	if(!empty($testimonial_arr) && is_array($testimonial_arr))
	{
		$return_html.= '<div class="page_content_wrapper"><div class="inner"><div class="testimonial_wrapper">';
	
		foreach($testimonial_arr as $key => $testimonial)
		{
			$image_url = '';
			$testimonial_ID = $testimonial->ID;
					
			//Get customer picture
			if(has_post_thumbnail($testimonial_ID, 'thumbnail'))
			{
			    $image_id = get_post_thumbnail_id($testimonial_ID);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
			}
			
			$last_class = '';
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			
			//Begin display HTML
			$return_html.= '<div class="'.esc_attr($columns_class).' testimonial_column_element animated'.($key+1).' '.esc_attr($last_class).'">';
			
			//Get testimonial meta
			$testimonial_name = get_post_meta($testimonial_ID, 'testimonial_name', true);
			$testimonial_position = get_post_meta($testimonial_ID, 'testimonial_position', true);
			$testimonial_company_name = get_post_meta($testimonial_ID, 'testimonial_company_name', true);
			$testimonial_company_website = get_post_meta($testimonial_ID, 'testimonial_company_website', true);
			
			if(!empty($small_image_url[0]))
			{
				$return_html.= '<div class="testimonial_image">';
				$return_html.='<img class="team_pic" src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($testimonial_name).'"/>';
				$return_html.= '</div>';
			}
			
			if(!empty($testimonial->post_content))
			{
				$return_html.= '<div class="testimonial_content">';
				$return_html.= $testimonial->post_content;
				
				if(!empty($testimonial_name))
				{
					$return_html.= '<br/><br/><div class="testimonial_customer">';
					$return_html.= '<h6 ';
					
					if(!empty($fontcolor))
					{
						$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
					}
					
					$return_html.= '>'.$testimonial_name.'</h6>';
					
					if(!empty($testimonial_position))
					{
						$return_html.= '<div class="testimonial_customer_position" ';
						
						if(!empty($fontcolor))
						{
							$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
						}
						
						$return_html.= '>'.$testimonial_position.'</div>';
					}
					
					if(!empty($testimonial_company_name))
					{
						$return_html.= '-<div class="testimonial_customer_company">';
						
						if(!empty($testimonial_company_website))
						{
							$return_html.= '<a href="'.esc_url($testimonial_company_website).'" target="_blank" ';
							
							if(!empty($fontcolor))
							{
								$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
							}
							
							$return_html.= '>';
						}
						
						$return_html.=$testimonial_company_name;
						
						if(!empty($testimonial_company_website))
						{
							$return_html.= '</a>';
						}
						
						$return_html.= '</div>';
					}
					
					$return_html.= '</div>';
				}
				
				$return_html.= '</div>';
			}
			
			$return_html.= '</div>';
		}
		
		$return_html.= '</div></div></div>';
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_testimonial_column', 'ppb_testimonial_column_func');


function ppb_venue_column_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'venue1_image' => '',
		'venue1_title' => '',
		'venue1_subtitle' => '',
		'venue1_url' => '',
		'venue1_rate' => '',
		'venue2_image' => '',
		'venue2_title' => '',
		'venue2_subtitle' => '',
		'venue2_url' => '',
		'venue2_rate' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_venue_column"';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//Venue 1
	if(!empty($venue1_image) OR !empty($venue1_title))
	{
		$return_html.= '<div class="one_half">';
		$return_html.= '<div class="venue_image">';
		
		if(!empty($venue1_image))
		{
			if(!empty($venue1_url))
			{
				$return_html.= '<a href="'.esc_url($venue1_url).'" target="_blank">';
			}
			
			$image_id = grandconference_get_image_id($venue1_image);
			if(!empty($image_id))
			{
			 	$obj_image = wp_get_attachment_image_src($image_id, 'grandconference-blog');
			 	
			 	if(isset($obj_image[0]) && !empty($obj_image[0]))
			 	{
				 	$venue1_image = $obj_image[0];
			 	}
			}
			$return_html.= '<img src="'.esc_url($venue1_image).'" alt="'.esc_attr($venue1_title).'"/>';
			
			if(!empty($venue1_url))
			{
				$return_html.= '</a>';
			}
		}
		
		$return_html.= '</div>';
		
		if(!empty($venue1_title))
		{
			$return_html.= '<div class="venue_content_wrapper">';
			
			$return_html.= '<div class="venue_content">';
			$return_html.= '<h4>'.$venue1_title.'</h4>';
			
			if(!empty($venue1_subtitle))
			{
				$return_html.= '<div class="venue_desc">'.$venue1_subtitle.'</div>';
			}
			
			$return_html.= '</div>';
			
			if(!empty($venue1_rate))
			{
				$return_html.= '<div class="venue_rate">';
				$return_html.= '<div class="venue_rate_label skin_color">'.esc_html__('Rate', 'grandconference-custom-post' ).'</div>';
				$return_html.= '<div class="venue_rate_content">'.$venue1_rate.'</div>';
				$return_html.= '</div>';
			}
			
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	//Venue 2
	if(!empty($venue2_image) OR !empty($venue2_title))
	{
		$return_html.= '<div class="one_half last">';
		$return_html.= '<div class="venue_image">';
		
		if(!empty($venue2_image))
		{
			if(!empty($venue2_url))
			{
				$return_html.= '<a href="'.esc_url($venue2_url).'" target="_blank">';
			}
			
			$image_id = grandconference_get_image_id($venue2_image);
			if(!empty($image_id))
			{
			 	$obj_image = wp_get_attachment_image_src($image_id, 'grandconference-blog');
			 	
			 	if(isset($obj_image[0]) && !empty($obj_image[0]))
			 	{
				 	$venue2_image = $obj_image[0];
			 	}
			}
			
			$return_html.= '<img src="'.esc_url($venue2_image).'" alt="'.esc_attr($venue2_title).'"/>';
			
			if(!empty($venue2_url))
			{
				$return_html.= '</a>';
			}
		}
		
		$return_html.= '</div>';
		
		if(!empty($venue2_title))
		{
			$return_html.= '<div class="venue_content_wrapper">';
			
			$return_html.= '<div class="venue_content">';
			$return_html.= '<h4>'.$venue2_title.'</h4>';
			
			if(!empty($venue2_subtitle))
			{
				$return_html.= '<div class="venue_desc">'.$venue2_subtitle.'</div>';
			}
			
			$return_html.= '</div>';
			
			if(!empty($venue2_rate))
			{
				$return_html.= '<div class="venue_rate">';
				$return_html.= '<div class="venue_rate_label skin_color">'.esc_html__('Rate', 'grandconference-custom-post' ).'</div>';
				$return_html.= '<div class="venue_rate_content">'.$venue2_rate.'</div>';
				$return_html.= '</div>';
			}
			
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
		
	$return_html.= '</div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_venue_column', 'ppb_venue_column_func');


function ppb_contact_map_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'slug' => '',
		'subtitle' => '',
		'lat' => 0,
		'long' => 0,
		'zoom' => 8,
		'type' => '',
		'popup' => '',
		'address' => '',
		'marker' => '',
		'bgcolor' => '',
		'fontcolor' => '',
		'buttonbgcolor' => '',
		'custom_css' => '',
		'contactform' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_contact_map one nopadding" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="floatleft nopadding"><div class="one_half_bg contact_form" ';
	
	$contact_form_custom_css = '';
	if(!empty($bgcolor))
	{
		$contact_form_custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$contact_form_custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($contact_form_custom_css))
	{
		$return_html.= 'style="'.esc_attr($contact_form_custom_css).'"';
	}
	
	$return_html.= '>';
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	if(!empty($fontcolor))
	{
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title" ';
		if(!empty($fontcolor))
		{
			$return_html.= 'style="'.esc_attr($custom_css_fontcolor).';"';
		}
		$return_html.= '>'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
	}
	
	//Display Content
	if(!empty($subtitle))
	{
		$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
	}
	
	//Display Content
	if(!empty($content))
	{
		$return_html.= '<div class="ppb_header_content">'.rawurldecode($content).'</div>';
	}
	
	//Display contact form
    
    //Setup Google Map API Key
	grandconference_set_map_api();
	$custom_id = time().rand();

	$return_html.= '<div class="contact_form7_wrapper">';
  	$return_html.= do_shortcode('[contact-form-7 id="'.esc_attr($contactform).'"]');	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Display Map
	$return_html.= '<div class="one_half_bg nopadding" style="height:100%">';
	$return_html.= '<div id="map'.$custom_id.'" class="map_shortcode_wrapper" style="width:100%;height:100%">';
	$return_html.= '<div class="map-marker" ';
	
	if(!empty($popup))
	{
		$return_html.= 'data-title="'.esc_attr(rawurldecode($popup)).'" ';
	}
	
	if(!empty($lat) && !empty($long))
	{
		$return_html.= 'data-latlng="'.esc_attr(rawurldecode($lat)).','.esc_attr(rawurldecode($long)).'" ';
	}
	
	if(!empty($address))
	{
		$return_html.= 'data-address="'.esc_attr(rawurldecode($address)).'" ';
	}
	
	if(!empty($marker))
	{
		$return_html.= 'data-icon="'.esc_attr(rawurldecode($marker)).'" ';
	}
		
	$return_html.= '>';
	
	if(!empty($popup))
	{
		$return_html.= '<div class="map-infowindow">'.rawurldecode($popup).'</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	$ext_attr = array(
		'id' => 'map'.$custom_id,
		'zoom' => $zoom,
		'type' => $type,
	);
	
	$ext_attr_serialize = serialize($ext_attr);
	
	wp_enqueue_script("simplegmaps", get_template_directory_uri()."/js/jquery.simplegmaps.min.js", false, GRANDCONFERENCE_THEMEVERSION, true);
	wp_enqueue_script("script-contact-map".$custom_id, admin_url('admin-ajax.php')."?action=grandconference_script_map_shortcode&fullheight=true&data=".$ext_attr_serialize, false, GRANDCONFERENCE_THEMEVERSION, true);
	$return_html.= '</div>';
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_contact_map', 'ppb_contact_map_func');


function ppb_contact_sidebar_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'slug' => '',
		'subtitle' => '',
		'sidebar' => '',
		'sidebar_layout' => 'left',
		'padding' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'contactform' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$sidebar_class = '';
	if($sidebar_layout == 'left')
	{
		$sidebar_class = 'left_sidebar';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="ppb_contact_sidebar one withsmallpadding" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.rawurldecode($custom_css).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner"><div class="inner_wrapper">';
	
	$return_html.= '<div class="sidebar_content '.esc_attr($sidebar_class).'">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
	}
	
	//Display Content
	if(!empty($subtitle))
	{
		$return_html.= '<div class="page_tagline">'.rawurldecode($subtitle).'</div>';
	}
	
	//Display Content
	if(!empty($content))
	{
		$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
	}
	
	//Display contact form
	$return_html.= '<div class="contact_form7_wrapper">';
  	$return_html.= do_shortcode('[contact-form-7 id="'.esc_attr($contactform).'"]');	
	$return_html.= '</div>';
	
	$return_html.= '</div>';
	
	//Display Sidebar
	$return_html.= '<div class="sidebar_wrapper '.esc_attr($sidebar_class).'"><div class="sidebar"><div class="content"><ul class="sidebar_widget">';
	$return_html.= grandconference_get_dynamic_sidebar(rawurldecode($sidebar));
	$return_html.= '</ul></div></div></div>';
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_contact_sidebar', 'ppb_contact_sidebar_func');


function ppb_contact_half_bg_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'background' => '',
		'background_parallax' => '',
		'background_position' => '',
		'padding' => 30,
		'bgcolor' => '#000000',
		'opacity' => 100,
		'fontcolor' => '',
		'align' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'parallax' => 0,
		'contactform' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$bgcolor = '#ffffff';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_contact_half_bg ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
		$custom_css.= 'background-image:url('.esc_url($background).');';
	}
	
	$parallax_stellar = '';
	if(!empty($parallax))
	{
		$return_html.= 'parallax ';
		$parallax_stellar.= 'data-stellar-ratio="1.3"';
	}
	
	if(!empty($background_position))
	{
		$custom_css.= 'background-position: center '.esc_attr($background_position).';';
	}
	
	$return_html.= '"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($title) OR !empty($subtitle) OR !empty($content))
	{
		$custom_bgcolor_css = '';
		if(!empty($bgcolor))
		{
			$ori_bgcolor = $bgcolor;
			$opacity = $opacity/100;
			$bgcolor = grandconference_hex_to_rgb($bgcolor);
		
			$custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
			$custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
			$custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
		}
		
		$custom_css_fontcolor = '';
		$custom_css_bordercolor = '';
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
		}
	
		if($align == 'left')
		{
			$return_html.= '<div class="one_half_bg" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'" '.$parallax_stellar.'>';
		}
		else
		{
			$return_html.= '<div class="one_half_bg floatright" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'" '.$parallax_stellar.'>';
		}
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		
		//Display contact form
		$return_html.= '<div class="contact_form7_wrapper">';
	  	$return_html.= do_shortcode('[contact-form-7 id="'.esc_attr($contactform).'"]');	
		$return_html.= '</div>';
		$return_html.= '</div>';
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_contact_half_bg', 'ppb_contact_half_bg_func');


function ppb_contact_box_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'padding' => 30,
		'bgcolor' => '#ffffff',
		'bordercolor' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'width' => 100,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'contactform' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$bgcolor = '#ffffff';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_contact_box ';
	
	$return_html.= '"';
	
	$custom_css = 'text-align:'.esc_attr($textalign).';';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	$custom_bgcolor_css = '';
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	if(!empty($bgcolor))
	{
		$custom_bgcolor_css.= 'background:'.esc_attr($bgcolor).';';
	}
	if(!empty($bordercolor))
	{
		$custom_css_bordercolor.= 'border:10px solid '.esc_attr($bordercolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($title) OR !empty($subtitle) OR !empty($content))
	{
		$return_html.= '<div class="inner_box parallax" style="width:'.intval($width).'%;margin:auto;'.esc_attr($custom_bgcolor_css).esc_attr($custom_css_bordercolor).'padding:'.esc_attr($padding).'px;" data-stellar-ratio="1.2">';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		
		//Display contact form
		$return_html.= '<div class="contact_form7_wrapper">';
	  	$return_html.= do_shortcode('[contact-form-7 id="'.esc_attr($contactform).'"]');	
		$return_html.= '</div>';
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_contact_box', 'ppb_contact_box_func');


function ppb_map_func($atts) {
	//extract short code attr
	extract(shortcode_atts(array(
		'height' => 600,
		'slug' => '',
		'lat' => 0,
		'long' => 0,
		'zoom' => 8,
		'type' => '',
		'popup' => '',
		'address' => '',
		'marker' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="one nopadding">';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);

	$custom_id = time().rand();
	$return_html.= '<div class="map_shortcode_wrapper" id="map'.$custom_id.'" style="width:100%;height:'.esc_attr($height).'px">';
	$return_html.= '<div class="map-marker" ';
	
	if(!empty($popup))
	{
		$return_html.= 'data-title="'.esc_attr(rawurldecode($popup)).'" ';
	}
	
	if(!empty($lat) && !empty($long))
	{
		$return_html.= 'data-latlng="'.esc_attr(rawurldecode($lat)).','.esc_attr(rawurldecode($long)).'" ';
	}
	
	if(!empty($address))
	{
		$return_html.= 'data-address="'.esc_attr(rawurldecode($address)).'" ';
	}
	
	if(!empty($marker))
	{
		$return_html.= 'data-icon="'.esc_attr(rawurldecode($marker)).'" ';
	}
		
	$return_html.= '>';
	
	if(!empty($popup))
	{
		$return_html.= '<div class="map-infowindow">'.rawurldecode($popup).'</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	$ext_attr = array(
		'id' => 'map'.$custom_id,
		'zoom' => $zoom,
		'type' => $type,
	);
	
	$ext_attr_serialize = serialize($ext_attr);
	
	//Setup Google Map API Key
	grandconference_set_map_api();
	
	wp_enqueue_script("simplegmaps", get_template_directory_uri()."/js/jquery.simplegmaps.min.js", false, GRANDCONFERENCE_THEMEVERSION, true);
	wp_enqueue_script("script-contact-map".$custom_id, admin_url('admin-ajax.php')."?action=grandconference_script_map_shortcode&data=".$ext_attr_serialize, false, GRANDCONFERENCE_THEMEVERSION, true);

	return $return_html;

}

add_shortcode('ppb_map', 'ppb_map_func');


function ppb_content_half_map_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'lat' => 0,
		'long' => 0,
		'zoom' => 8,
		'type' => '',
		'marker' => '',
		'padding' => 30,
		'bgcolor' => '#ffffff',
		'opacity' => 100,
		'fontcolor' => '',
		'align' => '',
		'height' => 600,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'parallax' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$bgcolor = '#ffffff';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_content_half_map" ';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$custom_id = time().rand();
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="map_shortcode_wrapper" id="map'.$custom_id.'" style="width:100%;height:'.esc_attr($height).'px">';
	$return_html.= '<div class="map-marker" ';
	
	if(!empty($lat) && !empty($long))
	{
		$return_html.= 'data-latlng="'.esc_attr(rawurldecode($lat)).','.esc_attr(rawurldecode($long)).'" ';
	}
	
	if(!empty($marker))
	{
		$return_html.= 'data-icon="'.esc_attr(rawurldecode($marker)).'" ';
	}
		
	$return_html.= '>';
	
	if(!empty($popup))
	{
		$return_html.= '<div class="map-infowindow">'.rawurldecode($popup).'</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($title) OR !empty($subtitle) OR !empty($content))
	{
		$custom_bgcolor_css = '';
		if(!empty($bgcolor))
		{
			$ori_bgcolor = $bgcolor;
			$opacity = $opacity/100;
			$bgcolor = grandconference_hex_to_rgb($bgcolor);
		
			$custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
			$custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
			$custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
		}
		
		$custom_css_fontcolor = '';
		$custom_css_bordercolor = '';
		$custom_css_fontitlecolor = '';
		
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
		}
	
		if($align == 'left')
		{
			$return_html.= '<div class="one_third_bg" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'padding:'.esc_attr($padding).'px;'.esc_attr($padding).'px 0;" data-stellar-ratio="1.3">';
		}
		else
		{
			$return_html.= '<div class="one_third_bg floatright" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'padding:'.esc_attr($padding).'px;" data-stellar-ratio="1.3">';
		}
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	$ext_attr = array(
		'id' => 'map'.$custom_id,
		'zoom' => $zoom,
		'type' => $type,
	);
	
	$ext_attr_serialize = serialize($ext_attr);
	
	//Setup Google Map API Key
	grandconference_set_map_api();
	
	wp_enqueue_script("simplegmaps", get_template_directory_uri()."/js/jquery.simplegmaps.min.js", false, GRANDCONFERENCE_THEMEVERSION, true);
	wp_enqueue_script("script-contact-map".$custom_id, admin_url('admin-ajax.php')."?action=grandconference_script_map_shortcode&data=".$ext_attr_serialize, false, GRANDCONFERENCE_THEMEVERSION, true);

	return $return_html;

}

add_shortcode('ppb_content_half_map', 'ppb_content_half_map_func');


function ppb_animated_gallery_grid_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slug' => '',
		'gallery_id' => '',
		'rows' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$custom_css = '';
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" style="'.esc_attr(rawurldecode($custom_css)).'">';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$images_arr = get_post_meta($gallery_id, 'wpsimplegallery_gallery', true);
	
	if(!empty($images_arr))
	{
		//Get contact form random ID
		$custom_id = time().rand();
	
		wp_enqueue_script("modernizr", get_template_directory_uri()."/js/modernizr.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		wp_enqueue_script("gridrotator", get_template_directory_uri()."/js/jquery.gridrotator.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		wp_enqueue_script("grandconference-script-gridrotator-".$custom_id, admin_url('admin-ajax.php')."?action=grandconference_script_gridrotator&grid=".$custom_id.'&rows='.$rows, false, GRANDCONFERENCE_THEMEVERSION, true);
		
		$return_html.= '<div id="'.$custom_id.'" class="ri-grid ri-grid-size-3">';
		
		$return_html.= '<ul>';
		
		foreach($images_arr as $key => $image)
		{
			$image_url = wp_get_attachment_image_src($image, 'thumbnail', true);
			$image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
			
			$return_html.= '<li><a href="javascript:;"><img src="'.esc_url($image_url[0]).'" alt="'.esc_attr($image_alt).'"/></a></li>';
		}
		
		$return_html.= '</ul>';
		$return_html.= '</div>';
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_animated_gallery_grid', 'ppb_animated_gallery_grid_func');


function ppb_header_youtube_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'width' => '100',
		'padding' => 30,
		'youtube' => '',
		'bgcolor' => '#000000',
		'opacity' => 100,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	if($size != 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_header_youtube withbg parallax" ';
	
	if(!empty($youtube))
	{
		//Add jarallax video script
		wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		
		$return_html.= 'data-jarallax-video="'.esc_url($youtube).'" ';
	}
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	if(!empty($titlecolor))
	{
		$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$custom_bgcolor_css = '';
	if(!empty($bgcolor))
	{
	    $ori_bgcolor = $bgcolor;
	    $opacity = $opacity/100;
	    $bgcolor = grandconference_hex_to_rgb($bgcolor);
	
	    $custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
	    $custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    $custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    
	    $return_html.= '<div class="overlay_background" style="'.esc_attr($custom_bgcolor_css).'"></div>';
	}
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if($size == 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(rawurldecode($width)).'%">';
	}
	
	//Add title and content
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
	}
	
	if(!empty($subtitle))
	{
		$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode($subtitle).'</div>';
	}
	
	if(!empty($content))
	{
		$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
	}
	
	$return_html.= '</div>';
	
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	if($size != 'one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_header_youtube', 'ppb_header_youtube_func');


function ppb_header_vimeo_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'width' => '100',
		'padding' => 30,
		'vimeo' => '',
		'bgcolor' => '#000000',
		'opacity' => 100,
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	if($size != 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_header_vimeo withbg parallax" ';
	
	if(!empty($vimeo))
	{
		//Add jarallax video script
		wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		
		$return_html.= 'data-jarallax-video="'.esc_url($vimeo).'" ';
	}
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($titlecolor))
	{
		$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$custom_bgcolor_css = '';
	if(!empty($bgcolor))
	{
	    $ori_bgcolor = $bgcolor;
	    $opacity = $opacity/100;
	    $bgcolor = grandconference_hex_to_rgb($bgcolor);
	
	    $custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
	    $custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    $custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
	    
	    $return_html.= '<div class="overlay_background" style="'.esc_attr($custom_bgcolor_css).'"></div>';
	}
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if($size == 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(rawurldecode($width)).'%">';
	}
	
	//Add title and content
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
	}
	
	if(!empty($subtitle))
	{
		$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).';text-align:'.esc_attr($textalign).';">'.rawurldecode($subtitle).'</div>';
	}
	
	if(!empty($content))
	{
		$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
	}
	
	$return_html.= '</div>';
	
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	if($size != 'one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_header_vimeo', 'ppb_header_vimeo_func');


function ppb_youtube_parallax_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slug' => '',
		'youtube' => '',
		'height' => 50,
		'display_title' => 1,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	if(!is_numeric($height))
	{
		$height = 80;
	}
	
	if($height > 100)
	{
		$height = 100;
	}
	
	$image_id = '';
	
	//Set begin wrapper div for live builder
	$return_html = grandconference_live_builder_begin_wrapper($builder_id);

	$return_html.= '<div '.$sec_id.' class="parallax" ';
	
	if(!empty($youtube))
	{
		//Add jarallax video script
		wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		
		$return_html.= 'data-jarallax-video="'.esc_url($youtube).'" ';
	}
		
	if(!empty($height))
	{
		$custom_css.= 'height:'.$height.'vh; ';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'"';
	}
	
	$return_html.= '>';
	
	$return_html.= '</div>';
	
	if(!empty($display_title))
	{
		if(!empty($title))
		{
			$return_html.= '<div class="ppb_image_caption">'.$title.'</div>';
		}
	}

	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);

	return $return_html;
}

add_shortcode('ppb_youtube_parallax', 'ppb_youtube_parallax_func');


function ppb_vimeo_parallax_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slug' => '',
		'vimeo' => '',
		'height' => 50,
		'display_title' => 1,
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	if(!is_numeric($height))
	{
		$height = 80;
	}
	
	if($height > 100)
	{
		$height = 100;
	}
	
	$image_id = '';
	
	//Set begin wrapper div for live builder
	$return_html = grandconference_live_builder_begin_wrapper($builder_id);

	$return_html.= '<div '.$sec_id.' class="parallax" ';
	
	if(!empty($vimeo))
	{
		//Add jarallax video script
		wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		
		$return_html.= 'data-jarallax-video="'.esc_url($vimeo).'" ';
	}
		
	if(!empty($height))
	{
		$custom_css.= 'height:'.$height.'vh; ';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'"';
	}
	
	$return_html.= '>';
	
	$return_html.= '</div>';
	
	if(!empty($display_title))
	{
		if(!empty($title))
		{
			$return_html.= '<div class="ppb_image_caption">'.$title.'</div>';
		}
	}

	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);

	return $return_html;
}

add_shortcode('ppb_vimeo_parallax', 'ppb_vimeo_parallax_func');


function ppb_content_half_youtube_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'padding' => 30,
		'bgcolor' => '#000000',
		'opacity' => 100,
		'fontcolor' => '',
		'align' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'youtube' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$bgcolor = '#ffffff';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_content_half_youtube parallax" ';
	
	if(!empty($youtube))
	{
		//Add jarallax video script
		wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		
		$return_html.= 'data-jarallax-video="'.esc_url($youtube).'" ';
	}
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($title) OR !empty($subtitle) OR !empty($content))
	{
		$custom_bgcolor_css = '';
		if(!empty($bgcolor))
		{
			$ori_bgcolor = $bgcolor;
			$opacity = $opacity/100;
			$bgcolor = grandconference_hex_to_rgb($bgcolor);
		
			$custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
			$custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
			$custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
		}
		
		$custom_css_fontcolor = '';
		$custom_css_bordercolor = '';
		$custom_css_fontitlecolor = '';
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
		}
		if(!empty($titlecolor))
		{
			$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
		}
	
		if($align == 'left')
		{
			$return_html.= '<div class="one_half_bg" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'" data-stellar-ratio="1.3">';
		}
		else
		{
			$return_html.= '<div class="one_half_bg floatright" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'" data-stellar-ratio="1.3">';
		}
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_content_half_youtube', 'ppb_content_half_youtube_func');


function ppb_content_half_vimeo_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'padding' => 30,
		'bgcolor' => '#000000',
		'opacity' => 100,
		'fontcolor' => '',
		'align' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'vimeo' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$bgcolor = '#ffffff';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_content_half_vimeo parallax" ';
	
	if(!empty($vimeo))
	{
		//Add jarallax video script
		wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		
		$return_html.= 'data-jarallax-video="'.esc_url($vimeo).'" ';
	}
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($title) OR !empty($subtitle) OR !empty($content))
	{
		$custom_bgcolor_css = '';
		if(!empty($bgcolor))
		{
			$ori_bgcolor = $bgcolor;
			$opacity = $opacity/100;
			$bgcolor = grandconference_hex_to_rgb($bgcolor);
		
			$custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
			$custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
			$custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
		}
		
		$custom_css_fontcolor = '';
		$custom_css_bordercolor = '';
		$custom_css_fontitlecolor = '';
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
		}
		if(!empty($titlecolor))
		{
			$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
		}
	
		if($align == 'left')
		{
			$return_html.= '<div class="one_half_bg" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'" data-stellar-ratio="1.3">';
		}
		else
		{
			$return_html.= '<div class="one_half_bg floatright" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'" data-stellar-ratio="1.3">';
		}
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_content_half_vimeo', 'ppb_content_half_vimeo_func');


function ppb_content_center_youtube_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'padding' => 30,
		'height' => 600,
		'bgcolor' => '#000000',
		'opacity' => 100,
		'fontcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'youtube' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$bgcolor = '#ffffff';
	}
	
	if(empty($height))
	{
		$height = 600;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_content_center_bg withbg parallax" ';
	
	if(!empty($youtube))
	{
		//Add jarallax video script
		wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		
		$return_html.= 'data-jarallax-video="'.esc_url($youtube).'" ';
	}
	
	if(!empty($height))
	{
		$custom_css.= 'height:'.intval($height).'px;';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if(!empty($title) OR !empty($subtitle) OR !empty($content))
	{
		$custom_bgcolor_css = '';
		if(!empty($bgcolor))
		{
			$ori_bgcolor = $bgcolor;
			$opacity = $opacity/100;
			$bgcolor = grandconference_hex_to_rgb($bgcolor);
		
			$custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
			$custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
			$custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
		}
		
		$custom_css_fontcolor = '';
		$custom_css_bordercolor = '';
		$custom_css_fontitlecolor = '';
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
		}
		
		if(!empty($titlecolor))
		{
			$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
		}
	
		$return_html.= '<div class="one_third" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).';padding:'.esc_attr($padding).'px;" data-stellar-ratio="1.3">';
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		$return_html.= '</div>';
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_content_center_youtube', 'ppb_content_center_youtube_func');


function ppb_content_center_vimeo_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'padding' => 30,
		'height' => 600,
		'bgcolor' => '#000000',
		'opacity' => 100,
		'fontcolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'vimeo' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$bgcolor = '#ffffff';
	}
	
	if(empty($height))
	{
		$height = 600;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_content_center_bg withbg parallax" ';
	
	if(!empty($vimeo))
	{
		//Add jarallax video script
		wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
		
		$return_html.= 'data-jarallax-video="'.esc_url($vimeo).'" ';
	}
	
	if(!empty($height))
	{
		$custom_css.= 'height:'.intval($height).'px;';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	if(!empty($title) OR !empty($subtitle) OR !empty($content))
	{
		$custom_bgcolor_css = '';
		if(!empty($bgcolor))
		{
			$ori_bgcolor = $bgcolor;
			$opacity = $opacity/100;
			$bgcolor = grandconference_hex_to_rgb($bgcolor);
		
			$custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
			$custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
			$custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
		}
		
		$custom_css_fontcolor = '';
		$custom_css_bordercolor = '';
		$custom_css_fontitlecolor = '';
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
			$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
		}
		if(!empty($titlecolor))
		{
			$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
		}
	
		$return_html.= '<div class="one_third" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).';padding:'.esc_attr($padding).'px;" data-stellar-ratio="1.3">';
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		$return_html.= '</div>';
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_content_center_vimeo', 'ppb_content_center_vimeo_func');


function ppb_youtube_two_third_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'height' => 500,
		'align' => 1,
		'youtube' => '',
		'bgcolor' => '',
		'fontcolor' => '',
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($height))
	{
		$height = 500;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="ppb_image_two_third_fullwidth '.esc_attr($size).'" ';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	if(!empty($titlecolor))
	{
		$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$content_custom_css = '';
	if($align=='left')
	{
		$return_html.= '<div class="two_third_bg parallax" ';

		if(!empty($youtube))
		{
			//Add jarallax video script
			wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
			
			$return_html.= 'data-jarallax-video="'.esc_url($youtube).'" ';
		}
		
		$return_html.= ' style="height:'.esc_attr($height).'px;"></div>';
		
		$return_html.= '<div class="one_third_bg" style="height:'.esc_attr($height).'px;">';
		
		$return_html.= '<div class="center_wrapper"><div class="inner_content">';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		//Add title and content
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		
		$return_html.= '</div>';
		$return_html.= '</div>';
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_third_bg textright" style="height:'.esc_attr($height).'px;">';
		
		$return_html.= '<div class="center_wrapper"><div class="inner_content">';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		//Add title and content
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
	
		$return_html.= '</div>';
		$return_html.= '</div>';
		$return_html.= '</div>';
		
		$return_html.= '<div class="two_third_bg parallax" ';

		if(!empty($youtube))
		{
			//Add jarallax video script
			wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
			
			$return_html.= 'data-jarallax-video="'.esc_url($youtube).'" ';
		}
		
		$return_html.= ' style="height:'.esc_attr($height).'px;"></div>';
	}
	
	$return_html.= '<br class="clear"/>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_youtube_two_third_fullwidth', 'ppb_youtube_two_third_fullwidth_func');


function ppb_vimeo_two_third_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'height' => 500,
		'align' => 1,
		'vimeo' => '',
		'bgcolor' => '',
		'fontcolor' => '',
		'custom_css' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($height))
	{
		$height = 500;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="ppb_image_two_third_fullwidth '.esc_attr($size).'" ';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	if(!empty($titlecolor))
	{
		$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$content_custom_css = '';
	if($align=='left')
	{
		$return_html.= '<div class="two_third_bg parallax" ';

		if(!empty($vimeo))
		{
			//Add jarallax video script
			wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
			
			$return_html.= 'data-jarallax-video="'.esc_url($vimeo).'" ';
		}
		
		$return_html.= ' style="height:'.esc_attr($height).'px;"></div>';
		
		$return_html.= '<div class="one_third_bg" style="height:'.esc_attr($height).'px;">';
		
		$return_html.= '<div class="center_wrapper"><div class="inner_content">';
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		//Add title and content
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		
		$return_html.= '</div>';
		$return_html.= '</div>';
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_third_bg textright" style="height:'.esc_attr($height).'px;">';
		
		$return_html.= '<div class="center_wrapper"><div class="inner_content">';
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		//Add title and content
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
	
		$return_html.= '</div>';
		$return_html.= '</div>';
		$return_html.= '</div>';
		
		$return_html.= '<div class="two_third_bg parallax" ';

		if(!empty($vimeo))
		{
			//Add jarallax video script
			wp_enqueue_script("jarallax-video", get_template_directory_uri()."/js/jarallax-video.js", false, GRANDCONFERENCE_THEMEVERSION, true);
			
			$return_html.= 'data-jarallax-video="'.esc_url($vimeo).'" ';
		}
		
		$return_html.= ' style="height:'.esc_attr($height).'px;"></div>';
	}
	
	$return_html.= '<br class="clear"/>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_vimeo_two_third_fullwidth', 'ppb_vimeo_two_third_fullwidth_func');


function ppb_card_two_cols_with_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'titlecolor' => '',
		'subtitle' => '',
		'slug' => '',
		'image_width' => 50,
		'image' => '',
		'align' => 1,
		'content_width' => 50,
		'padding' => 0,
		'bgcolor' => '#fff',
		'fontcolor' => '',
		'bordercolor' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($image_width))
	{
		$image_width = 50;
	}
	if(!is_numeric($content_width))
	{
		$content_width = 50;
	}
	
	if(empty($bgcolor))
	{
		$bgcolor = '#fff';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' ppb_card_two_cols_with_image" ';
	$custom_css.= 'position:relative;padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	$custom_css_fontitlecolor = '';
	
	if(!empty($fontcolor))
	{
	    $custom_css.= 'color:'.esc_attr($fontcolor).';';
	    $custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
	    $custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}

	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	//Get content block custom CSS
	$content_custom_css = 'background:'.esc_attr($bgcolor).';';
	
	if(!empty($bordercolor))
	{
	    $content_custom_css.= 'border: 1px solid '.$bordercolor.';';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if($align=='left')
	{
		$return_html.= '<div class="one_half parallax_scroll_image" style="width:'.esc_attr($image_width).'%;">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			$return_html.= '<img src="'.esc_url($image).'" alt="" class="portfolio_img"/>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;padding:'.esc_attr($padding).'px;'.esc_attr($content_custom_css).'" data-stellar-ratio="1.3">';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_half parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;padding:'.esc_attr($padding).'px;z-index:2;block !important;'.esc_attr($content_custom_css).'" data-stellar-ratio="1.3">';
		
		//Add title and content
		if(!empty($title))
		{
			if(!empty($titlecolor))
			{
				$custom_css_fontitlecolor.= 'color:'.$titlecolor.';';
			}
			
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontitlecolor).'">'.rawurldecode(grandconference_get_first_title_word($title)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="page_tagline" style="'.esc_attr($custom_css_fontcolor).'">'.rawurldecode($subtitle).'</div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="ppb_header_content">'.do_shortcode(grandconference_apply_content($content)).'</div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half parallax_scroll_image last" style="width:'.$image_width.'%;">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			$return_html.= '<img src="'.esc_url($image).'" alt="" class="portfolio_img"/>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_card_two_cols_with_image', 'ppb_card_two_cols_with_image_func');


function ppb_sponsor_column_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'image3' => '',
		'image4' => '',
		'image5' => '',
		'margin_top' => 0,
		'margin_right' => 0,
		'margin_bottom' => 0,
		'margin_left' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="ppb_sponsor_column '.esc_attr($size).'" ';
	
	$custom_css.= '';
	
	if(!empty($margin_top))
	{
		$custom_css.= 'margin-top:'.esc_attr($margin_top).'px;';
	}
	if(!empty($margin_right))
	{
		$custom_css.= 'margin-right:'.esc_attr($margin_right).'px;';
	}
	if(!empty($margin_bottom))
	{
		$custom_css.= 'margin-bottom:'.esc_attr($margin_bottom).'px;';
	}
	if(!empty($margin_left))
	{
		$custom_css.= 'margin-left:'.esc_attr($margin_left).'px;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(rawurldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandconference_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//First image
	if(!empty($image1))
	{
		$return_html.= '<div class="one_fifth">';
		
		$image_id = grandconference_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
		$return_html.= '<div class="sponser_wrapper"><div class="sponser_content">';
	    $return_html.= '<img src="'.esc_url($image1).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    $return_html.= '</div></div>';
	    
	    $return_html.= '</div>';
	}
	
	//Second image
	if(!empty($image2))
	{
		$return_html.= '<div class="one_fifth">';
		
		$image_id = grandconference_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
		$return_html.= '<div class="sponser_wrapper"><div class="sponser_content">';
	    $return_html.= '<img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    $return_html.= '</div></div>';
	    
	    $return_html.= '</div>';
	}
	
	//Third image
	if(!empty($image3))
	{
		$return_html.= '<div class="one_fifth">';
		
		$image_id = grandconference_get_image_id($image3);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
		$return_html.= '<div class="sponser_wrapper"><div class="sponser_content">';
	    $return_html.= '<img src="'.esc_url($image3).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    $return_html.= '</div></div>';
	    
	    $return_html.= '</div>';
	}
	
	//Fourth image
	if(!empty($image4))
	{
		$return_html.= '<div class="one_fifth">';
		
		$image_id = grandconference_get_image_id($image4);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
		$return_html.= '<div class="sponser_wrapper"><div class="sponser_content">';
	    $return_html.= '<img src="'.esc_url($image4).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    $return_html.= '</div></div>';
	    
	    $return_html.= '</div>';
	}
	
	//Fifth image
	if(!empty($image5))
	{
		$return_html.= '<div class="one_fifth last">';
		
		$image_id = grandconference_get_image_id($image5);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
		$return_html.= '<div class="sponser_wrapper"><div class="sponser_content">';
	    $return_html.= '<img src="'.esc_url($image5).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/>';
	    $return_html.= '</div></div>';
	    
	    $return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandconference_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_sponsor_column', 'ppb_sponsor_column_func');


function ppb_revslider_func($atts, $content) {
	
    //extract short code attr
    extract(shortcode_atts(array(
    	'size' => 'one',
    	'slug' => '',
    	'slider_id' => '',
    	'display' => '',
    	'builder_id' => '',
    ), $atts));
    
    $sec_id = '';
    if(!empty($slug))
    {
    	$sec_id = 'id="'.esc_attr($slug).'"';
    }

    $return_html = '<div '.$sec_id.' class="'.esc_attr($size).' fullwidth ';
    
    if($display == 'force')
    {
    	$return_html.= 'slideronly';
    }
    
    $return_html.= '">';
    
    //Set begin wrapper div for live builder
    $return_html.= grandconference_live_builder_begin_wrapper($builder_id);
    
    $return_html.= do_shortcode('[rev_slider '.$slider_id.']');
    
    //Set end wrapper div for live builder
    $return_html.= grandconference_live_builder_end_wrapper($builder_id);
    
    $return_html.= '</div>';

    return $return_html;

}

add_shortcode('ppb_revslider', 'ppb_revslider_func');
?>
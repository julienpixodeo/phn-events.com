<?php
	$animation_class = '';
	if(isset($settings['disable_animation']))
	{
		$animation_class = 'disable_'.$settings['disable_animation'];
	}	
?>

<!-- Begin each blog post -->
<div <?php post_class('blog-posts-'.$settings['layout']); ?>>

	<div class="post-wrapper">
		
		<div class="post-header-wrapper text-<?php echo esc_attr($settings['text_align']); ?>">
			<div class="post-header">
				<div class="post-header-title">
					<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
				</div>
				<?php
				  	if($settings['show_categories'] == 'yes') 
				  	{
				?>
				<div class="post-detail single-post">
					<div class="post-info-date"><?php echo date_i18n(GRANDCONFERENCE_THEMEDATEFORMAT, get_the_time('U')); ?></div>
					
					<span class="post-info-cat <?php if($settings['show_date'] != 'yes') { ?>post-info-nodate<?php } ?>">
						<?php
					   	//Get Post's Categories
					   	$post_categories = wp_get_post_categories($post_ID);
					   	
					   	$count_categories = count($post_categories);
					   	$i = 0;
					   	
					   	if(!empty($post_categories))
					   	{
							  	foreach($post_categories as $key => $c)
							  	{
								  	$cat = get_category( $c );
						?>
							  	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
						<?php
								   	if(++$i != $count_categories) 
								   	{
									   	echo '&nbsp;&middot;&nbsp;';
								   	}
							  	}
					   	}
						?>
					</span>
			 	</div>
			 	<?php
				 	}
				?>
			</div>
		</div>
		
		<?php
		    if(!empty($image_thumb) && $settings['show_featured_image'] == 'yes')
		    {
		?>
		    <div class="post-featured-image static">
			    <?php
					$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
				?>
			    <div class="post-featured-image-hover classic <?php if(!empty($tg_enable_lazy_loading)) { ?>lazy<?php } ?>">
				    <div class="post-featured-image-overlay"></div>
				    <?php
					  	if($settings['show_date'] == 'yes') 
					  	{
					?>
			    	<div class="post-featured-date-wrapper">
					    <div class="post-featured-date"><?php echo date_i18n('d', get_the_time('U')); ?></div>
					    <div class="post-featured-month"><?php echo date_i18n('M', get_the_time('U')); ?></div>
					</div>
					<?php
						}
					?>
				    
			     	<?php 
				     	$blog_featured_img_url = get_the_post_thumbnail_url($post_ID, 'grandconference-blog'); 
				     	$blog_featured_img_data = wp_get_attachment_image_src(get_post_thumbnail_id($post_ID), "grandconference-blog" );
				     	$blog_featured_img_alt = get_post_meta(get_post_thumbnail_id($post_ID), '_wp_attachment_image_alt', true);
				     	$return_attr = grandconference_get_lazy_img_attr();
				     	
				     	if(!empty($blog_featured_img_url))
				     	{
				     ?>
				     <img src="<?php echo esc_url($blog_featured_img_url); ?>" class="<?php echo esc_attr($return_attr['class']); ?> <?php echo esc_attr($animation_class); ?>" alt="<?php echo esc_attr($blog_featured_img_alt); ?>"/>
				     <?php
					     }
					?>
			     	<?php echo grandconference_get_post_format_icon($post_ID); ?>
			     	<a href="<?php the_permalink(); ?>"></a>
			    </div>
		    </div>
		<?php
		    }
		?>
	    
	    <div class="post-content-wrapper text-<?php echo esc_attr($settings['text_align']); ?>">
	    
			<div class="post-header-wrapper">
				<?php
			    	switch($settings['text_display'])
			    	{
				    	case 'full_content':
				    		if($settings['strip_html'] == 'yes')
				    		{
					    		echo strip_tags(get_the_content());
				    		}
				    		else
				    		{
				    			echo get_the_content();
				    		}
				    	break;
				    	
				    	case 'excerpt':
				    		if($settings['strip_html'] == 'yes')
				    		{
					    		echo grandconference_limit_get_excerpt(strip_tags(get_the_excerpt()), $settings['excerpt_length']['size'], '...');
					    	}
					    	else
					    	{
				    			echo grandconference_limit_get_excerpt(get_the_excerpt(), $settings['excerpt_length']['size'], '...');
				    		}
				    	break;
			    	}
			    ?>
			    <div class="post-button-wrapper">
				    <?php
					  	if($settings['show_continue'] == 'yes') 
					  	{
					?>
					<a class="continue-reading" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Continue Reading', 'grandconference-elementor' ); ?><span></span></a>
					<?php
						}
					?>
			    </div><br class="clear"/>
			</div>
	    </div>
	    
	</div>

</div>
<br class="clear"/>
<!-- End each blog post -->
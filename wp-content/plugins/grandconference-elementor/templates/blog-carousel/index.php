<?php
	//Get all settings
	$settings = $this->get_settings();
	
	$autoplay = 0;
	if($settings['autoplay'] == 'yes')
	{
		$autoplay = 1;
	}
	
	$pagination = 0;
	if($settings['pagination'] == 'yes')
	{
		$pagination = 1;
	}
	
	$timer = intval($settings['timer']['size']*1000);

	$thumb_image_name = 'grandconference-blog';
	$widget_id = $this->get_id();
	
	//Get all posts
	$args = array( 
		'posts_per_page' => $settings['posts_per_page']['size'],
		'category__in' => $settings['categories'],
		'paged' => 1,
	);
	query_posts($args);
	
	if (have_posts())
	{
		//Get all settings
		$settings = $this->get_settings();
		$count = 1;
?>
<div class="blog-carousel-wrapper layout-<?php echo esc_attr($settings['layout_style']); ?>">
	<div class="owl-carousel" data-pagination="<?php echo intval($pagination); ?>" data-autoplay="<?php echo intval($autoplay); ?>" data-timer="<?php echo intval($timer); ?>" data-items="<?php echo intval($settings['ini_item']['size']); ?>" data-stage-padding="<?php echo esc_attr($settings['stage_padding']['size']); ?>" data-margin="<?php echo esc_attr($settings['item_margin']['size']); ?>">
<?php
		while (have_posts()) : the_post();
			$post_ID = get_the_ID();
		
			//Get featured image
			$image_thumb = '';
			if(has_post_thumbnail($post_ID, $thumb_image_name))
			{
				$image_id = get_post_thumbnail_id($post_ID);
				$image_thumb = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
			}
			
			//Condition to display blog layout styles
			switch($settings['layout_style']) {
				case 'style1':
?>
			<div class="item post-wrapper">
				<div class="blog-carousel-handle"></div>
				
				<?php
					if(!empty($image_thumb) && $settings['show_featured_image'] == 'yes')
					{
				?>
					<div class="post-featured-image static">
						<?php
							$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
						?>
						<div class="post-featured-image-hover <?php if(!empty($tg_enable_lazy_loading)) { ?>lazy<?php } ?>">
							<div class="post-featured-image-overlay"></div>
							<?php
								  if($settings['show_date_block'] == 'yes') 
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
								 $blog_featured_img_url = get_the_post_thumbnail_url($post_ID, $thumb_image_name); 
								 $blog_featured_img_data = wp_get_attachment_image_src(get_post_thumbnail_id($post_ID), $thumb_image_name );
								 $blog_featured_img_alt = get_post_meta(get_post_thumbnail_id($post_ID), '_wp_attachment_image_alt', true);
								 $return_attr = grandconference_get_lazy_img_attr();
								 
								 if(!empty($blog_featured_img_url))
								 {
							 ?>
							 <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img <?php echo grandconference_get_blank_img_attr(); ?> <?php echo esc_attr($return_attr['source']); ?>="<?php echo esc_url($blog_featured_img_url); ?>" class="<?php echo esc_attr($return_attr['class']); ?> <?php echo esc_attr($animation_class); ?>" alt="<?php echo esc_attr($blog_featured_img_alt); ?>"/>
							 </a>
							 <?php
								 }
							?>
							 <?php echo grandconference_get_post_format_icon($post_ID); ?>
						</div>
					</div>
				<?php
					}
				?>
					
				<div class="post-header">
					<div class="post-header-title">
						<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
					</div>
					
					<?php
						  if($settings['show_categories'] == 'yes' OR $settings['show_date'] == 'yes') 
						  {
					?>
					<div class="post-detail single-post">
						
						<?php
							//Get blog date
							if($settings['show_date'] == 'yes') 
							{
						?>
						<div class="post-info-date"><?php echo date_i18n(GRANDCONFERENCE_THEMEDATEFORMAT, get_the_time('U')); ?></div>
						<?php
							}
						?>
						
						<?php
							//Get blog date
							if($settings['show_categories'] == 'yes') 
							{
						?>
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
						<?php
							}
						?>
					 </div>
					 <?php
						 }
					?>
				</div>
			
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
					
					<?php
						if($settings['show_continue'] == 'yes')
						{
					?>
						<div class="post-button-wrapper">
							<a class="continue-reading" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Continue Reading', 'grandconference-elementor' ); ?><span></span></a>
						</div>
						<br class="clear"/>
					<?php
						}
					?>
				</div>
			</div>
<?php
				break;
				
				case 'style2':
?>
				<div class="post-background-wrapper" <?php if(!empty($image_thumb) && $settings['show_featured_image'] == 'yes') { ?>style="background-image: url(<?php echo esc_url($image_thumb[0]); ?>)"<?php } ?>>
					<?php
						  if($settings['show_date_block'] == 'yes') 
						  {
					?>
					<div class="post-featured-date-wrapper">
						<div class="post-featured-date"><?php echo date_i18n('d', get_the_time('U')); ?></div>
						<div class="post-featured-month"><?php echo date_i18n('M', get_the_time('U')); ?></div>
					</div>
					<?php
						}
					?>
				
					<div class="blog-carousel-handle"></div>
					<div class="post-header">
						<div class="post-header-title">
							<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
						</div>
						
						<?php
							  if($settings['show_categories'] == 'yes' OR $settings['show_date'] == 'yes') 
							  {
						?>
						<div class="post-detail single-post">
							
							<?php
								//Get blog date
								if($settings['show_date'] == 'yes') 
								{
							?>
							<div class="post-info-date"><?php echo date_i18n(GRANDCONFERENCE_THEMEDATEFORMAT, get_the_time('U')); ?></div>
							<?php
								}
							?>
							
							<?php
								//Get blog date
								if($settings['show_categories'] == 'yes') 
								{
							?>
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
							<?php
								}
							?>
						 </div>
						 <?php
							 }
						?>
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
							
							<?php
								if($settings['show_continue'] == 'yes')
								{
							?>
								<div class="post-button-wrapper">
									<a class="continue-reading" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Continue Reading', 'grandconference-elementor' ); ?><span></span></a>
								</div>
								<br class="clear"/>
							<?php
								}
							?>
						</div>
					</div>
				</div>
<?php					
				break;
			}
		
		endwhile; 
?>
	</div>
</div>
<?php
	}
	
	wp_reset_query();
?>
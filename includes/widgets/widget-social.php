<?php
// Social List Widget
	 class social_list_widget extends WP_Widget {
	 function __construct() {
		 $widget_ops = array('classname' => 'social_list_widget', 'description' => __('Displays up to 4 icons to be used in the "Header Right" widget area', 'themedy') );
		 parent::__construct('social_list_widget', __('Themedy - Social List', 'themedy'), $widget_ops);
	 }
	
	 function widget($args, $instance) {
		 extract($args, EXTR_SKIP);
		 echo $before_widget;
		 $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		 $rss_link = empty($instance['rss_link']) ? '' : apply_filters('widget_rss_link', $instance['rss_link']);
		 $mail_link = empty($instance['mail_link']) ? '' : apply_filters('widget_mail_link', $instance['mail_link']);
		 $twitter_link = empty($instance['twitter_link']) ? '' : apply_filters('widget_twitter_link', $instance['twitter_link']);
		 $facebook_link = empty($instance['facebook_link']) ? '' : apply_filters('widget_facebook_link', $instance['facebook_link']);
		
		 if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>
         <div class="social_list">
		 	<?php if ($facebook_link) { ?><a href="<?php echo $facebook_link; ?>" class="hastip" title="Facebook"><img src="<?php echo CHILD_URL; ?>/images/icon-facebook.png" alt="Facebook" /></a><?php } ?>
			<?php if ($twitter_link) { ?><a href="<?php echo $twitter_link; ?>" class="hastip" title="Twitter"><img src="<?php echo CHILD_URL; ?>/images/icon-twitter.png" alt="Twitter" /></a><?php } ?>
			<?php if ($mail_link) { ?><a href="<?php echo $mail_link; ?>" class="hastip" title="Mail"><img src="<?php echo CHILD_URL; ?>/images/icon-mail.png" alt="Mail" /></a><?php } ?>
            <?php if ($rss_link) { ?><a href="<?php echo $rss_link; ?>" class="hastip" title="RSS"><img src="<?php echo CHILD_URL; ?>/images/icon-rss.png" alt="RSS" /></a><?php } ?>    
        </div>
		
		 <?php echo $after_widget;
	 }
	
	 function update($new_instance, $old_instance) {
		 $instance = $old_instance;
		 $instance['title'] = strip_tags($new_instance['title']);
		 $instance['rss_link'] = strip_tags($new_instance['rss_link']);
		 $instance['mail_link'] = strip_tags($new_instance['mail_link']);
		 $instance['twitter_link'] = strip_tags($new_instance['twitter_link']);
		 $instance['facebook_link'] = strip_tags($new_instance['facebook_link']);
		 return $instance;
	 }
	
	 function form($instance) {
		 $rss_default = get_bloginfo('rss2_url');
		 $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'rss_link' => $rss_default, 'mail_link' => '', 'twitter_link' => '', 'facebook_link' => '') );
		 $title = strip_tags($instance['title']);
		 $rss_link = strip_tags($instance['rss_link']);
		 $mail_link = strip_tags($instance['mail_link']);
		 $twitter_link = strip_tags($instance['twitter_link']);
		 $facebook_link = strip_tags($instance['facebook_link']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title", 'themedy'); ?>: <br/><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('rss_link'); ?>"><?php _e("RSS", 'themedy'); ?>: <br/><input class="widefat" id="<?php echo $this->get_field_id('rss_link'); ?>" name="<?php echo $this->get_field_name('rss_link'); ?>" type="text" value="<?php echo esc_attr($rss_link); ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('mail_link'); ?>"><?php _e("Mail", 'themedy'); ?>: <br/><input class="widefat" id="<?php echo $this->get_field_id('mail_link'); ?>" name="<?php echo $this->get_field_name('mail_link'); ?>" type="text" value="<?php echo esc_attr($mail_link); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('twitter_link'); ?>"><?php _e("Twitter", 'themedy'); ?>: <br/><input class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" type="text" value="<?php echo esc_attr($twitter_link); ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php _e("Facebook", 'themedy'); ?>: <br/><input class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" type="text" value="<?php echo esc_attr($facebook_link); ?>" /></label></p>
		
		<?php
	 }
	}
	
	add_action('wp_print_scripts', 'social_list_widget_scripts');
	function social_list_widget_scripts() {
		if (!is_admin()) {
			wp_enqueue_script('tooltipsy', CHILD_URL.'/lib/js/tooltipsy.js', array('jquery'), '1.0', TRUE);
		}
	}

	add_action('init', 'enqueue');
	function enqueue() {
		/* Paths */
		$themedy_widgets_path = dirname(__FILE__);
		$themedy_widgets_main_file = dirname(__FILE__).'/widget-social.php';
		$themedy_widgets_directory = plugin_dir_url($themedy_widgets_main_file);

		if (is_active_widget(false, false, 'social_list_widget') and !is_admin()){
			wp_register_script('tooltipsy', $themedy_widgets_directory.'js/tooltipsy.js', array('jquery'), '1.0', TRUE);
			wp_enqueue_script('tooltipsy');
		}
	}
	
register_widget('social_list_widget');
<?php
class LastPostsWidget extends WP_Widget {
	/**
	 * Init the class and parse the widget title to Wordpress Widget Page
	 */
    function LastPostsWidget() {
        parent::WP_Widget(false, $name = 'PPSN: Letzte Artikel', $width = 500, $widget_options = array("description" => "Zeigt die letzten Artikel an."));
    }

    /**
     * Displays the widget in the frontend
     * @param array $args comes from wordpress itself and give the befor & after Strings
     * @param array $instance contains the widget data
     */
    function widget($args, $instance) {
    	// Build the variables	
    	extract($args);
    	$title = $instance['title'];
    	
    	$lastPosts = $this->getLastPosts();

    	// echo the widget
    	echo $before_widget;
    		if (trim($title) != "") echo $before_title.$title.$after_title;
    		echo $lastPosts;
    	echo $after_widget;
    }
    
    /**
     * Get the last Posts
     * @param string $html The HTML-String for the output
     */
    function getLastPosts ($html = "") {
    	global $wpdb;
    	$posts = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts
    									WHERE `post_status` = 'publish'
    									  AND `post_type` = 'post'
    									  	ORDER BY `post_date` DESC
    									  	LIMIT 0,3");
    	$count = 1;
    	foreach ($posts as $post) {
    		$date = date_create($post->post_date);
    		if ($count == 1) {
    			$html .= '<strong>'.$post->post_title.'</strong> vom '.date_format($date, 'd.m.Y').'<br />';
    			$html .= substr($post->post_content,0,275)." ... <a href='".get_permalink($post->ID)."'>mehr lesen</a>";
    		}
    		else {
    			$html .= "<hr />";
    			$html .= '<strong>'.$post->post_title.'</strong> vom '.date_format($date, 'd.m.Y').'<br />';
    			$html .= substr($post->post_content,0,125)." ... <a href='".get_permalink($post->ID)."'>mehr lesen</a>";
    		}
    		++$count;
    	}
    	
    	return $html;
    }
    
	/**
	 * Updates the current instance
	 * @param array $new_instance The values of the new instance
	 * @param array $old_instance The values of the old instance
	 * @return array $instance The values of the old instance
	 */
    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /**
     * Provides the form for the widget-backend
     * @param array $instance the values of this instance
     */
    function form($instance) {
    	$title = esc_attr($instance['title']);
        ?>
         <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Titel:'); ?> <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" /></label></p>
        <?php 
    }
}

?>
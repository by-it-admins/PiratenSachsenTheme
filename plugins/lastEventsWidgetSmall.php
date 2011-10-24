<?php
class LastEventsWidgetSmall extends WP_Widget {
	/**
	 * Init the class and parse the widget title to Wordpress Widget Page
	 */
    function LastEventsWidgetSmall() {
        parent::WP_Widget(false, $name = 'PPSN: Letzte Events Small', $width = 500, $widget_options = array("description" => "Zeigt die letzten Events an."));
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
    	
    	$lastEvents = $this->getLastEvents();

    	// echo the widget
    	echo $before_widget;
    		if (trim($title) != "") echo $before_title.$title.$after_title;
    		echo $lastEvents;
    	echo $after_widget;
    }
    
    /**
     * Get the last Events
     * @param string $html The HTML-String for the output
     */
    function getLastEvents ($html = "") {
    	global $wpdb;
    	$events = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE `post_type` = 'event' AND `post_date` >= NOW() ORDER BY `post_date` ASC LIMIT 0,5");
    	foreach ($events as $event) {
    		$date = explode(" ",$event->post_date);
    		$date = explode("-",$date[0]);
    		$date = $date[2].".".$date[1].".".$date[0];
    		$html .= '<p><strong>'.$date.'</strong> - '.$event->post_name.'<br /><a href="'.$event->to_ping.'">mehr erfahren</a></p>';
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
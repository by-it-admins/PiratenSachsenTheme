<?php

/**
 * Greatest fail in the development of this theme:
 * "SELECT ID FROM ".$wpdb->prefix."posts WHERE `ID` = '".$currentPage."'"
 * Sometimes . . . m(
 */

if (!get_option("ppsn_theme_options")) {
	add_option("ppsn_theme_options");
}

/**
 * Oh yeah, top navigation eat brainz ...
 * @param string $html
 */
function topNavigation ($html = "") {
	global $wpdb;
	$set = unserialize(getOptions("idSet"));
	$startPage = $set["startpage"];
	$pages = $wpdb->get_results("SELECT *
									FROM ".$wpdb->prefix."posts
										WHERE `post_parent` = '".$wpdb->escape($startPage)."'
										  AND `post_status` = 'publish'
										  AND `post_type` = 'page'");
	foreach ($pages as $page) {
		$getMeta = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta
										WHERE `post_id` = '".$page->ID."'
										  AND (`meta_key` = 'menu_top' OR `meta_key` = 'menu_bot')");
		
		if (!is_front_page() && !is_404() && !is_search() && !is_single()) {
			if ((getTheId() == $page->ID || getParentId(getTheId()) == $page->ID)) {
				$currentPageString = ' class="current-item"';
			}
			else {
				$currentPageString = '';
			}
		}
		
		$html .= '<li'.$currentPageString.'>
					<a href="'.get_permalink($page->ID).'"><span>'.$getMeta[0]->meta_value.'<br /><em>'.$getMeta[1]->meta_value.'</em></span></a>
				  </li>';
	}
	
	echo $html;
}

function subNavigation ($html = "") {
	global $wpdb;
	$set = unserialize(getOptions("idSet"));
	if (is_single() || is_category() || is_archive()) {
		$parentPage = $set["blogcategory"];
	}
	else {
		$parentPage = getParentId(getTheId());
	}
	
	$pages = $wpdb->get_results("SELECT *
									FROM ".$wpdb->prefix."posts
										WHERE `post_parent` = '".$wpdb->escape($parentPage)."'
										  AND `post_status` = 'publish'
										  AND `post_type` = 'page'
										  	ORDER BY menu_order ASC");

	$html = '<div id="box-181"><div id="top"><h1>'.get_the_title($parentPage).'</h1></div><div id="middle" class="submenu"><div id="submenu"><ul>';
	foreach ($pages as $page) {
		if (((is_home() || is_single() || is_archive()) && $page->post_name == "blog") || getTheId() == $page->ID) {
			$currentSubPageString = ' class="current-item"';
		}
		else {
			$currentSubPageString = '';
		}
		
		$html .= '<li'.$currentSubPageString.'><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></li>';
	}
	$html .= '</ul></div></div><div id="bottom"></div></div>';
	
	echo $html;
}

/**
 * Parent is the wrong word for this. It gets the ID of the main category
 * @param int $currentPage
 */
function getParentId ($currentPage) {
	global $wpdb;
	$set = unserialize(getOptions("idSet"));
	if (!is_home() && !is_single() && !is_front_page() && !is_category() && !is_archive()) {
		$getPostParent = $wpdb->get_var("SELECT post_parent FROM ".$wpdb->prefix."posts WHERE `ID` = '".$currentPage."'");
		if ($getPostParent == $set["startpage"]) {
			return $currentPage;
		}
		else if ($getPostParent == $set["metaebene"]) {
			return $set["metaebene"];
		}
		else {
			return getParentId($getPostParent);
		}
	}
	else {
		return $set["blogcategory"];
	}
}

/**
 * Get an Option from the option array
 * @param string $type startPage|topBannerImg|topBannerUrl|boxlist|boxname
 */
function getOptions ($type = "") {
	$options = unserialize(get_option("ppsn_theme_options"));
	if (!$type) {
		return $options;
	}
	else {
		return $options[$type];
	}
}

/**
 * Sets an option ... suprise, he?
 * @param string $type
 * @param string $value
 */
function setOption ($type,$value) {
	$options = unserialize(get_option("ppsn_theme_options"));
	$options[$type] = $value;
	$options = serialize($options);
	update_option("ppsn_theme_options",$options);
}

/**
 * Get the page ID outside the loop
 * Cool, he?
 */
function getTheId () {
	global $wp_query;
	$thePostID = $wp_query->post->ID;
	return $thePostID;	
}

/**
 * This cute lil' box right of the main menu
 * @param string $rtn
 */
function getBoxList ($rtn = "") {
	$set = unserialize(getOptions("boxSet"));
	$list = explode("\n",$set["boxlist"]);
	
	foreach ($list as $item) {
		$res = explode("::",$item);
		$rtn .= '<li><a href="'.$res["1"].'">'.$res["0"].'</a></li>';
	}
	
	return $rtn;
}

/**
 * Top Banner Bar
 * @param string $rtn
 */
function getBanner ($rtn = "") {
	if (trim(getOptions("bannerlist")) != "") {
		$list = explode("\n",getOptions("bannerlist"));
		shuffle($list);
		$res = explode("::",$list[0]);
		$rtn .= '<a href="'.$res["1"].'"><img src="'.$res["0"].'" /></a>';
		return $rtn;
	}
	else {
		return false;
	}
}

	 /**
 * Welcome Text auf der Startseite
 * @param string $rtn
 */
function getWelcome ($rtn = "") 
{
	if (trim(getOptions("welcometext")) != "") 
	{
		$rtn .= getOptions("welcometext");
		return $rtn;
	}
	else 
	{
		return false;
	}
}

/**
 * Picture neben Welcometext
 * @param string $rtn
 */
function getPicture ($rtn = "") 
{
	if (trim(getOptions("welcomepicture")) != "") 
	{
		//<img src=" bloginfo("template_url"); /elements/header-picture.png" />
		$picpath = getOptions("welcomepicture");
		$rtn .= '<img src="'.$picpath.'" />';
		return $rtn;
	}
	else 
	{
		return false;
	}
}

/**
 * Headder Banner
 * @param string $rtn
 */
function getHeader ($rtn = "") 
{
	if (trim(getOptions("headerpicture")) != "") 
	{
		//style="background: #f9f9f9 url(images/header.png) no-repeat scroll 0 0;">
		$rtn .= 'style="background: #f9f9f9 url('.getOptions("headerpicture").') no-repeat scroll 0 0;"';
		return $rtn;
	}
	else 
	{
		return false;
	}
}

/**
 * Freakin' Breadcrumbs
 * @param string $rtn
 * @param int $currentPage
 */
function getBreadcrumb ($rtn = "",$currentPage, $flag = null) {
	global $wpdb;
	$set = unserialize(getOptions("idSet"));
	
	// Where am i?
	if (!$currentPage) {
		$currentPage = getTheId();
	}
	
	if ((is_home() || is_single() || is_category() || is_archive()) && !$flag) {
		$currentPage = $set["blogid"]; // ID vom Blog
	}
	
	// Get Parent
	$getPostParent = $wpdb->get_var("SELECT post_parent FROM ".$wpdb->prefix."posts WHERE `post_type` = 'page' AND `post_status` = 'publish' AND `ID` = '".$currentPage."'");
	if ($getPostParent != $set["startpage"] && $getPostParent != $set["metaebene"]) {
		$crumb = ' &raquo; <a href="'.get_permalink($currentPage).'">'.get_the_title($currentPage).'</a>';
		$rtn = $crumb.$rtn;
		getBreadcrumb($rtn,$getPostParent,true);
	}
	else {
		$crumb = ' &raquo; <a href="'.get_permalink($currentPage).'">'.get_the_title($currentPage).'</a>';
		$rtn = $crumb.$rtn;
		echo $rtn;
	}
}

/**
 * Fuck, so much widget areas . . .
 */
if (!function_exists('initWidgets')) { // klml http://codex.wordpress.org/Child_Themes#Using_functions.php
	function initWidgets () {
		$beforeWidget626 = '<div id="box-626" class="fixed-height-310">';  // Just for the startpage, so it goes width fixed height
		$beforeWidget468 = '<div id="box-468" class="fixed-height-277">';  // Just for the startpage, so it goes width fixed height
		$beforeWidget468no = '<div id="box-468" class="nomargin fixed-height-277">';  // Just for the startpage, so it goes width fixed height
		$beforeWidget308 = '<div id="box-308" class="fixed-height-310">'; // Just for the startpage, so it goes width fixed height
		$beforeWidget308no = '<div id="box-308" class="fixed-height-310 nomargin">'; // Just for the startpage, so it goes width fixed height
		$beforeWidget268 = '<div id="box-268" class="fixed-height-277">';  // Just for the startpage, so it goes width fixed height
		$beforeWidget268no = '<div id="box-268" class="nomargin fixed-height-277">';  // Just for the startpage, so it goes width fixed height
		$beforeWidget181 = '<div id="box-181">';
		$beforeWidget181no = '<div id="box-181" class="nomargin">';
		
		// Standards
		$beforeTitle = '<div id="top"><h1>';
		$afterTitle = '</h1></div><div id="middle">';
		$afterTitleMenu = '</h1></div><div id="middle" class="submenu"><div id="submenu">';
		$afterWidgetMenu = '</div></div><div id="bottom"></div></div>';
		$afterWidget = '</div><div id="bottom"></div></div>';
		
		// Register the sidebars
		register_sidebar( array(
			'name' => 'Home: Oben Links',
			'id' => 'home-top-left',
			'description' => 'Widget auf der Startseite oben links',
			'before_widget' => $beforeWidget626,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
		register_sidebar( array(
			'name' => 'Home: Oben Rechts',
			'id' => 'home-top-right',
			'description' => 'Widget auf der Startseite oben rechts',
			'before_widget' => $beforeWidget308no,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
		register_sidebar( array(
			'name' => 'Home: Unten Links',
			'id' => 'home-bottom-left',
			'description' => 'Widget auf der Startseite unten links',
			'before_widget' => $beforeWidget308,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
		register_sidebar( array(
			'name' => 'Home: Mitte Links',
			'id' => 'home-bottom-middle',
			'description' => 'Widget auf der Startseite mitte links',
			'before_widget' => $beforeWidget308,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
		register_sidebar( array(
			'name' => 'Home: Unten Right',
			'id' => 'home-bottom-right',
			'description' => 'Widget auf der Startseite unten rechts',
			'before_widget' => $beforeWidget308no,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
		
		register_sidebar( array(
			'name' => 'Verteiler: Links',
			'id' => 'allocator-left',
			'description' => 'Widget auf der Verteilerseite links',
			'before_widget' => $beforeWidget181,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
		register_sidebar( array(
			'name' => 'Verteiler: Oben Links',
			'id' => 'allocator-top-left',
			'description' => 'Widget auf der Verteilerseite oben links',
			'before_widget' => $beforeWidget468,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
		register_sidebar( array(
			'name' => 'Verteiler: Oben Rechts',
			'id' => 'allocator-top-right',
			'description' => 'Widget auf der Verteilerseite oben right',
			'before_widget' => $beforeWidget268no,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
		
		register_sidebar( array(
			'name' => 'Blog: Links',
			'id' => 'blog-left',
			'description' => 'Widget auf der Blogseite links',
			'before_widget' => $beforeWidget181,
			'after_widget' => $afterWidgetMenu,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitleMenu,
		));
		register_sidebar( array(
			'name' => 'Detail: Links',
			'id' => 'detail-left',
			'description' => 'Widget auf der Detailseite links',
			'before_widget' => $beforeWidget181,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
		register_sidebar( array(
			'name' => 'Detail: Rechts',
			'id' => 'detail-right',
			'description' => 'Widget auf der Detailseite rechts',
			'before_widget' => $beforeWidget181no,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
		));
	}
}
add_action('widgets_init', 'initWidgets');

// Load files
define("THEME_PATH",ABSPATH."/wp-content/themes/ppsn/");

// Options Page
require_once THEME_PATH.'plugins/View.php';
require_once THEME_PATH.'plugins/Options.php';
$themeOptions = new ThemeOptions();
add_action('admin_menu',array(&$themeOptions,"init"));

// TinyEvents
require_once THEME_PATH.'plugins/TinyEvents.php';
$tinyEvents = new TinyEvents();
add_action('admin_menu',array(&$tinyEvents,"init"));

// Last Posts Widget for the start page
require_once THEME_PATH."plugins/lastPostsWidget.php";
add_action('widgets_init', create_function('','return register_widget("LastPostsWidget");'));

// Last Events Widget Big for the start page
require_once THEME_PATH."plugins/lastEventsWidgetBig.php";
add_action('widgets_init', create_function('','return register_widget("LastEventsWidgetBig");'));

// Last Events Widget Small for the detail pages
require_once THEME_PATH."plugins/lastEventsWidgetSmall.php";
add_action('widgets_init', create_function('','return register_widget("LastEventsWidgetSmall");'));
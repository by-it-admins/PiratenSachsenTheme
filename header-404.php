<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title><?
	  global $page, $paged;
	  wp_title( '&laquo;', true, 'right' );
	  bloginfo("name");
  ?></title>
  <link rel="shortcut icon" href="<? bloginfo("template_url"); ?>/images/favicon.ico" type="image/x-icon" /> 
  <link rel="icon" href="<? bloginfo("template_url"); ?>/images/favicon.ico" type="image/x-icon" /> 
  <link rel="stylesheet" type="text/css" media="screen" href="<? bloginfo("template_url"); ?>/style.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="<? bloginfo("template_url"); ?>/style-small.css" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <script type="text/javascript">
    function townList(e) {
    	element = document.getElementById("towns-active");
        if (e=="show") {
            element.style.zIndex = "100";
			element.style.display = "block";
        }
        else {
        	element.style.zIndex = "0";
			element.style.display = "none";
        }
    }
  </script>
  <? wp_head(); ?>
 </head>
 <body>
  <!-- The bgstripe: Start -->
  <div id="bgstripe"></div>
  <!-- The bgstripe: End -->

  <div id="wrapper"> <!-- The Page: Start -->
   
   <div id="header" <? echo getHeader(); ?> > <!-- The Header: Start -->
    <div id="logo">
    	<a href="<? bloginfo("url"); ?>"><img src="<? bloginfo("template_url"); ?>/images/orwell.png" /></a>
    </div>
    <div id="banner">
     <? echo getBanner(); ?>
    </div>
   </div> <!-- The Header: End -->
   
   <div id="stripe"> <!-- The Stripe: Start -->
    <div id="breadcrumb">
     <strong>Du bist hier:</strong> 404 - Seite nicht gefunden
    </div>
    <div id="search">
     <form action="" method="get">
      <input type="text" class="text" name="s" value="<?php
		if (get_search_query()) {
			echo get_search_query();
		}
		else {
			echo "Suche ...";
		}
      ?>" />&nbsp;&nbsp;
      <input type="submit" class="submit" value="&nbsp;" />
     </form>
    </div>
   </div> <!-- The Stripe: End -->
   
   <div id="topmenu"> <!-- The Topmenu: Start -->
    <div id="menu">
     <ul>
      <li <? if (is_front_page()) { echo 'class="current-item"';} ?>><a href="<? bloginfo("url"); ?>" class="home"><span><img src="<? bloginfo("template_url"); ?>/images/orwell.png" /></span></a></li>
      <? topNavigation(); ?>
     </ul>
    </div>
    
    <? $set = unserialize(getOptions("boxSet")); if (trim($set["boxname"]) != "") { ?>
    <div id="towns-inactive" onmousedown="townList('show');">
     <span><strong><? $set = unserialize(getOptions("boxSet")); echo $set["boxname"]; ?></strong></span>
    </div>
    
    <div id="towns-active" style="display:none;">
     <div id="top"><span><strong><? $set = unserialize(getOptions("boxSet")); echo $set["boxname"]; ?></strong></span></div>
     <div id="middle">
      <ul>
       <? echo getBoxList(); ?>
      </ul>
     </div>
     <div id="bottom" onmousedown="townList('hide');"><span>schlie&szlig;en</span></div>
    </div>
    <?php } ?>
    
   </div> <!-- The Topmenu: End -->
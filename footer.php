<?php 
	$set = unserialize(getOptions("idSet"));
	$values["privacyid"] = $set["privacyid"];
	$values["contactid"] = $set["contactid"];
	$values["imprintid"] = $set["imprintid"];
?>
   <div id="footer"> <!-- The Footer: Start -->
    <div id="left">
     <a href="http://creativecommons.org/licenses/by-sa/3.0/de/">CC-BY-SA</a> <?php echo date("Y"); ?> <?php bloginfo("name"); ?> - <a href="http://piraten-sachsen.de/metaebene/das-theme">THEME</a> - <a href="http://www.wordpress.org">WIR DANKEN WORDPRESS</a>
    </div>
    <div id="right">
     <a href="<?php echo get_permalink($values["privacyid"]); ?>">DATENSCHUTZ</a> - <a href="<?php echo get_permalink($values["contactid"]); ?>">KONTAKT</a> - <a href="<?php echo get_permalink($values["imprintid"]); ?>">IMPRESSUM</a>
    </div>
   </div> <!-- The Footer: End -->
  </div> <!-- The Page: End -->
  <? wp_footer(); ?>
 </body>
</html>
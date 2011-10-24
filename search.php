<? get_header("small"); ?>

   <div id="content"> <!-- The Content: Start -->
    
    <div id="sidebar-left">
     &nbsp;
    </div>

    <div id="content-normal">
     <div id="box-555">
      <div id="top">
       <h1>Suche nach: <span><?php echo get_search_query(); ?></span></h1>
      </div>
      <div id="middle">
       <p>
        <?php if (have_posts()) : ?>
         Es wurden <?php echo $wp_query->found_posts; ?> Ergebnisse gefunden:
         <?php while (have_posts()) : the_post(); ?>
          <hr />
          <strong><?php the_title(); ?></strong><br />
          <?php the_excerpt(); ?>
          <a href="<?php the_permalink(); ?>">&raquo; hier weiterlesen</a>
         <?php endwhile; ?>
        <?php else : ?>
         Zu deiner Suchanfrage konnten wir leider nichts finden.
        <?php endif; ?>
       </p>
      </div>
      <div id="bottom"></div>
     </div>
     <?php if ( $wp_query->max_num_pages > 1 ) : ?>
	 <div id="nav-under" class="pages">
		<div class="nav-previous"><?php next_posts_link("&laquo; n&auml;chste Seite"); ?></div>
		<div class="nav-next"><?php previous_posts_link("&raquo; voherige Seite"); ?></div>
	 </div><!-- #nav-under -->
	 <?php endif; ?>
    </div>
    
    <div id="sidebar-right">
     &nbsp;
    </div>
    <div class="clear"></div>
    
   </div> <!-- The Content: End -->

<? get_footer(); ?>
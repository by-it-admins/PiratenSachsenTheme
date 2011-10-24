<? get_header("small"); ?>

   <div id="content"> <!-- The Content: Start -->
    
    <div id="sidebar-left">
     <?php subNavigation(); ?>
     <?php if (is_active_sidebar('blog-left')) : ?>
		<?php dynamic_sidebar('blog-left'); ?>
	 <?php endif; ?>
    </div>

    <div id="content-normal">
     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     <div id="box-750">
      <div id="top">
       <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?> vom <?php the_time('d.m.Y') ?></a></h1>
      </div>
      <div id="middle">
       <?php the_content("&raquo; hier weiterlesen ..."); ?>
       <p><em><a href="<?php the_permalink(); ?>/#respond"><?php comments_number('keine Kommentare', 'ein Kommentar', '% Kommentare' );?></a></em></p>
      </div>
      <div id="bottom"></div>
     </div>
     <?php endwhile; endif; ?>
     
     <?php if ( $wp_query->max_num_pages > 1 ) : ?>
	 <div id="nav-under" class="pages">
		<div class="nav-previous"><?php next_posts_link("&laquo; &auml;ltere Beitr&auml;ge"); ?></div>
		<div class="nav-next"><?php previous_posts_link("&raquo; neuere Beitr&auml;ge"); ?></div>
	 </div><!-- #nav-under -->
	 <?php endif; ?>
    </div>
    
    <div id="sidebar-right">
     <?php if (is_active_sidebar('detail-right')) : ?>
		<?php dynamic_sidebar('detail-right'); ?>
	 <?php endif; ?>
    </div>
    <div class="clear"></div>
    
   </div> <!-- The Content: End -->

<? get_footer(); ?>
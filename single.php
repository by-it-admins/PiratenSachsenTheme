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
       <h1><?php the_title(); ?></h1>
      </div>
      <div id="middle">
       <p><em><span>vom <?php the_time('d.m.Y') ?></span></em><br /></p>
       <?php the_content("hier weiterlesen ..."); ?>
      </div>
      <div id="bottom"></div>
     </div>
     <?php endwhile; endif; ?>
     <?php comments_template( '', true ); ?>
    </div>
    
    <div class="clear"></div>
    
   </div> <!-- The Content: End -->

<? get_footer(); ?>
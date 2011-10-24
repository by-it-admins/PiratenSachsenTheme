<? /* Template Name: Verteiler */ ?>
<? get_header("small"); ?>

   <div id="content"> <!-- The Content: Start -->
    
    <div id="sidebar-left">
    
     <?php subNavigation(); ?>
     <?php if (is_active_sidebar('allocator-left')) : ?>
		<?php dynamic_sidebar('allocator-left'); ?>
	 <?php endif; ?>
    
    </div>
    <div id="content-verteiler">
     
     <?php if (is_active_sidebar('allocator-top-left')) : ?>
		<?php dynamic_sidebar('allocator-top-left'); ?>
	 <?php endif; ?>
	
	 <?php if (is_active_sidebar('allocator-top-right')) : ?>
		<?php dynamic_sidebar('allocator-top-right'); ?>
	 <?php endif; ?>
     
     <div class="clear"></div>
     <!-- Fixed height top boxes -->
     
     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     <div id="box-750" class="nomargin">
      <div id="top">
       <h1><?php the_title(); ?></h1>
      </div>
      <div id="middle">
       <?php the_content(); ?>
      </div>
      <div id="bottom"></div>
     </div>
     <?php endwhile; endif; ?>
     
    </div>
    <div class="clear"></div>
    
   </div> <!-- The Content: End -->

<? get_footer(); ?>
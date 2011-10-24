<? /* Template Name: Detail */ ?>
<? get_header("small"); ?>

   <div id="content"> <!-- The Content: Start -->
    
    <div id="sidebar-left">
     <?php subNavigation(); ?>
     <?php if (is_active_sidebar('detail-left')) : ?>
		<?php dynamic_sidebar('detail-left'); ?>
	 <?php endif; ?>
    </div>

    <div id="content-normal">
     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     <div id="box-750">
      <div id="top">
       <h1><?php the_title(); ?></h1>
      </div>
      <div id="middle">
       <?php the_content(); ?>
      </div>
      <div id="bottom"></div>
     </div>
     <?php endwhile; endif; ?>
     <?php comments_template( '', true ); ?>
    </div>
    
    <div id="sidebar-right">
     <?php if (is_active_sidebar('detail-right')) : ?>
		<?php dynamic_sidebar('detail-right'); ?>
	 <?php endif; ?>
    </div>
    <div class="clear"></div>
    
   </div> <!-- The Content: End -->

<? get_footer(); ?>
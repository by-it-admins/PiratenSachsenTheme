<? /* Template Name: Startseite */ ?>
<? get_header(); ?>

   <div id="content"> <!-- The Content: Start -->

	<?php if (is_active_sidebar('home-top-left')) : ?>
		<?php dynamic_sidebar('home-top-left'); ?>
	<?php endif; ?>
	
	<?php if (is_active_sidebar('home-top-right')) : ?>
		<?php dynamic_sidebar('home-top-right'); ?>
	<?php endif; ?>
	
    <div class="clear"></div>
    
    <?php if (is_active_sidebar('home-bottom-left')) : ?>
		<?php dynamic_sidebar('home-bottom-left'); ?>
	<?php endif; ?>
	
	<?php if (is_active_sidebar('home-bottom-middle')) : ?>
		<?php dynamic_sidebar('home-bottom-middle'); ?>
	<?php endif; ?>
	
	<?php if (is_active_sidebar('home-bottom-right')) : ?>
		<?php dynamic_sidebar('home-bottom-right'); ?>
	<?php endif; ?>

    <div class="clear"></div>
   </div> <!-- The Content: End -->

<? get_footer(); ?>
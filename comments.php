<?php if (have_comments()) : ?>
	 <div id="box-750">
      <div id="top">
       <h1>Es wurden bisher
       		<?php comments_number('keine Kommentare', 'ein Kommentar', '% Kommentare' ); ?>
       		geschrieben<?php if (comments_open()) : ?> - <span><a href="#respond">Kommentar schreiben</a></span><?php endif; ?></h1>
      </div>
      <div id="middle">
       <?php foreach ($comments as $comment) : ?>
        <a name="comment-<?php comment_ID(); ?>"></a>
        <div id="comment" <?php comment_class() ?>>
         <div id="avatar"><?php echo get_avatar($comment, 70); ?></div>
         <div id="post">
          <p><em><strong><?php comment_author_link(); ?></strong> schrieb am <?php comment_date(); ?>:</em></p>
          
          <?php comment_text() ?>
         </div><br class="clear" />
        </div>
       <?php endforeach; ?>
      </div>
      <div id="bottom"></div>
     </div>
<?php endif; ?>

<?php if (comments_open()) : ?>
<a name="respond"></a>

	 <div id="box-750">
      <div id="top">
       <h1>Einen Kommentar schreiben</h1>
      </div>
      <div id="middle">
       <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <?php if (is_user_logged_in()) : ?>
        <p>eingeloggt als: <a href="<?php bloginfo('url'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> - <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="ausloggen">ausloggen &raquo;</a></p>
        <?php else: ?>
        <p>
         <label for="name">Name</label>
         <input type="text" class="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" />
        </p>
        <p>
         <label for="name">E-Mail</label>
         <input type="text" class="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" /> <small>(wird nicht ver&ouml;ffentlicht)</small>
        </p>
        <p>
         <label for="name">Webseite</label>
         <input type="text" class="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" />  <small>(kein Pflichtfeld)</small>
        </p>
        <?php endif; ?>
        <p>
         <label for="name">Nachricht</label>
         <textarea class="text" name="comment" id="comment"></textarea>
        </p>
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
        <input value="&nbsp;" type="submit" name="submit" id="submit" class="comment-submit" /><br class="clear" />
        <?php do_action('comment_form', $post->ID); ?>
       </form>
      </div>
      <div id="bottom"></div>
     </div>
<?php else: ?>
	<?php if( !is_page() ): ?>
	<p>Die Kommentarfunktion in diesem Artikel wurde deaktiviert</p>
	<?php endif; ?>
<?php endif; ?>

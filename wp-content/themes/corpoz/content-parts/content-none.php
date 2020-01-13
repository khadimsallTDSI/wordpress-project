<?php
/**
* The template part for displaying a message that posts cannot be found
*
* @package WordPress
* @subpackage corpoz
*/
?>
<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
<p>
  <?php printf( esc_html__( 'Ready to publish your first post? Get started here.', 'corpoz' ), esc_url( admin_url( 'post-new.php' ) ) ); ?>
</p>
<?php elseif ( is_search() ) : ?>
<h4>
  <?php printf( esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'corpoz' ), '<span>' . get_search_query() . '</span>' ); ?>
</h4>
&nbsp;
<div class="widget widget_search cc-search">
  <?php get_search_form(); ?>
</div>
<?php else : ?>
<p>
  <?php echo(esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'corpoz' )); ?>
</p>
<div class="widget widget_search cc-search">
  <?php get_search_form(); ?>
</div>
<?php endif; ?>
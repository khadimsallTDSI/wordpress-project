<div class="single-blog-post">
	<div class="img-box">
	 <?php if(has_post_thumbnail()) : the_post_thumbnail();
	 endif; 
	 ?> 
	 </div>
	<div class="content-box">
	  <div class="content_blog">
		<h3><?php the_title(); ?></h3>
		<ul class="post-info">
		  <li>
			<a href="?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
			  <i class="fa fa-user"></i> <?php the_author(); ?></a>
		  </li>
		  <li>
			  <i class="fa fa-comment"></i> <?php comments_number( esc_html__('0 comment', 'corpoz'), esc_html__('1 comment', 'corpoz'), esc_html__('% comments', 'corpoz') ); ?>
		  </li>
		  <li>
			  <i class="fa fa-calendar"></i> <?php echo esc_html(get_the_date()); ?>
		  </li>
		</ul>
		<?php the_content(); ?>
		<?php if(has_tag()) { ?>
		<div class="bottom-box clearfix">
		  <span class="pull-left"><?php echo esc_html('Tags :', 'corpoz'); ?>
		  </span>
		  <?php the_tags(' '); ?>
		</div>
	  <?php } ?>
	  </div>
	</div>
  </div>
  <?php 
  if ( comments_open() || get_comments_number() ) :
	  comments_template();
  endif; 
  ?> 
<div class="news_box">
	<div class="news_img">
	  <?php 
		 if(has_post_thumbnail()) : 
		  the_post_thumbnail();
		  endif; 
	   ?>
	</div>
	<div class="news_detail">
	  <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
	  <ul class="post-info">
		<li>
		  <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
			<i class="fa fa-user"></i><?php the_author(); ?></a>
		</li>
		<li>
			<i class="fa fa-comment"></i> <?php comments_number( esc_html__('0 comment', 'corpoz'), esc_html__('1 comment', 'corpoz'), esc_html__('% comments', 'corpoz') ); ?>
		</li>
		<li>
			<i class="fa fa-calendar"></i>  <?php echo esc_html(get_the_date()); ?>
		</li>
	  </ul>
	   <?php the_excerpt(); ?>
	  <a href="<?php the_permalink(); ?>" class="read-btn"><?php echo esc_html__('Read More','corpoz'); ?>
		<i class="fa fa-chevron-right" aria-hidden="true"></i>
	  </a>
	</div>
</div>
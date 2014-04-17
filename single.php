<?php get_header(); ?>
<div class="left">
	<?php get_sidebar(); ?>
</div>
<div id="content" >
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<div class="title">
			<h2><?php the_title(); ?></h2>
		</div>
		<div class="entry">
			<?php 
			if ( 'instructors' == get_post_type()) { 
				echo get_the_post_thumbnail($thumbnail->ID, 'instructor-single', array('class' => 'alignleft'));
			}	
			?>
			<?php the_content('Read the rest of this entry &raquo;'); ?>
			<?php 
			if ( 'instructors' == get_post_type()) { 
				echo '<p class="golf_tip">GOLF TIP: </p>';
				the_excerpt(); 
			} 
			?>
			<div class="clear"></div>
			<?php if ( 'tournaments' == get_post_type()) { ?>
				<div class="navigation_next"><?php next_post_link(); ?></div>
				<div class="navigation_previous"><?php previous_post_link(); ?></div>	
			<?php } ?>
			<?php if ( 'instructors' == get_post_type()) {  ?>
				<div class="navigation_next"><?php next_post_link(); ?></div>
				<div class="navigation_previous"><?php previous_post_link(); ?></div>	
			<?php } ?>			
		</div>
	</div>
	<?php if ( 'tournaments' == get_post_type()) { ?>
	<?php //comments_template(); ?>
	<?php } ?>
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
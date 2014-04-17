<?php
/*
Template Name: Courses Template
*/
?>
<?php get_header(); ?>
<div class="button_section">
<?php get_template_part( 'sidebar', 'button' ); ?>
</div>
<div id="content">
<h4>Click on numbers for hole details</h4>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'inc', 'courses' );  ?>	
<div class="post" id="post-<?php the_ID(); ?>">


	<div class="entry">
		<?php the_content('Read the rest of this entry &raquo;'); ?>
		<div class="clear"></div>
		<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>

</div>

<?php endwhile; endif; ?>
</div>		
<div class="left">
<div class="left-col">
	<div class="hole_details">
		<h3>Details for Hole <?php echo get_post_meta($post->ID, 'number', true); ?></h3>
		<label>Black</label><?php echo get_post_meta($post->ID, 'black', true); ?><br />
		<label>Gold</label><?php echo get_post_meta($post->ID, 'gold', true); ?><br />
		<label>Blue</label><?php echo get_post_meta($post->ID, 'blue', true); ?><br />
		<label>Par</label><?php echo get_post_meta($post->ID, 'par', true); ?><br />
		<label>Men's Handicap</label><?php echo get_post_meta($post->ID, 'mcap', true); ?><br />
		<label>Pace of Play</label><?php echo get_post_meta($post->ID, 'pace', true); ?><br />
		<label>Red</label><?php echo get_post_meta($post->ID, 'red', true); ?><br />
		<label>Laidies' Handicap</label><?php echo get_post_meta($post->ID, 'lcap', true); ?><br />
	</div>
	<div class="hole_photo">
	<?php echo get_the_post_thumbnail($thumbnail->ID, 'hole-thumb'); ?>
	</div>
</div>
</div>
<?php get_footer(); ?>
<?php get_header(); ?>
<div id="content">
	<?php if (have_posts()) : ?>
	<?php $count = 0; ?>
	<?php while (have_posts()) : the_post(); ?>
	<div class="box <?php if($count % 2 != 0) { echo 'floatright';} ?>" id="post-<?php the_ID(); ?>">
		<a href="<?php the_permalink() ?>">
			<?php echo get_the_post_thumbnail($thumbnail->ID, 'instructor-thumb', array('class' => 'boximg')); ?>
		</a>
		<div class="inner_box">	
			<div class="btitle">
				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<?php if (is_category('tournaments')) { echo '<span class="golf_tees"></span>';} ?>
			</div>
			<div class="entry">
				<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="titlemeta clearfix">
			<span class="smore"> <a href="<?php the_permalink() ?>"> Read More  </a>  </span>
		</div>
	</div>
	<?php $count++; ?>
	<?php if(++$counter % 2 == 0) : ?>
		<div class="clear"></div>
	<?php endif; ?>
	<?php endwhile; ?>

	<?php getpagenavi(); ?>

	<?php else : ?>

		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>	
	
</div> <!-- end .content -->
<div class="left">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
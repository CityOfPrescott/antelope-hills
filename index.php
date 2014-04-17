<?php get_header(); ?>
<div id="primary">
	<div id="content" role="main">
		<?php if (have_posts()) : ?>
		<?php $count = 0; ?>
		<?php /* Start the Loop */ ?>
		<?php while (have_posts()) : the_post(); ?>
		<div class="box" id="post-<?php the_ID(); ?>">
			This is index.php
			<a href="<?php the_permalink() ?>"><img class="boximg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=200&amp;w=330&amp;zc=1" alt=""/></a>
			<div class="btitle">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<div class="entry">
				<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
				<div class="clear"></div>
			</div>
			<div class="titlemeta clearfix">
				<span class="smore"> <a href="<?php the_permalink() ?>"> Read More  </a>  </span>
				<span class="slike"><?php printLikes(get_the_ID()); ?></span>
				<span class="comm"><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></span>
			</div>
		</div>
		<?php if(++$counter % 2 == 0) : ?>
			<div class="clear"></div>
		<?php endif; ?>
		<?php endwhile; ?>
		<div class="clear"></div>
		<?php getpagenavi(); ?>
		<?php else : ?>
				<h1 class="title">Not Found</h1>
				<p>Sorry, but you are looking for something that isn't here.</p>
		<?php endif; ?>
	</div><!-- #content -->
</div><!-- #primary -->
<div class="left">
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
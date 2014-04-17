<?php get_header(); ?>

<div id="content">

	<div class="blurb">
	<img src="<?php echo bloginfo('template_url'); ?>/images/golf_course_word_art.jpg" />
	<p>
	<?php // $id=68; $post = get_page($id); echo $post->post_content;  ?>
	</p>
	</div>
	

<div class="home_left">
<a href="http://webdev/services/wp-golf/?page_id=78">
<img src="<?php echo bloginfo('template_url'); ?>/images/North-Course_370.png" />
</a>
<a href="http://webdev/services/wp-golf/?page_id=81">
<img src="<?php echo bloginfo('template_url'); ?>/images/South-Course_370.png" class="right_tournament" />
</a>
</div>
<div class="clear"></div>
		<hr />
<div class="home_right">
<h3>Upcoming Tournaments</h3>
<?php 
$args2 = array(
	'cat' => 6,
	'posts_per_page' => 3,
	'meta_key' => '_start_eventtimestamp',
	'meta_value' => date("Ymd"),
	'meta_compare' => '>',
	'orderby' => 'meta_value',
	'order' => 'ASC'
); 
query_posts( $args2 );
?>
<?php if (have_posts()) : ?>
<?php $count = 0; ?>
<?php while (have_posts()) : the_post(); ?>

<!-- This div below had the class of box attahced to the post -->
<div class="box post-<?php the_ID(); if($count % 2 != 0) { echo ' right_tournament';} ?>">
	<a href="<?php the_permalink() ?>">
	<!--<img class="boximg" src="<?php //bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php //get_image_url(); ?>&amp;h=200&amp;w=330&amp;zc=1" alt=""/> -->
	</a>

	<div class="btitle">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<p><?php echo get_post_meta($post->ID, '_start_eventtimestamp', true); ?></p>	
		<p><?php echo date("Ymd"); ?></p>	
		<span class="golf_tees"></span>
	</div>
	<div class="entry">
		<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
		<div class="clear"></div>
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

<div class="clear"></div>
<?php getpagenavi(); ?>
<?php else : ?>
		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>

<h3>Past Tournaments</h3>
<?php 
$ugh = date("Ymd");
$args = array(
	'cat' => 6,
	'posts_per_page' => 3,
	'meta_key' => '_start_eventtimestamp',
	'meta_value' => $ugh,		
	'meta_compare' => '<',	
	'orderby' => 'meta_value',
	'order' => 'DESC'
); 
query_posts ($args);
?>
<?php if (have_posts()) : ?>
<?php $count = 0; ?>
<?php while (have_posts()) : the_post(); ?>

<!-- This div below had the class of box attahced to the post -->
<div class="box post-<?php the_ID(); if($count % 2 != 0) { echo ' right_tournament';} ?>">
	<a href="<?php the_permalink() ?>">
	<!--<img class="boximg" src="<?php //bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php //get_image_url(); ?>&amp;h=200&amp;w=330&amp;zc=1" alt=""/> -->
	</a>

	<div class="btitle">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<p><?php echo get_post_meta($post->ID, '_start_eventtimestamp', true); ?></p>
		<p><?php echo date("Ymd"); ?></p>			
		<span class="golf_tees"></span>
	</div>
	<div class="entry">
		<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
		<div class="clear"></div>
	</div>
	<div class="titlemeta clearfix">
		<span class="smore"> <a href="<?php the_permalink() ?>"> Read More  </a>  </span>
	</div>
</div>
<?php $count++; ?>
<?php if(++$counter % 2 == 0) : ?>
	<div class="clear"></div>
<?php endif; ?>
<?php endwhile; 
?>

<div class="clear"></div>
<?php getpagenavi(); ?>
<?php else : ?>
		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>
  
</div>
</div>

<div class="left">
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
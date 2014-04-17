<?php 
$num_posts = 3;
if (is_page( 'upcoming-tournaments' ) || is_page( 'previous-tournaments' ) ) {
	$ah_page = 'tournaments';
	$num_posts = '';	
	}
if ( is_post_type_archive( 'tournaments' )){$num_posts = 2;}	
?>
<?php if( !is_page( 'previous-tournaments' ) ){ ?>
	<div class="new_tourneys">
		<h2>
			<?php if( !is_page( 'upcoming-tournaments' ) ){ echo '<a href="' . get_bloginfo('home') . '/upcoming-tournaments/">';} ?>Upcoming Tournaments<?php if( !is_page( 'upcoming-tournaments' ) ){ echo '</a>'; }?>
			</h2>
		<?php 
		$args2 = array(
			'post_type' => 'tournaments',
			'posts_per_page' => $num_posts,	
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
		<div class="box post-<?php the_ID(); if($count != 0) { echo ' floatright';} ?>">
			<div class="inner_box">
				<div class="btitle">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<span class="golf_tees"></span>
				</div>
				<div class="entry">
					<?php wpe_excerpt('wpe_excerptlength_home', ''); ?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="titlemeta clearfix">
				<span class="smore"> <a href="<?php the_permalink() ?>"> Read More  </a>  </span>
			</div>
		</div>
		<?php $count++;?>
		<?php 
		if ($ah_page == 'tournaments' ) {
			if($count == 2) { 
				echo '<div style="clear: both"></div>';
				$count = 0;
			}
		}
		?>
		<?php endwhile; ?>

		<div class="clear"></div>
		<?php else : ?>
				<h1 class="title">Not Found</h1>
				<p>Sorry, but you are looking for something that isn't here.</p>
		<?php endif; ?>
	</div> <!-- end .new_tourneys -->
<?php } ?>
<?php 
wp_reset_query();
if( !is_page( '319' ) ){ ?>
	<div class="old_tourneys">
		<h2>
			<?php if( !is_page( 'previous-tournaments' ) ){ echo '<a href="' . get_bloginfo('home') . '/previous-tournaments/">';} ?>Previous Tournaments<?php if( !is_page( 'previous-tournaments' ) ){ echo '</a>'; }?>
			</h2>
		<?php 
		$ugh = date("Ymd");
		$args = array(
			'post_type' => 'tournaments',
			'posts_per_page' => $num_posts,
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
		<div class="box post-<?php the_ID(); if($count != 0) { echo ' floatright';} ?>">
			<a href="<?php the_permalink() ?>">
			<?php echo get_the_post_thumbnail($thumbnail->ID, 'hole-thumb', array('class' => 'boximg')); ?>
			</a>
			<div class="inner_box">		
				<div class="btitle">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="entry">
					<?php wpe_excerpt('wpe_excerptlength_home', ''); ?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="titlemeta clearfix">
				<span class="smore"> <a href="<?php the_permalink() ?>"> Read More  </a>  </span>
			</div>
		</div>
		<?php $count++; ?>
		<?php 
		if ($ah_page == 'tournaments' ) {
			if($count == 2) { 
				echo '<div style="clear: both"></div>';
				$count = 0;
			}
		}
		?>
		<?php endwhile; ?>
		<div class="clear"></div>
		<?php else : ?>
		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>
		<?php endif; ?>
	</div> <!-- end .old_tourneys -->  
<?php } ?>
<?php 
//$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
$num_posts = 3;
$tourney_page = '';
if ( is_page( 'upcoming-tournaments' ) || is_page( 'previous-tournaments' ) ) {
	$ah_page = 'tournaments';
	$num_posts = 4;	
	if ( is_page('upcoming-tournaments')) { $tourney_page = 'upcoming';}
	if ( is_page('previous-tournaments')) { $tourney_page = 'previous';}
}
if ( is_post_type_archive( 'tournaments' )){$num_posts = 2;}	
?>
<?php if( $tourney_page != 'previous' ){ ?>
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
			'paged' => $paged,
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
					<?php 
					$month_num = get_post_meta($post->ID, '_start_month', true); 
					$month_arr = array('', 'JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
					foreach ($month_arr as $key => $value) {
						if ($month_num == $key) {
							$month_name = $value; 
						}
					}
					?>	
					<div class="calendar">
					<img src="<?php echo bloginfo('template_url') ?>/images/calendar.png" class="cal" alt="Calendar icon" />
 					<?php
					echo '<div class="cal_mon">' . $month_name . '</div>';
					echo '<div class="cal_day">' . $month_date = get_post_meta($post->ID, '_start_day', true) . '</div>';
					?>
					</div>
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
		<?php if( $tourney_page == 'upcoming' ) { ?>
		<div class="clear"></div>
		<div class="navigation">
			<div class="alignleft"><?php previous_posts_link('Past Tournaments') ?></div>
			<div class="alignright"><?php next_posts_link('More Tournaments') ?></div>
		</div>
		<?php } ?>
		<div class="clear"></div>
		<?php else : ?>
				<h1 class="title">Not Found</h1>
				<p>Sorry, but you are looking for something that isn't here.</p>
				<?php next_posts_link('Older Entries �', 0); ?>
		<?php endif; ?>
	</div>
<?php if( $tourney_page != 'upcoming' ) { ?>	
		<div class="navigation">
			<div class="alignright"><a href="<?php echo get_bloginfo('url'); ?>/upcoming-tournaments/">More Upcoming Tournaments</a></div>
		</div>
		<div class="clear"></div>
		<?php } ?><!-- end .new_tourneys -->
<?php } ?>
<?php 
if( $tourney_page != 'upcoming' ){ ?>
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
			'paged' => $paged,
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
			<?php if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail($thumbnail->ID, 'hole-thumb', array('class' => 'boximg')); 
			} else {
				echo '<img src="' . get_bloginfo('template_url') . '/images/tournament_default.png" class="boximg" alt="Golf Tournament Photos Coming Soon"/>';
			}
			?>
			</a>
			<div class="inner_box">		
				<div class="btitle">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="entry">
					<?php 
					$month_num = get_post_meta($post->ID, '_start_month', true); 
					$month_arr = array('', 'JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
					foreach ($month_arr as $key => $value) {
						if ($month_num == $key) {
							$month_name = $value; 
						}
					}
					?>
					<div class="calendar">
					<img src="<?php echo bloginfo('template_url') ?>/images/calendar.png" class="cal" alt="Calendar icon" />
 					<?php
					echo '<div class="cal_mon">' . $month_name . '</div>';
					echo '<div class="cal_day">' . $month_date = get_post_meta($post->ID, '_start_day', true) . '</div>';
					?>
					</div>
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
		<?php if( $tourney_page == 'previous' ) { ?>
		<div class="clear"></div>
		<div class="navigation">
				<div class="alignleft"><?php next_posts_link('Past Tournaments') ?></div>
				<div class="alignright"><?php previous_posts_link('More Tournaments') ?></div>
		</div>
		<?php } ?>
		<div class="clear"></div>
		<?php else : ?>
		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>
		<?php endif; ?>
	</div>
	<?php if( $tourney_page != 'previous' ) { ?>
		<div class="navigation">
			<div class="alignright"><a href="<?php echo get_bloginfo('url'); ?>/previous-tournaments/">More Previous Tournaments</a></div>
		</div>
		<div class="clear"></div>
		<?php } ?> <!-- end .old_tourneys -->  
<?php } ?>
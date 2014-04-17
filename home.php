<?php get_header(); 
$homepage = 'yes';
?>
	<div id="content">
		<div class="content_home">
			<div class="blurb">
				<img src="<?php echo bloginfo('template_url'); ?>/images/golf_course_word_art.jpg" alt="Antelope Hills Golf Course in Prescott, Arizona" />
			</div>
			<div class="home_courses">
				<a href="<?php echo bloginfo('url'); ?>/north-course-hole-1/">
				<img src="<?php echo bloginfo('template_url'); ?>/images/North-Course_370.png" alt="North Course of Antelope Hills Golf Course in Prescott, Arizona" />
				</a>
				<a href="<?php echo bloginfo('url'); ?>/south-course-hole-1/">
				<img src="<?php echo bloginfo('template_url'); ?>/images/South-Course_370.png" alt="South Course of Antelope Hills Golf Course in Prescott, Arizona" class="floatright" />
				</a>
			</div>
		</div>
		<div class="left">
		<?php get_sidebar('home'); ?>
		</div>
	</div>
	<div class="clear"></div>
	<hr />
</div> <!-- end .casing_sidebar_graphic -->	

<div class="tourneys">
<?php get_template_part( 'inc', 'tournaments' );  ?>
</div><!-- end .tourneys -->  
</div><!-- end #casing -->
<?php get_footer(); ?>
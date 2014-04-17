<div class="left-col">
	<?php // include (TEMPLATEPATH . '/searchform.php'); ?>	
	<div class="sidebox">
		<h3 class="sidetitl">Book with us today!</h3>
		<?php get_template_part( 'sidebar', 'button' ); ?>
		<iframe width="275" height="250" src="http://www.youtube.com/embed/Wzu2qtZmIck"></iframe>		 
		<div class="man_button">
			<a href="<?php echo get_bloginfo('url'); ?>/manzanita-grill/"><img src="<?php echo bloginfo('template_url'); ?>/images/manzanita_logo_265.png" alt="manzanita grill" /></a>
		</div>
	</div>
	<!-- Sidebar widgets -->
	<div class="sidebar">
		<ul>
			<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
			<?php endif; ?>
		</ul>
	</div>
</div>
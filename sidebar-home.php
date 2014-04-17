<div class="left-col">
	<div class="sidebox">
		<h3 class="sidetitl">Book with us today!</h3>
		<?php get_template_part( 'sidebar', 'button' ); ?>
	</div>
	<!-- Sidebar widgets -->
	<div class="sidebar">
		<ul>
			<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
			<?php endif; ?>
		</ul>
	</div>
</div>
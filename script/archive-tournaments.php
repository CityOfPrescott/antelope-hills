<?php get_header(); ?>
<div id="content">
		<div class="host_tour">
		<h3><a href="<?php echo get_bloginfo('url') ?>/host-your-tournament/">Host Your Next Tournament at Antelope Hills!</a></h3>
		<span class="logo"></span>
		</div>
	<?php get_template_part( 'inc', 'tournaments' ); ?>
</div> <!-- end .content -->
<div class="left">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
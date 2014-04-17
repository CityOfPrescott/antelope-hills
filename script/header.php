<?php
/**
 * Displays all of the <head> section and everything up till <div id="main">
 */
?>
<!DOCTYPE html>
<!--[if gte IE 6]>
<html id="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
<?php
	//Print the <title> tag based on what is being viewed.
	global $page, $paged;
	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
?>
</title>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.png" />
<link href='http://fonts.googleapis.com/css?family=Crimson+Text:600' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Arbutus+Slab' rel='stylesheet' type='text/css'><link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php 
	wp_enqueue_script('jquery');
?>

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<?php 
if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' ); 
	wp_head(); ?>
</head>

<body <?php body_class('body'); ?>>

<div class="wrapper">  <!-- wrapper begin -->
	<header id="branding" role="banner">
		<div id="logo_sec">
			<a class="mylogo" href="<?php bloginfo('siteurl');?>/"><img src="<?php bloginfo('template_directory'); ?>/images/logo_220_brown.png" class="logoimg" alt="" /></a>
			<div id="blogname">	
				<h1>
					<a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"> <?php bloginfo('name');?></a>
				</h1>
			</div>
		</div>
		<?php echo do_shortcode('[portfolio_slideshow id=595 size=header speed=400 delay=1000 autoplay=true ]');?>
	</header>
</div>	
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'nav', 'walker' => new description_walker(),'fallback_cb'=> 'fallbackmenu' ) ); ?>
<div class="wrapper">
<div id="casing">
<?php if ( !is_singular( 'courses' ) ) { echo '<div class="casing_sidebar_graphic">'; } ?>
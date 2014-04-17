<?php
include 'inc/custom_posts.php';
include 'inc/admin_functions.php';

/* SIDEBARS */
if ( function_exists('register_sidebar') )

	register_sidebar(array(
	'name' => 'Sidebar',
    'before_widget' => '<li class="sidebox %2$s">',
    'after_widget' => '</li>',
	'before_title' => '<h3 class="sidetitl">',
    'after_title' => '</h3>',
    ));

	register_sidebar(array(
	'name' => 'Footer',
    'before_widget' => '<li class="botwid %2$s">',
    'after_widget' => '</li>',
	'before_title' => '<h3 class="bothead">',
    'after_title' => '</h3>',
    ));		
	
	
/* CUSTOM MENUS */	
register_nav_menus( array(
		'primary' => __( 'Primary Navigation', '' ),
	) );


/* CUSTOM EXCERPTS */
function wpe_excerptlength_home($length) { return 50; }	
function wpe_excerptlength_archive($length) { return 60; }
function wpe_excerptlength_index($length) { return 70; }

function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

/* FEATURED THUMBNAILS */
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'homepage-thumb', 720, 295, true ); //(cropped)
	add_image_size( 'hole-thumb', 290, 200, true ); //(cropped)	
	add_image_size( 'instructor-thumb', 290, 300, true ); //(cropped)				
	add_image_size( 'instructor-single', 300, 9999 ); 	
	add_image_size( 'header', 700, 250, true ); 
	add_image_size( 'gallery-tournaments', 500, 999 ); 
}

/* PAGE NAVIGATION */
function getpagenavi(){
?>
<div id="navigation" class="clearfix">
<?php if(function_exists('wp_pagenavi')) : ?>
<?php wp_pagenavi() ?>
<?php else : ?>
        <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','web2feeel')) ?></div>
        <div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','web2feel')) ?></div>
        <div class="clear"></div>
<?php endif; ?>

</div>

<?php
}


/* Menu Walker */
class description_walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
	 	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$prepend = '<strong>';
		$append = '</strong>';
		$description  = ! empty( $item->description ) ? '<span class="menudescription">'.esc_attr( $item->description ).'</span>' : '';
		if($depth != 0) {
			$description = $append = $prepend = "";
	  }
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, 	$item->ID ).$append;
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 
			'walker_nav_menu_start_el', $item_output, $item, $depth, $args 
		);
	}
}
?>
<?php 
/* PHOTO CROP MOD */
function my_awesome_image_resize_dimensions( $payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop ){  
  
    // Change this to a conditional that decides whether you   
    // want to override the defaults for this image or not.  
    if( false )  
        return $payload;  
  
    if ( $crop ) {  
        // crop the largest possible portion of the original image that we can size to $dest_w x $dest_h  
        $aspect_ratio = $orig_w / $orig_h;  
        $new_w = min($dest_w, $orig_w);  
        $new_h = min($dest_h, $orig_h);  
  
        if ( !$new_w ) {  
            $new_w = intval($new_h * $aspect_ratio);  
        }  
  
        if ( !$new_h ) {  
            $new_h = intval($new_w / $aspect_ratio);  
        }  
  
        $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);  
  
        $crop_w = round($new_w / $size_ratio);  
        $crop_h = round($new_h / $size_ratio);  
  
        $s_x = 0; // [[ formerly ]] ==> floor( ($orig_w - $crop_w) / 2 );  
        $s_y = 0; // [[ formerly ]] ==> floor( ($orig_h - $crop_h) / 2 );  
    } else {  
        // don't crop, just resize using $dest_w x $dest_h as a maximum bounding box  
        $crop_w = $orig_w;  
        $crop_h = $orig_h;  
  
        $s_x = 0;  
        $s_y = 0;  
  
        list( $new_w, $new_h ) = wp_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h );  
    }  
  
    // if the resulting image would be the same size or larger we don't want to resize it  
    if ( $new_w >= $orig_w && $new_h >= $orig_h )  
        return false;  
  
    // the return array matches the parameters to imagecopyresampled()  
    // int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h  
    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );  
  
}  
add_filter( 'image_resize_dimensions', 'my_awesome_image_resize_dimensions', 10, 6 ); 
?>
<?php
// add ie conditional html5 shim to header
function add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

remove_action( 'wp_header' ,  'wp_generator' );

/** Google Analytics
**************************************************************/
function google_analytics_tracking_code(){ ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2432710-7', 'antelopehillsgolf.com');
  ga('send', 'pageview');

</script>
<?php }	
add_action('wp_head', 'google_analytics_tracking_code');
?>

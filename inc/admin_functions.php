<?php
// add admin css
function customAdmin() {
    $url = get_bloginfo('template_url');
    $url = $url . '/css/wp_admin.css';
    echo '<!-- custom admin css -->
          <link rel="stylesheet" type="text/css" href="' . $url . '" />
          <!-- /end custom adming css -->';
}
add_action('admin_head', 'customAdmin');
add_action('login_head', 'customAdmin');
?>
<?php /* ADMIN MODS */
//Dashboard Widgets
if ( ! function_exists('golf_remove_widgets') ){
function golf_remove_widgets() {
  // Remove "Incoming Links" widget
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );
  
  // Remove "Plugins" widget
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );
  
  // Remove "Quick Press" widget
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );
  
  // Remove "Recent Drafts" widget
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );
  
  // Remove "WordPress Blog" widget
  remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );
  
  // Remove "Other News" widget
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );
}
// Hook into the dashboard action
add_action('admin_menu', 'golf_remove_widgets' );
}
//Remove Menu Items
add_action( 'admin_menu', 'my_remove_menu_pages', 999 );
function my_remove_menu_pages() {
if (! current_user_can('update_core')) {
remove_menu_page('edit.php');
remove_menu_page('upload.php');
remove_menu_page('link-manager.php');
remove_menu_page('edit-comments.php');
remove_menu_page('themes.php');
remove_menu_page('plugins.php');
remove_menu_page('users.php');
remove_menu_page('tools.php');
remove_menu_page('admin.php?page=wpcf7'); //Contact Form 7
remove_menu_page('options-general.php');
remove_menu_page('edit.php?post_type=portfolio_slideshow'); //Raygun Slideshow
remove_submenu_page('tools.php', 'tools.php');
remove_submenu_page( 'index.php', 'update-core.php' );
}
}
?>
<?php // Admin bar modsfunction remove_admin_bar_links() {
	global $wp_admin_bar;
	if (! current_user_can('update_core')) {
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('updates');
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('search');
		$wp_admin_bar->remove_menu('new-content');
	}
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
?>
<?php /* Create galler link on editor */
add_action('init', 'mylink_button');

function mylink_button() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     return;
   }
   if ( get_user_option('rich_editing') == 'true' ) {
     add_filter( 'mce_external_plugins', 'add_plugin' );
     add_filter( 'mce_buttons', 'register_button' );
   }
}

function register_button( $buttons ) {
 array_push( $buttons, "|", "mylink" );
 return $buttons;
}

function add_plugin( $plugin_array ) {
   $plugin_array['mylink'] = get_bloginfo( 'template_url' ) . '/script/raygun_gallery.js';
   return $plugin_array;
}
?>
<?php //ADD DATE COLUMN
// GET VALUE
function ST4_get_featured_image($post_ID) {  
$full_date = get_post_meta($post_ID, '_start_eventtimestamp', true);
$day_date = get_post_meta($post_ID, '_start_day', true);
$month_num = get_post_meta($post_ID, '_start_month', true);
$month_arr = array('', 'JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
					foreach ($month_arr as $key => $value) {
						if ($month_num == $key) {
							$month_name = $value; 
						}
					}
$year_date = get_post_meta($post_ID, '_start_year', true);
    if ($full_date) { 
			$custom_date = $month_name . ' ' . $day_date . '. ' . $year_date;
        return $custom_date;  
    }  
}
// ADD NEW COLUMN  
function ST4_columns_head($defaults) {  
    $defaults['tour_date'] = 'Tournament Date';  
    return $defaults;  
}  
// DISPLAY VALUE
function ST4_columns_content($column_name, $post_ID) {  
    if ($column_name == 'tour_date') {  
        $post_featured_image = ST4_get_featured_image($post_ID);  
        if ($post_featured_image) {  
            echo $post_featured_image;  
        }  
    }  
}
add_filter('manage_tournaments_posts_columns', 'ST4_columns_head');  
add_action('manage_tournaments_posts_custom_column', 'ST4_columns_content', 10, 2);  

//MAKE COLUMNS SORTABLE
add_filter( 'manage_edit-tournaments_sortable_columns', 'my_sortable_cake_column' );  
function my_sortable_cake_column( $columns ) {  
    $columns['tour_date'] = 'slice';  
    //To make a column 'un-sortable' remove it from the array  
    //unset($columns['date']);  
    return $columns;  
}
//DETERMINE ORDER BY
add_action( 'pre_get_posts', 'tour_date_orderby' );  
function tour_date_orderby( $query ) {  
    if( ! is_admin() )  
        return;  
    $orderby = $query->get( 'orderby');  
    if( 'slice' == $orderby ) {  
        $query->set('meta_key','_start_eventtimestamp');  
        $query->set('orderby','meta_value');  
    }  
}
?>
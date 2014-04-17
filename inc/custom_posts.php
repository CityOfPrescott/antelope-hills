<?php /* CUSTOM META BOXES */
//Course Holes
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'courses',
		array(
			'labels' => array(
				'name' => __( 'Holes' ),
				'singular_name' => __( 'Hole' )
			),
		'supports' => array('title', 'thumbnail'),
		'public' => true,
		'has_archive' => true,
		)
	);
	//Tournaments
	register_post_type( 'tournaments',
		array(
			'labels' => array(
				'name' => __( 'Tournaments' ),
				'singular_name' => __( 'Tournament' )
			),
		'supports' => array('title', 'editor', 'thumbnail'),	
		'public' => true,
		'has_archive' => true,
		)
	);	
	register_post_type( 'instructors',
		array(
			'labels' => array(
				'name' => __( 'Instructors' ),
				'singular_name' => __( 'Instructor' )
			),
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),	
		'public' => true,
		'query_var' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'golf-instructors')
		)
	);		
}



/* CUSTOM META BOXES */
// Custom Meta Box - Golf Hole Details
add_action("admin_init", "golf_add_meta");  
function golf_add_meta(){  
	add_meta_box("post-extras-meta", "Hole Details", "golf_meta_options", "courses", "normal", "high");   
}  
//Create area for extra fields
function golf_meta_options() {
	global $post;  
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
	$custom = get_post_custom($post->ID);
	$number = $custom["number"] [0];
	$black = $custom["black"] [0];
	$gold = $custom["gold"] [0];
	$blue = $custom["blue"] [0];
	$par = $custom["par"] [0];
	$mcap = $custom["mcap"] [0];	
	$pace = $custom["pace"] [0];
	$red = $custom["red"] [0];
	$lcap = $custom["lcap"] [0];
?>
<div class="golf">
<div><label>Hole Number:</label><input name="number" value="<?php echo $number; ?>" /></div>
<div><label>Black:</label><input name="black" value="<?php echo $black; ?>" /></div>
<div><label>Gold:</label><input name="gold" value="<?php echo $gold; ?>" /></div>	
<div><label>Blue:</label><input name="blue" value="<?php echo $blue; ?>" /></div>
<div><label>Par:</label><input name="par" value="<?php echo $par; ?>" /></div>
<div><label>Men's Handicap:</label><input name="mcap" value="<?php echo $mcap; ?>" /></div>
<div><label>Pace of Play:</label><input name="pace" value="<?php echo $pace; ?>" /></div>
<div><label>Red:</label><input name="red" value="<?php echo $red; ?>" /></div>
<div><label>Ladies' Handicap:</label><input name="lcap" value="<?php echo $lcap; ?>" /></div>
</div>   
<?php  
}
add_action('save_post', 'golf_save'); 
function golf_save(){  
	global $post;  
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ //if you remove this the sky will fall on your head.
	return $post_id;
	} else {
	update_post_meta($post->ID, "number", $_POST["number"]);
	update_post_meta($post->ID, "black", $_POST["black"]);  
	update_post_meta($post->ID, "gold", $_POST["gold"]); 
	update_post_meta($post->ID, "blue", $_POST["blue"]); 
	update_post_meta($post->ID, "par", $_POST["par"]); 
	update_post_meta($post->ID, "mcap", $_POST["mcap"]); 
	update_post_meta($post->ID, "pace", $_POST["pace"]); 
	update_post_meta($post->ID, "red", $_POST["red"]); 
	update_post_meta($post->ID, "lcap", $_POST["lcap"]);  
	} 
}
?>
<?php
//Custom Meta Box - Tournament Details
add_action("admin_init", "tourney_add_meta");  
function tourney_add_meta(){  
add_meta_box("post-extras-meta", "Tournament Date", "tourney_meta_options", "post", "side", "high");   
}  
//Create area for extra fields
function tourney_meta_options(){
global $post;  
if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
$custom = get_post_custom($post->ID);
$t_date = $custom["t_date"] [0];
?>
<div class="tourney">
<div><label>mm/dd/year:</label><input name="t_date" value="<?php echo $t_date; ?>" /></div>
</div>   
<?php  
}
add_action('save_post', 'tourney_save'); 
function tourney_save(){  
	global $post;  
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ //if you remove this the sky will fall on your head.
	return $post_id;
	} else {
	update_post_meta($post->ID, "t_date", $_POST["t_date"]);
	} 
}
?>
<?php
function ep_eventposts_metaboxes() {
    add_meta_box( 'ept_event_date_start', 'Start Date', 'ept_event_date', 'tournaments', 'side', 'default', array( 'id' => '_start') );
}
add_action( 'admin_init', 'ep_eventposts_metaboxes' );
// Metabox HTML
function ept_event_date($post, $args) {
    $metabox_id = $args['args']['id'];
    global $post, $wp_locale;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'ep_eventposts_nonce' );
    $time_adj = current_time( 'timestamp' );
    $month = get_post_meta( $post->ID, $metabox_id . '_month', true );
    if ( empty( $month ) ) {
        $month = gmdate( 'm', $time_adj );
    }
    $day = get_post_meta( $post->ID, $metabox_id . '_day', true );
    if ( empty( $day ) ) {
        $day = gmdate( 'd', $time_adj );
    }
    $year = get_post_meta( $post->ID, $metabox_id . '_year', true );
    if ( empty( $year ) ) {
        $year = gmdate( 'Y', $time_adj );
    }
    $month_s = '<select name="' . $metabox_id . '_month">';
    for ( $i = 1; $i < 13; $i = $i +1 ) {
        $month_s .= "\t\t\t" . '<option value="' . zeroise( $i, 2 ) . '"';
        if ( $i == $month )
            $month_s .= ' selected="selected"';
        $month_s .= '>' . $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) ) . "</option>\n";
    }
    $month_s .= '</select>';
    echo $month_s;
    echo '<input type="text" name="' . $metabox_id . '_day" value="' . $day  . '" size="2" maxlength="2" />';
    echo '<input type="text" name="' . $metabox_id . '_year" value="' . $year . '" size="4" maxlength="4" />';
}
// Save the Metabox Data
function ep_eventposts_save_meta( $post_id, $post ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !isset( $_POST['ep_eventposts_nonce'] ) )
        return;
    if ( !wp_verify_nonce( $_POST['ep_eventposts_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ) )
        return;
    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though
    $metabox_ids = array( '_start', '_end' );
    foreach ($metabox_ids as $key ) {
        $events_meta[$key . '_month'] = $_POST[$key . '_month'];
        $events_meta[$key . '_day'] = $_POST[$key . '_day'];
            if($_POST[$key . '_hour']<10){
                 $events_meta[$key . '_hour'] = '0'.$_POST[$key . '_hour'];
             } else {
                   $events_meta[$key . '_hour'] = $_POST[$key . '_hour'];
             }
        $events_meta[$key . '_year'] = $_POST[$key . '_year'];
        $events_meta[$key . '_hour'] = $_POST[$key . '_hour'];
        $events_meta[$key . '_minute'] = $_POST[$key . '_minute'];
        $events_meta[$key . '_eventtimestamp'] = $events_meta[$key . '_year'] . $events_meta[$key . '_month'] . $events_meta[$key . '_day'] . $events_meta[$key . '_hour'] . $events_meta[$key . '_minute'];
    }
    // Add values of $events_meta as custom fields
    foreach ( $events_meta as $key => $value ) { // Cycle through the $events_meta array!
        if ( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode( ',', (array)$value ); // If $value is an array, make it a CSV (unlikely)
        if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
            update_post_meta( $post->ID, $key, $value );
        } else { // If the custom field doesn't have a value
            add_post_meta( $post->ID, $key, $value );
        }
        if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
    }
}
add_action( 'save_post', 'ep_eventposts_save_meta', 1, 2 );
/**
 * Helpers to display the date on the front end
 */
// Get the Month Abbreviation
function eventposttype_get_the_month_abbr($month) {
    global $wp_locale;
    for ( $i = 1; $i < 13; $i = $i +1 ) {
                if ( $i == $month )
                    $monthabbr = $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) );
                }
    return $monthabbr;
}
// Display the date
function eventposttype_get_the_event_date() {
    global $post;
    $eventdate = '';
    $month = get_post_meta($post->ID, '_month', true);
    $eventdate = eventposttype_get_the_month_abbr($month);
    $eventdate .= ' ' . get_post_meta($post->ID, '_day', true) . ',';
    $eventdate .= ' ' . get_post_meta($post->ID, '_year', true);
    echo $eventdate;
}
?>
<?php
/*function move_drag_drop_meta_box(){
	remove_meta_box('drag_to_upload', __('Featured Image'), 'dgd_upload_meta_box', 'courses', 'side', 'high');
	add_meta_box('drag_to_upload', __('Hole Image'), 'dgd_upload_meta_box', 'courses', 'normal', 'high');
}
add_action('plugins_loaded', 'move_drag_drop_meta_box' ); */
?>
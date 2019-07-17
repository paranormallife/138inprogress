<?php

/**
 * @package WordPress
 * @subpackage asw_template
 */

// Thumbnails
add_theme_support('post-thumbnails');



//menus
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'nav1' => __( 'Header Navigation' ),
			'nav2' => __( 'Footer Navigation' )
		)
	);
}



// make sure quotes and single quotes dont end up in the url
add_action( 'title_save_pre', 'do_replace_dashes' );
function do_replace_dashes($string_to_clean) {
    $string_to_clean = str_replace( array('&#8212;', '—', '&#8211;', '–', '‚', '„', '“', '”', '’', '‘', '…'), array(' -- ',' -- ', '--','--', ',', ',,', '"', '"', "'", "'", '...'), $string_to_clean );
    return $string_to_clean;
}

//remove wp version from head
remove_action('wp_head', 'wp_generator');


// Custom Taxonomies (Should be above Custom Post Types)
function asw_register_taxonomies() {
	register_taxonomy("media_role", array("attachment"), 
	array(
		"hierarchical" => true, 
		"label" => __('Media Roles', 'attachment'), 
		"singular_label" => "Media Role",
		"show_in_rest" => "true", 
		"rewrite" => true));
}


// Custom Post Types

function js_init() {
  asw_register_custom_types(); // Register Custom Post Types
  asw_register_taxonomies(); // Register Custom Taxonomies
}

add_action('init', 'js_init');

function asw_register_custom_types() {
	

	// FRONT PAGE HERO
	register_post_type(
		  'hero', array(
			  'labels' => array(
				  'name' => 'Homepage Slides', 
				  'singular_name' => 'Homepage Carousel', 
				  'add_new' => 'Add new slide', 
				  'add_new_item' => 'Add new slide', 
				  'new_item' => 'New slide', 
				  'view_item' => 'View slides',
				  'edit_item' => 'Edit slide',
				  'not_found' =>  __('No slides found'),
				  'not_found_in_trash' => __('No slides found in Trash')
			  ), 
			  'public' => true,
			  'publicly_queryable' => true,
			  'show_ui' => true,
			  'query_var' => true,
			  'rewrite' => false,
			  'capability_type' => 'post',
			  'has_archive' => false,
			  'menu_icon' => 'dashicons-images-alt',
			  'exclude_from_search' => true, // If this is set to TRUE, Taxonomy pages won't work.
			  'hierarchical' => true,
			  'menu_position' => null,
			  'supports' => array('title', 'thumbnail')
		 )
	  );
	
	flush_rewrite_rules();
 
 	add_action('add_meta_boxes', 'asw_add_meta');
	add_action('save_post', 'asw_save_meta');
 
}


function asw_add_meta() {
	add_meta_box('book_title_field', 'Book Title', 'book_title', array('post'), 'normal', 'high');
	add_meta_box('book_subtitle_field', 'Book Subtitle', 'book_subtitle', array('post'), 'normal', 'high');
}

function book_title($post) {
    echo '<div id="book_title">';
    echo '<input type="text" style="width:95%;" id="book_title" name="book_title" placeholder="Title" value="' . get_post_meta($post->ID, 'book_title', true) . '" />';
    echo '</div>';
}

function book_subtitle($post) {
    echo '<div id="book_title">';
    echo '<input type="text" style="width:95%;" id="book_subtitle" name="book_subtitle" placeholder="Subtitle" value="' . get_post_meta($post->ID, 'book_subtitle', true) . '" />';
    echo '</div>';
}


// Save the Custom Field Data
function asw_save_meta($post_id) {

    if (wp_is_post_revision($post_id)) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
       return $post_id;
    }

    if (isset($_POST['book_title'])) {
       update_post_meta($post_id, 'book_title', $_POST['book_title']);
    }

    if (isset($_POST['book_subtitle'])) {
       update_post_meta($post_id, 'book_subtitle', $_POST['book_subtitle']);
    }
	
}

function mytheme_setup() {
    // Add support for Block Styles
	add_theme_support( 'wp-block-styles' );
	// Add Color Palettes
	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'Black', 'wkc01' ),
			'slug' => 'black',
			'color' => '#000',
		),
		array(
			'name' => __( 'White', 'wkc01' ),
			'slug' => 'white',
			'color' => '#FFF',
		),
		array(
			'name' => __( 'WKC Blue', 'wkc01' ),
			'slug' => 'wkc_blue',
			'color' => '#1d5565',
		),
		array(
			'name' => __( 'WKC Gold', 'wkc01' ),
			'slug' => 'wkc_gold',
			'color' => '#E2B33E',
		),
	) );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support('disable-custom-font-sizes');
}
add_action( 'after_setup_theme', 'mytheme_setup' );

?>
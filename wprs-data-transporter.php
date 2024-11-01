<?php
/*
Plugin Name:	WPRS Data Transporter
Plugin URI:		https://wprichsnippets.com
Description:	Helps you transfer post/page specific reviews data, like rating, item name, item description, price, etc., from one platform (theme or plugin) to another.
Version:		0.1
Author:			Hesham Zebida
Author URI:		http://zebida.com/
*/

define('WPRSDT_PLUGIN_DIR', dirname(__FILE__));

add_action( 'plugins_loaded', 'wprsdt_init' );
/**
 * Initialize the WPRS Data Transporter plugin
 */
function wprsdt_init() {

	global $_wprsdt_themes, $_wprsdt_plugins, $_wprsdt_platforms;

	/**
	 * The associative array of supported themes.
	 */
	$_wprsdt_themes = array(
		// alphabatized
		'Builder' => array(
			'Custom Doctitle' => '_builder_seo_title',
			'META Description' => '_builder_seo_description',
			'META Keywords' => '_builder_seo_keywords',
		),
		'Catalyst' => array(
			'Custom Doctitle' => '_catalyst_title',
			'META Description' => '_catalyst_description',
			'META Keywords' => '_catalyst_keywords',
			'noindex' => '_catalyst_noindex',
			'nofollow' => '_catalyst_nofollow',
			'noarchive' => '_catalyst_noarchive',
		),
		'Frugal' => array(
			'Custom Doctitle' => '_title',
			'META Description' => '_description',
			'META Keywords' => '_keywords',
			'noindex' => '_noindex',
			'nofollow' => '_nofollow',
		),
		'Genesis' => array(
			'Custom Doctitle' => '_genesis_title',
			'META Description' => '_genesis_description',
			'META Keywords' => '_genesis_keywords',
			'noindex' => '_genesis_noindex',
			'nofollow' => '_genesis_nofollow',
			'noarchive' => '_genesis_noarchive',
			'Canonical URI' => '_genesis_canonical_uri',
			'Custom Scripts' => '_genesis_scripts',
			'Redirect URI' => 'redirect',
		),
		'Headway' => array(
			'Custom Doctitle' => '_title',
			'META Description' => '_description',
			'META Keywords' => '_keywords',
		),
		'Hybrid' => array(
			'Custom Doctitle' => 'Title',
			'META Description' => 'Description',
			'META Keywords' => 'Keywords',
		),
		'Thesis 1.x' => array(
			'Custom Doctitle' => 'thesis_title',
			'META Description' => 'thesis_description',
			'META Keywords' => 'thesis_keywords',
			'Custom Scripts' => 'thesis_javascript_scripts',
			'Redirect URI' => 'thesis_redirect',
		),
		/*
		'Thesis 2.x' => array(
			'Custom Doctitle' => '_thesis_title_tag',
			'META Description' => '_thesis_meta_description',
			'META Keywords' => '_thesis_meta_keywords',
			'Custom Scripts' => '_thesis_javascript_scripts',
			'Canonical URI' => '_thesis_canonical_link',
			'Redirect URI' => '_thesis_redirect',
		),
		*/
		'WooFramework' => array(
			'Custom Doctitle' => 'seo_title',
			'META Description' => 'seo_description',
			'META Keywords' => 'seo_keywords',
		)
	);

	/**
	 * The associative array of supported plugins.
	 */
	$_wprsdt_plugins = array(
		// alphabatized
		'Author hReview' => array(
			
			'Rating' => 'ta_post_review_rating',
			'Item Name' => 'ta_post_review_name',
			'Description' => 'ta_post_review_summary',
			
			'Price' => 'ta_post_review_price',
			
			//'User Snippets Enable' => 'ta_post_user_snippets_enable',
			'Disclaimer Eenable' => 'ta_post_review_disclaimer_enable',
			
			'Pros' => 'ta_post_review_pros',
			'Cons' => 'ta_post_review_cons',
			'Display Pros & Cons' => 'ta_post_display_pros_cons',
			
			'Box Position' => 'ta_post_review_box_below',
			'Box Hide' => 'ta_post_review_box_hide',
			
			'Image' => 'ta_post_review_image',
			'Gallery Slider' => 'ta_post_review_gallery_slider',
			'Video' => 'ta_post_review_video',
			'Slider Shortcode' => 'ta_post_review_slider_shortcode',
			'Image ALT' => 'ta_post_img_alt',
			
			'Link' => 'ta_post_review_url',
			'Button Text' => 'ta_post_review_button_text',
			'Demo Link' => 'ta_post_review_demo_url',
			'Link Target Window' => 'ta_post_review_link_window',
			'Dofollow Link' => 'ta_post_review_dofollow',
			
			'Author Name' => 'ta_post_review_author_name',
		),
		
		'WP Reviews' => array(
			
			'Rating' => 'ta_post_review_rating',
			'Item Name' => 'ta_post_review_name',
			'Description' => 'ta_post_review_summary',
			
			'Price' => 'ta_post_review_price',
			
			'User Snippets Enable' => 'ta_post_user_snippets_enable',
			'Disclaimer Enable' => 'ta_post_review_disclaimer_enable',
			
			'Pros' => 'ta_post_review_pros',
			'Cons' => 'ta_post_review_cons',
			'Display Pros & Cons' => 'ta_post_display_pros_cons',
			
			'Box Position' => 'ta_post_review_box_below',
			'Box Hide' => 'ta_post_review_box_hide',
			
			'Image' => 'ta_post_review_image',
			'Gallery Slider' => 'ta_post_review_gallery_slider',
			'Video' => 'ta_post_review_video',
			'Slider Shortcode' => 'ta_post_review_slider_shortcode',
			'Image ALT' => 'ta_post_img_alt',
			
			'Link' => 'ta_post_review_url',
			'Button Text' => 'ta_post_review_button_text',
			'Demo Link' => 'ta_post_review_demo_url',
			'Link Target Window' => 'ta_post_review_link_window',
			'Dofollow Link' => 'ta_post_review_dofollow',
			
			'Criteria' => 'ta_post_repeatable',
			
			'Author Name' => 'ta_post_review_author_name',
			
			'User Rating Average' => 'userrating_average',
			'User Rating Count' => 'userrating_count',
			
		),
		
		'WPRichSnippet' => array(
			
			'Rating' => '_wprs_post_star_rating',
			'Item Name' => '_wprs_post_item_name',
			'Description' => '_wprs_post_item_description',
			
			'Price' => '_wprs_post_lowprice',
			
			//'User Snippets Enable' => 'ta_post_user_snippets_enable',
			'Disclaimer Enable' => '_wprs_post_disclaimer_enable',
			
			'Pros' => '_wprs_post_pros',
			'Cons' => '_wprs_post_cons',
			'Display Pros & Cons' => '_wprs_post_display_pros_cons',
			
			'Box Position' => '_wprs_post_display_box_below_content',
			
			'Image' => '_wprs_post_image',
			'Gallery Slider' => '_wprs_post_gallery_slider',
			'Video' => '_wprs_post_youtube',
			'Slider Shortcode' => '_wprs_post_slider_shortcode',
			'Image ALT' => '_wprs_post_image_alt',
			
			'Link' => '_wprs_post_item_url',
			'Button Text' => '_wprs_post_button_text',
			'Demo Link' => '_wprs_post_item_demo_url',
			'Link Target Window' => '_wprs_post_link_target',
			'Dofollow Link' => '_wprs_post_link_dofollow',
			
			'Criteria' => '_wprs_post_repeatable',
			
			'Author Name' => '_wprs_post_author_name',
			
			'User Rating Average' => '_wprs_post_userrating_average',
			'User Rating Count' => '_wprs_post_userrating_count',
		),
	);

	/**
	 * The combined array of supported platforms.
	 */
	$_wprsdt_platforms = array_merge( $_wprsdt_themes, $_wprsdt_plugins );

	/**
	 * Include the other elements of the plugin.
	 */
	require_once( WPRSDT_PLUGIN_DIR . '/admin.php' );
	require_once( WPRSDT_PLUGIN_DIR . '/functions.php' );

	/**
	 * Init hook.
	 *
	 * Hook fires after plugin functions are loaded.
	 *
	 * @since 0.9.10
	 *
	 */
	do_action( 'wprsdt_init' );

}

/**
 * Activation Hook
 * @since 0.9.4
 */
register_activation_hook( __FILE__, 'wprsdt_activation_hook' );
function wprsdt_activation_hook() {

	require_once( WPRSDT_PLUGIN_DIR . '/functions.php' );

	//wprsdt_meta_key_convert( '_yoast_seo_title', 'yoast_wpseo_title', true );
	//wprsdt_meta_key_convert( '_yoast_seo_metadesc', 'yoast_wpseo_metadesc', true );	

}

/**
 * Manual conversion test
 */
/*
$wprsdt_convert = wprsdt_post_meta_convert( 'All in One SEO Pack', 'Genesis', false );
printf( '%d records were updated', $wprsdt_convert->updated );
/**/

/**
 * Manual analysis test
 */
/*
$wprsdt_analyze = wprsdt_post_meta_analyze( 'All in One SEO Pack', 'Genesis' );
printf( '<p><b>%d</b> Compatible Records were identified</p>', $wprsdt_analyze->update );
/**/

/**
 * Delete all SEO data, from every platform
 */
/*
foreach ( $_wprsdt_platforms as $platform => $data ) {
	
	foreach ( $data as $field ) {
		$deleted = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_key = %s", $field ) );
		printf( '%d %s records deleted<br />', $deleted, $field );
	}
	
}
/**/

/**
 * Query all SEO data to find the number of records to change
 */
/*
foreach ( $_wprsdt_platforms as $platform => $data ) {
	
	foreach ( $data as $field ) {
		$update = $wpdb->get_results( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s", $field ) );
		printf( '%d %s records can be updated<br />', count( $update ), $field );
		//print_r($update);
	}
	
}
/**/
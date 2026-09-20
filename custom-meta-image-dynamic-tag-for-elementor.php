<?php
/**
 * Plugin Name:       Custom Meta Image Dynamic Tag for Elementor
 * Plugin URI:        https://maxsofttechnologies.com
 * Description:       Adds an Elementor dynamic image tag that displays a custom WordPress post meta image field by meta key.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Mueed Ullah
 * Author URI:        https://maxsofttechnologies.com
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       custom-meta-image-dynamic-tag-for-elementor
 * Requires Plugins:  elementor
 *
 * @package Custom_Meta_Image_Dynamic_Tag_For_Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MAXSOFT_CMIDT_VERSION' ) ) {
	define( 'MAXSOFT_CMIDT_VERSION', '1.0.0' );
}

if ( ! defined( 'MAXSOFT_CMIDT_PATH' ) ) {
	define( 'MAXSOFT_CMIDT_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * Register Elementor dynamic tag group and tag.
 *
 * @param \Elementor\Core\DynamicTags\Manager $dynamic_tags_manager Elementor dynamic tags manager.
 * @return void
 */
function maxsoft_cmidt_register_dynamic_tags( $dynamic_tags_manager ) {
	if ( ! class_exists( '\\Elementor\\Core\\DynamicTags\\Data_Tag' ) ) {
		return;
	}

	$dynamic_tags_manager->register_group(
		'maxsoft-custom-fields',
		array(
			'title' => esc_html__( 'MaXsoft Custom Fields', 'custom-meta-image-dynamic-tag-for-elementor' ),
		)
	);

	require_once MAXSOFT_CMIDT_PATH . 'includes/class-maxsoft-custom-meta-image-tag.php';

	if ( class_exists( 'MaXsoft_Custom_Meta_Image_Tag' ) ) {
		$dynamic_tags_manager->register( new MaXsoft_Custom_Meta_Image_Tag() );
	}
}
add_action( 'elementor/dynamic_tags/register', 'maxsoft_cmidt_register_dynamic_tags' );

/**
 * Show an admin notice if Elementor is not active.
 *
 * @return void
 */
function maxsoft_cmidt_elementor_missing_notice() {
	if ( did_action( 'elementor/loaded' ) ) {
		return;
	}

	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__( 'Custom Meta Image Dynamic Tag for Elementor requires Elementor to be installed and active.', 'custom-meta-image-dynamic-tag-for-elementor' )
	);
}
add_action( 'admin_notices', 'maxsoft_cmidt_elementor_missing_notice' );

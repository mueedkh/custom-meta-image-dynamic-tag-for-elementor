<?php
/**
 * Elementor Custom Meta Image dynamic tag class.
 *
 * @package Elementor_Custom_Meta_Image_Dynamic_Tag
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dynamic image tag that reads a normal WordPress post meta field by meta key.
 */
class MaxSoft_Custom_Meta_Image_Tag extends \Elementor\Core\DynamicTags\Data_Tag {

	/**
	 * Get dynamic tag name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'maxsoft-custom-meta-image';
	}

	/**
	 * Get dynamic tag title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Custom Meta Image', 'elementor-custom-meta-image-dynamic-tag' );
	}

	/**
	 * Get dynamic tag group.
	 *
	 * @return array
	 */
	public function get_group() {
		return array( 'maxsoft-custom-fields' );
	}

	/**
	 * Get compatible dynamic tag categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( \Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY );
	}

	/**
	 * Register controls shown inside Elementor dynamic tag settings.
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->add_control(
			'meta_key',
			array(
				'label'       => esc_html__( 'Meta Key', 'elementor-custom-meta-image-dynamic-tag' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example_image_meta_key', 'elementor-custom-meta-image-dynamic-tag' ),
				'description' => esc_html__( 'Enter the exact custom field / post meta key that stores an image attachment ID or image URL.', 'elementor-custom-meta-image-dynamic-tag' ),
			)
		);
	}

	/**
	 * Return image data to Elementor Image widget.
	 *
	 * Supported values:
	 * - Attachment ID: 123
	 * - Image URL: https://example.com/image.jpg
	 * - Array with id / ID / url key.
	 *
	 * @param array $options Elementor options.
	 * @return array
	 */
	public function get_value( array $options = array() ) {
		$empty_image = array(
			'id'  => 0,
			'url' => '',
		);

		$meta_key = trim( (string) $this->get_settings( 'meta_key' ) );

		if ( '' === $meta_key ) {
			return $empty_image;
		}

		$post_id = get_the_ID();

		// Fall back to the queried object on singular template/preview contexts
		// where the main loop has not set up the current post.
		if ( ! $post_id && is_singular() ) {
			$post_id = get_queried_object_id();
		}

		if ( ! $post_id ) {
			return $empty_image;
		}

		$value = get_post_meta( $post_id, $meta_key, true );

		if ( empty( $value ) ) {
			return $empty_image;
		}

		return $this->format_image_value( $value, $empty_image );
	}

	/**
	 * Format custom field value into Elementor image array.
	 *
	 * @param mixed $value       Saved meta value.
	 * @param array $empty_image Empty image fallback.
	 * @return array
	 */
	private function format_image_value( $value, $empty_image ) {
		// Attachment ID saved as integer or numeric string.
		if ( is_numeric( $value ) ) {
			return $this->get_image_from_attachment_id( (int) $value, $empty_image );
		}

		// Direct image URL saved as string.
		if ( is_string( $value ) ) {
			$url = trim( $value );

			if ( filter_var( $url, FILTER_VALIDATE_URL ) ) {
				return array(
					'id'  => 0,
					'url' => esc_url_raw( $url ),
				);
			}
		}

		// Some plugins save image values as arrays.
		if ( is_array( $value ) ) {
			$attachment_id = 0;

			if ( ! empty( $value['id'] ) && is_numeric( $value['id'] ) ) {
				$attachment_id = (int) $value['id'];
			} elseif ( ! empty( $value['ID'] ) && is_numeric( $value['ID'] ) ) {
				$attachment_id = (int) $value['ID'];
			}

			if ( $attachment_id > 0 ) {
				return $this->get_image_from_attachment_id( $attachment_id, $empty_image );
			}

			if ( ! empty( $value['url'] ) && filter_var( $value['url'], FILTER_VALIDATE_URL ) ) {
				return array(
					'id'  => 0,
					'url' => esc_url_raw( $value['url'] ),
				);
			}
		}

		return $empty_image;
	}

	/**
	 * Build image data from attachment ID.
	 *
	 * @param int   $attachment_id Attachment ID.
	 * @param array $empty_image   Empty image fallback.
	 * @return array
	 */
	private function get_image_from_attachment_id( $attachment_id, $empty_image ) {
		if ( $attachment_id <= 0 ) {
			return $empty_image;
		}

		$mime_type = get_post_mime_type( $attachment_id );

		if ( ! $mime_type || 0 !== strpos( $mime_type, 'image/' ) ) {
			return $empty_image;
		}

		$image_url = wp_get_attachment_image_url( $attachment_id, 'full' );

		if ( ! $image_url ) {
			return $empty_image;
		}

		return array(
			'id'  => $attachment_id,
			'url' => esc_url_raw( $image_url ),
		);
	}
}

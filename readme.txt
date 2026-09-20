=== Elementor Custom Meta Image Dynamic Tag ===
Contributors: mueedkh
Tags: elementor, dynamic tags, custom fields, post meta, image
Requires at least: 5.8
Tested up to: 6.9
Requires PHP: 7.4
Requires Plugins: elementor
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds an Elementor dynamic image tag for displaying normal WordPress post meta image fields by meta key.

== Description ==

Elementor Custom Meta Image Dynamic Tag adds a simple dynamic tag for Elementor Image widgets.

It lets you display an image stored in a normal WordPress custom field / post meta field without using ACF.

The plugin supports custom field values saved as:

* WordPress media attachment ID, for example: `123`
* Direct image URL, for example: `https://example.com/image.jpg`
* Array value with an `id`, `ID`, or `url` key

Author: maxsofttechnologies
Author URI: https://maxsofttechnologies.com  
Contact: moeedullah@gmail.com

Requires Elementor 3.5 or newer, which is when the current dynamic tag registration API was introduced.

Important: Elementor dynamic tags are available through Elementor's dynamic tag system. Make sure Elementor is installed and active. Elementor Pro may be required depending on your Elementor setup and the widget/control where you want to use dynamic tags.

== Installation ==

= From WordPress Admin =

1. Download the plugin ZIP file.
2. Go to your WordPress Dashboard.
3. Go to Plugins > Add New.
4. Click Upload Plugin.
5. Choose the ZIP file.
6. Click Install Now.
7. Click Activate Plugin.
8. Make sure Elementor is installed and active.

= Manual Installation =

1. Upload the `elementor-custom-meta-image-dynamic-tag` folder to `/wp-content/plugins/`.
2. Go to your WordPress Dashboard.
3. Go to Plugins.
4. Activate Elementor Custom Meta Image Dynamic Tag.
5. Make sure Elementor is installed and active.

== How to Use ==

1. Open your page, post, or template with Elementor.
2. Add an Image widget.
3. Click the Dynamic Tags icon next to the Image field.
4. Select Custom Meta Image under the MaXsoft Custom Fields group.
5. Enter your exact meta key, for example: `property_image`.
6. Update or publish the page.

== Example ==

If your custom field key is:

`property_image`

And its value is an attachment ID:

`123`

Or an image URL:

`https://example.com/uploads/property.jpg`

The Elementor Image widget will display that image dynamically.

== Frequently Asked Questions ==

= Does this plugin require ACF? =

No. This plugin reads normal WordPress post meta using a meta key.

= Does this plugin automatically scan all custom fields? =

No. You manually enter the meta key inside the Elementor dynamic tag settings.

= What type of custom field value should I use? =

Use either a WordPress media attachment ID or a direct image URL.

= Why is my image not showing? =

Check these points:

1. Elementor is active.
2. The custom field key is correct.
3. The custom field has a value on the current post.
4. The value is either an image attachment ID or an image URL.
5. You are previewing the correct post or template context inside Elementor.

= Can I use it in custom post types? =

Yes. It works with any post type as long as the current post has the meta key and the value is a valid image attachment ID or image URL.

== Changelog ==

= 1.0.0 =
* Initial release.
* Added Elementor dynamic image tag for custom post meta image fields.
* Added support for attachment IDs, image URLs, and simple array values.

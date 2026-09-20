=== Custom Meta Image Dynamic Tag for Elementor ===
Contributors: mueedkh
Tags: elementor, dynamic tags, custom fields, post meta, image
Requires at least: 5.8
Tested up to: 7.1
Requires PHP: 7.4
Requires Plugins: elementor
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display an image stored in a normal WordPress custom field through an Elementor dynamic tag, selected by meta key.

== Description ==

Elementor can pull images from a handful of field plugins out of the box. If your image is stored in a plain post meta row, written by your theme, a custom metabox, an importer, or your own code, there is no built-in way to bind it to an Image widget.

This plugin adds a dynamic tag that does exactly that. You type the meta key, and the Image widget resolves it against the current post on every render.

**Supported custom field values**

* A WordPress media attachment ID, for example `123`
* A direct image URL, for example `https://example.com/uploads/photo.jpg`
* A root-relative path, for example `/wp-content/uploads/photo.jpg`
* An array containing an `id`, `ID`, or `url` key

Anything else resolves to an empty image, so the widget simply renders nothing rather than producing a broken image.

**Using the tag**

1. Edit a page, post, or template with Elementor.
2. Add an Image widget.
3. Click the dynamic tags icon next to the Choose Image control.
4. Select Custom Meta Image under the MaXsoft Custom Fields group.
5. Enter the exact meta key, for example `property_image`.

**Requirements**

This plugin requires Elementor 3.5 or newer, which is when the current dynamic tag registration API was introduced. Depending on your Elementor setup, the widget or control where you want to use dynamic tags may require Elementor Pro.

== Installation ==

= From the WordPress admin =

1. Go to Plugins > Add New > Upload Plugin.
2. Choose the plugin ZIP file.
3. Click Install Now, then Activate.
4. Make sure Elementor is installed and active.

= Manually =

1. Upload the `custom-meta-image-dynamic-tag-for-elementor` folder to `/wp-content/plugins/`.
2. Activate the plugin from the Plugins screen.
3. Make sure Elementor is installed and active.

== Frequently Asked Questions ==

= Does this plugin require Advanced Custom Fields? =

No. It reads normal WordPress post meta using the meta key you provide.

= Does it scan all custom fields automatically? =

No. You enter the meta key yourself in the dynamic tag settings. This keeps the tag predictable and avoids listing every meta key on the site.

= What kind of value should the custom field hold? =

A media attachment ID or an image URL. Attachment IDs are preferred, because WordPress can then generate the correct image sizes.

= Can I use it with custom post types? =

Yes. It works with any post type, as long as the current post has the meta key and the value resolves to an image.

= Why is my image not showing? =

Check these points in order:

1. Elementor is active and is version 3.5 or newer.
2. The meta key is spelled exactly as stored. Keys are case sensitive.
3. The current post actually has a value for that key.
4. The value is an attachment ID or an image URL, not a bare filename.
5. You are previewing the correct post context. Inside a template, use Elementor's preview settings to point at a real post.

= The meta key holds an attachment ID but nothing renders. =

The plugin checks that the attachment is an image before returning it. If the ID points at a PDF or another non-image file, the tag returns nothing on purpose.

== Changelog ==

= 1.0.0 =
* Initial release.
* Elementor dynamic image tag for custom post meta image fields.
* Support for attachment IDs, absolute and root-relative image URLs, and simple array values.

== Upgrade Notice ==

= 1.0.0 =
Initial release.

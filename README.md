# Elementor Custom Meta Image Dynamic Tag

Adds an Elementor dynamic image tag that displays an image stored in a normal WordPress
custom field (post meta), selected by meta key. No ACF required.

- **Requires:** WordPress 5.8+, PHP 7.4+, Elementor 3.5+
- **License:** GPLv2 or later

## Why

Elementor can pull images from ACF and a few other field plugins out of the box. If your
image is stored in a plain `post_meta` row (written by a theme, a custom metabox, an
importer, or your own code), there is no built-in way to bind it to an Image widget.
This plugin adds that.

## Supported meta values

| Stored value | Example |
| --- | --- |
| Media attachment ID | `123` |
| Direct image URL | `https://example.com/uploads/photo.jpg` |
| Array with `id`, `ID`, or `url` | `array( 'id' => 123 )` |

Anything else resolves to an empty image, so the widget simply renders nothing.

## Installation

**From the WordPress admin**

1. Download the plugin ZIP.
2. Go to *Plugins > Add New > Upload Plugin*.
3. Choose the ZIP, click *Install Now*, then *Activate*.
4. Make sure Elementor is installed and active.

**Manually**

1. Copy the `elementor-custom-meta-image-dynamic-tag` folder into `wp-content/plugins/`.
2. Activate it from *Plugins*.

## Usage

1. Edit a page, post, or template with Elementor.
2. Drop in an **Image** widget.
3. Click the dynamic tags icon next to the *Choose Image* control.
4. Pick **Custom Meta Image** under the **MaxSoft Custom Fields** group.
5. Type the exact meta key, for example `property_image`.

The widget then resolves that key against the current post on every render.

## Troubleshooting

If nothing shows up, check in this order:

1. Elementor is active.
2. The meta key is spelled exactly as it is stored (keys are case-sensitive).
3. The current post actually has a value for that key.
4. The value is an image attachment ID or an image URL, not a filename or a serialized blob.
5. You are previewing the right post context. Inside a template, use Elementor's preview
   settings to point at a real post.

## Changelog

### 1.0.0

- Initial release.
- Elementor dynamic image tag for custom post meta image fields.
- Support for attachment IDs, image URLs, and simple array values.

## Author

[MaxSoft Technologies](https://maxsofttechnologies.com)

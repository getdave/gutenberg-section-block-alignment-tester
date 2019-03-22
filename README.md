# Gutenberg Section Block Alignment Tester Plugin

This is a simple Plugin designed to automatically generated all the various permutations of the Section Block its alignment and that of those of its child Blocks which support alignment.

It works by dynamically creating a Block Editor Page Template for all _new_ Pages consisting of the necessary Blocks. 

## Quick Start

* In your WP install's `wp-config.php` file define a new constant `GUTENBERG_SB_ALIGNMENT_TESTER_IMAGE_URL` and set this to a url of a publically accessible image file (tip: the simplest way to do this is to upload an image to your Media Library and grab the resulting url).

```
// inside wp-config.php
define( 'GUTENBERG_SB_ALIGNMENT_TESTER_IMAGE_URL', 'http://localhost:8888/wp-content/uploads/YYYY/MM/some-image-here.jpg');
```

* Download/clone Plugin and add Plugin to your `plugins/` directory.
* Activate the Plugin
* Add a _new_ `Page` - you should see the Blocks automatically added to your Page.

To generate a fresh test simply add a new `Page`.


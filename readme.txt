=== Tomatillo Design Style Salvage 2025 ===
Contributors: tomatillodesign
Tags: styles, css, stylesheet, restore, fix, wordpress-6.9, compatibility
Requires at least: 5.0
Tested up to: 6.9
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Restores and replaces lost stylesheets that broke in WordPress 6.9. Attempts to re-enqueue original stylesheets with fallback to replacement CSS.

== Description ==

WordPress 6.9 introduced changes that broke compatibility with some older plugins and themes, particularly affecting stylesheet loading. This plugin provides a solution to restore missing stylesheets and inject replacement CSS when needed.

**Features:**

* Automatically attempts to re-enqueue broken or missing stylesheets
* Provides fallback replacement CSS for styles that fail to load
* Works on both frontend and block editor (Gutenberg)
* Easy configuration through a simple array in the plugin file
* Automatic updates from GitHub - get updates directly through WordPress admin
* Lightweight and performant

**Use Cases:**

* Restore stylesheets from old plugins that stopped working in WordPress 6.9
* Patch missing CSS from themes or plugins
* Ensure critical styles load in both frontend and block editor
* Maintain visual consistency after WordPress updates

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/tomatillo-style-salvage` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Configure the stylesheets you want to restore by editing the `tdss_get_stylesheets_to_restore()` function in `style-salvage.php`.
4. Add any replacement CSS to `assets/css/style-salvage.css`.

== Frequently Asked Questions ==

= Does this plugin work with WordPress 6.9? =

Yes, this plugin was specifically created to address compatibility issues introduced in WordPress 6.9.

= Will this slow down my site? =

No, the plugin is lightweight and only loads when needed. It uses WordPress's standard enqueue system.

= Can I use this in the block editor? =

Yes, the plugin automatically loads styles in both the frontend and the block editor.

= How do I add stylesheets to restore? =

Edit the `tdss_get_stylesheets_to_restore()` function in `style-salvage.php` and add your stylesheet configuration to the array.

== Screenshots ==

1. Plugin configuration example showing how to add stylesheets to restore.

== Changelog ==

= 1.0.0 =
* Initial release
* Restore missing stylesheets functionality
* Fallback CSS replacement system
* Frontend and block editor support
* Includes clb-icon-cards plugin styles

== Upgrade Notice ==

= 1.0.0 =
Initial release of the plugin.


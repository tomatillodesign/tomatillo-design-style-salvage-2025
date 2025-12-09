=== Tomatillo Design Style Salvage 2025 ===
Contributors: tomatillodesign
Tags: styles, css, stylesheet, restore, fix, wordpress-6.9, compatibility
Requires at least: 5.0
Tested up to: 6.9
Stable tag: 1.0.6
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

**Method 1: Download from GitHub**
1. Download the latest release from GitHub
2. Extract to `/wp-content/plugins/` (no need to rename - works with or without `-main` suffix)
3. Activate the plugin through the 'Plugins' screen in WordPress

**Method 2: Direct Installation**
1. Clone or download the repository
2. Place it in `/wp-content/plugins/`
3. Activate the plugin through the 'Plugins' screen in WordPress

**Configuration:**
1. Configure the stylesheets you want to restore by editing the `tdss_get_stylesheets_to_restore()` function in `style-salvage.php`.
2. Add any replacement CSS to `assets/css/style-salvage.css`.

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

= 1.0.5 =
* Test release to verify auto-update functionality

= 1.0.4 =
* Added folder name preservation during updates
* Prevents plugin deactivation when updating from any folder name
* Ensures downloaded updates maintain current folder structure
* Critical fix for maintaining plugin activation after updates

= 1.0.3 =
* Auto-detects plugin folder name for seamless updates
* Now works perfectly regardless of folder name (with or without -main suffix)
* Simplified update logic - no manual configuration needed
* Improved compatibility with different installation methods

= 1.0.2 =
* Fixed plugin slug to match repository name for proper updates
* Added filter to handle GitHub folder naming (-main suffix)
* Improved installation instructions in documentation
* Better handling of folder name mismatches during updates

= 1.0.1 =
* Added GitHub auto-update functionality
* Plugin now updates automatically from GitHub repository
* Integrated Plugin Update Checker library
* Added .gitignore for better repository management
* Updated documentation with auto-update feature

= 1.0.0 =
* Initial release
* Restore missing stylesheets functionality
* Fallback CSS replacement system
* Frontend and block editor support
* Includes clb-icon-cards plugin styles

== Upgrade Notice ==

= 1.0.3 =
Auto-detects folder name. Updates now work flawlessly regardless of how you installed the plugin.

= 1.0.2 =
Important fix for auto-update functionality. Ensures proper folder naming for consistent updates.

= 1.0.1 =
Added GitHub auto-update functionality. Plugin now checks for updates automatically from the GitHub repository.

= 1.0.0 =
Initial release of the plugin.


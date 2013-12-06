=== HTML Sitemap Generator ===
Contributors: donalmacarthur
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=53RPL36YFD9P2
Tags: sitemap, html sitemap, sitemap page
Requires at least: 3.0
Tested up to: 3.1.2
Stable tag: 1.5

Add a customizable HTML sitemap to any page on your site.

== Description ==

Visitors love sitemaps - and so do search engines. This plugin generates a customizable sitemap which you can add to any page on your site using a simple shortcode.

**Features**

* Simple point-and-click setup from your WordPress dashboard.
* Lets you optionally include feeds, authors, pages, categories, tags, archives, and posts.
* Displays your posts organized by category.
* Lets you exclude individual pages, categories, tags, and posts. You can also exclude whole categories from the post listing.
* Integrated caching to speed up page load times.

**Instructions**

You'll find the plugin's settings page under the Settings tab on your WordPress dashboard. Select the elements you want to include in your sitemap, save your settings, then simply add the `[sitemap]` shortcode to the page where you want the sitemap to appear.

**Formatting**

By default the sitemap is completely unstyled, so it will inherit the styling of your current theme. As an example, here's how it looks on [my own site](http://cranesandskyhooks.com/sitemap/). The sitemap is made up of a simple mixture of standard headings and lists, so most themes should display it perfectly well by default. 

If you're not happy with how your theme is displaying the output, however, the sitemap itself and all its individual elements have wrapper classes assigned, so you can customize its formatting with a little CSS. You can find tips on styling the sitemap output on [the plugin's homepage](http://cranesandskyhooks.com/wordpress-plugins/html-sitemap-generator/).

== Installation ==

1. Install the plugin in the usual way - preferably through the WordPress automatic plugin installer.
1. Activate the plugin from the 'Plugins' menu on your dashboard.
1. Navigate to `Settings > HTML Sitemap` and and choose your customization options.
1. Add the `[sitemap]` shortcode to the page where you want the sitemap to appear.

== Screenshots ==

1. You can enable or disable individual elements from the plugin's settings page.
2. The sitemap inherits your theme's default styles. Here's how it looks on my own site.

== Changelog ==

= 1.5 =
* Bugfix to ensure nested categories in the posts listing display properly.

= 1.4 =
* Update 1.3 didn't upload to the repository properly. This is a reupload with the version number bumped to ensure users are offered the opportunity to update.

= 1.3 =
* Bugfix for memory issues.

= 1.2 =
* Added integrated caching to speed up page load times on sites with large, complex sitemaps.
* Implemented full hierarchical nesting of subcategories in the posts list. (You may need to tweak your styles to suit the new heading structure.)
* Added a new 'html-sitemap' class to the sitemap div. The old 'sitemap' class remains but should be considered deprecated; it will be removed in a future release.

= 1.1 =
* Lots of new options added to the dashboard interface.
* All backend functionality upgraded to the new DMAC plugin framework to ensure compatibility with future plugin releases.
* Removed a rogue 'echo' statement from the shortcode function. This didn't show up in any of the themes tested, but may have caused display issues for some users.

= 1.0 =
* Initial Release.

== Upgrade Notice ==

= 1.1 =
New options have been added to the plugin's interface. Please visit the plugin's settings page after upgrading and click the 'Save Settings' button. This will write default settings for the new options to your database and ensure your sitemap displays properly.
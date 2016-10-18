ITPMeta Changelog
==========================

###v4.5
* Added support [EShop](http://joomdonation.com/joomla-extensions/eshop-joomla-shopping-cart.html).
* Added option Auto-update Period to the **plugin System - ITPMeta Tags**. Use that option to set a period in which the system will not check for changes in meta tags.

###v4.4
* Fixed a compatibility issue between extension and Prism library v1.10.

###v4.3
* Added functionality to create tags for VirtueMart.
* Added Twitter tag __twitter:player:stream:content_type__
* Added option to extract first image from item content (description) and use it as og:image.

###v4.2
* Fixed bug in the plugin System - ItpMeta.

###v4.1
* Fixed some issues.

###v4.0
* Improved code quality.
* The library was rewritten.

###v3.11
* Added new tags
  * books:gender
  * books:official_site
  * books:canonical_name
  * game:secret
* Fixed several bugs.

###v3.10
* Fixed the tag editor.
* Removed dependencies from MooTools.
* Added functionality to generate tags for CrowdFunding categories.

###v3.9
* Added some new tags.
* Added statistical information on the dashboard.
* Added functionality to plugin "ITPMeta - Tags" to generate Dublin Core tags.
* Added support for extension CrowdFunding, SocialCommunity, User Ideas and ITP Donate. The plugin ITPMeta Tags generates meta tags for those extensions.
* Fixed some issues.
* Improved.

###v3.8
* It was copied all tags from Pro release to Lite one.
* The functionality that adding urls automatically was moved from the plugin to another one.
* Language files were moved to the component folder.
* Added option to select default image.
* Added option to enable and disable generating tags for extensions.
* Improved collecting data from K2 (com_k2).
* Improved collecting data from Cobalt.
* Added option for generating meta description from article text, if metadesc missing.
* Added new tags
    * Dublin Core tags.
    * OpenGraph Product
* Some tags sections were updated with new tags.
    * Article
    * Book
    * Locale
    * Business
    * Places ( now is Place )
    * Misc
* Fixed some issues.

###v3.7.2

* Fix an issue with overriding Google Alternate tag.

###v3.7.1

* Added Google Alternate (rel=alternate) meta tag.

###v3.7

* Merged Tags Manager with URL form
* Added tags og:video:url, twitter:image:src
* Fixed some issues

###v3.6

* Added Google Author and Publisher meta tags.
* Added a new way of collecting URLs. Now they are two - Strict and Full.
* Added filter by "Auto Update" state.
* Fixed filter by State
* Added Tags Manager
* Changed interface for managing Tags.
* Improved usability

###v3.5

* Added K2 tags generator
* Improved plugins "System - ITPMeta" and "System - ITPMeta - Tags"
* Improved

###v3.4

* Moved options from component to plugins
* Added option "autoupdate" to urls. Now, you are able to disable updating for URLs.
* Improved auto adding urls. Now, invalid URLs will not be added.

###v3.3

* Added ordering to tags.
* Added publishing functionality to tags.
* Added new state for URLs - suspicious.
* Now works with enabled magic quotes.
* Added site verification tags for Alexa and Bing
* Improved content plugin - added tags "Article Author", "Article Published Time", "Article Modified Time". Now it collects information about categories and creates tags.
* The content plugin was removed. Now the plugin "System - ITPMeta - Tags" is used for generating tags for Joomla! Content (com_content).
* Improved

###v3.2

* Added Open Graph Music tags
* Added Plugin that generates tags for extension Content (com_content)
* Improved

###v3.1

* Added a functionality that collect links automatically.
* Added a functionality that generate canonical URL automatically.
* Added new OpenGraph tags
 * Facebook restrictions tags
 * article tags
 * book tags
 * music tags
 * profile tags
 * new image tags
 * new video tags
* Added options using to setup the loading of namespace schemes
* Improved

###v3.0

* Ported to Joomla! 2.5
* Added global tags
* Added a new video tag - og:secure_url
* Added a locale tags - og:locale, og:locale:alternate
* Improved

###v2.2

* Added Open Graph URL tag
* Improved

###v2.1

* Fixed a bug in the plugin

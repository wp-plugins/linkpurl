=== LinkPURL Header ===
Tags: linkpurl, purl, persistent identifier, auto-discovery
Contributors: mjgiarlo, decasm, anarchivist
Stable tag: trunk

Inserts a <link> tag into each WordPress post and page that enables LinkPURL auto-discovery, as described on the LinkPURL website: http://staff.oclc.org/~smithde/linkpurl/.  Enables bookmarking of persistent URLs if present in the link tag's href attribute, where the rel attribute has a value of "purl".  Note that this plugin may be used for auto-discovery of any persistent identifer scheme as long as the identifier is a URI, rather than being limited to purl-style identifiers.

There is a Firefox extension that makes use of LinkPURL which is linked from the URL above.

== Downloading ==

1. Grab the zip file from http://downloads.wordpress.org/plugin/linkpurl.zip
2. Check out from svn: svn co http://svn.wp-plugins.org/linkpurl/trunk linkpurl

== Installation ==

1. Upload the linkpurl folder containing all source files to your plug-ins folder, usually `wp-content/plugins/`
2. Login as an administrator and activate the plug-in via the Plugins menu
3. Enter the persistent URL you have created for your blog via the LinkPURL submenu of the Options menu.  
4. Voila!  Your blog may now have its persistent URL bookmarked.

== Frequently Asked Questions ==

= Er? =

Hit me at leftwing at alumni period rutgers period edu

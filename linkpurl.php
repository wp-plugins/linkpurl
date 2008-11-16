<?php

/*
Plugin Name: LinkPURL
Plugin URI: http://www.lackoftalent.org/michael/blog/persistent-url-bookmarker/
Description: Inserts a <link> tag into each WordPress post and page that enables LinkPURL auto-discovery, as described on the LinkPURL website: http://staff.oclc.org/~smithde/linkpurl/.  Enables bookmarking of persistent URLs if present in the link tag's href attribute, where the rel attribute has a value of "purl".  Note that this plugin may be used for auto-discovery of any persistent identifer scheme as long as the identifier is a URI, rather than being limited to purl-style identifiers.
Version: 1.1
Author: Michael J. Giarlo
Author URI: http://purl.org/net/leftwing/blog
Contributor: Mark Matienzo
Contributor URI: http://matienzo.org/

LinkPURL Header for Wordpress
Copyright (C) 2007  Michael J. Giarlo

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

HISTORY:
Version: 0.1, 2007-01-17 [Michael J. Giarlo]
Version: 1.0, 2007-12-15 "
Version: 1.1, 2008-11-16 [Mark Matienzo and Michael J. Giarlo]
*/

add_action('wp_head', 'linkpurl_link');
add_action('admin_menu', 'linkpurl_admin_menu');
add_option('linkpurl_pid', 'http://change.this.now', 'A persistent identifier for your blog.  In order for partial redirects to work, omit the final slash character.');
add_option('linkpurl_partialRedirect', 'off', 'Set to on to use PURL partial redirects');

function linkpurl_link() {
	echo "	<!-- LinkPURL -->\n";
	$partial = ('on' == get_option('linkpurl_partialRedirect')) ? $_SERVER["REQUEST_URI"] : '';
        echo '  <link rel="purl" href="' . get_option('linkpurl_pid') . $partial . '"/>' . "\n";
}

function linkpurl_admin_menu() {
	if ( function_exists('add_options_page') ) {
		add_options_page('LinkPURL Configuration', 'LinkPURL', 9, __FILE__, 'linkpurl_manage');
	}
}

function linkpurl_manage() {
	if ( isset($_POST['linkpurl_pid']) || isset($_POST['linkpurl_partialRedirect']) ) {
		update_option('linkpurl_pid', $_POST['linkpurl_pid']);
		update_option('linkpurl_partialRedirect', $_POST['linkpurl_partialRedirect']);
		echo '<div class="updated"><p><strong>Options saved.</strong></p></div>';
	}
	$pid = get_option('linkpurl_pid');
	$checked = ('on' == get_option('linkpurl_partialRedirect')) ? ' checked="checked" ' : '';
	echo '<div class="wrap"> ' .
		'<h2>LinkPURL Options</h2>' .
		'<form name="form1" method="post" action="' . $_SERVER['REQUEST_URI'] . '">' .
		'<fieldset class="options"><legend>Enter your persistent identifier</legend><br/>' .
		'<input type="text" size="75" name="linkpurl_pid" value="' . $pid . '"/>' .
		'<br/><br/><input id="lpr" type="checkbox" name="linkpurl_partialRedirect" ' . $checked . '/> ' .
		'<label for="lpr">Enable <a href="http://purl.oclc.org/docs/inet96.html#partial" target="_blank">Partial Redirect</a></label>' .
		'</fieldset>' .
		'<p class="submit">' .
		'<input type="submit" name="Submit" value="Update Options &raquo;" />' .
		'</p>' .
		'</form>' .
		'</div>';
}
?>

<?php

/*
Plugin Name: LinkPURL
Plugin URI: http://www.lackoftalent.org/michael/blog/unapi-wordpress-plug-in/
Description: Implements unAPI 1.0 specification, providing machine-readable metadata records for posts and pages.  Hat tip: <a href="http://www.wallandbinkley.com/quaedam/" target="_blank">Peter Binkley</a> for writing the first unAPI plug-in, on which subsequent versions have been heavily based.
Version: 0.1
Author: Michael J. Giarlo
Author URI: http://purl.org/net/leftwing/blog

unAPI Server for Wordpress
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
*/

add_action('wp_head', 'linkpurl_link');
add_action('admin_menu', 'linkpurl_admin_menu');
add_option('linkpurl_pid', 'http://change.this.now/', 'A persistent identifier for your blog');

function linkpurl_link() {
	echo "	<!-- LinkPURL -->\n";
	echo '	<link rel="purl" href="' . get_option('linkpurl_pid') . '"/>' . "\n";
}

function linkpurl_admin_menu() {
	if ( function_exists('add_options_page') ) {
		add_options_page('LinkPURL Configuration', 'LinkPURL', 9, __FILE__, 'linkpurl_manage');
	}
}

function linkpurl_manage() {
	if ( isset($_POST['linkpurl_pid']) ) {
		update_option('linkpurl_pid', $_POST['linkpurl_pid']);
		echo '<div class="updated"><p><strong>Options saved.</strong></p></div>';
	}
	$pid = get_option('linkpurl_pid');
	echo '<div class="wrap"> ' .
		'<h2>LinkPURL Options</h2>' .
		'<form name="form1" method="post" action="' . $_SERVER['REQUEST_URI'] . '">' .
		'<fieldset class="options"><legend>Enter your persistent identifier</legend><br/>' .
		'<input type="text" size="75" name="linkpurl_pid" value="' . $pid . '"/>' .
		'</fieldset>' .
		'<p class="submit">' .
		'<input type="submit" name="Submit" value="Update Options &raquo;" />' .
		'</p>' .
		'</form>' .
		'</div>';
}
?>
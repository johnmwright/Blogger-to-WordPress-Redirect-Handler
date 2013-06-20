<?php
/*
Plugin Name: Blogger Redirect Handler
Plugin URI: 
Description: Receives redirects from a blogger blog, and looks up the corresponding post by meta key.  Default to check for "blogger_permalink" as the meta key.
Version: 1.0
Author: Matthew Richmond
Author URI: http://matthewgrichmond.com
*/

class mgr_Blogger_Redirect_Handler {
	// Which variable are we looking for -- coming from blogger?
	var $get_var = 'blogger_redirect';
	
	/**
	 * Adds the various actions
	 */
	function __construct() {
		$this->blogger_meta = apply_filters('blogger_permalink');
		
		if (!empty($_GET[$this->get_var]) && !headers_sent()) {
			add_action('init', array($this, 'possible_redirect'), 1);
		}
	}
	
	/**
	 * Does the lookup to see if we have a post or page with that post meta
	 */
	function possible_redirect() {
		// Clean our request
		$search_link = strip_tags(stripslashes($_GET[$this->get_var]));
		
		// Look for our post
		$posts = get_posts(array(
			'meta_key' => apply_filters('blogger_meta_key', 'blogger_permalink', $this),
			'meta_value' => $search_link,
			'numberposts' => 1,
		));
		
		if (!empty($posts)) {
			$post = array_shift($posts);
			wp_redirect(get_permalink($post->ID), 301);
			exit;
		}
		
		// no page found, so see if it's a page instead
		$pages = get_pages(array(
			'meta_key' => apply_filters('blogger_meta_key', 'blogger_permalink', $this),
			'meta_value' => $search_link,
			'number' => 1,
		));
				
		if (!empty($pages)) {
			$page = array_shift($pages);
			wp_redirect(get_permalink($page->ID), 301);
			exit;
		}
	}
}
new mgr_Blogger_Redirect_Handler;
?>
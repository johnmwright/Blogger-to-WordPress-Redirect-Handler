# Blogger Redirect Handler

## Description

When migrating from Blogger to WordPress, the importer creates a `blogger_permalink` meta key for each post and page.  This plugin catches $_GET query parameters and does a lookup for a post/page with the matching postmeta, then redirects to it.

## Installation

1. Import blogger posts from Blogger to WordPress using the [Blogger Importer](http://wordpress.org/extend/plugins/blogger-importer/)
2. Install this WordPress plugin in typical plugins folder, then activate
3. Modify Blogger template to redirect to your WordPress blog, using JavaScript snippet below (change "example.com" to your domain).  [Screenshot](https://skitch.com/bigdawggi/8k8k2/blogger-redirect)
	
	<script type='text/javascript'>
		var blogRoot=&quot;http://example.com/&quot;;
		var Redir = (document.location.pathname == &#39;/&#39;) ? blogRoot : blogRoot + &quot;?blogger_redirect=&quot;+document.location.pathname.toLowerCase();
			
		document.location.href = Redir;
	</script>
	


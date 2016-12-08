<?php
function marla_add_to_author_profile( $contactmethods ) {
	$contactmethods['rss_url'] = 'RSS URL';
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
	$contactmethods['youtube_profile'] = 'YouTube Profile URL';
	$contactmethods['pinterest_profile'] = 'Pinterest Profile URL';
	$contactmethods['vimeo_profile'] = 'Vimeo Profile URL';
	$contactmethods['flickr_profile'] = 'Flickr Profile URL';
	$contactmethods['instagram_profile'] = 'Instagram Profile URL';
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'marla_add_to_author_profile', 10, 1); ?>
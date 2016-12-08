<div class="author-bio clearfix">
<div class="author-info fleft">
<h3 class="author-title"><?php _e( 'Author: ', 'marla' );  the_author_link(); ?></h3>
<p class="author-description"><?php the_author_meta('description'); ?><?php if ( get_the_author_meta('user_url') ) { ?><span>
Web: <a href="<?php the_author_meta('user_url');?>"><?php the_author_meta('user_url');?></a></span><?php } ?></p>
</div>
<div class="fright avatar-icons">
			<?php echo get_avatar( get_the_author_meta('email'), '150' ); ?>
            <ul class="icons clear">
					<?php
						$rss_url = get_the_author_meta( 'rss_url' );
						if ( $rss_url && $rss_url != '' ) {
							echo '
<li class="rss"><a title="rss" href="' . esc_url($rss_url) . '"></a></li>
';
						}
						$google_profile = get_the_author_meta( 'google_profile' );
						if ( $google_profile && $google_profile != '' ) {
							echo '
<li class="google"><a title="Google" href="' . esc_url($google_profile) . '?rel=author"></a></li>
';
						}
						$twitter_profile = get_the_author_meta( 'twitter_profile' );
						if ( $twitter_profile && $twitter_profile != '' ) {
							echo '
<li class="twitter"><a title="twitter" href="' . esc_url($twitter_profile) . '"></a></li>
';
						}
						$facebook_profile = get_the_author_meta( 'facebook_profile' );
						if ( $facebook_profile && $facebook_profile != '' ) {
							echo '
<li class="facebook"><a title="facebook" href="' . esc_url($facebook_profile) . '"></a></li>
';
						}
						$linkedin_profile = get_the_author_meta( 'linkedin_profile' );
						if ( $linkedin_profile && $linkedin_profile != '' ) {
							echo '
<li class="linkedin"><a title="linkedin" href="' . esc_url($linkedin_profile) . '"></a></li>
';
						}
						$youtube_profile = get_the_author_meta( 'youtube_profile' );
						if ( $youtube_profile && $youtube_profile != '' ) {
							echo '
<li class="youtube"><a title="yotube" href="' . esc_url($youtube_profile) . '"></a></li>
';
						}
						$pinterest_profile = get_the_author_meta( 'pinterest_profile' );
						if ( $pinterest_profile && $pinterest_profile != '' ) {
							echo '
<li class="pinterest"><a title="pinterest" href="' . esc_url($pinterest_profile) . '"></a></li>
';
						}
						$vimeo_profile = get_the_author_meta( 'vimeo_profile' );
						if ( $vimeo_profile && $vimeo_profile != '' ) {
							echo '
<li class="vimeo"><a title="vimeo" href="' . esc_url($vimeo_profile) . '"></a></li>
';
						}
						$instagram_profile = get_the_author_meta( 'instagram_profile' );
						if ( $instagram_profile && $instagram_profile != '' ) {
							echo '
<li class="instagram"><a title="instagram" href="' . esc_url($instagram_profile) . '"></a></li>
';
						}
					?>
				</ul></div>
</div>
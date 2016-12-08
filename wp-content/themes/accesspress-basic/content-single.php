<?php
/**
 * @package Accesspress Basic
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
    	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    
  	<!--<div class="entry-meta">-->
    		<!--<?php accesspress_basic_posted_on(); ?>-->
    <!--	</div>   .entry-meta -->
    </header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>

<p class="disclaimer">
	<span style="color:#800000;"><strong><a href="contribute-to-icf" target="_blank"><span style="color:#0033cc;">Donate </a>to the Indian Writers' Forum, a public trust that belongs to all of us.</strong></span>
</p>		

<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'accesspress-basic' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

<div class="social-icons--fixed">
<div class="share-icons">
        



    <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" target="_blank" rel="noopener noreferrer">
        <img src="/wp-content/uploads/2016/08/facebook.png">
    </a>
    <a class="twitter" href="https://www.twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink() ?>" target="_blank" rel="noopener noreferrer">
        <img src="/wp-content/uploads/2016/08/twitter.png">
    </a>
    <a class="mail" href="mailto:?subject=<?php the_title(); ?>&body=Indian Cultural Forum - <?php the_permalink() ?>" >
        <img src="/wp-content/uploads/2016/08/mail.png">
    </a>
</div>
</div>    

	<footer class="entry-footer">
		<?php accesspress_basic_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

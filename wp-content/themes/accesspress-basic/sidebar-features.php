<?php
/**
 * The sidebar containing the Feature Section.
 *
 * @package Accesspress Basic
 */

if ( ! is_active_sidebar( 'apbasic_featured_section' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'apbasic_featured_section' ); ?>
</div><!-- #secondary -->

<?php $tags = wp_get_post_tags($post->ID);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
$args=array(
'tag__in' => $tag_ids,
'post__not_in' => array($post->ID),
'showposts'=>3,  
'ignore_sticky_posts'=>1
);
$my_query = new wp_query($args);
if( $my_query->have_posts() ) {
echo '<div id="slider-tags" class="clearfix"><h2 class="widget-title">'. __( 'Related posts ', 'marla' ).'</h2><div class="slider"><ul>';
while ($my_query->have_posts()) {
$my_query->the_post();
?>
 
<?php
if ( has_post_thumbnail() ) { ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('full-width'); ?><span><?php the_title(); ?></span></a></li>
<?php } else { ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php }
?>
 
<?php
}
echo '</ul></div></div>';
}
}
wp_reset_query();?>
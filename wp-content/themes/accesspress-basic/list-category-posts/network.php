<?php

/* This is the string which will gather all the information.*/
$lcp_display_output = '';

// Show category link:
$lcp_display_output .= $this->get_category_link('strong');

//Add 'starting' tag. Here, I'm using an unordered list (ul) as an example:
$lcp_display_output .= '<ul class="lcp_catlist_network">';

/**
 * POSTS LOOP
 *
 * The code here will be executed for every post in the category.
 * As you can see, the different options are being called from functions on the
 * $this variable which is a CatListDisplayer.
 *
 * The CatListDisplayer has a function for each field we want to show.
 * So you'll see get_excerpt, get_thumbnail, etc.
 * You can now pass an html tag as a parameter. This tag will sorround the info
 * you want to display. You can also assign a specific CSS class to each field.
 */
foreach ($this->catlist->get_categories_posts() as $single){
  //Start a List Item for each post:
  $lcp_display_output .= "<li>";

  //Show the title and link to the post:
  $lcp_display_output .= $this->get_post_title($single, 'h4', 'lcp_post');

  //Show comments:
  $lcp_display_output .= $this->get_comments($single);

  //Show date:
  $lcp_display_output .= ' ' . $this->get_date($single);

  //Show date modified:
  $lcp_display_output .= ' ' . $this->get_modified_date($single);

  //Show author
  $lcp_display_output .= $this->get_author($single);

  //Custom fields:
  $lcp_display_output .= $this->get_custom_fields($single);

  //Post Thumbnail
  $lcp_display_output .= $this->get_thumbnail($single);

  /**
   * Post content - Example of how to use tag and class parameters:
   * This will produce:<p class="lcp_content">The content</p>
   */
  $lcp_display_output .= $this->get_content($single, 'p', 'lcp_content');

  /**
   * Post content - Example of how to use tag and class parameters:
   * This will produce:<div class="lcp_excerpt">The content</div>
   */
  $lcp_display_output .= $this->get_excerpt($single, 'div', 'lcp_excerpt');


  // Get Posts "More" link:
  $lcp_display_output .= $this->get_posts_morelink($single);

  //Close li tag
  $lcp_display_output .= '</li>';
}

// Close the wrapper I opened at the beginning:
$lcp_display_output .= '</ul>';

// If there's a "more link", show it:
$lcp_display_output .= $this->catlist->get_morelink();

//Pagination
$lcp_display_output .= $this->get_pagination();

$this->lcp_output = $lcp_display_output;

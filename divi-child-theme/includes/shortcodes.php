<?php

/* pull event_type taxonomy */
add_shortcode('al_event_type', 'al_event_type_taxonomy');
function al_event_type_taxonomy()
{
  global $post;
  $terms = get_the_terms($post->ID, 'event_type');
  foreach ($terms as $term) {
    $term_link = get_term_link($term, 'event_type');
    return '<a href="' . $term_link . '">' . $term->name . '</a>';
  }
}


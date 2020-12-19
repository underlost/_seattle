<?php
// Fetch the post value, else the default value
function get_post_val($key, $default = '') {
  if (isset($_POST[$key]) and !empty($_POST[$key])) {
    return $_POST[$key];
  } else {
    return $default;
  }
}
// Pretty prints an object.
function pretty_print($obj) {
  echo '<pre>';
  print_r($obj);
  echo '</pre>';
}

// Add button class to next/previous post links
add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');
function post_link_attributes($output) {
  $injection = 'class="btn btn-primary btn-block"';
  return str_replace('<a href=', '<a ' . $injection . ' href=', $output);
}

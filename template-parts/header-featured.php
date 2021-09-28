<?php
/**
 * Template part for displaying featured pages or categories.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seattle
 */

$menu_name = 'menu-3';
if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items($menu->term_id);
	$menu_list = '<div class="row justify-content-lg-end align-items-lg-end">';
	foreach ( (array) $menu_items as $key => $menu_item ) {
    $title = $menu_item->title;
    $slug = sanitize_title($title);
		$url = $menu_item->url;
    //print_r($menu_item->object);
    
    if ($menu_item->object == 'category') {
      $term = get_term($menu_item->object_id);
      $image_field = get_field('image', $term);
      $image = $image_field['url'];
    } else {
      $thumbnail_id = get_post_thumbnail_id($menu_item->object_id);
      $image = wp_get_attachment_image_url($thumbnail_id, 'medium');
    }

    if (!empty($image)) {
      $data_bg = 'data-bg="' . $image . '"';
      $image_classes = 'bg-dark bg-cover fsr-lazy';
    } else {
      $data_bg = null;
      $image_classes = 'bg-secondary';
    }

    $menu_list .= '<div class="col-4 col-md-3 col-lg-1 align-self-end pt-2">';
    $menu_list .= '<a class="d-block d-block-square w-100 nav-link nav-link-featured '. $image_classes .' '.$slug.'" href="'.$url. '" '. $data_bg . ' data-bs-toggle="tooltip" data-bs-placement="left" title="' . $title . '">';
    $menu_list .= '<p class="sub-menu-title visually-hidden">'.$title.'</p>';
    $menu_list .= '</a></div>' ."\n";

	}
  $menu_list .= '</div>';
  echo $menu_list;

} ?>
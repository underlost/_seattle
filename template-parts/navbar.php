<?php
/**
 * Navbar
 *
 * @package Seattle
 */
$site_logo = get_option('site_logo');
$post_tags = get_the_tags();
$categories = get_categories(array(
  'orderby' => 'name',
  'order' => 'ASC',
  'hide_empty' => false,
));
?>

<nav class="navbar navbar-expand-lg navbar-dark px-3">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <form id='search_form' class="form-inline my-2 my-lg-0 order-1 order-md-2" action="<?php echo get_site_url(); ?>" method="get" role="search">
    <input type="hidden" id="search_post_type" name="post_type" />
    <input type="text" id="search_query" name="s" class="search-input form-control" placeholder="Search"/>
  </form>
  <div class="collapse navbar-collapse order-2 order-md-1" id="navbarSupportedContent">
    <?php wp_nav_menu(array(
      'menu' => 'primary',
      'theme_location' => 'primary',
      'depth' => 4,
      'menu_class' => 'navbar-nav mr-auto',
      'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
      'walker' => new wp_bootstrap_navwalker(),
    )); ?>
    
  </div>
  
</nav>

<?php
/**
 * Navbar
 *
 * @package Seattle
 */
$site_logo = get_option('site_logo');
$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC',
    'hide_empty' => false,
) );

?>

<nav class="navbar navbar-expand-lg navbar-dark site-header navbar-filter mb-3">
  <a class="navbar-brand" href="<?php echo home_url(); ?>">
    <?php if ($site_logo) { ?>
    <img src="<?php echo get_option('site_logo'); ?>" height="36" alt="<?php bloginfo( 'name' ); ?>" />
    <?php } else { ?>
    <img src="<?php echo get_template_directory_uri() . '/inc/svg/logo.svg' ?>" width="36" height="36" alt="<?php bloginfo( 'name' ); ?>">
    <?php }?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="<?php echo home_url(); ?>">Home</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="CategoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="CategoryDropdown">
          <?php
          foreach( $categories as $category ) {
              $category_link = sprintf(
                  '<a class="dropdown-item" href="%1$s" alt="%2$s">%3$s</a>',
                  esc_url( get_category_link( $category->term_id ) ),
                  esc_attr( sprintf( __( 'View all posts in %s', 'seattle' ), $category->name ) ),
                  esc_html( $category->name )
              );
              echo $category_link;
          } ?>
        </div>
      </li>
      <?php $post_tags = get_the_tags();
        if ($post_tags) {
          echo '<li class="nav-item dropdown">';
          echo '<a class="nav-link dropdown-toggle" href="#" id="TagDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tags</a>';
          echo '<div class="dropdown-menu" aria-labelledby="TagDropdown">';
          foreach($post_tags as $tag) {
            echo '<a href="/?tag=' . $tag->slug . '" class="dropdown-item">' . $tag->name . '</a>';
          }
          echo '</div>';
          echo '</li>';
        }
      ?>
    </ul>
    <form id='search_form' class="form-inline my-2 my-lg-0" action="<?php echo get_site_url(); ?>" method="get" role="search">
      <input type="hidden" id="search_post_type" name="post_type" />
      <input type="text" id="search_query" name="s" class="search-input form-control" placeholder="Search"/>
    </form>
  </div>
</nav>

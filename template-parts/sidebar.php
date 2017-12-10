<input type="checkbox" class="sidebar-checkbox" id="sidebar-checkbox">

<nav class="page-sidebar">
  <div class="sidebar-header">
    <label for="sidebar-checkbox" class="sidebar-toggle"></label>
    <div class="sidebar-header-controls">
      <button type="button" class="btn btn-link visible-lg-inline float-right" data-toggle-pin="sidebar"><i class="fa fs-12"></i></button>

      <header id="masthead" class="site-header">
        <div class="site-branding">
          <?php
          the_custom_logo();
          if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php else : ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
          <?php
          endif;

          $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
          <?php
          endif; ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation">
          <?php
            wp_nav_menu( array(
              'theme_location' => 'primary',
              'menu_id'        => 'primary-menu',
            ) );
          ?>
        </nav><!-- #site-navigation -->
      </header><!-- #masthead -->

    </div>
  </div>
  <div class="sidebar-body">
    <div class="widget-content">
      <?php get_sidebar(); ?>
    </div>
  </div>
</nav>

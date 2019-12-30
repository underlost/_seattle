<div id="page-sidebar" class="mobileMenu text-right" role="navigation">>
  <div class="sidebar-header">
    <div class="sidebar-header-controls">
      <button type="button" class="btn btn-link visible-lg-inline float-right" data-toggle-pin="sidebar"><i class="fa fs-12"></i></button>

      <div class="sidebar-site-header">
        <div class="site-branding">
          <?php
          $description = get_bloginfo('description', 'display');
          if ($description || is_customize_preview()): ?>
            <p class="site-description"><?php echo $description;
            /* WPCS: xss ok. */
            ?></p>
          <?php endif;
          ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation">
          <?php wp_nav_menu(array(
            'theme_location' => 'sidebar',
            'menu_id' => 'sidebar-menu',
          )); ?>
        </nav><!-- #site-navigation -->
      </div><!-- #masthead -->

    </div>
  </div>
  <div class="sidebar-body">
    <div class="widget-content">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>

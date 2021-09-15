<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Seattle
 */

$facebook = get_option('social_facebook');
$twitter = get_option('social_twitter');
$instagram = get_option('social_instagram');
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer container py-4 mb-4 px-2 px-md-5">
  <div class="site-info">
    <div class="row">
      <div class="col-md-6">

        <div class="social-icons">
          <ul class="list-inline">
            <?php if ($facebook) { ?>
              <li class="list-inline-item"><a href="<?php echo $facebook; ?>" title="Facebook">
                  <span class="fa-stack fa-lg">
                    <i class="fab fa-facebook fa-stack-1x"></i>
                  </span>
                </a></li>
            <?php } ?>
            <?php if ($twitter) { ?>
              <li class="list-inline-item"><a href="<?php echo $twitter; ?>" title="Twitter">
                  <span class="fa-stack fa-lg">
                    <i class="fab fa-twitter fa-stack-1x"></i>
                  </span>
                </a></li>
            <?php } ?>
            <?php if ($instagram) { ?>
              <li class="list-inline-item"><a href="<?php echo $instagram; ?>" title="Instagram">
                  <span class="fa-stack fa-lg">
                    <i class="fab fa-instagram fa-stack-1x"></i>
                  </span>
                </a></li>
            <?php } ?>
          </ul>
        </div>

        <div class="navbar navbar-expand-lg" id="navbarFooterContent">
          <?php wp_nav_menu(array(
            'menu' => 'menu-2',
            'theme_location' => 'menu-2',
            'depth' => 4,
            'menu_class' => 'navbar-nav mr-auto',
            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
            'walker' => new wp_bootstrap_navwalker(),
          )); ?>
        </div>


      </div>
      <div class="col-md-6">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="pb-2 text-center">
          <span class="d-block py-2">&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?></span>
          <p><?php printf(esc_html__('%1$s theme by %2$s.', 'seattle'), 'WordPress', '<a href="https://tyler.codes">Tyler Rilling</a>'); ?></p>
        </div>
      </div>
    </div>
  </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- .page-container-inner -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
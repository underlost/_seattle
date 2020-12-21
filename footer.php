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
		<div class="site-info row">
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
        <span class="d-block py-2">&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?></span>
        <div class="pb-2">
          <a href="<?php echo esc_url(__('https://wordpress.org/', 'seattle')); ?>"><?php printf(esc_html__('Powered by %s. ', 'seattle'), 'WordPress'); ?></a> <?php printf(esc_html__('%1$s theme by %2$s.', 'seattle'), '_Seattle', '<a href="https://tyler.codes">Tyler Rilling</a>'); ?>
        </div>
      </div>
      <div class="col-md-6">
      </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- .page-container-inner -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

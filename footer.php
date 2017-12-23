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
 $twitter =  get_option('social_twitter');
 $google = get_option('social_google');
 $instagram = get_option('social_instagram');
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer py-4 mb-2">
		<div class="site-info text-center">
      <div class="social-icons">
        <ul class="list-inline">
          <?php if ($facebook) { ?>
            <li><a href="<?php echo $facebook; ?>" title="Facebook">
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-facebook fa-stack-1x"></i>
              </span>
            </a></li>
          <?php } ?>
          <?php if ($twitter) { ?>
            <li><a href="<?php echo $twitter; ?>" title="Twitter">
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-twitter fa-stack-1x"></i>
              </span>
            </a></li>
          <?php } ?>
          <?php if ($google) { ?>
            <li><a href="<?php echo $google; ?>" title="Google Plus">
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-google-plus fa-stack-1x"></i>
              </span>
            </a></li>
          <?php } ?>
          <?php if ($instagram) { ?>
            <li><a href="<?php echo $instagram; ?>" title="Instagram">
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-instagram fa-stack-1x"></i>
              </span>
            </a></li>
          <?php } ?>
        </ul>
      </div>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'seattle' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Powered by %s. ', 'seattle' ), 'WordPress' );
			?></a>
			<span class="sep sr-only"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( '%1$s theme by %2$s.', 'seattle' ), 'Seattle', '<a href="https://underlost.net">Tyler Rilling</a>' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- .page-container-inner -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

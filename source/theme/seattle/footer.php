<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Seattle
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="layout-single-column">
		<?php get_sidebar(); ?>
		</div>

		<nav role="navigation" class="site-navigation main-navigation layout-single-column">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- .site-navigation .main-navigation -->

		<div class="site-info layout-single-column">
			<p>&copy; Copyright 2014 <?php bloginfo( 'name' ); ?>. All Rights Reserved. <br />
				Powered by WordPress. <a href="tyler.codes/seattle/">Seattle</a> theme by <a href="http://underlost.net/">Tyler</a>.</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Seattle
 */

?>
	</div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
    	<div class="container">
    		<div class="footer-bottom">
    			<nav class="footer-navigation" role="navigation">
    				<?php wp_nav_menu( array(
    					'theme_location' => 'footer',
    					'depth'          => 1,
    					'fallback_cb'    => false
    				) );?>
    			</nav><!-- .footer-navigation -->

    			<div class="footer-tagline">
    				<div class="site-info">
    					<?php echo seattle_filter_footer_text(); ?>
    				</div>
    			</div><!-- .footer-tagline -->
    		</div>
    	</div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

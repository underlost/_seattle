	<footer id="colophon" class="site-footer" role="contentinfo">
	
		<nav role="navigation" class="site-navigation main-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- .site-navigation .main-navigation -->
		
		<div class="site-info">
			<?php do_action( 'seattle_credits' ); ?>
			<p>&copy; 2012 Tyler Rilling. All Rights Reserved.</p>
		</div><!-- .site-info -->
		
	</footer><!-- #colophon .site-footer -->
	</section><!-- #main .site-main -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>
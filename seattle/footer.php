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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.colorbox-min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.masonry.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/hello.js" type="text/javascript"></script>


</body>
</html>
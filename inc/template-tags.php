<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Seattle
 */

if ( ! function_exists( 'seattle_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function seattle_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><span class="last-updated">Last Updated: <time class="updated" datetime="%3$s">%4$s</time></span>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'seattle' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'seattle' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'seattle_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function seattle_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'seattle' ) );
		if ( $categories_list && seattle_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'seattle' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'seattle' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'seattle' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'seattle' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'seattle' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function seattle_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'seattle_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'seattle_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so seattle_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so seattle_categorized_blog should return false.
		return false;
	}
}

function seattle_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'nav-links post-navigation container';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h2 class="sr-only"><?php _e( 'Post navigation', 'seattle' ); ?></h2>
		<div class="nav-links-inner">

	<?php if ( is_single() ) : // navigation links for single posts ?>
		<div class="row">
		<?php previous_post_link( '<div class="nav-previous col-md-6">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'seattle' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next col-md-6">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'seattle' ) . '</span>' ); ?>
		</div>
	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous col-md-6"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'seattle' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next col-md-6"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'seattle' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>
		</div>
	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}

function seattle_paging_nav( $query = false ) {

	global $wp_query;
	if( $query ) {
		$temp_query = $wp_query;
		$wp_query = $query;
	}

	// Return early if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	} ?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'seattle' ); ?></h1>

		<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous">
				<span class="meta-nav">
					<?php next_posts_link( esc_html__( 'Older Posts', 'seattle' ) ); ?>
				</span>
			</div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next">
				<span class="meta-nav">
					<?php previous_posts_link( esc_html__( 'Newer Posts', 'seattle' ) ); ?>
				</span>
			</div>
		<?php endif; ?>

	</nav><!-- .navigation -->
	<?php
	if( isset( $temp_query ) ) {
		$wp_query = $temp_query;
	}
}

/**
 * Display the author description on author archive
 */
function the_author_archive_description( $before = '', $after = '' ) {
	$author_description  = get_the_author_meta( 'description' );
	if ( ! empty( $author_description ) ) {
		echo $author_description;
	}
}

/**
 * Site title and logo
 */
function seattle_title_logo() { ?>
	<div class="site-title-wrap">
		<!-- Use the Site Logo feature, if supported -->
		<?php if ( function_exists( 'jetpack_the_site_logo' ) && jetpack_the_site_logo() ) {

			if ( is_front_page() && is_home() ) {
				printf( '<h1 class="site-logo">%s</h1>', jetpack_the_site_logo() );
 			} else {
 				printf( '<p class="site-logo">%s</p>', jetpack_the_site_logo() );
 			}

		} else {
			// Use the standard Customizer logo
			$logo = get_theme_mod( 'seattle_customizer_logo' );
			if ( ! empty( $logo ) ) {

				if ( is_front_page() && is_home() ) { ?>
					<h1 class="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
					</h1>
	 			<?php } else { ?>
					<p class="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
					</p>
	 			<?php }
			}
		} ?>

		<div class="titles-wrap">
			<?php if ( is_front_page() && is_home() ) { ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
 			<?php } else { ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
 			<?php } ?>

			<?php if ( get_bloginfo( 'description' ) ) { ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php } ?>
		</div>
	</div><!-- .site-title-wrap -->
<?php }


/**
 * Custom comment output
 */
function seattle_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID() ?>">

	<div class="comment-block" id="comment-<?php comment_ID(); ?>">

		<?php echo get_avatar( $comment->comment_author_email, 75 ); ?>

		<div class="comment-wrap">
			<div class="comment-info">
				<cite class="comment-cite">
				    <?php comment_author_link() ?>
				</cite>

				<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( esc_html__( '%1$s at %2$s', 'seattle' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( esc_html__( '(Edit)', 'seattle' ), '&nbsp;&nbsp;', '' ); ?>
			</div>

			<div class="comment-content">
				<?php comment_text() ?>
				<p class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
				</p>
			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'seattle' ) ?></em>
			<?php endif; ?>
		</div>
	</div>
<?php
}

function seattle_layout_class() {
	$layout_class = get_option( 'seattle_customizer_gallery_style', 'col-md-6 col-sm-6 col-xs-12' );
	return $layout_class;
}

/**
 * Flush out the transients used in seattle_categorized_blog.
 */
function seattle_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'seattle_categories' );
}
add_action( 'edit_category', 'seattle_category_transient_flusher' );
add_action( 'save_post',     'seattle_category_transient_flusher' );

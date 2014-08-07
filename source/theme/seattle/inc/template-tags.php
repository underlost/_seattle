<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Seattle
 */

if ( ! function_exists( 'seattle_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function seattle_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'seattle' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'seattle' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'seattle' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'seattle_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function seattle_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'seattle' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="glyphicon glyphicon-chevron-left"></span> <span class="hover-only">%title</span>', 'Previous post link', 'seattle' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '<span class="hover-only">%title</span> <span class="glyphicon glyphicon-chevron-right"></span>', 'Next post link',     'seattle' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'seattle_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function seattle_posted_on() {
	$time_string = '<i class="glyphicon glyphicon-time"></i> <time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated sr-only" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'seattle' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'seattle' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline sr-only"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'seattle_comments_link' ) ) :

function seattle_comments_link() {

	$leavecomment = __( '<i class="glyphicon glyphicon-comment"></i> No comments', 'seattle' );
	$onecomment = __( '<i class="glyphicon glyphicon-comment"></i> 1 Comment', 'seattle' );
	$morecomments = __( '<i class="glyphicon glyphicon-comment"></i> % Comments', 'seattle' );
	$commentsoff = __( '<i class="glyphicon glyphicon-comment"></i> Comments Disabled', 'seattle' );

	// echo comments_popup_link( __( 'No comments', 'seattle' ), __( '1 Comment', 'seattle' ), __( '% Comments', 'seattle' ) );

	echo comments_popup_link($leavecomment, $onecomment,$morecomments, 'comments-link', $commentsoff ) ;

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

/**
 * Flush out the transients used in seattle_categorized_blog.
 */
function seattle_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'seattle_categories' );
}
add_action( 'edit_category', 'seattle_category_transient_flusher' );
add_action( 'save_post',     'seattle_category_transient_flusher' );

if (!function_exists(' clearcontent_comment_template ')) :
		/*
		* Echo a custom comment template aligned and styled with bootstrap 3.02
		* The big problem here is, that there is no way in wordpress 3.7.1 to supply
		* specific parameters to certain class attributes within the comment template.
		* There are just no filters for it. (Such as for the form element class attribute).
		*
		* But in order to stlye forms with bootstrap 3.02 I do need this access.
		*
		* Approach: Just copy comment_form() function from
		* http://core.trac.wordpress.org/browser/tags/3.7.1/src/wp-includes/comment-template.php#L1509
		* and modify it to our liking. Thats definitely not nice, but how else?
		*
		*/

		/**
		* Output a complete commenting form for use within a template.
		*
		* Most strings and form fields may be controlled through the $args array passed
		* into the function, while you may also choose to use the comment_form_default_fields
		* filter to modify the array of default fields if you'd just like to add a new
		* one or remove a single field. All fields are also individually passed through
		* a filter of the form comment_form_field_$name where $name is the key used
		* in the array of fields.
		*
		* @since 3.0.0
		*
		* @param array       $args {
		*     Optional. Default arguments and form fields to override.
		*
		*     @type array 'fields' {
		*         Default comment fields, filterable by default via the 'comment_form_default_fields' hook.
		*
		*         @type string 'author' The comment author field HTML.
		*         @type string 'email'  The comment author email field HTML.
		*         @type string 'url'    The comment author URL field HTML.
		*     }
		*     @type string 'comment_field'        The comment textarea field HTML.
		*     @type string 'must_log_in'          HTML element for a 'must be logged in to comment' message.
		*     @type string 'logged_in_as'         HTML element for a 'logged in as <user>' message.
		*     @type string 'comment_notes_before' HTML element for a message displayed before the comment form.
		*                                         Default 'Your email address will not be published.'.
		*     @type string 'comment_notes_after'  HTML element for a message displayed after the comment form.
		*                                         Default 'You may use these HTML tags and attributes ...'.
		*     @type string 'id_form'              The comment form element id attribute. Default 'commentform'.
		*     @type string 'id_submit'            The comment submit element id attribute. Default 'submit'.
		*     @type string 'title_reply'          The translatable 'reply' button label. Default 'Leave a Reply'.
		*     @type string 'title_reply_to'       The translatable 'reply-to' button label. Default 'Leave a Reply to %s',
		*                                         where %s is the author of the comment being replied to.
		*     @type string 'cancel_reply_link'    The translatable 'cancel reply' button label. Default 'Cancel reply'.
		*     @type string 'label_submit'         The translatable 'submit' button label. Default 'Post a comment'.
		*     @type string 'format'               The comment form format. Default 'xhtml'. Accepts 'xhtml', 'html5'.
		* }
		* @param int|WP_Post $post_id Optional. Post ID or WP_Post object to generate the form for. Default current post.
		*/
		function seattle_comment_form($args = array(), $post_id = null) {
			if (null === $post_id)
				$post_id = get_the_ID();
			else
				$id = $post_id;

			$commenter = wp_get_current_commenter();
			$user = wp_get_current_user();
			$user_identity = $user->exists() ? $user->display_name : '';

			$args = wp_parse_args($args);
			if (!isset($args['format']))
				$args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';

			$req = get_option('require_name_email');
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$html5 = 'html5' === $args['format'];
			$fields = array(
				'author' => '<div class="form-group"><label for="author" class="control-label comment-form-author">' . __('Name') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div>',
				'email' => '<div class="form-group"><label for="email" class="control-label comment-form-email">' . __('Email') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="email" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div>',
				'url' => '<div class="form-group"><label for="url" class="control-label comment-form-url">' . __('Website') . '</label> ' .
				'<input id="url" class="form-control" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div>',
			);

			$required_text = sprintf(' ' . __('Required fields are marked %s'), '<span class="required">*</span>');

			/**
			* Filter the default comment form fields.
			*
			* @since 3.0.0
			*
			* @param array $fields The default comment fields.
			*/
			$fields = apply_filters('comment_form_default_fields', $fields);
			$defaults = array(
				'fields' => $fields,
				'comment_field' => '<div class="form-group"><label for="comment" class="control-label">' . _x('Comment', 'noun') . '</label><textarea id="comment" class="form-control" name="comment" cols="45" rows="7" aria-required="true"></textarea></div>',
				'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
				'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
				'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.') . ( $req ? $required_text : '' ) . '</p>',
				'comment_notes_after' => '<p class="form-allowed-tags">' . sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s'), ' <pre><code>' . allowed_tags() . '</code></pre>') . '</p>',
				'id_form' => 'commentform',
				'id_submit' => 'submit',
				'title_reply' => __('Leave a Reply'),
				'title_reply_to' => __('Leave a Reply to %s'),
				'cancel_reply_link' => __('Cancel reply'),
				'label_submit' => __('Post Comment'),
				'format' => 'xhtml',
			);

			/**
			* Filter the comment form default arguments.
			*
			* Use 'comment_form_default_fields' to filter the comment fields.
			*
			* @since 3.0.0
			*
			* @param array $defaults The default comment form arguments.
			*/
			$args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));
			?>
			<?php if (comments_open($post_id)) : ?>
				<?php
				/**
				* Fires before the comment form.
				*
				* @since 3.0.0
				*/
				do_action('comment_form_before');
				?>
				<div id="respond" class="comment-respond">
					<h3 id="reply-title" class="comment-reply-title"><?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?> <small><?php cancel_comment_reply_link($args['cancel_reply_link']); ?></small></h3>
					<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
						<?php echo $args['must_log_in']; ?>
						<?php
						/**
						* Fires after the HTML-formatted 'must log in after' message in the comment form.
						*
						* @since 3.0.0
						*/
						do_action('comment_form_must_log_in_after');
						?>
						<?php else : ?>
						<form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>" class="comment-form" role="form" <?php echo $html5 ? ' novalidate' : ''; ?>>
							<?php
							/**
							* Fires at the top of the comment form, inside the <form> tag.
							*
							* @since 3.0.0
							*/
							do_action('comment_form_top');
							?>
							<?php if (is_user_logged_in()) : ?>
								<?php
								/**
								* Filter the 'logged in' message for the comment form for display.
								*
								* @since 3.0.0
								*
								* @param string $args['logged_in_as'] The logged-in-as HTML-formatted message.
								* @param array  $commenter            An array containing the comment author's username, email, and URL.
								* @param string $user_identity        If the commenter is a registered user, the display name, blank otherwise.
								*/
								echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity);
								?>
								<?php
								/**
								* Fires after the is_user_logged_in() check in the comment form.
								*
								* @since 3.0.0
								*
								* @param array  $commenter     An array containing the comment author's username, email, and URL.
								* @param string $user_identity If the commenter is a registered user, the display name, blank otherwise.
								*/
								do_action('comment_form_logged_in_after', $commenter, $user_identity);
								?>
							<?php else : ?>
								<?php echo $args['comment_notes_before']; ?>
								<?php
								/**
								* Fires before the comment fields in the comment form.
								*
								* @since 3.0.0
								*/
								do_action('comment_form_before_fields');
								foreach ((array) $args['fields'] as $name => $field) {
									/**
									* Filter a comment form field for display.
									*
									* The dynamic portion of the filter hook, $name, refers to the name
									* of the comment form field. Such as 'author', 'email', or 'url'.
									*
									* @since 3.0.0
									*
									* @param string $field The HTML-formatted output of the comment form field.
									*/
									echo apply_filters("comment_form_field_{$name}", $field) . "\n";
								}
								/**
								* Fires after the comment fields in the comment form.
								*
								* @since 3.0.0
								*/
								do_action('comment_form_after_fields');
								?>
							<?php endif; ?>
							<?php
							/**
							* Filter the content of the comment textarea field for display.
							*
							* @since 3.0.0
							*
							* @param string $args['comment_field'] The content of the comment textarea field.
							*/
							echo apply_filters('comment_form_field_comment', $args['comment_field']);
							?>
				<?php echo $args['comment_notes_after']; ?>
							<div class="form-group">
									<p class="form-submit">
										<input name="submit" type="submit" class="btn btn-default" id="<?php echo esc_attr($args['id_submit']); ?>" value="<?php echo esc_attr($args['label_submit']); ?>" />
				<?php comment_id_fields($post_id); ?>
									</p>
							</div>
							<?php
							/**
							* Fires at the bottom of the comment form, inside the closing </form> tag.
							*
							* @since 1.5.2
							*
							* @param int $post_id The post ID.
							*/
							do_action('comment_form', $post_id);
							?>
						</form>
				<?php endif; ?>
				</div><!-- #respond -->
				<?php
				/**
				* Fires after the comment form.
				*
				* @since 3.0.0
				*/
				do_action('comment_form_after');
			else :
				/**
				* Fires after the comment form if comments are closed.
				*
				* @since 3.0.0
				*/
				do_action('comment_form_comments_closed');
			endif;
		}

	endif;

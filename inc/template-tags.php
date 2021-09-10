<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Seattle
 */

if (!function_exists('_seattle_meta')) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function _seattle_meta($ID = '')
	{
		if (empty($ID)) {
			$ID = get_the_ID();
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U', $ID) !== get_the_modified_time('U', $ID)) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated sr-only" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date('c', $ID)),
			esc_html(get_the_date('', $ID)),
			esc_attr(get_the_modified_date('c', $ID)),
			esc_html(get_the_modified_date('', $ID))
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('%s', 'post date', 'seattle'),
			'<span class="datetime">' . $time_string . '</span>'
		);
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('%s', 'post author', 'seattle'),
			'<span class="author vcard">' . esc_html(get_the_author($ID)) . '</span>'
		);
		echo '<span class="posted-on d-block mb-2"><span class="posted-on-text d-block h6 text-secondary mb-1 fw-bold text-uppercase">Published</span>' . $posted_on . '</span>';
		echo '<span class="byline d-block mb-3 sr-only"><span class="byline-txext d-block h6 text-secondary mb-0">Written by</span> ' . $byline . '</span>';
	}
endif;

if (!function_exists('seattle_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function seattle_posted_on($ID = '')
	{
		if (empty($ID)) {
			$ID = get_the_ID();
		}
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U', $ID) !== get_the_modified_time('U', $ID)) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated sr-only" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date('c', $ID)),
			esc_html(get_the_date('', $ID)),
			esc_attr(get_the_modified_date('c', $ID)),
			esc_html(get_the_modified_date('', $ID))
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('%s', 'post date', 'seattle'),
			'<span class="datetime">' . $time_string . '</span>'
		);
		echo '<span class="posted-on"><span class="posted-on-text">Published </span>' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if (!function_exists('seattle_author')) :
	/**
	 * Prints HTML with meta information for the current post author.
	 */
	function seattle_author($ID = '')
	{

		if (empty($ID)) {
			$ID = get_the_ID();
		}

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s', 'post author', 'seattle'),
			'<span class="author vcard">' . esc_html(get_the_author($ID)) . '</span>'
		);
		echo '<span class="byline h6"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if (!function_exists('seattle_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function seattle_entry_footer()
	{

		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'seattle'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="cat-links">' . esc_html__('Posted in: %1$s', 'seattle') . '</span>', $categories_list); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'seattle'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">' . esc_html__('Tagged with: %1$s', 'seattle') . '</span>', $tags_list); // WPCS: XSS OK.
			}
		}

		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="sr-only"> on %s</span>', 'seattle'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="sr-only">%s</span>', 'seattle'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if (!function_exists('_seattle_pagination')) :
	/**
	 * Displays pagination
	 */
	function _seattle_pagination()
	{
		if (is_singular()) {
			return;
		}

		global $wp_query;

		/** Stop execution if there's only 1 page */
		if ($wp_query->max_num_pages <= 1) {
			return;
		}

		$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
		$max = intval($wp_query->max_num_pages);

		/** Add current page to the array */
		if ($paged >= 1) {
			$links[] = $paged;
		}

		/** Add the pages around the current page to the array */
		if ($paged >= 3) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ($paged + 2 <= $max) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<nav class="navigation text-center py-5 mb-lg-5" aria-label="Page Navigation"><ul class="pagination justify-content-center">' .
			"\n";

		/** Previous Post Link */
		if (get_previous_posts_link()) {
			printf(
				'<li class="page-item previous-page">%s</li>' . "\n",
				get_previous_posts_link('Previous')
			);
		}

		/** Link to first page, plus ellipses if necessary */
		if (!in_array(1, $links)) {
			$class = 1 == $paged ? 'active' : '';

			printf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>' .
					"\n",
				$class,
				esc_url(get_pagenum_link(1)),
				'1'
			);

			if (!in_array(2, $links)) {
				echo '<li class="page-item"><span class="page-link">…</span></li>';
			}
		}

		/** Link to current page, plus 2 pages in either direction if necessary */
		sort($links);
		foreach ((array) $links as $link) {
			$class = $paged == $link ? 'active' : '';
			printf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>' .
					"\n",
				$class,
				esc_url(get_pagenum_link($link)),
				$link
			);
		}

		/** Link to last page, plus ellipses if necessary */
		if (!in_array($max, $links)) {
			if (!in_array($max - 1, $links)) {
				echo '<li class="page-item"><span class="page-link">…</span></li>' .
					"\n";
			}

			$class = $paged == $max ? 'active' : '';
			printf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>' .
					"\n",
				$class,
				esc_url(get_pagenum_link($max)),
				$max
			);
		}

		/** Next Post Link */
		if (get_next_posts_link()) {
			printf(
				'<li class="page-item next-page">%s</li>' . "\n",
				get_next_posts_link('Next')
			);
		}

		echo '</ul></nav>' . "\n";
	}
endif;

if (!function_exists('_seattle_grid_item')) :
	/**
	 * Displays a grid item.
	 */
	function _seattle_grid_item($ID, $is_fixed_width = true)
	{

		$format = get_post_format($ID);
		$square_thumbnail = true;
		$thumbnail_arr = wp_get_attachment_image_src(get_post_thumbnail_id($ID), 'large');
		$thumbnail_url = !empty($thumbnail_arr[0]) ? $thumbnail_arr[0] : '';
		$url = get_the_permalink($ID);
		$sizeWidth = get_post_meta($ID, 'display-img-size', true);
		$sizeHeight = get_post_meta($ID, 'display-img-height', true);
		$location = get_post_meta($ID, 'location', true);
		$nsfw = get_post_meta($ID, 'nsfw', true);
		$lightboxEndabled = get_post_meta($ID, 'lightbox', true);
		$image_min_height = $thumbnail_arr[1];
		$image_min_width = $thumbnail_arr[2];
		//print_r($thumbnail_arr);

		if (empty($sizeWidth)) {
			$sizeWidth = 'col-md-4';
		}
		if (empty($sizeHeight)) {
			$sizeHeight = 'd-block-square';
		}

		$has_image_class = 'no-image';
		if (!empty($thumbnail_url)) : $has_image_class = 'has-image';
		endif;

		if ($is_fixed_width == true) {
			$sizeWidth = 'col-md-4';
			$sizeHeight = 'grid-md d-block-square';
		}

		if (!empty($nsfw)) {
			$nsfwClass = 'grid-item-nsfw';
		} else {
			$nsfwClass = null;
		}
		$classes = array($sizeWidth, $sizeHeight, $nsfwClass, $has_image_class, 'grid-item', 'grid-item-clickable');

		$lightbox = null;
		$element = 'article';

		if ($format == 'aside') {
			$element = 'aside';
			$lightbox = 'data-featherlight="' . $thumbnail_url . '"';
		}
		if (!empty($lightboxEndabled)) {
			$lightbox = 'data-featherlight="' . $thumbnail_url . '"';
		}
?>

		<<?php echo $element . ' id="post-' . $ID; ?>" <?php post_class($classes); ?>>
			<a href="<?php echo $url; ?>" rel="bookmark" <?php echo $lightbox; ?> class="post-inner d-flex align-items-center h-100">
				<?php if (!empty($nsfw)) { ?>
					<div class="badge-group">
						<span class="badge text-dark bg-secondary">NSFW</span>
					</div>
				<?php } ?>
				<div class="image-wrapper">
					<img class="image-cover-overlay" src="<?php echo get_template_directory_uri() . '/dist/images/1x1.png'; ?>" />
					<img class="fsr-lazy" alt="<?php echo get_the_title($ID); ?>" data-src="<?php echo $thumbnail_url; ?>" src="<?php echo get_template_directory_uri() . '/dist/images/1x1.png'; ?>" />
				</div>
				<header class="entry-header text-center">
					<h2 class="entry-title h4 px-lg-5"><?php echo get_the_title($ID); ?></h2>
					<?php
					if ('post' === get_post_type()) : ?>
						<div class="entry-meta">
							<span class="sr-only"><?php seattle_posted_on($ID); ?></span>
							<?php if (!empty($location)) { ?>
								<span class="location"><span class="sr-only">In: </span><?php echo $location; ?></span>
							<?php } ?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
				</header><!-- .entry-header -->
			</a>
		</<?php echo $element . '><!-- #post-' . $ID ?> -->
	<?php
	}
endif;

if (!function_exists('_seattle_post_navigation')) :
	/**
	 * Displays previous/next cards
	 */
	function _seattle_post_navigation()
	{
	?>

		<h3 class="text-white pt-4 h4">View More</h3>
		<div class="row pb-4">
			<div class="col-lg-12">
				<div class="row">
					<?php
					$prev_post = get_previous_post();
					$next_post = get_next_post();

					if (!empty($prev_post)) :
						_seattle_grid_item($prev_post->ID);
					endif;

					if (!empty($next_post)) :
						_seattle_grid_item($next_post->ID);
					endif;
					?>
				</div>
			</div>
		</div>
<?php
	}
endif;

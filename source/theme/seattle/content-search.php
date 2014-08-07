<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seattle
 */
?>

<?php if ( has_post_thumbnail() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'seattle-large');
echo ' style="background-image: url(' . $large_image_url[0] . ')"'; ?>>
<?php else : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php endif; ?>
	<div class="article-wrap">

	<?php $format = get_post_format(); get_template_part( 'format', $format ); ?>

	</div>
</article><!-- #post-## -->

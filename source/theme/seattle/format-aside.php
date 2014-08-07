<?php
/**
 * @package Seattle
 */
?>

<?php if ( has_post_thumbnail() ) { ?>
    <div class="photo photo-featured layout-single-column">
    <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'seattle-large');
    echo '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute('echo=0') . '" >'; ?>
    <figure><?php the_post_thumbnail('large');?></figure>
    <?php echo '</a>'; ?> </div>
<?php } ?>

    <header class="entry-header layout-single-column">
        <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
    </header><!-- .entry-header -->

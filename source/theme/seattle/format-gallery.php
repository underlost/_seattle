<?php
/**
 * @package Seattle
 */
?>

<header class="entry-header layout-single-column">
    <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
</header><!-- .entry-header -->

<div class="thumbs layout-single-column">

    <?php if ( has_post_thumbnail() ) { ?>
        <div class="thumb thumb-featured">
        <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'seattle-large');
        echo '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute('echo=0') . '" >'; ?>
        <figure><?php the_post_thumbnail('large');?></figure>
        <?php echo '</a>'; ?> </div>
    <?php } ?>

    <?php
    $thumb_ID = get_post_thumbnail_id( $post->ID );
    $attachments = get_children(array(
        'post_type' => 'attachment',
        'numberposts' => -1,
        'exclude' => $thumb_ID,
        'post_parent' => $post->ID,
        'post_status' => 'inherit',
        'post_mime_type' => 'image',
        'order' => 'ASC',
        'orderby' => 'menu_order ID'));

    foreach($attachments as $att_id => $attachment) {
        $full_img_url = wp_get_attachment_url($attachment->ID);
            $split_pos = strpos($full_img_url, 'wp-content');
            $split_len = (strlen($full_img_url) - $split_pos);
            $abs_img_url = substr($full_img_url, $split_pos, $split_len);
            $full_info = @getimagesize(ABSPATH.$abs_img_url);
            ?>
            <div class="thumb">
                <a href="<?php echo $full_img_url; ?>" title="<?php echo $attachment->post_title; ?>" target="_blank">
                <?php $portimg = wp_get_attachment_image( $attachment->ID, 'medium' );
                echo preg_replace('#(width|height)="\d+"#','',$portimg); ?> </a>
            </div>
    <?php } ?>
</div>

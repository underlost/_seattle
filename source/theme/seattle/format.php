<?php
/**
 * @package Seattle
 */
?>


    <header class="entry-header layout-single-column">
        <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
    </header><!-- .entry-header -->

    <?php if ( is_search() ) : // Only display Excerpts for Search ?>
    <div class="entry-summary layout-single-column">

        <div class="entry-excerpt">
            <?php the_excerpt(); ?>
        </div>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content layout-single-column">
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'seattle' ) ); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'seattle' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer layout-single-column">
        <?php if ( 'post' == get_post_type() ) : ?>
        <div class="entry-meta">
            <span class="borders">
                <?php seattle_posted_on(); ?>
                <?php seattle_comments_link(); ?>
            </span>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </footer>

    <?php endif; ?>

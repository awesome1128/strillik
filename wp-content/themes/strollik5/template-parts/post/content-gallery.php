<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-inner row">
        <div class="col-md-3 col-sm-4">
            <div class="entry-meta">
                <?php echo get_avatar( get_the_author_meta( 'email' ), 90 ) ?>
                <div class="entry-date">
                    <?php strollik5_posted_on(); ?>
                </div>
                <div class="entry-category">
                    <?php esc_html_e('in', 'strollik5'); the_category(); ?>
                </div>
                <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                    <div class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'strollik5' ), esc_html__( '1 Comment', 'strollik5' ), esc_html__( '% Comments', 'strollik5' ) ); ?></div>
                <?php endif; ?>
            </div><!-- .entry-meta -->
        </div>
        <div class="col-md-9 col-sm-8">
            <?php

            // If not a single post, highlight the gallery.
            if (get_post_gallery()) {
                echo '<div class="entry-gallery">';
                echo get_post_gallery();
                echo '</div>';
            };
            ?>
            <?php if ('' !== get_the_post_thumbnail() && !get_post_gallery()) : ?>
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'strollik5-featured-image-full' ); ?>
                    </a>
                </div><!-- .post-thumbnail -->
            <?php endif; ?>
            <header class="entry-header">
                <?php
                if (is_single()) {
                    the_title( '<h1 class="entry-title">', '</h1>' );
                } elseif (is_front_page() && is_home()) {
                    the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                } else {
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                }
                ?>
            </header><!-- .entry-header -->

            <div class="entry-content">

                <?php
                if (is_single() || !get_post_gallery()) {

                    /* translators: %s: Name of current post */
                    the_content( sprintf(
                        __( 'Read more<span class="screen-reader-text"> "%s"</span>', 'strollik5' ),
                        get_the_title()
                    ) );

                    wp_link_pages( array(
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'strollik5' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ) );

                };
                ?>

            </div><!-- .entry-content -->

            <?php
            if (is_single()) {
                strollik5_entry_footer();
                strollik5_social_share();
            }
            ?>
        </div>

    </div>
</article><!-- #post-## -->

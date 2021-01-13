<?php
get_header(); ?>
    <header class="page-header search-page-header">
        <h1 class="page-title"><?php printf(__('Search Results for: %s', 'strollik5'), '<span>' . get_search_query() . '</span>'); ?></h1>
    </header><!-- .page-header -->
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">

                <?php
                if (have_posts()) :
                    /* Start the Loop */
                    while (have_posts()) : the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('template-parts/post/content', 'excerpt');

                    endwhile; // End of the loop.

                    the_posts_pagination( array(
                        'prev_text'          => '<span class="opal-icon-arrow-left"></span><span class="screen-reader-text">' . esc_html__( 'Previous', 'strollik5' ) . '</span>',
                        'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next', 'strollik5' ) . '</span><span class="opal-icon-arrow-right"></span>',
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'strollik5' ) . ' </span>',
                    ) );

                else : ?>

                    <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'strollik5'); ?></p>
                <?php
                endif;
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div><!-- .wrap -->

<?php get_footer();

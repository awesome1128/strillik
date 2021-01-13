<?php
get_header(); ?>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <section class="error-404 not-found">
                    <div class="page-content">
                        <div class="row">
                            <div class="col-12 error-404-content text-center">

                                <h1 class="error-404-bkg"><?php esc_html_e( '404', 'strollik5' ); ?></h1>
                                <h2 class="error-title p-0 m-0"><?php esc_html_e( 'Not Found', 'strollik5' ); ?></h2>
                                <div class="error-content">
                                    <div class="error-text">
                                        <span><?php esc_html_e( "It looks like nothing was found at this location. Maybe try a search?", 'strollik5' ) ?></span>
                                    </div>
                                    <div class="error-btn-bh">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="return-home"><?php esc_html_e( 'Return to homepage', 'strollik5' ); ?></a>

                                        <a href="javascript: history.go(-1)" class="go-back"><?php esc_html_e( 'Go back to previous page', 'strollik5' ); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->
<?php get_footer();

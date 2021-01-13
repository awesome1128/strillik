<div class="site-header">
    <?php
    if (strollik5_is_header_builder()) {
        strollik5_the_header_builder();
    } else {
        $container = get_theme_mod('osf_header_width', true) ? 'container' : 'container-fluid';
        ?>
        <div id="opal-header-content" class="header-content osf-sticky-active">
            <div class="custom-header <?php echo esc_attr($container) ?>">
                <div class="header-main-content d-flex flex-wrap align-items-center justify-content-between <?php echo get_theme_mod('osf_header_layout_is_sticky', false) ? ' opal-element-sticky' : ''; ?>">
                    <?php get_template_part('template-parts/header/site', 'branding'); ?>

                    <?php if (has_nav_menu('top')) : ?>
                        <div class="navigation-top text-center">
                            <?php get_template_part('template-parts/header/navigation'); ?>
                        </div><!-- .navigation-top -->
                    <?php endif; ?>

                    <div class="header-group">
                        <div class="header-search">
                            <a class="opal-icon-search search-button" aria-hidden="true" data-search-toggle="toggle"
                               data-target="#header-search-form"></a>
                            <div id="#header-search-form">
                                <?php get_search_form(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <?php
    }
    ?>
</div>

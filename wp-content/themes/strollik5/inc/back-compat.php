<?php
/**
 * Prevent switching to Strollik5 on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Strollik5 1.0
 */
function strollik5_switch_theme() {
    switch_theme( WP_DEFAULT_THEME );
    unset( $_GET['activated'] );
    add_action( 'admin_notices', 'strollik5_upgrade_notice' );
}

add_action( 'after_switch_theme', 'strollik5_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Strollik5 on WordPress versions prior to 4.7.
 *
 * @since Strollik5 1.0
 *
 * @global string $wp_version WordPress version.
 */
function strollik5_upgrade_notice() {
    $message = sprintf( esc_html__( 'Strollik5 requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'strollik5' ), $GLOBALS['wp_version'] );
    printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Strollik5 1.0
 *
 * @global string $wp_version WordPress version.
 */
function strollik5_customize() {
    wp_die( sprintf( esc_html__( 'Strollik5 requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'strollik5' ), $GLOBALS['wp_version'] ), '', array(
        'back_link' => true,
    ) );
}

add_action( 'load-customize.php', 'strollik5_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Strollik5 1.0
 *
 * @global string $wp_version WordPress version.
 */
function strollik5_preview() {
    if (isset( $_GET['preview'] )) {
        wp_die( sprintf( esc_html__( 'Strollik5 requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'strollik5' ), $GLOBALS['wp_version'] ) );
    }
}

add_action( 'template_redirect', 'strollik5_preview' );

<?php
/**
 * @package  strollik5-core
 * @category Plugins
 * @author   WpOpal
 * Plugin Name: Strollik5 Core
 * Plugin URI: http://www.wpopal.com/
 * Version: 1.2.0
 * Description: Implement rich functions for themes base on WpOpal. Wordpress framework and load widgets for theme
 * used, this is required. Version: 1.1.0 Author: WpOpal Author URI:  http://www.wpopal.com/ License: GNU/GPLv3
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

final class Strollik5Core {
    /**
     * @var Strollik5Core
     */
    private static $instance;

    /**
     * Strollik5Core constructor.
     */
    public function __construct() {
        $this->setup_constants();
        $this->plugin_update();
        $this->init_hooks();
    }

    /**
     * @return void
     */
    public function setup_constants() {
        if (!defined('STROLLIK5_CORE_VERSION')) {
            define('STROLLIK5_CORE_VERSION', '1.2.0');
        }

        if (!defined('STROLLIK5_CORE_PLUGIN_DIR')) {
            define('STROLLIK5_CORE_PLUGIN_DIR', plugin_dir_path(__FILE__));
        }

        if (!defined('STROLLIK5_CORE_PLUGIN_URL')) {
            define('STROLLIK5_CORE_PLUGIN_URL', plugin_dir_url(__FILE__));
        }

        if (!defined('STROLLIK5_CORE_PLUGIN_FILE')) {
            define('STROLLIK5_CORE_PLUGIN_FILE', __FILE__);
        }
    }

    /**
     * @return void
     */
    private function load_textdomain() {
        $lang_dir = dirname(plugin_basename(STROLLIK5_CORE_PLUGIN_FILE)) . '/languages/';
        $lang_dir = apply_filters('osf_languages_directory', $lang_dir);
        $locale = apply_filters('plugin_locale', get_locale(), 'strollik5-core');
        $mofile = sprintf('%1$s-%2$s.mo', 'strollik5-core', $locale);
        $mofile_local = $lang_dir . $mofile;
        $mofile_global = WP_LANG_DIR . '/strollik5-core/' . $mofile;

        if (file_exists($mofile_global)) {
            load_textdomain('strollik5-core', $mofile_global);
        } else {
            if (file_exists($mofile_local)) {
                load_textdomain('strollik5-core', $mofile_local);
            } else {
                load_plugin_textdomain('strollik5-core', false, $lang_dir);
            }
        }
    }

    public function plugin_update() {
    	if(is_admin()){
		    require 'plugin-updates/plugin-update-checker.php';
		    Puc_v4_Factory::buildUpdateChecker(
			    'http://source.wpopal.com/strollik5/dummy_data/update-plugin.json',
			    __FILE__,
			    'strollik5-core'
		    );
	    }
    }

    /**
     * @return void
     */
    public function includes() {
		$this->load_textdomain();

	    // Require plugin.php to use is_plugin_active() below
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');

        include_once 'inc/vendors/ariColor.php';
        require_once 'inc/core-functions.php';
        require_once 'inc/style-functions.php';
        require_once 'inc/class-abstract-post-type.php';
//        require_once 'inc/class-admin-menu.php';
        require_once 'inc/class-customize.php';
        require_once 'inc/class-meta-box.php';
        require_once 'inc/class-scripts.php';
        require_once 'inc/class-theme.php';
        require_once 'inc/class-user.php';
        require_once 'inc/class-widgets.php';
        require_once 'inc/class-template-loader.php';
        require_once 'inc/typography.php';
        require_once 'inc/shortcodes.php';

        if (osf_is_elementor_activated()) {
            require_once 'inc/vendors/elementor/class-elementor.php';
        require_once 'inc/vendors/elementor/class-elementor-pro.php';
            require_once 'inc/vendors/elementor/icons.php';
            require_once 'inc/vendors/opal-megamenu-for-elementor/opalmegamenu.php';
        }

        // CMB2
        if (!class_exists('CMB2')) {
            require_once 'inc/vendors/cmb2/libraries/init.php';
        }


        // AJAX Load More
        require_once 'inc/vendors/ajax-load-more/class-ajax-load-more.php';

//        require_once 'inc/vendors/cmb2/custom-fields/map/map.php';
//        require_once 'inc/vendors/cmb2/custom-fields/upload/upload.php';
//        require_once 'inc/vendors/cmb2/custom-fields/user/user.php';
//        require_once 'inc/vendors/cmb2/custom-fields/user_upload/user_upload.php';
        require_once 'inc/vendors/cmb2/custom-fields/switch/switch.php';
        require_once 'inc/vendors/cmb2/custom-fields/tabs/cmb2-tabs.php';
        require_once 'inc/vendors/cmb2/custom-fields/button_set.php';
//        require_once 'inc/vendors/cmb2/custom-fields/text_password.php';
//        require_once 'inc/vendors/cmb2/custom-fields/agent_info.php';
//		require_once 'inc/vendors/cmb2/custom-fields/text_price.php';
        require_once 'inc/vendors/cmb2/custom-fields/switch-layout.php';
        require_once 'inc/vendors/cmb2/custom-fields/slider/slider.php';
        require_once 'inc/vendors/cmb2/custom-fields/footer-layout.php';
        require_once 'inc/vendors/cmb2/custom-fields/header-layout.php';



        if (is_plugin_active('woocommerce/woocommerce.php')) {
            require 'inc/vendors/woocommerce/class-woocommerce.php';
            require 'inc/vendors/woocommerce/woocommerce-mobile-handhed-footer-bar.php';
            require 'inc/vendors/woocommerce/class-woocommerce-extra.php';
            require 'inc/vendors/woocommerce/woocommerce-template-functions.php';
            require 'inc/vendors/woocommerce/woocommerce-template-hooks.php';
            require 'inc/vendors/woocommerce/class-woocommerce-clever.php';
        }

        require_once 'inc/class-import.php';
        if (!osf_is_one_click_import_activated()) {
            require_once 'inc/vendors/one-click-demo-import/one-click-demo-import.php';
        }


    }

    /**
     * @return void
     */
    private function init_hooks() {
        add_action('plugins_loaded', array($this, 'includes'), 99);
        add_action('init', array($this, 'init_theme_support'), 1);
        add_action('customize_register', array($this, 'init_customize_control'), 1);
    }

    /**
     * @return Strollik5Core
     */
    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof Strollik5Core)) {
            self::$instance = new Strollik5Core();
        }

        return self::$instance;
    }

    /**
     * @return void
     */
    public function init_customize_control() {
        if (get_theme_support('opal-customize-css')) {
            /** inject:customize_control */
            require_once 'inc/customize-control/background-position.php';
            require_once 'inc/customize-control/button-group.php';
            require_once 'inc/customize-control/button-move.php';
            require_once 'inc/customize-control/button-switch.php';
            require_once 'inc/customize-control/color.php';
            require_once 'inc/customize-control/editor.php';
            require_once 'inc/customize-control/font-style.php';
            require_once 'inc/customize-control/footer.php';
            require_once 'inc/customize-control/google-font.php';
            require_once 'inc/customize-control/header.php';
            require_once 'inc/customize-control/heading.php';
            require_once 'inc/customize-control/image-select.php';
            require_once 'inc/customize-control/import-export.php';
            require_once 'inc/customize-control/sidebar.php';
            require_once 'inc/customize-control/slider.php';
            /** end:customize_control */
        }
    }

    /**
     * @return void
     */
    public function init_theme_support() {
        if (osf_is_elementor_activated()) {
            if (get_theme_support('opal-header-builder')) {
                require_once 'inc/post-type/header.php';
                require_once 'inc/class-header-builder.php';
            }
            if (get_theme_support('opal-footer-builder')) {
                require_once 'inc/post-type/footer.php';
                require_once 'inc/class-footer-builder.php';
            }
        }

        new OSF_Metabox();
    }
}

return Strollik5Core::getInstance();

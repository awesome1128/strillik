<?php

class OSF_Import {
	private $config, $path_rev, $homepage, $blogpage, $settings, $templates;

	public function __construct() {
		if ( is_admin() ) {
			$this->path_rev = trailingslashit( wp_upload_dir()['basedir'] ) . 'opal_rev_sliders_import/';
			add_action( 'after_setup_theme', array( $this, 'init' ) );
		}
	}

	public function init() {
		$this->init_hooks();
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
	}

	public function init_hooks() {
		if ( get_option( 'otf-oneclick-first-import', 'yes' ) === 'yes' ) {
			add_filter( 'pt-ocdi/import_files', array( $this, 'import_file_base' ) );
			add_action( 'pt-ocdi/after_import', array( $this, 'after_import_setup' ) );
			add_action( 'pt-ocdi/after_import', array( $this, 'after_import_setup_base' ), 20 );
		} else {
			add_filter( 'pt-ocdi/import_files', array( $this, 'import_files' ) );
			add_action( 'pt-ocdi/after_import', array( $this, 'after_import_setup' ) );
			add_filter( 'pt-ocdi/enable_grid_layout_import_popup_confirmation', '__return_false' );
			add_filter( 'otf-ocdi/reload_page', '__return_false' );
		}
	}

	public function import_file_base() {
		$this->init_data();
		$imports   = array();
		$import    = array(
			'import_file_name'  => 'Home 1',
			'local_import_file' => trailingslashit( STROLLIK5_CORE_PLUGIN_DIR ) . 'dummy-data/content.xml',
			'import_notice'     => 'Basic import includes default version from our demo and a few products, blog posts and portfolio projects. It is a required minimum to see how our theme built and to be able to import additional versions or pages.',
			'slug'              => '1',
			'customizer'        => esc_url( 'http://source.wpopal.com/strollik5/dummy_data/strollik5/customizer.json' ),
			'elementor'         => esc_url( 'http://source.wpopal.com/strollik5/dummy_data/strollik5/elementor.json' ),
			'settings'          => esc_url( 'http://source.wpopal.com/strollik5/dummy_data/strollik5/settings.json' ),
		);
		$imports[] = $import;

		return $imports;
	}

	public function import_files() {
		$this->init_data();
		$imports = array();
		foreach ( $this->config as $key => $item ) {
			$import = array(
				'import_file_name'         => $item['name'],
				'import_preview_image_url' => $item['screenshot'],
				'slug'                     => $key,
				'settings'                 => esc_url( 'http://source.wpopal.com/strollik5/dummy_data/strollik5/settings.json' ),
			);
			if ( isset( $item['xml'] ) ) {
				$import['import_file_url'] = $item['xml'];
			}

			$imports[] = $import;
		}

		return $imports;
	}

	private function init_data() {
		$this->config   = $this->get_remote_json( trailingslashit( STROLLIK5_CORE_PLUGIN_URL ) . 'dummy-data/config.json', true );
		$this->blogpage = get_page_by_title( 'Blog' );
	}

	public function after_import_setup_base( $selected_import ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', ( ( $this->homepage instanceof WP_Post ) ? $this->homepage->ID : 0 ) );
		update_option( 'page_for_posts', ( ( $this->blogpage instanceof WP_Post ) ? $this->blogpage->ID : 0 ) );
		update_option( 'otf-oneclick-first-import', 'no' );

		// Setup Customizer
		$thememods = $this->get_remote_json( $selected_import['customizer'], true );
		foreach ( $thememods as $mod => $value ) {
			set_theme_mod( $mod, $value );
		}

		// Setup Elementor
		$this->settings = $this->get_remote_json( $selected_import['settings'], true );
		$elementor      = $this->get_remote_json( $selected_import['elementor'], true );

		// Breadcrumb
		update_option( 'bcn_options', $this->settings['breadcrumb'] );

		if ( osf_is_elementor_activated() ) {
			$this->updateElementor();
			foreach ( $elementor as $key => $value ) {
				update_option( $key, $value );
			}
			$global = new Elementor\Core\Files\CSS\Global_CSS( 'global.css' );
			$global->update_file();
		}

	}


	public function after_import_setup( $selected_import ) {
		if ( isset( $this->config[ $selected_import['slug'] ] ) ) {

			$this->homepage = get_page_by_title( $selected_import['import_file_name'] );

			$setup = $this->config[ $selected_import['slug'] ];
			// REVSLIDER
			if ( $sliders = $setup['rev_sliders'] ) {
				if ( class_exists( 'RevSliderAdmin' ) ) {
					if ( ! file_exists( $this->path_rev ) ) {
						wp_mkdir_p( $this->path_rev );
					}
					foreach ( $sliders as $slider ) {
						$this->add_revslider( $slider );
					}
				}
			}

			$this->settings  = $this->get_remote_json( $selected_import['settings'], true );
			$this->templates = $this->settings['templates'];

			$this->setup_home_page( $selected_import['slug'] );

			// Setup Home page
			update_option( 'page_on_front', ( ( $this->homepage instanceof WP_Post ) ? $this->homepage->ID : 0 ) );

			// Mailchimp
			$mailchimp = get_page_by_title( 'Opal MailChimp', OBJECT, 'mc4wp-form' );
			if ( $mailchimp ) {
				update_option( 'mc4wp_default_form_id', $mailchimp->ID );
			}

			if ( osf_is_elementor_activated() ) {
				$this->update_url_elementor();
				\Elementor\Plugin::$instance->files_manager->clear_cache();
			}

		}
		set_theme_mod( 'osf_dev_mode', false );
	}

	private function add_revslider( $slider ) {
		$dest_rev = $this->path_rev . basename( $slider );
		if ( ! file_exists( $dest_rev ) ) {
			file_put_contents( $dest_rev, fopen( $slider, 'r' ) );
			$_FILES['import_file']['error']    = UPLOAD_ERR_OK;
			$_FILES['import_file']['tmp_name'] = $dest_rev;

			$revslider = new RevSlider();
			$revslider->importSliderFromPost( true, 'none' );
		}
	}

	private function setup_home_page( $slug ) {
            $this->reset_theme_mods();
            
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CPoppins%3A700%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_blog_archive_style', '1');
        set_theme_mod('osf_typography_general_body_line_height', '24');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_size', '14');
        set_theme_mod('osf_typography_page_title_breadcrumb_heading_line_height', '24');
        set_theme_mod('osf_typography_sidebar_title_font_size', '30');
        set_theme_mod('osf_typography_sidebar_title_letter_spacing', '0');
        set_theme_mod('osf_typography_sidebar_title_padding_top', '0');
        set_theme_mod('osf_typography_sidebar_title_padding_bottom', '0');
        set_theme_mod('osf_typography_sidebar_title_margin_top', '0');
        set_theme_mod('osf_typography_sidebar_title_margin_bottom', '20');
        set_theme_mod('osf_typography_footer_widget_title_font_size', '30');
        set_theme_mod('osf_typography_footer_widget_title_letter_spacing', '0');
        set_theme_mod('osf_typography_footer_widget_title_padding_top', '0');
        set_theme_mod('osf_typography_footer_widget_title_padding_bottom', '0');
        set_theme_mod('osf_typography_footer_widget_title_margin_bottom', '20');
        set_theme_mod('osf_typography_button_line_height', '24');
        set_theme_mod('osf_colors_general_primary', '#e43636');
        set_theme_mod('osf_colors_general_heading', '#000000');
        set_theme_mod('osf_colors_general_body', '#666666');
        set_theme_mod('osf_colors_general_secondary', '#1d1d1d');
        set_theme_mod('osf_colors_quotes_color', '#000000');
        set_theme_mod('osf_colors_sidebar_title_color', '#000000');
        set_theme_mod('osf_colors_sidebar_color', '#666666');
        set_theme_mod('osf_layout_general_content_width_px', '1200');
        set_theme_mod('osf_layout_general_layout_mode', 'boxed');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1400');
        set_theme_mod('osf_layout_buttons_border_radius', '0');
        set_theme_mod('osf_socials', 'true');
        set_theme_mod('osf_facebook', 'true');
        set_theme_mod('osf_twitter', 'true');
        set_theme_mod('osf_linkedin', 'true');
        set_theme_mod('osf_tumblr', 'true');
        set_theme_mod('osf_google_plus', 'true');
        set_theme_mod('osf_pinterest', 'true');
        set_theme_mod('osf_email', 'true');
        set_theme_mod('osf_header_enable_builder', 'true');
        set_theme_mod('osf_header_builder', 'header-1');
        set_theme_mod('osf_typography_general_heading_letter_spacing', '0');
        set_theme_mod('osf_fixed_footer', 'false');
        set_theme_mod('osf_footer_layout', 'footer-1');
        set_theme_mod('osf_woocommerce_single_layout', '1c');
        set_theme_mod('osf_woocommerce_archive_sidebar', 'sidebar-woocommerce-shop');
        set_theme_mod('osf_comment_template_form', '3');
        set_theme_mod('osf_woocommerce_product_thumbnail_columns', '6');
        set_theme_mod('osf_woocommerce_single_product_style', '2');
        set_theme_mod('osf_woocommerce_archive_layout', '1c');
        set_theme_mod('osf_woocommerce_archive_sidebar_width', '310');
        set_theme_mod('osf_layout_sidebar_margin_bottom', '30');
        set_theme_mod('osf_blog_single_layout', '1c');
        set_theme_mod('osf_blog_single_navigation', '2');
        set_theme_mod('osf_layout_page_title_style', 'top-bottom');
        set_theme_mod('osf_layout_page_title_height', '160');
        set_theme_mod('osf_layout_page_title_padding_top', '0');
        set_theme_mod('osf_colors_page_title_bg', '#f8f8f8');
        set_theme_mod('osf_colors_page_title_heading_color', '#000000');
        set_theme_mod('osf_colors_page_title_breadcrumb_color', '#666666');
        set_theme_mod('osf_layout_page_title_padding_bottom', '0');
        set_theme_mod('osf_woocommerce_archive_product_width', '');
        set_theme_mod('osf_woocommerce_archive_sidebar_padding_left', '40');
        set_theme_mod('osf_woocommerce_archive_sidebar_padding_right', '97');
        set_theme_mod('osf_woocommerce_archive_columns', '3');
        set_theme_mod('osf_layout_pagination_style', '6');
        set_theme_mod('osf_layout_page_title_width', 'false');
        set_theme_mod('osf_layout_page_title_padding_right', '0');
        set_theme_mod('osf_layout_page_title_padding_left', '0');
        set_theme_mod('osf_woocommerce_archive_filter_position', 'none');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_body_font_size', '14');
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "false",]);
        set_theme_mod('osf_typography_page_title_heading_font_size', '30');
        set_theme_mod('osf_typography_page_title_heading_line_height', '36');
        set_theme_mod('osf_typography_page_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "false",]);
        set_theme_mod('osf_typography_mainmenu_font_family', ["family" => "",]);
        set_theme_mod('osf_typography_mainmenu_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "true",]);
        set_theme_mod('osf_typography_mainmenu_font_size', '14');
        set_theme_mod('osf_typography_vertical_menu_font_family', ["family" => "",]);
        set_theme_mod('osf_typography_vertical_menu_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "true",]);
        set_theme_mod('osf_typography_vertical_menu_font_size', '14');
        set_theme_mod('osf_typography_button_font_size', '12');
        set_theme_mod('osf_typography_footer_heading_color', '#000000');
        set_theme_mod('osf_colors_quotes_border', '#e5e5e5');
        set_theme_mod('osf_typography_general_body_letter_spacing', '0');
        set_theme_mod('osf_layout_sidebar_padding_bottom', '30');
        set_theme_mod('osf_typography_sidebar_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "false",]);
        set_theme_mod('osf_woocommerce_single_product_tab_style', 'tab');
        set_theme_mod('osf_woocommerce_single_product_width', 'false');
        set_theme_mod('osf_woocommerce_single_related_number', '3');
        set_theme_mod('osf_woocommerce_single_related_columns', '3');
        set_theme_mod('osf_woocommerce_single_upsell_columns', '3');
        set_theme_mod('osf_layout_general_content_width_padding', '15');
        set_theme_mod('osf_blog_archive_sidebar', 'sidebar-1');
        set_theme_mod('osf_typography_page_title_heading_letter_spacing', '0');
        set_theme_mod('osf_blog_archive_sidebar_padding_right', '80');
        set_theme_mod('osf_blog_archive_layout', '1c');
        set_theme_mod('osf_blog_archive_sidebar_padding_left', '40');
        set_theme_mod('osf_colors_page_title_border_color', '#efefef');
        set_theme_mod('osf_colors_page_title_border', '1');
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_blog_archive_sidebar_width', '340');
        set_theme_mod('osf_typography_footer_widget_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "false",]);
        set_theme_mod('osf_colors_page_title_border_bottom', '0');
        set_theme_mod('custom_css_post_id', '-1');
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_button_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "false",]);
        set_theme_mod('background_color', 'f6f6f6');
        set_theme_mod('osf_colors_footer_control', 'false');
        set_theme_mod('osf_colors_buttons_enable_custom', 'false');
        set_theme_mod('osf_layout_general_content_width_type', 'px');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '40');
        set_theme_mod('osf_layout_sidebar_is_sticky', 'false');
        set_theme_mod('osf_page_404_page_enable', 'custom');
        set_theme_mod('osf_page_404_page_custom', '291');
        set_theme_mod('osf_comment_template_skin', '4');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_woocommerce_product_color_label_sale', '#ffffff');
        set_theme_mod('osf_woocommerce_product_color_bg_label_sale', '#f5c806');
        set_theme_mod('osf_woocommerce_product_color_border_label_sale', '#f5c806');
        set_theme_mod('osf_woocommerce_product_hover', 'fade');
        set_theme_mod('osf_woocommerce_product_style', '1');
        set_theme_mod('osf_layout_general_gutter_width', '30');
        set_theme_mod('custom_logo', '744');
        set_theme_mod('osf_back_to_top_footer', 'true');
switch ($slug){        
   case '10':
        set_theme_mod('custom_logo', '1255');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_colors_general_primary', '#cc9b76');
        set_theme_mod('osf_colors_general_secondary', '#213258');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_header_builder', 'header-9');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_woocommerce_product_hover', 'swap');
        set_theme_mod('osf_footer_layout', 'footer-8');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '11':
        set_theme_mod('custom_logo', '2898');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Ubuntu%3A400%7CUbuntu%3A700%7CUbuntu%3A700%7CUbuntu%3A400%7CUbuntu%3A400%7CUbuntu%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Ubuntu","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_colors_general_primary', '#35e1db');
        set_theme_mod('osf_colors_general_secondary', '#f13333');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-10');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Ubuntu","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Ubuntu","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Ubuntu","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_body_font_size', '16');
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_page_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_sidebar_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Ubuntu","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_footer_widget_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Ubuntu","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_footer_layout', 'footer-9');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '12':
        set_theme_mod('custom_logo', '1247');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Montserrat%3A400%7CMontserrat%3A700%7CMontserrat%3A700%7CMontserrat%3A300%7CMontserrat%3A400%7CMontserrat%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_colors_general_primary', '#ddb09a');
        set_theme_mod('osf_colors_general_secondary', '#2c2c2c');
        set_theme_mod('osf_header_builder', 'header-11');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_woocommerce_archive_sidebar_padding_right', '100');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('background_image', 'http://dev.wpopal.com/strollik/niches/12/wp-content/uploads/2018/09/ochair_bg_home-min.jpg');
        set_theme_mod('osf_colors_buttons_primary_border', '#eeee22');
        set_theme_mod('osf_colors_buttons_primary_hover_border', '#eeee22');
        set_theme_mod('osf_colors_buttons_primary_bg', '#eeee22');
        set_theme_mod('osf_colors_buttons_primary_hover_bg', '#eeee22');
        set_theme_mod('osf_footer_layout', 'footer-10');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '13':
        set_theme_mod('custom_logo', '1240');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Roboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_colors_general_primary', '#ec6d38');
        set_theme_mod('osf_layout_general_content_width_px', '1320');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1760');
        set_theme_mod('osf_header_builder', 'header-12');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_body_font_size', '16');
        set_theme_mod('osf_layout_general_content_width_padding', '20');
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_layout_general_gutter_width', '40');
        set_theme_mod('osf_footer_layout', 'footer-11');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '14':
        set_theme_mod('custom_logo', '1239');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Roboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_colors_general_primary', '#30aece');
        set_theme_mod('osf_layout_general_content_width_px', '1320');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1760');
        set_theme_mod('osf_header_builder', 'header-13');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_body_font_size', '16');
        set_theme_mod('osf_layout_general_content_width_padding', '20');
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_colors_buttons_enable_custom', 'true');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_layout_general_gutter_width', '40');
        set_theme_mod('osf_colors_buttons_secondary_bg', '#000000');
        set_theme_mod('osf_colors_buttons_secondary_hover_bg', '#767676');
        set_theme_mod('osf_colors_buttons_secondary_border', '#000000');
        set_theme_mod('osf_colors_buttons_primary_hover_bg', '#30aece');
        set_theme_mod('osf_colors_buttons_primary_hover_border', '#30aece');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_footer_layout', 'footer-11');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '15':
        set_theme_mod('custom_logo', '1237');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Roboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_colors_general_primary', '#7143ea');
        set_theme_mod('osf_layout_general_content_width_px', '1320');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1760');
        set_theme_mod('osf_header_builder', 'header-14');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_body_font_size', '16');
        set_theme_mod('osf_layout_general_content_width_padding', '20');
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_layout_general_gutter_width', '40');
        set_theme_mod('osf_footer_layout', 'footer-11');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '16':
        set_theme_mod('custom_logo', '1236');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Roboto%3A300%7CRoboto%3A300%7CPoppins%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_colors_general_primary', '#004ab8');
        set_theme_mod('osf_layout_general_content_width_px', '1320');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1760');
        set_theme_mod('osf_header_builder', 'header-12');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_body_font_size', '16');
        set_theme_mod('osf_layout_general_content_width_padding', '20');
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_layout_general_gutter_width', '40');
        set_theme_mod('osf_footer_layout', 'footer-11');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '17':
        set_theme_mod('custom_logo', '1256');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7COswald%3A300%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_blog_archive_style', '1');
        set_theme_mod('osf_colors_general_primary', '#00a4e1');
        set_theme_mod('osf_colors_general_secondary', '#2a2a2a');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-15');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Oswald","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_page_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_sidebar_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_footer_widget_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('custom_css_post_id', '1097');
        set_theme_mod('background_color', '2a2a2a');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_colors_buttons_primary_bg', '#dd3333');
        set_theme_mod('osf_footer_layout', 'footer-12');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '18':
        set_theme_mod('custom_logo', '1253');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Raleway%3A300%7CRaleway%3A700%7CRaleway%3A700%7CRaleway%3A400%7CRaleway%3A300%7CRaleway%3A300&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Raleway","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_size', '18');
        set_theme_mod('osf_typography_page_title_breadcrumb_heading_line_height', '30');
        set_theme_mod('osf_colors_general_primary', '#5bdc65');
        set_theme_mod('osf_colors_general_body', '#888888');
        set_theme_mod('osf_colors_general_secondary', '#000000');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-16');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Raleway","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Raleway","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Raleway","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_body_font_size', '18');
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Raleway","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Raleway","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_footer_layout', 'footer-13');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '19':
        set_theme_mod('custom_logo', '1249');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CAnton%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_colors_general_primary', '#df3b43');
        set_theme_mod('osf_colors_general_secondary', '#00a4e1');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-17');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_woocommerce_archive_sidebar_padding_left', '34');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Anton","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_button_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "false",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_layout_general_gutter_width', '30');
        set_theme_mod('osf_woocommerce_product_style', '3');
        set_theme_mod('osf_colors_buttons_primary_bg', '#eeee22');
        set_theme_mod('osf_colors_buttons_primary_border', '');
        set_theme_mod('osf_colors_buttons_primary_hover_bg', '#81d742');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_footer_layout', 'footer-14');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '2':
        set_theme_mod('custom_logo', '1252');
        set_theme_mod('osf_colors_general_primary', '#54a9a2');
        set_theme_mod('osf_colors_general_secondary', '#c59c6c');
        set_theme_mod('osf_header_builder', 'header-2');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_woocommerce_archive_sidebar_padding_right', '60');
        set_theme_mod('background_image', 'http://dev.wpopal.com/strollik/niches/02/wp-content/uploads/2018/09/bg-body.jpg');
        set_theme_mod('background_preset', 'repeat');
        set_theme_mod('background_position_x', 'center');
        set_theme_mod('background_position_y', 'center');
        set_theme_mod('background_attachment', 'scroll');
        set_theme_mod('background_size', 'auto');
        set_theme_mod('background_repeat', 'repeat');
        set_theme_mod('osf_woocommerce_product_hover', 'fade');
        set_theme_mod('osf_footer_layout', 'footer-2');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '20':
        set_theme_mod('custom_logo', '3304');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Titillium+Web%3A300%7CTitillium+Web%3A600%7CTitillium+Web%3A300%7CTitillium+Web%3A300%7CTitillium+Web%3A700%7CTitillium+Web%3A900&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Titillium Web","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_colors_general_primary', '#e35a58');
        set_theme_mod('osf_colors_general_secondary', '#5bc2dc');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-18');
        set_theme_mod('osf_woocommerce_product_thumbnail_columns', '3');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Titillium Web","subsets" => "latin-ext","fontWeight" => "600",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Titillium Web","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Titillium Web","subsets" => "latin-ext","fontWeight" => "900",]);
        set_theme_mod('osf_typography_general_body_font_size', '16');
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "false",]);
        set_theme_mod('osf_typography_page_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "false",]);
        set_theme_mod('osf_typography_sidebar_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "false",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Titillium Web","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_footer_widget_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "false",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Titillium Web","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_mobile_menu_skin', 'light');
        set_theme_mod('osf_woocommerce_product_style', '1');
        set_theme_mod('osf_footer_layout', 'footer-15');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '21':
        set_theme_mod('custom_logo', '1245');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Rubik%3A400%7CRubik%3A700italic%7CRubik%3A700%7CRubik%3A400%7CRubik%3A400%7CRubik%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Rubik","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_colors_general_primary', '#e52929');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-26');
        set_theme_mod('osf_footer_layout', 'footer-16');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Rubik","subsets" => "latin-ext","fontWeight" => "700italic",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Rubik","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Rubik","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_body_font_size', '16');
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "true","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_page_title_font_style', ["italic" => "true","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_mainmenu_font_style', ["italic" => "true","underline" => "false","fontWeight" => "false","uppercase" => "true",]);
        set_theme_mod('osf_typography_vertical_menu_font_style', ["italic" => "true","underline" => "false","fontWeight" => "false","uppercase" => "true",]);
        set_theme_mod('osf_typography_sidebar_font_style', ["italic" => "true","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Rubik","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_blog_archive_sidebar_width', '340');
        set_theme_mod('osf_typography_footer_widget_title_font_style', ["italic" => "true","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_colors_page_title_border_bottom', '0');
        set_theme_mod('custom_css_post_id', '994');
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Rubik","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('background_color', '2a2a2a');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '22':
        set_theme_mod('custom_logo', '1244');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Lato%3A300%7CLato%3A300%7CLato%3A400%7CLato%3A400%7CLato%3A300%7CLato%3A300&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Lato","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_colors_general_primary', '#b16fbe');
        set_theme_mod('osf_colors_general_secondary', '#172c60');
        set_theme_mod('osf_header_builder', 'header-19');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Lato","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Lato","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Lato","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_body_font_size', '18');
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Lato","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('custom_css_post_id', '807');
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Lato","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_footer_layout', 'footer-17');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '23':
        set_theme_mod('custom_logo', '1243');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Roboto%3A300%7CRoboto%3A300%7CRoboto%3A300%7CRoboto%3A300italic%7CRoboto%3A300%7CRoboto%3A300&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_size', '16');
        set_theme_mod('osf_typography_page_title_breadcrumb_heading_line_height', '30');
        set_theme_mod('osf_colors_general_primary', '#e48d26');
        set_theme_mod('osf_colors_general_body', '#888888');
        set_theme_mod('osf_colors_general_secondary', '#222222');
        set_theme_mod('osf_colors_sidebar_color', '#888888');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-20');
        set_theme_mod('osf_footer_layout', 'footer-18');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_colors_page_title_heading_color', '#000000');
        set_theme_mod('osf_colors_page_title_breadcrumb_color', '#888888');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_body_font_size', '16');
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "false",]);
        set_theme_mod('osf_typography_page_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "false",]);
        set_theme_mod('osf_typography_sidebar_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "false",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300italic",]);
        set_theme_mod('osf_typography_footer_widget_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "false","uppercase" => "false",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Roboto","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '24':
        set_theme_mod('custom_logo', '1242');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CPoppins%3A300%7CPoppins%3A300%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_colors_general_primary', '#ff568a');
        set_theme_mod('osf_colors_general_heading', '#000000');
        set_theme_mod('osf_colors_general_body', '#888888');
        set_theme_mod('osf_colors_general_secondary', '#222222');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-21');
        set_theme_mod('osf_footer_layout', 'footer-18');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_body_font_size', '16');
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '25':
        set_theme_mod('custom_logo', '1364');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7COswald%3A700%7COswald%3A700%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "500",]);
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_colors_general_primary', '#8fba1c');
        set_theme_mod('osf_colors_general_heading', '#000000');
        set_theme_mod('osf_colors_general_body', '#666666');
        set_theme_mod('osf_colors_general_secondary', '#222222');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-22');
        set_theme_mod('osf_footer_layout', 'footer-19');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '26':
        set_theme_mod('custom_logo', '1365');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Montserrat%3A400%7CMontserrat%3A700%7CMontserrat%3A700%7CMontserrat%3A300%7CMontserrat%3A400%7CMontserrat%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_colors_general_primary', '#90d26c');
        set_theme_mod('osf_colors_general_heading', '#000000');
        set_theme_mod('osf_colors_general_body', '#666666');
        set_theme_mod('osf_colors_general_secondary', '#222222');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-23');
        set_theme_mod('osf_footer_layout', 'footer-20');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '27':
        set_theme_mod('custom_logo', '1363');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Bai+Jamjuree%3A400%7CBai+Jamjuree%3A700%7CBai+Jamjuree%3A700italic&subset=latin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Bai Jamjuree","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_colors_general_primary', '#90d26c');
        set_theme_mod('osf_colors_general_heading', '#000000');
        set_theme_mod('osf_colors_general_body', '#666666');
        set_theme_mod('osf_colors_general_secondary', '#222222');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-24');
        set_theme_mod('osf_footer_layout', 'footer-20');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Bai Jamjuree","subsets" => "latin-ext","fontWeight" => "700italic",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Bai Jamjuree","subsets" => "latin-ext","fontWeight" => "700italic",]);
        set_theme_mod('osf_typography_page_title_breadcrumb_font_family', ["family" => "Bai Jamjuree","subsets" => "latin-ext","fontWeight" => "700italic",]);
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Bai Jamjuree","subsets" => "latin-ext","fontWeight" => "700italic",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '28':
        set_theme_mod('custom_logo', '1360');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Barlow%3A400%7CBarlow%3A600&subset=latin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Barlow","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_colors_general_primary', '#fac36e');
        set_theme_mod('osf_colors_general_heading', '#000000');
        set_theme_mod('osf_colors_general_body', '#666666');
        set_theme_mod('osf_colors_general_secondary', '#222222');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-23');
        set_theme_mod('osf_footer_layout', 'footer-20');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Barlow","subsets" => "latin-ext","fontWeight" => "600",]);
        set_theme_mod('osf_typography_general_tertiary_font', ["family" => "Barlow","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_quaternary_font', ["family" => "Barlow","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '29':
        set_theme_mod('custom_logo', '1361');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CRozha+One%3A400&subset=latin-ext%2Clatin-ext');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "500",]);
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_colors_general_primary', '#e58f9a');
        set_theme_mod('osf_colors_general_heading', '#000000');
        set_theme_mod('osf_colors_general_body', '#666666');
        set_theme_mod('osf_colors_general_secondary', '#222222');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-22');
        set_theme_mod('osf_footer_layout', 'footer-20');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Rozha One","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '3':
        set_theme_mod('custom_logo', '1251');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7COswald%3A700%7COswald%3A700%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_colors_general_primary', '#f15252');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_header_builder', 'header-3');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Oswald","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_page_title_heading_font_size', '30');
        set_theme_mod('osf_typography_page_title_heading_line_height', '36');
        set_theme_mod('osf_typography_page_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_sidebar_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_typography_footer_widget_title_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('osf_colors_page_title_border_bottom', '0');
        set_theme_mod('custom_css_post_id', '-1');
        set_theme_mod('osf_typography_page_title_font_family', ["family" => "Oswald","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_woocommerce_product_hover', 'swap');
        set_theme_mod('osf_footer_layout', 'footer-3');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '30':
        set_theme_mod('custom_logo', '1362');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CPrata%3A400&subset=latin-ext%2Ccyrillic-ext');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "400",]);
        set_theme_mod('osf_typography_general_body_line_height', '30');
        set_theme_mod('osf_colors_general_primary', '#bf4545');
        set_theme_mod('osf_colors_general_heading', '#000000');
        set_theme_mod('osf_colors_general_body', '#666666');
        set_theme_mod('osf_colors_general_secondary', '#222222');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-25');
        set_theme_mod('osf_footer_layout', 'footer-21');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "CPrata","subsets" => "cyrillic-ext","fontWeight" => "400",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_single_upsale_columns', '3');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '4':
        set_theme_mod('custom_logo', '3924');
        set_theme_mod('osf_colors_general_primary', '#3d9ec9');
        set_theme_mod('osf_colors_general_secondary', '#2d2d2d');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_header_builder', 'header-4');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_woocommerce_archive_sidebar_padding_right', '100');
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_woocommerce_product_hover', 'swap');
        set_theme_mod('osf_woocommerce_product_color_border_label_sale', '#f5c806');
        set_theme_mod('osf_footer_layout', 'footer-4');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '5':
        set_theme_mod('custom_logo', '1241');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CTeko%3A700%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_colors_general_primary', '#f2335d');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_header_enable_builder', 'true');
        set_theme_mod('osf_header_builder', 'header-5');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Teko","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('background_color', 'f1f1f1');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_woocommerce_product_hover', 'right-to-left');
        set_theme_mod('osf_colors_footer_link_color', '#000000');
        set_theme_mod('osf_footer_layout', 'footer-22');
        break;        
   case '6':
        set_theme_mod('custom_logo', '1238');
        set_theme_mod('osf_colors_general_primary', '#6dc0ea');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-6');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_product_hover', 'swap');
        set_theme_mod('osf_footer_layout', 'footer-5');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '7':
        set_theme_mod('custom_logo', '1235');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CMontserrat%3A700%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_colors_general_primary', '#ee733d');
        set_theme_mod('osf_colors_general_secondary', '#213e7f');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1200');
        set_theme_mod('osf_header_builder', 'header-3');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Montserrat","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '30');
        set_theme_mod('osf_woocommerce_product_hover', 'swap');
        set_theme_mod('osf_footer_layout', 'footer-6');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '8':
        set_theme_mod('custom_logo', '2090');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_colors_general_primary', '#d48e5d');
        set_theme_mod('osf_colors_general_heading', '#000000');
        set_theme_mod('osf_colors_general_body', '#666666');
        set_theme_mod('osf_colors_general_secondary', '#57585d');
        set_theme_mod('osf_layout_general_layout_mode', 'wide');
        set_theme_mod('osf_header_builder', 'header-7');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('background_color', 'ffffff');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_footer_layout', 'footer-23');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;        
   case '9':
        set_theme_mod('custom_logo', '1254');
        set_theme_mod('osf_theme_google_fonts', 'https://fonts.googleapis.com/css?family=Poppins%3A400%7CSaira+Condensed%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400%7CPoppins%3A400&#038;subset=latin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext%2Clatin-ext');
        set_theme_mod('osf_colors_general_primary', '#60339e');
        set_theme_mod('osf_colors_general_secondary', '#08193d');
        set_theme_mod('osf_layout_general_layout_boxed_width', '1600');
        set_theme_mod('osf_header_builder', 'header-8');
        set_theme_mod('osf_layout_page_title_padding_top', '20');
        set_theme_mod('osf_layout_page_title_padding_bottom', '20');
        set_theme_mod('osf_typography_general_body_font', ["family" => "Poppins","subsets" => "latin-ext","fontWeight" => "300",]);
        set_theme_mod('osf_typography_general_heading_font', ["family" => "Saira Condensed","subsets" => "latin-ext","fontWeight" => "700",]);
        set_theme_mod('osf_typography_general_heading_font_style', ["italic" => "false","underline" => "false","fontWeight" => "true","uppercase" => "true",]);
        set_theme_mod('custom_css_post_id', '1098');
        set_theme_mod('background_color', '08193d');
        set_theme_mod('osf_layout_general_layout_boxed_offset', '0');
        set_theme_mod('osf_footer_layout', 'footer-7');
        set_theme_mod('osf_header_enable_builder', 'true');
        break;
}


			$this->set_elementor_option();
        }

	/**
	 * @param $link
	 *
	 * @return object|boolean
	 */
	private function get_remote_json( $link, $assoc = false ) {
		$content = file_get_contents( $link );
		if ( ! $content ) {
			return false;
		}

		return json_decode( $content, $assoc );
	}

	public function reset_theme_mods() {
		$mods = json_decode( file_get_contents( trailingslashit( STROLLIK5_CORE_PLUGIN_DIR ) . 'reset-theme-mods.json' ) );
		foreach ( $mods as $mod ) {
			remove_theme_mod( $mod );
		}
	}

	private function updateElementor() {
		$query = new WP_Query( array(
			'post_type'      => [
				'page',
				'elementor_library',
				'header',
				'footer'
			],
			'posts_per_page' => - 1
		) );
		while ( $query->have_posts() ): $query->the_post();
			$postid = get_the_ID();
			if ( get_post_meta( $postid, '_elementor_edit_mode', true ) === 'builder' ) {
				$data = json_decode( get_post_meta( $postid, '_elementor_data', true ), true );
				$data = $this->updateElementorData( $data );
				update_post_meta( $postid, '_elementor_data', wp_slash( wp_json_encode( $data ) ) );
			}
		endwhile;
		wp_reset_postdata();
	}

	private function updateElementorData( $datas ) {
		if ( count( $datas ) <= 0 ) {
			return $datas;
		}
		foreach ( $datas as $key => $data ) {

			// Contact Form
			if ( ! empty( $data['widgetType'] ) && $data['widgetType'] === 'opal-contactform7' ) {
				$data['settings']['cf_id'] = $this->get_contact_form_id( absint( $data['settings']['cf_id'] ) );
			}

			if ( ! empty( $data['elements'] ) ) {
				$data['elements'] = $this->updateElementorData( $data['elements'] );
			}
			$datas[ $key ] = $data;
		}

		return $datas;
	}

	private function get_contact_form_id( $id ) {
		$contact = get_page_by_title( $this->settings['contact'][ $id ], OBJECT, 'wpcf7_contact_form' );
		if ( $contact ) {
			return $contact->ID;
		}

		return $id;
	}

	private function set_elementor_option() {
		$color_primary   = get_theme_mod( 'osf_colors_general_primary', '#0160b4' );
		$color_secondary = get_theme_mod( 'osf_colors_general_secondary', '#00c484' );
		$body_color      = get_theme_mod( 'osf_colors_general_body', '#222222' );
		$scheme_colors   = array_values( get_option( 'elementor_scheme_color' ) );
		if ( $color_primary != $scheme_colors[0] || $color_secondary != $scheme_colors[1] || $body_color != $scheme_colors[2] ) {
			update_option( 'elementor_scheme_color', [
				'1' => $color_primary,
				'2' => $color_secondary,
				'3' => $body_color,
				'4' => $scheme_colors[3],
			] );
		}
	}

	private function get_image_id( $image_url ) {
		global $wpdb;
		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );

		return $attachment[0];
	}

	private function update_url_elementor() {
		$from          = 'http://source.wpopal.com/strollik5';
		$to            = site_url();
		$is_valid_urls = ( filter_var( $from, FILTER_VALIDATE_URL ) && filter_var( $to, FILTER_VALIDATE_URL ) );
		if ( ! $is_valid_urls ) {
			return false;
		}

		if ( $from === $to ) {
			return false;
		}

		global $wpdb;

		// @codingStandardsIgnoreStart cannot use `$wpdb->prepare` because it remove's the backslashes
		$rows_affected = $wpdb->query(
			"UPDATE {$wpdb->postmeta} " .
			"SET `meta_value` = REPLACE(`meta_value`, '" . str_replace( '/', '\\\/', $from ) . "', '" . str_replace( '/', '\\\/', $to ) . "') " .
			"WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE '[%' ;" ); // meta_value LIKE '[%' are json formatted
		// @codingStandardsIgnoreEnd

	}
}

return new OSF_Import();
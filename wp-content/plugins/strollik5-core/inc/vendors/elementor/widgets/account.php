<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class OSF_Elementor_Account extends Elementor\Widget_Base {

	public function get_name() {
		return 'opal-account';
	}

	public function get_title() {
		return __( 'Opal Account', 'strollik5-core' );
	}

	public function get_icon() {
		return 'eicon-lock-user';
	}

	public function get_categories() {
		return [ 'opal-addons' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'account_content',
			[
				'label' => __( 'Account', 'strollik5-core' ),
			]
		);

        $this->add_control(
            'show_icon',
            [
                'label' => __( 'Show Icon', 'strollik5-core' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_submenu_indicator',
            [
                'label' => __( 'Show Submenu Indicator', 'strollik5-core' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

		$this->add_control(
			'icon',
			[
				'label' => __( 'Choose Icon', 'strollik5-core' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-user',
                'condition' => [
                    'show_icon!' => '',
                ],
			]
		);

        $this->add_control(
            'text_account',
            [
                'label' => __( 'Text', 'strollik5-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('My account', 'strollik5-core'),
            ]
        );
		$this->end_controls_section();

        // Title
        $this->start_controls_section(
            'section_style_account_title',
            [
                'label' => __('Title', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => __('Text Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_hover_color',
            [
                'label'     => __('Text Hover Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .site-header-account > a',
            ]
        );

        $this->add_responsive_control(
            'account_align',
            [
                'label' => __( 'Text Alignment', 'strollik5-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'strollik5-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'strollik5-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'strollik5-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
            ]
        );

        $this->end_controls_section();

        // Icon
        $this->start_controls_section(
            'section_style_submenu_indicator',
            [
                'label' => __('Icon', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'strollik5-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a span' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __( 'Spacing', 'strollik5-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a span' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a span' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'icon__hover_color',
            [
                'label'     => __('Hover Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account > a:hover span' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        if (osf_is_woocommerce_activated()) {
            $account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
        } else {
            $account_link = wp_login_url();
        }
        ?>
        <div class="site-header-account">
            <?php
                echo '<a href="' . esc_html($account_link) . '">';

                    if($settings['show_icon_account'] == 'yes'){
                        echo '<i class="'. esc_attr($settings['icon_account']) .'"></i>';
                    }

                    if(is_user_logged_in()) {
                        echo '<span class="text-account">'. esc_attr($settings['text_account']) .'</span>';
                    }
                    else {
                        if(!$settings['icon_account']){
                            echo esc_html__('Login / Register','strollik5-core');
                        }
                    }

                    if($settings['show_submenu_indicator']){
                        echo ' <i class="fa fa-angle-down submenu-indicator" aria-hidden="true"></i>';
                    }
                echo '</a>';
            ?>
            <div class="account-dropdown">
                <div class="account-wrap">
                    <div class="account-inner <?php if (is_user_logged_in()): echo "dashboard"; endif; ?>">
                        <?php if (!is_user_logged_in()) {
                            $this->render_form_login();
                        } else {
                            $this->render_dashboard();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
	}

	protected function render_form_login(){ ?>

        <div class="login-form-head pb-1 mb-3 bb-so-1 bc d-flex align-items-baseline justify-content-between">
            <span class="login-form-title"><?php esc_attr_e('Sign in', 'strollik5-core') ?></span>
            <span class="pull-right">
                <a class="register-link" href="<?php echo esc_url( wp_registration_url()); ?>"
                   title="<?php esc_attr_e('Register', 'strollik5-core'); ?>"><?php esc_attr_e('Create an Account', 'strollik5-core'); ?></a>
            </span>
        </div>
        <form class="opal-login-form-ajax" data-toggle="validator">
            <p>
                <label><?php esc_attr_e('Username or email', 'strollik5-core'); ?> <span class="required">*</span></label>
                <input name="username" type="text" required placeholder="<?php esc_attr_e('Username', 'strollik5-core') ?>">
            </p>
            <p>
                <label><?php esc_attr_e('Password', 'strollik5-core'); ?> <span class="required">*</span></label>
                <input name="password" type="password" required placeholder="<?php esc_attr_e('Password', 'strollik5-core') ?>">
            </p>
            <button type="submit" data-button-action class="btn btn-primary btn-block w-100 mt-1"><?php esc_html_e('Login', 'strollik5-core') ?></button>
            <input type="hidden" name="action" value="osf_login">
			<?php wp_nonce_field('ajax-osf-login-nonce', 'security-login'); ?>
        </form>
        <div class="login-form-bottom">
            <a href="<?php echo wp_lostpassword_url(get_permalink()); ?>" class="mt-2 lostpass-link d-inline-block" title="<?php esc_attr_e('Lost your password?', 'strollik5-core'); ?>"><?php esc_attr_e('Lost your password?', 'strollik5-core'); ?></a>
        </div>
        <?php
    }

    protected function render_dashboard(){ ?>
	    <?php if (has_nav_menu('my-account')) : ?>
            <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Dashboard', 'strollik5-core'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'my-account',
                    'menu_class'     => 'account-links-menu',
                    'depth'          => 1,
                ));
                ?>
            </nav><!-- .social-navigation -->
        <?php else: ?>
            <ul class="account-dashboard">

                <?php if (osf_is_woocommerce_activated()): ?>
                        <li>
                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" title="<?php esc_html_e('Dashboard', 'strollik5-core'); ?>"><?php esc_html_e('Dashboard', 'strollik5-core'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" title="<?php esc_html_e('Orders', 'strollik5-core'); ?>"><?php esc_html_e('Orders', 'strollik5-core'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('downloads')); ?>" title="<?php esc_html_e('Downloads', 'strollik5-core'); ?>"><?php esc_html_e('Downloads', 'strollik5-core'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>" title="<?php esc_html_e('Edit Address', 'strollik5-core'); ?>"><?php esc_html_e('Edit Address', 'strollik5-core'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" title="<?php esc_html_e('Account Details', 'strollik5-core'); ?>"><?php esc_html_e('Account Details', 'strollik5-core'); ?></a>
                        </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo esc_url(get_dashboard_url(get_current_user_id())); ?>" title="<?php esc_html_e('Dashboard', 'strollik5-core'); ?>"><?php esc_html_e('Dashboard', 'strollik5-core'); ?></a>
                    </li>
                <?php endif; ?>
                <li>
                    <a title="<?php esc_html_e('Log out', 'strollik5-core'); ?>" class="tips" href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Log Out', 'strollik5-core'); ?></a>
                </li>
            </ul>
        <?php endif;

    }
}
$widgets_manager->register_widget_type(new OSF_Elementor_Account());
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * BMECOM Slider Widget.
 *
 * @since 1.0.0
 */
class BMECOM_Slider_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'bmecom-slider';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'BMECOM Slider', 'bmecomslider' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slides';
    }

    /**
     * Get widget categories.
     *
     * @since 1.0.0
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'general' ];
    }

    /**
     * Get script dependencies.
     *
     * @since 1.0.0
     *
     * @return array Script handles.
     */
    public function get_script_depends() {
        return [ 'bmecomslider' ];
    }

    /**
     * Get style dependencies.
     *
     * @since 1.0.0
     *
     * @return array Style handles.
     */
    public function get_style_depends() {
        return [ 'bmecomslider' ];
    }

    /**
     * Register widget controls.
     *
     * @since 1.0.0
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_slides',
            [
                'label' => __( 'Slides', 'bmecomslider' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'background_type',
            [
                'label' => __( 'Background Type', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'image' => [
                        'title' => __( 'Image', 'bmecomslider' ),
                        'icon' => 'eicon-image',
                    ],
                    'color' => [
                        'title' => __( 'Color', 'bmecomslider' ),
                        'icon' => 'eicon-paint-brush',
                    ],
                ],
                'default' => 'image',
            ]
        );

        $repeater->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'background_type' => 'color',
                ],
            ]
        );

        $repeater->add_control(
            'desktop_image',
            [
                'label' => __( 'Desktop Image', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'background_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'tablet_image',
            [
                'label' => __( 'Tablet Image', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'background_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'mobile_image',
            [
                'label' => __( 'Mobile Image', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'background_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'slide_link',
            [
                'label' => __( 'Link', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'bmecomslider' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'background_size',
            [
                'label' => __( 'Background Size', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'responsive' => true,
                'options' => [
                    'auto' => __( 'Auto', 'bmecomslider' ),
                    'cover' => __( 'Cover', 'bmecomslider' ),
                    'contain' => __( 'Contain', 'bmecomslider' ),
                ],
                'default' => 'cover',
            ]
        );

        $repeater->add_control(
            'heading',
            [
                'label' => __( 'Heading', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Slide Heading', 'bmecomslider' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Slide description content.', 'bmecomslider' ),
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Click Here', 'bmecomslider' ),
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => __( 'Button Link', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'bmecomslider' ),
            ]
        );

        $repeater->add_control(
            'background_overlay',
            [
                'label' => __( 'Background Overlay', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'bmecomslider' ),
                'label_off' => __( 'Hide', 'bmecomslider' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'background_overlay_color',
            [
                'label' => __( 'Overlay Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'background_overlay' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'background_position',
            [
                'label' => __( 'Background Position', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'responsive' => true,
                'options' => [
                    'center center' => __( 'Center Center', 'bmecomslider' ),
                    'center left' => __( 'Center Left', 'bmecomslider' ),
                    'center right' => __( 'Center Right', 'bmecomslider' ),
                    'top center' => __( 'Top Center', 'bmecomslider' ),
                    'top left' => __( 'Top Left', 'bmecomslider' ),
                    'top right' => __( 'Top Right', 'bmecomslider' ),
                    'bottom center' => __( 'Bottom Center', 'bmecomslider' ),
                    'bottom left' => __( 'Bottom Left', 'bmecomslider' ),
                    'bottom right' => __( 'Bottom Right', 'bmecomslider' ),
                ],
                'default' => 'center center',
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => __( 'Arrow Border Radius', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slider-arrow' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __( 'Slides', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'heading' => __( 'Slide 1 Title', 'bmecomslider' ),
                    ],
                    [
                        'heading' => __( 'Slide 2 Title', 'bmecomslider' ),
                    ],
                ],
                'title_field' => '{{{ heading }}}',
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __( 'Animation Speed (ms)', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 5000,
                'step' => 50,
                'default' => 500,
                'selectors' => [
                    '{{WRAPPER}} .animation-slide .bmecom-slider' => 'transition-duration: {{SIZE}}ms',
                ],
                'condition' => [
                    'animation' => 'slide',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_height',
            [
                'label' => __( 'Height', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'vh' ],
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slider-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bmecom-slide-button',
            ]
        );

        $this->start_controls_tabs( 'button_style_tabs' );

        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => __( 'Normal', 'bmecomslider' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slide-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slide-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => __( 'Hover', 'bmecomslider' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slide-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __( 'Background Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slide-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slide-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_position',
            [
                'label' => __( 'Content Position', 'bmecomslider' ),
            ]
        );

        $this->add_responsive_control(
            'content_horizontal_position',
            [
                'label' => __( 'Horizontal Position', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slide-content' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_vertical_position',
            [
                'label' => __( 'Vertical Position', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slide-content' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_behavior',
            [
                'label' => __( 'Slider Behavior', 'bmecomslider' ),
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'bmecomslider' ),
                'label_off' => __( 'Off', 'bmecomslider' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'slide_timing',
            [
                'label' => __( 'Slide Timing (ms)', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 20000,
                'step' => 100,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => __( 'Pause on Hover', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'bmecomslider' ),
                'label_off' => __( 'Off', 'bmecomslider' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Loop', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'bmecomslider' ),
                'label_off' => __( 'Off', 'bmecomslider' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_animation',
            [
                'label' => __( 'Animation', 'bmecomslider' ),
            ]
        );

        $this->add_control(
            'animation',
            [
                'label' => __( 'Animation', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'fade' => __( 'Fade', 'bmecomslider' ),
                    'slide' => __( 'Slide', 'bmecomslider' ),
                    'zoom' => __( 'Zoom', 'bmecomslider' ),
                ],
                'default' => 'fade',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Content', 'bmecomslider' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_style',
            [
                'label' => __( 'Heading', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .bmecom-slide-heading',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __( 'Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slide-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_style',
            [
                'label' => __( 'Description', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .bmecom-slide-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slide-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_button',
            [
                'label' => __( 'Button', 'bmecomslider' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_navigation',
            [
                'label' => __( 'Navigation', 'bmecomslider' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __( 'Arrows', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'bmecomslider' ),
                'label_off' => __( 'Off', 'bmecomslider' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __( 'Arrow Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slider-arrow' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_background_color',
            [
                'label' => __( 'Arrow Background Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slider-arrow' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __( 'Dots', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'bmecomslider' ),
                'label_off' => __( 'Off', 'bmecomslider' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __( 'Dots Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slider-dots .bmecom-slider-dot' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_color_active',
            [
                'label' => __( 'Dots Active Color', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bmecom-slider-dots .bmecom-slider-dot.active' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'dots' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * @since 1.0.0
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        ?>
        <div class="bmecom-slider-wrapper bmecom-slider-wrapper-<?php echo esc_attr( $id ); ?> animation-<?php echo esc_attr( $settings['animation'] ); ?>">
            <div class="bmecom-slider"
                 data-animation="<?php echo esc_attr( $settings['animation'] ); ?>"
                 data-autoplay="<?php echo esc_attr( $settings['autoplay'] ); ?>"
                 data-slide-timing="<?php echo esc_attr( $settings['slide_timing'] ); ?>"
                 data-pause-on-hover="<?php echo esc_attr( $settings['pause_on_hover'] ); ?>"
                 data-loop="<?php echo esc_attr( $settings['loop'] ); ?>">
                <?php
                $style_blocks = '';
                foreach ( $settings['slides'] as $index => $slide ) :
                    $slide_style = 'background-size: ' . esc_attr( $slide['background_size'] ) . ';';
                    $slide_style .= 'background-position: ' . esc_attr( $slide['background_position'] ) . ';';

                    if ( $slide['background_type'] === 'color' ) {
                        $slide_style .= 'background-color: ' . esc_attr( $slide['background_color'] ) . ';';
                    } else {
                        if ($index !== 0) {
                            $slide_style .= 'background-image: none;';
                        } else {
                            $slide_style .= 'background-image: url(' . esc_url( $slide['desktop_image']['url'] ) . ');';
                        }

                        $tablet_image = ! empty( $slide['tablet_image']['url'] ) ? $slide['tablet_image']['url'] : $slide['desktop_image']['url'];
                        $mobile_image = ! empty( $slide['mobile_image']['url'] ) ? $slide['mobile_image']['url'] : $slide['desktop_image']['url'];

                        $background_size_tablet = !empty($slide['background_size_tablet']) ? $slide['background_size_tablet'] : $slide['background_size'];
                        $background_position_tablet = !empty($slide['background_position_tablet']) ? $slide['background_position_tablet'] : $slide['background_position'];
                        $background_size_mobile = !empty($slide['background_size_mobile']) ? $slide['background_size_mobile'] : $slide['background_size'];
                        $background_position_mobile = !empty($slide['background_position_mobile']) ? $slide['background_position_mobile'] : $slide['background_position'];

                        $style_blocks .= "
                            @media (max-width: 1024px) {
                                .bmecom-slider-wrapper-{$id} .bmecom-slide-{$id}-{$index} {
                                    background-image: url(" . esc_url( $tablet_image ) . ") !important;
                                    background-size: " . esc_attr( $background_size_tablet ) . " !important;
                                    background-position: " . esc_attr( $background_position_tablet ) . " !important;
                                }
                            }
                            @media (max-width: 767px) {
                                .bmecom-slider-wrapper-{$id} .bmecom-slide-{$id}-{$index} {
                                    background-image: url(" . esc_url( $mobile_image ) . ") !important;
                                    background-size: " . esc_attr( $background_size_mobile ) . " !important;
                                    background-position: " . esc_attr( $background_position_mobile ) . " !important;
                                }
                            }
                        ";
                    }
                    ?>
                    <div class="bmecom-slide bmecom-slide-<?php echo $id; ?>-<?php echo $index; ?>"
                         style="<?php echo $slide_style; ?>"
                         data-desktop-image="<?php echo esc_url( $slide['desktop_image']['url'] ); ?>"
                         data-tablet-image="<?php echo esc_url( $tablet_image ); ?>"
                         data-mobile-image="<?php echo esc_url( $mobile_image ); ?>"
                         data-background-type="<?php echo esc_attr( $slide['background_type'] ); ?>"
                         aria-label="<?php echo esc_attr( $slide['heading'] ); ?>">

                        <?php if ( 'yes' === $slide['background_overlay'] ) : ?>
                            <div class="bmecom-slide-overlay" style="background-color: <?php echo esc_attr( $slide['background_overlay_color'] ); ?>"></div>
                        <?php endif; ?>

                        <?php
                        $has_button_link = ! empty( $slide['button_text'] ) && ! empty( $slide['button_link']['url'] );
                        if ( ! empty( $slide['slide_link']['url'] ) && ! $has_button_link ) {
                            $this->add_link_attributes( 'slide-link-' . $index, $slide['slide_link'] );
                            echo '<a ' . $this->get_render_attribute_string( 'slide-link-' . $index ) . '>';
                        }
                        ?>

                        <div class="bmecom-slide-content">
                            <?php if ( ! empty( $slide['heading'] ) ) : ?>
                                <h2 class="bmecom-slide-heading"><?php echo esc_html( $slide['heading'] ); ?></h2>
                            <?php endif; ?>
                            <?php if ( ! empty( $slide['description'] ) ) : ?>
                                <p class="bmecom-slide-description"><?php echo esc_html( $slide['description'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $slide['button_text'] ) && ! empty( $slide['button_link']['url'] ) ) :
                                $this->add_link_attributes( 'button-link-' . $index, $slide['button_link'] );
                                ?>
                                <a <?php echo $this->get_render_attribute_string( 'button-link-' . $index ); ?> class="bmecom-slide-button">
                                    <?php echo esc_html( $slide['button_text'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php
                        if ( ! empty( $slide['slide_link']['url'] ) && ! $has_button_link ) {
                            echo '</a>';
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <style>
                <?php echo $style_blocks; ?>
            </style>
            <?php if ( $settings['arrows'] === 'yes' ) : ?>
                <div class="bmecom-slider-arrows">
                    <button class="bmecom-slider-arrow prev">&lt;</button>
                    <button class="bmecom-slider-arrow next">&gt;</button>
                </div>
            <?php endif; ?>
            <?php if ( $settings['dots'] === 'yes' ) : ?>
                <div class="bmecom-slider-dots"></div>
            <?php endif; ?>
        </div>
        <?php
    }

}

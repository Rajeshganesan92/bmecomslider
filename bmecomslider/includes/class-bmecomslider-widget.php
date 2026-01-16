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
            'slide_title',
            [
                'label' => __( 'Title', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Slide Title', 'bmecomslider' ),
                'label_block' => true,
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

        $this->add_control(
            'slides',
            [
                'label' => __( 'Slides', 'bmecomslider' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_title' => __( 'Slide 1 Title', 'bmecomslider' ),
                    ],
                    [
                        'slide_title' => __( 'Slide 2 Title', 'bmecomslider' ),
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
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
            'section_navigation',
            [
                'label' => __( 'Navigation', 'bmecomslider' ),
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

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * @since 1.0.0
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="bmecom-slider-wrapper">
            <div class="bmecom-slider"
                 data-animation="<?php echo esc_attr( $settings['animation'] ); ?>"
                 data-autoplay="<?php echo esc_attr( $settings['autoplay'] ); ?>"
                 data-slide-timing="<?php echo esc_attr( $settings['slide_timing'] ); ?>"
                 data-pause-on-hover="<?php echo esc_attr( $settings['pause_on_hover'] ); ?>"
                 data-loop="<?php echo esc_attr( $settings['loop'] ); ?>">
                <?php $first = true; ?>
                <?php foreach ( $settings['slides'] as $slide ) : ?>
                    <div class="bmecom-slide">
                        <?php
                        $link_tag = '';
                        if ( ! empty( $slide['slide_link']['url'] ) ) {
                            $this->add_link_attributes( 'link_tag', $slide['slide_link'] );
                            echo '<a ' . $this->get_render_attribute_string( 'link_tag' ) . '>';
                        }
                        ?>
                        <picture>
                            <source media="(max-width: 767px)" <?php echo $first ? 'srcset' : 'data-srcset'; ?>="<?php echo esc_url( ! empty( $slide['mobile_image']['url'] ) ? $slide['mobile_image']['url'] : $slide['desktop_image']['url'] ); ?>">
                            <source media="(max-width: 1024px)" <?php echo $first ? 'srcset' : 'data-srcset'; ?>="<?php echo esc_url( ! empty( $slide['tablet_image']['url'] ) ? $slide['tablet_image']['url'] : $slide['desktop_image']['url'] ); ?>">
                            <img <?php echo $first ? 'src' : 'data-src'; ?>="<?php echo esc_url( $slide['desktop_image']['url'] ); ?>" alt="<?php echo esc_attr( $slide['slide_title'] ); ?>" loading="lazy">
                        </picture>
                        <?php
                        if ( ! empty( $slide['slide_link']['url'] ) ) {
                            echo '</a>';
                        }
                        ?>
                    </div>
                <?php $first = false; ?>
                <?php endforeach; ?>
            </div>
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

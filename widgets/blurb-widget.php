<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Blurb Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Blurb_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Blurb widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'blurb';
    }

    /**
     * Get widget title.
     *
     * Retrieve Blurb widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Blurb', 'elementor-blurb-widget' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Blurb widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-instagram-comments';
    }

    /**
     * Get custom help URL.
     *
     * Retrieve a URL where the user can get more information about the widget.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget help URL.
     */
    public function get_custom_help_url() {
        return 'https://developers.elementor.com/docs/widgets/';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Blurb widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'general' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the Blurb widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'blurb', 'custom' ];
    }

    /**
     * Register Blurb widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Image', 'custom-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Image Upload', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'elementor-list-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'headline',
            [
                'label' => esc_html__( 'Headline', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your headline', 'custom-elementor-widget' ),
            ]
        );

        $this->add_control(
            'blurb',
            [
                'label' => esc_html__( 'Blurb', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your content here', 'custom-elementor-widget' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'elementor-list-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_label',
            [
                'label' => esc_html__( 'Button Label', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your label', 'custom-elementor-widget' ),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Button Link URL', 'custom-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'custom-elementor-widget' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
    }

    /**
     * Render Blurb widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
?>
        <div class="blurb-elementor-widget">
            <div class="blurb-image-container">
                <?php echo wp_get_attachment_image( $settings['image']['id'], 'thumbnail' ); ?>
            </div>
            <p><?php echo $settings['headline']; ?></p>
            <div><?php echo $settings['blurb']; ?></div>
            <div class="elementor-button-wrapper">
                <a class="elementor-button-link" href="<?php echo $settings['button_link']['url']; ?>">
                    <?php echo $settings['button_label']; ?>
                </a>
            </div>
        </div>
<?php
    }

    protected function content_template() {
		?>
		<img src="{{{ settings.image.url }}}">
		<p class="{{ settings.class }}">{{{ settings.headline }}}</p>
        <div>{{{ settings.blurb }}}</div>
            <div class="elementor-button-wrapper">
                <a class="elementor-button-link" href="{{ settings.button_link.url }}">
                    {{{ settings.blurb_label }}}
                </a>
            </div>
		<?php
	}

}
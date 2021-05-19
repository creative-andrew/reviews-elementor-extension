<?php
class TripAdvisorReview extends \Elementor\Widget_Base {

		/**
	 * Get widget name.
	 *
	 * Retrieve Trip Advisor Reviews widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function __construct( $data=[], $args=null ){
		parent::__construct( $data, $args );
		wp_enqueue_style( 'trip-advisor-elementor-widget-css', plugin_dir_url(__FILE__) . '../assets/trip_advisor_review.css');
		wp_enqueue_script( 'trip-advisor-widget-js', plugin_dir_url(__FILE__) . '../assets/trip_advisor_review.js' );
	}


	public function get_name() {
		return 'ca-reviews';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Trip Advisor Reviews widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Trip Advisor Rewiews', 'creative-andrew-elementor-blocks' );
	}


	/**
	 * Get widget icon.
	 *
	 * Retrieve Trip Advisor Reviews widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-code';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Trip Advisor Reviews widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'creative-andrew-blocks-category' ];
	}

	/**
	 * Register Trip Advisor Reviews widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label' => __( 'Name', 'creative-andrew-elementor-blocks' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Add the name of the review' , 'creative-andrew-elementor-blocks' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'label', [
				'label' => __( 'Label', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'verified guest' , 'creative-andrew-elementor-blocks' ),
				'show_label' => true,
			]
		);

		$repeater->add_control(
			'content', [
				'label' => __( 'Content', 'creative-andrew-elementor-blocks' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Review content' , 'creative-andrew-elementor-blocks' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Trip Advisor Reviews widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['list'] ) {
			echo '<div class="ca-reviews"> <div class="slider">';
			$count = 1;
			$section_counter = 1;
			foreach (  $settings['list'] as $item ) {
				if($count % 5 == 1) { 
				?>
					<div class="slide-content padded slider-number<?php echo $section_counter;?> 
						<?php if ($count == 1) {echo ' active'; }  ?>
					">
				<?php	
				$section_counter++;
			}
			?>
				<div class="rev-box">
					<h3><?php echo $item['name'] ?></h3>
					<p class="verified-g"><span>&#10003;</span> <?php  echo $item['label']?></p>
					<p class="teext"><?php  echo $item['content']?></p>
				</div>
				<?php if ($count%5 == 0) {
				echo '</div>';
				}
				$count++;
				?> 
			<?}

			if ($count%5 != 1) echo "</div>";
			?>
				</div>
			<div class="ca-controlers">
			<?php
	
				for ($x = 0; $x < (round($count/5,0, PHP_ROUND_HALF_DOWN)); $x++ ) {
					$value = $x + 1;
					echo "<span class='" . ($x == 0 ? 'control-active' : false ) . "'>$value</span>";
				}
			?>
			</div>
			</div>
			<?php
		}
	}



}
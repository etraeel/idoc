<?php
namespace DoclyCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use WP_Query;
use WP_Post;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Forums
 * @package DoclyCore\Widgets
 */
class Forums extends Widget_Base {

	public function get_name() {
		return 'Docly_forums';
	}

	public function get_title() {
		return __( 'Forums', 'docly-core' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'docly-elements' ];
	}

	protected function register_controls() {

		// --- Filter Options
		$this->start_controls_section(
			'filter_opt', [
				'label' => __( 'Filter Options', 'docly-core' ),
			]
		);

		$this->add_control(
			'ppp', [
				'label' => esc_html__( 'Show Forums', 'docly-core' ),
				'description' => esc_html__( 'Show the forums count at the initial view. Default is 5 forums in a row.', 'docly-core' ),
				'type' => Controls_Manager::NUMBER,
				'label_block' => true,
				'default' => 5
			]
		);

		$this->add_control(
			'ppp2', [
				'label' => esc_html__( 'Hidden Forums', 'docly-core' ),
				'description' => esc_html__( 'Hidden forums will show on clicking on the More button.', 'docly-core' ),
				'type' => Controls_Manager::NUMBER,
				'label_block' => true,
				'default' => 10
			]
		);

		$this->add_control(
			'order', [
				'label' => esc_html__( 'Order', 'docly-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => 'ASC',
					'DESC' => 'DESC'
				],
				'default' => 'ASC'
			]
		);

		$this->add_control(
			'more_txt', [
				'label' => esc_html__( 'Read More Text', 'docly-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'More Communities'
			]
		);

		$this->end_controls_section();
		// end Document Setting Section
	}

	protected function render() {
		$settings = $this->get_settings();
		$forums = new WP_Query(array(
			'post_type' => 'forum',
			'posts_per_page' => !empty($settings['ppp']) ? $settings['ppp'] : 5,
			'order' => $settings['order'],
		));
		?>
		<div class="communities-boxes">
			<?php
			while( $forums->have_posts() ) : $forums->the_post();
				?>
				<div class="docly-com-box wow fadeInRight" data-wow-delay="0.5s">
					<div class="icon-container">
						<?php the_post_thumbnail('full'); ?>
					</div>
					<div class="docly-com-box-content">
						<h3 class="title">
							<a href="<?php the_permalink(); ?>"> <?php the_title() ?> </a>
						</h3>
						<p class="total-post"> <?php bbp_forum_topic_count(get_the_ID()); ?> <?php esc_html_e('Posts', 'docly') ?> </p>
					</div>
					<!-- /.docly-com-box-content -->
				</div>
				<!-- /.docly-com-box -->
				<?php
		    endwhile;
		    wp_reset_postdata();
		    ?>
		</div>
		<!-- /.communities-boxes -->

		<div class="more-communities">

			<a href="#more-category" class="collapse-btn">
                <?php echo esc_html($settings['more_txt']) ?> <i class="icon_plus"></i>
            </a>

			<div class="collapse-wrap" id="more-category">
				<div class="communities-boxes">
					<?php
					$forums2 = new WP_Query(array(
						'post_type' => 'forum',
						'posts_per_page' => !empty($settings['ppp2']) ? $settings['ppp2'] : 10,
                        'offset' => !empty($settings['ppp']) ? $settings['ppp'] : 5,
						'order' => $settings['order'],
					));
					while( $forums2->have_posts() ) : $forums2->the_post();
						?>
						<div class="docly-com-box">
							<div class="icon-container">
								<?php the_post_thumbnail('full'); ?>
							</div>
							<div class="docly-com-box-content">
								<h3 class="title">
									<a href="<?php the_permalink(); ?>"> <?php the_title() ?> </a>
								</h3>
								<p class="total-post"> <?php bbp_forum_topic_count(get_the_ID()); ?> <?php esc_html_e('Posts', 'docly-core') ?> </p>
							</div>
							<!-- /.docly-com-box-content -->
						</div>
						<!-- /.docly-com-box -->
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<!-- /.communities-boxes -->
			</div>
			<!-- /.collapse-wrap -->
		</div>
		<!-- /.more-communities -->
		<?php
	}
}
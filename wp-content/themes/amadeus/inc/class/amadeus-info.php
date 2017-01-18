<?php
/**
 * Class to display upsells.
 *
 * @package WordPress
 * @subpackage Amadeus
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Class Amadeus_Info
 */
class Amadeus_Info extends WP_Customize_Control {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'info';

	/**
	 * Control label
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $label = '';

	/**
	 * The render function for the controler
	 */
	public function render_content() {
		$links = array(
			array(
				'name' => __( 'Documentation','amadeus' ),
				'link' => esc_url( 'http://docs.themeisle.com/article/270-amadeus-documentation' ),
			),
			array(
				'name' => __( 'View Demo','amadeus' ),
				'link' => esc_url( 'https://themeisle.com/demo/?theme=Amadeus' ),
			),
			array(
				'name' => __( 'Free VS Pro','amadeus' ),
				'link' => esc_url( 'http://docs.themeisle.com/article/531-what-is-the-difference-between-amadeus-and-amadeus-pro' ),
			),
			array(
				'name' => __( 'Leave a review','amadeus' ),
				'link' => esc_url( 'https://wordpress.org/support/theme/amadeus/reviews/#new-post/' ),
			),
		); ?>


		<div class="amadeus-theme-info">
			<?php
			foreach ( $links as $item ) {  ?>
				<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank"><?php echo esc_html( $item['name'] ); ?></a>
				<hr/>
				<?php
			} ?>
		</div>
		<?php
	}
}

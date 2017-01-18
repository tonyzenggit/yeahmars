<?php
/**
 * Banner
 *
 * @package Amadeus
 */

/**
 * Function that shows the banner.
 */
function amadeus_banner() {

	if ( get_theme_mod( 'hide_banner' ) && ! is_front_page() ) {
		return;
	}

	if ( (get_theme_mod( 'banner_type', 'image' ) == 'image') && get_header_image() ) {
		echo '<div class="header-image">';
		if ( ! get_theme_mod( 'hide_scroll' ) ) {
			echo '<div class="header-scroll">';
				echo '<a href="#primary" class="scroll-icon"><i class="fa fa-angle-down"></i></a>';
			echo '</div>';
		}
		echo '</div>';
	} elseif ( get_theme_mod( 'banner_type', 'image' ) == 'slider' ) {
		$shortcode = get_theme_mod( 'metaslider_shortcode' );
		echo '<div class="header-slider">';
	    	echo do_shortcode( $shortcode );
	    echo '</div>';
	}
}

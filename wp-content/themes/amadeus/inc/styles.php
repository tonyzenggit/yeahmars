<?php
/**
 * Custom styles
 *
 * @package Amadeus
 */

/**
 * Dynamic styles
 */
function amadeus_custom_styles() {

	$custom = '';

	// Header padding
	$branding_padding = get_theme_mod( 'branding_padding', '75' );
	$custom .= '.site-branding { padding:' . intval( $branding_padding ) . 'px 0; }' . "\n";

	// Header image
	$header_img_height = get_theme_mod( 'header_img_height', '300' );
	$custom .= '.header-image { height:' . intval( $header_img_height ) . 'px; }' . "\n";
	$header_img_height_1024 = get_theme_mod( 'header_img_height_1024', '300' );
	$custom .= '@media only screen and (max-width: 1024px) { .header-image { height:' . intval( $header_img_height_1024 ) . 'px; } }' . "\n";
	// Logo size
	$logo_size = get_theme_mod( 'logo_size', '200' );
	$custom .= '.site-logo { max-width:' . intval( $logo_size ) . 'px; }' . "\n";
	$custom .= '.custom-logo { max-width:' . intval( $logo_size ) . 'px; }' . "\n";

	// Hide sidebar
	$hide_sidebar_index = get_theme_mod( 'hide_sidebar_index' );
	if ( $hide_sidebar_index && ! is_singular() ) {
		$custom .= '.content-area { float:none;margin-left:auto;margin-right:auto; }' . "\n";
	}
	$hide_sidebar_single = get_theme_mod( 'hide_sidebar_single' );
	if ( $hide_sidebar_single && is_singular() ) {
		$custom .= '.content-area { float:none;margin-left:auto;margin-right:auto; }' . "\n";
	}

	// Primary color
	$primary_color = get_theme_mod( 'primary_color', '#618EBA' );
	if ( $primary_color != '#618EBA' ) {
		$custom .= 'a, a:hover, .main-navigation a:hover, .nav-next a:hover, .nav-previous a:hover, .social-navigation li a:hover { color:' . esc_attr( $primary_color ) . ' !important;}' . "\n";
		$custom .= 'button, .button, input[type="button"], input[type="reset"], input[type="submit"], .entry-thumb-inner { background-color:' . esc_attr( $primary_color ) . '}' . "\n";
	}
	// Body
	$body_text = get_theme_mod( 'body_text_color', '#4c4c4c' );
	$custom .= 'body, .widget a { color:' . esc_attr( $body_text ) . '}' . "\n";
	// Social bg
	$social_bg = get_theme_mod( 'social_bg', '#fff' );
	$custom .= '.social-navigation { background-color:' . esc_attr( $social_bg ) . '}' . "\n";
	// Social color
	$social_color = get_theme_mod( 'social_color', '#1c1c1c' );
	$custom .= '.social-navigation li a::before { background-color:' . esc_attr( $social_color ) . '}' . "\n";
	// Branding wrapper
	$branding_bg = get_theme_mod( 'branding_bg', '#fff' );
	$custom .= '.branding-wrapper { background-color:' . esc_attr( $branding_bg ) . '}' . "\n";
	// Menu
	$menu_bg = get_theme_mod( 'menu_bg', '#fff' );
	$custom .= '.main-navigation { background-color:' . esc_attr( $menu_bg ) . '}' . "\n";
	// Menu items
	$menu_color = get_theme_mod( 'menu_color', '#1c1c1c' );
	$custom .= '.main-navigation a { color:' . esc_attr( $menu_color ) . ' !important;}' . "\n";

	// Site title
	$site_title = get_theme_mod( 'site_title_color', '#1c1c1c' );
	$custom .= '.site-title a, .site-title a:hover { color:' . esc_attr( $site_title ) . ' !important;}' . "\n";
	// Site desc
	$site_desc = get_theme_mod( 'site_desc_color', '#767676' );
	$custom .= '.site-description { color:' . esc_attr( $site_desc ) . '}' . "\n";
	// Entry titles
	$entry_titles = get_theme_mod( 'entry_titles', '#1c1c1c' );
	$custom .= '.entry-title, .entry-title a { color:' . esc_attr( $entry_titles ) . ' !important;}' . "\n";
	// Entry meta
	$entry_meta = get_theme_mod( 'entry_meta', '#9d9d9d' );
	$custom .= '.entry-meta, .entry-meta a, .entry-footer, .entry-footer a { color:' . esc_attr( $entry_meta ) . ' !important;}' . "\n";
	// Footer
	$footer_bg = get_theme_mod( 'footer_bg', '#fff' );
	$custom .= '.site-footer, .footer-widget-area { background-color:' . esc_attr( $footer_bg ) . '}' . "\n";

	// Fonts
	$body_fonts = get_theme_mod( 'body_font_family' );
	$headings_fonts = get_theme_mod( 'headings_font_family' );
	if ( $body_fonts != '' ) {
		$custom .= 'body { font-family:' . $body_fonts . ';}' . "\n";
	}
	if ( $headings_fonts != '' ) {
		$custom .= 'h1, h2, h3, h4, h5, h6 { font-family:' . $headings_fonts . ';}' . "\n";
	}
	// Site title
	$site_title_size = get_theme_mod( 'site_title_size', '62' );
	if ( get_theme_mod( 'site_title_size' ) ) {
		$custom .= '.site-title { font-size:' . intval( $site_title_size ) . 'px; }' . "\n";
	}
	// Site description
	$site_desc_size = get_theme_mod( 'site_desc_size', '18' );
	if ( get_theme_mod( 'site_desc_size' ) ) {
		$custom .= '.site-description { font-size:' . intval( $site_desc_size ) . 'px; }' . "\n";
	}
	// H1 size
	$h1_size = get_theme_mod( 'h1_size' );
	if ( get_theme_mod( 'h1_size' ) ) {
		$custom .= 'h1 { font-size:' . intval( $h1_size ) . 'px; }' . "\n";
	}
	// H2 size
	$h2_size = get_theme_mod( 'h2_size' );
	if ( get_theme_mod( 'h2_size' ) ) {
		$custom .= 'h2 { font-size:' . intval( $h2_size ) . 'px; }' . "\n";
	}
	// H3 size
	$h3_size = get_theme_mod( 'h3_size' );
	if ( get_theme_mod( 'h3_size' ) ) {
		$custom .= 'h3 { font-size:' . intval( $h3_size ) . 'px; }' . "\n";
	}
	// H4 size
	$h4_size = get_theme_mod( 'h4_size' );
	if ( get_theme_mod( 'h4_size' ) ) {
		$custom .= 'h4 { font-size:' . intval( $h4_size ) . 'px; }' . "\n";
	}
	// H5 size
	$h5_size = get_theme_mod( 'h5_size' );
	if ( get_theme_mod( 'h5_size' ) ) {
		$custom .= 'h5 { font-size:' . intval( $h5_size ) . 'px; }' . "\n";
	}
	// H6 size
	$h6_size = get_theme_mod( 'h6_size' );
	if ( get_theme_mod( 'h6_size' ) ) {
		$custom .= 'h6 { font-size:' . intval( $h6_size ) . 'px; }' . "\n";
	}
	// Body size
	$body_size = get_theme_mod( 'body_size' );
	if ( get_theme_mod( 'body_size' ) ) {
		$custom .= 'body { font-size:' . intval( $body_size ) . 'px; }' . "\n";
	}

	// Output all the styles
	wp_add_inline_style( 'amadeus-style', $custom );
}
add_action( 'wp_enqueue_scripts', 'amadeus_custom_styles' );

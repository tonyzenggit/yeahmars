<?php
/**
 * Amadeus Theme Customizer
 *
 * @package Amadeus
 */

/**
 * Register theme options.
 *
 * @param object $wp_customize Customizer object.
 */
function amadeus_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'header_image' )->panel         = 'amadeus_header_panel';
	$wp_customize->get_section( 'title_tagline' )->priority     = '9';
	$wp_customize->get_section( 'title_tagline' )->title        = __( 'Site branding', 'amadeus' );
	$wp_customize->get_section( 'title_tagline' )->panel        = 'amadeus_header_panel';
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_control( 'display_header_text' );

	require_once( 'class/amadeus-info.php' );
	$wp_customize->add_section('amadeus_theme_info', array(
		'title' => __( 'Theme info', 'amadeus' ),
		'priority' => 0,
	) );
	$wp_customize->add_setting('amadeus_theme_info', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'amadeus_sanitize_text',
	) );
	$wp_customize->add_control( new Amadeus_Info( $wp_customize, 'amadeus_theme_info', array(
		'section' => 'amadeus_theme_info',
		'priority' => 10,
	) ) );

	// ___General___//
	$wp_customize->add_section(
		'amadeus_general',
		array(
			'title' => __( 'General', 'amadeus' ),
			'priority' => 9,
		)
	);
	// Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'site_favicon',
			array(
				'label'          => __( 'Upload your favicon', 'amadeus' ),
				'type'           => 'image',
				'section'        => 'amadeus_general',
				'settings'       => 'site_favicon',
				'priority' => 10,
			)
		)
	);
	// ___Header area___//
	$wp_customize->add_panel( 'amadeus_header_panel', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Header area', 'amadeus' ),
	) );
	// Logo Upload
	$custom_logo = $wp_customize->get_control( 'custom_logo' );
	if ( ! empty( $custom_logo ) ) {
		$wp_customize->get_control( 'custom_logo' )->section = 'title_tagline' ;
		$wp_customize->get_control( 'custom_logo' )->priority = 11;
	} else {
		$wp_customize->add_setting(
			'site_logo',
			array(
				'default-image'     => '',
				'sanitize_callback' => 'esc_url_raw',

			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'site_logo',
				array(
					'label'    => __( 'Upload your logo', 'amadeus' ),
					'type'     => 'image',
					'section'  => 'title_tagline',
					'settings' => 'site_logo',
					'priority' => 11,
				)
			)
		);
	}
	// Logo size
	$wp_customize->add_setting(
		'logo_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '200',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'logo_size', array(
		'type'        => 'number',
		'priority'    => 12,
		'section'     => 'title_tagline',
		'label'       => __( 'Logo size', 'amadeus' ),
		'description' => __( 'Max-width for the logo. Default 200px', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 50,
			'max'   => 600,
			'step'  => 5,
		),
	) );
	// Logo style
	$wp_customize->add_setting(
		'logo_style',
		array(
			'default'           => 'hide-title',
			'sanitize_callback' => 'amadeus_sanitize_logo_style',
		)
	);
	$wp_customize->add_control(
		'logo_style',
		array(
			'type'          => 'radio',
			'label'         => __( 'Logo style', 'amadeus' ),
			'description'   => __( 'This option applies only if you are using a logo', 'amadeus' ),
			'section'       => 'title_tagline',
			'priority'      => 13,
			'choices'       => array(
				'hide-title'  => __( 'Only logo', 'amadeus' ),
				'show-title'  => __( 'Logo plus site title&amp;description', 'amadeus' ),
			),
		)
	);
	// Padding
	$wp_customize->add_setting(
		'branding_padding',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '75',
		)
	);
	$wp_customize->add_control( 'branding_padding', array(
		'type'        => 'number',
		'priority'    => 14,
		'section'     => 'title_tagline',
		'label'       => __( 'Site branding padding', 'amadeus' ),
		'description' => __( 'Top&amp;bottom padding for the branding (logo, site title, description). Default: 75px', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 20,
			'max'   => 200,
			'step'  => 5,
		),
	) );

	// ___Menu___//
	$wp_customize->add_section(
		'amadeus_menu',
		array(
			'title'    => __( 'Menu position', 'amadeus' ),
			'priority' => 13,
			'panel'    => 'amadeus_header_panel',
		)
	);
	// Menu position
	$wp_customize->add_setting(
		'menu_position',
		array(
			'default'           => 'below',
			'sanitize_callback' => 'amadeus_sanitize_menu_position',
		)
	);
	$wp_customize->add_control(
		'menu_position',
		array(
			'type'          => 'radio',
			'label'         => __( 'Menu position', 'amadeus' ),
			'section'       => 'amadeus_menu',
			'priority'      => 15,
			'choices'       => array(
				'above'  => __( 'Above site title/description', 'amadeus' ),
				'below'  => __( 'Below site title/description', 'amadeus' ),
			),
		)
	);

	// ___Banner type___//
	$wp_customize->add_section(
		'amadeus_banner',
		array(
			'title'    => __( 'Banner type', 'amadeus' ),
			'priority' => 11,
			'panel'    => 'amadeus_header_panel',
		)
	);
	// Banner type
	$wp_customize->add_setting(
		'banner_type',
		array(
			'default'           => 'image',
			'sanitize_callback' => 'amadeus_sanitize_banner',
		)
	);
	$wp_customize->add_control(
		'banner_type',
		array(
			'type'          => 'radio',
			'label'         => __( 'Banner type', 'amadeus' ),
			'section'       => 'amadeus_banner',
			'priority'      => 16,
			'choices'       => array(
				'image'    => __( 'Header image', 'amadeus' ),
				'slider'   => __( 'Nivo Slider (requires the Nivo Slider plugin)', 'amadeus' ),
				'nothing'  => __( 'Nothing', 'amadeus' ),
			),
		)
	);
	// Hide banner
	$wp_customize->add_setting(
		'hide_banner',
		array(
			'sanitize_callback' => 'amadeus_sanitize_checkbox',
			'default' => 0,
		)
	);
	$wp_customize->add_control(
		'hide_banner',
		array(
			'type' => 'checkbox',
			'label' => __( 'Show the banner only on the homepage?', 'amadeus' ),
			'section' => 'amadeus_banner',
			'priority' => 17,
		)
	);
	// Meta shortcode
	$wp_customize->add_setting(
		'metaslider_shortcode',
		array(
			'default' => '',
			'sanitize_callback' => 'amadeus_sanitize_text',
		)
	);

	$amadeus_nivo_shortcode_desc = __( 'Add the shortcode for the Nivo Slider plugin here','amadeus' );

	if ( ! class_exists( 'WordPress_Nivo_Slider_Lite' ) ) {
		$amadeus_nivo_shortcode_desc = sprintf( __( 'Add the shortcode for the %s plugin here','amadeus' ), sprintf( '<a href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=nivo-slider-lite' ), 'install-plugin_nivo-slider-lite' ) ) . '" >%s</a>', 'Nivo Slider' ) );
	}

	$wp_customize->add_control(
		'metaslider_shortcode',
		array(
			'label' => __( 'Nivo Slider shortcode', 'amadeus' ),
			'description'  => $amadeus_nivo_shortcode_desc,
			'section' => 'amadeus_banner',
			'type' => 'text',
			'priority' => 18,
		)
	);

	// Header image
	$wp_customize->add_setting(
		'header_img_height',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '300',
		)
	);
	$wp_customize->add_control( 'header_img_height', array(
		'type'        => 'number',
		'priority'    => 19,
		'section'     => 'header_image',
		'label'       => __( 'Header image height', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 50,
			'max'   => 650,
			'step'  => 5,
		),
	) );
	// Header image <1024
	$wp_customize->add_setting(
		'header_img_height_1024',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '300',
		)
	);
	$wp_customize->add_control( 'header_img_height_1024', array(
		'type'        => 'number',
		'priority'    => 20,
		'section'     => 'header_image',
		'label'       => __( 'Header image height < 1024px', 'amadeus' ),
		'description' => __( 'Set your header image height for screen widths smaller than 1024px', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 50,
			'max'   => 650,
			'step'  => 5,
		),
	) );
	// Hide scroll arrow
	$wp_customize->add_setting(
		'hide_scroll',
		array(
			'sanitize_callback' => 'amadeus_sanitize_checkbox',
			'default' => 0,
		)
	);
	$wp_customize->add_control(
		'hide_scroll',
		array(
			'type' => 'checkbox',
			'label' => __( 'Hide the animated scroll arrow from the header image?', 'amadeus' ),
			'section' => 'header_image',
			'priority' => 21,
		)
	);

	// ___Blog options___//
	$wp_customize->add_section(
		'blog_options',
		array(
			'title' => __( 'Blog options', 'amadeus' ),
			'priority' => 13,
		)
	);
	// Excerpt
	$wp_customize->add_setting(
		'exc_lenght',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '55',
		)
	);
	$wp_customize->add_control( 'exc_lenght', array(
		'type'        => 'number',
		'priority'    => 10,
		'section'     => 'blog_options',
		'label'       => __( 'Excerpt length', 'amadeus' ),
		'description' => __( 'Choose your excerpt length. Default: 55 words', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 200,
			'step'  => 5,
		),
	) );
	// Hide meta
	$wp_customize->add_setting(
		'meta_index',
		array(
			'sanitize_callback' => 'amadeus_sanitize_checkbox',
			'default' => 0,
		)
	);
	$wp_customize->add_control(
		'meta_index',
		array(
			'type' => 'checkbox',
			'label' => __( 'Hide date/author/archives on index?', 'amadeus' ),
			'section' => 'blog_options',
			'priority' => 11,
		)
	);
	$wp_customize->add_setting(
		'meta_singles',
		array(
			'sanitize_callback' => 'amadeus_sanitize_checkbox',
			'default' => 0,
		)
	);
	$wp_customize->add_control(
		'meta_singles',
		array(
			'type' => 'checkbox',
			'label' => __( 'Hide date/author/archives on single posts?', 'amadeus' ),
			'section' => 'blog_options',
			'priority' => 12,
		)
	);
	$wp_customize->add_setting(
		'hide_sidebar_index',
		array(
			'sanitize_callback' => 'amadeus_sanitize_checkbox',
			'default' => 0,
		)
	);
	$wp_customize->add_control(
		'hide_sidebar_index',
		array(
			'type' => 'checkbox',
			'label' => __( 'Hide the sidebar on index?', 'amadeus' ),
			'section' => 'blog_options',
			'priority' => 13,
		)
	);
	$wp_customize->add_setting(
		'hide_sidebar_single',
		array(
			'sanitize_callback' => 'amadeus_sanitize_checkbox',
			'default' => 0,
		)
	);
	$wp_customize->add_control(
		'hide_sidebar_single',
		array(
			'type' => 'checkbox',
			'label' => __( 'Hide the sidebar on single posts and pages?', 'amadeus' ),
			'section' => 'blog_options',
			'priority' => 13,
		)
	);
	// Full content posts
	$wp_customize->add_setting(
		'full_content',
		array(
			'sanitize_callback' => 'amadeus_sanitize_checkbox',
			'default' => 0,
		)
	);
	$wp_customize->add_control(
		'full_content',
		array(
			'type' => 'checkbox',
			'label' => __( 'Display the full content of your posts on index?', 'amadeus' ),
			'section' => 'blog_options',
			'priority' => 14,
		)
	);
	// Index images
	$wp_customize->add_setting(
		'index_feat_image',
		array(
			'sanitize_callback' => 'amadeus_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'index_feat_image',
		array(
			'type' => 'checkbox',
			'label' => __( 'Hide featured images on index, archives?', 'amadeus' ),
			'section' => 'blog_options',
			'priority' => 15,
		)
	);
	// Post images
	$wp_customize->add_setting(
		'post_feat_image',
		array(
			'sanitize_callback' => 'amadeus_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'post_feat_image',
		array(
			'type' => 'checkbox',
			'label' => __( 'Hide featured images on single posts?', 'amadeus' ),
			'section' => 'blog_options',
			'priority' => 16,
		)
	);

	// ___Colors___//
	// Primary color
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => '#618EBA',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'label'         => __( 'Primary color', 'amadeus' ),
				'section'       => 'colors',
				'settings'      => 'primary_color',
				'priority'      => 12,
			)
		)
	);

	// Social background
	$wp_customize->add_setting(
		'social_bg',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'social_bg',
			array(
				'label'         => __( 'Social area background', 'amadeus' ),
				'section'       => 'colors',
				'settings'      => 'social_bg',
				'priority'      => 13,
			)
		)
	);
	// Social color
	$wp_customize->add_setting(
		'social_color',
		array(
			'default'           => '#1c1c1c',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'social_color',
			array(
				'label'         => __( 'Social icons', 'amadeus' ),
				'section'       => 'colors',
				'settings'      => 'social_color',
				'priority'      => 14,
			)
		)
	);
	// Branding wrapper
	$wp_customize->add_setting(
		'branding_bg',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'branding_bg',
			array(
				'label'         => __( 'Branding background', 'amadeus' ),
				'section'       => 'colors',
				'settings'      => 'branding_bg',
				'priority'      => 15,
			)
		)
	);
	// Menu
	$wp_customize->add_setting(
		'menu_bg',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_bg',
			array(
				'label'         => __( 'Menu background', 'amadeus' ),
				'section'       => 'colors',
				'settings'      => 'menu_bg',
				'priority'      => 16,
			)
		)
	);
	// Menu items
	$wp_customize->add_setting(
		'menu_color',
		array(
			'default'           => '#1c1c1c',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_color',
			array(
				'label'         => __( 'Menu items', 'amadeus' ),
				'section'       => 'colors',
				'settings'      => 'menu_color',
				'priority'      => 17,
			)
		)
	);
	// Site title
	$wp_customize->add_setting(
		'site_title_color',
		array(
			'default'           => '#1c1c1c',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_title_color',
			array(
				'label' => __( 'Site title', 'amadeus' ),
				'section' => 'colors',
				'settings' => 'site_title_color',
				'priority' => 18,
			)
		)
	);
	// Site desc
	$wp_customize->add_setting(
		'site_desc_color',
		array(
			'default'           => '#767676',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_desc_color',
			array(
				'label' => __( 'Site description', 'amadeus' ),
				'section' => 'colors',
				'priority' => 19,
			)
		)
	);
	// Entry titles
	$wp_customize->add_setting(
		'entry_titles',
		array(
			'default'           => '#1c1c1c',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entry_titles',
			array(
				'label' => __( 'Entry titles', 'amadeus' ),
				'section' => 'colors',
				'priority' => 20,
			)
		)
	);
	// Entry meta
	$wp_customize->add_setting(
		'entry_meta',
		array(
			'default'           => '#9d9d9d',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entry_meta',
			array(
				'label' => __( 'Entry meta', 'amadeus' ),
				'section' => 'colors',
				'priority' => 21,
			)
		)
	);
	// Body
	$wp_customize->add_setting(
		'body_text_color',
		array(
			'default'           => '#4c4c4c',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_text_color',
			array(
				'label' => __( 'Body text', 'amadeus' ),
				'section' => 'colors',
				'settings' => 'body_text_color',
				'priority' => 22,
			)
		)
	);
	// Footer
	$wp_customize->add_setting(
		'footer_bg',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_bg',
			array(
				'label' => __( 'Footer background', 'amadeus' ),
				'section' => 'colors',
				'settings' => 'footer_bg',
				'priority' => 23,
			)
		)
	);
	// ___Fonts___//
	$wp_customize->add_section(
		'amadeus_fonts',
		array(
			'title' => __( 'Fonts', 'amadeus' ),
			'priority' => 15,
			'description' => __( 'You can use any Google Fonts you want for the heading and/or body. See the fonts here: google.com/fonts. See the documentation if you need help with this: flyfreemedia.com/documentation/amadeus', 'amadeus' ),
		)
	);
	// Body fonts
	$wp_customize->add_setting(
		'body_font_name',
		array(
			'default' => 'Noto+Serif:400,700,400italic,700italic',
			'sanitize_callback' => 'amadeus_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'body_font_name',
		array(
			'label' => __( 'Body font name/style/sets', 'amadeus' ),
			'section' => 'amadeus_fonts',
			'type' => 'text',
			'priority' => 11,
		)
	);
	// Body fonts family
	$wp_customize->add_setting(
		'body_font_family',
		array(
			'default' => '\'Noto Serif\', serif',
			'sanitize_callback' => 'amadeus_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'body_font_family',
		array(
			'label' => __( 'Body font family', 'amadeus' ),
			'section' => 'amadeus_fonts',
			'type' => 'text',
			'priority' => 12,
		)
	);
	// Headings fonts
	$wp_customize->add_setting(
		'headings_font_name',
		array(
			'default' => 'Playfair+Display:400,700',
			'sanitize_callback' => 'amadeus_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'headings_font_name',
		array(
			'label' => __( 'Headings font name/style/sets', 'amadeus' ),
			'section' => 'amadeus_fonts',
			'type' => 'text',
			'priority' => 14,
		)
	);
	// Headings fonts family
	$wp_customize->add_setting(
		'headings_font_family',
		array(
			'default' => '\'Playfair Display\', serif',
			'sanitize_callback' => 'amadeus_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'headings_font_family',
		array(
			'label' => __( 'Headings font family', 'amadeus' ),
			'section' => 'amadeus_fonts',
			'type' => 'text',
			'priority' => 15,
		)
	);
	// Site title
	$wp_customize->add_setting(
		'site_title_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '62',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'site_title_size', array(
		'type'        => 'number',
		'priority'    => 17,
		'section'     => 'amadeus_fonts',
		'label'       => __( 'Site title', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 90,
			'step'  => 1,
		),
	) );
	// Site description
	$wp_customize->add_setting(
		'site_desc_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '18',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'site_desc_size', array(
		'type'        => 'number',
		'priority'    => 17,
		'section'     => 'amadeus_fonts',
		'label'       => __( 'Site description', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 50,
			'step'  => 1,
		),
	) );
	// H1 size
	$wp_customize->add_setting(
		'h1_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '38',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'h1_size', array(
		'type'        => 'number',
		'priority'    => 17,
		'section'     => 'amadeus_fonts',
		'label'       => __( 'H1 font size', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
		),
	) );
	// H2 size
	$wp_customize->add_setting(
		'h2_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '30',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'h2_size', array(
		'type'        => 'number',
		'priority'    => 18,
		'section'     => 'amadeus_fonts',
		'label'       => __( 'H2 font size', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
		),
	) );
	// H3 size
	$wp_customize->add_setting(
		'h3_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '24',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'h3_size', array(
		'type'        => 'number',
		'priority'    => 19,
		'section'     => 'amadeus_fonts',
		'label'       => __( 'H3 font size', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
		),
	) );
	// H4 size
	$wp_customize->add_setting(
		'h4_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '18',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'h4_size', array(
		'type'        => 'number',
		'priority'    => 20,
		'section'     => 'amadeus_fonts',
		'label'       => __( 'H4 font size', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
		),
	) );
	// H5 size
	$wp_customize->add_setting(
		'h5_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '14',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'h5_size', array(
		'type'        => 'number',
		'priority'    => 21,
		'section'     => 'amadeus_fonts',
		'label'       => __( 'H5 font size', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
		),
	) );
	// H6 size
	$wp_customize->add_setting(
		'h6_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '12',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'h6_size', array(
		'type'        => 'number',
		'priority'    => 22,
		'section'     => 'amadeus_fonts',
		'label'       => __( 'H6 font size', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 60,
			'step'  => 1,
		),
	) );
	// Body
	$wp_customize->add_setting(
		'body_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '15',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control( 'body_size', array(
		'type'        => 'number',
		'priority'    => 23,
		'section'     => 'amadeus_fonts',
		'label'       => __( 'Body font size', 'amadeus' ),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 24,
			'step'  => 1,
		),
	) );

}
add_action( 'customize_register', 'amadeus_customize_register' );

/**
 * Sanitize Text
 *
 * @param string $input Input.
 *
 * @return string
 */
function amadeus_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Logo style
 *
 * @param string $input Input.
 *
 * @return string
 */
function amadeus_sanitize_logo_style( $input ) {
	$valid = array(
		'hide-title'  => __( 'Only logo', 'amadeus' ),
		'show-title'  => __( 'Logo plus site title&amp;description', 'amadeus' ),
	);
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Menu position
 *
 * @param string $input Input.
 *
 * @return string
 */
function amadeus_sanitize_menu_position( $input ) {
	$valid = array(
		'above'  => __( 'Above site title/description', 'amadeus' ),
		'below'  => __( 'Below site title/description', 'amadeus' ),
	);
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitize banner.
 *
 * @param string $input Input.
 *
 * @return string
 */
function amadeus_sanitize_banner( $input ) {
	$valid = array(
		'image'    => __( 'Header image', 'amadeus' ),
		'slider'   => __( 'Nivo Slider (requires the Nivo Slider plugin)', 'amadeus' ),
		'nothing'  => __( 'Nothing', 'amadeus' ),
	);
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitize checkbox
 *
 * @param int $input Input.
 *
 * @return int|string
 */
function amadeus_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function amadeus_customize_preview_js() {
	wp_enqueue_script( 'amadeus_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'amadeus_customize_preview_js' );

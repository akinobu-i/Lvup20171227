<?php
/**
 * Typography settings.
 *
 * @package Hestia
 * @since 1.1.38
 */

/**
 * Include font selector functions.
 */
$font_selector_functions = HESTIA_PHP_INCLUDE . 'customizer-font-selector/functions.php';
if ( file_exists( $font_selector_functions ) ) {
	require_once( $font_selector_functions );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.1.38
 */
function hestia_customize_preview() {
	wp_enqueue_script( 'hestia_customizer', get_template_directory_uri() . '/inc/typography/js/customizer.js', array( 'customize-preview' ), HESTIA_VERSION, true );
}
add_action( 'customize_preview_init', 'hestia_customize_preview' );

/**
 * Customizer controls for typography settings.
 *
 * @param WP_Customize_Manager $wp_customize Customize manager.
 *
 * @since 1.1.38
 */
function hestia_typography_settings( $wp_customize ) {

	// Add typography panel.
	$wp_customize->add_section(
		'hestia_typography', array(
			'title'    => esc_html__( 'Typography', 'hestia' ),
			'panel'    => 'hestia_appearance_settings',
			'priority' => 25,
		)
	);

	if ( class_exists( 'Hestia_Select_Multiple' ) ) {

		$wp_customize->add_setting(
			'hestia_font_subsets', array(
				'sanitize_callback' => 'hestia_sanitize_array',
				'default'           => array( 'latin' ),
			)
		);

		$wp_customize->add_control(
			new Hestia_Select_Multiple(
				$wp_customize, 'hestia_font_subsets', array(
					'section'  => 'hestia_typography',
					'label'    => esc_html__( 'Font Subsets', 'hestia' ),
					'choices'  => array(
						'latin'        => 'latin',
						'latin-ext'    => 'latin-ext',
						'cyrillic'     => 'cyrillic',
						'cyrillic-ext' => 'cyrillic-ext',
						'greek'        => 'greek',
						'greek-ext'    => 'greek-ext',
						'vietnamese'   => 'vietnamese',
					),
					'priority' => 45,
				)
			)
		);
	}

	if ( class_exists( 'Hestia_Font_Selector' ) ) {

		$wp_customize->add_setting(
			'hestia_headings_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Hestia_Font_Selector(
				$wp_customize, 'hestia_headings_font', array(
					'label'    => esc_html__( 'Headings', 'hestia' ) . ' ' . esc_html__( 'font family', 'hestia' ),
					'section'  => 'hestia_typography',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);

		$wp_customize->add_setting(
			'hestia_body_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Hestia_Font_Selector(
				$wp_customize, 'hestia_body_font', array(
					'label'    => esc_html__( 'Body', 'hestia' ) . ' ' . esc_html__( 'font family', 'hestia' ),
					'section'  => 'hestia_typography',
					'priority' => 10,
					'type'     => 'select',
				)
			)
		);
	}// End if().

	if ( class_exists( 'Hestia_Customizer_Range_Value_Control' ) ) {

		if ( class_exists( 'Hestia_Customizer_Heading' ) ) {
			$wp_customize->add_setting(
				'hestia_posts_and_pages_title', array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new Hestia_Customizer_Heading(
					$wp_customize, 'hestia_posts_and_pages_title', array(
						'label'    => esc_html__( 'Posts & Pages', 'hestia' ),
						'section'  => 'hestia_typography',
						'priority' => 50,
					)
				)
			);
		}

		$wp_customize->add_setting(
			'hestia_header_titles_fs', array(
				'sanitize_callback' => 'hestia_sanitize_range_value',
				'default'           => '0',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_header_titles_fs', array(
					'label'       => esc_html__( 'Title', 'hestia' ),
					'section'     => 'hestia_typography',
					'type'        => 'range-value',
					'input_attr'  => array(
						'min'  => -25,
						'max'  => 25,
						'step' => 1,
					),
					'priority'    => 60,
					'media_query' => true,
					'sum_type'    => true,
				)
			)
		);

		$wp_customize->add_setting(
			'hestia_post_page_headings_fs', array(
				'sanitize_callback' => 'hestia_sanitize_range_value',
				'default'           => 0,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_post_page_headings_fs', array(
					'label'      => esc_html__( 'Headings', 'hestia' ),
					'section'    => 'hestia_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => -25,
						'max'  => 25,
						'step' => 1,
					),
					'priority'   => 70,
					'sum_type'   => true,
				)
			)
		);

		$wp_customize->add_setting(
			'hestia_post_page_content_fs', array(
				'sanitize_callback' => 'hestia_sanitize_range_value',
				'default'           => 0,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_post_page_content_fs', array(
					'label'      => esc_html__( 'Content', 'hestia' ),
					'section'    => 'hestia_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => -25,
						'max'  => 25,
						'step' => 1,
					),
					'priority'   => 80,
					'sum_type'   => true,
				)
			)
		);

	}// End if().
}
add_action( 'customize_register', 'hestia_typography_settings', 20 );


/**
 * Return style for fonts.
 *
 * @return string
 * @since 1.1.48
 */
function hestia_get_fonts_style() {
	$custom_css = '';

	/**
	 * Header Titles
	 *
	 * Carousel H1, header-small H1
	 */
	$custom_css .= hestia_get_inline_style( 'hestia_header_titles_fs', 'hestia_get_header_titles_style' );

	/**
	 * Post/Page Headings.
	 */
	$custom_css .= hestia_get_inline_style( 'hestia_post_page_headings_fs', 'hestia_get_post_page_headings_style', $custom_css );

	/**
	 * Post/Page Content.
	 */
	$custom_css .= hestia_get_inline_style( 'hestia_post_page_content_fs', 'hestia_get_post_page_content_style', $custom_css );

	/**
	 * Headings font family.
	 */
	$default              = apply_filters( 'hestia_headings_default', false );
	$hestia_headings_font = get_theme_mod( 'hestia_headings_font', $default );

	if ( ! empty( $hestia_headings_font ) ) {
		hestia_enqueue_google_font( $hestia_headings_font );
		$custom_css .=
			'h1, h2, h3, h4, h5, h6, .hestia-title , .info-title, .card-title,
		.page-header.header-small .hestia-title, .page-header.header-small .title, .widget h5, .hestia-title, 
		.title, .card-title, .info-title, .footer-brand, .footer-big h4, .footer-big h5, .media .media-heading, 
		.carousel h1.hestia-title, .carousel h2.title, 
		.carousel span.sub-title, .woocommerce.single-product h1.product_title, .woocommerce section.related.products h2, .hestia-about h1, .hestia-about h2, .hestia-about h3, .hestia-about h4, .hestia-about h5 {
            font-family: ' . $hestia_headings_font . ';
        }';
		if ( class_exists( 'WooCommerce' ) ) {
			$custom_css .=
				'.woocommerce.single-product .product_title, .woocommerce .related.products h2, .woocommerce span.comment-reply-title {
				font-family: ' . $hestia_headings_font . ';
            }';
		}
	}

	/**
	 * Body font family.
	 */
	$default          = apply_filters( 'hestia_body_font_default', false );
	$hestia_body_font = get_theme_mod( 'hestia_body_font', $default );
	if ( ! empty( $hestia_body_font ) ) {
		hestia_enqueue_google_font( $hestia_body_font );
		$custom_css .= '
		body, ul, .tooltip-inner {
            font-family: ' . $hestia_body_font . ';
        }';

		if ( class_exists( 'WooCommerce' ) ) {
			$custom_css .= '
		.products .shop-item .added_to_cart,
		.woocommerce-checkout #payment input[type=submit], .woocommerce-checkout input[type=submit],
		.woocommerce-cart table.shop_table td.actions input[type=submit],
		.woocommerce .cart-collaterals .cart_totals .checkout-button, .woocommerce button.button,
		.woocommerce div[id^=woocommerce_widget_cart].widget .buttons .button, .woocommerce div.product form.cart .button,
		.woocommerce #review_form #respond .form-submit , .added_to_cart.wc-forward, .woocommerce div#respond input#submit,
		.woocommerce a.button {
			font-family: ' . $hestia_body_font . ';
        }';
		}
	}

	return $custom_css;
}

/**
 * Adds inline style from customizer
 *
 * @since 1.1.38
 */
function hestia_typography_inline_style() {

	$custom_css = hestia_get_fonts_style();
	wp_add_inline_style( 'hestia_style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'hestia_typography_inline_style' );

/**
 * Get inline style for different controls
 *
 * @param string $control_name Control name.
 * @param string $function_name Function to be called.
 *
 * @since 1.1.38
 * @return string
 */
function hestia_get_inline_style( $control_name, $function_name ) {
	$control_value = get_theme_mod( $control_name );
	if ( empty( $control_value ) ) {
		return '';
	}
	$custom_css = '';
	if ( hestia_is_json( $control_value ) ) {
		$control_value = json_decode( $control_value, true );
		if ( ! empty( $control_value ) ) {

			foreach ( $control_value as $key => $value ) {
				$custom_css .= call_user_func( $function_name, $value, $key );
			}
		}
	} else {
		$custom_css .= call_user_func( $function_name, $control_value );
	}
	return $custom_css;
}

/**
 * [Posts & Pages] Headings.
 * This changes the font size for headings ( h1 - h6 ) on pages and single post pages
 *
 * @param string $value Font value.
 */
function hestia_get_post_page_headings_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	if ( empty( $value ) ) {
		return $custom_css;
	}
	switch ( $dimension ) {
		case 'desktop':
			$v1 = ( 42 + (int) $value ) > 0 ? ( 42 + (int) $value ) : 0;
			$v2 = ( 37 + (int) $value ) > 0 ? ( 37 + (int) $value ) : 0;
			$v3 = ( 32 + (int) $value ) > 0 ? ( 32 + (int) $value ) : 0;
			$v4 = ( 27 + (int) $value ) > 0 ? ( 27 + (int) $value ) : 0;
			$v5 = ( 23 + (int) $value ) > 0 ? ( 23 + (int) $value ) : 0;
			$v6 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			break;
		case 'tablet':
		case 'mobile':
			$v1 = ( 36 + (int) $value ) > 0 ? ( 36 + (int) $value ) : 0;
			$v2 = ( 32 + (int) $value ) > 0 ? ( 32 + (int) $value ) : 0;
			$v3 = ( 28 + (int) $value ) > 0 ? ( 28 + (int) $value ) : 0;
			$v4 = ( 24 + (int) $value ) > 0 ? ( 24 + (int) $value ) : 0;
			$v5 = ( 21 + (int) $value ) > 0 ? ( 21 + (int) $value ) : 0;
			$v6 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			break;
	}

	$custom_css .= 'h1,
	.single-post-wrap article h1,
	.page-content-wrap h1,
	.page-template-template-fullwidth article h1 {
		font-size: ' . $v1 . 'px;
	}
	h2,
	.single-post-wrap article h2,
	.page-content-wrap h2,
	.page-template-template-fullwidth article h2 {
		font-size: ' . $v2 . 'px;
	}
	h3,
	.single-post-wrap article h3,
	.page-content-wrap h3,
	.page-template-template-fullwidth article h3 {
		font-size: ' . $v3 . 'px;
	}
	h4,
	.single-post-wrap article h4,
	.page-content-wrap h4,
	.page-template-template-fullwidth article h4 {
		font-size: ' . $v4 . 'px;
	}
	h5,
	.single-post-wrap article h5,
	.page-content-wrap h5,
	.page-template-template-fullwidth article h5 {
		font-size: ' . $v5 . 'px;
	}
	h6,
	.single-post-wrap article h6,
	.page-content-wrap h6,
	.page-template-template-fullwidth article h6 {
		font-size: ' . $v6 . 'px;
	}';

	if ( function_exists( 'hestia_add_media_query' ) ) {
		$custom_css = hestia_add_media_query( $dimension, $custom_css );
	}
	return $custom_css;
}


/**
 * [Posts & Pages] Content.
 * This changes the font size for content ( p ) on pages and single post pages
 *
 * @param string $value Font value.
 */
function hestia_get_post_page_content_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	if ( empty( $value ) ) {
		return $custom_css;
	}
	switch ( $dimension ) {
		case 'desktop':
			$v1 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			break;
		case 'tablet':
		case 'mobile':
			$v1 = ( 16 + (int) $value ) > 0 ? ( 16 + (int) $value ) : 0;
			break;
	}
	$custom_css .= '.single-post-wrap article p, .page-content-wrap p, .single-post-wrap article ul, .page-content-wrap ul, .single-post-wrap article ol, .page-content-wrap ol, .single-post-wrap article dl, .page-content-wrap dl, .single-post-wrap article table, .page-content-wrap table, .page-template-template-fullwidth article p {
		font-size: ' . $v1 . 'px;
	}';
	if ( function_exists( 'hestia_add_media_query' ) ) {
		$custom_css = hestia_add_media_query( $dimension, $custom_css );
	}
	return $custom_css;
}

/**
 * Check if a string is in json format
 *
 * @param  string $string Input.
 *
 * @since 1.1.38
 * @return bool
 */
function hestia_is_json( $string ) {
	return is_string( $string ) && is_array( json_decode( $string, true ) ) ? true : false;
}

/**
 * Function to import font sizes from old controls to new ones.
 *
 * @since 1.1.58
 */
function hestia_sync_new_fs() {
	$execute = get_option( 'hestia_sync_new_fs' );
	if ( $execute !== false ) {
		return;
	}
	$headings_fs_old = get_theme_mod( 'hestia_headings_font_size' );
	$body_fs_old     = get_theme_mod( 'hestia_body_font_size' );
	if ( empty( $body_fs_old ) && empty( $headings_fs_old ) ) {
		return;
	}
	if ( ! empty( $headings_fs_old ) ) {
		$decoded          = json_decode( $headings_fs_old );
		$decoded->desktop = floor( $decoded->desktop - 37 ) > 25 ? 25 : ( floor( $decoded->desktop - 37 ) < -25 ? -25 : floor( $decoded->desktop - 37 ) );
		$decoded->tablet  = floor( $decoded->tablet - 37 ) > 25 ? 25 : ( floor( $decoded->tablet - 37 ) < -25 ? -25 : floor( $decoded->tablet - 37 ) );
		$decoded->mobile  = floor( $decoded->mobile - 37 ) > 25 ? 25 : ( floor( $decoded->mobile - 37 ) < -25 ? -25 : floor( $decoded->mobile - 37 ) );
		$decoded          = json_encode( $decoded );
		// set_theme_mod( 'hestia_section_primary_headings_fs', $decoded);
		// set_theme_mod( 'hestia_section_secondary_headings_fs', $decoded);
		set_theme_mod( 'hestia_header_titles_fs', $decoded );
		set_theme_mod( 'hestia_post_page_headings_fs', $decoded );
	}

	if ( ! empty( $body_fs_old ) ) {
		$decoded          = json_decode( $body_fs_old );
		$decoded->desktop = floor( $decoded->desktop - 14 ) > 25 ? 25 : ( floor( $decoded->desktop - 14 ) < -25 ? -25 : floor( $decoded->desktop - 14 ) );
		$decoded->tablet  = floor( $decoded->tablet - 14 ) > 25 ? 25 : ( floor( $decoded->tablet - 14 ) < -25 ? -25 : floor( $decoded->tablet - 14 ) );
		$decoded->mobile  = floor( $decoded->mobile - 14 ) > 25 ? 25 : ( floor( $decoded->mobile - 14 ) < -25 ? -25 : floor( $decoded->mobile - 14 ) );
		$decoded          = json_encode( $decoded );
		// set_theme_mod( 'hestia_section_content_fs', $decoded);
		set_theme_mod( 'hestia_post_page_content_fs', $decoded );
	}
	update_option( 'hestia_sync_new_fs', true );

}
add_action( 'after_setup_theme', 'hestia_sync_new_fs' );

/**
 * [Posts and Pages] Title font size.
 *
 * This function changes the font size for:
 * pages/posts titles
 * Slider/Big title title/subtitle
 *
 * @param string $value Font value.
 */
function hestia_get_header_titles_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	switch ( $dimension ) {
		case 'desktop':
			$v1 = ( 67 + (int) $value ) > 0 ? ( 67 + (int) $value ) : 0;
			$v2 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			$v3 = ( 42 + (int) $value ) > 0 ? ( 42 + (int) $value ) : 0;
			break;
		case 'tablet':
		case 'mobile':
			$v1 = ( 42 + (int) $value ) > 0 ? ( 42 + (int) $value ) : 0;
			$v2 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			$v3 = ( 42 + (int) $value ) > 0 ? ( 42 + (int) $value ) : 0;
			break;
	}
	$custom_css .= '
	.page-header.header-small .hestia-title,
	.page-header.header-small .title {
	    font-size: ' . $v3 . 'px;
	}';

	$custom_css = hestia_add_media_query( $dimension, $custom_css );

	return $custom_css;
}

/**
 * Add media queries
 *
 * @param string $dimension Query dimension.
 * @param string $custom_css Css.
 *
 * @return string
 */
function hestia_add_media_query( $dimension, $custom_css ) {
	switch ( $dimension ) {
		case 'tablet':
			$custom_css = '@media (max-width: 768px){' . $custom_css . '}';
			break;
		case 'mobile':
			$custom_css = '@media (max-width: 480px){' . $custom_css . '}';
			break;
	}

	return $custom_css;
}

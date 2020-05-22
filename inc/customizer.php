<?php
/**
 * LETO_STUDIO Theme Customizer
 *
 * @package LETO_STUDIO
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function leto_studio_customize_register( $wp_customize ) {
	/*
 * Add custom sections
 * */
	$wp_customize->add_section(
		'start_learnin',
		array(
			'title'      => __( 'Начаь обучение', 'leto_studio' ),
			'priority'   => 100,
			'capability' => 'edit_theme_options'
		)
	);
	$wp_customize->add_section(
		'header_contacts',
		array(
			'title'      => __( 'Контакты', 'leto_studio' ),
			'priority'   => 101,
			'capability' => 'edit_theme_options'
		)
	);

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_phone1' )->transport    = 'postMessage';

	/*
	 * Add custom setings
	 * */
	$start_learning_n = array( 'start_learning_1', 'start_learning_2', 'start_learning_3', 'start_learning_4' );
	foreach ( $start_learning_n as $start_learning ) {
		$wp_customize->add_setting( $start_learning, array(
			'default'           => 'Редактируется в настройках темы.',
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage'
		) );
	}
	$header_contacts = array( 'schedule', 'adress_1', 'adress_2', 'phone_1', 'phone_2', 'facebook', 'instagram', 'pinterest', 'WhatsApp' );
	foreach ( $header_contacts as $header_contact ) {
		$wp_customize->add_setting( $header_contact, array(
			'default'           => 'Редактируется в настройках темы.',
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage'
		) );
	}
	/*
 * Add custom control
 * */
	$i = 1;
	foreach ( $start_learning_n as $start_learning ) {
		$wp_customize->add_control( $start_learning, array(
			'section' => 'start_learnin',
			'type'    => 'textarea',
			'label'   => $i ++,
		) );
	}
	foreach ( $header_contacts as $header_contact ) {
		$wp_customize->add_control( $header_contact, array(
			'section' => 'header_contacts',
			'type'    => 'input',
			'label'   => $header_contact,
		) );
	}

	/*
 * Add live refresh
 * */
	foreach ( $start_learning_n as $start_learning ) {
		$wp_customize->selective_refresh->add_partial( $start_learning, array(
			'selector'        => '.' . $start_learning,
			'render_callback' => function () use ( $start_learning ) {
				return nl2br( esc_html( get_theme_mod( $start_learning ) ) );
			}
		) );
	}
	foreach ( $header_contacts as $header_contact ) {
		$wp_customize->selective_refresh->add_partial( $header_contact, array(
			'selector'        => '.' . $header_contact,
			'render_callback' => function () use ( $header_contact ) {
				return nl2br( esc_html( get_theme_mod( $header_contact ) ) );
			}
		) );
	}
	/*
 * ive refresh end
 * */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'leto_studio_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'leto_studio_customize_partial_blogdescription',
			)
		);
	}

}

add_action( 'customize_register', 'leto_studio_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function leto_studio_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function leto_studio_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function leto_studio_customize_preview_js() {
	wp_enqueue_script( 'leto_studio-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'leto_studio_customize_preview_js' );

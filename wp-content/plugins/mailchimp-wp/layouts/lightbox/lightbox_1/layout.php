<?php

/**
 * @package    Optin Cat
 */

$layout = array(

	'name' => __( 'Popup 1' ),

	'editables' => array(

		// Added to the fieldset "Form Background"
		'form' => array(
			'.fca_eoi_lightbox_1' => array(
				'background-color' => array( __( 'Form Background Color' ), '#ffffff' ),
				'border-color' => array( __( 'Border Color' ), '#D2D2D2' ),
			),
		),

		// Added to the fieldset "Headline"
		'headline' => array(
			'.fca_eoi_lightbox_1 .fca_eoi_lightbox_1_headline_copy_wrapper' => array(
				'font-size' => array( __('Font Size'), '25px'),
				'color' => array( __('Font Color'), '#2B6B98'),
			),
		),
		'description' => array(
			'.fca_eoi_lightbox_1 .fca_eoi_lightbox_1_description_copy_wrapper p' => array(
				'font-size' => array( __('Font Size'), '14px'),
				'color' => array( __('Font Color'), '#6D6D6D'),
			),
		),
		'name_field' => array(
			'.fca_eoi_lightbox_1 .fca_eoi_lightbox_1_name_field_wrapper, .fca_eoi_lightbox_1 .fca_eoi_lightbox_1_name_field_wrapper input' => array(
				'color' => array( __( 'Font Color' ), '#7f7f7f' ),
				'background-color' => array( __( 'Background Color' ), '#F5F5F5' ),
			),
			'.fca_eoi_lightbox_1 .fca_eoi_lightbox_1_name_field_wrapper' => array(
				'border-color' => array( __('Border Color'), '#CCC'),
			),
		),
		'email_field' => array(
			'.fca_eoi_lightbox_1 .fca_eoi_lightbox_1_email_field_wrapper, .fca_eoi_lightbox_1 .fca_eoi_lightbox_1_email_field_wrapper input' => array(
				'color' => array( __( 'Font Color' ), '#7f7f7f' ),
				'background-color' => array( __( 'Background Color' ), '#F5F5F5'),
			),
			'.fca_eoi_lightbox_1 .fca_eoi_lightbox_1_email_field_wrapper' => array(
				'border-color' => array( __( 'Border Color' ), '#CCC'),
			),
		),
		'button' => array(
			'.fca_eoi_lightbox_1 .fca_eoi_lightbox_1_submit_button_wrapper input' => array(
				'font-size' => array( __('Font Size'), '14px'),
				'color' => array( __( 'Font Color' ), '#963' ),
				'background-color' => array( __( 'Color' ), '#f5d03b' ),
				'border-color' => array( __( 'Border Color' ), '#EEC22B' ),
			),
		),
		'privacy' => array(
			'.fca_eoi_lightbox_1 .fca_eoi_lightbox_1_privacy_copy_wrapper' => array(
				'font-size' => array( __('Font Size'), '14px'),
				'color' => array( __('Font Color'), '#8F8F8F'),
			),
		),
		'fatcatapps' => array(
			'.fca_eoi_lightbox_1 .fca_eoi_lightbox_1_fatcatapps_link_wrapper a, .fca_eoi_lightbox_1 .fca_eoi_lightbox_1_fatcatapps_link_wrapper a:hover' => array(
				'color' => array( __('Font Color'), '#BAA34E'),
			),
		),
	)
);

<?php

/**
 * @package    Optin Cat
 */

$layout = array(

	'name' => __( 'No CSS' ),

	'editables' => array(

		// Added to the fieldset "Form Background"
		'form' => array(
			'.fca_eoi_layout_0' => array(
				'background-color' => array( __( 'Form Background Color' ), '' ),
				'border-color' => array( __( 'Border Color' ), '' ),
			),
		),
		// Added to the fieldset "Headline"
		'headline' => array(
			'.fca_eoi_layout_0 .fca_eoi_layout_0_headline_copy_wrapper' => array(
				'font-size' => array( __('Font Size'), '25px'),
				'color' => array( __('Font Color'), ''),
			),
		),
		'description' => array(
			'.fca_eoi_layout_0 .fca_eoi_layout_0_description_copy_wrapper p' => array(
				'font-size' => array( __('Font Size'), '14px'),
				'color' => array( __('Font Color'), ''),
			),
		),
		'name_field' => array(
			'.fca_eoi_layout_0 .fca_eoi_layout_0_name_field_wrapper, .fca_eoi_layout_0 .fca_eoi_layout_0_name_field_wrapper input' => array(
				'color' => array( __( 'Font Color' ), '' ),
			),
			'.fca_eoi_layout_0 .fca_eoi_layout_0_name_field_wrapper' => array(
				'border-color' => array( __('Border Color'), ''),
			),
		),
		'email_field' => array(
			'.fca_eoi_layout_0 .fca_eoi_layout_0_email_field_wrapper, .fca_eoi_layout_0 .fca_eoi_layout_0_email_field_wrapper input' => array(
				'color' => array( __( 'Font Color' ), '' ),
			),
			'.fca_eoi_layout_0 .fca_eoi_layout_0_email_field_wrapper' => array(
				'border-color' => array( __( 'Border Color' ), ''),
			),
		),
		'button' => array(
			'.fca_eoi_layout_0 .fca_eoi_layout_0_submit_button_wrapper input' => array(
				'font-size' => array( __('Font Size'), '14px'),
				'color' => array( __( 'Font Color' ), '#FFF' ),
				'background-color' => array( __( 'Button Background Color' ), '#000' ),
			),
		),
		'privacy' => array(
			'.fca_eoi_layout_0 .fca_eoi_layout_0_privacy_copy_wrapper' => array(
				'font-size' => array( __('Font Size'), '14px'),
				'color' => array( __('Font Color'), ''),
			),
		),
		'fatcatapps' => array(
			'.fca_eoi_layout_0 .fca_eoi_layout_0_fatcatapps_link_wrapper a, .fca_eoi_layout_0 .fca_eoi_layout_0_fatcatapps_link_wrapper a:hover' => array(
				'color' => array( __('Font Color'), ''),
			),
		),
	)
);

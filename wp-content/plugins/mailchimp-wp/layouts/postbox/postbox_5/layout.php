<?php

/**
 * @package Optin Cat
 */

$layout = array(

	'name' => __( 'Postbox 5' ),

	'editables' => array(

		// Added to the fieldset "Form Background"
		'form' => array(
			'.fca_eoi_postbox_5' => array(
				'background-color' => array( __( 'Form Background' ), '#f6f6f6' ),
				'border-color' => array( __( 'Border Color' ), '#ccc' ),
			),
		),

		// Added to the fieldset "Headline"
		'headline' => array(
			'.fca_eoi_postbox_5 .fca_eoi_postbox_5_headline_copy_wrapper' => array(
				'font-size' => array( __('Font Size'), '28px'),
				'color' => array( __('Font Color'), '#1A78D7'),
			),
		),
		'description' => array(
			'.fca_eoi_postbox_5 .fca_eoi_postbox_5_description_copy_wrapper p' => array(
			),
		),
		'name_field' => array(
			'.fca_eoi_postbox_5 .fca_eoi_postbox_5_name_field_wrapper, .fca_eoi_postbox_5 .fca_eoi_postbox_5_name_field_wrapper input' => array(
				'font-size' => array( __( 'Font Size' ), '18px' ),
				'color' => array( __( 'Font Color' ), '#777' ),
				'background-color' => array( __( 'Background Color' ), '#FFF' ),
			),
			'.fca_eoi_postbox_5 .fca_eoi_postbox_5_name_field_wrapper' => array(
				'border-color' => array( __('Border Color'), '#CCC'),
			),
		),
		'email_field' => array(
			'.fca_eoi_postbox_5 .fca_eoi_postbox_5_email_field_wrapper, .fca_eoi_postbox_5 .fca_eoi_postbox_5_email_field_wrapper input' => array(
				'font-size' => array( __( 'Font Size' ), '18px' ),
				'color' => array( __( 'Font Color' ), '#777' ),
				'background-color' => array( __( 'Background Color' ), '#FFF'),
			),
			'.fca_eoi_postbox_5 .fca_eoi_postbox_5_email_field_wrapper' => array(
				'border-color' => array( __( 'Border Color' ), '#CCC'),
			),
		),
		'button' => array(
			'.fca_eoi_postbox_5 .fca_eoi_postbox_5_submit_button_wrapper input' => array(
				'font-size' => array( __('Font Size'), '18px' ),
				'color' => array( __( 'Font Color' ), '#FFF' ),
				'background-color' => array( __( 'Button Color' ), '#E67E22' ),
			),
		),
		'privacy' => array(
			'.fca_eoi_postbox_5 .fca_eoi_postbox_5_privacy_copy_wrapper' => array(
				'font-size' => array( __('Font Size'), '14px'),
				'color' => array( __('Font Color'), '#8F8F8F'),
			),
		),
		'fatcatapps' => array(
			'.fca_eoi_postbox_5 .fca_eoi_postbox_5_fatcatapps_link_wrapper a, .fca_eoi_postbox_5 .fca_eoi_postbox_5_fatcatapps_link_wrapper a:hover' => array(
				'color' => array( __('Font Color'), '#8F8F8F'),
			),
		),
	)
);

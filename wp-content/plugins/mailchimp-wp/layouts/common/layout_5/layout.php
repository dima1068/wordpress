<?php

function fca_eoi_layout_descriptor_5( $name, $layout_id, $texts ) {
	require_once FCA_EOI_PLUGIN_DIR . 'includes/eoi-layout.php';
	$layout = new EasyOptInsLayout( $layout_id );
	$class = $layout->layout_class;

	return array(

		'name' => __( $name ),

		'editables' => array(

			// Added to the fieldset "Form Background"
			'form' => array(
				'.fca_eoi_layout_5.' . $class => array(
					'background-color' => array( __( 'Form Background' ), '#f6f6f6' ),
					'border-color' => array( __( 'Border Color' ), '#ccc' ),
				),
			),

			// Added to the fieldset "Headline"
			'headline' => array(
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_headline_copy_wrapper div' => array(
					'font-size' => array( __('Font Size'), '28px'),
					'color' => array( __('Font Color'), '#1A78D7'),
				),
			),
			'description' => array(
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_description_copy_wrapper p, ' .
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_description_copy_wrapper div' => array(
					'font-size' => array( __('Font Size'), '14px'),
					'color' => array( __('Font Color'), '#000'),
				),
			),
			'name_field' => array(
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_name_field_wrapper, ' .
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_name_field_wrapper input' => array(
					'font-size' => array( __( 'Font Size' ), '18px' ),
					'color' => array( __( 'Font Color' ), '#777' ),
					'background-color' => array( __( 'Background Color' ), '#FFF' ),
				),
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_name_field_wrapper' => array(
					'border-color' => array( __('Border Color'), '#CCC'),
				),
			),
			'email_field' => array(
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_email_field_wrapper, ' .
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_email_field_wrapper input' => array(
					'font-size' => array( __( 'Font Size' ), '18px' ),
					'color' => array( __( 'Font Color' ), '#777' ),
					'background-color' => array( __( 'Background Color' ), '#FFF'),
				),
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_email_field_wrapper' => array(
					'border-color' => array( __( 'Border Color' ), '#CCC'),
				),
			),
			'button' => array(
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_submit_button_wrapper input' => array(
					'font-size' => array( __('Font Size'), '18px' ),
					'color' => array( __( 'Font Color' ), '#FFF' ),
					'background-color' => array( __( 'Background Color' ), '#E67E22' ),
				),
			),
			'privacy' => array(
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_privacy_copy_wrapper div' => array(
					'font-size' => array( __('Font Size'), '14px'),
					'color' => array( __('Font Color'), '#8F8F8F'),
				),
			),
			'fatcatapps' => array(
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_fatcatapps_link_wrapper a, ' .
				'.fca_eoi_layout_5.' . $class . ' div.fca_eoi_layout_fatcatapps_link_wrapper a:hover' => array(
					'color' => array( __('Font Color'), '#8F8F8F'),
				),
			),
		)
	);
}
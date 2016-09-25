<?php 

/* REMOVE LINKS FOR USERS WITH FEWER PERMISSIONS THAN EDITOR */
			
function fca_eoi_remove_admin_bar_link() {
	if (!current_user_can( 'delete_others_pages' ) && function_exists( 'remove_meta_box' )){
		remove_meta_box( 'fca_eoi_dashboard_widget', 'dashboard', 'normal' );	
	}
}
add_action( 'wp_dashboard_setup', 'fca_eoi_remove_admin_bar_link', 50 );

function fca_eoi_get_error_texts($post_meta) {
		
	$name_error = empty ( $post_meta[ 'error_text_field_required' ] ) ? "Error: Please enter a valid email address. For example \"max@domain.com\"." : $post_meta[ 'error_text_field_required' ];
	$email_error = empty ( $post_meta[ 'error_text_invalid_email' ] ) ? 'Error: This field is required.' : $post_meta[ 'error_text_invalid_email' ];
	
	$errorTexts = array(
		'field_required' => $name_error,
		'invalid_email' => $email_error,
	);
	
	return $errorTexts;
}

function fca_eoi_get_thanks_mode($post_meta) {

	$mode = empty ( $post_meta[ 'thankyou_page_mode' ] ) ? 'not set' : $post_meta[ 'thankyou_page_mode' ];
	return $mode;
}


//CHECK IF USER HAS AN ACTIVE CUSTOM FORM IN ONE OF THEIR OPT INS, OTHERWISE TURN OFF THIS FEATURE
function fca_eoi_set_custom_form_depreciation() {
	
	$optins_using_customform = get_posts( array(
		'post_type' => 'easy-opt-ins',
		'posts_per_page' => -1,
		'post_status' => 'any',
		'meta_key'         => 'fca_eoi_provider',
		'meta_value'       => 'customform',
		
	));
	
	$forms_in_trash = get_posts( array(
		'post_type' => 'easy-opt-ins',
		'posts_per_page' => -1,
		'post_status' => 'trash',
		'meta_key'         => 'fca_eoi_provider',
		'meta_value'       => 'customform',
		
	)); 
	
	if ( count ( $optins_using_customform ) > 0 OR count ( $forms_in_trash ) > 0) {
		update_option ( 'fca_eoi_allow_customform', 'true' );
	} else {
		update_option ( 'fca_eoi_allow_customform', 'false' );
	}
	
}

function fca_eoi_get_html( $form_id, $fca_eoi_meta ) {
	
	$selected_layout = $fca_eoi_meta[ 'layout' ];

	if( empty( $selected_layout ) OR empty ( $fca_eoi_meta ) ) {
		return 'Form data missing';
	}
	
	$list_ids = array ( 'mailchimp_list_id', 'campaignmonitor_list_id', 'getresponse_list_id', 'aweber_list_id', 'drip_list_id' );
	$list_id = 'Not Set';
	
	forEach ($list_ids as $id ) {
		if ( !empty ($fca_eoi_meta[$id]) ) {
			$list_id = $fca_eoi_meta[$id];
			break;
		}
	}
		
	$errorTexts = fca_eoi_get_error_texts($fca_eoi_meta);
	
	//determine if ajax or thank you page redirect
	$thanks_mode = fca_eoi_get_thanks_mode($fca_eoi_meta);
	if ($thanks_mode == 'ajax') {
		$thanks_page =  htmlentities ( K::get_var( 'thankyou_ajax', $fca_eoi_meta ), ENT_QUOTES, "UTF-8");
	} else {
		$thanks_mode = 'redirect';
		$thanks_page =  get_permalink( K::get_var( 'thank_you_page', $fca_eoi_meta, get_site_url() ) );
	}
		
	$layout_helper	= new EasyOptInsLayout( $selected_layout );
	$php_path		= $layout_helper->path_to_resource( 'layout', 'php' );
	$html_path		= $layout_helper->path_to_resource( 'layout', 'html' );
	$html_wrap_path	= $layout_helper->path_to_html_wrapper();
	$scss_path		= $layout_helper->path_to_resource( 'layout', 'scss' );
		
	$form_wrapper = '';
	$form_wrapper_end = '';

	if ( $layout_helper->layout_type != 'lightbox' ) {
		$form_wrapper =
			'<div class="' .
				'fca_eoi_form_wrapper ' .
				$layout_helper->layout_class . '_wrapper ' .
				'fca_eoi_layout_' . $layout_helper->layout_number . '_wrapper' .
			'">';
		$form_wrapper_end = '</div>';
	}
	
	//SET UP TEMPLATE
	
	$layout_html = str_replace('{{{layout}}}',file_get_contents( $html_path ),file_get_contents( $html_wrap_path ));
	
	$banding = K::get_var( 'show_fatcatapps_link', $fca_eoi_meta, false );
	$banding = $banding ? "<div class='fca_eoi_layout_fatcatapps_link_wrapper fca_eoi_form_text_element'><a href='https://fatcatapps.com/optincat/' target='_blank'>Powered by Optin Cat</a></div>" : '';
	
		
	$form_head = $form_wrapper;
	$form_head .= "<div id='fca_eoi_form_$form_id' class='fca_eoi_form_content'>";
	$form_head .= "<form method='post' action='#' class='fca_eoi_form fca_eoi_layout_$layout_helper->layout_number $layout_helper->layout_class'";
		$form_head .= "data-fca_eoi_list_id='$list_id' data-fca_eoi_thank_you_page='$thanks_page' data-fca_eoi_thank_you_mode='$thanks_mode' novalidate>";
	$form_head .= "<input type='hidden' id='fca_eoi_form_id' name='fca_eoi_form_id' value='$form_id'>";
	
	//FILL TEMPLATE
	$layout_html = str_replace(
		array(
			'<form>',
			'{{{description_copy}}}',
			'{{{headline_copy}}}',
			'{{{name_field}}}',
			'{{{email_field}}}',
			'{{{submit_button}}}',
			'{{{privacy_copy}}}',
			'{{{fatcatapps_link}}}',
			'</form>',
		),
		array(
			$form_head,
			'<div>{{{description_copy}}}</div>',
			'<div>{{{headline_copy}}}</div>',
			"<input class='fca_eoi_form_input_element' type='text' name='name' placeholder='{{{name_placeholder}}}'>",
			'<input class="fca_eoi_form_input_element" type="email" name="email" placeholder="{{{email_placeholder}}}">',
			'<div class="fca_eoi_spiner_div"><span class="fca_eoi_loading_spinner"></span></div><input class="fca_eoi_form_button_element" type="submit" value="{{{button_copy}}}">',
			'<div>{{{privacy_copy}}}</div>',
			$banding,
			'<input type="hidden" name="fca_eoi" value="1">
			<input type="hidden" name="fca_eoi_error_texts_email" class="fca_eoi_error_texts_email" value="' . htmlspecialchars ($errorTexts['invalid_email']) . '">
			<input type="hidden" name="fca_eoi_error_texts_required" class="fca_eoi_error_texts_required" value="' . htmlspecialchars ($errorTexts['field_required']) . '"></form></div>' . $form_wrapper_end,
		),
		$layout_html
	);
	
	//ADD TEXTS
	$headline_copy = $fca_eoi_meta[ 'headline_copy' ];
	$description_copy = $fca_eoi_meta[ 'description_copy' ];
	$name_placeholder = $fca_eoi_meta[ 'name_placeholder' ];
	$email_placeholder = $fca_eoi_meta[ 'email_placeholder' ];
	
	$button_copy = $fca_eoi_meta[ 'button_copy' ];
	$privacy_copy = $fca_eoi_meta[ 'privacy_copy' ];
			
	$output = str_replace( 
		array(
			'{{{headline_copy}}}',
			'{{{description_copy}}}',
			'{{{name_placeholder}}}',
			'{{{email_placeholder}}}',
			'{{{button_copy}}}',
			'{{{privacy_copy}}}',
		),
		array(
			$headline_copy,
			$description_copy,
			$name_placeholder,
			$email_placeholder,
			$button_copy,
			$privacy_copy,
		),
		$layout_html
	);
	
	$output = apply_filters( 'fca_eoi_alter_form', $output, $fca_eoi_meta );

	return $output;
}

//ADD KEYUP ACTION TO TINY MCE VISUAL EDITOR
function fca_eoi_tiny_mce_before_init( $initArray ) {
	global $post;
	if ( $post->post_type == 'easy-opt-ins' ) {
		$initArray['setup'] = <<<JS
[function(ed) {
    ed.on('keyup', function(ed, e) {
		jQuery('[name="fca_eoi[description_copy]"]').html(tinymce.activeEditor.getContent()).trigger('keyup')
    });

}][0]
JS;
		return $initArray;
	} else {
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'fca_eoi_tiny_mce_before_init' );

function fca_eoi_migrate_css() {
	
	require_once FCA_EOI_PLUGIN_DIR . 'powerups/4_new_css/powerup.php';
		
	//CHECK CURRENT SETTING
	$isActive = powerup_new_css_is_active();
	
	if ( !$isActive ) {
		$new_css_obj = new EoiNewCssMigration();
		$new_css_obj->migrate( 'old', 'new' );
		powerup_new_css_set_active( TRUE );
	} 

}


//CONVERTS OLD EDITOR SAVE FORMAT TO NEW FORMAT
function fca_eoi_convert_post_meta() {
	require_once FCA_EOI_PLUGIN_DIR . 'includes/eoi-layout.php';

	$args = array(
		'post_type' => 'easy-opt-ins',
		'post_status' => 'publish',
		'posts_per_page'=> -1, 
	);
	
	$posts_array = get_posts( $args );
	
	$settings = array (
		'form_background_color_selector' => 'background-color',
		'form_border_color_selector' => 'border-color',
		'headline_font_size_selector' => 'font-size',
		'headline_font_color_selector' => 'color',
		'headline_background_color_selector' => 'background-color',
		'description_font_size_selector' => 'font-size',
		'description_font_color_selector' => 'color',
		'name_font_size_selector' => 'font-size',
		'name_font_color_selector' => 'color',
		'name_background_color_selector' => 'background-color',
		'name_border_color_selector' => 'border-color',
		'email_font_size_selector' => 'font-size',
		'email_font_color_selector' => 'color',
		'email_background_color_selector' => 'background-color',
		'email_border_color_selector' => 'border-color',
		'button_font_size_selector' => 'font-size',
		'button_font_color_selector' => 'color',
		'button_background_color_selector' => 'background-color',
		'button_wrapper_background_color_selector' => 'background-color',
		'privacy_font_size_selector' => 'font-size',
		'privacy_font_color_selector' => 'color',
		'branding_font_color_selector' => 'color',	
		
	);

	forEach ( $posts_array as $post ) {
		$form_id = $post->ID;
		$version = get_post_meta( $post->ID, 'fca_eoi_meta_format', true );
		
		//ONLY CONVERT OLD VERSIONS
		if ( $version != '2.0' ) {
			$meta = get_post_meta( $post->ID, 'fca_eoi', true );
			//FIX FOR EMPTY LAYOUT? SET THE DEFAULT
			$layout = empty ( $meta['layout'] ) ? 'postbox_1' : $meta['layout'];
			$new_meta['layout'] = $layout;
				
			$new_meta = $meta;
			unset ( $new_meta[$layout] );
			
			$i = 0;
			
			forEach ( $meta[$layout] as $selector => $array ) {
				$type = '';
				
				if ( $i == 0 ) {
					$type = 'form';
				} else if ( strpos($selector, 'headline') !== false ) {
					$type = 'headline';
				} else if ( strpos($selector, 'description') !== false ) {
					$type = 'description';
				} else if ( strpos($selector, 'name') !== false ) {
					$type = 'name';
				} else if ( strpos($selector, 'email') !== false ) {
					$type = 'email';
				} else if ( strpos($selector, 'submit_button_wrapper input:hover') !== false ) {
					$type = 'hover';
				} else if ( strpos($selector, 'submit_button_wrapper input') !== false && strpos($selector, 'hover') === false  ) {
					$type = 'button';
				} else if ( strpos($selector, 'privacy') !== false ) {
					$type = 'privacy';
				} else if ( strpos($selector, 'fatcatapps') !== false ) {
					$type = 'branding';
				}
				
				forEach ($array as $css_property => $value ) {
					if ( !empty ( $type ) ) {
						
						if ( $type == 'hover' ) {
							
							$new_meta['button_wrapper_background_color_selector'] = '.fca_eoi_layout_submit_button_wrapper';
							$new_meta['button_wrapper_background_color'] = $value;
													
						} else {
							
							$new_key = $type . '_' . str_replace ('-', '_', $css_property) . '_selector';
							if ( strpos( $new_key, 'color' ) !== false && strpos( $new_key, 'border' ) === false && strpos( $new_key, 'background' ) === false ) {
								$new_key =  str_replace ('_color', '_font_color', $new_key);
							}						
							$new_meta[trim($new_key)] = $selector;
							
							$new_value_key = $type . '_' . str_replace ('-', '_', $css_property);
							
							if ( strpos( $new_value_key, 'color' ) !== false && strpos( $new_value_key, 'border' ) === false && strpos( $new_value_key, 'background' ) === false ) {
								$new_value_key =  str_replace ('_color', '_font_color', $new_value_key);
							}
							
							$new_meta[trim($new_value_key)] = $value;
						}
					}
				}
				
				$i++;
			}
			
			//SOME SPECIAL CASES
			if ( empty ( $new_meta['email_font_size'] ) ) {
				$new_meta['email_font_size_selector'] = 'div.fca_eoi_layout_email_field_wrapper';
				$new_meta['email_font_size'] = '13px';
			}
			if ( empty ( $new_meta['name_font_size'] ) ) {
				$new_meta['name_font_size_selector'] = 'div.fca_eoi_layout_name_field_wrapper';
				$new_meta['name_font_size'] = '13px';
			}
			
			//POSSIBLE FIX FOR PUBLICATION MODE
			if ( stripos ( $new_meta[ 'layout' ], 'lightbox') === FALSE && array_key_exists( 'publish_lightbox_mode', $new_meta )) {
				unset ( $new_meta['publish_lightbox_mode'] );
			}
			
			//COMPILE CSS AND SAVE INTO 'HEAD' META
						
			// General CSS for all forms
			$css = "<style type='text/css' class='fca-eoi-style'>.fca_eoi_form{ margin: auto; } .fca_eoi_form p { width: auto; } #fca_eoi_form_$form_id input{ max-width: 9999px; }";
				
			// CACHE (ALMSOT) ALL THE OUTPUT HERE
			$layout_helper = new EasyOptInsLayout( $new_meta[ 'layout' ] );
			$scss_path = $layout_helper->path_to_resource( 'layout', 'scss' );
			
			if ( file_exists( $scss_path ) ) {
				$css_path = str_replace ( '.scss' , '_min.css', $scss_path );
				$css_file = file_get_contents( $css_path );
			}
			
			$show_name = K::get_var( 'show_name_field', $new_meta, false );
			if ( !$show_name ) {
				$css .= "#fca_eoi_form_$form_id .fca_eoi_layout_email_field_wrapper {width: 100% !important;}";
				$css .= "#fca_eoi_form_$form_id .fca_eoi_layout_name_field_wrapper {display: none !important;}";
			}
			
			//ADD CSS FROM FILE
			$css .= $css_file;
			
			//ADD CUSTOM CSS FROM SAVE
			$added_inherent_css_rule = false;
			$added_widget_3_css_rule = false;
			
			foreach ( $settings as $key => $property ) {
				$input = str_replace ( '_selector', '', $key);
													
				$selector = empty ( $new_meta[$key] ) ? '' : $new_meta[$key];
				
				if ( !empty ( $selector ) ) {
					//BUTTON HOVER HACK
					if ( strpos ( $selector, '.fca_eoi_layout_submit_button_wrapper input' ) !== false && !$added_inherent_css_rule ) {
						$css .= "#fca_eoi_form_$form_id $selector:hover { background-color: inherit !important; }";
						$added_inherent_css_rule = true;
					}
					//SPECIAL CASE FOR WIDGET 3
					if ( $selector == '.fca_eoi_layout_3.fca_eoi_layout_widget div.fca_eoi_layout_headline_copy_wrapper div' && !$added_widget_3_css_rule && $input == 'headline_background_color' ) {
						$css .= "#fca_eoi_form_$form_id form.fca_eoi_layout_3.fca_eoi_layout_widget svg.fca_eoi_layout_headline_copy_triangle { fill: $new_meta[$input] !important; }";
						$added_widget_3_css_rule = true;
					}
										
					$css .= "#fca_eoi_form_$form_id $selector {	$property: $new_meta[$input] !important; }";
				}
			}
		
			$head = $css . '</style>';
			
			$html = fca_eoi_get_html ( $form_id, $new_meta );
							
			$head = $head . $html;
	
			update_post_meta( $post->ID, 'fca_eoi', $new_meta );
			update_post_meta( $post->ID, 'fca_eoi_meta_format', '2.0' );
			update_post_meta( $post->ID, 'fca_eoi_head', $head );
			
		}
	}
}
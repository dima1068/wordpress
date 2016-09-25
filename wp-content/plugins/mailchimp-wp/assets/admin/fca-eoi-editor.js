/* jshint asi: true */
jQuery( document ).ready( function( $ ) {
	////////////
	// DEFINE GLOBALS
	////////////
	var post_ID = $( '#post_ID' ).val()
	console.log (layouts)
	
	var layoutSaves = []
	
	var targetSelectors = {
		'form-background-color': '[name="fca_eoi[form_background_color]"]',
		'form-border-color': '[name="fca_eoi[form_border_color]"]',
		'headline-font-size': '[name="fca_eoi[headline_font_size]"]',
		'headline-color': '[name="fca_eoi[headline_font_color]"]',
		'headline-background-color': '[name="fca_eoi[headline_background_color]"]',
		'description-font-size': '[name="fca_eoi[description_font_size]"]',
		'description-color': '[name="fca_eoi[description_font_color]"]',
		'name_field-font-size': '[name="fca_eoi[name_font_size]"]',
		'name_field-color': '[name="fca_eoi[name_font_color]"]',
		'name_field-background-color': '[name="fca_eoi[name_background_color]"]',
		'name_field-border-color': '[name="fca_eoi[name_border_color]"]',
		'email_field-font-size': '[name="fca_eoi[email_font_size]"]',
		'email_field-color': '[name="fca_eoi[email_font_color]"]',
		'email_field-background-color': '[name="fca_eoi[email_background_color]"]',
		'email_field-border-color': '[name="fca_eoi[email_border_color]"]',
		'button-font-size': '[name="fca_eoi[button_font_size]"]',
		'button-color': '[name="fca_eoi[button_font_color]"]',
		'button-background-color': '[name="fca_eoi[button_background_color]"]',	
		'privacy-font-size': '[name="fca_eoi[privacy_font_size]"]',
		'privacy-color': '[name="fca_eoi[privacy_font_color]"]',
		'fatcatapps-color': '[name="fca_eoi[branding_font_color]"]',
	}
	
	function save_layout( layout_id ) {
		layoutSave = {}
		
		for (var key in targetSelectors ) {
			layoutSave[key] = $(targetSelectors[key]).val()
		}
		layoutSaves[layout_id] = layoutSave
	}
	
	function load_layout( layout_id ) {
		if ( layoutSaves[layout_id] ) {
			this_save = layoutSaves[layout_id]
			for (var key in targetSelectors ) {
				if ( this_save[key] ) {
					$(targetSelectors[key]).val( this_save[key] )
				}
			}
		}
	}

	
	////////////
	// MAIN EDITOR EVENT HANDLERS
	////////////
		
	//COLOR PICKERS
	$('.fca-color-picker').wpColorPicker({
		'change':
		function(event, ui) {
			//$(this).attr( 'value', $(this).val() )
			var $target = $( $(this).data('css-target') )
			var layout_id = $('#fca_eoi_layout_select').val()
			
			if ( $(this).attr('name').indexOf('button_background_color') != -1 ){
				//SPECIAL CASE FOR BUTTONS (AND SPECIAL CASE FOR LAYOUT 1)
				if ( layout_id == 'lightbox_1' || layout_id == 'postbox_1' || layout_id == 'layout_1' ) {
					newColor = ColorLuminance(ui.color.toString(), -0.1)
				} else {
					newColor = ColorLuminance(ui.color.toString(), -0.3)
				}
								
				$('.fca_eoi_layout_submit_button_wrapper').css('background-color', newColor )
				$('[name="fca_eoi[button_wrapper_background_color]"]').val( newColor )
				$('.fca_eoi_form_button_element').css('background-color', ui.color.toString() )
							
			} else if ( $(this).attr('name').indexOf('background') != -1 ) {
				if ( layout_id == 'layout_3' && $(this).attr('name') == 'fca_eoi[headline_background_color]' ) {
					//SPECIAL CASE FOR WIDGET 3
					$target.css('background-color', ui.color.toString() )
					$('.fca_eoi_layout_headline_copy_triangle polygon').css('fill', ui.color.toString() )
				}	else if ( $(this).attr('name') == 'fca_eoi[name_background_color]' ) {
					$target = $( $(this).data('css-target') )
					$target.css('background-color', ui.color.toString() )
					$('[name="fca_eoi[email_background_color]"]').val(ui.color.toString())
					$target = $( $('[name="fca_eoi[email_background_color]"]').data('css-target') )
					$target.css('background-color', ui.color.toString() )
					
				} else if ( $(this).attr('name') == 'fca_eoi[email_background_color]' ) {
					$target = $( $(this).data('css-target') )
					$target.css('background-color', ui.color.toString() )
					$('[name="fca_eoi[name_background_color]"]').val(ui.color.toString())
					$target = $( $('[name="fca_eoi[name_background_color]"]').data('css-target') )
					$target.css('background-color', ui.color.toString() )
				} else {		
					$target.css('background-color', ui.color.toString() )
				}			
			} else if ( $(this).attr('name').indexOf('border') != -1 ) {
				if ( $(this).attr('name') == 'fca_eoi[name_border_color]' ) {
					$target = $( $(this).data('css-target') )
					$target.css('border-color', ui.color.toString() )
					$('[name="fca_eoi[email_border_color]"]').val(ui.color.toString())
					$target = $( $('[name="fca_eoi[email_border_color]"]').data('css-target') )
					$target.css('border-color', ui.color.toString() )
					
				} else if ( $(this).attr('name') == 'fca_eoi[email_border_color]' ) {
					$target = $( $(this).data('css-target') )
					$target.css('border-color', ui.color.toString() )
					$('[name="fca_eoi[name_border_color]"]').val(ui.color.toString())
					$target = $( $('[name="fca_eoi[name_border_color]"]').data('css-target') )
					$target.css('border-color', ui.color.toString() )
				} else {		
					$target.css('border-color', ui.color.toString() )
				}
				
			} else {
				if ( $(this).attr('name') == 'fca_eoi[name_font_color]' ) {
					$target = $( $(this).data('css-target') )
					$target.css('color', ui.color.toString() )
					$('[name="fca_eoi[email_font_color]"]').val(ui.color.toString())
					$target = $( $('[name="fca_eoi[email_font_color]"]').data('css-target') )
					$target.css('color', ui.color.toString() )
					
				} else if ( $(this).attr('name') == 'fca_eoi[email_font_color]' ) {
					$target = $( $(this).data('css-target') )
					$target.css('color', ui.color.toString() )
					$('[name="fca_eoi[name_font_color]"]').val(ui.color.toString())
					$target = $( $('[name="fca_eoi[name_font_color]"]').data('css-target') )
					$target.css('color', ui.color.toString() )
				} else {		
					$target.css('color', ui.color.toString() )
				}
			}
		}
	})


	$('.fca-color-picker').change( function() {	
		var $target = $( $(this).data('css-target') )
		var layout_id = $('#fca_eoi_layout_select').val()
		
		if ( $(this).attr('name').indexOf('button_background_color') != -1 ){
			//SPECIAL CASE FOR BUTTONS (AND SPECIAL CASE FOR LAYOUT 1)
			if ( layout_id == 'lightbox_1' || layout_id == 'postbox_1' || layout_id == 'layout_1' ) {
				newColor = ColorLuminance($(this).val(), -0.1)
			} else {
				newColor = ColorLuminance($(this).val(), -0.3)
			}
			$('.fca_eoi_layout_submit_button_wrapper').css('background-color', newColor )
			$('[name="fca_eoi[button_wrapper_background_color]"]').val( newColor )
			$('.fca_eoi_form_button_element').css('background-color', $(this).val() )
						
		} else if ( $(this).attr('name').indexOf('background') != -1 ) {
			if ( layout_id == 'layout_3' && $(this).attr('name') == 'fca_eoi[headline_background_color]' ) {
				//SPECIAL CASE FOR WIDGET 3
				var value = $(this).val()
				$target.css('background-color', value )
				$('.fca_eoi_layout_headline_copy_triangle polygon').css('fill', value )
			} else {
				$target.css('background-color', $(this).val() )
			}		
		} else if ( $(this).attr('name').indexOf('border') != -1 ) {
			$target.css('border-color', $(this).val() )
		} else {
			$target.css('color', $(this).val() )
		}

	})
		
	//FONTS SIZE PICKERS
	$('.fca-font-size-picker').change( function() {
		if ( $(this).attr('name') == 'fca_eoi[name_font_size]' ) {
			$target = $( $(this).data('css-target') )
			$target.css('font-size', $(this).val() )
			$('[name="fca_eoi[email_font_size]"]').val($(this).val())
			$target = $( $('[name="fca_eoi[email_font_size]"]').data('css-target') )
			$target.css('font-size', $(this).val() )
			
		} else if ( $(this).attr('name') == 'fca_eoi[email_font_size]' ) {
			$target = $( $(this).data('css-target') )
			$target.css('font-size', $(this).val() )
			$('[name="fca_eoi[name_font_size]"]').val($(this).val())
			$target = $( $('[name="fca_eoi[name_font_size]"]').data('css-target') )
			$target.css('font-size', $(this).val() )
		} else {		
			$target = $( $(this).data('css-target') )
			$target.css('font-size', $(this).val() )
		}
	})
	
	//CHANGE LAYOUT BUTTON CLICK
	$('#fca_eoi_show_setup').click(function() {
		
		hide_tooltips()
		
		var layout_id = $('#fca_eoi_layout_select').val()
		save_layout ( layout_id )
		// Go back to the layout select tab
		$( '.postbox' ).hide()
		$( '#fca_eoi_meta_box_setup' ).show()
		
		if ( layout_id.indexOf('postbox') != -1 ) {
			$( '#layouts_types_tabs').find('a').eq(1).click()
		} else if ( layout_id.indexOf('lightbox') != -1 ) {
			$( '#layouts_types_tabs').find('a').first().click()
		} else {
			$( '#layouts_types_tabs').find('a').last().click()
		}
	})
	
	//BUTTON COPY KEYUP HANDLERS
	$('[name="fca_eoi[headline_copy]"]').keyup(function() {
		$('#fca_eoi_preview_headline_copy').html( $(this).val())
	})
	//TEXT EDITOR TAB
	$('[name="fca_eoi[description_copy]"]').keyup(function() {
		$('.fca_eoi_layout_description_copy_wrapper div').html( $(this).val())
	})
	
	$('[name="fca_eoi[name_placeholder]"]').keyup(function() {
		$('.fca_eoi_layout_name_field_inner').children().first().attr('placeholder', $(this).val())
	})
	$('[name="fca_eoi[email_placeholder]"]').keyup(function() {
		$('.fca_eoi_layout_email_field_inner').children().first().attr('placeholder', $(this).val())
	})	
	$('[name="fca_eoi[button_copy]"]').keyup(function() {
		$('.fca_eoi_form_button_element').val( $(this).val())
	})
	$('[name="fca_eoi[privacy_copy]"]').keyup(function() {
		$('.fca_eoi_layout_privacy_copy_wrapper').children().first().html( $(this).val())
	})
	
	//BRANDING TOGGLE BUTTON
	$('[name="fca_eoi[show_fatcatapps_link]"]').change(function() {
		$('.fca_eoi_layout_fatcatapps_link_wrapper').toggle(this.checked)
	})
	//NAME FIELD TOGGLE BUTTON
	$('[name="fca_eoi[show_name_field]"]').change(function() {
		$('.fca_eoi_layout_name_field_wrapper').toggle(this.checked)
		var layout_id = $('#fca_eoi_layout_select').val()
		if ( (this.checked) && layout_id.indexOf('layout') == -1 ) {
			$('.fca_eoi_layout_email_field_wrapper').css('width', '49%')
		} else {
			$('.fca_eoi_layout_email_field_wrapper').css('width', '100%')
		}
		destroy_tooltips()
		attach_tooltips()

	})		

	//////////////////
	// LAYOUT STUFF
	//////////////////
		
	//LOADS A LAYOUT OBJECT INTO THE EDITOR FIELDS
	function update_layout ( currentLayout, rebuild ) {
		console.log ("Updating layout...")
		console.log ( currentLayout )
		
		//ADD NEW HTML
		$('#fca-preview-style').remove()
		$('#fca_eoi_preview_form_container').remove()
		$('#fca_eoi_preview').append(currentLayout.html)
		
		var editables = currentLayout.editables
		var target, value, $selector = ''
		
		//CLEAR EXISTING TARGETS
		for (var key in targetSelectors ) {
			var css_hidden_input = targetSelectors[key].replace(']"]', '_selector]"]')
			$(css_hidden_input).val('')
		}
		
		for (var field in editables ) {
						
			for ( var cssSelector in editables[field] ) {
				
				for ( var attribute in editables[field][cssSelector] ) {
					target = field + '-' + attribute
					$selector = $(targetSelectors[target])
					value = editables[field][cssSelector][attribute][1]

					if ( target.indexOf('font-size') == -1 ) { 
						rebuild ? $selector.val(value) : ''						
						$selector.data('css-target', cssSelector)
					} else { //Need something different for font size inputs
						rebuild ? $selector.children().filter( function() {
							return $( this ).val() == value
						}).prop('selected', true) : ''
						$selector.data('css-target', cssSelector)
					}
					//Update hidden selector input with target
					var targetString = targetSelectors[target]
					if ( targetString ) {
						var css_hidden_input = targetString.replace(']"]', '_selector]"]')
						$(css_hidden_input).val(cssSelector)
					} else {
						console.log("can't find target: " + target)
					}
				}
			}
		}
		//LOAD SAVE IF APPLICABLE
		load_layout ( $( '#fca_eoi_layout_select' ).val() )
		
		//REFRESH CUSTOMIZATION PICKERS
		$('.fca-color-picker').change()
		$('.fca-font-size-picker').change()
		$('[name="fca_eoi[show_fatcatapps_link]"]').change()
		$('[name="fca_eoi[show_name_field]"]').change()
		
		//TRIGGER THE TEXT INPUT KEYUP TO WRITE SAVED/DEFAULT COPY TO PREVIEWS
		load_default_texts()
		$('[name="fca_eoi[headline_copy]"], [name="fca_eoi[description_copy]"], [name="fca_eoi[name_placeholder]"], [name="fca_eoi[email_placeholder]"], [name="fca_eoi[button_copy]"], [name="fca_eoi[privacy_copy]"]').keyup()
		
		//VARIOUS RESETS
		hide_unused_inputs()
		set_publication()
		
	}
	
	function hide_unused_inputs() {

		for ( var key in targetSelectors ) {
			target = targetSelectors[key]
			var css_hidden_input = target.replace(']"]', '_selector]"]')
						
			if ( $(css_hidden_input).val() !== '' ) {
				if ( $(target).hasClass('wp-color-picker') ) {
					$(target).closest('p').show()
				} else {
					$(target).show()
				}
			} else {
				if ( $(target).hasClass('wp-color-picker') ) {
					$(target).closest('p').hide()
				} else {
					$(target).hide()
				}
			}
		}
	}

	// Switch layout when screenshot clicked
	$( '.fca_eoi_layout' ).click( function( e ) {

		// Determine the layout that was clicked
		var old_layout_id = $('#fca_eoi_layout_select').val()
		var layout_id = $( this ).data( 'layout-id' )
		
		// Mark active
		$( '.fca_eoi_layout' ).removeClass( 'active' )
		$( this ).addClass( 'active' )
		
		// Update hidden input value for new layout
		$( '#fca_eoi_layout_select' ).val( layout_id )
		
		//REBUILD LAYOUT, UNLESS ITS THE SAME ONE, JUST GO BACK
		if ( old_layout_id != layout_id ) {
			update_layout(layouts[layout_id], true)
		}		

		// Go back to the build tab
		$( '.postbox' ).show()
		$( '#fca_eoi_meta_box_setup' ).hide()
		$( '#fca_eoi_meta_box_build, #fca_eoi_meta_box_provider, #fca_eoi_meta_box_thanks, #fca_eoi_meta_box_publish' ).show()
		
		
		//Hide the animations unless the lightbox/popup layout type is selected
		if ( layout_id.indexOf('lightbox') != -1 ) {
			$( '.eoi-custom-animation-form' ).show()
		} else {
			//if there are no others, hide the whole box fca_eoi_meta_box_powerups
			var children = $( '#fca_eoi_meta_box_powerups' ).children(".inside").children()
			if (children.length == 1 && $(children[0]).hasClass('eoi-custom-animation-form') )  {
				$('#fca_eoi_meta_box_powerups').hide()
			}else {
				$( '.eoi-custom-animation-form' ).hide()
			}
		}
		destroy_tooltips()
		attach_tooltips()

	})
	
	function load_default_texts() {		
		if ( $('[name="fca_eoi[headline_copy]"]').val() === '' ) {
			$('[name="fca_eoi[headline_copy]"]').val('Free Email Updates')	
		}
		if ( $('[name="fca_eoi[description_copy]"]').val() === '' ) {
			$('[name="fca_eoi[description_copy]"]').val('Get the latest content first.')	
		}
		if ( $('[name="fca_eoi[name_placeholder]"]').val() === '' ) {
			$('[name="fca_eoi[name_placeholder]"]').val('First Name')	
		}
		if ( $('[name="fca_eoi[email_placeholder]"]').val() === '' ) {
			$('[name="fca_eoi[email_placeholder]"]').val('Email')	
		}
		if ( $('[name="fca_eoi[button_copy]"]').val() === '' ) {
			$('[name="fca_eoi[button_copy]"]').val('Join Now')	
		}
		if ( $('[name="fca_eoi[privacy_copy]"]').val() === '' ) {
			$('[name="fca_eoi[privacy_copy]"]').val('We respect your privacy.')	
		}		
	}

	//ACCORDION CLICK HANDLER
	$( '.accordion-section, .accordion-section-title' ).click(function() {
		var $parent = $(this).closest( '[id^="fca_eoi_fieldset_"]' )
		var field_id = $parent.attr('id')

		if ( field_id == 'fca_eoi_fieldset_error_text' && $parent.hasClass('open') ) {
			//error_tooltip.update()
		} else {
			//error_tooltip.hide_all()
		}
		$( '.fca_eoi_highlighted', '#fca_eoi_preview' ).removeClass( 'fca_eoi_highlighted' )
		// If nothing else was highlighted, highlight the whole form
		if ( $( '.fca_eoi_highlighted' ).length === 0 ) {
			$( '#fca_eoi_preview_form' ).addClass( 'fca_eoi_highlighted' )
		}
	})
	
	// Expand working fieldset
	var expand_fieldset = function ( fieldset_id ) {		
		$( '#fca_eoi_fieldset_' + fieldset_id + '.accordion-section:not(.open) .accordion-section-title').click()		
	}		
		
	$( '#fca_eoi_preview' ).click( function( event ) {
		if ( isNaN(event.clientX) ) {
			event.clientX = 0
		}
		if ( isNaN(event.clientY) ) {
			event.clientY = 0
		}
		var $element = $( document.elementFromPoint( event.clientX, event.clientY ) ).closest( '[data-fca-eoi-fieldset-id]' )		
		if ( $element.length > 0 ) {		
			expand_fieldset( $element.data( 'fca-eoi-fieldset-id' ) )		
		} else {		
			expand_fieldset( 'form' )		
		}		
	})		

	// Highlight current preview element
	$( '#fca_eoi_settings .accordion-section' ).each( function() {
	
		$(this).click( function() {
			$( '.fca_eoi_highlighted', '#fca_eoi_preview' ).removeClass( 'fca_eoi_highlighted' )
			var $fieldset = $( this )
			var $fieldset_id = $fieldset.attr( 'id' ).replace( 'fca_eoi_fieldset_', '' )
			var $element = $( '[data-fca-eoi-fieldset-id=' + $fieldset_id + ']', '#fca_eoi_preview' )

			// Highlight element or closest block level element
			if( $element.is( 'p, div, h1, h2, h3, h4, h5, h6' ) ) {
				$element.addClass( 'fca_eoi_highlighted' )
			} else {
				$element.closest( 'p, div, h1, h2, h3, h4, h5, h6' ).addClass( 'fca_eoi_highlighted' )
			}
			// If nothing else was highlighted, highlight the whole form
			if ( $( '.fca_eoi_highlighted' ).length === 0 ) {
				$( '#fca_eoi_preview_form' ).addClass( 'fca_eoi_highlighted' )
			}				
		})
	})
	
	/////////////////
	// PROVIDERS
	/////////////////
	
	// Show only the selected provider
	$( '[name="fca_eoi[provider]"]' ).change( function() {
		var provider_id = $( this ).val()
		$( '[id^=fca_eoi_fieldset_form_][id$=_integration]' ).slideUp( 'fast' )
		if ( provider_id ) {
			$( '#fca_eoi_fieldset_form_' + provider_id + '_integration' ).slideDown( 'fast' )
		}
	}).change()
	
	//////////////////
	// PUBLICATION METABOX
	//////////////////
	
	function set_publication() {
		$('#fca_eoi_publish_widget, #fca_eoi_publish_postbox, #fca_eoi_publish_lightbox').hide()
		var layout_id = $('#fca_eoi_layout_select').val()
		if ( layout_id.indexOf('postbox') != -1 ) {
			$('#fca_eoi_publish_postbox').show()
		} else if ( layout_id.indexOf('lightbox') != -1 ) {
			$('#fca_eoi_publish_lightbox').show()
		} else {
			$('#fca_eoi_publish_widget').show()
		}
	}
	
	// Show/hide popup publication modes
	$( 'input[name="fca_eoi[publish_lightbox_mode]"]' ).on( 'click change', function() {
		var $this = $( this )
		var mode = $this.val()
		var $mode = $( '#fca_eoi_publish_lightbox_mode_' + mode )
		$mode.removeClass( 'hidden' )
		$( '[id^=fca_eoi_publish_lightbox_mode_]' ).hide( 'fast' )
		if ( $this.prop( 'checked' ) ) {
			$mode.show( 'fast' )
		}
	} )
	
	$( 'input[name="fca_eoi[publish_lightbox_mode]"]' ).filter(':checked').click()
	$( 'input[name="fca_eoi[publish_lightbox_mode]"]' ).unbind('click')
	
	// Update popup link HTML code
	$( 'input[name="fca_eoi[lightbox_cta_text]"]' ).change( function() {
		var link = '<button data-optin-cat="{{post_ID}}">{{text}}</button>'
		$( 'input[name="fca_eoi[lightbox_cta_link]"]' ).val( link.replace( '{{post_ID}}', post_ID ).replace( '{{text}}', $( this ).val() ) )
	}).change()
		
	//////////////////
	// SAVE BUTTON
	//////////////////	
		
	// Change buttons texts 
	$('#publish').val('Save')

	// Override saving throbber text
	$( '#publish' ).click(function(){
		postL10n.publish = 'Saving'
		postL10n.update= 'Saving'
	})

	// Duplicate the Save button and add to the button of the page
	$( '#submitdiv' ).clone( true ).appendTo( '#normal-sortables' )
	
	// Add the Save button to each item
	$('.fca_eoi_layout_info').append( "<button type='button' class='button button-primary button-large fca-layout-button'>Select Layout</button>" )
	
	//FIX AN ISSUE WITH EMAIL FIELD NEEDING VALIDATION ON FORM SAVING
	$('input[name="save"]').click(function(){
		$('.fca_eoi_form_input_element').val('')
	})
	
	//////////////////
	// THANK YOU MODE
	//////////////////
		
	// Show/hide Thank you page modes
	currentThanksSetting = $( 'input[name="fca_eoi[thankyou_page_mode]"]:checked' ).val()
	if (currentThanksSetting == 'ajax') {
		$('#fca_eoi_thankyou_redirect').hide()
	} else {
		$('#fca_eoi_thankyou_ajax_msg').hide()		
	}
	
	//Turn on redirect mode as default
	if (currentThanksSetting === undefined) {
		$( 'input[name="fca_eoi[thankyou_page_mode]"]' ).first().prop("checked", true)
	}
	
	$( 'input[name="fca_eoi[thankyou_page_mode]"]' ).on( 'click change', function() {
		var $this = $( this )
		var mode = $this.val()
		
		if (mode == 'ajax') {
			$('#fca_eoi_thankyou_redirect').hide( 'fast' )
			$('#fca_eoi_thankyou_ajax_msg').show( 'fast' )
		} else {
			$('#fca_eoi_thankyou_redirect').show( 'fast' )
			$('#fca_eoi_thankyou_ajax_msg').hide( 'fast' )		
		}
	})
	
	// Hide new page link if Thank You Page is set
	$( 'select', '#fca_eoi_meta_box_thanks' ).change( function() {
		var $this = $( this )
		var $p = $( 'p', '#fca_eoi_meta_box_thanks' ).filter( ':last' )

		if( $this.val() ) {
			$p.hide()
		} else {
			$p.show()
		}
	}).change()
	
	//////////////////
	// ANIMATIONS
	//////////////////
	
	// Show/hide animations checkbox
	if (document.getElementById("fca_eoi_show_animation_checkbox")) {
		if (!($('#fca_eoi_show_animation_checkbox')[0].checked)) {
			$( '#fca_eoi_animations_div' ).hide()
		}
	}
		
	// Add toggle to animations checkbox
	$('#fca_eoi_show_animation_checkbox').click(function () {
		$("#fca_eoi_animations_div").toggle('fast')
	})
	
	//Display change text when you pick a new animation
	$( '#fca_eoi_animations' ).select2().on("select2-open", function() {
		$( "#fca_eoi_animations_choice_text" ).removeClass()
	})
		
	$( '#fca_eoi_animations' ).select2().on("select2-close", function() {
		if (this.value != 'None') {
			$( "#fca_eoi_animations_choice_text" ).addClass( 'animated ' + this.value )
			$( "#fca_eoi_animations_choice_text" ).text( "Solid choice!  You've selected a great entrance effect.")
			
		}else{
			$( "#fca_eoi_animations_choice_text" ).text('')
		}
	})
	
	///////////////
	// TAB NAVIGATION
	///////////////

	// Use tabs in the main metabox
	$( '.nav-tab-wrapper > a' ).click( function( e ) {
		var target_hash = $( this ).attr( 'href' )

		e.preventDefault()
		$( '.nav-tab-wrapper > a' ).removeClass( 'nav-tab-active' )
		$( this ).blur().addClass( 'nav-tab-active' )

		$( 'div[id^=fca_eoi_meta_box_]' ).not( '#fca_eoi_meta_box_nav' ).hide()
		$( target_hash ).show()
		
		if( '#fca_eoi_meta_box_build' == target_hash ) {
			$( '#fca_eoi_meta_box_provider' ).show()
			$( '#fca_eoi_meta_box_publish' ).show()
			$( '#fca_eoi_meta_box_thanks' ).show()
			$( '#fca_eoi_meta_box_powerups' ).show()
		}
	})
	
	// Use smaller tabs for layout types
	$( 'a[href^="#layouts_type_"]' ).click( function( e ) {
		var $this = $( this )
		e.preventDefault()
		$( 'a[href^="#layouts_type_"]' ).parent().removeClass( 'tabs' )
		$this.parent().addClass( 'tabs' )
		$( 'div[id^="layouts_type_"]' ).hide()
		$( $this.attr( 'href' ) ).show()
		$this.blur()
	} )

	///////////////
	// TOOLTIPS
	///////////////

	// Add default error text if it is empty
	if ( $( '[name="fca_eoi[error_text_field_required]"]' ).val() === '' ) {
		$( '[name="fca_eoi[error_text_field_required]"]' ).val("Error: This field is required.")
	}
	
	if ( $( '[name="fca_eoi[error_text_invalid_email]"]' ).val() === '' ) {
		$( '[name="fca_eoi[error_text_invalid_email]"]' ).val("Error: Please enter a valid email address. For example \"max@domain.com\".")
	}	
	
	var name_tooltip = {
		'selector' : '.fca_eoi_layout_name_field_inner input',
		'input' : '[name="fca_eoi[error_text_field_required]"]'
	}

	var email_tooltip = {
		'selector' : '.fca_eoi_layout_email_field_inner input',
		'input' : '[name="fca_eoi[error_text_invalid_email]"]'
	}
	
	// Attach tooltips
	function attach_tooltips () {
		$( name_tooltip.selector ).attr( 'title', $( name_tooltip.input ).val() )
		$( email_tooltip.selector ).attr( 'title', $( email_tooltip.input ).val() )
		$( name_tooltip.selector ).tooltipster({
			contentAsHTML: true,
			fixedWidth: ( $(name_tooltip.selector).outerWidth() * 0.8),
			minWidth: ( $(name_tooltip.selector).outerWidth() * 0.8),
			maxWidth: ( $(name_tooltip.selector).outerWidth() * 0.8),
			trigger: 'click',
			theme: ['tooltipster-borderless', 'tooltipster-optin-cat']
		} )
		$( email_tooltip.selector ).tooltipster({
			contentAsHTML: true,
			fixedWidth: ( $(email_tooltip.selector).outerWidth() * 0.8),
			minWidth: ( $(email_tooltip.selector).outerWidth() * 0.8),
			maxWidth: ( $(email_tooltip.selector).outerWidth() * 0.8),
			trigger: 'click',
			theme: ['tooltipster-borderless', 'tooltipster-optin-cat']
		} )
	}
	
	function destroy_tooltips() {
		if ( $( name_tooltip.selector ).hasClass('tooltipstered') ) {
			$( name_tooltip.selector ).tooltipster('destroy')
		}
		if ( $( email_tooltip.selector ).hasClass('tooltipstered') ) {
			$( email_tooltip.selector ).tooltipster('destroy')
		}
	}
	
	function hide_tooltips() {
		$( name_tooltip.selector ).tooltipster('hide')
		$( email_tooltip.selector ).tooltipster('hide')
		
	}
	
	function show_tooltips() {
		$( name_tooltip.selector+':visible' ).tooltipster('show')
		$( email_tooltip.selector+':visible' ).tooltipster('show')
	}
	
	//KEYUP HANDLERS FOR TOOLTIPS
	$( name_tooltip.input ).change(function(){
		$( name_tooltip.selector ).tooltipster('content', $(this).val() )
	})
		
	$( email_tooltip.input ).change(function(){
		$( email_tooltip.selector ).tooltipster('content', $(this).val() )
	})
	
	$('#fca_eoi_fieldset_error_text').click( show_tooltips )

	////////////
	// RANDOM STUFF
	////////////
	
	function ColorLuminance(hex, lum) {
		if ( typeof(hex) != 'string' || hex === '' || isNaN(parseFloat(lum)) ) {
			return false;
		}
		
		// validate hex string
		hex = String(hex).replace(/[^0-9a-f]/gi, '');
		if (hex.length < 6) {
			hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
		}
		lum = lum || 0;

		// convert to decimal and change luminosity
		var rgb = "#", c, i;
		for (i = 0; i < 3; i++) {
			c = parseInt(hex.substr(i*2,2), 16);
			c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
			rgb += ("00"+c).substr(c.length);
		}

		return rgb;
	}
	
	$( document ).on( 'submit', '#post', function () {
		$("#post").attr("enctype", "application/x-www-form-urlencoded")
		$("#post").attr("encoding", "application/x-www-form-urlencoded")
		$( window ).unbind( 'beforeunload' )
	})
	
	// Remove FOUC, don't show metaboxes and likes until page is fully loaded
	jQuery( '#poststuff' ).fadeTo( 1, '1' )

	// Apply select2
	$( 'select.select2' ).select2()
	
	// Disable enter doing accidential save
	$( document ).on( 'keypress', ':input:not(textarea)', function( e ) {
		if (e.keyCode == 13) {
			e.preventDefault()
		}
	})
	// Disable submit of the preview form
	$( document ).on( 'click', '#fca_eoi_preview input[type=submit]', function( e ) {
		e.preventDefault()
	})
	
	// Autoselect
	$(".autoselect").bind( 'click focus mouseenter', function(){ $( this ).select() }).mouseup( function(e){ e.preventDefault } )
	
	// SET STARTING STATE
	set_publication()
	if ( $('#fca_eoi_layout_select').hasClass('fca-new-layout') ) {
		$('#fca_eoi_show_setup').click()
		$('#fca_eoi_show_setup').removeClass('fca-new-layout')
	} else {
		//BUILD LAYOUT
		var layout_id = $('#fca_eoi_layout_select').val()
		update_layout(layouts[layout_id], false)
		$( '#fca_eoi_meta_box_setup' ).hide()
		$( '#fca_eoi_meta_box_build' ).show()
	}

})
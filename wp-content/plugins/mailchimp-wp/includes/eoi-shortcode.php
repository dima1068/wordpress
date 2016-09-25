<?php

class EasyOptInsShortcodes {

	var $settings;
	var $prerequisites = array();
	var $assets_enqueued = false;

	public function __construct( $settings = array() ) {
		global $pagenow, $typenow;

		$this->settings = $settings;

		// Add shortcode
		add_shortcode( $this->settings[ 'shortcode' ], array( $this, 'shortcode_content' ) );

		// Add shortcode aliases
		foreach ( $settings[ 'shortcode_aliases' ] as $shortcode) {
			add_shortcode( $shortcode, array( $this, 'shortcode_content' ) );
		}

		// Add shortcode generator button
		if ( FCA_EOI_EDITION != 'email_popup' && in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) && $typenow != 'download' ) {
			add_action( 'admin_head', array( $this, 'button_head' ) );
			add_action( 'media_buttons', array( $this, 'button' ), 1000 );
			add_action( 'admin_footer', array( $this, 'button_footer' ) );
		}

	}

	public function button_head() {
		?>

		<style>
			#fca-eoi-media-button {
				background: url(<?php echo FCA_EOI_PLUGIN_URL . '/icon.png' ?>) 0 -1px no-repeat;
				background-size: 16px 16px;
			}
		</style>

		<?php
	}

	public function button() {
		global $post;
		if (current_user_can( 'delete_pages' ) && $post->post_type != 'easy-opt-ins'){
		
			$button_title = __( 'Optin Cat' );
			
			if ( version_compare( $GLOBALS['wp_version'], '3.5', '<' ) ) {
				echo '<a href="#TB_inline?width=640&inlineId=fca-eoi-shortcode-thickbox" class="thickbox" title="' . $button_title . '">' . $button_title . '</a>';
			} else {
				$img = '<span class="wp-media-buttons-icon" id="fca-eoi-media-button"></span>';
				echo '<a href="#TB_inline?width=640&inlineId=fca-eoi-shortcode-thickbox" class="thickbox button" title="' . $button_title . '" style="padding-left: .4em;">' . $img . $button_title . '</a>';
			}
		}
	}

	public function button_footer() {
		$options = array();

		foreach ( get_posts( array( 'post_type' => 'easy-opt-ins', 'post_status' => 'publish', 'posts_per_page' => -1 ) ) as $post ) {
			$form_id = $post->ID;
			$layout = get_post_meta( $form_id, 'fca_eoi_layout', true );

			if ( ! empty( $layout ) && strpos( $layout, 'postbox_' ) === 0 ) {
				$options[ $form_id ] = empty( $post->post_title ) ? '(no title)' : $post->post_title;
			}
		}

		?>

		<script type="text/javascript">
			jQuery( function( $ ) {
				$( '#fca-eoi-shortcode-insert' ).on( 'click', function() {
					var id = $( '#fca-eoi-shortcode' ).val();

					if ( '' === id ) {
						alert( <?php echo json_encode( __( 'You must choose a form' ) ) ?> );
						return;
					}

					window.send_to_editor( '[<?php echo $this->settings[ 'shortcode' ] ?> id="' + id + '"]' );
				} );
			} );
		</script>
		<div id="fca-eoi-shortcode-thickbox" style="display: none;">
			<div class="wrap" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
				<p><?php _e('Use the form below to insert an Optin Cat shortcode .' ) ?></p>
				<div>
					<select id="fca-eoi-shortcode">
						<option value=""><?php _e( 'Please select...' ) ?></option>
						<?php foreach ( $options as $form_id => $title ) { ?>
							<option value="<?php echo (int) $form_id ?>"><?php echo esc_html( $title ) ?></option>
						<?php } ?>
					</select>
				</div>
				<p class="submit">
					<input type="button" id="fca-eoi-shortcode-insert" class="button-primary" value="<?php _e( 'Insert' ) ?>">
					<a id="fca-eoi-shortcode-cancel" class="button-secondary" onclick="tb_remove();" title="<?php _e( 'Cancel' ) ?>"><?php _e( 'Cancel' ) ?></a>
				</p>
			</div>
		</div>

		<?php
	}

	public function enqueue_assets() {
		$protocol = is_ssl() ? 'https' : 'http';
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'fontawesome', $protocol . '://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css' );

		wp_enqueue_script( 'fca_eoi_tooltipster', FCA_EOI_PLUGIN_URL . '/assets/vendor/tooltipster/tooltipster.bundle.min.js' );
		wp_enqueue_style( 'fca_eoi_tooltipster_css', FCA_EOI_PLUGIN_URL . '/assets/vendor/tooltipster/tooltipster.bundle.min.css' );
		wp_enqueue_style( 'fca_eoi_tooltipster_theme_css', FCA_EOI_PLUGIN_URL . '/assets/vendor/tooltipster/tooltipster-borderless.min.css' );
		
		wp_enqueue_script( 'fca_eoi_featherlight_js', FCA_EOI_PLUGIN_URL . '/assets/vendor/featherlight/release/featherlight.min.js' );
		wp_enqueue_style( 'fca_eoi_featherlight_css', FCA_EOI_PLUGIN_URL . '/assets/vendor/featherlight/release/featherlight.min.css' );

		wp_enqueue_style( 'fca_eoi', FCA_EOI_PLUGIN_URL . '/assets/style-new.css' );
		wp_enqueue_script( 'fca_eoi_script_js', FCA_EOI_PLUGIN_URL . '/assets/script.js' );

		//PASS VARIABLES TO JAVASCRIPT
		$data = array (
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' =>  wp_create_nonce( 'fca_eoi_submit_form' ),
		);
		
		wp_localize_script( 'fca_eoi_script_js', 'fca_eoi', $data );		
	}

	public function shortcode_content( $atts ) {

		$form_id = $atts['id'];

		/**
		 * Check that we have a valid post ID
		 */
		if( empty ( $form_id ) ) {
			return 'Missing form ID';
		}
		if( ! $post = get_post( $form_id ) ) {
			return 'Wrong form ID';
		}
		$animation = get_post_meta( $form_id, 'fca_eoi_animation', true);
		if (!empty ($animation) ) {
			wp_enqueue_style( 'fca_eoi_powerups_animate', FCA_EOI_PLUGIN_URL . '/assets/vendor/animate/animate.css' );
		}
		$this->enqueue_assets();
		$head = get_post_meta( $form_id, 'fca_eoi_head', true );
		
		$layout_id = get_post_meta ( $form_id, 'fca_eoi_layout', true );
		$layout    = new EasyOptInsLayout( $layout_id );
		
		if ( $layout->layout_type != 'lightbox' ) {
			$head .= '<script>' . EasyOptInsActivity::get_instance()->get_tracking_code( $form_id ) . '</script>';
		}		
		
		return $head;
	}
}

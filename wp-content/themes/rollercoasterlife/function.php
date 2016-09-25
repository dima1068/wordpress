<?php

	function theme_settings_init(){

		register_setting( 'theme_settings', 'theme_settings' );

	}

	 

	/*---------------------------------------------------

	add settings page to menu

	----------------------------------------------------*/

	function add_settings_page() {

		add_menu_page( __( 'rollercoasterlife' .' Theme Panel' ), __( 'rollercoasterlife' .' Theme Panel' ), 'manage_options', 'settings', 'theme_settings_page');
	}
	/*---------------------------------------------------

	add actions

	----------------------------------------------------*/

	add_action( 'admin_init', 'theme_settings_init' );

	add_action( 'admin_menu', 'add_settings_page' );

	/*--------------------------------------------------

	Theme Panel Output

	----------------------------------------------------*/
	function theme_settings_page() {
	    ?>
	     <div class="wrap">
	         <div id="icon-options-general"></div>
	         <h2><?php _e( ' Theme Options' ) //your admin panel title ?></h2>
	         <ul>
	             <li>View Documentation |</li>
	             <li>Visit Support </li>
	         </ul>
	         <p><span>Theme version</span></p>
	         <div class="footer-credit">
	            <p>This theme was made by <a title="Anang pratika" href="http://anangpratika.wordpress.com" target="_blank" >Anang Pratika</a>.</p>
	         </div>
	     </div>
	     <?php
	}
?>
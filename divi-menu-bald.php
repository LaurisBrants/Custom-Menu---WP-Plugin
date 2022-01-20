<?php

/**

 * Plugin Name: Custom DIVI menu

 * Plugin URI: https://kellenberger-interactive.ch/

 * Description: Custom Divi Menu

 * Author: Kellenberger Interactive

 * Version: 1.1

 * Author URI: https://kellenberger-interactive.ch/

 * Text Domain: dbm-divi-menu

 * Domain Path: /languages

 * License: GPL-2.0+

 */



 // Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



//Definitions

define( 'DMB_VERSION', '1.0.' ); // Left for legacy purposes.

define( 'DMB_WP_VERSION', get_bloginfo( 'version' ) );



function dbm_init() {

	require_once plugin_dir_path( __FILE__ ) . 'classes/class-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-views.php';	

}

add_action( 'init', 'dbm_init' );



function dbm_deactivation() {

	flush_rewrite_rules();

}



register_deactivation_hook( __FILE__, 'dbm_deactivation' );



function dbm_load_textdomain() {

	load_plugin_textdomain( 'dbm-divi-menu' );

}



add_action( 'plugins_loaded', 'dbm_load_textdomain' );



function load_styles() {

	$plugin_url = plugin_dir_url( __FILE__ );

	wp_enqueue_script( 'menu-loader',  $plugin_url . '/js/custom-menu.js', array(), '1.0.0', true );

	wp_enqueue_style( 'style',  $plugin_url . "css/style.css");

}

add_action( 'wp_enqueue_scripts', 'load_styles' );

function loadFontAwesome(){

	wp_register_style('all',plugin_dir_url( __FILE__ ) . 'css/all.css' , false, 1.0, 'all');
	wp_enqueue_style('all');

}

add_action( 'wp_enqueue_scripts', 'loadFontAwesome' );

function load_admin_menus(){

	add_submenu_page( 
		'options-general.php', 		
		'Custom Menu Settings', 		
		'Custom Menu Settings', 
		'manage_options',
		'dbm_settings',		
		'dbmGeneral',
	);
}

add_action('admin_menu', 'load_admin_menus');

function loadMenu($data){
	
	echo $data;
}
add_action('body_begin', 'my_function');

function dbm_menu_shortcode($target){

	    $point= $target['target'];
		$option = 'dbm_menu_selector_'.$point;
		$menu = CustomDiviMenu::callMenu(get_option($option),$point);
		loadMenu($menu['menu']);
		return $menu['burger'];

	

}

add_shortcode('dbm-divi-menu', 'dbm_menu_shortcode');
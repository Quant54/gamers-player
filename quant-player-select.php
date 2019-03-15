<?php 
/*
Plugin Name: Player Select Plugin 
Plugin URI: https://quant54.github.io/
Description: Player Select Plugin 
Version: 1.0.0
Author: Vadim "Quant" Farrakhov
Author URI: https://quant54.github.io/
License: GPL 
Text Domain: quant-plugin
*/


if ( ! function_exists( 'add_action' ) ) {
	echo 'Hey, you can\'t access this file, you silly human!'; 
	exit;
}


$dir = plugin_dir_path(__FILE__);
require ($dir.'player-select-cpt.php');
require ($dir.'player-select-shortcode.php');
require ($dir.'player-select-fields.php');

function add_style_and_script(){
	$path_plugin = plugin_dir_url(__FILE__);
	wp_enqueue_style('player-plugin-css',$path_plugin.'css/player-plugin-style.css');
	wp_enqueue_style('awesome-css','https://use.fontawesome.com/releases/v5.7.2/css/all.css');
}

add_action( 'wp_enqueue_scripts','add_style_and_script');


// add_action('admin_menu', 'register_my_custom_submenu_page');

// function register_my_custom_submenu_page() {
// 	add_submenu_page( 'tools.php', 'Setting Players Section', 'Setting Players Section', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' ); 
// }

// function my_custom_submenu_page_callback() {
// 	// контент страницы
// 	echo '<div class="wrap">';
// 		echo '<h2>'. get_admin_page_title() .'</h2>';
// 	echo '</div>';

// }
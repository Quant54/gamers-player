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
$dirps = $dir.'inc/player-select/';
$dirss = $dir.'inc/social-slider/';
$direp = $dir.'inc/event-plan/';
require ($dirps.'player-select-cpt.php');
require ($dirps.'player-select-shortcode.php');
require ($dirps.'player-select-fields.php');

require ($dirss.'social-slider-shortcode.php');
require ($dirss.'social-slider-cpt.php');
require ($dirss.'social-slider-fields.php');

require ($direp.'event-plan-cpt.php');
require ($direp.'event-plan-fields.php');
require ($direp.'event-plan-shortcode-online.php');


function add_style_and_script_boostrap(){
		$path_plugin = plugin_dir_url(__FILE__);
		wp_enqueue_style('awesome-css','https://stackpath.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');
	//	wp_enqueue_script('carousel_bs_js','https://stackpath.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js' ); 
		wp_enqueue_script('carousel_bs_js',$path_plugin.'js/carousel.js' ); 
		wp_enqueue_script('transition_bs_js',$path_plugin.'js/transition.js' ); 
}
function add_style_and_script(){
	$path_plugin = plugin_dir_url(__FILE__);
	wp_enqueue_style('player-select-css',$path_plugin.'css/player-plugin-style.css');
	wp_enqueue_style('social-slider-css',$path_plugin.'css/social-slider-style.css',false,'1.2');
	wp_enqueue_style('event-plan-style',$path_plugin.'css/event-plan-style.css',false,'1.22');
	// need to delete after prod
//	wp_enqueue_style('awesome-css','https://use.fontawesome.com/releases/v5.7.2/css/all.css');
	// end for delete
}
add_action( 'wp_enqueue_scripts', 'add_style_and_script_boostrap' );
add_action( 'get_footer','add_style_and_script');


<?php

function load_stylesheet() {
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), false, 'all' );
	wp_enqueue_style( 'bootstrap' );
	wp_register_style( 'style', get_template_directory_uri() . '/css/style.css', array(), false, 'all' );
	wp_enqueue_style( 'style' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), false, 'all' );
	wp_enqueue_style( 'font-awesome' );
	wp_register_style( 'themify-icons', get_template_directory_uri() . '/css/themify-icons.css', array(), false, 'all' );
	wp_enqueue_style( 'bootstrap' );
}
add_action( 'wp_enqueue_scripts', 'load_stylesheet' );

function load_jquery() {
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3-4.js', '', 1, true );
}
add_action( 'wp_enqueue_scripts', 'load_jquery' );

function load_scripts() {
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', '', 1, true );
	wp_enqueue_script( 'bootstrap' );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );



//SIDEBAR

function theme_register_sidebars() {
	register_sidebar(
		array(
			'name' => 'Main Sidebar',
			'id' => 'main-sidebar',
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'theme_register_sidebars' );



//SKRIPTE

require_once get_template_directory() . '/theme-settings/theme-settings.php';

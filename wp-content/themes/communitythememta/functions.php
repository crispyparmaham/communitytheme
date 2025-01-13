<?php

//LOAD STYLESHEETS
function load_stylesheet() {
	wp_register_style( 'main', get_template_directory_uri() . '/assets/css/base/main.css', array(), false, 'all' );
	wp_enqueue_style( 'main' );
	wp_register_style( 'grid', get_template_directory_uri() . '/assets/css/layout/grid.css', array(), false, 'all' );
	wp_enqueue_style( 'grid' );
	wp_register_style( 'header', get_template_directory_uri() . '/assets/css/layout/header.css', array(), false, 'all' );
	wp_enqueue_style( 'header' );
	wp_register_style( 'footer', get_template_directory_uri() . '/assets/css/layout/footer.css', array(), false, 'all' );
	wp_enqueue_style( 'footer' );
	wp_register_style( 'sidebar', get_template_directory_uri() . '/assets/css/layout/sidebar.css', array(), false, 'all' );
	wp_enqueue_style( 'sidebar' );
	wp_register_style( 'theme', get_template_directory_uri() . '/assets/css/layout/theme.css', array(), false, 'all' );
	wp_enqueue_style( 'theme' );
}
add_action( 'wp_enqueue_scripts', 'load_stylesheet' );

function load_jquery() {
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3-4.js', '', 1, true );
}
add_action( 'wp_enqueue_scripts', 'load_jquery' );


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

wp_enqueue_style('custom-fields', get_template_directory_uri() . '/custom-fields.php');
wp_enqueue_style('dynamic-styles', get_template_directory_uri() . '/assets/includes/dynamic-styles.php');




//GENERATE CSS

function enqueue_theme_styles() {
    // Haupt-Stylesheet
    wp_enqueue_style('main-style', get_stylesheet_uri());

    // Variables CSS
    wp_enqueue_style('variables-style', get_template_directory_uri() . '/assets/css/variables.css', [], filemtime(get_template_directory() . '/assets/css/variables.css'));
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');


function generate_dynamic_css() {
    // Pfad zur variables.css
    $css_file = get_template_directory() . '/assets/css/variables.css';

    // Farben aus ACF abrufen
    $primary_color = get_field('primary_color', 'option') ?: '#000000';
    $secondary_color = get_field('secondary_color', 'option') ?: '#ffffff';
    $background_color = get_field('background_color', 'option') ?: '#f5f5f5';

    $css_content = "
:root {
    --primary-color: {$primary_color};
    --secondary-color: {$secondary_color};
    --background-color: {$background_color};
}";

    // CSS-Datei aktualisieren
    file_put_contents($css_file, $css_content);
}

add_action('acf/save_post', function ($post_id) {
    if ($post_id === 'options') {
        generate_dynamic_css();
    }
});





function populate_selected_menu_field( $field ) {
    $field['choices'] = [];

    // Abrufen aller registrierten Menüs
    $menus = wp_get_nav_menus();

    if ( ! empty( $menus ) ) {
        foreach ( $menus as $menu ) {
            $field['choices'][ $menu->term_id ] = $menu->name; // ID und Name des Menüs
        }
    }

    return $field;
}

// Diesen Filter auf das "selected_menu"-Feld anwenden
add_filter( 'acf/load_field/name=selected_menu', 'populate_selected_menu_field' );



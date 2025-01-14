<?php

//LOAD STYLESHEETS
function load_stylesheet() {
	//BASE
	wp_register_style( 'main', get_template_directory_uri() . '/assets/css/base/main.css', array(), false, 'all' );
	wp_enqueue_style( 'main' );

	//LAYOUT
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

	//UTILS
	wp_register_style( 'button', get_template_directory_uri() . '/assets/css/utils/button.css', array(), false, 'all' );
	wp_enqueue_style( 'button' );
	wp_register_style( 'typography', get_template_directory_uri() . '/assets/css/utils/typography.css', array(), false, 'all' );
	wp_enqueue_style( 'typography' );


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

	//GRID

	$innerContentWidth = get_field('inner_content_width', 'option') ? get_field('inner_content_width', 'option') . "px" : "1120px";
	$innerHeaderWidth = get_field('inner_header_width', 'option') ? get_field('inner_header_width', 'option') . "px" : "1120px";
	$innerFooterWidth = get_field('inner_footer_width', 'option') ? get_field('inner_footer_width', 'option') . "px" : "1120px";

    //COLORS
    $primaryColor = get_field('primary_color', 'option');
    $secondaryColor = get_field('secondary_color', 'option');

    $backgroundBodyColor = get_field('background_body_color', 'option');
    $backgroundHeaderColor = get_field('background_header_color', 'option');
    $backgroundFooterColor = get_field('background_footer_color', 'option');

    $buttonRootColor = get_field('button_color', 'option');
    $buttonHoverColor = get_field('button_hover_color', 'option');

	// FONTS

    $headlineXS = get_field('h_six', 'option') . "px";
    $headlineS = get_field('h_five', 'option') . "px";
    $headlineM = get_field('h_four', 'option') . "px";
    $headlineL = get_field('h_three', 'option') . "px";
    $headlineXL = get_field('h_two', 'option') . "px";
    $headlineXXL = get_field('h_one', 'option') . "px";
    $bodyText = get_field('body_text', 'option') . "px";

	$fontFamilyHeading = get_field('font_heading', 'option');
	$fontFamilyText = get_field('font_text', 'option');

	$fontColorHeading = get_field('font_color_heading', 'option');
	$fontColorText = get_field('font_color_text', 'option');
	$fontColorHeader = get_field('font_color_header', 'option');
	$fontColorFooter = get_field('font_color_footer', 'option');
	$fontColorHeaderHover = get_field('font_color_header_hover', 'option');
	$fontColorFooterHover = get_field('font_color_footer_hover', 'option');

    $css_content = "
:root {
    --primary-color: {$primaryColor};
    --secondary-color: {$secondaryColor};

    --body-background-color: {$backgroundBodyColor};
    --header-background-color: {$backgroundHeaderColor};
    --footer-background-color: {$backgroundFooterColor};

    --button-root-color: {$buttonRootColor};
    --button-hover-color: {$buttonHoverColor};

    --headline-xs: {$headlineXS};
    --headline-s: {$headlineS};
    --headline-m: {$headlineM};
    --headline-l: {$headlineL};
    --headline-xl: {$headlineXL};
    --headline-xxl: {$headlineXXL};
    --body-text-size: {$bodyText};

    --inner-content-width: {$innerContentWidth};
    --inner-header-width: {$innerHeaderWidth};
    --inner-footer-width: {$innerFooterWidth};

    --font-family-heading: {$fontFamilyHeading};
    --font-family-text: {$fontFamilyText};

    --font-color-heading: {$fontColorHeading};
    --font-color-text: {$fontColorText};
    --font-color-header: {$fontColorHeader};
    --font-color-footer: {$fontColorFooter};
    --font-color-header-hover: {$fontColorHeaderHover};
    --font-color-footer-hover: {$fontColorFooterHover};
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



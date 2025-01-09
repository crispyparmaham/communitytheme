<?php
function theme_customize_register( $wp_customize ) {
    // Logo
    $wp_customize->add_section( 'theme_logo_section', array(
        'title'       => __( 'Logo' ),
        'priority'    => 30,
    ));

    $wp_customize->add_setting( 'theme_logo', array(
        'default'     => '',
        'transport'   => 'refresh',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_logo', array(
        'label'       => __( 'Logo' ),
        'section'     => 'theme_logo_section',
        'settings'    => 'theme_logo',
    )));

    // Menü
    $wp_customize->add_section( 'theme_menu_section', array(
        'title'       => __( 'Menü' ),
        'priority'    => 40,
    ));

    $wp_customize->add_setting( 'theme_menu_location', array(
        'default'     => 'primary',
        'transport'   => 'refresh',
    ));

    $wp_customize->add_control( 'theme_menu_location', array(
        'label'       => __( 'Menü-Position' ),
        'section'     => 'theme_menu_section',
        'type'        => 'select',
        'choices'     => array(
            'primary'     => __( 'Hauptmenü' ),
            'footer'      => __( 'Footer-Menü' ),
        ),
    ));

    // Weitere Einstellungen für Farbschema oder andere Optionen können hier hinzugefügt werden
}

add_action( 'customize_register', 'theme_customize_register' );

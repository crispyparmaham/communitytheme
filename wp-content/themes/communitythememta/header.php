<!DOCTYPE html>
<html lang="de">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="main-header">
    <div class="header-inner-wrap">
        <?php
        // Logo von der Optionsseite abrufen
        $logo = get_field('logo', 'option');
        $logo_size = get_field('logo_size', 'option');
        
        if ($logo) :
            $logo_class = '';
            $logo_style = '';

            switch ($logo_size) {
                case 'small':
                    $logo_class = 'logo-small';
                    break;
                case 'medium':
                    $logo_class = 'logo-medium';
                    break;
                case 'large':
                    $logo_class = 'logo-large';
                    break;
            }
        ?>
            <div class="main-logo <?php echo esc_attr($logo_class); ?>">
                <a href="/"><img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" <?php echo $logo_style; ?>></a>
            </div>
        <?php else : ?>
            <h1><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php endif; ?>

        <?php
        $selected_menu_id = get_field('selected_menu', 'option'); 

        if ( $selected_menu_id ) :
            wp_nav_menu(array(
                'menu' => $selected_menu_id,
                'container' => 'nav',
                'container_class' => 'main-navigation',
            ));
        else :
            echo '<p>' . __('Kein Menü ausgewählt.', 'communitytheme') . '</p>';
        endif;
        
        ?>
    </div>
</header>



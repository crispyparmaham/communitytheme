<!DOCTYPE html>
<html lang="de">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
    <div class="main-header" style="--header-background-color: <?php echo esc_attr(get_field('background-color', 'option')); ?>;">
        <?php
        // Logo von der Optionsseite abrufen
        $logo = get_field('logo', 'option'); 
        $logo_size = get_field('logo_size', 'option');
        if ($logo) : 
            // Setzen die CSS-Klasse oder Inline-Stile basierend auf der Logo-Größe
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
                default:
                    $logo_class = '';
            }

            // Falls eine benutzerdefinierte Größe im Textfeld eingegeben wurde
            if ($logo_size && !in_array($logo_size, ['small', 'medium', 'large'])) {
                $logo_style = 'style="width: ' . esc_attr($logo_size) . ';"'; 
            }
        ?>
            <div class="main-logo <?php echo esc_attr($logo_class); ?>">
                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" <?php echo $logo_style; ?>>
            </div>
        <?php else : ?>
            <h1><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php endif; ?>
        <nav>
            <?php
            $selected_menu_id = get_option('communitytheme_selected_menu');
            if ($selected_menu_id) {
                wp_nav_menu(array(
                    'menu' => $selected_menu_id,
                    'container' => 'nav',
                    'container_class' => 'main-navigation',
                ));
            } else {
                echo '<p>' . __('Kein Menü ausgewählt.', 'communitytheme') . '</p>';
            }
            ?>
        </nav>
    </div>
</header>


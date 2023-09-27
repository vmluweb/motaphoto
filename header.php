<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="top">
        <div class="top_logo">
            <a href="<?php echo home_url('/'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png" alt="Logo">
            </a>
        </div>

        <?php wp_nav_menu(array(
            'theme_location' => 'main',
            'container' => 'nav',
            'container_class' => 'top_menu_container',
            'menu_id' => 'top_menu',
            'menu_class' => 'top_menu',

        )); ?>
    </header>
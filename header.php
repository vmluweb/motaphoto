<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="top site-header">
        <div class="main-navigation">
            <div class="top_logo site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png" alt="Logo">
                </a>
            </div>

            <div class="burgerMenu">
                <!-- Icones menu burger -->
                <div id="icons"></div>
            </div>


            <?php wp_nav_menu(array(
                'theme_location' => 'main',
                'container' => 'nav',
                'container_class' => 'menu-navigation',
                'menu_id' => 'top_menu',
                'menu_class' => 'top_menu',

            )); ?>
        </div>
    </header>
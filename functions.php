<?php

// Prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Ajout du titre du site dans la balise title
add_theme_support('title-tag');

add_action('wp_enqueue_scripts', 'motaphoto_register_assets');
function motaphoto_register_assets()
{
    // Chargement du fichier CSS
    wp_enqueue_style(
        'motaphoto-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        '1.0'
    );
    wp_enqueue_style('jquery-ui-css', 'https://cdn.jsdelivr.net/npm/jquery-ui@1.13.2/themes/base/theme.min.css', array('jquery'), '1.13.2');
}

add_action('wp_enqueue_scripts', 'custom_scripts');
function custom_scripts()
{
    // Chargement jQuery
    wp_enqueue_script('jquery');

    wp_enqueue_script('script-modal', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js', array('jquery'), '0.9.2', true);

    // Chargement des scripts javascript
    wp_enqueue_script(
        'script-popup',
        get_template_directory_uri() . '/assets/scripts/popup.js'
    );

    wp_enqueue_script(
        'script-custom-navigation',
        get_template_directory_uri() . '/assets/scripts/custom-navigation.js'
    );
}

// Personnalisation des menus: en-tête et pied-de-page
register_nav_menus(array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
));

// Ajout d'un ID à l'élément #menu-item-42 > a
add_filter('nav_menu_link_attributes', 'add_class_to_menu_item_42_link', 10, 3);
function add_class_to_menu_item_42_link($atts, $item, $args)
{

    if ($item->ID == 42) {
        $atts['class'] = 'popup_link';
    }
    return $atts;
}


require_once get_template_directory() . '/inc/custom-navigation.php';

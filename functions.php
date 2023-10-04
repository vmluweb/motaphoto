<?php

// Prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Ajout du titre du site dans la balise title
add_theme_support('title-tag');


function motaphoto_register_assets()
{
    // Chargement jQuery
    wp_enqueue_script('jquery');

    wp_enqueue_script('script-modal', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js', array('jquery'), '0.9.2', true);

    // Chargement du fichier CSS
    wp_enqueue_style(
        'motaphoto-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'motaphoto_register_assets');

function custom_script()
{
    // Chargement le JS
    wp_enqueue_script(
        'custom_script',
        get_template_directory_uri() . '/assets/scripts/script.js'
    );
}
add_action('wp_enqueue_scripts', 'custom_script');


register_nav_menus(array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
));

// Ajout d'un ID à l'élément #menu-item-42 > a
function add_class_to_menu_item_42_link($atts, $item, $args)
{

    if ($item->ID == 42) {
        $atts['class'] = 'popup_link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_class_to_menu_item_42_link', 10, 3);

// Ajout d'un custom type personnalisé
function catalogue_register_post_types()
{

    // CPT catalogue photo
    $labels = array(
        'name' => 'Photo',
        'all_items' => 'Toutes les photos',
        'singular_name' => 'Photo',
        'add_new_item' => 'Ajouter une photo',
        'edit_item' => 'Modifier la photo',
        'menu_name' => 'Photo'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array('title', 'thumbnail'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-gallery',
    );

    register_post_type('photo', $args);
}

add_action('init', 'catalogue_register_post_types');

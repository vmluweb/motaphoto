<?php

// Ajouter la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support('title-tag');

function motaphoto_register_assets()
{
    // chargement jQuery
    wp_enqueue_script('jquery');

    // chargement le JS
    wp_enqueue_script(
        'motaphoto',
        get_template_directory_uri() . '/assets/scripts/script.js',
        array('jquery'),
        '1.0',
        true
    );

    // chargement du fichier CSS
    wp_enqueue_style(
        'motaphoto',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'motaphoto_register_assets');

register_nav_menus(array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
));

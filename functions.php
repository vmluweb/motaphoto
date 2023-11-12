<?php

/**  SOMMAIRE
 ******************************************************************
 * 01_Prise en charge des images mises en avant pour le thème Motaphoto
 * 02_Prise en charge automatique de la balise "title" du site
 * 03_Enregistrement des fichiers CSS du thème
 * 04_Enregistrement des scripts personnalisés du thème
 * 05_Enregistrement des emplacements de menu pour l'en-tête et le pied-de-page
 * 06_Ajout d'une classe à un lien de menu spécifique: #menu-item-42 > a
 */

/**
 *  01_Prise en charge des images mises en avant pour le thème Motaphoto
 * 
 */
add_theme_support('post-thumbnails');

/**
 *  02_Prise en charge automatique de la balise "title" du site
 * 
 */
add_theme_support('title-tag');

/**
 *  03_Enregistrement des fichiers CSS du thème
 * 
 */
add_action('wp_enqueue_scripts', 'motaphoto_register_assets');
function motaphoto_register_assets()
{
    wp_enqueue_style(
        'fancybox-style',
        get_template_directory_uri() . '/assets/css/jquery.fancybox.css',
        array()
    );

    wp_enqueue_style(
        'motaphoto-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        '1.0'
    );
    wp_enqueue_style(
        'motaphoto-responsive',
        get_template_directory_uri() . '/assets/css/media-queries.css',
        array(),
        '1.0'
    );
}

/**
 *  04_Enregistrement des scripts personnalisés pour le thème
 * 
 */
add_action('wp_enqueue_scripts', 'custom_scripts');
function custom_scripts()
{
    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'modal',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js',
        array('jQuery'),
    );

    wp_enqueue_script(
        'fancybox-script',
        get_template_directory_uri() . '/assets/scripts/jquery.fancybox.min.js',
        array('jquery'),
    );

    wp_enqueue_script(
        'fancybox-custom-script',
        get_template_directory_uri() . '/assets/scripts/jquery.fancybox-init.js'
    );

    wp_enqueue_script(
        'script-custom-navigation',
        get_template_directory_uri() . '/assets/scripts/custom-navigation.js'
    );

    wp_enqueue_script(
        'script-custom-motaphoto',
        get_template_directory_uri() . '/assets/scripts/custom-motaphoto.js'
    );

    wp_enqueue_script(
        'script-popup',
        get_template_directory_uri() . '/assets/scripts/popup.js'
    );
}

/**
 *  05_Enregistrement des emplacements de menu pour l'en-tête et le pied-de-page
 * 
 */
register_nav_menus(array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
));

/**
 *  06_Ajout d'une classe à un lien de menu spécifique: #menu-item-42 > a
 * 
 */
add_filter('nav_menu_link_attributes', 'add_class_to_menu_item_42_link', 10, 3);
function add_class_to_menu_item_42_link($atts, $item, $args)
{

    if ($item->ID == 42) {
        $atts['class'] = 'popup_link';
    }
    return $atts;
}

require_once get_template_directory() . '/inc/custom-navigation.php';

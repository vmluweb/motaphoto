<?php

// Ajout d'un custom post type personnalisé
add_action('init', 'catalogue_register_post_types');
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

// Tri par date des publications: des plus anciennes aux plus récentes
add_action('pre_get_posts', 'custom_photo_query');
function custom_photo_query($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if (is_single()) {
            $query->set('post_type', 'photo');
            $query->set('post_status', 'publish');
            $query->set('posts_per_page', -1);
            $query->set('order', 'ASC');
        }
    }
}

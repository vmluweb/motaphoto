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
            // $query->set('posts_per_page', -1);
            $query->set('order', 'ASC');
        }
    }
}

add_action('wp_enqueue_scripts', 'add_ajax_object');
function add_ajax_object()
{
    // Récupération des catégories du post courant
    $categories = get_the_terms(get_the_ID(), 'categorie');
    $current_category = '';
    if ($categories && count($categories) >= 1) {
        $current_category = $categories[0]->slug;
    }

    // Récupération du post_id
    $post_id = get_the_ID();

    wp_localize_script('script-custom-navigation', 'myAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'currentCategory' => $current_category,
        'postID' => $post_id,
    ));
}

add_action('wp_ajax_load_more_post_single', 'load_more_post_single');
add_action('wp_ajax_nopriv_load_more_post_single', 'load_more_post_single');

function load_more_post_single()
{
    $response = '';

    $post_id = $_POST['post_id'];
    $current_categories = get_the_terms($post_id, 'categorie');

    if ($current_categories && count($current_categories) > 0) {
        $category_slugs = array(); // Création d'un tableau pour stocker les slugs des catégories
        foreach ($current_categories as $category) {
            $category_slugs[] = $category->slug; // Ajout des slugs des catégories au tableau
        }

        $ajaxposts = new WP_Query([
            'post_type' => 'photo',
            'posts_per_page' => 2,
            'paged' => $_POST['paged'],
            'tax_query' => [
                [
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $category_slugs, // Utilisation des slugs des catégories de la publication courante
                ],
            ],
        ]);

        if ($ajaxposts->have_posts()) {
            while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
                $response .= get_template_part('template-parts/photo_block', '', false);
            endwhile;
        }
    }

    echo $response;
    exit;
}

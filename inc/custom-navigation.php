<?php

/**  SOMMAIRE
 ******************************************************************
 * 01_Enregistrement du type de publication personnalisé "Photos" pour le catalogue
 * 02_Personnalisation de la requête principale pour les pages de type "single"
 * 03_Enregistrement des objets pour les requêtes AJAX
 * 04_Fonction de filtrage des publications via AJAX
 * 05_Fonction AJAX pour charger davantage de photos
 */

/**
 * 01_Enregistrement du type de publication personnalisé "Photos" pour le catalogue
 *
 */
add_action('init', 'catalogue_register_post_types');
function catalogue_register_post_types()
{

    // CPT catalogue photo
    $labels = array(
        'name' => 'Photos',
        'all_items' => 'Toutes les photos',
        'singular_name' => 'Photo',
        'add_new_item' => 'Ajouter une photo',
        'edit_item' => 'Modifier la photo',
        'menu_name' => 'Photos'
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

    register_post_type('photos', $args);
}

/**
 * 02_Personnalisation de la requête principale pour les pages de type "single"
 *
 */
add_action('pre_get_posts', 'custom_photo_query');
function custom_photo_query($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if (is_single()) {
            $query->set('post_type', 'photos');
            $query->set('post_status', 'publish');
            $query->set('order', 'ASC');
        }
    }
}

/**
 * 03_Enregistrement des objets pour les requêtes AJAX
 *
 */
add_action('wp_enqueue_scripts', 'add_ajax_object');
function add_ajax_object()
{
    // Récupération du post_id
    $post_id = get_the_ID();

    // Récupération des catégories du post courant
    $categories = get_the_terms(get_the_ID(), 'categorie');
    $current_category = '';
    if ($categories && count($categories) >= 1) {
        $current_category = $categories[0]->slug;
    }

    wp_localize_script('script-custom-navigation', 'myAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'currentCategory' => $current_category,
        'postID' => $post_id,
        'post__not_in' => $post_id,
    ));
}

/**
 * 04_Fonction de filtrage des publications via AJAX
 *
 */
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
function filter_photos()
{
    $categorie = $_POST['categorie'];
    $format = $_POST['format'];
    $year = $_POST['year'];

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 12,
    );

    $tax_query = array();

    if (!empty($categorie) && !empty($format) &&  !empty($year)) {
        $tax_query['relation'] = 'AND';
    }

    if (!empty($categorie)) {
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field' => 'id',
            'terms' => $categorie,
            'operator' => 'IN',
        );
    }
    if (!empty($format)) {
        $tax_query[] = array(
            'taxonomy' => 'format',
            'field' => 'id',
            'terms' => $format,
            'operator' => 'IN',
        );
    }

    if ($year) {
        $args['year'] = $year;
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            get_template_part('template-parts/photos-block');
        endwhile;
        wp_reset_postdata();
    else :
        echo '<div class="fail_filters">Aucun résultat trouvé pour cette sélection</div>';

    endif;

    die();
}

/**
 * 05_Fonction AJAX pour charger davantage de photos
 *
 */
add_action('wp_ajax_load_more_post', 'load_more_post');
add_action('wp_ajax_nopriv_load_more_post', 'load_more_post');
function load_more_post()
{
    $selectedCategory = $_POST['categorie'];
    $selectedFormat = $_POST['format'];
    $selectedYear = $_POST['year'];
    $paged = $_POST['paged'];

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 12,
        'paged' => $paged,
    );

    if (!empty($selectedCategory) || !empty($selectedFormat) || !empty($selectedYear)) {
        $args['tax_query'] = array('relation' => 'AND');

        if (!empty($selectedCategory)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categorie',
                'field' => 'id',
                'terms' => $selectedCategory,
                'operator' => 'IN',
            );
        }

        if (!empty($selectedFormat)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'format',
                'field' => 'id',
                'terms' => $selectedFormat,
                'operator' => 'IN',
            );
        }

        if (!empty($selectedYear)) {
            $args['date_query'] = array(
                array(
                    'year' => $selectedYear,
                ),
            );
        }
    }

    $ajaxposts = new WP_Query($args);

    $response = '';
    $max_pages = $ajaxposts->max_num_pages;

    if ($ajaxposts->have_posts()) {
        ob_start();
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            $response .= get_template_part('template-parts/photos-block', '', false);
        endwhile;
        $output = ob_get_contents();
        ob_end_clean();
    } else {
        $response = '';
    }

    $result = [
        'max' => $max_pages,
        'html' => $output,
    ];

    wp_reset_postdata();

    echo json_encode($result);
    exit;
}

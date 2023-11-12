<?php

/** 
 * Récupération des informations de l'image et des termes de catégorie pour une publication
 */
$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
$image_url = $image_url[0];
$reference = get_field('reference');
$categories = get_the_terms(get_the_ID(), 'categorie');
$category_list = '';

if ($categories && !is_wp_error($categories)) {

    foreach ($categories as $category) {
        $category_list .= $category->name . ', ';
    }
    $category_list = rtrim($category_list, ', ');
}
?>

<article class="gallery_card">
    <img src="<?php echo $image_url; ?>" class="gallery_image lightbox" alt="<?php the_title() ?>">

    <div class="overlay_post">
        <div class="overlay_post_header">
            <a href="<?php echo $image_url; ?>" data-fancybox="gallery">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_fullscreen.png" alt="fullscreen">
            </a>
        </div>

        <div class="overlay_post_main">
            <a href="<?php the_permalink(); ?>" class="post_link"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_eye.png" alt="eye"></a>
        </div>

        <div class="overlay_post_footer">
            <p class="ref_lightbox"><?php echo $reference; ?></p>
            <p class="cat_lightbox"><?php echo $category_list; ?></p>
        </div>
    </div>
</article>
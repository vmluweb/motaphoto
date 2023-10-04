<div class="gallery_grid">

    <?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
    );

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();

    ?>
            <article class="gallery_card">

                <a href="<?php the_permalink(); ?>" class="post__link">
                    <?php the_post_thumbnail(); ?>
                </a>

            </article>

    <?php
        endwhile;
        wp_reset_postdata();
    else :
    // Aucun projet trouvé.
    endif;
    ?>
</div>
<a href="" class="btn btn_gallery ">Charger plus</a>
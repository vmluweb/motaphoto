<?php get_header(); ?>
<main>
    <?php if (have_posts()) : ?>

        <div class="banner">
            <div class="banner_text">
                <p>Photographe Event</p>
            </div>
            <div class="banner_image">
                <?php the_post_thumbnail(); ?>
            </div>
        </div>
    <?php
    endif; ?>

    <section class="homepage_gallery">
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
                    <?php get_template_part('template-parts/photo_block'); ?>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            // Aucun projet trouvé.
            endif;
            ?>
        </div>
        <a href="" class="btn btn_gallery ">Charger plus</a>
    </section>

</main>
<?php get_footer(); ?>
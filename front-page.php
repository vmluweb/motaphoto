<?php get_header(); ?>
<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="banner">
                <div class="banner_text">
                    <p>Photographe Event</p>
                </div>
                <div class="banner_image">
                    <?php the_post_thumbnail(); ?>
                </div>
            </div>
            <section class="homepage_gallery">
                <?php get_template_part('template-parts/gallery-photo'); ?>
            </section>
    <?php endwhile;
    endif; ?>
</main>
<?php get_footer(); ?>
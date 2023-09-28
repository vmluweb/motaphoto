<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <main>
            <div class="banner">
                <div class="banner_text">
                    <p>Photographe Event</p>
                </div>
                <div class="banner_image">
                    <?php the_post_thumbnail(); ?>
                </div>
            </div>
            <?php get_template_part('template-parts/popup'); ?>
        </main>
<?php endwhile;
endif; ?>

<?php get_footer(); ?>
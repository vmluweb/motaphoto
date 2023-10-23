<?php get_header(); ?>
<main>
    <div class="banner_text">
        <p>Photographe Event</p>
    </div>
    <div class="banner">
        <?php
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 1,
            'orderby' => 'rand'
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :

        ?>
            <div class="banner_image">
                <!-- Hero: affichage d'image aléatoire -->
            <?php while ($query->have_posts()) : $query->the_post();
                the_post_thumbnail();
            endwhile;
        endif;

        wp_reset_postdata(); ?>
            </div>
    </div>

    <section class="homepage_gallery">

        <div class="filtering_sorting_container">
            <div class="filters_category_format">
                <?php
                $taxonomy = 'categorie';
                $tax_object = get_taxonomy('categorie');
                $taxonomy_name = $tax_object->labels->name;

                $terms = get_terms(array(
                    'taxonomy' => $taxonomy,
                    'hide_empty' => false,
                ));

                if (!empty($terms)) {
                    echo '<div class="select_container" id="category_filter">';
                    echo '<ul class="placeholder_option">';
                    echo '<li>' . esc_html($taxonomy_name) . '</li>';
                    echo '</ul>';
                    echo '<ul class="options_items_list" data-target="category_filter">';
                    echo '<li class="option"></li>';
                    foreach ($terms as $term) {
                        echo '<li class="option_items" data-value="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                }
                ?>

                <?php
                $taxonomy = 'format';
                $tax_object = get_taxonomy('format');
                $taxonomy_name = $tax_object->labels->name;

                $terms = get_terms(array(
                    'taxonomy' => $taxonomy,
                    'hide_empty' => false,
                ));

                if (!empty($terms)) {
                    echo '<div class="select_container" id="format_filter">';
                    echo '<ul class="placeholder_option">';
                    echo '<li>' . esc_html($taxonomy_name) . '</li>';
                    echo '</ul>';
                    echo '<ul class="options_items_list" data-target="format_filter">';
                    echo '<li class="option"></li>';
                    foreach ($terms as $term) {
                        echo '<li class="option_items" data-value="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="sorting">
                <div class="select_container" id="year-filter">
                    <ul class="placeholder_option">
                        <li>Trier par</li>
                    </ul>
                    <ul class="options_items_list" data-target="year-filter">
                        <li class="option" data-value=""></li>
                        <?php
                        global $wpdb;
                        $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_type = 'photo' AND post_status = 'publish' ORDER BY post_date DESC");
                        foreach ($years as $year) :
                            $selected = (isset($_GET['year']) && $_GET['year'] == $year) ? 'selected' : '';
                            echo "<li class='option_items' data-value='{$year}' {$selected}>{$year}</li>";
                        endforeach;
                        ?>
                    </ul>
                </div>
            </div>
            <!--  -->
        </div>
        <div class="gallery_grid" id="gallery_grid_homepage">

            <?php
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 12,
                'paged' => 1,
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
                echo "aucune publication trouvée";
            endif;
            ?>
        </div>
        <a href="#" class="btn btn_gallery " id="load-more">Charger plus</a>
    </section>

</main>
<?php get_footer(); ?>
<?php get_header(); ?>

<main class="main-single">

	<section class="post">

		<article class="post_container">

			<table class="post_info_description_wrapper">
				<tr class="post_description">
					<?php if (have_posts()) : the_post(); ?>
						<td class="post_description_text">

							<h2><span><?php the_title(); ?></span></h2>
							<p>Réf. photo : <?php the_field('reference'); ?></p>
							<p>Catégorie : <?php the_terms(get_the_ID(), 'categorie', '', ', ', ''); ?></p>
							<p> Format : <?php the_terms(get_the_ID(), 'format', '', ', ', ''); ?></p>
							<p>Type : <?php the_field('type'); ?></p>
							<p>Année : <?php echo get_the_date('Y') ? get_the_date('Y') : 'Année non spécifiée'; ?></p>

						</td><!-- end post_description_text -->
						<td>
							<figure class="post_description_img">
								<?php the_post_thumbnail(); ?>

							</figure>

						</td>
					<?php endif; ?>
				</tr>
				<tr class="post_info">
					<td class="post_info_cta_wrapper">
						<div class="post_info_cta">
							<p>Cette photo vous intéresse?</p>
							<a href="#" class="btn popup_link btn_post_info">Contact</a>
						</div>
					</td>
					<td class="post_info_carousel_container">

						<div class="post_info_carousel">
							<figure class="preview_thumbnail" id="image-preview">
								<img src="" alt="Thumbnail" class="post-thumbnail" />
							</figure>

							<div class="arrows_container">
								<?php
								/**
								 * Affichage du lien vers la publication précédente ou suivante avec une miniature
								 *
								 */
								$prev_post = get_previous_post();
								if ($prev_post) :
									$prev_post_id = $prev_post->ID;
									$prevThumbnail = get_the_post_thumbnail($prev_post_id);
									$prevThumbnailURL = get_the_post_thumbnail_url($prev_post_id);
									previous_post_link('<div class="prev" data-thumbnail-url="' . esc_url($prevThumbnailURL) . '">%link</div>', '');
								endif;

								$next_post = get_next_post();
								if ($next_post) :
									$next_post_id = $next_post->ID;
									$nextThumbnail = get_the_post_thumbnail($next_post_id);
									$nextThumbnailURL = get_the_post_thumbnail_url($next_post_id);
									next_post_link('<div class="next" data-thumbnail-url="' . esc_url($nextThumbnailURL) . '">%link</div>', '');
								endif;
								?>
							</div>
						</div> <!-- end post_info_carousel -->
					</td> <!-- end post_info_carousel_container -->
				</tr>
			</table>
			<div class="single_gallery">
				<h3>Vous aimerez aussi</h3>
				<div class="gallery_grid" id="gallery_grid_single">
					<?php
					/**
					 * Affichage des publications similaires basée sur la catégorie actuelle
					 *
					 */
					$current_id = get_the_ID();
					$categories = get_the_terms($current_id, 'categorie');

					if ($categories && count($categories) >= 1) {
						$current_category = array_shift($categories);

						$args = array(
							'post_type' => 'photos',
							'post_status' => 'publish',
							'posts_per_page' => 2,
							'tax_query' => array(
								array(
									'taxonomy' => 'categorie',
									'field' => 'term_id',
									'terms' => $current_category->term_id,
								),
							),
							'post__not_in' => array($current_id),
						);

						$related_articles = new WP_Query($args);

						if ($related_articles->have_posts()) {
							while ($related_articles->have_posts()) {
								$related_articles->the_post();
								get_template_part('template-parts/photos-block');
							}
							wp_reset_postdata();
						}
					}
					?>

				</div>
				<!-- Retour à l'accueil -->
				<a href="<?php echo home_url('/'); ?>" class="btn btn_gallery">Toutes les photos</a>
			</div>
		</article>
	</section>

</main>

<?php get_footer(); ?>
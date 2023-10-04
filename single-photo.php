<?php get_header(); ?>

<!-- Affichage d'une photo -->
<main class="main-single">

	<section class="post">

		<article class="post_container">

			<div class="post_description">
				<div class="post_description_text">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
							<h2><span><?php the_title(); ?></span></h2>

							<p>Réf. photo : <?php the_field('reference'); ?></p>
							<p>Catégorie : <?php the_terms(get_the_ID(), 'categorie', '', ', ', ''); ?></p>
							<p> Format : <?php the_terms(get_the_ID(), 'format', '', ', ', ''); ?></p>
							<p>Type : <?php the_field('type'); ?></p>
							<p>Année : <?php the_date('Y'); ?> </p>
				</div>

				<div class="post_description_img">
					<?php the_post_thumbnail(); ?>
			<?php endwhile;
					endif; ?>
				</div>

			</div>

			<div class="post_info">
				<div class="post_info_cta">

					<p>Cette photo vous intéresse ?</p>

					<a href="#" class="btn popup_link btn_post_info">Contact</a>
				</div>
				<div class="post_info_carousel_container">
					<div class="post_info_carousel">
						<div class="post_info_carousel">
							<?php
							$previous_post = get_previous_post();

							$args = array(
								'post_type' => 'photo',
								'posts_per_page' => 1,
								'order' => 'ASC',
								'orderby' => 'meta_value',
								'meta_key' => 'annee',
							);
							$next_post = get_posts($args);

							if (!empty($next_post)) {
								$next_post = $next_post[0];
							}
							?>

							<div class="arrow_hover">
								<!-- Emplacement image au survol des flèches -->
								<div class="preview prev_thumbnail">
									<?php echo get_the_post_thumbnail($previous_post); ?>
								</div>
								<div class="preview next_thumbnail">
									<?php echo get_the_post_thumbnail($next_post); ?>
								</div>
							</div>
							<div class="arrows_container">
								<div class="left">
									<a href="<?php echo get_permalink($previous_post->ID); ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/precedente.png" alt="Flèche précédente">
									</a>

								</div>
								<div class="right">
									<a href="<?php echo get_permalink($next_post->ID); ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/suivante.png" alt="Flèche suivante">
									</a>

								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
			<div class="single_gallery">
				<h3>Vous aimerez aussi</h3>
				<?php get_template_part('template-parts/gallery-photo'); ?>
			</div>
		</article>

	</section>

</main>

<?php get_footer(); ?>
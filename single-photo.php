<?php get_header(); ?>

<main class="main-single">

	<section class="post">

		<article class="post_container">
			<?php while (have_posts()) : the_post(); ?>

				<div class="post_description">
					<div class="post_description_text">


						<h2><span><?php the_title(); ?></span></h2>
						<p>Réf. photo : <?php the_field('reference'); ?></p>
						<p>Catégorie : <?php the_terms(get_the_ID(), 'categorie', '', ', ', ''); ?></p>
						<p> Format : <?php the_terms(get_the_ID(), 'format', '', ', ', ''); ?></p>
						<p>Type : <?php the_field('type'); ?></p>
						<p>Année : <?php echo get_the_date('Y') ? get_the_date('Y') : 'Année non spécifiée'; ?></p>

					</div>

					<figure class="post_description_img">
						<?php the_post_thumbnail();
						?>
					</figure>
				</div>
			<?php endwhile; ?>

			<div class="post_info">
				<div class="post_info_cta">
					<p>Cette photo vous intéresse?</p>
					<a href="#" class="btn popup_link btn_post_info">Contact</a>
				</div>

				<div class="post_info_carousel_container">

					<div class="post_info_carousel">

						<figure class="preview_thumbnail" id="image-preview">
							<img src="" alt="Thumbnail" class="post-thumbnail" />
						</figure>

						<div class="arrows_container">
							<?php

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
					</div>
				</div>

			</div>


			<div class="single_gallery">
				<h3>Vous aimerez aussi</h3>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<?php get_template_part('template-parts/photo_block'); ?>

				<?php
					endwhile;
				endif;
				?>
			</div>
		</article>
	</section>

</main>

<?php get_footer(); ?>
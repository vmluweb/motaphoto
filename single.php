<?php get_header(); ?>

<!-- Affichage d'une photo -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post">
			<div class="details_post_column">
				<div class="details_post_description">
					<?php the_content(); ?>
					<h1><?php the_title(); ?></h1>

					<ul>
						<li>Réf. photo : <?php the_field('reference'); ?></li>
						<li>Catégorie : <?php the_terms(get_the_ID(), 'categorie', '', ', ', ''); ?></li>
						<li> Format : <?php the_terms(get_the_ID(), 'format', '', ', ', ''); ?></li>
						<li>Type : <?php the_field('type'); ?></li>
						<li>Année : <?php the_date('Y'); ?> </li>
					</ul>
				</div>
				<p>Cette photo vous intéresse ?</p>
				<a href="#popup_links" class="btn_single">Contact</a>
			</div>
			<div class="images_posts_column">
				<div>
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="carousel">
					<?php the_post_thumbnail(); ?>
					<?php the_posts_pagination(); ?>
				</div>
			</div>
		</div>
		<div class="suggestion">
			<h2>Vous aimerez aussi</h2>
			<?php get_template_part('template-parts/gallery-photo'); ?>
		</div>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<main class="main-page">
			<h1><?php the_title(); ?></h1>
			<div class="main-page-container">
				<?php the_content(); ?>
			</div>
		</main>


<?php endwhile;
endif; ?>

<?php get_footer(); ?>
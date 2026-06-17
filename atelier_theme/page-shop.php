<?php get_header(); /* Template Name: Shop */ ?>

<section class="allcont shop">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php the_content(); ?>

		</article>

	<?php endwhile; ?>

	<?php else: ?>

		<article>

			<h2><?php _e( 'Sorry, nothing to display.', 'atelier' ); ?></h2>

		</article>

	<?php endif; ?>
</section>

<?php get_footer(); ?>

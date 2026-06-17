<?php get_header(); ?>

<section class="allcont">

		<article id="post-404">

			<!-- <div class="inner">
				<h1><?php _e( 'Page not found', 'atelier' ); ?></h1>
				<h2>
					<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'atelier' ); ?></a>
				</h2>
			</div> -->

			<div class="wrapper">
				<div class="error__404">
					<h2>Diese Seite<br><b>Existiert nicht</b></h2>
					<h5>Fehler 404</h5>
					<p>Die von dir gesuchte Seite scheint es nicht zu geben. Überprüfe deine Suche oder geh zurück zur Startseite.</p>
					<a class="button --color-accent" href="<?= home_url(); ?>">
						<span>Zur Startseite</span>
					</a>
					<span class="background__number">404</span>
				</div>
			</div>

		</article>

</section>

<?php get_footer(); ?>

<?php get_header(); /* Template Name: Buchung Bestätigt */ ?>

<script>
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	const product = urlParams.get('booking_product')
	const category = urlParams.get('booking_category')
	const value = urlParams.get('booking_value')

	// add content group to tag manager data layer
	window.dataLayer = window.dataLayer || []
	window.dataLayer.push({
		'event': 'booking',
		'booking_product': product,
		'booking_category': category,
		"booking_value": value,
		"booking_currency": 'EUR'
	})
</script>

<style>
	.header,
	.footer {
		display: none;
	}

	main {
		padding: 0 !important;
	}
</style>



<?php
// Get color
$color_name = $_GET["color"];
if ($color_name === "blue") : ?>
	<style>
		:root {
			--product-color: #3fcad6;
			--product-color-dark: #33a2ab;
		}
	</style>
<?php elseif ($color_name === "purple") : ?>
	<style>
		:root {
			--product-color: #4248de;
			--product-color-dark: #353ab2;
		}
	</style>
<?php elseif ($color_name === "red") : ?>
	<style>
		:root {
			--product-color: #de332a;
			--product-color-dark: #c72e26;
		}
	</style>
<?php elseif ($color_name === "green") : ?>
	<style>
		:root {
			--product-color: #55d045;
			--product-color-dark: #44ad36;
		}
	</style>
<?php elseif ($color_name === "pink") : ?>
	<style>
		:root {
			--product-color: #b23cdf;
			--product-color-dark: #9322BE;
		}
	</style>
<?php elseif ($color_name === "yellow") : ?>
	<style>
		:root {
			--product-color: #d8d12b;
			--product-color-dark: #d8d12b;
		}
	</style>
<?php endif; ?>




<div class="book__confirmed website">

	<img class="background_swing" src="<?= get_template_directory_uri(); ?>/assets/img/website/book/book_swing_<?= $color_name ?>.svg" alt="">

	<div class="wrapper">



		<div class="book__header">
			<img class="logo" src="<?= get_template_directory_uri() ?>/assets/img/logos/logo_3_dark.svg" alt="Atelier Kunst & Gestalten Logo">
		</div>



		<div class="book__container book__confirmation">

			<div class="confirmation__header">
				<img src="<?= get_template_directory_uri() ?>/assets/img/website/book/confirmation_checkmark_<?= $color_name ?>.svg" alt="Häkchen Icon">
				<?php if ($color_name  === "blue" || $color_name === "purple" || $color_name === "red" || $color_name === "yellow") : ?>
					<div>
						<h2>Vielen Dank<br><b>für deine Buchung</b></h2>
						<h6>Ich habe deine Buchung erhalten</h6>
					</div>
				<?php else : ?>
					<div>
						<h2>Vielen Dank<br><b>für deine Anfrage</b></h2>
						<h6>Ich habe deine Anfrage erhalten</h6>
					</div>
				<?php endif; ?>
			</div>

			<p>Du erhältst in Kürze eine Bestätigungs-Mail, in der nochmal alle relevanten Informationen zu deinem gebuchten Kurs aufgelistet sind.</p>

			<a class="button --color-main" href="https://www.atelier-delatron.de">
				<span>Zurück zur Startseite</span>
			</a>

		</div>



	</div>
</div>



<?php get_footer(); ?>
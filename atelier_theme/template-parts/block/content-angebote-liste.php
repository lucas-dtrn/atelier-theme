<?php

/**
 * Block Name: Angebote Liste
 *
 */


// get fields
$id = $block['id'];
?>



<div id="angebote" class="angebote__list">



	<?php
	$courses = get_field("kurse");
	$c_headline_h2 = $courses["headline_h2"];
	$c_headline_h6 = $courses["headline_h6"];
	$c_text = $courses["text"];
	$c_image = $courses["image"];
	$c_button_1 = $courses["button_1"];
	$c_button_2 = $courses["button_2"];
	?>
	<div class="list__item item--1" id="<?= $courses["anchor"] ?>">

		<div class="item__image">
			<?php if (!empty($c_image)) : ?>
				<img class="image" src="<?= $c_image["url"]; ?>" alt="<?= $c_image["alt"]; ?>">
			<?php endif; ?>
			<img class="image__mask" src="<?= get_template_directory_uri(); ?>/assets/img/website/home/mask_blue.svg" alt="">
		</div>

		<div class="item__content">
			<h2><?= $c_headline_h2 ?></h2>
			<h6><?= $c_headline_h6 ?></h6>

			<p><?= $c_text ?></p>

			<p class="two-buttons-vertical">
				<a class="button --color-blue" href="<?= $c_button_1["url"] ?>" target="">
					<span><?= $c_button_1["title"] ?></span>
				</a>
				<a class="button --color-purple" href="<?= $c_button_2["url"] ?>" target="">
					<span><?= $c_button_2["title"] ?></span>
				</a>
			</p>

			<p class="background__number">1</p>
		</div>
	</div>



	<?php
	$workshops = get_field("workshops");
	$w_headline_h2 = $workshops["headline_h2"];
	$w_headline_h6 = $workshops["headline_h6"];
	$w_text = $workshops["text"];
	$w_image = $workshops["image"];
	$w_button_1 = $workshops["button_1"];
	?>
	<div class="list__item item--2" id="<?= $workshops["anchor"] ?>">

		<div class="item__image">
			<?php if (!empty($w_image)) : ?>
				<img class="image" src="<?= $w_image["url"]; ?>" alt="<?= $w_image["alt"]; ?>">
			<?php endif; ?>
			<img class="image__mask" src="<?= get_template_directory_uri(); ?>/assets/img/website/home/mask_red.svg" alt="">
		</div>

		<div class="item__content">
			<h2><?= $w_headline_h2 ?></h2>
			<h6><?= $w_headline_h6 ?></h6>

			<p><?= $w_text ?></p>

			<p class="two-buttons-vertical">
				<a class="button --color-red" href="<?= $w_button_1["url"]; ?>" target="">
					<span><?= $w_button_1["title"]; ?></span>
				</a>
			</p>

			<p class="background__number">2</p>
		</div>
	</div>



	<?php
	$birthdays = get_field("birthdays");
	$b_headline_h2 = $birthdays["headline_h2"];
	$b_headline_h6 = $birthdays["headline_h6"];
	$b_text = $birthdays["text"];
	$b_image = $birthdays["image"];
	$b_button_1 = $birthdays["button_1"];
	?>
	<div class="list__item item--3" id="<?= $birthdays["anchor"] ?>">

		<div class="item__image">
			<?php if (!empty($b_image)) : ?>
				<img class="image" src="<?= $b_image; ?>" alt="<?= $b_image['alt']; ?>">
			<?php endif; ?>
			<img class="image__mask" src="<?= get_template_directory_uri(); ?>/assets/img/website/home/mask_green.svg" alt="">
		</div>

		<div class="item__content">
			<h2><?= $b_headline_h2 ?></h2>
			<h6><?= $b_headline_h6 ?></h6>

			<p><?= $b_text ?></p>

			<p class="two-buttons-vertical">
				<a class="button --color-accent" href="<?= $b_button_1["url"]; ?>" target="">
					<span><?= $b_button_1["title"]; ?></span>
				</a>
			</p>

			<p class="background__number">3</p>
		</div>
	</div>




	<?php
	$kunstevents = get_field("kunstevents");
	$k_headline_h2 = $kunstevents["headline_h2"];
	$k_headline_h6 = $kunstevents["headline_h6"];
	$k_text = $kunstevents["text"];
	$k_image = $kunstevents["image"];
	$k_button_1 = $kunstevents["button_1"];
	?>
	<div class="list__item item--4" id="<?= $kunstevents["anchor"] ?>">

		<div class="item__image">
			<?php if (!empty($k_image)) : ?>
				<img class="image" src="<?= $k_image; ?>" alt="<?= $k_image['alt'] ?>">
			<?php endif; ?>
			<img class="image__mask" src="<?= get_template_directory_uri(); ?>/assets/img/website/home/mask_pink.svg" alt="">
		</div>

		<div class="item__content">
			<h2><?= $k_headline_h2 ?></h2>
			<h6><?= $k_headline_h6 ?></h6>

			<p><?= $k_text ?></p>

			<p class="two-buttons-vertical">
				<a class="button --color-pink" href="<?= $k_button_1["url"]; ?>" target="">
					<span><?= $k_button_1["title"]; ?></span>
				</a>
			</p>

			<p class="background__number">4</p>
		</div>
	</div>






</div>
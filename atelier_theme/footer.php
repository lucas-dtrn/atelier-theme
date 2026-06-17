			</main>

			<?php
			global $websiteMode;

			$contactButton = array(
				'title' => $websiteMode === 'shop' ? 'Kundensupport' : 'Kontaktformular',
				'link' => $websiteMode === 'shop' ? get_permalink(get_page_by_path('kundensupport')) : get_permalink(get_page_by_path('kontakt')) . '#allgemein',
			);

			$switchButton = array(
				'title' => $websiteMode === 'shop' ? 'Zu den Kunstkursen' : 'Zum Online-Shop',
				'link' => $websiteMode === 'shop' ? home_url() : get_permalink(get_page_by_path('shop')),
			);

			$preheader = get_field('preheader', 'options');
			$uberschrift_h2 = get_field('uberschrift_h2', 'options');
			$inhalte = get_field('inhalte', 'options');
			$formular_shortcode = get_field('formular_shortcode', 'options');
			$hinweis = get_field('hinweis', 'options');
			?>

			<footer class="footer footer--desktop">

				<?php get_template_part('components/paper'); ?>

				<div class="footer__newsletter">
					<?php if ($preheader) : ?>
						<h6><?= $preheader ?></h6>
					<?php endif; ?>

					<h2><?= $uberschrift_h2 ?></h2>

					<?php if ($inhalte) : ?>
						<div class="list">
							<?php foreach ($inhalte as $item) :
								$titel = $item['titel'];
							?>
								<span><img src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_checkmark_green.svg"><?= $titel ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php echo do_shortcode($formular_shortcode); ?>

					<?php if ($hinweis) : ?>
						<p class="privacy"><?= $hinweis ?></p>
					<?php endif; ?>

					<img class="decoration" src="<?php echo get_template_directory_uri(); ?>/assets/img/elements/footer_newsletter_decoration.svg" alt="">
				</div>

				<img class="footer__decoration" src="<?php echo get_template_directory_uri(); ?>/assets/img/elements/footer_decoration.svg" alt="">

				<div class="wrapper">

					<div class="footer__content">

						<?php if ($websiteMode === 'atelier') :
							atelier_footer_nav();
						elseif ($websiteMode === 'shop') :
							shop_footer_nav();
						endif; ?>

						<div class="footer__contact">
							<img class="footer__logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/logo_1_white.svg" height="80" width="279" alt="Atelier Kunst & Gestalten Logo">
							<ul class="links__list">
								<li>
									<a href="https://www.google.com/maps?client=safari&rls=en&q=atelier+delatron&oe=UTF-8&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiUtZjd1Jr3AhXlRfEDHVjzBnAQ_AUoAXoECAEQAw" target="_blank">
										<?php get_template_part('components/icon', '', array('icon' => 'map_pin', 'color' => 'white',  'size' => 'small', 'alt' => 'Stecknadel Icon')); ?>
										<span>Burgstallstr. 6, 1OG<br>90587 Obermichelbach</span>
									</a>
								</li>
								<li>
									<a href="tel:0173-3958815">
										<?php get_template_part('components/icon', '', array('icon' => 'phone', 'color' => 'white', 'size' => 'small', 'alt' => 'Telefon Icon')); ?>
										<span>0173-3958815</span>
									</a>
								</li>
								<li>
									<a href="mailto:info@atelier-delatron.de">
										<?php get_template_part('components/icon', '', array('icon' => 'mail', 'color' => 'white', 'size' => 'small', 'alt' => 'E-Mail Icon')); ?>
										<span>info@atelier-delatron.de</span>
									</a>
								</li>
							</ul>

							<?php get_template_part('components/button', NULL, array('button' => $contactButton, 'color' => 'white', 'class' => 'button__contact', 'size' => 'small')); ?>
							<?php get_template_part('components/button', NULL, array('button' => $switchButton, 'color' => 'accent', 'size' => 'small', 'icon' => 'chevron-right', 'iconPosition' => 'right')); ?>
						</div>

					</div>

					<?php law_nav(); ?>

					<p class="copyright">© 2022 Atelier Kunst & Gestalten.</p>

				</div>

			</footer>

			<footer class="footer footer--mobile">

				<?php get_template_part('components/paper'); ?>

				<div class="footer__newsletter">
					<?php if ($preheader) : ?>
						<h6><?= $preheader ?></h6>
					<?php endif; ?>

					<h2><?= $uberschrift_h2 ?></h2>

					<?php if ($inhalte) : ?>
						<div class="list">
							<?php foreach ($inhalte as $item) :
								$titel = $item['titel'];
							?>
								<span><img src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_checkmark_green.svg"><?= $titel ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php echo do_shortcode($formular_shortcode); ?>

					<?php if ($hinweis) : ?>
						<p class="privacy"><?= $hinweis ?></p>
					<?php endif; ?>

					<img class="decoration" src="<?php echo get_template_directory_uri(); ?>/assets/img/elements/footer_newsletter_decoration.svg" alt="">
				</div>

				<img class="footer__decoration" src="<?php echo get_template_directory_uri(); ?>/assets/img/elements/footer_decoration.svg" alt="">

				<div class="wrapper">

					<div class="footer__content">

						<img class="footer__logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/logo_1_white.svg" height="80" width="279" alt="Atelier Kunst & Gestalten Logo">

						<?php if ($websiteMode === 'atelier') :
							atelier_footer_nav();
						elseif ($websiteMode === 'shop') :
							shop_footer_nav();
						endif; ?>

						<div class="footer__contact">
							<h4 class="contact__header">Kontakt & Anfahrt</h4>

							<ul class="links__list">
								<li>
									<a href="https://www.google.com/maps?client=safari&rls=en&q=atelier+delatron&oe=UTF-8&um=1&ie=UTF-8&sa=X&ved=2ahUKEwiUtZjd1Jr3AhXlRfEDHVjzBnAQ_AUoAXoECAEQAw" target="_blank">
										<?php get_template_part('components/icon', '', array('icon' => 'map_pin', 'color' => 'white',  'size' => 'small', 'alt' => 'Stecknadel Icon')); ?>
										<span>Burgstallstr. 6, 1OG<br>90587 Obermichelbach</span>
									</a>
								</li>
								<li>
									<a href="tel:0173-3958815">
										<?php get_template_part('components/icon', '', array('icon' => 'phone', 'color' => 'white', 'size' => 'small', 'alt' => 'Telefon Icon')); ?>
										<span>0173-3958815</span>
									</a>
								</li>
								<li>
									<a href="mailto:info@atelier-delatron.de">
										<?php get_template_part('components/icon', '', array('icon' => 'mail', 'color' => 'white', 'size' => 'small', 'alt' => 'E-Mail Icon')); ?>
										<span>info@atelier-delatron.de</span>
									</a>
								</li>
							</ul>

							<?php get_template_part('components/button', NULL, array('button' => $contactButton, 'color' => 'white', 'class' => 'button__contact', 'size' => 'small')); ?>
							<?php get_template_part('components/button', NULL, array('button' => $switchButton, 'color' => 'accent', 'size' => 'small', 'icon' => 'chevron-right', 'iconPosition' => 'right')); ?>
						</div>


					</div>

					<p class="copyright">© 2022 Atelier Kunst & Gestalten.</p>

					<?php law_nav(); ?>

				</div>

			</footer>

			<dialog class="popup popup--newsletter">
				<form method="dialog">
					<button class="button --color-white popup__close" value="cancel"></button>
				</form>

				<div class="popup__content">
					<?php if ($preheader) : ?>
						<h6><?= $preheader ?></h6>
					<?php endif; ?>

					<h2><?= $uberschrift_h2 ?></h2>

					<?php if ($inhalte) : ?>
						<div class="list">
							<?php foreach ($inhalte as $item) :
								$titel = $item['titel'];
							?>
								<span><img src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_checkmark_green.svg"><?= $titel ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php echo do_shortcode($formular_shortcode); ?>

					<?php if ($hinweis) : ?>
						<p class="privacy"><?= $hinweis ?></p>
					<?php endif; ?>

					<img class="decoration" src="<?php echo get_template_directory_uri(); ?>/assets/img/elements/newsletter_decoration_popup.svg" alt="">
					<?php get_template_part('components/paper'); ?>
				</div>

			</dialog>

			<?php wp_footer(); ?>

			</body>

			</html>
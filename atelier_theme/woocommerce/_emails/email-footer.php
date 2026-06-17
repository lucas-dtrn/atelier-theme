<?php

/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>
<div class="email__questions">
	<h2>Hast du <span>Fragen?</span></h2>
	<p>Kontaktiere mich bei Fragen über <a href="https://atelier-delatron.de/kontakt">www.atelier-delatron.de/kontakt.</a> Alternativ kannst du auch einfach auf diese Email antworten. Ich werde mich schnellstmöglich um dein Anliegen kümmern.</p>
</div>

</div>
</div>

<div class="email__footer inner email__box">
	<img src="https://atelier-delatron.de/assets/img/logos/logo_5.png">
	<div>
		<h3>Atelier Kunst & Gestalten</h3>
		<p>Burgstallstr. 6<br>
			90587 Obermichelbach<br>
			Landkreis Fürth, Deutschland</p>
		<a href="https://www.atelier-delatron.de">www.atelier-delatron.de</a>
	</div>
</div>
</body>

</html>









<style>
	.email__questions {
		margin-top: 40px;
		padding: 50px 0 60px;
		border-top: solid 1px var(--linegray);
	}

	.email__footer {
		margin-bottom: 30px;
		padding: 25px 20px 30px;
		background-color: var(--lightgray);
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		justify-content: space-between;
		align-items: flex-start;
	}

	.email__footer img {
		height: 50px;
		width: 50px;
	}
</style>
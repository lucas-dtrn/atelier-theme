<?php

/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email__header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

?>



<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
	<title><?php echo get_bloginfo('name', 'display'); ?></title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="color-scheme" content="light">
	<meta name="supported-color-schemes" content="light">

	<link rel="stylesheet" href="https://use.typekit.net/geu7xjt.css">

</head>

<body>

	<div class="email__header">
		<div class="inner">
			<div class="header__topic">
				<div class="topic__dots">
					<div></div>
					<div></div>
					<div></div>
				</div>
				<span>Kunst aus der Tüte</span>
			</div>
			<a href="https://kunstausdertuete.de"><img class="header__logo" src="https://atelier-delatron.de/assets/img/logos/logo_1_white.svg"></a>
		</div>
		<img class="header__background" src="https://atelier-delatron.de/assets/img/email_header_background.svg">
	</div>

	<div class="email__content">
		<div class="inner">









			<style>
				.email__header {
					width: 100vw;
					height: 160px;
					margin-bottom: 70px;
					padding-top: 25px;
					position: relative;
				}

				.email__header .inner {
					margin: 1px auto;
					display: flex;
					flex-direction: row;
					flex-wrap: nowrap;
					justify-content: space-between;
					align-items: center;
					transform: translateZ(1px);
				}

				.email__header .header__topic {
					display: flex;
					flex-direction: column;
					flex-wrap: nowrap;
					justify-content: flex-start;
				}

				.email__header .header__topic span {
					font-size: 13px;
					font-weight: 700;
					text-transform: uppercase;
					color: white;
				}

				.email__header .topic__dots {
					margin-bottom: 5px;
					display: flex;
					flex-direction: row;
					flex-wrap: nowrap;
					justify-content: flex-start;
				}

				.email__header .topic__dots div {
					height: 5px;
					width: 5px;
					border-radius: 50%;
					background-color: #55D045;
					margin-right: 5px;
				}

				.email__header .header__logo {
					height: 50px;
					width: 175px;
				}

				.email__header .header__background {
					width: 100%;
					height: 100%;
					object-position: bottom;
					object-fit: cover;
					position: absolute;
					top: 0px;
					pointer-events: none;
				}
			</style>









			<style>
				:root {
					--main: #001E34;
					--accent: #55D045;
					--lightgray: #F7F7F7;
					--linegray: #E3E3E3;
				}


				* {
					font-family: proxima-soft, sans-serif;
					font-weight: 400;
					padding: 0px;
					margin: 0px;
					box-sizing: border-box;
				}

				body {
					/* background-color: var(--lightgray); */
					background-color: white;
					margin: 0px;
				}

				.inner {
					width: 96vw;
					max-width: 600px;
					margin: auto;
				}



				p,
				a,
				address {
					margin: 0;
					padding: 10px 0 0;
					font-size: 14px;
					line-height: 1.5em;
					font-style: normal;
				}

				a {
					color: var(--accent);
					font-weight: 700;
					text-decoration: underline;
				}



				h1,
				h2,
				h3 {
					margin: 0;
					padding: 0;
					font-family: proxima-soft, sans-serif;
					font-weight: 800;
					line-height: 1.2em;
					text-transform: uppercase;
					color: var(--main);
				}

				h1 {
					font-size: 25px;
				}

				h2 {
					font-size: 17px;
				}

				h3 {
					font-size: 15px;
				}

				h1 span,
				h2 span,
				h3 span {
					color: var(--second);
					white-space: nowrap;
					font-weight: 800;
				}



				.email__box,
				section {
					margin-bottom: 30px;
					padding: 25px;
					/* background-color: white; */
					border-radius: 15px;
					/* box-shadow: 0 0 20px rgba(0 0 0 / 5%); */
					background-color: var(--lightgray);
					border: solid 1px var(--linegray);
				}

				.email__box p:first-child {
					padding-top: 0;
				}



				.email__message {
					margin-bottom: 70px;
					font-size: 16px;
				}

				.email__message h1 {
					margin-bottom: 10px;
				}


				/* 
	.button {
		padding: 11px 100px;
		border: solid #55D045 3px;
		background-color: #55D045;
		border-radius: 8px;
		color: white;
		text-decoration: none;
		text-transform: uppercase;
		font-size: 14px;
		font-weight: 700;
		letter-spacing: 1px;
		transition: ease-in-out 200ms;
	}
	.button:hover {
		background-color: transparent;
		color: #55D045;
	} */







				/* .email-content {
		background-color: var(--lightgray);
		padding: 120px 0px 70px;
	}
	.email-starter {
		margin-bottom: 100px;
		display: flex;
		flex-direction: column;
		align-items: flex-end;

		img {
			height: 120px;
			width: 120px;
			border: none;
			border-radius: 50%;
			margin-bottom: -10px;
			background-color: white;
		}
		div h1 span {
			color: var(--second);
		}
	}
	.email-field {
		margin-bottom: 60px;
		border-radius: 15px;
		background: #fff;
		box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.05);
		.field-padding {
			padding: 25px;
		}
	}
	.course-infos {
		.course-header {
			display: flex;
			flex-direction: row;
			flex-wrap: nowrap;
			justify-content: space-between;
			align-items: flex-start;
			margin-bottom: 30px;

			img {
				height: 100px;
				width: 100px;
				border-radius: 50%;
			}
			div {
				display: flex;
				flex-direction: column;
				align-items: flex-end;

				h3 {
					text-align: right;
				}
				span {
					font-size: 12px;
					font-weight: 800;
					text-transform: uppercase;
					text-align: right;
					color: var(--course-color);
				}
			}
		}
		h4 {
			margin-top: 50px;
		}
		.email-list {
			margin-top: 10px;
		}
	}
	.email-list {
		display: flex;
		flex-direction: column;

		.row {
			width: 100%;
			padding: 20px 25px;
			border-top: 3px solid #f7f7f7;
			display: flex;
			flex-direction: row;
			flex-wrap: nowrap;
			justify-content: space-between;

			span {
				font-size: 15px;
			}
			span:first-child {
				font-weight: 750;
			}
		}
		&.hide-first-border {
			.row:first-child {
				border-top: none;
			}
		}
	}




	.email-invoice {
		width: 100%;
		margin-bottom: 45px;

		.invoice-item {
			display: flex;
			flex-direction: row;
			flex-wrap: nowrap;
			justify-content: space-between;
			margin-bottom: 6px;

			span {
				font-size: 15px;
			}
			&:first-child span {
				font-weight: 750;
			}
			&:last-child span {
				font-weight: 750;
				color: var(--second);
			}
		}
		.invoive-divide {
			height: 2px;
			width: 100%;
			background-color: #EDF0F2;
			position: relative;
			margin: 12px 0px 15px;

			&::after {
				content: "";
				display: block;
				height: 2px;
				width: 100%;
				background-color: #EDF0F2;
				position: absolute;
				left: 0px;
				top: 5px;
			}
		}
	}
	.payment-list {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: space-between;
		margin-top: 15px;
		margin-bottom: 5px;

		span {
			width: calc(50% - 5px);
			margin-top: 10px;
			padding: 12px 0px;
			font-size: 12px;
			font-weight: 800;
			text-transform: uppercase;
			text-align: center;
			border: 1px solid #bfc6cc;
			border-radius: 8px;
		}
	}







	.email-share {
		margin-top: 120px;
		margin-bottom: 70px;

		h2 {
			max-width: 260px;
		}
		.social-buttons {
			display: flex;
			flex-direction: row;
			flex-wrap: nowrap;
			margin-top: 20px;

			div {
				height: 40px;
				width: 40px;
				border-radius: 50%;
				background-color: pink;
				margin-right: 20px;
			}
		}
	}
	*/
			</style>
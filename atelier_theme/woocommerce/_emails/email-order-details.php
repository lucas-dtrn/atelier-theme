<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
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

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>
<div class="email__box email__table">

	<h2>
		<?php
		if ( $sent_to_admin ) {
			$before = '<a class="link" href="' . esc_url( $order->get_edit_order_url() ) . '">';
			$after  = '</a>';
		} else {
			$before = '';
			$after  = '';
		}
		/* translators: %s: Order ID. */
		echo wp_kses_post( $before . sprintf( __( '[Order #%s]', 'woocommerce' ) . $after . ' (<time datetime="%s">%s</time>)', $order->get_order_number(), $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) ) );
		?>
	</h2>

	<table>
		<thead>
			<tr>
				<th><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => false,
					'image_size'    => array( 32, 32 ),
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
		</tbody>
		<tfoot>
			<?php
			$item_totals = $order->get_order_item_totals();

			if ( $item_totals ) {
				$i = 0;
				foreach ( $item_totals as $total ) {
					$i++;
					?>
					<tr>
						<th colspan="2"><?php echo wp_kses_post( $total['label'] ); ?></th>
						<td><?php echo wp_kses_post( $total['value'] ); ?></td>
					</tr>
					<?php
				}
			}
			if ( $order->get_customer_note() ) {
				?>
				<tr>
					<th colspan="2"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
					<td><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
				</tr>
				<?php
			}
			?>
		</tfoot>
	</table>

</div>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>









<style>
	.email__table {
	}
	table {
		width: 100%;
		margin-top: 30px;
		border-collapse: collapse;
	}
	tr {

	}
	th,
	td {
		padding: 15px;
		font-family: proxima-soft, sans-serif;
		font-weight: 400;
		font-size: 14px;
		text-align: left;
		color: var(--main);
		opacity: 1;
		border: solid 1px var(--linegray);
	}
	td {

	}
	thead {

	}
	thead th {
		font-weight: 800;
		text-transform: uppercase;
	}
	tbody {

	}
	tbody ul li {
			list-style: none;
		}
		tbody ul span,
		tbody ul p {
			display: inline-block;
			padding-top: 2px;
			font-size: 12px;
			font-weight: 600;
		}
	tfoot {

	}

	tbody ul {

	}



	tr:first-child th {
		border-top: none;
	}
	tr:last-child th,
	tr:last-child td {
		padding-bottom: 0;
		border-bottom: none;
	}
	th:first-child,
	td:first-child {
		padding-left: 0;
		border-left: none;
	}
	th:last-child,
	td:last-child {
		padding-right: 0;
		border-right: none;
	}


	thead tr:first-child th {
		padding-top: 0;
	}
	thead tr:last-child th {
		padding-bottom: 15px;
	}
	tbody tr:last-child td {
		padding-bottom: 15px;
		border-bottom: double 4px var(--linegray);
	}
	tbody tr td:first-child {
		font-weight: 600;
	}
	tfoot tr:last-child th,
	tfoot tr:last-child td {
		border-top: double 4px var(--linegray);
	}
	tfoot tr:last-child th {
		font-weight: 800;
		text-transform: uppercase;
	}
</style>
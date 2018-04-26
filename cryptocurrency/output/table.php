<?php

namespace Cryptocurrency\Output;

use Cryptocurrency\Purchases\Handler;

class Table {

	public static function generate( $output = false ) {

		if ( ! $output ) {
			ob_start();
		}
		self::build_table();
		if ( ! $output ) {
			return ob_get_clean();
		}


	}

	protected static function build_table() {
		$currencies       = carbon_get_theme_option( 'crypto_items' );
		$purchase_handler = new Handler( $currencies );
		$pricing          = $purchase_handler->get();

		$show_current_price = apply_filters( 'cryptocurrency/show_current_price', true );
		$show_last_updated  = apply_filters( 'cryptocurrency/show_last_updated', false );

		$coin_label            = __( 'Coin', 'cryptocurrency' );
		$quantity_label        = __( 'Owned Quantity', 'cryptocurrency' );
		$purchased_spend_label = __( 'Total spend', 'cryptocurrency' );
		$current_price_label   = __( 'Current Price', 'cryptocurrency' );
		$current_worth_label   = __( 'Current Worth', 'cryptocurrency' );
		$percentage_label      = __( 'Percentage', 'cryptocurrency' );
		$net_label             = __( 'Net', 'cryptocurrency' );
		$last_updated_label    = __( 'Last updated', 'cryptocurrency' );

		$last_updated = self::nice_time( $pricing->time );

		$currency_symbol_before = _x( '$', 'currency symbol before', 'cryptocurrency' );
		$currency_symbol_after  = _x( '', 'currency symbol after', 'cryptocurrency' );

		?>

		<table class="cryptocurrency">
			<thead>
			<tr>
				<th scope="col" class="text-left"><?php esc_html_e( $coin_label ); ?></th>
				<th scope="col"><?php esc_html_e( $quantity_label ); ?></th>
				<th scope="col"><?php esc_html_e( $purchased_spend_label ); ?></th>
				<?php if ( $show_current_price ) : ?>
					<th scope="col"><?php esc_html_e( $current_price_label ); ?></th>
				<?php endif; ?>
				<th scope="col"><?php esc_html_e( $current_worth_label ); ?></th>
				<th scope="col"><?php esc_html_e( $percentage_label ); ?></th>
				<th scope="col"><?php esc_html_e( $net_label ); ?></th>
				<?php if ( $show_last_updated ) : ?>
					<th scope="col"><?php esc_html_e( $last_updated_label ); ?></th>
				<?php endif; ?>
			</tr>
			</thead>
			<tbody>
			<?php foreach ( $pricing->calculations as $price_datum ) :


				$name = __( $price_datum['name'], 'cryptocurrency' );
				$quantity = isset( $price_datum['quantity'] ) ? number_format( $price_datum['quantity'], 4, '.',
					',' ) : '-';

				$purchased_spend = isset( $price_datum['purchased_price'] ) ? $currency_symbol_before . number_format( $price_datum['purchased_price'],
						2, '.', ',' ) . $currency_symbol_after : '-';


				$current_price = isset( $price_datum['current_price'] ) ? number_format( $price_datum['current_price'],
					2, '.', ',' ) : '-';


				$current_worth = $currency_symbol_before . number_format( $price_datum['current_worth'], 2, '.',
						',' ) . $currency_symbol_after;


				$percentage = _x( '', 'percent symbol before',
						'cryptocurrency' ) . number_format( 100 * $price_datum['percentage'], 2, '.',
						',' ) . _x( '%',
						'percent symbol after', 'cryptocurrency' );


				$net = number_format( $price_datum['net'], 2, '.', ',' );


				?>


				<tr>
					<td class="text-left" data-label="<?php esc_attr_e( $coin_label ); ?>"><?php esc_html_e( $name ); ?></td>

					<td data-label="<?php esc_attr_e( $quantity_label ); ?>">
						<?php esc_html_e( $quantity ); ?>
					</td>
					<td data-label="<?php esc_attr_e( $purchased_spend_label ); ?>">
						<?php esc_html_e( $purchased_spend ); ?>
					</td>
					<?php if ( $show_current_price ) : ?>
						<td data-label="<?php esc_attr_e( $current_price_label ); ?>">
							<?php esc_html_e( $current_price ); ?>
						</td>
					<?php endif; ?>
					<td data-label="<?php esc_attr_e( $current_worth_label ); ?>">
						<?php esc_html_e( $current_worth ); ?>
					</td>
					<td data-label="<?php esc_attr_e( $percentage_label ); ?>">
						<?php esc_html_e( $percentage ); ?>
					</td>
					<td data-label="<?php esc_attr_e( $net_label ); ?>"><?php esc_html_e( $net ); ?></td>
					<?php if ( $show_last_updated ) : ?>
						<td data-label="<?php esc_attr_e( $last_updated_label ); ?>">
							<?php esc_html_e( $last_updated ); ?>
						</td>
					<?php endif; ?>

				</tr>

			<?php endforeach; ?>
			</tbody>
		</table>

		<?php
	}

	public static function nice_time( $time1, $time2 = null, $precision = 6 ) {

		if ( ! $time2 ) {

			$time2 = time();
		}

		$seconds = $time2 - $time1;

		$s      = $seconds % 60;
		$m      = ( floor( ( $seconds % 3600 ) / 60 ) > 0 ) ? floor( ( $seconds % 3600 ) / 60 ) . ' minutes' : '';
		$h      = ( floor( ( $seconds % 86400 ) / 3600 ) > 0 ) ? floor( ( $seconds % 86400 ) / 3600 ) . ' hours' : '';
		$d      = ( floor( ( $seconds % 2592000 ) / 86400 ) > 0 ) ? floor( ( $seconds % 2592000 ) / 86400 ) . ' days' : '';
		$M      = ( floor( $seconds / 2592000 ) > 0 ) ? floor( $seconds / 2592000 ) . ' months' : '';
		$suffix = ( $s === 1 ) ? '' : 's';

		if ( trim( "$M $d $h $m $s" ) == "0" ) {
			return 'just now';
		}

		return "$M $d $h $m $s second" . $suffix . ' ago';

	}


}
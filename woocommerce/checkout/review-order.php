<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-checkout-review-order-info">
  <div class="woocommerce-checkout-review-order-info-cart">
    <?php
      foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) { ?>
          <div class="woocommerce-checkout-review-order-info-cart-product">
            <div class="woocommerce-checkout-review-order-info-cart-product__image">
              <img src="<?php echo wp_get_attachment_url($_product->get_image_id()); ?>">
            </div>
            <div class="woocommerce-checkout-review-order-info-cart-product-content">
              <div class="woocommerce-checkout-review-order-info-cart-product-content__title">
                <span class="font-subtitle font-weight-500"><?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?></span>
              </div>
              <div class="woocommerce-checkout-review-order-info-cart-product-content__amount">
                <span class="font-subtitle subtitle-small"><?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', 'Amount: '.sprintf( $cart_item['quantity'] ).' unit', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
              </div>
            </div>
            <div class="woocommerce-checkout-review-order-info-cart-product__price">
              <span class="font-subtitle subtitle-small"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
            </div>
          </div>
      <?php }
      }
    ?>
  </div>
  <div class="woocommerce-checkout-review-order-info-coupon"></div>
  <div class="woocommerce-checkout-review-order-info-summary">
    <div class="woocommerce-checkout-review-order-info-summary-subtotal">
      <span class="font-subtitle"><?php esc_html_e( 'Subtotal:', 'woocommerce' ); ?></span>
      <span class="font-subtitle"><?php wc_cart_totals_subtotal_html(); ?></span>
    </div>
    <div class="woocommerce-checkout-review-order-info-summary-coupons">
      <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
        <div class="woocommerce-checkout-review-order-info-summary-coupons__item">
          <span class="font-subtitle"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
          <span class="font-subtitle"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="woocommerce-checkout-review-order-info-summary-fees">
      <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <div class="woocommerce-checkout-review-order-info-summary-fees__item">
          <span class="font-subtitle"><?php echo esc_html( $fee->name ); ?></span>
          <span class="font-subtitle"><?php wc_cart_totals_fee_html( $fee ); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="woocommerce-checkout-review-order-info-summary-taxes">
      <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
        <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
          <div class="woocommerce-checkout-review-order-info-summary-taxes__item">
            <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
              <span class="font-subtitle"><?php echo esc_html( $tax->label ); ?></span>
              <span class="font-subtitle"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
            <?php endforeach; ?>
          </div>
          <?php else : ?>
          <div class="woocommerce-checkout-review-order-info-summary-taxes__item">
            <span class="font-subtitle"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
            <span class="font-subtitle"><?php wc_cart_totals_taxes_total_html(); ?></span>
          </div>
        <?php endif; ?>
		  <?php endif; ?>
    </div>
    <div class="woocommerce-checkout-review-order-info-summary-total">
      <span class="font-subtitle"><?php esc_html_e( 'Total:', 'woocommerce' ); ?></span>
      <span class="font-subtitle"><?php wc_cart_totals_order_total_html(); ?></span>
    </div>
    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
      <div class="woocommerce-checkout-review-order-info-summary-shipping">
        <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
        <span class="font-subtitle"><?php wc_cart_totals_shipping_html(); ?></span>
        <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
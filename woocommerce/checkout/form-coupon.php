<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $post;
$post_type = $post->post_type;

if ( !wc_coupons_enabled() || $post_type == 'product' ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="woocommerce-form-coupon-toggle" style="display: none;">
	<?php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'woocommerce' ) . '</a>' ), 'notice' ); ?>
</div>

<form id="form-coupon-contener" class="checkout_coupon woocommerce-form-coupon" method="post">
	<input type="text" name="coupon_code" class="woocommerce-form-coupon__input input-text font-subtitle" placeholder="<?php esc_attr_e( 'Discount code', 'woocommerce' ); ?>" id="coupon_code" value="" />
	<button type="submit" class="woocommerce-form-coupon__submit font-subtitle button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
	<div class="clear"></div>
</form>

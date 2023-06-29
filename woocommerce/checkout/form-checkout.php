<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$checkout = WC()->checkout;

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<?php
		if ($checkout->get_checkout_fields()){
			do_action( 'woocommerce_checkout_before_customer_details' );
			?>
			<div class="col2-set woocommerce-checkout-billing" id="customer_details">
				<div class="col-1">
					<div>
						<?php include get_stylesheet_directory().'/img/svg/luckycuppa-header-logo.svg' ?>
					</div>
					<h1 class="woocommerce-checkout-billing__title font-heading">Checkout</h1>
					<fieldset><legend class="font-subtitle">Express Checkout</legend></fieldset>
					<fieldset><legend class="font-subtitle">Or</legend></fieldset>
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
					<?php //wc_get_template( 'checkout/terms.php' ); ?>
					<div id="checkout-buttons-contener" class="woocommerce-checkout-billing__buttons">
						<div class="theme-button button-back" onclick="this.children[0].click()">
							<a href="<?php echo wc_get_cart_url(); ?>">
								<span class="font-subtitle">Back</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
	<?php } ?>
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>
	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<style>
	<?php include get_stylesheet_directory().'/css/style.css'; ?>
	<?php include get_stylesheet_directory().'/css/base/main-theme.css'; ?>
</style>
<script defer>
	<?php 
		include get_stylesheet_directory().'/src/functions/createElement.js';
		include get_stylesheet_directory().'/src/functions/createCloneElement.js';
		include get_stylesheet_directory().'/src/notices.js';
	?>
</script>
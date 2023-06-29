<?php
	if(str_contains($_SERVER['REQUEST_URI'], 'remove_coupon')){
		$coupon_code = substr($_SERVER['REQUEST_URI'], 21);
		WC()->cart->remove_coupon($coupon_code);
		WC()->cart->calculate_totals();

		header('Location: '.wc_get_cart_url());
	}
?>

<?php get_header(); ?>
<section class="main-cart">
	<div class="main-cart__title">
		<span class="font-heading heading-mid font-weight-400">Your Cart</span>
	</div>
	<div class="main-cart-grid">
		<div class="main-cart-grid-heading main-cart-grid-table">
			<span class="font-subtitle font-weight-500 justify-start"><?php esc_html_e( 'Image', 'woocommerce' ); ?></span>
			<span class="font-subtitle font-weight-500"><?php esc_html_e( 'Product Name', 'woocommerce' ); ?></span>
			<span class="font-subtitle font-weight-500"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></span>
			<span class="font-subtitle font-weight-500"><?php esc_html_e( 'Price', 'woocommerce' ); ?></span>
			<span class="font-subtitle font-weight-500 justify-end"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
		</div>
		<div class="main-cart-grid-list">
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>
			
			<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<div id="main-cart-grid-list-item-<?php echo $product_id; ?>" class="main-cart-grid-list-item main-cart-grid-table">
							<div class="main-cart-grid-list-item__thumbnail">
								<a href="<?php echo $product_permalink; ?>">
									<img src="<?php echo wp_get_attachment_url($_product->get_image_id()); ?>">
								</a>
							</div>
							<div class="main-cart-grid-list-item__name">
								<span class="font-subtitle">
									<?php
										if ( ! $product_permalink ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
										} else {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
										}
									?>
								</span>
							</div>
							<div class="main-cart-grid-list-item__quantity">
								<div id="cart-item-quantity-form-<?php echo $product_id; ?>" class="cart-item-quantity-form relative flex" item-key="<?php echo $cart_item_key; ?>" class="flex">
									<button class="quantity-minus">&minus;</button>
									<?php
										if ( $_product->is_sold_individually() ) {
											$min_quantity = 1;
											$max_quantity = 1;
										} else {
											$min_quantity = 0;
											$max_quantity = $_product->get_max_purchase_quantity();
										}

										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $max_quantity,
												'min_value'    => $min_quantity,
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);

										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
									<button class="quantity-plus">&plus;</button>
									<div class="main-cart-grid-list-item__remove">
										<?php
											echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span class="font-subtitle subtitle-min"><strong class="subtitle-huge font-weight-500 mr-1">&times;</strong>Remove</span></a>',
													esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
													esc_html__( 'Remove this item', 'woocommerce' ),
													esc_attr( $product_id ),
													esc_attr( $_product->get_sku() )
												),
												$cart_item_key
											);
										?>
									</div>
								</div>
							</div>
							<div class="main-cart-grid-list-item__price">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</div>
							<div class="main-cart-grid-list-item__subtotal">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</div>
						</div>
					<?php }
				}
			?>
		</div>
		<script type="module">
			addEventListener('DOMContentLoaded', () => {
				const buttons = document.querySelectorAll('.cart-item-quantity-form > button')

				buttons.forEach(btn => {
					btn.addEventListener('click', (e) => {
						const className = String(e.target.className)
						const parent = e.target.parentNode
						const input = document.querySelector(`#${parent.id} input`)
						const max_quantity = parseInt(input.getAttribute('max'))

						const cartItem = parent.parentNode.parentNode
						const currency = decodeHTMLEntity('<?php echo get_woocommerce_currency_symbol(); ?>')
						let price = parseFloat(document.querySelector(`#${cartItem.id} .main-cart-grid-list-item__price bdi`).textContent.replace(currency, ''))
						const total = document.querySelector('.main-cart-info-total bdi')
						const total_value = parseFloat(total.textContent.replace(currency, ''))
						const subtotal = document.querySelector(`#${cartItem.id} .main-cart-grid-list-item__subtotal bdi`)
						const subtotal_value = parseFloat(subtotal.textContent.replace(currency, ''))
						let newPrice

						let add = null

						if(className.includes('quantity-plus')){
							add = 'true'
							input.value++
							newPrice = subtotal_value + price
						}
						else if(className.includes('quantity-minus')){
							add = 'false'
							input.value--
							price *= -1
							newPrice = subtotal_value + price
						}

						if(input.value > max_quantity && max_quantity > 1){
							input.value = max_quantity
							return
						}
						if(input.value <= 0){
							input.value = 1
							return
						}

						if(add == null) return

						subtotal.textContent = currency+newPrice.toFixed(2)
						total.textContent = currency+(total_value + price).toFixed(2)

						const formData = new FormData()
						
						formData.append('cart-item-key', parent.getAttribute('item-key'))
						formData.append('add', add)

						buttons.forEach(el => {
							el.setAttribute('disabled', 'disabled')
						})

						fetch('<?php echo get_theme_file_uri().'/post/cart_item_quantity.php'; ?>', {
							method: 'POST',
							body: formData
						})
						.then(function(response){
							if(response.ok){
								buttons.forEach(el => {
									el.removeAttribute('disabled')
								})
								return response.text()
							}

							throw new Error('Something went wrong')
						})
						.then(function(text){
							console.log('Succesfull', text)
						})
						.catch(function(error){
							console.log('Failed', error)
						})
					})
				})
			})
		</script>
	</div>
	<div class="main-cart-info">
		<div class="main-cart-info-taxes">
			<span class="font-subtitle font-small">Taxes and shipping calculated at checkout</span>
		</div>
		<div class="main-cart-info-total">
			<span class="font-heading heading-small"><?php esc_html_e( 'Total:', 'woocommerce' ); ?></span>
			<span class="font-heading heading-small"><?php wc_cart_totals_order_total_html(); ?></span>
		</div>
		<div class="main-cart-info-button theme-button" onclick="this.children[0].click()">
			<a href="<?php echo wc_get_checkout_url(); ?>">
				<span class="font-subtitle subtitle-small">Checkout</span>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>

<style>
	<?php include get_stylesheet_directory().'/css/base/cart-theme.css'; ?>
</style>
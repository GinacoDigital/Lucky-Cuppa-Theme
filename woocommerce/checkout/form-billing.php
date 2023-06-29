<div class="woocommerce-billing-fields">
	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
			$fields = array(
				'billing_email' => array(
					'required' => 1,
					'type' => 'email',
					'class' => array('woocommerce-billing-field', 'billing-label', '!mt-8'),
					'validate' => array('email'),
					'autocomplete' => 'email username',
					'label' => 'Contact Information',
					'label_class' => array('font-subtitle', 'subtitle-small', 'font-weight-500'),
					'placeholder' => 'Email',
					'priority' => 110
				),
				'billing_country' => array(
					'required' => 1,
					'type' => 'country',
					'class' => array('woocommerce-billing-field', 'address_field', 'update_totals_on_change', '!mt-8'),
					'autocomplete' => 'country',
					'label' => 'Shipping Address',
					'label_class' => array('font-subtitle', 'subtitle-small', 'font-weight-500'),
					'placeholder' => 'Country/Region',
					'priority' => 40
				),
				'billing_first_name' => array(
					'required' => 1,
					'class' => array('woocommerce-billing-field'),
					'autocomplete' => 'given-name',
					'placeholder' => 'First Name',
					'priority' => 10
				),
				'billing_last_name' => array(
					'required' => 1,
					'class' => array('woocommerce-billing-field'),
					'autocomplete' => 'family-name',
					'placeholder' => 'Last Name',
					'priority' => 20
				),
				'billing_address_1' => array(
					'required' => 1,
					'class' => array('woocommerce-billing-field', 'address-field'),
					'autocomplete' => 'address-line1',
					'placeholder' => 'Address',
					'priority' => 50
				),
				'billing_address_2' => array(
					'required' => 0,
					'class' => array('woocommerce-billing-field', 'address-field'),
					'autocomplete' => 'address-line2',
					'placeholder' => 'Apartment, suite, etc (optional)',
					'priority' => 60
				),
				'billing_city' => array(
					'required' => 1,
					'class' => array('woocommerce-billing-field', 'address-field'),
					'autocomplete' => 'address-level2',
					'placeholder' => 'City',
					'priority' => 70
				),
				'billing_state' => array(
					'required' => 1,
					'type' => 'state',
					'class' => array('woocommerce-billing-field', 'address-field'),
					'validate' => array('state'),
					'autocomplete' => 'address-level1',
					'placeholder' => 'Province',
					'country_field' => 'billing_country',
					'country' => 'GB',
					'priority' => 80
				),
				'billing_postcode' => array(
					'required' => 1,
					'class' => array('woocommerce-billing-field', 'address-field'),
					'validate' => array('postcode'),
					'autocomplete' => 'postal-code',
					'placeholder' => 'Postal Code',
					'priority' => 90
				),
				'billing_phone' => array(
					'required' => 1,
					'class' => array('woocommerce-billing-field'),
					'validate' => array('phone'),
					'autocomplete' => 'tel',
					'placeholder' => 'Phone'
				)
			);

			foreach ( $fields as $key => $field ) {
				if($key == 'billing_first_name' || $key == 'billing_state'){
					echo '<div class="woocommerce-billing-twice">';
				}

				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );

				if($key == 'billing_last_name' || $key == 'billing_postcode'){
					echo '</div>';
				}

				if($key == 'billing_email'){ ?>
					<div class="woocommerce-billing-checkbox font-subtitle subtitle-small"><?php do_action( 'woocommerce_checkout_before_terms_and_conditions' ); ?></div>
			<?php }
			}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>

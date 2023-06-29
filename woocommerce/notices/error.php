<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

?>
<ul class="woocommerce-notices woocommerce-notices-error" role="alert">
	<?php foreach ( $notices as $notice ) : ?>
		<li class="woocommerce-notices-notice" <?php echo wc_get_notice_data_attr( $notice ); ?>>
			<?php echo wc_kses_notice( $notice['notice'] ); ?>
      <span class="close-tag">&#10005;</span>
		</li>
	<?php endforeach; ?>
</ul>
<?php
  $color_name = get_field('color_home_product')['color_home_product_name'];
  $color_rgb = get_field('color_home_product')['color_home_product_rgb'];
  $first = get_field('color_home_product')['display_home_product_first'];

  $rgb = '';

  foreach($color_rgb as $key => $color){
    $rgb = $rgb.$color;
    if($key == 'alpha') break;
    $rgb = $rgb.', ';
  }

  $product = wc_get_product(get_the_id());
?>
<?php if($first) : ?>
  <li id="main-gallery-active__color" class="promise-load" data-id="<?php echo get_the_id(); ?>"><?php echo $color_name; ?></li>
<?php endif ?>
<li>
  <span
    class="block main-gallery__color promise-load"
    data-id="<?php echo get_the_id(); ?>"
    data-image="<?php echo wp_get_attachment_url($product->get_image_id()); ?>"
    data-name="<?php echo $product->get_title(); ?>"
    data-color="<?php echo $color_name; ?>"
    data-rgb="<?php echo $rgb; ?>"
    data-link="<?php echo $product->get_permalink(); ?>"
    style="background-color: rgba(<?php echo $rgb;?>);">
  </span>
</li>
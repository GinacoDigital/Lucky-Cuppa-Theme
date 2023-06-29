<?php
  require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php');

  $cart_item_key = $_POST['cart-item-key'];
  $cart_item = WC()->cart->get_cart_item($cart_item_key);
  $data = $cart_item['data']->get_data();
  $product_quantity = $cart_item['quantity'];
  $product_max_quantity = $data['stock_quantity'];

  print_r(WC()->cart);
  
  if($_POST['add'] == 'true'){
    $product_quantity++;
  }
  else if($_POST['add'] == 'false'){
    $product_quantity--;
  }

  if($product_quantity < 1){
    return;
  }
  if($product_quantity > $product_max_quantity && !empty($product_max_quantity)){
    return;
  }

  WC()->cart->set_quantity($cart_item_key, $product_quantity);
?>
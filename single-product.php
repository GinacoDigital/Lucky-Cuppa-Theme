<script>
  if(sessionStorage.getItem('checkout-clicked') == 'true'){
    sessionStorage.setItem('checkout-clicked', 'false')
    location.href = '<?php echo wc_get_cart_url(); ?>'
  }
</script>
<?php 
  get_header();
  
  $checkout = WC()->checkout;
  do_action( 'woocommerce_before_checkout_form', $checkout ); 
?>
<section class="py-section">
  <?php
    while(have_posts()){
      the_post(); ?>
      <div class="product-section">
        <div class="product-section-images">
          <div class="product-section-images__image">
            <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" data-id="<?php $product->get_image_id(); ?>" alt="<?php the_title(); ?> Image">
          </div>
          <div class="product-section-images-gallery">
            <?php
              foreach($product->get_gallery_image_ids() as $image_id){ ?>
                <div class="product-section-images-gallery__image">
                  <img src="<?php echo wp_get_attachment_url($image_id); ?>" data-id="<?php echo $image_id; ?>" alt="Product Image <?php echo $image_id; ?>">
                </div>
            <?php } ?> 
          </div>
        </div>
        <div class="product-section-info">
          <div class="product-section-info__title">
            <span class="font-heading heading-mid font-weight-400"><?php the_title(); ?></span>
          </div>
          <div class="product-section-info__rating">
            <?php if($product->total_sales >= 1) : ?>
              <span class="font-subtitle">Sold (<?php echo $product->total_sales; ?>)</span>
              <span>&bull;</span>
            <?php endif ?>
              <div class="flex items-center gap-2">
                <span class="font-subtitle">Rating</span>
                <span class="rating-stars flex">
                  <?php
                    $rating = round($product->average_rating);
                    get_template_part('/templates/rating-stars', null, array('rating' => $rating));
                  ?>
                </span>
              </div>
              <script>
                const rating = document.querySelector('.rating-stars')
                const svgs = document.querySelectorAll('.rating-stars svg')
                const paths = document.querySelectorAll('.rating-stars svg path')
                
                svgs.forEach(svg => {
                  const data = svg.parentNode.getAttribute('data-id')

                  svg.addEventListener('mouseover', () => {
                    paths.forEach(path => {
                      path.classList.remove('fill')
                    })

                    for(let i=0; i<=data; i++){
                      paths[i].classList.add('fill')
                    }
                  })

                  
                })
                
                rating.addEventListener('mouseleave', () => {
                  paths.forEach(path => {
                    path.classList.remove('fill')
                  })
                })
              </script>
          </div>
          <div class="product-section-info__price">
            <?php
              $regular_price = get_woocommerce_currency_symbol().$product->get_regular_price();
              $sale_price = $product->get_sale_price();

              if(!empty($sale_price)){ ?>
                <span class="font-heading heading-small font-weight-400">
                  <?php echo get_woocommerce_currency_symbol().$sale_price; ?>
                </span>
            <?php } ?>
            <span class="font-heading heading-small font-weight-400 <?php if(!empty($sale_price)){ echo 'opacity-7 td-line-through'; } ?>">
              <?php echo $regular_price; ?>
            </span>
          </div>
          <div class="product-section-info-buttons">
            <form action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
              <button id="checkout-button" type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="product-section-info-buttons__checkout theme-button " onclick="checkoutClicked()">
                <span class="font-subtitle">Checkout</span>
              </button>
              <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="product-section-info-buttons__cart theme-button">
                <?php include get_stylesheet_directory().'/img/svg/cart.svg'; ?>
                <span class="font-subtitle">Add to Cart</span>
              </button>
            </form>
            <script>
              function checkoutClicked(){
                sessionStorage.setItem('checkout-clicked', 'true')
              }
            </script>
          </div>
          <div class="product-section-info-details">
            <span class="font-heading heading-min">Product Details</span>
            <ul class="product-section-info-details__list font-subtitle">
              <?php if(!empty($product->sku)) : ?>
                <li>
                  <div>
                    <span>Product Code</span>
                    <span><?php echo $product->sku; ?></span>
                  </div>
                </li>
              <?php endif ?>
              <?php if(!empty($product->weight)) : ?>
                <li>
                  <div>
                    <span>Weight</span>
                    <span><?php echo $product->weight.get_option('woocommerce_weight_unit'); ?></span>
                  </div>
                </li>
              <?php endif ?>
              <?php
                $length = $product->length;
                $width = $product->width;
                $height = $product->height;
              ?>
              <?php if(!empty($length) && !empty($width) && !empty($height)) : ?>
                <li>
                  <div>
                    <span>Dimension</span>
                    <div>
                      <span><?php echo $length.get_option('woocommerce_dimension_unit').' x '; ?></span>
                      <span><?php echo $width.get_option('woocommerce_dimension_unit').' x '; ?></span>
                      <span><?php echo $height.get_option('woocommerce_dimension_unit'); ?></span>
                    </div>
                  </div>
                </li>
              <?php endif ?>
            </ul>
          </div>
          <div class="product-section-info-description">
            <span class="font-heading heading-min">Product Description</span>
            <span id="product-description" class="product-section-info-description__content font-subtitle">
              <?php the_content(); ?>
            </span>
          </div>
        </div>
      </div>
    <?php } ?>
</section>
<?php if(comments_open() && $product->review_count >= 1) : ?>
  <section>
    <div class="review-section">
      <div class="review-section__title">
        <span class="font-heading">Reviews</span>
      </div>
      <div class="review-section-comments">
        <?php foreach(get_comments() as $key => $review) : ?>
          <?php if($key >=5) break; ?>
          <div class="review-section-comments-item">
            <div class="review-section-comments-item-top">
              <div class="review-section-comments-item-top__rating">
                <span class="flex">
                  <?php 
                    $rating = get_comment_meta($review->comment_ID, 'rating', true);
                    if(empty($rating)) $rating = 1;
                    get_template_part('/templates/rating-stars', null, array('rating' => $rating));
                  ?>
                </span>
              </div>
              <div class="review-section-comments-item-top__date">
                <span class="font-subtitle subtitle-small">
                  <?php
                    $date = $review->comment_date;
                    echo date('M j, Y', strtotime($date));
                  ?>
                </span>
              </div>
            </div>
            <div class="review-section-comments-item-mid">
              <div class="review-section-comments-item-mid__image">
                <img src="<?php echo get_avatar_url($review); ?>" alt="Avatar Image">
              </div>
              <div class="review-section-comments-item-mid__name">
                <span class="font-heading heading-min"><?php echo $review->comment_author; ?></span>
              </div>
            </div>
            <div class="review-section-comments-item-bottom">
              <div class="review-section-comments-item-bottom__content">
                <span class="font-subtitle"><?php echo $review->comment_content; ?></span>
              </div>
            </div>
          </div>
          <hr>
        <?php endforeach ?>
      </div>
    </div>
  </section>
<?php endif ?>
<section class="grid place-center py-section px-8">
  <div class="products-list">
    <div class="products-list-title">
      <?php
        $collection_slug = 'tea-cups' 
      ?>
      <span class="font-heading heading-mid">See Other Products</span>
    </div>
    <div class="products-list-items">
      <?php
        $productsQuery = new WP_Query(array(
          'post_type' => 'product',
          'post_status' => 'publish',
          'ignore_sticky_posts' => 1,
          'meta_key' => 'total_sales',
          'orderby' => 'meta_value_num',
          'posts_per_page' => 3
        ));
      ?>

      <?php while($productsQuery->have_posts()) : ?>
        <?php
          $productsQuery->the_post(); 
          $product_id = get_the_ID();
          $product = wc_get_product($product_id);

          $stock_quantity = $product->get_stock_quantity();
          $regular_price = get_woocommerce_currency_symbol().$product->get_regular_price();
          $sale_price = $product->get_sale_price();

          $image_id =  $product->get_image_id();
          $image_url = wp_get_attachment_url($image_id);
        ?>
        <div class="products-list-items__item" onclick="this.children[0].click()">
          <a href="<?php the_permalink(); ?>">
            <div class="flex justify-center">
              <img src="<?php echo $image_url; ?>">
            </div>
            <?php if($stock_quantity > 0 && $stock_quantity < 10) : ?>
              <div class="font-subtitle flex gap-2">
                <span>Limited Edtion</span>
                <span>&#8226;</span>
                <span style="color: var(--font-main-color-300);">
                  <?php echo $stock_quantity; ?> stock left!
                </span>
              </div>
            <?php endif ?>
            <div class="font-heading heading-min flex justify-between mt-1 gap-4" <?php if($stock_quantity >= 10 || $stock_quantity <= 0){ echo 'style="margin-top: calc(0.25rem + 19px);"'; } ?>>
              <span><?php the_title(); ?></span>
              <div class="flex gap-2">
                <span>
                  <?php if(!empty($sale_price)) echo get_woocommerce_currency_symbol().$sale_price; ?>
                </span>
                <span class="<?php if(!empty($sale_price)) echo 'td-line-through opacity-7';  ?>"><?php echo $regular_price; ?></span>
              </div>
            </div>
          </a>
        </div>
      <?php endwhile ?>
    </div>
  </div>
</section>
<script src="<?php echo get_theme_file_uri('/src/product-description.js'); ?>" defer></script>
<?php get_footer(); ?>
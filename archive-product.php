<?php get_header(); ?>
<section>
  <div class="category-banner">
    <img src="http://lucky-cuppa.local/wp-content/uploads/2023/06/category-banner.png" alt="Collection Banner">
  </div>
</section>
<section class="py-section">
  <div class="main-category">
    <div class="main-category-text">
      <span class="main-category-text__title font-heading heading-mid"><?php single_term_title(); ?></span>
      <span class="font-subtitle">See what we have</span>  
    </div>
    <div class="main-category-list py-section">
      <?php
        while(have_posts()){
          the_post(); ?>
          <div class="main-category-list-card">
            <a href="<?php the_permalink(); ?>">
              <?php
                global $product;
                $image_id = $product->get_image_id();
                $stock_quantity = $product->get_stock_quantity();
                $regular_price = get_woocommerce_currency_symbol().$product->get_regular_price();
                $sale_price = $product->get_sale_price();
              ?>
              <div class="main-category-list-card__image">
                <img src="<?php echo wp_get_attachment_url($image_id); ?>" alt="<?php the_title(); ?> Image">
              </div>
              <div>
                <?php if($stock_quantity > 0 && $stock_quantity < 10) : ?>
                  <div class="main-category-list-card-stock font-subtitle">
                    <span>Limited Edition</span>
                    <span>&#8226;</span>
                    <span class="main-category-list-card-stock__quantity">
                      <?php echo $stock_quantity; ?> stock left!
                    </span>
                  </div>
                <?php endif ?>
                <div class="main-category-list-card-info font-heading heading-min gap-4">
                  <span class="main-category-list-card-info__title"><?php the_title(); ?></span>
                  <div class="main-category-list-card-info__price">
                    <?php if(!empty($sale_price)){ ?>
                      <span><?php echo get_woocommerce_currency_symbol().$sale_price ?></span>
                    <?php } ?>
                    <span class="<?php if(!empty($sale_price)){ echo 'td-line-through opacity-7'; } ?>"><?php echo $regular_price; ?></span>
                  </div>
                </div>
              </div>
            </a>
          </div>
      <?php }
      echo paginate_links(); ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
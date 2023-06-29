<?php
  get_header();

  while(have_posts()){
    the_post(); ?>
    <section id="gallery" class="main-gallery">
      <div class="main-gallery-header flex justify-between container">
        <div class="main-gallery-header-title grid promise-load">
          <span class="font-heading"><?php bloginfo('title'); ?></span>
          <span class="font-subtitle">The Essential <strong>Tea Cups</strong> for your Drinking Pleasure<span>
        </div>
        <ul class="flex items-center font-subtitle main-gallery-header-colors">
          <?php
            $queryProducts = new WP_Query(array(
              'post_type' => 'product',
              'posts_per_page' => -1,
              'meta_key' => 'display_home_product',
              'meta_query' => array(
                array(
                  'key' => 'display_home_product',
                  'compare' => '!=',
                  'value' => 0,
                  'type' => 'numeric'
                )
              )
            ));
          ?>
          <?php
            while($queryProducts->have_posts()){
              $queryProducts->the_post();

              if(get_field('color_home_product_display_home_product_first')){
                get_template_part('/templates/front-product');

                $product = wc_get_product(get_the_id());
                $firstProductArray = array(
                  'image-id' => $product->get_image_id(),
                  'name' => $product->get_title(),
                  'link' => $product->get_permalink()
                );
              }
            }

            while($queryProducts->have_posts()){
              $queryProducts->the_post();

              if(get_field('color_home_product_display_home_product_first')) continue;
              get_template_part('/templates/front-product');
              $product = wc_get_product(get_the_id());
            }

            wp_reset_postdata();
          ?>
        </ul>
      </div>
      <div class="main-gallery-container relative">
        <?php if(!empty($firstProductArray)) : ?>
          <a href="<?php echo $firstProductArray['link']; ?>">
            <img class="main-gallery__image promise-load" src="<?php echo wp_get_attachment_url($firstProductArray['image-id']); ?>" alt="<?php echo $firstProductArray['name']; ?>">
          </a>
        <?php endif ?>
      </div>
    </section>
    <section id="advantages" class="grid place-center pb-section">
      <div class="advantages-list promise-load">
        <div class="advantages-card advantages-card-title">
          <span class="font-heading heading-small"><?php bloginfo('title'); ?></span>
          <span class="font-subtitle">We Build Different</span>
        </div>
        <?php
            $badges = array(
              'tea-cup' => 'Elegant Appearance',
              'diamond' => 'Premium Quality',
              'faucet' => 'Easy to Clean',
              'gift' => 'Perfect for Gifting',
              'badge' => 'Ergonomic Design'
            );

            foreach($badges as $badge){ ?>
              <div class="advantages-card">
                <div class="advantages-card-badge">
                  <?php
                    $svg = array_keys($badges, $badge)[0].'.svg';
                    include get_stylesheet_directory().'/img/svg/'.$svg;
                  ?>
                </div>
                <span class="advantages-card-text font-heading heading-min"><?php echo $badge; ?></span>
              </div>
            <?php }
          ?>
      </div>
    </section>
    <section id="products-grid" class="grid place-center promise-load">
      <div class="products-grid">
        <div class="products-grid-title">
          <span class="font-heading heading-small">Products</span>
          <span class="font-subtitle">Find out on what we have!</span>
        </div>
        <?php if(!empty(get_field('card_collection_taller'))) : ?>
          <div class="products-grid-collection products-grid-collection-tall">
            <?php collection_card(get_field('card_collection_taller_image'), get_field('card_collection_taller_category')); ?>
          </div>
        <?php endif ?>
        <?php if(!empty(get_field('card_collection_wider'))) : ?>
          <div class="products-grid-collection products-grid-collection-wide">
            <?php collection_card(get_field('card_collection_wider_image'), get_field('card_collection_wider_category')); ?>
          <div>
        <?php endif ?>
      </div>
    </section>
    <section id="banner" class="page-banner parallax-container container">
      <div class="page-banner-container">
        <div class="page-banner-content">
          <?php get_template_part('/templates/banner'); ?>
        </div>
        <div class="page-banner-images">
          <?php for($i = 1; $i<=2; $i++) : ?>
            <?php if(!empty(get_field('banner_image'))) : ?>
              <img class="page-banner-images__<?php echo $i; ?> parallax" src="<?php echo get_field('banner_image'); ?>" alt="Banner Image">
            <?php endif ?>
          <?php endfor ?>
        </div>
      </div>
    </section>
    <section id="products-list" class="grid place-center py-section px-8 promise-load">
      <div class="products-list">
        <?php if(!empty(get_field('recommended_collection_list'))) : ?>
          <div class="products-list-title">
            <?php
              $collection_id = get_field('recommended_collection_list');
              $collection_slug = get_term_by('term_id', $collection_id, 'product_cat')->slug;
            ?>
            <span class="font-heading heading-mid"><?php echo get_term_by('term_id', $collection_id, 'product_cat')->name; ?></span>
          </div>
          <div class="products-list-items">
            <?php
              $productsQuery = new WP_Query(array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page' => 3,
                'product_cat' => $collection_slug
              ));

              while($productsQuery->have_posts()) : ?>
                <?php 
                  $productsQuery->the_post(); 
                  $product = wc_get_product(get_the_ID());

                  $stock_quantity = $product->get_stock_quantity();
                  $regular_price = get_woocommerce_currency_symbol().$product->get_regular_price();
                  $sale_price = $product->get_sale_price();

                  $image_url = wp_get_attachment_url($product->get_image_id());
                ?>
                <div class="products-list-items__item" onclick="this.children[0].click()">
                  <a href="<?php the_permalink(); ?>">
                    <div class="flex justify-center">
                      <img src="<?php echo $image_url; ?>">
                    </div>
                    <div class="font-subtitle flex gap-2">
                      <?php if($stock_quantity > 0 && $stock_quantity < 10) : ?>
                        <span>Limited Edtion</span>
                        <span>&#8226;</span>
                        <span style="color: var(--font-main-color-300);">
                          <?php echo $stock_quantity; ?> stock left!
                        </span>
                      <?php endif ?>
                    </div>
                    <div class="font-heading heading-min flex justify-between mt-1 gap-4">
                      <span><?php the_title(); ?></span>
                      <div class="flex gap-2">
                        <span>
                          <?php if(!empty($sale_price)){
                            echo get_woocommerce_currency_symbol().$sale_price;
                          } ?>
                        </span>
                        <span class="<?php if(!empty($sale_price)){ echo 'td-line-through opacity-7'; } ?>"><?php echo $regular_price; ?></span>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endwhile ?>
            <?php wp_reset_postdata(); ?>
          </div>
        <?php endif ?>
      </div>
    </section>
    <section id="collage">
      <div class="collage promise-load">
        <?php if(!empty(get_field('collage'))) : ?>
          <?php foreach(get_field('collage') as $key => $id) : ?>
            <?php
              if($key >= 2) break;
              collection_collage_image($id);
            ?>
          <?php endforeach ?>
        <?php endif ?>
      </div>
    </section>
  <?php }
  get_footer(); ?>
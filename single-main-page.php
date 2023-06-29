<?php
  get_header();
  global $post;
  $post_name = $post->post_name;
  
  while(have_posts()){
    the_post(); ?>
    <section id="main" class="main-product py-section">
      <div class="main-product-text promise-load">
        <span class="main-product-text__title font-heading"><?php bloginfo('title') ?>'s Present</span>
        <span class="font-subtitle"><?php the_title(); ?>' Edition</span>
      </div>
      <div class="main-product-image">
        <?php if(!empty(get_field('main_product'))) : ?>
          <?php
            $product_id = get_field('main_product');
            $product = wc_get_product($product_id);

            $main_product_name = $product->name;
            $main_product_image_url = wp_get_attachment_url($product->get_image_id());
          ?>
          <a href="<?php echo $product->get_permalink(); ?>">
            <img class="promise-load" src="<?php echo $main_product_image_url; ?>" alt="<?php echo $main_product_name; ?>"></img>
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
    <section id="products-grid" class="grid place-center">
      <div class="products-grid products-grid-single">
        <div class="products-grid-title promise-load">
          <span class="font-heading heading-small">
            <?php
              the_title();
            ?>
          </span>
          <span class="font-subtitle">These products won't be released again. Forever.</span>
        </div>
        <div class="products-grid-collection products-grid-single-collection products-grid-collection-tall products-grid-single-collection-tall !no-background promise-load">
          <div class="products-grid-collection-tall-items">
            <?php if(!empty(get_field('recommended_products'))) : ?>
              <?php foreach(get_field('recommended_products') as $key => $product_id) : ?>
                <?php
                  if($key >= 2) break;
                  $product = wc_get_product($product_id);
                ?>
                <div class="products-grid-collection-tall-items__card">
                  <a href="<?php echo $product->get_permalink(); ?>">
                    <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="<?php echo $product->name; ?>">
                  </a>
                </div>
              <?php endforeach ?>
            <?php endif ?>
          </div>
        </div>
        <?php if(!empty(get_field('recommended_collection'))) : ?>
          <div class="products-grid-collection products-grid-collection-wide products-grid-single-collection-wide !card-background promise-load">
            <?php
              $collection = get_term_by('term_id', get_field('recommended_collection'), 'product_cat');
              $collection_id = $collection->term_id;
              $collection_url = get_term_link($collection_id, 'product_cat');
            ?>
            <div class="products-grid-text">
              <span class="products-grid-text-title font-subtitle subtitle-huge">
                What makes it differents?
              </span>
              <div class="products-grid-button theme-button mt-2" onclick="this.children[0].click()">
                <a href="<?php echo $collection_url; ?>">
                  <span class="font-subtitle subtitle-min">See Products</span>
                </a> 
              </div>
            </div>
            <img src="<?php echo $main_product_image_url; ?>" alt="<?php echo $main_product_name; ?>">
          <div>
        <?php endif ?>
      </div>
    </section>
    <section id="banner" class="page-banner container">
      <div class="page-banner-content">
        <?php get_template_part('/templates/banner'); ?>
      </div>
      <div class="page-banner-images page-banner-images-single">
        <img class="page-banner-images__single" src="<?php echo get_field('banner_image'); ?>" alt="<?php echo the_title(); ?>">
      </div>
    </section>
    <?php if($post_name == 'sherlock-holmes') : ?>
      <section id="sherlock" class="container promise-load">
        <div class="sherlock-quote parallax-container">
          <div class="sherlock-quote-content">
            <span class="sherlock-quote-content__text font-heading heading-mid">
              &ldquo;There is nothing more deceptive than an obvious fact.&rdquo;
            </span>
            <span class="sherlock-quote-content__author font-subtitle">
              ― Arthur Conan Doyle, The Boscombe Valley Mystery
            </span>
          </div>
          <div class="sherlock-quote-image parallax">
            <?php if(!empty(get_field('sherlock_detective_image'))) : ?>
              <img src="<?php echo get_field('sherlock_detective_image'); ?>" alt="Detective">
            <?php endif ?>
          </div>
          <div class="sherlock-quote-steps parallax">
            <?php if(!empty(get_field('sherlock_steps_image'))) : ?>
              <img src="<?php echo get_field('sherlock_steps_image'); ?>" alt="Steps">
            <?php endif ?>
          </div>
        </div>
      </section>
    <?php endif ?>
    <?php if($post_name == 'alice-in-the-wonderland') : ?>
      <section id="alice" class="container promise-load">
        <div class="alice-wonderland">
          <div class="alice-wonderland-image">
            <?php if(!empty(get_field('alice_first_dall_image'))) : ?>
              <img src="<?php echo get_field('alice_first_dall_image'); ?>" alt="Alice Dall">
            <?php endif ?>
          </div>
          <div class="alice-wonderland-content">
            <span class="alice-wonderland-content__title font-heading heading-mid"><?php the_title(); ?></span>
            <span class="alice-wonderland-content__desc font-subtitle">We will not reproduce this anymore. Get it before it is gone!</span>
            <div class="alice-wonderland-content__button theme-button">
              <a href="/">
                <span class="font-subtitle">Get The Up!</span>
              </a>
            </div>
          </div>
          <div class="alice-wonderland-image">
            <?php if(!empty(get_field('alice_second_dall_image'))) : ?>
              <img src="<?php echo get_field('alice_second_dall_image'); ?>" alt="Alice Dall">
            <?php endif ?>
          </div>
        </div>
      </section>
    <?php endif ?>
    <?php if(!empty(get_field('special_offer'))) : ?>
      <section id="special-offer promise-load">
        <div class="limited-product">
          <?php
            $product_id = get_field('special_offer');
            $product = wc_get_product($product_id);
            $product_name = $product->name;
            $product_desc = $product->short_description;
            $product_url = $product->get_permalink();

            $regular_price = get_woocommerce_currency_symbol().$product->get_regular_price();
            $sale_price = $product->get_sale_price();

            $image_id = $product->get_image_id();
            $image_url = wp_get_attachment_url($image_id);
          ?>
          <div class="limited-product__image">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $product_name; ?>">
          </div>
          <div class="limited-product-content">
            <span class="font-heading heading-mid"><?php echo $product_name; ?></span>
            <span class="font-subtitle"><?php echo $product_desc; ?></span>
            <div class="limited-product-content__price">
              <span class="font-heading heading-min font-weight-400">Just for </span>
              <span class="font-heading heading-small">
                <?php
                  if(empty($sale_price)){
                    echo $regular_price.'/each';
                  }
                  else{
                    echo get_woocommerce_currency_symbol().$sale_price.'/each';
                  }
                ?>
              </span>
            </div>
            <div class="limited-product-content__button theme-button">
              <a href="<?php echo $product_url; ?>">
                <span class="font-subtitle">Get the offer</span>
              </a>
            </div>
          </div>
        </div>
      </section>
    <?php endif ?>
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
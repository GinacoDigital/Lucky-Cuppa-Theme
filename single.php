<?php
  get_header();

  while(have_posts()){
    the_post(); ?>
    <section class="main-product py-section">
      <div class="main-product-text">
        <span class="main-product-text__title font-heading"><?php bloginfo('title') ?>'s Present</span>
        <span class="font-subtitle"><?php the_title(); ?>' Edition</span>
      </div>
      <div class="main-product-image">
        <?php
          $product_id = 38;
          if(get_the_id() == 7){
            $product_id = 30;
          }

          $product = wc_get_product($product_id);
          $product_name = $product->name;
          $product_url = $product->get_permalink();

          $image_id = $product->get_image_id();
          $image_url = wp_get_attachment_url($image_id);
        ?>
        <a href="<?php echo $product_url; ?>">
          <img src="<?php echo $image_url; ?>" alt="<?php echo $product_name; ?>"></img>
        </a>
      </div>
    </section>
    <section class="grid place-center pb-section">
      <div class="advantages-list">
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
    <section class="grid place-center">
      <div class="products-grid products-grid-single">
        <div class="products-grid-title">
          <span class="font-heading heading-small">
            <?php
              $postSlug = 'sherlock-holmes';
              if(get_the_id() == 7){
                $postSlug = 'alice-wonderland';
              }

              echo get_term_by('slug', $postSlug, 'product_cat')->name;
            ?>
          </span>
          <span class="font-subtitle">These products won't be released again. Forever.</span>
        </div>
        <div class="products-grid-collection products-grid-single-collection products-grid-collection-tall products-grid-single-collection-tall !no-background">
          <div class="products-grid-collection-tall-items">
            <?php
              $queryPosts = new WP_Query(array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => 2,
                'order' => 'ASC',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $postSlug
                  )
                )
              ));

              while($queryPosts->have_posts()){
                $queryPosts->the_post(); ?>
                <div class="products-grid-collection-tall-items__card">
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="<?php the_title(); ?>">
                  </a>
                </div>
              <?php }
              wp_reset_postdata();
            ?>
          </div>
        </div>
        <div class="products-grid-collection products-grid-collection-wide products-grid-single-collection-wide !card-background">
          <?php
            $collection = get_term_by('slug', 'tea-cups', 'product_cat');
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
          <img src="<?php echo $image_url; ?>" alt="<?php echo $product_name; ?>">
        <div>
      </div>
    </section>
    <section class="page-banner container">
      <div class="page-banner-content">
        <?php
          $collection = get_term_by('slug', 'drink-me', 'product_cat');
          $collection_id = $collection->term_id;
          $collection_name = $collection->name;
          $collection_desc = category_description($collection_id);
          $collection_url = get_term_link($collection_id, 'product_cat');
    
          $product = wc_get_product(31);
          $image_id = $product->get_image_id();
          $image_url = wp_get_attachment_url($image_id);
        ?>
        <span class="page-banner-content__title font-heading heading-small"><?php echo $collection_name; ?></span>
        <span class="page-banner-content__text font-subtitle"><?php echo $collection_desc; ?></span>
        <div class="page-banner-content__button theme-button" onclick="this.children[0].click()">
          <a href="<?php echo $collection_url; ?>">
            <span class="font-subtitle subtitle-min">See Products</span>
          </a>
        </div>
      </div>
      <div class="page-banner-images page-banner-images-single">
        <?php if(get_the_id() == 6){ ?>
          <img class="page-banner-images__single" src="http://lucky-cuppa.local/wp-content/uploads/2023/06/sherlock-banner-img.png" alt="Sherlock Holmes">
        <?php } elseif(get_the_id() == 7){ ?>
          <img class="page-banner-images__single" src="http://lucky-cuppa.local/wp-content/uploads/2023/06/alice-banner-img.png" alt="Alice in the Wonderland">
        <?php } ?>
      </div>
    </section>
    <?php if(get_the_id() == 6){ ?>
      <section class="container">
        <div class="sherlock-quote">
          <div class="sherlock-quote-content">
            <span class="sherlock-quote-content__text font-heading heading-mid">
              &ldquo;There is nothing more deceptive than an obvious fact.&rdquo;
            </span>
            <span class="sherlock-quote-content__author font-subtitle">
              ― Arthur Conan Doyle, The Boscombe Valley Mystery
            </span>
          </div>
          <div class="sherlock-quote-image">
            <img src="http://lucky-cuppa.local/wp-content/uploads/2023/06/sherlock.png" alt="Detective">
          </div>
          <div class="sherlock-quote-steps">
            <img src="http://lucky-cuppa.local/wp-content/uploads/2023/06/steps.png" alt="Steps">
          </div>
        </div>
      </section>
    <?php } ?>
    <?php if(get_the_id() == 7){ ?>
      <section class="container">
        <div class="alice-wonderland">
          <div class="alice-wonderland-image">
            <img src="http://lucky-cuppa.local/wp-content/uploads/2023/06/alice1.png" alt="Alice Dall">
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
            <img src="http://lucky-cuppa.local/wp-content/uploads/2023/06/alice2.png" alt="Alice Dall">
          </div>
        </div>
      </section>
    <?php } ?>
    <section>
      <div class="limited-product">
        <?php
          $product_id = 53;
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
    <section>
      <div class="collage">
        <?php
          collection_collage_image('lucky-cuppa');
          collection_collage_image('drink-me');
        ?>
      </div>
    </section>
  <?php }
  get_footer(); ?>
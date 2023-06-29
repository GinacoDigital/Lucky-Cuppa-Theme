<?php
  function collection_card($image_url, $collection_id){
      $collection = get_term_by('term_id', $collection_id, 'product_cat');
      $collection_name = $collection->name;
      $collection_url = get_term_link($collection_id, 'product_cat');
    ?>
    <div class="products-grid-text">
      <span class="products-grid-text-title font-subtitle subtitle-huge">
        <?php echo $collection_name; ?>
      </span>
      <div class="products-grid-button theme-button mt-2" onclick="this.children[0].click()">
        <a href="<?php echo $collection_url; ?>">
          <span class="font-subtitle subtitle-min">See Products</span>
        </a> 
      </div>
    </div>
    <img src="<?php echo $image_url; ?>" alt="<?php echo $collection_name; ?>">
  <?php }

  function collection_collage_image($collection_id){
    $collection = get_term_by('term_id', $collection_id, 'product_cat');
    $collection_id = $collection->term_id;
    $collection_name = $collection->name;
    $collection_url = get_term_link($collection_id, 'product_cat');
    
    $thumbnail_id = get_woocommerce_term_meta($collection_id, 'thumbnail_id', true);
    $image_url = wp_get_attachment_url($thumbnail_id); ?>
    <div class="collage-item">
      <div class="collage-item__image">
        <img src="<?php echo $image_url; ?>" alt="<?php echo $collection_name; ?>">
      </div>
      <div class="collage-item-info">
        <span class="collage-item-info__title font-heading heading-small"><?php echo $collection_name; ?></span>
        <div class="collage-item-info__button theme-button" onclick="this.children[0].click();">
          <a href="<?php echo $collection_url; ?>">
            <span class="font-subtitle subtitle-min">See Products</span>
          </a>
        </div>
      </div>
    </div>
  <?php }

  function files(){
    global $post;
    if(!is_null($post)){
      $post_name = $post->post_name;
      $post_type = $post->post_type;
    }
    else{
      $post_name = '';
      $post_type = '';
    }

    wp_enqueue_style('theme_styles', get_theme_file_uri('/css/base/main-theme.css'));
    if($post_name == 'sherlock-holmes'){
      wp_enqueue_style('sherlock_styles', get_theme_file_uri('css/base/sherlock-theme.css'));
    }
    elseif($post_name == 'alice-in-the-wonderland'){
      wp_enqueue_style('alice_styles', get_theme_file_uri('css/base/alice-theme.css'));
    }

    wp_enqueue_style('main_styles', get_theme_file_uri('/css/style.css'));

    wp_enqueue_script('function-decode-html-entity', get_theme_file_uri('/src/functions/decodeHTMLEntity.js'));
    wp_enqueue_script('function-create-element', get_theme_file_uri('/src/functions/createElement.js'));
    wp_enqueue_script('function-create-clone-element', get_theme_file_uri('/src/functions/createCloneElement.js'));

    wp_enqueue_script('main-product-colors', get_theme_file_uri('/src/main-product-colors.js'));
    wp_enqueue_script('gallery-images', get_theme_file_uri('/src/gallery-images.js'));
    wp_enqueue_script('notices-script', get_theme_file_uri('/src/notices.js'));

    if($post_name == 'home-page' || $post_type == 'main-page'){
      wp_enqueue_script('scroll-animation', get_theme_file_uri('/src/scroll-animation.js'));
    }
  }

  function features(){
    add_theme_support('woocommerce');
    add_theme_support('menus');
    register_nav_menu('sitemap', 'Sitemap');
  }

  add_action('after_setup_theme', 'features');
  add_action('wp_enqueue_scripts', 'files');

  if(class_exists('Woocommerce')){
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
  }
?>
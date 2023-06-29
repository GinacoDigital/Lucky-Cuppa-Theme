<!DOCTYPE html>
<html <?php language_attributes(); ?> style="margin-top: 0 !important;">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('title'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header id="header" class="header-section">
    <ul class="header-section-list">
      <li class="header-section-list-logo">
        <div>
          <?php include get_stylesheet_directory().'/img/svg/luckycuppa-header-logo.svg'; ?>
        </div>
      </li>
      <ul class="header-section-list header-section-list-homes font-header">
        <li>
          <a href="<?php echo get_home_url(); ?>"><?php echo bloginfo('title') ?></a>
        </li>
        <?php
          $queryPosts = new WP_Query(array(
            'post_type' => 'main-page'
          ));

          while($queryPosts->have_posts()){
            $queryPosts->the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
          <?php }
          wp_reset_postdata();
        ?>
      </ul>
    </ul>
    <ul class="header-section-list header-section-icons">
      <li>
        <a href="<?php echo wc_get_cart_url(); ?>">
          <span><?php include get_stylesheet_directory().'/img/svg/cart.svg'; ?></span>
        </a>
      </li>
    </ul>
  </header>
  <main>
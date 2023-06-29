<?php if(!empty(get_field('banner_title'))) : ?>
  <span class="page-banner-content__title font-heading heading-small promise-load"><?php echo get_field('banner_title'); ?></span>
<?php endif ?>
<?php if(!empty(get_field('banner_description'))) : ?>
  <span class="page-banner-content__text font-subtitle promise-load"><?php echo get_field('banner_description'); ?></span>
<?php endif ?>
<?php if(!empty(get_field('banner_collection'))) : ?>
  <div class="page-banner-content__button theme-button promise-load" onclick="this.children[0].click()">
    <a href="<?php echo get_term_link(get_field('banner_collection'), 'product_cat'); ?>">
      <span class="font-subtitle subtitle-min">See Products</span>
    </a>
  </div>
<?php endif ?>
<?php get_header(); ?>
<section class="container">
  <div class="page-section">
    <div class="page-section__title">
      <span class="font-heading"><?php the_title(); ?></span>
    </div>
    <div class="page-section__content">
      <span class="font-subtitle"><?php the_content(); ?></span>
    </div>
  </div>
</section>
<?php get_footer(); ?>
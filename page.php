<?php get_header(); ?>
<section class="container">
  <div class="page-section__title">
    <span class="font-heading"><?php the_title(); ?></span>
  </div>
  <div class="page-section__content">
    <span class="font-body"><?php the_content(); ?></span>
  </div>
</section>
<?php get_footer(); ?>
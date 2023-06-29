<?php get_header(); ?>
<section class="container">
  <div class="archive-section">
    <div class="archive-section__title">
      <span class="font-heading"><?php the_title(); ?></span>
    </div>
    <div class="archive-section__content">
      <span class="font-body"><?php the_content(); ?></span>
    </div>
    <div class="archive-section-posts">
      <ul class="archive-section-posts-list">
        <?php while(have_posts()) : ?>
          <?php the_post(); ?>
          <li class="archive-section-posts-list-item">
            <a href="<?php the_permalink(); ?>">
              <span class="font-heading heading-min"><?php the_title(); ?></span>
            </a>
            <span class="font-body body-sm"><?php the_excerpt(); ?></span>
          </li>
        <?php endwhile ?>
      </ul>
    </div>
  </div>
</section>
<?php get_footer(); ?>
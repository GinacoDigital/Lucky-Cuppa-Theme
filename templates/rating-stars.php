<?php for($i=0; $i<$args['rating']; $i++) : ?>
  <a href="#" data-id="<?php echo $i; ?>">
    <?php include get_stylesheet_directory().'/img/svg/star-solid.svg'; ?>
  </a>
<?php endfor ?>
<?php for($i=$args['rating']; $i<5; $i++) : ?>
  <a href="#" data-id="<?php echo $i; ?>">
    <?php include get_stylesheet_directory().'/img/svg/star-outline.svg'; ?>
  </a>
<?php endfor ?>
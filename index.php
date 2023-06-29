<?php
    get_header();
?>
<div>
    <?php
        while(have_posts()){
            the_post(); ?>

        <?php }
    ?>
</div>
<?php
    get_footer();
?>
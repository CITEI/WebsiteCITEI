<?php
/*
Type: Single
Purpose: Used for displaying a single post
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php
get_header();

?>
<main class="container text-center">
    <?php the_post(); ?>
    <h1><?php echo get_the_title(); ?>
    <div class="text-left">
        <?php the_content() ?>
    </div>
</main>

<?php
get_footer();
?>
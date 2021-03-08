<?php
/*
Type: Single
Name: Produtos
Purpose: Displays  a post about a product
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php 
    get_header(); 
    the_post();
    $cover = get_field("coverimg");
?>
<section>
    <?php
        get_template_part('template_parts/content/cover', ''
            , array(
                'imgurl' => $cover['url'],
                'title' => get_the_title(),
                'description' => get_the_excerpt()
            ));
    ?>
</section>
<?php the_content() ?>

<?php get_footer(); ?>

<?php
/*
Type: Search
Purpose: Shows the posts obtained by a search
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php
get_header();

?>
<main>
<?php get_template_part('template_parts/content/post_list', '',
    array(
        'yes_title' => "Resultados da busca",
        'no_title' => "Sem resultados para busca"
    ));
?>
</main>

<?php
get_footer();
?>
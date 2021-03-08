<?php
/*
Type: Archive
Purpose: Fallback for post types list
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php
get_header();
?>

<?php get_template_part('template_parts/content/post_list', '',
    array(
        'yes_title' => post_type_archive_title( '', false ),
        'no_title' => "Sem itens nessa categoria."
    ));
?>

<?php
get_footer();
?>
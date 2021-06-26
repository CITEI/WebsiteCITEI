<?php
/*
Type: Index
Purpose: Default fallback for everything
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php
get_header();
?>

<?php get_template_part('template_parts/content/post_list', '',
    array(
        'yes_title' => "",
        'no_title' => ""
    ));
?>

<?php
get_footer();
?>
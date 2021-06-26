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
        'yes_title' => __('Search results', 'citei'),
        'no_title' => __('No items were found', 'citei')
    ));
?>
</main>

<?php
get_footer();
?>
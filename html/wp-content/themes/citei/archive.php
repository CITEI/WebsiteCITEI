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
        'yes_title' => __(post_type_archive_title( '', false ), 'citei'),
        'no_title' => __('No items to show within this category.', 'citei')
    ));
?>

<?php
get_footer();
?>
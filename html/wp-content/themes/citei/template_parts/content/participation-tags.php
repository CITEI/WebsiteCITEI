<?php 
/*
Type: Template Part
Name: Participation tags
Purpose: Displays posts as a tag cloud layout of a specific post type with a specified tag
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>

<?php
    $tag = get_term_by('name', $args['tag'], 'post_tag');
    if ($tag)
    {
        $posts = new WP_Query(array(
            'post_type' => $args['post_type'],
            'tag__in' => $tag->term_id)
        );
        if ($posts->have_posts())
        { 
            ?>
            <h5><?php echo $args['label'] ?></h5>
            <div class="row mx-auto">
                <?php 
                    while($posts->have_posts())
                    { 
                        $posts->the_post();
                        ?>
                        <div class="col col-auto p-1">
                            <a class="btn btn-primary rounded-pill" 
                                href="<?php echo the_permalink($post) ?>">
                                <?php echo get_the_title($post) ?>
                            </a>
                        </div>
                <?php }
                    wp_reset_postdata();
                ?>
            </div>
<?php } } ?>
<?php
/*
Type: Single
Name: Person
Purpose: Displays a post about a person
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php 
    get_header(); 
    the_post();
?>

<section class="container bg-white text-center">
    <h1 class="mb-4" tabindex="0"><?php echo get_the_title() ?></h1>
    <div class="row mx-auto pb-3">
        <aside class="col-md-3 pb-3">
            <div class="card text-left">
                <img class="card-img-top"
                    src="<?php echo get_the_post_thumbnail_url(); ?>" 
                    alt="<?php echo get_post_meta( get_post_thumbnail_id(), 
                                    '_wp_attachment_image_alt', true); ?>"
                    />
                <div class="card-body" >
                    <div tabindex="0" aria-label="<?php _e('Excerpt', 'citei') ?>">
                        <h4 tabindex="-1"><?php _e('Excerpt', 'citei') ?></h4>
                        <p tabindex="0">
                            <?php echo get_the_excerpt(); ?>
                        </p>
                    </div>
                    <div class="mb-3">
                        <?php 
                            echo get_template_part('template_parts/content/participation-tags' , ''
                                , array(
                                    'post_type' => 'products',
                                    'label' => __('Products', 'citei'),
                                    'tag'   => get_the_title()
                                )); 
                        ?>
                    </div>
                    
                    <div class="mb-3">
                        <?php  
                            echo get_template_part('template_parts/content/participation-tags' , ''
                                , array(
                                    'post_type' => 'projects',
                                    'label' => __('Projects', 'citei'),
                                    'tag'   => get_the_title()
                                ));
                        ?>
                    </div>
                    <div>
                        <?php  
                            echo get_template_part('template_parts/content/participation-tags', ''
                                , array(
                                    'post_type' => 'research_groups',
                                    'label' => __('Research Groups', 'citei'),
                                    'tag'   => get_the_title()
                                ));
                        ?>
                    </div>
                </div>
            </div>
        </aside>
        <article class="col-md text-left sr-read-children">
            <?php echo get_the_content(); ?>
        </article>
    </div>
</section>

<?php get_footer(); ?>

<?php 
/*
Type: Template Part
Name: Post list
Purpose: Displays a list of posts
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php
    if (have_posts())
    {
?>
        <div class="container my-4 text-center">
            <h1 tabindex="-1"><?php echo $args['yes_title'] ?></h1>
        </div>
    <ul role="list" tabindex="0"  class="p-0 mb-0"
        aria-label="<?php echo $args['yes_title'] ?>" class="list-unstyled">
    <?php
        while(have_posts())
        { 
            the_post()
        ?>
            <li class="row mx-auto border" 
                tabindex="0" role="listitem"
                aria-label="<?php echo get_the_title() ?>">
                <div class="container my-4">
                    <div class="row mx-auto justify-content-center">
                        <?php if(has_post_thumbnail())
                        {?>
                            <div class="col-auto p-2 my-auto" aria-hidden="true">
                                <a tabindex="-1" href="<?php echo get_the_permalink(); ?>">
                                    <img
                                        src="<?php echo get_the_post_thumbnail_url(); ?>" 
                                        alt="<?php echo get_post_meta( get_post_thumbnail_id(), 
                                                        '_wp_attachment_image_alt', true); ?>"
                                        class="rounded-circle"
                                        style="width: 230px" />
                                </a>
                            </div>
                        <?php } ?>
                        <div class="col p-2 my-auto d-flex flex-column"
                            role="row" tabindex="-1">
                            <h3><?php echo get_the_title(); ?></h3>
                            <p><?php echo get_the_excerpt(); ?></p>
                            <a class="btn btn-primary align-self-end" 
                                role="complementary" tabindex="0"
                                href="<?php echo get_the_permalink(); ?>">
                                Ler mais
                            </a>
                        </div>
                    </div>
                </div>
            </li>
<?php 
        } 
?>
        </ul>
<?php
    }
    else
    { 
?>
        <section class="container my-4 text-center">
            <h2 tabindex="0"><?php echo $args['no_title'] ?></h2>
        </section>
<?php
    }
?>
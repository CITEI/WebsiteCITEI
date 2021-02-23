<?php
    $posts = get_posts_by_category($attributes['category']);
    foreach($posts as $post)
    { 
        setup_postdata($GLOBALS['post'] =& $post);
    ?>
        <div class="row mx-auto border">
            <div class="container my-4">
                <div class="row mx-auto justify-content-center">
                    <div class="col-auto my-auto">
                        <a href="<?php echo get_the_permalink(); ?>">
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" 
                                alt="<?php echo get_post_meta( get_post_thumbnail_id(), 
                                                '_wp_attachment_image_alt', true); ?>"
                                class="rounded-circle"
                                style="width: 200px" />
                        </a>
                    </div>
                    <div class="col my-auto d-flex flex-column">
                        <h4><?php echo get_the_title(); ?></h4>
                        <p><?php echo get_the_excerpt(); ?></p>
                        <a class="btn btn-primary align-self-end stretched-link"
                            href="<?php echo get_the_permalink(); ?>">
                            Ler mais
                        </a>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
<?php 
    $id = new_id() ;
    $slides = new WP_Query(array(
        'post_type' => $attributes['post_type'],
        'posts_per_page' => $attributes['max-posts']));
    if ($slides->have_posts())
    {
?>
        <div id="citeicarousel-<?php echo $id; ?>" 
            class="carousel slide child-expand" 
            data-ride="carousel"
            style="
                min-height: <?php echo $attributes['min-height'] ?>px;
                ">
            <div class="carousel-inner expanded-child" style="">
                <?php
                    $active = "active";
                    while($slides->have_posts())
                    { 
                        $slides->the_post();
                        $cover = get_field("coverimg", get_the_ID());
                ?>
                        <div class="carousel-item w-100 h-100
                            <?php echo $active; ?>">
                            <div class="w-100 h-100 cover"
                                style="
                                    background: url(<?php echo $cover['url'] ?>);
                                ">
                                <div class="h-100" 
                                    style="
                                        backdrop-filter: brightness(0.5);
                                        ">
                                    <div class="mx-auto h-100 d-flex flex-column
                                                text-white py-5 justify-content-center
                                                align-items-start"
                                        style="
                                            width: 70%;
                                        ">
                                        <h2 class="text-lowercase">
                                            <?php echo $attributes['post_type'] ?>
                                        </h2>
                                        <h1 class="display-4 text-break">
                                            <?php echo get_the_title() ?>
                                        </h1>
                                        <p class="lead">
                                            <?php echo get_the_excerpt() ?>
                                        </p>
                                        <a 
                                            class="btn btn-primary stretched-link
                                                    align-self-end"
                                            href="<?php the_permalink() ?>">
                                            Ler mais
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php 
                        $active = "";
                    }
                    wp_reset_postdata();
                ?>
            </div>
            <a class="carousel-control-prev" href="#citeicarousel-<?php echo $id; ?>" 
                role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#citeicarousel-<?php echo $id; ?>" role="button" 
                data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
<?php
    } else {
?>
        <h2>Sem posts para mostrar.</h2>
<?php
    }
?>
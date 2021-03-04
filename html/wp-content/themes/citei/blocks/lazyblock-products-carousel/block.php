<?php
/*
Type: LazyBlock
Name: Products carousel
Purpose: Displays an image carousel with title and excerpt 
    of posts from a post type
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
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
            data-interval="false"
            aria-label="Carrossel de <?php echo $attributes['post_type'] ?>"
            tabindex="0"
            style="
                min-height: <?php echo $attributes['min-height'] ?>px;
                ">
            <div id="citeicarousel<?php echo $id ?>-inner"
                class="carousel-inner expanded-child" style="">
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
                                        <h1 class="text-lowercase"
                                            aria-hidden="true">
                                            <?php echo $attributes['post_type'] ?>
                                        </h1>
                                        <h1 class="display-3 text-break"
                                            tabindex="0">
                                            <?php echo get_the_title() ?>
                                        </h1>
                                        <p class="lead"
                                            tabindex="0">
                                            <?php echo get_the_excerpt() ?>
                                        </p>
                                        <a 
                                            class="btn btn-primary
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
                role="button" aria-label="Item anterior"
                aria-controls="citeicarousel<?php echo $id ?>-inner"
                data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#citeicarousel-<?php echo $id; ?>" 
                role="button" aria-label="Próximo item"
                aria-controls="citeicarousel<?php echo $id ?>-inner"
                data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
<?php
    } else {
?>
        <h2>Sem posts para mostrar.</h2>
<?php
    }
?>
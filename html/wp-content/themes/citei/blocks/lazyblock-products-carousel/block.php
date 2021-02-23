<?php $id = new_id() ?>
<div id="citeicarousel-<?php echo $id; ?>" class="carousel slide" data-ride="carousel"
    style="
        min-height: <?php echo $attributes['min-height'] ?>px;
        ">
    <div class="carousel-inner" style="">
    <?php 
        $slides = get_posts_by_category($attributes['category'], 
            $attributes['max-posts']);
        if (!empty($slides)) 
        {
            $active = "active";
            foreach($slides as $post)
            { 
                setup_postdata($GLOBALS['post'] =& $post);
    ?>
                <div class="carousel-item <?php echo $active; ?>">
                    <img class="d-block w-100" 
                        src="<?php  ?>" 
                        alt="<?php  ?>" />
                    <div class="carousel-caption">
                        <h5><?php echo get_the_title(); ?></h5>
                        <p><?php echo get_the_excerpt(); ?></p>
                    </div>
                </div>
        <?php $active = "";
            }
        }?>
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
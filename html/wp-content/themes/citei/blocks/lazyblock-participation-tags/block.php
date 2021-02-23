<div class="container">
    <h6><?php echo $attributes['label'] ?></h6>
    <div class="row mx-auto">
        <?php 
            $posts = get_posts(array('tag' => $attributes['tag']));
            foreach($posts as $post)
            {
                setup_postdata($GLOBALS['post'] =& $post); ?>
                <a class="btn btn-primary m-1 rounded-pill" 
                    href="<?php echo the_permalink() ?>">
                    <?php echo get_the_title() ?>
                </a>
        <?php } ?>
    </div>
</div>
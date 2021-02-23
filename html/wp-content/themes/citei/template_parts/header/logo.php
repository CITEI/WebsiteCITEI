<?php 

/* Displays custom logo image or blog's name */

    if(has_custom_logo())
        the_custom_logo();
    else
    { ?>
        <a href="<?php echo home_url(); ?>">
            <h1 class="navbar-brand"><?php bloginfo('name'); ?></h1></a>
<?php } ?>
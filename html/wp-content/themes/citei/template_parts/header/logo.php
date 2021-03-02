<?php 

/* Displays custom logo image or blog's name */

    if(has_custom_logo())
    {
?>
        <a href="<?php echo get_home_url() ?>">
            <img src="<?php echo get_the_custom_logo_url() ?>"
                alt="<?php echo bloginfo('name') ?>"
                style="
                    max-width: 200px;
                    width: 100%;
                " />
        </a>
<?php
    }
    else
    { 
?>
        <a href="<?php echo home_url(); ?>">
            <h1 class="navbar-brand"><?php bloginfo('name'); ?></h1></a>
<?php } ?>
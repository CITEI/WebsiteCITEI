<?php
/*
Type: Template_part
Name: Logo
Purpose: Displays custom logo or blog's name
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php 
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
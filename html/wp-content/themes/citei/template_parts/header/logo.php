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
       $custom_logo_id = get_theme_mod( 'custom_logo' );
       $custom_logo_data = wp_get_attachment_image_src( $custom_logo_id , 'full' );
       $custom_logo_url = $custom_logo_data[0];
?>
        <a id="logo-link" href="<?php echo get_home_url() ?>" 
            role="link" aria-label="<?php _e('Go to home', 'citei') ?>"
            tabindex="100">
            <img src="<?php echo $custom_logo_url ?>"
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
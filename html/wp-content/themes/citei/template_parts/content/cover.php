<?php
/*
Type: Template_part
Name: Cover
Purpose: Displays cover image
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<div style="
    background:linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
        url(<?php echo esc_url($args['imgurl']) ?>);
    background-size: cover;
    background-position: center;
    min-height: 400px;
    display: flex;
    align-self: stretch;
">
    <div class="d-flex justify-content-center flex-column
            align-items-center text-white" 
        style="
            flex: 1;
        ">
        <div class="py-4 container sr-read-children"
            tabindex="-1">
            <h1 class="display-3 text-break">
                <?php echo esc_html($args['title']) ?>
            </h1>
            <p class="lead">
                <?php echo esc_html($args['description']) ?>
            </p>
        </div> 
    </div>
</div>
<?php
/*
Type: Template_part
Name: Cover
Purpose: Displays cover image
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<div style="
    background: url(<?php echo $args['imgurl'] ?>);
    background-size: cover;
    background-position: center;
    min-height: 400px;
    display: flex;
    align-self: stretch;
">
    <div class="d-flex justify-content-center flex-column
            align-items-center text-white" 
        style="
            backdrop-filter: brightness(0.4);
            flex: 1;
        ">
        <div class="py-4 container">
            <h1 class="display-4 text-break"><?php echo $args['title'] ?></h1>
            <p class="lead"><?php echo $args['description'] ?>
        </div> 
    </div>
</div>
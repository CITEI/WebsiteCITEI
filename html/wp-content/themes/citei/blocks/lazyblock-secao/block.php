<?php
/*
Type: LazyBlock
Name: Section
Purpose: Separates a piece of the page with full width, but displays
     content inside a container
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php
    $id = new_id();
?>
<div class="jumbotron-fluid py-4 d-flex" tabindex="-1" style="
        background-color: <?php
            $color = "";
            if(!isset($attributes['bgcolor']))
                $color = "#fff";
            else
                $color = $attributes['bgcolor'];
            echo $color, ";";
            if(isset($attributes['bgimage']['url']))
            {
                echo "\nbackground: url(",  esc_url($attributes['bgimage']['url'] ), ");",
                        "\nbackground-size: cover;",
                        "\nbackground-position: center;";
            }
        ?>
        min-height: <?php echo $attributes['min-height']; ?>px">
    <section class="container text-center text-justify my-auto" 
        role="section" tabindex="-1" 
        style="
        <?php echo 'color: ', black_or_white($color), ';';?>">
        <?php echo $attributes['blocos']; ?>
    </section>
</div>
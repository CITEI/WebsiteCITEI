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
<section class="jumbotron-fluid py-4 d-flex" tabindex="-1" style="
        background-color: <?php
            $color = "";
            if(!isset($attributes['bgcolor']))
                $color = "#fff";
            else
                $color = $attributes['bgcolor'];
            echo esc_attr($color), ";";
            if(isset($attributes['bgimage']['url']))
            {
                echo "\nbackground: url(",  esc_url($attributes['bgimage']['url'] ), ");",
                        "\nbackground-size: cover;",
                        "\nbackground-position: center;";
            }
        ?>
        min-height: <?php echo esc_attr($attributes['min-height']); ?>px">
    <div class="container text-center text-justify my-auto sr-read-children" 
        role="section" tabindex="-1" 
        style="
        <?php echo 'color: ', black_or_white($color), ';';?>">
        <?php echo $attributes['blocks']; ?>
    </div>
</section>
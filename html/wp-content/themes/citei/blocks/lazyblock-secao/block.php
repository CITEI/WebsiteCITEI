<div class="jumbotron-fluid py-4 d-flex" style="
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
                        "background-size: cover", ';';
            }
        ?>
        min-height: <?php echo $attributes['min-height']; ?>px">
    <div class="container text-center text-justify my-auto" style="
        <?php echo 'color: ', black_or_white($color), ';';?>">
        <?php echo $attributes['blocos']; ?>
    </div>
</div>
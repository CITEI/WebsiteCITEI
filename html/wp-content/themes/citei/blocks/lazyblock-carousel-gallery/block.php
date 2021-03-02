<?php 
    $id = new_id() ;
    $imgs = $attributes['imgs'];
    if (!empty($imgs))
    {
?>
        <div id="citeicarouselgallery-<?php echo $id; ?>" 
            class="carousel slide child-expand rounded
                d-flex justify-content-center" 
            data-ride="carousel"
            style="
                height: <?php echo $attributes['height'] ?>px;
                ">
            <div class="carousel-inner expanded-child" style="
                max-width: 70%;
            ">
                <?php
                    $active = "active";
                    foreach($imgs as $img)
                    { 
                ?>
                        <div class="carousel-item w-100 h-100
                            p-2
                            <?php echo $active; ?>">
                            <div class="w-100 h-100 d-flex flex-column
                                justify-content-center align-items-center">
                                <img class="rounded"
                                    src="<?php echo $img['img']['url'] ?>"
                                    alt="<?php echo $img['img']['alt'] ?>"
                                    style="
                                            max-width: 100%;
                                            max-height: 100%;
                                        " />
                            </div>
                        </div>
                <?php 
                        $active = "";
                    }
                ?>
            </div>
            <a class="carousel-control-prev" href="#citeicarouselgallery-<?php echo $id; ?>" 
                role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#citeicarouselgallery-<?php echo $id; ?>" role="button" 
                data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
<?php
    }
?>
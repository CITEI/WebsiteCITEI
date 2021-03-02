<?php
/*
Type: Template-part
Name: Social media
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<h5 class="text-uppercase">Redes sociais</h5>
<ul class="list-unstyled m-0 my-2">
    <?php
        foreach($args as $smedia)
        {
            ?>
            <li class="mt-2">
                <a href="<?php echo $smedia['url'] ?>"
                   class="text-capitalize text-reset">
                        <i class="mr-2 bi bi-<?php echo $smedia['label'] ?>"></i>
                        <span><?php echo $smedia['label'] ?></span>
                </>
            </li>
    <?php
        }
    ?>
</ul>
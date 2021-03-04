<?php
/*
Type: Template_part
Name: Social-media
Purpose: Displays social media links
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php
    $list = '';
    foreach($args as $smedia)
    {
        if ($smedia['url'] != '')
        {
            $list .= <<< EOD
                <li class="mt-2">
                    <a href="{$smedia['url']}"
                    class="text-capitalize text-reset">
                            <i class="mr-2 bi bi-{$smedia['label']}"></i>
                            <span>{$smedia['label']}</span>
                    </a>
                </li>
            EOD;
        }
    }
    if ($list != '')
    { ?>
        <h5 id="socialmedia-title" class="text-uppercase">Redes sociais</h5>
        <ul class="list-unstyled m-0 my-2">
            <?php echo $list ?>
        </ul>
<?php } ?>
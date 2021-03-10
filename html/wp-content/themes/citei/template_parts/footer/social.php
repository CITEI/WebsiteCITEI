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
        $label_attr = esc_attr($smedia['label']);
        $label_html = esc_html($smedia['label']);
        $url = esc_url($smedia['url']);
        if ('' != $smedia['url'])
        {
            $list .= <<< EOD
                <li class="mt-2">
                    <a href="{$url}"
                    class="text-capitalize text-reset">
                            <i class="mr-2 bi bi-{$label_attr}"></i>
                            <span>{$label_html}</span>
                    </a>
                </li>
            EOD;
        }
    }
    if ('' != $list)
    { ?>
        <h5 id="socialmedia-title" class="text-uppercase">
            <?php _e('Social media', 'citei') ?>
        </h5>
        <ul class="list-unstyled m-0 my-2">
            <?php echo $list ?>
        </ul>
<?php } ?>
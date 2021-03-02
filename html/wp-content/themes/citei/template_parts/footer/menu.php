<?php
/*
Type: Template-part
Name: Footer menu
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<h5 class="text-uppercase">Mapa do site</h5>
<ul class="list-unstyled m-0 my-2">
    <li class="mt-2"><a class="text-reset" href="<?php echo get_home_url() ?>">
        Início
    </a></li>
<?php
    $menu = wp_get_menu_array(get_nav_menu_locations()['primary']);
    foreach ($menu as $item)
    { ?>
        <li class="mt-2">
            <a class="text-reset" href="<?php echo $item['url'] ?>">
                <?php echo $item['title'] ?>
            </a>
        </li>
<?php } ?>
</ul>
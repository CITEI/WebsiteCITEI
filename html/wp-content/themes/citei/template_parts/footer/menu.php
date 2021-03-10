<?php
/*
Type: Template-part
Name: Footer menu
Purpose: Displays menu links as a site map layout
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<h5 id="sitemap-title" class="text-uppercase">
    <?php _e('Site map', 'citei') ?>
</h5>
<ul class="list-unstyled m-0 my-2" role="menu">
    <li class="mt-2"
        role="none"><a role="menuitem"
            class="text-reset" href="<?php echo get_home_url() ?>">
        <?php _e('Home', 'citei') ?>
    </a></li>
<?php
    $menu = wp_get_menu_array(get_nav_menu_locations()['primary']);
    foreach ($menu as $item)
    { ?>
        <li class="mt-2" role="none">
            <a role="menuitem"
                class="text-reset" href="<?php echo esc_url($item['url']) ?>">
                <?php esc_html_e($item['title'], 'citei') ?>
            </a>
        </li>
<?php } ?>
</ul>
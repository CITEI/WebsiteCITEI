<?php
/*
Type: Template_part
Name: Nav menu
Purpose: Displays main menu
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<div class="w-100 text-center px-0">
    <button class="btn rounded-pill navbar-toggler full-width py-2" type="button" data-toggle="collapse" data-target="#nav-content" 
        aria-controls="nav-content" aria-expanded="false" 
        aria-label="<?php _e('Toggle menu', 'citei') ?>">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse mx-auto" id="nav-content">
        <ul class="navbar-nav" role="menu">
            <?php
                $menu = wp_get_menu_array(get_nav_menu_locations()['primary']);
                foreach ($menu as $item)
                { ?>
                    <li class="nav-item" role="none">
                        <a class="nav-link text-nowrap" role="menuitem"
                            href="<?php echo esc_url($item['url']) ?>">
                            <?php esc_html_e($item['title'], 'citei') ?>
                        </a>
                    </li>
                <?php } ?>
        </ul>
    </div>
</div>
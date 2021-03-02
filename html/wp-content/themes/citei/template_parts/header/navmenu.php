<?php 

/* Displays main menu */ 

?>
<div class="w-100 text-center px-0">
    <button class="btn rounded-pill navbar-toggler full-width" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse mx-auto" id="nav-content">
        <ul class="navbar-nav">
            <?php
                $menu = wp_get_menu_array(get_nav_menu_locations()['primary']);
                foreach ($menu as $item)
                { ?>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="<?php echo $item['url'] ?>">
                            <?php echo $item['title'] ?>
                        </a>
                    </li>
                <?php } ?>
        </ul>
    </div>
</div>
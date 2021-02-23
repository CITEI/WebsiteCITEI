<?php 
/* Custom support */
add_theme_support( 'custom-logo' );
add_theme_support( 'post-thumbnails' );



/* Widgets */
function initialize_widgets() {
	register_sidebar( [
		'name' => 'Rodapé',
		'id'   => 'footer'
	] );
}
add_action( 'widgets_init', 'initialize_widgets' );



/* Styles */
function custom_theme_assets() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_assets' );



/* Nav menus */
function wp_get_menu_array($current_menu) {
    $array_menu = wp_get_nav_menu_items($current_menu);
    if(empty($array_menu))
        print('ok');
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID']      =   $m->ID;
            $menu[$m->ID]['title']       =   $m->title;
            $menu[$m->ID]['url']         =   $m->url;
            $menu[$m->ID]['children']    =   array();
        }
    }
    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID']       =   $m->ID;
            $submenu[$m->ID]['title']    =   $m->title;
            $submenu[$m->ID]['url']  =   $m->url;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }
    return $menu;
}

/* Registering */
register_nav_menus( [ 'primary' => __( 'Main Menu' ) ] );




/* Other */
function get_posts_by_category($cat, $posts_number=3) 
{
    $cat_id = get_cat_ID($cat);
    $args = array('category' => $cat_id,
                    'posts_per_page' => $posts_number);
    return get_posts($args);
}


function hex_to_rgb($hex)
{
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    return array('r' => $r,
                'g' => $g,
                'b' => $b);
}

function black_or_white($hex)
{
    $rgb = hex_to_rgb($hex);
    $lum = 0.299 * $rgb['r'] + 0.587 * $rgb['g'] + 0.114 * $rgb['b'];
    return $lum > 186 ? '#000' : '#fff';
}

function new_id()
{
    static $counter = 0;
    $counter++;
    return $counter;
}
?>
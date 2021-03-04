<?php
/*
Type: Functions
Purpose: Contains all functions
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php 
/* Custom support */
add_theme_support( 'custom-logo' );
add_theme_support( 'post-thumbnails' );

/* Widgets */
function initialize_widgets() {
}
add_action( 'widgets_init', 'initialize_widgets' );


/* Theme settings */
function theme_settings_page(){
        ?>
	    <div class="wrap">
	    <h1>Painel do tema - CITEI</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function add_theme_menu_item()
{
	add_menu_page("CITEI", "CITEI", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

function display_instagram_element()
{
	?>
    	<input type="text" name="instagram_url" id="instagram_url" value="<?php echo get_option('instagram_url'); ?>" />
    <?php
}

function display_facebook_element()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_youtube_element()
{
	?>
    	<input type="text" name="youtube_url" id="youtube_url" value="<?php echo get_option('youtube_url'); ?>" />
    <?php
}

function display_theme_panel_fields()
{
	add_settings_section("section", "Redes sociais", null, "theme-options");
	
	add_settings_field("twitter_url", "Perfil do Instagram", "display_instagram_element", "theme-options", "section");
    add_settings_field("facebook_url", "Perfil do Facebook", "display_facebook_element", "theme-options", "section");
    add_settings_field("youtube_url", "Canal do YouTube", "display_youtube_element", "theme-options", "section");

    register_setting("section", "instagram_url");
    register_setting("section", "facebook_url");
    register_setting("section", "youtube_url");
}

add_action("admin_menu", "add_theme_menu_item");
add_action("admin_init", "display_theme_panel_fields");


/* Styles */
function custom_theme_assets() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_assets' );


/* JS Scripts */
function myprefix_enqueue_scripts() {
    wp_enqueue_script( 'fixes', 
        get_template_directory_uri() . '/js/fixes.js', array(), true );
}
add_action( 'wp_enqueue_scripts', 'myprefix_enqueue_scripts' );


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
function new_social_media($name, $url)
{
    return array(
        'label' => $name,
        'url'   => $url
    );
}

function get_the_custom_logo_url()
{
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    return wp_get_attachment_image_src( $custom_logo_id )[0];
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
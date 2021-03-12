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
	    <h1>Theme Panel - CITEI</h1>
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
	add_settings_section("section", "Social media", null, "theme-options");
	
	add_settings_field("twitter_url", "Instagram", "display_instagram_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook", "display_facebook_element", "theme-options", "section");
    add_settings_field("youtube_url", "YouTube", "display_youtube_element", "theme-options", "section");

    register_setting("section", "instagram_url");
    register_setting("section", "facebook_url");
    register_setting("section", "youtube_url");
}

add_action("admin_menu", "add_theme_menu_item");
add_action("admin_init", "display_theme_panel_fields");


/* Styles */
function citei_theme_assets() {
	wp_enqueue_style( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css');
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'citei_theme_assets' );


/* JS Scripts */
function citei_enqueue_scripts() {
    wp_enqueue_script( 'fixes', 
        get_template_directory_uri() . '/js/fixes.js', array( 'jquery' ));
	wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
		array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'citei_enqueue_scripts' );


/* Nav menus */
function wp_get_menu_array($current_menu) {
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID']      	 =   $m->ID;
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
            $submenu[$m->ID]['url']  	 =   $m->url;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }
    return $menu;
}

/* Registering */
register_nav_menus( [ 'primary' => __( 'Main Menu', 'citei' ) ] );

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


/* Required plugins */
require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'citei_register_required_plugins' );

function citei_register_required_plugins() 
{
    $plugins = array(
        array(
            'name'      => 'ACF',
			'slug'      => 'advanced-custom-fields',
			'required'  => true,
        ),
        array(
            'name'      => 'CPT_UI',
			'slug'      => 'custom-post-type-ui',
			'required'  => true,
        ),
        array(
            'name'      => 'LazyBlocks',
			'slug'      => 'lazy-blocks',
			'required'  => true,
        ),
        array(
            'name'      => 'AccessibilityBar',
			'slug'      => 'pojo-accessibility',
			'required'  => false,
        )
    );

    $config = array(
		'id'           => 'citei',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'citei' ),
			'menu_title'                      => __( 'Install Plugins', 'citei' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'citei' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'citei' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'citei' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'citei'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'citei'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'citei'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'citei'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'citei'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'citei'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'citei'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'citei'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'citei'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'citei' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'citei' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'citei' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'citei' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'citei' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'citei' ),
			'dismiss'                         => __( 'Dismiss this notice', 'citei' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'citei' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'citei' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}


/* Translation Fixes */
function citei_translation_fixes()
{
    //Custom Post Types
    __('Products', 'citei');
    __('Product', 'citei');
    __('Research Groups', 'citei');
    __('Research Group', 'citei');
    __('Scholars', 'citei');
    __('Scholar', 'citei');
    __('Researchers', 'citei');
    __('Researcher', 'citei');
    __('Projects', 'citei');
    __('Project', 'citei');
}
add_action('setup_theme', 'citei_translation_fixes');

?>
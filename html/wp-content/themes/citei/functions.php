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
    if(empty($array_menu))
        print(__('No menu items', 'citei'));
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
            'name'      => 'BlockManager',
			'slug'      => 'block-manager',
			'required'  => true,
        ),
        array(
            'name'      => 'CPTUI',
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
			'required'  => true,
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


/* Removing blocks */
add_filter( 'gbm_disabled_blocks', function() {
   return ['core/embed', 'variation;core/embed;twitter', 'variation;core/embed;youtube', 'variation;core/embed;facebook', 'variation;core/embed;instagram', 'variation;core/embed;wordpress', 'variation;core/embed;soundcloud', 'variation;core/embed;spotify', 'variation;core/embed;flickr', 'variation;core/embed;vimeo', 'variation;core/embed;animoto', 'variation;core/embed;cloudup', 'variation;core/embed;collegehumor', 'variation;core/embed;crowdsignal', 'variation;core/embed;dailymotion', 'variation;core/embed;imgur', 'variation;core/embed;issuu', 'variation;core/embed;kickstarter', 'variation;core/embed;meetup-com', 'variation;core/embed;mixcloud', 'variation;core/embed;reddit', 'variation;core/embed;reverbnation', 'variation;core/embed;screencast', 'variation;core/embed;scribd', 'variation;core/embed;slideshare', 'variation;core/embed;smugmug', 'variation;core/embed;speaker-deck', 'variation;core/embed;tiktok', 'variation;core/embed;ted', 'variation;core/embed;tumblr', 'variation;core/embed;videopress', 'variation;core/embed;wordpress-tv', 'variation;core/embed;amazon-kindle', 'core/gallery', 'core/list', 'core/code', 'core/subhead', 'core/cover', 'core/media-text', 'core/freeform', 'core/pullquote', 'core/quote', 'core/preformatted', 'core/verse', 'core/table', 'core/tag-cloud', 'core/latest-comments', 'core/categories', 'core/archives', 'core/calendar', 'core/search', 'core/latest-posts', 'core/shortcode', 'core/social-link', 'core/social-links', 'core/rss', 'core/text-columns', 'core/nextpage', 'core/more', 'core/button', 'core/buttons'];
});

/* Custom Post Types */
function cptui_register_my_cpts() {

	/**
	 * Post Type: Products.
	 */

	$labels = [
		"name" => __( "Products", "citei" ),
		"singular_name" => __( "Product", "citei" ),
	];

	$args = [
		"label" => __( "Products", "citei" ),
		"labels" => $labels,
		"description" => __("To use this kind of post you have to write all content within \'section\' blocks."),
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "products", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-media-default",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "comments" ],
		"taxonomies" => [ "post_tag" ],
	];

	register_post_type( "products", $args );

	/**
	 * Post Type: Scholars.
	 */

	$labels = [
		"name" => __( "Scholars", "citei" ),
		"singular_name" => __( "Scholar", "citei" ),
	];

	$args = [
		"label" => __( "Scholars", "citei" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "scholars", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-admin-users",
		"supports" => [ "title", "editor", "thumbnail", "excerpt" ],
	];

	register_post_type( "scholars", $args );

	/**
	 * Post Type: Projects.
	 */

	$labels = [
		"name" => __( "Projects", "citei" ),
		"singular_name" => __( "Project", "citei" ),
	];

	$args = [
		"label" => __( "Projects", "citei" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "projects", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-search",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "comments" ],
		"taxonomies" => [ "post_tag" ],
	];

	register_post_type( "projects", $args );

	/**
	 * Post Type: Research Groups.
	 */

	$labels = [
		"name" => __( "Research Groups", "citei" ),
		"singular_name" => __( "Research Group", "citei" ),
	];

	$args = [
		"label" => __( "Research Groups", "citei" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "research_groups", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-groups",
		"supports" => [ "title", "editor", "thumbnail", "excerpt" ],
		"taxonomies" => [ "post_tag" ],
	];

	register_post_type( "research_groups", $args );

	/**
	 * Post Type: Researchers.
	 */

	$labels = [
		"name" => __( "Researchers", "citei" ),
		"singular_name" => __( "Researcher", "citei" ),
	];

	$args = [
		"label" => __( "Researchers", "citei" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "researchers", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-businessman",
		"supports" => [ "title", "editor", "thumbnail", "excerpt" ],
	];

	register_post_type( "researchers", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

/* LazyBlocks */
if ( function_exists( 'lazyblocks' ) ) :

    lazyblocks()->add_block( array(
        'id' => 503,
        'title' => 'Image carousel',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" /></svg>',
        'keywords' => array(
        ),
        'slug' => 'lazyblock/carousel-gallery',
        'description' => '',
        'category' => 'media',
        'category_label' => 'media',
        'supports' => array(
            'customClassName' => true,
            'anchor' => false,
            'align' => array(
                0 => 'wide',
                1 => 'full',
            ),
            'html' => false,
            'multiple' => true,
            'inserter' => true,
        ),
        'ghostkit' => array(
            'supports' => array(
                'spacings' => false,
                'display' => false,
                'scrollReveal' => false,
                'frame' => false,
                'customCSS' => false,
            ),
        ),
        'controls' => array(
            'control_987b504d7d' => array(
                'type' => 'number',
                'name' => 'height',
                'default' => '300',
                'label' => 'Height',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'min' => '300',
                'max' => '',
                'step' => '5',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_507baa40ca' => array(
                'type' => 'repeater',
                'name' => 'imgs',
                'default' => '',
                'label' => 'Images',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'rows_min' => '1',
                'rows_max' => '',
                'rows_label' => 'Image {{#}}',
                'rows_add_button_label' => 'Add image',
                'rows_collapsible' => 'true',
                'rows_collapsed' => 'true',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_617a8249ff' => array(
                'type' => 'image',
                'name' => 'img',
                'default' => '',
                'label' => 'Image',
                'help' => '',
                'child_of' => 'control_507baa40ca',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'true',
                'preview_size' => 'full',
                'placeholder' => '',
                'characters_limit' => '',
            ),
        ),
        'code' => array(
            'output_method' => 'template',
            'editor_html' => '',
            'editor_callback' => '',
            'editor_css' => '',
            'frontend_html' => '',
            'frontend_callback' => '',
            'frontend_css' => '',
            'show_preview' => 'always',
            'single_output' => false,
        ),
        'condition' => array(
        ),
    ) );
    
    lazyblocks()->add_block( array(
        'id' => 407,
        'title' => 'Text tabs',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 3H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H3V5h10v4h8v10z" /></svg>',
        'keywords' => array(
        ),
        'slug' => 'lazyblock/text-tabs',
        'description' => '',
        'category' => 'text',
        'category_label' => 'text',
        'supports' => array(
            'customClassName' => true,
            'anchor' => false,
            'align' => array(
                0 => 'wide',
                1 => 'full',
            ),
            'html' => false,
            'multiple' => true,
            'inserter' => true,
        ),
        'ghostkit' => array(
            'supports' => array(
                'spacings' => false,
                'display' => false,
                'scrollReveal' => false,
                'frame' => false,
                'customCSS' => false,
            ),
        ),
        'controls' => array(
            'control_d9bab24f27' => array(
                'type' => 'repeater',
                'name' => 'tabs',
                'default' => '',
                'label' => 'Tabs',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'rows_min' => '1',
                'rows_max' => '9',
                'rows_label' => 'Tab {{#}}',
                'rows_add_button_label' => 'New tab',
                'rows_collapsible' => 'true',
                'rows_collapsed' => 'true',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_698b3542ed' => array(
                'type' => 'text',
                'name' => 'text',
                'default' => '',
                'label' => 'Text',
                'help' => '',
                'child_of' => 'control_d9bab24f27',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_ab5bf64557' => array(
                'type' => 'text',
                'name' => 'label',
                'default' => '',
                'label' => 'Label',
                'help' => '',
                'child_of' => 'control_d9bab24f27',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'true',
                'placeholder' => '',
                'characters_limit' => '',
            ),
        ),
        'code' => array(
            'output_method' => 'template',
            'editor_html' => '',
            'editor_callback' => '',
            'editor_css' => '',
            'frontend_html' => '',
            'frontend_callback' => '',
            'frontend_css' => '',
            'show_preview' => 'always',
            'single_output' => false,
        ),
        'condition' => array(
        ),
    ) );
    
    lazyblocks()->add_block( array(
        'id' => 293,
        'title' => 'Profile columns',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" /></svg>',
        'keywords' => array(
        ),
        'slug' => 'lazyblock/profile-columns',
        'description' => '',
        'category' => 'media',
        'category_label' => 'media',
        'supports' => array(
            'customClassName' => true,
            'anchor' => false,
            'align' => array(
                0 => 'wide',
                1 => 'full',
            ),
            'html' => false,
            'multiple' => true,
            'inserter' => true,
        ),
        'ghostkit' => array(
            'supports' => array(
                'spacings' => false,
                'display' => false,
                'scrollReveal' => false,
                'frame' => false,
                'customCSS' => false,
            ),
        ),
        'controls' => array(
            'control_c7388b4080' => array(
                'type' => 'repeater',
                'name' => 'profiles',
                'default' => '',
                'label' => 'Profiles',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'rows_min' => '1',
                'rows_max' => '3',
                'rows_label' => 'Profile {{#}}',
                'rows_add_button_label' => 'Add profile',
                'rows_collapsible' => 'true',
                'rows_collapsed' => 'true',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_940aab4d86' => array(
                'type' => 'image',
                'name' => 'picture',
                'default' => '',
                'label' => 'Picture',
                'help' => '',
                'child_of' => 'control_c7388b4080',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'preview_size' => 'medium',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_333a894648' => array(
                'type' => 'text',
                'name' => 'title',
                'default' => '',
                'label' => 'Title',
                'help' => '',
                'child_of' => 'control_c7388b4080',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_2ccbfa438a' => array(
                'type' => 'text',
                'name' => 'description',
                'default' => '',
                'label' => 'Description',
                'help' => '',
                'child_of' => 'control_c7388b4080',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_1a580f4d44' => array(
                'type' => 'url',
                'name' => 'url',
                'default' => '',
                'label' => 'URL',
                'help' => '',
                'child_of' => 'control_c7388b4080',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
        ),
        'code' => array(
            'output_method' => 'template',
            'editor_html' => '',
            'editor_callback' => '',
            'editor_css' => '',
            'frontend_html' => '',
            'frontend_callback' => '',
            'frontend_css' => '',
            'show_preview' => 'always',
            'single_output' => false,
        ),
        'condition' => array(
        ),
    ) );
    
    lazyblocks()->add_block( array(
        'id' => 272,
        'title' => 'Products carousel',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4 18h3V5H4v13zM18 5v13h3V5h-3zM8 18h9V5H8v13z" /></svg>',
        'keywords' => array(
        ),
        'slug' => 'lazyblock/products-carousel',
        'description' => 'This block needs the &quot;Cover image&quot; field filled for the posts at the chosen category.',
        'category' => 'media',
        'category_label' => 'media',
        'supports' => array(
            'customClassName' => true,
            'anchor' => false,
            'align' => array(
                0 => 'wide',
                1 => 'full',
            ),
            'html' => false,
            'multiple' => true,
            'inserter' => true,
        ),
        'ghostkit' => array(
            'supports' => array(
                'spacings' => false,
                'display' => false,
                'scrollReveal' => false,
                'frame' => false,
                'customCSS' => false,
            ),
        ),
        'controls' => array(
            'control_7d08c640ac' => array(
                'type' => 'image',
                'name' => 'image',
                'default' => '',
                'label' => 'Imagem',
                'help' => '',
                'child_of' => 'control_1bca204906',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'preview_size' => 'medium',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_4829354af5' => array(
                'type' => 'text',
                'name' => '',
                'default' => '',
                'label' => '',
                'help' => '',
                'child_of' => 'control_1bca204906',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_9b09024a3d' => array(
                'type' => 'image',
                'name' => 'image',
                'default' => '',
                'label' => 'Imagem',
                'help' => '',
                'child_of' => 'control_9e9ab04476',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'true',
                'preview_size' => 'full',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_be98834d4e' => array(
                'type' => 'text',
                'name' => 'title',
                'default' => '',
                'label' => 'Titulo',
                'help' => '',
                'child_of' => 'control_9e9ab04476',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_2269ce4be5' => array(
                'type' => 'text',
                'name' => 'description',
                'default' => '',
                'label' => 'Descricao',
                'help' => '',
                'child_of' => 'control_9e9ab04476',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_0449684bfb' => array(
                'type' => 'text',
                'name' => 'post_type',
                'default' => '',
                'label' => 'Post type',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_987b504d7d' => array(
                'type' => 'number',
                'name' => 'min-height',
                'default' => '300',
                'label' => 'Minimum height',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'min' => '300',
                'max' => '',
                'step' => '5',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_a43a3d4fc2' => array(
                'type' => 'range',
                'name' => 'max-posts',
                'default' => '2',
                'label' => 'Max posts',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'min' => '2',
                'max' => '9',
                'step' => '1',
                'placeholder' => '',
                'characters_limit' => '',
            ),
        ),
        'code' => array(
            'output_method' => 'template',
            'editor_html' => '',
            'editor_callback' => '',
            'editor_css' => '',
            'frontend_html' => '',
            'frontend_callback' => '',
            'frontend_css' => '',
            'show_preview' => 'always',
            'single_output' => false,
        ),
        'condition' => array(
        ),
    ) );
    
    lazyblocks()->add_block( array(
        'id' => 225,
        'title' => 'Section',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M2 21h19v-3H2v3zM20 8H3c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h17c.55 0 1-.45 1-1V9c0-.55-.45-1-1-1zM2 3v3h19V3H2z" /></svg>',
        'keywords' => array(
        ),
        'slug' => 'lazyblock/secao',
        'description' => '',
        'category' => 'design',
        'category_label' => 'design',
        'supports' => array(
            'customClassName' => true,
            'anchor' => false,
            'align' => array(
                0 => 'wide',
                1 => 'full',
            ),
            'html' => false,
            'multiple' => true,
            'inserter' => true,
        ),
        'ghostkit' => array(
            'supports' => array(
                'spacings' => false,
                'display' => false,
                'scrollReveal' => false,
                'frame' => false,
                'customCSS' => false,
            ),
        ),
        'controls' => array(
            'control_559a96477e' => array(
                'type' => 'color',
                'name' => 'bgcolor',
                'default' => '#fff',
                'label' => 'Background Color',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'alpha' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_b4fbe44554' => array(
                'type' => 'image',
                'name' => 'bgimage',
                'default' => '',
                'label' => 'Background Image',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'preview_size' => 'full',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_176a824926' => array(
                'type' => 'inner_blocks',
                'name' => 'blocks',
                'default' => '',
                'label' => 'Blocks',
                'help' => '',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_6da91543d6' => array(
                'type' => 'number',
                'name' => 'min-height',
                'default' => '300',
                'label' => 'Minimum height',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'min' => '300',
                'max' => '',
                'step' => '5',
                'placeholder' => '',
                'characters_limit' => '',
            ),
        ),
        'code' => array(
            'output_method' => 'template',
            'editor_html' => '',
            'editor_callback' => '',
            'editor_css' => '',
            'frontend_html' => '',
            'frontend_callback' => '',
            'frontend_css' => '',
            'show_preview' => 'always',
            'single_output' => false,
        ),
        'condition' => array(
        ),
    ) );
    
endif;

/* Advanced Custom Fields */
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_604945a824564',
	'title' => 'Product',
	'fields' => array(
		array(
			'key' => 'field_604945abd7f25',
			'label' => 'Cover image',
			'name' => 'coverimg',
			'type' => 'image',
			'instructions' => 'A large image to visually summarize the post content.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'full',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'products',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'research_groups',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'projects',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
?>
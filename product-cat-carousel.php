<?php
/**
 * Plugin Name: Product Category Carousel for WooCommerce
 * Plugin URI: http://www.wpexpertplugins.com/woocommerce-category-carousel/
 * Description: Show Woocommerce Products Slider/Carousel.
 * Author: WpExpertPlugins
 * Text Domain: product-cat-carousel
 * Domain Path: /languages/
 * WC tested up to: 3.5.2
 * Version: 1.0.4
 * Author URI: http://www.wpexpertplugins.com/contact-us/
 *
 * @package woocc
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Basic plugin definitions
 *
 * @package woocc
 * @since 1.0.0
 */
if (!defined('WOOCC_DIR_PATH')) {
    define('WOOCC_DIR_PATH', dirname(__FILE__));      // Plugin dir
}

if (!defined('WOOCC_VERSION')) {
    define('WOOCC_VERSION', '1.0.4');      // Plugin Version
}
if (!defined('WOOCC_PLUGIN_URL')) {
    define('WOOCC_PLUGIN_URL', plugin_dir_url(__FILE__));   // Plugin url
}
if (!defined('WOOCC_INC_DIR_PATH')) {
    define('WOOCC_INC_DIR_PATH', WOOCC_DIR_PATH . '/includes');   // Plugin include dir
}
if (!defined('WOOCC_PREFIX')) {
    define('WOOCC_PREFIX', '_woocc'); // Plugin Prefix
}
if (!defined('WOOCC_VAR_PREFIX')) {
    define('WOOCC_VAR_PREFIX', '_woocc'); // Variable Prefix
}
if (!defined('WOOCC_TEXT_DOMAIN')) {
    define("WOOCC_TEXT_DOMAIN", "woocc");
}
if (!defined('WOOCC_PLUGIN_NAME')) {
    define("WOOCC_PLUGIN_NAME", "Product Category Carousel for WooCommerce");
}
if (!defined('WOOCC_SLG_BASENAME')) {
    define('WOOCC_SLG_BASENAME', basename(WOOCC_DIR_PATH));
}

/**
 * Check WooCommerce plugin is active
 *
 * @package woocc
 * @since 1.0.0
 */
function woocc_check_activation() {
    if (!class_exists('WooCommerce')) {
        // is this plugin active?
        if (is_plugin_active(plugin_basename(__FILE__))) {
            // deactivate the plugin
            deactivate_plugins(plugin_basename(__FILE__));
            // unset activation notice
            unset($_GET['activate']);
            // display notice
            add_action('admin_notices', 'woocc_admin_notices');
        }
    }
}

add_action('admin_init', 'woocc_check_activation');

/**
 * Admin notices
 *
 * @package woocc
 * @since 1.0.0
 */
function woocc_admin_notices() {
    if (!class_exists('WooCommerce')) {
        echo '<div class="error notice is-dismissible">';
        echo sprintf(esc_html__('%s recommends the following plugin to use. %s', "product-cat-carousel"), "<p><strong>" . WOOCC_PLUGIN_NAME . "</strong>", "</p>");
        echo sprintf(esc_html__('%s WooCommerce %s', "product-cat-carousel"), '<p><strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a> </strong></p>');
        echo '</div>';
    }
}

/**
 * Load the plugin after the main plugin is loaded.
 *
 * @package woocc
 * @since 1.0.0
 */
function woocc_load_plugin() {

    // Check main plugin is active or not
    if (class_exists('WooCommerce')) {

        /**
         * Load Text Domain
         *
         * This gets the plugin ready for translation.
         *
         * @package woocc
         * @since 1.0.0
         */
        function woocc_load_textdomain() {

            // Set filter for plugin's languages directory
            $woocc_slg_lang_dir = dirname(plugin_basename(__FILE__)) . '/languages/';
            $woocc_slg_lang_dir = apply_filters('woo_slg_languages_directory', $woocc_slg_lang_dir);

            // Traditional WordPress plugin locale filter
            $locale = apply_filters('plugin_locale', get_locale(), "product-cat-carousel");
            $mofile = sprintf('%1$s-%2$s.mo', "product-cat-carousel", $locale);

            // Setup paths to current locale file
            $mofile_local = $woocc_slg_lang_dir . $mofile;
            $mofile_global = WP_LANG_DIR . '/' . WOOCC_SLG_BASENAME . '/' . $mofile;

            if (file_exists($mofile_global)) { // Look in global /wp-content/languages/woo-cat-carousel folder
                load_textdomain("product-cat-carousel", $mofile_global);
            } elseif (file_exists($mofile_local)) { // Look in local /wp-content/plugins/woo-cat-carousel/languages/ folder
                load_textdomain("product-cat-carousel", $mofile_local);
            } else { // Load the default language files
                load_plugin_textdomain("product-cat-carousel", false, $woocc_slg_lang_dir);
            }
        }

        // Action to load plugin text domain
        add_action('plugins_loaded', 'woocc_load_textdomain');

        /**
         * Function add some script and style
         *
         * @package woocc
         * @since 1.0.0
         */
        function woocc_style_css() {
            if (!wp_style_is('slick-style', 'registered')) {
                wp_enqueue_style('slick-style', WOOCC_PLUGIN_URL . 'includes/assets/css/slick.css', array(), WOOCC_VERSION);
            }
            // Slick CSS
            wp_enqueue_style('woocc-public-style', WOOCC_PLUGIN_URL . 'includes/assets/css/woocc-public.css', array(), WOOCC_VERSION);

            // Registring slick slider script
            if (!wp_script_is('slick-jquery', 'registered')) {
                wp_register_script('slick-jquery', WOOCC_PLUGIN_URL . 'includes/assets/js/slick.min.js', array('jquery'), WOOCC_VERSION, true);
            }

            // Public script
            wp_register_script('woocc-public-jquery', WOOCC_PLUGIN_URL . 'includes/assets/js/public.js', array('jquery', 'slick-jquery'), WOOCC_VERSION, true);
        }

        /**
         * Function add scripts in admin side
         *
         * @package woocc
         * @since 1.0.0
         */
        function woocc_admin_scripts($hook) {
            if ($hook == "toplevel_page_woocc-settings" || $hook == "procc-shortcode-generator_page_best_selling-products-shortcode" || $hook == "procc-shortcode-generator_page_featured-products-shortcode" || $hook == "procc-shortcode-generator_page_masonry-effect-products-shortcode" || $hook == "procc-shortcode-generator_page_recently-sold-products-shortcode") {
                wp_register_script('woocc-admin-script', WOOCC_PLUGIN_URL . 'includes/assets/js/admin.js', array('jquery'), WOOCC_VERSION, true);
                $taxonomy = 'product_cat';
                $orderby = 'name';
                $show_count = 1;      // 1 for yes, 0 for no
                $pad_counts = 1;      // 1 for yes, 0 for no
                $hierarchical = 1;      // 1 for yes, 0 for no  
                $title = '';
                $empty = 1;

                $args = array(
                    'taxonomy' => $taxonomy,
                    'orderby' => $orderby,
                    'show_count' => $show_count,
                    'pad_counts' => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li' => $title,
                    'hide_empty' => $empty
                );
                $all_categories = get_categories($args);

                if (empty($all_categories)) {
                    $woocc = ["error" => esc_html__("Please Enter Some WooCoomerce Products and Categories.", "product-cat-carousel")];
                } else {
                    $woocc = ["error" => ""];
                }

                wp_localize_script("woocc-admin-script", "woocc", $woocc);
                wp_enqueue_script("woocc-admin-script");
            }
        }

        // Action to add some style and script
        add_action('wp_enqueue_scripts', 'woocc_style_css');
        add_action('admin_enqueue_scripts', 'woocc_admin_scripts');
        /**
         * Gutenberg shortcode supports
         *
         * @package woocc
         * @since 1.0.2
         */
		//Loads the file to register block
        require_once( WOOCC_DIR_PATH .'/includes/blocks/pro_cat_carousel_block/index.php' );
        require_once( WOOCC_DIR_PATH .'/includes/blocks/pcc_best_selling_products_block/index.php' );
        require_once( WOOCC_DIR_PATH .'/includes/blocks/pcc_featured_products_block/index.php' );
        
    }
}

// Action to load plugin after the main plugin is loaded
add_action('plugins_loaded', 'woocc_load_plugin', 15);

add_action("wp_loaded", "woocc_create_categories");
function woocc_create_categories(){
    $cats = array(
        array('name' => 'Accessories','description' => 'Accessories','slug' => 'accessories'),
        array('name' => 'Bags','description' => 'Bags','slug' => 'bags'),
        array('name' => 'Clothing','description' => 'Clothing','slug' => 'clothing'),
    );
    
    foreach($cats as $data) {
        $cat_data = get_term_by("slug", $data['slug'], "product_cat", ARRAY_A);
        if($cat_data && !empty($cat_data)){
            $cid = wp_insert_term(
                $data['name'], // the term 
                'product_cat', // the taxonomy
                array(
                    'description'=> $data['description'],
                    'slug' => $data['slug']
                )
            );
        }
    }
}

global $pro_cat_carousel_admin, $pro_cat_carousel_public, $pro_masonry_public, $pro_scripts;

/**
 * Public css and js file enq
 *
 * @package woocc
 * @since 1.0.1
 */
require_once(WOOCC_DIR_PATH . '/includes/pro-scripts.php');
$pro_scripts = new Pro_Scripts_Public;
$pro_scripts->add_hooks();

/**
 * Product category carousel public include
 *
 * @package woocc
 * @since 1.0.0
 */
require_once(WOOCC_DIR_PATH . '/includes/pro-cat-carousel-public.php');
$pro_cat_carousel_public = new Pro_Cat_Carousel_Public;
$pro_cat_carousel_public->add_hooks();

/**
 * Masonry public file include
 *
 * @package woocc
 * @since 1.0.1
 */
require_once(WOOCC_DIR_PATH . '/includes/pro-masonry-public.php');
$pro_masonry_public = new Pro_Masonry_Public;
$pro_masonry_public->add_hooks();

/**
 * Product category carousel admin include
 *
 * @package woocc
 * @since 1.0.0
 */
require_once(WOOCC_DIR_PATH . '/includes/admin/pro-cat-carousel-admin.php');
$pro_cat_carousel_admin = new Pro_Cat_Carousel_Admin;
$pro_cat_carousel_admin->add_hooks();
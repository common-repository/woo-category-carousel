<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Pro_Cat_Carousel_Admin {

    /**
     *  Add Top Level Menu Page
     *
     * @package woocc
     * @since 1.0.0
     */
    public function woocc_admin_menu() {
        add_menu_page(esc_html__('Category Carousel', "product-cat-carousel"), esc_html__('Procc Shortcode Generator', "product-cat-carousel"), 'manage_options', 'woocc-settings', array($this, "woocc_admin_html"));
        add_submenu_page("woocc-settings", esc_html__('Recently Sold Products', "product-cat-carousel"), esc_html__('Recently Sold Products', "product-cat-carousel"), 'manage_options', 'recently-sold-products-shortcode', array($this, "woocc_rsp_html"));
        add_submenu_page("woocc-settings", esc_html__('Best Selling Products', "product-cat-carousel"), esc_html__('Best Selling Products', "product-cat-carousel"), 'manage_options', 'best-selling-products-shortcode', array($this, "woocc_bsp_html"));
        add_submenu_page("woocc-settings", esc_html__('Featured Products', "product-cat-carousel"), esc_html__('Featured Products', "product-cat-carousel"), 'manage_options', 'featured-products-shortcode', array($this, "woocc_featured_products_html"));
        add_submenu_page("woocc-settings", esc_html__('Masonry Effect for Products', "product-cat-carousel"), esc_html__('Masonry Effect for Products', "product-cat-carousel"), 'manage_options', 'masonry-effect-products-shortcode', array($this, "woocc_masonry_effect_products_html"));

    }

    /**
     *  Add Html page for setting page
     *
     * @package woocc
     * @since 1.0.0
     */
    public function woocc_admin_html() {
        require_once(WOOCC_DIR_PATH . '/includes/admin/html/woocc-settings-html.php');
    }
    public function woocc_bsp_html(){
        require_once(WOOCC_DIR_PATH . '/includes/admin/html/woocc-bsp-html.php');
    }
    public function woocc_featured_products_html(){
        require_once(WOOCC_DIR_PATH . '/includes/admin/html/woocc-featured-products-html.php');
    }
    public function woocc_masonry_effect_products_html(){
        require_once(WOOCC_DIR_PATH . '/includes/admin/html/woocc-masonry-html.php');
    }
    public function woocc_rsp_html(){
        require_once(WOOCC_DIR_PATH . '/includes/admin/html/woocc-rsp-html.php');
    }
    /**
     * Adding Hooks
     *
     * @package woocc
     * @since 1.0.0
     */
    public function add_hooks() {
        add_action('admin_menu', array($this, "woocc_admin_menu"));
    }

}

<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Pro_Scripts_Public {
     public function enqueue_woomasonry(){
          wp_register_style("pro-masonary-css", WOOCC_PLUGIN_URL . "/includes/assets/css/masonry/masonry_layout.css", array(), WOOCC_VERSION);
          wp_enqueue_style("pro-masonary-css");

          wp_register_script("pro-masonry-isotope-js", WOOCC_PLUGIN_URL . "/includes/assets/js/masonry/isotope.pkgd.min.js", array("jquery"), WOOCC_VERSION, true);
          wp_enqueue_script("pro-masonry-isotope-js");
          wp_register_script("pro-masonry-own-js", WOOCC_PLUGIN_URL . "/includes/assets/js/masonry/pro-masonry-custom.js", array("jquery"), WOOCC_VERSION, true);
          wp_enqueue_script("pro-masonry-own-js");
     }
     public function add_hooks(){
          
          add_action('wp_enqueue_scripts', array($this, 'enqueue_woomasonry'));
     }
}
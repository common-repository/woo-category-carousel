<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Pro_Masonry_Public {
     /**
      * Masonry shortcode callback
      *
      * @package woocc
      * @since 1.0.1
      */
     public function pro_masonry_product_display($atts){
          $pro_masonry_output  = "";
          $pro_masonry_atts = shortcode_atts(array(
               'number' => 6,
               'cats' => '',
             ), $atts);
             
          if ($pro_masonry_atts['cats'] <> '') {
               $arr_cats = explode(',', $pro_masonry_atts['cats']);
               $pro_masonry_catTerms = get_terms('product_cat', array(
               'hide_empty' => 1,
               'orderby' => 'ASC',
               'include' => $arr_cats, //cat="hoodies, t-shirts"
               ));
          } else {
               $pro_masonry_catTerms = get_terms('product_cat', array(
               'hide_empty' => 1,
               'orderby' => 'ASC',
               ));
          }

          $pro_masonry_output .=  '<div id="filters" class="pro-masonry-button-group">
          <button class="button is-checked" data-filter="*">'.esc_html__('All', 'product-cat-carousel').'</button>';

     
          if ($pro_masonry_catTerms) {
               foreach ($pro_masonry_catTerms as $woo_term) {
                    $pro_masonry_output .= '<button class="button" data-filter=".' . $woo_term->slug . '">' . $woo_term->name . '</button>';
               }
          }
          $pro_masonry_output .= '</div>';

          if ($pro_masonry_catTerms <> '') {
               $pro_masonry_output .= '<div class="pro-masonry-grid">';
          
               foreach ($pro_masonry_catTerms as $woo_term) {
                    global $product;
          
                    $pro_masonry_args = array('post_type' => 'product', 'posts_per_page' => $pro_masonry_atts['number'], 'product_cat' => $woo_term->slug);
          
                    $loop = new WP_Query($pro_masonry_args);
          
                    while ($loop->have_posts()) : $loop->the_post();
                         $_product = wc_get_product(get_the_ID());
                         $pro_masonry_output .= '
                    <div class = "pro-masonry-element-item ' . $woo_term->slug . ' " data-category = "' . $woo_term->slug . '">
                    <div class="pro-masonry-products">
                         ' . woocommerce_get_product_thumbnail() . '
                         <h1><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h1>
                         <p class="pro-masonry-price">' . $_product->get_price_html() . '</p>
                         ' .
                                   apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="pro-masonry-cart button %s product_type_%s">%s</a>', esc_url($_product->add_to_cart_url()), esc_attr($_product->get_id()), esc_attr($_product->get_sku()), $_product->is_purchasable() ? 'add_to_cart_button' : '', esc_attr($_product->get_type()), esc_html($_product->add_to_cart_text())
                                        ), $_product) . '
                                   </div>
                    </div>';
                    endwhile;
               }
               $pro_masonry_output .= '</div>';
               wp_reset_query();
               
          }
          return $pro_masonry_output;
     }

     public function add_hooks(){
          /** masonry shortcode hook */
          add_shortcode('pcc_masonry_grid', array($this, 'pro_masonry_product_display'));
     }
}
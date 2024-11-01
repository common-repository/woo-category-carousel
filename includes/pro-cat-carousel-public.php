<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Pro_Cat_Carousel_Public {

    public function woocc_products_slider($atts) {
        global $woocommerce_loop;
    
        extract(shortcode_atts(array(
            'cats' => '',
            'design' => '',
            'tax' => 'product_cat',
            'limit' => '-1',
            'slide_to_show' => '3',
            'slide_to_scroll' => '3',
            'autoplay' => 'true',
            'autoplay_speed' => '3000',
            'speed' => '300',
            'arrows' => 'true',
            'dots' => 'true',
            'rtl' => '',
            'slider_cls' => 'products',
                        ), $atts));

        $unique = $this->woocc_get_unique();
        $cat = (!empty($cats)) ? explode(',', $cats) : '';
        $slider_cls = !empty($slider_cls) ? $slider_cls : 'products';
        $design = !empty($design) ? $design : '';
    
        // For RTL
        if (empty($rtl) && is_rtl()) {
            $rtl = 'true';
        } elseif ($rtl == 'true') {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
    
        // js added
        wp_enqueue_script('slick-jquery');
        wp_enqueue_script('woocc-public-jquery');
    
        // Slider configuration
        $slider_conf = compact('slide_to_show', 'slide_to_scroll', 'autoplay', 'autoplay_speed', 'speed', 'arrows', 'dots', 'rtl', 'slider_cls');
        ob_start();
        // setup query
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $limit,
        );
        // Category Parameter
        if ($cat != "") {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $tax,
                    'field' => 'id',
                    'terms' => $cat
            ));
        }
    
        // query database
        $products = new WP_Query($args);
    
        if ($products->have_posts()) {
            ?>
            <div class="woocc-product-slider-wrap wcps-<?php echo $design; ?>">
                <div class="woocommerce woocc-product-slider" id="wcpscwc-product-slider-<?php echo $unique; ?>">
                    <?php
                    woocommerce_product_loop_start();
                    while ($products->have_posts()) : $products->the_post();
                        if ($this->woocc_wc_version()) {
                            wc_get_template_part('content', 'product');
                        } else {
                            woocommerce_get_template_part('content', 'product');
                        }
                        ?>
                        <?php
                    endwhile; // end of the loop.
                    woocommerce_product_loop_end();
                    ?>
                </div>
                <div class="woocc-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            </div>
            <?php
        } else {
            echo sprintf(esc_html__("Please enter %s some products and enter some categories %s or %s Regenerate shortcode %s to display Carousel.", "product-cat-carousel"), "<b>", "</b>", "<b>", "</b>");
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

    /**
     * Function to unique number value
     * 
     * @package woocc
     * @since 1.0.0
     */
    public function woocc_get_unique() {
        static $unique = 0;
        $unique++;

        return $unique;
    }


    /**
     * Function to check woocommerce compatibility
     *
     * @package woocc
     * @since 1.0.0
     */
    public function woocc_wc_version($version = '3.0') {
        global $woocommerce;
        if (version_compare($woocommerce->version, $version, ">=")) {
            return true;
        }
        return false;
    }

    public function woocc_bestselling_products_slider($atts){

        global $woocommerce_loop;
    
        extract(shortcode_atts(array(
            'cats' 				=> '',	
            'design' 			=> '',
            'tax' 				=> 'product_cat',	
            'limit' 			=> '-1',	
            'slide_to_show' 	=> '3',
            'slide_to_scroll' 	=> '3',
            'autoplay' 			=> 'true',
            'autoplay_speed' 	=> '3000',
            'speed' 			=> '300',
            'arrows' 			=> 'true',
            'dots' 				=> 'true',
            'rtl'  				=> '',
            'slider_cls'		=> 'products',
        ), $atts));
    
        $unique = $this->woocc_get_unique();
        
        $cat 		= (!empty($cats)) ? explode(',',$cats) 	: '';
        $slider_cls = !empty($slider_cls) ? $slider_cls : 'products';
        $design 	= !empty($design) ? $design : '';
        
        // For RTL
        if( empty($rtl) && is_rtl() ) {
            $rtl = 'true';
        } elseif ( $rtl == 'true' ) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        
        // js added
        wp_enqueue_script('slick-jquery');
        wp_enqueue_script('woocc-public-jquery');
        
        // Slider configuration
        $slider_conf = compact('slide_to_show', 'slide_to_scroll', 'autoplay', 'autoplay_speed', 'speed', 'arrows','dots','rtl', 'slider_cls'); 
        
        ob_start();		
    
        // setup query
        $args = array(
            'post_type' 			=> 'product',
            'post_status' 			=> 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'		=> $limit,			
            'orderby' 		 		=> 'meta_value_num',
            'order'                 => 'DESC',
            'meta_query' => array(				
                // get only products marked as featured
                array(
                        'key' 		=> 'total_sales',
                        'value' 	=> 0,
                        'compare' 	=> '>',
                )
            )			
        );

        // Category Parameter
        if($cat != "") {			
            $args['tax_query'] = array(
                                    array( 
                                                'taxonomy' 	=> $tax,
                                                'field' 	=> 'id',
                                                'terms' 	=> $cat
                                ));

        }		
    
        // query database
        $products = new WP_Query( $args );
    
            
    
        if ( $products->have_posts() ) { ?>
            <div class="woocc-product-slider-wrap wcps-<?php echo $design; ?>">
                <div class="woocommerce woocc-product-slider" id="wcpscwc-product-slider-<?php echo $unique; ?>">
                <?php 
                woocommerce_product_loop_start(); 
    
                while ( $products->have_posts() ) : $products->the_post();
                        if($this->woocc_wc_version()){
                                wc_get_template_part( 'content', 'product' ); 
                        } else{
                            woocommerce_get_template_part( 'content', 'product' );
                        }
                endwhile; // end of the loop. 
    
                woocommerce_product_loop_end(); ?>
                </div>
                <div class="woocc-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            </div>
        <?php 
        } else {
            echo sprintf(esc_html__("Please enter %s some products and enter some categories %s or %s Regenerate shortcode %s to display Carousel.", "product-cat-carousel"), "<b>", "</b>", "<b>", "</b>");
        }
        wp_reset_postdata();	
        return ob_get_clean();
    }


    public function woocc_featured_products_slider($atts){

        global $woocommerce_loop;
    
        extract(shortcode_atts(array(
            'cats' 				=> '',
            'design' 			=> '',			
            'tax' 				=> 'product_cat',	
            'limit' 			=> '-1',	
            'slide_to_show' 	=> '3',
            'slide_to_scroll' 	=> '3',
            'autoplay' 			=> 'true',
            'autoplay_speed' 	=> '3000',
            'speed' 			=> '300',
            'arrows' 			=> 'true',
            'dots' 				=> 'true',
            'rtl'  				=> '',
            'slider_cls'		=> 'products',
        ), $atts));
    
        $unique = $this->woocc_get_unique();
        
        $cat = (!empty($cats)) ? explode(',',$cats) 	: '';
        $slider_cls = !empty($slider_cls) ? $slider_cls : 'products';
        $design = !empty($design) ? $design : '';
    
        // For RTL
        if( empty($rtl) && is_rtl() ) {
            $rtl = 'true';
        } elseif ( $rtl == 'true' ) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        
        // js added
        wp_enqueue_script('slick-jquery');
        wp_enqueue_script('woocc-public-jquery');
        
        // Slider configuration
        $slider_conf = compact('slide_to_show', 'slide_to_scroll', 'autoplay', 'autoplay_speed', 'speed', 'arrows','dots','rtl', 'slider_cls'); 		
    
        ob_start();
    
        // setup query
        if($this->woocc_wc_version()){
            $tax_query = array();
            $tax_query[] = array('relation' => 'AND');
            $tax_query[] =array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                            'operator' => 'IN',
                        );
            // Category Parameter 
            if($cat != "") {	
                        
                $tax_query[] =array( 
                                                        'taxonomy' 	=> $tax,
                                                        'field' 	=> 'id',
                                                        'terms' 	=> $cat
                                            );
            }
            
            $args = array(
                'post_type'				=> 'product',
                'post_status' 			=> 'publish',
                'ignore_sticky_posts'	=> 1,
                'posts_per_page' 		=> $limit,			
                'tax_query' 			=> $tax_query,
            );
        }
        else{
            $args = array(
                'post_type'				=> 'product',
                'post_status' 			=> 'publish',
                'ignore_sticky_posts'	=> 1,
                'posts_per_page' 		=> $limit,			
                'meta_query' 			=> array(				
                        // get only products marked as featured
                        array(
                            'key' 		=> '_featured',
                            'value' 	=> 'yes',
                            'compare' 	=> '=',
                        )
                )
            );
            // Category Parameter
            if($cat != "") {			
            $args['tax_query'] = array(
                                                array( 
                                                        'taxonomy' 	=> $tax,
                                                        'field' 	=> 'id',
                                                        'terms' 	=> $cat
                                            ));
    
            }		
        }
        
        
            
        // query database
        $products = new WP_Query( $args );	
            
        if ( $products->have_posts() ) { ?>
            <div class="woocc-product-slider-wrap wcps-<?php echo $design; ?>">
                <div class="woocommerce woocc-product-slider" id="wcpscwc-product-slider-<?php echo $unique; ?>">
                <?php 
                woocommerce_product_loop_start();  
                while ( $products->have_posts() ) : $products->the_post(); 
                        if($this->woocc_wc_version()){
                            wc_get_template_part( 'content', 'product' ); 
                        } else{
                            woocommerce_get_template_part( 'content', 'product' ); 
                        }				
                endwhile; // end of the loop.  
                woocommerce_product_loop_end(); ?>
                </div>
                <div class="woocc-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            </div>
        <?php }else {
            echo sprintf(esc_html__("Please enter %s some products and enter some categories %s or %s Regenerate shortcode %s to display Carousel.", "product-cat-carousel"), "<b>", "</b>", "<b>", "</b>");
        }
        wp_reset_postdata();
        return ob_get_clean(); 
    }

    /**
     * Function recently sold products carousel
     *
     * @package woocc
     * @since 1.0.0
     */
    public function woocc_recently_sold_products_slider($atts){

        global $woocommerce_loop;
    
        extract(shortcode_atts(array(
            'cats' 				=> '',
            'design' 			=> '',			
            'tax' 				=> 'product_cat',	
            'limit' 			=> '-1',	
            'slide_to_show' 	=> '3',
            'slide_to_scroll' 	=> '3',
            'autoplay' 			=> 'true',
            'autoplay_speed' 	=> '3000',
            'speed' 			=> '300',
            'arrows' 			=> 'true',
            'dots' 				=> 'true',
            'rtl'  				=> '',
            'slider_cls'		=> 'products',
        ), $atts));
    
        $after_date    = date( 'Y-m-d', strtotime('-7 days') );

        $recent_sold_products_orders_args = array(
            'numberposts'   => 10,
            'post_status'   => array('wc-completed', "wc-processing"),
            'date_query'    => array(
                    'after'     => $after_date,
                    'inclusive' => true
                )
        );
    
        $orders = wc_get_orders( $recent_sold_products_orders_args );
        $get_products = [];
    
        foreach ( $orders as $order ) {
            $items = $order->get_items();
            
            foreach ( $items as $item ) {
                array_push( $get_products, $item->get_product_id() );
            }
        }
    
    
        $get_products = count($get_products) ? $get_products : [0];

        $unique = $this->woocc_get_unique();
        
        $cat 		= (!empty($cats)) ? explode(',',$cats) 	: '';
        $slider_cls = !empty($slider_cls) ? $slider_cls : 'products';
        $design 	= !empty($design) ? $design : '';
        
        // For RTL
        if( empty($rtl) && is_rtl() ) {
            $rtl = 'true';
        } elseif ( $rtl == 'true' ) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        
        // js added
        wp_enqueue_script('slick-jquery');
        wp_enqueue_script('woocc-public-jquery');
        
        // Slider configuration
        $slider_conf = compact('slide_to_show', 'slide_to_scroll', 'autoplay', 'autoplay_speed', 'speed', 'arrows','dots','rtl', 'slider_cls'); 
        
        ob_start();		
    
        // setup query
        $args = array(
            'post_type' 			=> 'product',
            'post_status' 			=> 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'		=> $limit,			
            'post__in'       => $get_products,
            'orderby'        => 'post__in',		
        );

        if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'outofstock',
                    'operator' => 'NOT IN',
                ),
            ); // WPCS: slow query ok.
        }		
    
        // query database
        $products = new WP_Query( $args );
    
        if ( $products->have_posts() ) { ?>
            <div class="woocc-product-slider-wrap wcps-<?php echo $design; ?>">
                <div class="woocommerce woocc-product-slider" id="wcpscwc-product-slider-<?php echo $unique; ?>">
                <?php 
                woocommerce_product_loop_start(); 
    
                while ( $products->have_posts() ) : $products->the_post();
                        if($this->woocc_wc_version()){
                                wc_get_template_part( 'content', 'product' ); 
                        } else{
                            woocommerce_get_template_part( 'content', 'product' );
                        }
                endwhile; // end of the loop. 
    
                woocommerce_product_loop_end(); ?>
                </div>
                <div class="woocc-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            </div>
        <?php 
        } else {
            echo sprintf(esc_html__("Please enter %s some products and enter some categories %s or %s Regenerate shortcode %s to display Carousel.", "product-cat-carousel"), "<b>", "</b>", "<b>", "</b>");
        }
        wp_reset_postdata();	
        return ob_get_clean(); 
    }

    public function woocc_recently_sold_products_slider_3d($atts){

        global $woocommerce_loop;
    
        extract(shortcode_atts(array(
            'cats' 				=> '',
            'design' 			=> '',			
            'tax' 				=> 'product_cat',	
            'limit' 			=> '-1',	
            'slide_to_show' 	=> '3',
            'slide_to_scroll' 	=> '3',
            'autoplay' 			=> 'true',
            'autoplay_speed' 	=> '3000',
            'speed' 			=> '300',
            'arrows' 			=> 'true',
            'dots' 				=> 'true',
            'rtl'  				=> '',
            'slider_cls'		=> 'products',
        ), $atts));
    
        $after_date    = date( 'Y-m-d', strtotime('-7 days') );

        $recent_sold_products_orders_args = array(
            'numberposts'   => 10,
            'post_status'   => array('wc-completed', "wc-processing"),
            'date_query'    => array(
                    'after'     => $after_date,
                    'inclusive' => true
                )
        );
    
        $orders = wc_get_orders( $recent_sold_products_orders_args );
        $get_products = [];
    
        foreach ( $orders as $order ) {
            $items = $order->get_items();
            
            foreach ( $items as $item ) {
                array_push( $get_products, $item->get_product_id() );
            }
        }
    
    
        $get_products = count($get_products) ? $get_products : [0];

        $unique = $this->woocc_get_unique();
        
        $cat 		= (!empty($cats)) ? explode(',',$cats) 	: '';
        $slider_cls = !empty($slider_cls) ? $slider_cls : 'products';
        $design 	= !empty($design) ? $design : '';
        
        // For RTL
        if( empty($rtl) && is_rtl() ) {
            $rtl = 'true';
        } elseif ( $rtl == 'true' ) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        
        wp_enqueue_script('woocc-public-jquery');
        
        // Slider configuration
        $slider_conf = compact('slide_to_show', 'slide_to_scroll', 'autoplay', 'autoplay_speed', 'speed', 'arrows','dots','rtl', 'slider_cls'); 
        
        ob_start();		
    
        // setup query
        $args = array(
            'post_type' 			=> 'product',
            'post_status' 			=> 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'		=> $limit,			
            'post__in'       => $get_products,
            'orderby'        => 'post__in',		
        );

        if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'outofstock',
                    'operator' => 'NOT IN',
                ),
            ); // WPCS: slow query ok.
        }		
    
        // query database
        $products = new WP_Query( $args );
    
        if ( $products->have_posts() ) { ?>
            <div class="cascade-slider_container" id="cascade-slider">
                <div class="cascade-slider_slides">
                    <?php foreach ( $products->get_posts() as $product){ ?>
                    <div class="cascade-slider_item">
                        <a href="<?php echo get_permalink( $product->ID ); ?>">
                            <?php $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' ); 
                            if($product_image && isset($product_image[0]) && !empty(isset($product_image[0]))){
                                ?>
                                    <img src="<?php echo $product_image[0]; ?>" alt="<?php echo $product->post_title;  ?>">
                                <?php
                            }else{
                                ?>
                                    <img src="<?php echo WOOCC_PLUGIN_URL; ?>/includes/assets/images/default_product_img.png" alt="<?php echo $product->post_title;  ?>">
                                <?php
                            }
                            ?>
                            <h3><?php echo $product->post_title;  ?></h3>
                        </a>
                    </div>
                    <?php } ?>
                </div>

                <ol class="cascade-slider_nav">
                <?php $i = 0; while ( $products->have_posts() ){
                        $products->the_post(); ?>
                    <li class="cascade-slider_dot <?php echo ($i == 0)? 'cur': ''; ?>"></li>
                    <?php $i = 1;} ?>
                </ol>

                <span class="cascade-slider_arrow cascade-slider_arrow-left" data-action="prev"><img src="<?php echo WOOCC_PLUGIN_URL; ?>/includes/assets/images/previous.png" alt="prev"></span>
                <span class="cascade-slider_arrow cascade-slider_arrow-right" data-action="next"><img src="<?php echo WOOCC_PLUGIN_URL; ?>/includes/assets/images/next.png" alt="next"></span>
            </div>
        <?php 
        } else {
            echo sprintf(esc_html__("Please enter %s some products and enter some categories %s or %s Regenerate shortcode %s to display Carousel.", "product-cat-carousel"), "<b>", "</b>", "<b>", "</b>");
        }
        wp_reset_postdata();	
        return ob_get_clean(); 
    }

    public function add_hooks(){
        add_shortcode('product_catgory_carousel', array($this, 'woocc_products_slider'));
        add_shortcode( 'pcc_bestselling_products_slider', array($this, 'woocc_bestselling_products_slider') );
        add_shortcode( 'pcc_featured_products_slider', array($this, 'woocc_featured_products_slider') );
        add_shortcode( 'pcc_recently_sold_products_slider', array($this, 'woocc_recently_sold_products_slider') );
        add_shortcode( 'pcc_recently_sold_products_slider_three_d', array($this, 'woocc_recently_sold_products_slider_3d') );
    }
}




<?php


/**
 * Enqueue the block's assets for the editor.
 *
 */
function pcc_featured_products_block_editor_assets()
{	
	global $post; /* get global variables in js from php editor load time. */

	// Enqueue block editor scripts
	wp_register_script(
		'pcc-featured-products-block-js',
		WOOCC_PLUGIN_URL . '/includes/blocks/pcc_featured_products_block/pcc-featured-products-block.js',
		array('wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor'),
		filemtime(WOOCC_DIR_PATH . '/includes/blocks/pcc_featured_products_block/pcc-featured-products-block.js')
	);

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
     $cats = array();
     if (!empty($all_categories)) {
          foreach ($all_categories as $ack) {
               $cats[$ack->term_id] = $ack->name;
          }
     }
	$pcc_featured_products_block_localize = array(
		'pcc_categories' => $cats,
	);
	wp_localize_script('pcc-featured-products-block-js', 'pcc_featured_products_block_localize', $pcc_featured_products_block_localize); /** do localize js from here. */

	// Enqueue block editor styles
	wp_enqueue_style(
		'pcc-best-selling-products-block-css',
		WOOCC_PLUGIN_URL . '/includes/blocks/pcc_featured_products_block/pcc-featured-products-block.css',
		filemtime(WOOCC_DIR_PATH . '/includes/blocks/pcc_featured_products_block/pcc-featured-products-block.css')
	);

}
add_action('enqueue_block_editor_assets', 'pcc_featured_products_block_editor_assets');


/**
 * Handle Block Registering
 *
 */
function pcc_featured_products_block_register_block()
{
	if (function_exists('register_block_type')) {
          
		$args = array(
			'editor_script' => 'pcc-featured-products-block-js',
			'attributes' => array(
				'cats' => array(
					'type' => 'array', /** type must be match in js and php */
                         'default' => '',
                         'multiple' => true,
					'items' => array(
						'type' => 'string',
					)
				),
				'product_limit' => array(
                         'type' => 'string', /** type must be match in js and php */
                         'default' => '',
				),
				'slide_to_show' => array(
                         'type' => 'string', /** type must be match in js and php */
					'default' => '',
					'items' => array(
						'type' => 'string',
					)
				),
				'slide_to_scroll' => array(
                         'type' => 'string', /** type must be match in js and php */
					'default' => '',
					'items' => array(
						'type' => 'string',
					)
				),
				'autoplay' => array(
                         'type' => 'string', /** type must be match in js and php */
					'default' => '',
					'items' => array(
						'type' => 'string',
					)
				),
				'autoplay_speed' => array(
                         'type' => 'string', /** type must be match in js and php */
					'default' => '',
					'items' => array(
						'type' => 'string',
					)
				),
				'arrows' => array(
                         'type' => 'string', /** type must be match in js and php */
					'default' => '',
					'items' => array(
						'type' => 'string',
					)
				),
				'dots' => array(
                         'type' => 'string', /** type must be match in js and php */
					'default' => '',
					'items' => array(
						'type' => 'string',
					)
				),
				
			),
			/**
			 * inspector panel settings change it will call
			 * render callback from here.
			 * Pass attributes of settings from here
			 * 
			 */
			'render_callback' => 'pcc_featured_products_block_render', 
		);
    
		// register dynamic custom block
		register_block_type('wpexpertplugins/pcc-featured-products', $args);
	}

}
add_action('init', 'pcc_featured_products_block_register_block');

function pcc_featured_products_remove_blank_cats($items){
     return trim($items) != "";
}

/**
 * Handle  Block Rendering
 *
 */
function pcc_featured_products_block_render($attributes)
{	
     $attribute_string = "";
     
     if(isset($attributes["cats"]) && !empty($attributes["cats"])){

          $attributes["cats"] = array_filter($attributes["cats"], "pcc_featured_products_remove_blank_cats");
          $attribute_string .= " cats='".implode(",", $attributes["cats"])."'";
     }
     if(isset($attributes["product_limit"]) && !empty($attributes["product_limit"])){
          $attribute_string .= " product_limit='".$attributes["product_limit"]."'";
     }
     if(isset($attributes["slide_to_show"]) && !empty($attributes["slide_to_show"])){
          $attribute_string .= " slide_to_show='".$attributes["slide_to_show"]."'";
     }
     if(isset($attributes["slide_to_scroll"]) && !empty($attributes["slide_to_scroll"])){
          $attribute_string .= " slide_to_scroll='".$attributes["slide_to_scroll"]."'";
     }
     if(isset($attributes["autoplay"]) && !empty($attributes["autoplay"])){
          $attribute_string .= " autoplay='".$attributes["autoplay"]."'";
     }
     if(isset($attributes["autoplay_speed"]) && !empty($attributes["autoplay_speed"])){
          $attribute_string .= " autoplay_speed='".$attributes["autoplay_speed"]."'";
     }
     if(isset($attributes["arrows"]) && !empty($attributes["arrows"])){
          $attribute_string .= " arrows='".$attributes["arrows"]."'";
     }
     if(isset($attributes["dots"]) && !empty($attributes["dots"])){
          $attribute_string .= " dots='".$attributes["dots"]."'";
     }
	$content = "[pcc_featured_products_slider". $attribute_string ."]"; 
     return $content;
}
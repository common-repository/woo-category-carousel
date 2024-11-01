<div class="wrap">
    <h1><?php echo esc_html__("Masonry Effect for Products Shortcode Generator", "product-cat-carousel"); ?></h1>

    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="shortcode"><?php echo esc_html__("Copy Shortocde", "product-cat-carousel"); ?></label></th>
                <td><input type="text" id="shortcode" value="[pcc_masonry_grid]" readonly class="large-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="product_cats"><?php echo esc_html__("Product Categories", "product-cat-carousel"); ?></label></th>
                <td>
                    <select name="product_cats" id="product_cats" multiple>

                        <?php
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
                        if (!empty($all_categories)) {
                            foreach ($all_categories as $ack) {
                                ?>
                                <option value="<?php echo esc_html__($ack->term_id, "product-cat-carousel"); ?>"><?php echo esc_html__($ack->name, "product-cat-carousel"); ?> ( <?php echo esc_html__($ack->count); ?> )</option>   
                                <?php
                            }
                        } else {
                            echo sprintf(esc_html__("%s Please Enter Some WooCoomerce Products and Categories. %s", "product-cat-carousel"), "<option disabled>", "</option>");
                            '<option></option>';
                        }
                        ?>

                    </select>
                    <span class="description"><br><?php echo esc_html__("Select one or multiple categories. ( To select multiple: Use Command key (Mac), or Ctrl key (PC) and click. )", "product-cat-carousel"); ?></span>
                </td>
            </tr>
            

        </tbody>
    </table>
    <p class="submit">
        <input type="button" name="masonry_submit" id="masonry_submit" class="button button-primary" value="<?php echo esc_html__("Generate Shortcode", "product-cat-carousel"); ?>">
        <input type="button" name="reset" id="reset" onclick="location.reload();" class="button button-primary" value="<?php echo esc_html__("Reset To Default", "product-cat-carousel"); ?>">
    </p>

</div>
<div class="wrap">
    <h1><?php echo esc_html__("Product Category Carousel Shortcode Generator", "product-cat-carousel"); ?></h1>

    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="shortcode"><?php echo esc_html__("Copy Shortocde", "product-cat-carousel"); ?></label></th>
                <td><input type="text" id="shortcode" value="[product_catgory_carousel]" readonly class="large-text"></td>
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
            <tr>
                <th scope="row"><label for="product_limit"><?php echo esc_html__("Product Limits", "product-cat-carousel"); ?></label></th>
                <td>
                    <input name="product_limit" type="text" id="product_limit" min="1" class="small-text">
                    <span class="description"><br><?php echo esc_html__("Default blank for dispaly all products.", "product-cat-carousel"); ?></span>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="slide_to_show"><?php echo esc_html__("Slide to show", "product-cat-carousel"); ?></label></th>
                <td>
                    <select name="slide_to_show" id="slide_to_show">
                        <option value="1"><?php echo esc_html__("1", "product-cat-carousel"); ?></option>
                        <option value="2"><?php echo esc_html__("2", "product-cat-carousel"); ?></option>
                        <option value="3" selected><?php echo esc_html__("3", "product-cat-carousel"); ?></option>
                        <option value="4"><?php echo esc_html__("4", "product-cat-carousel"); ?></option>
                        <option value="5"><?php echo esc_html__("5", "product-cat-carousel"); ?></option>
                    </select>
                    <span class="description"><br><?php echo esc_html__("Slide to show display how many products slide show.", "product-cat-carousel"); ?></span>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="slide_to_scroll"><?php echo esc_html__("Slide to scroll", "product-cat-carousel"); ?></label></th>
                <td>
                    <select name="slide_to_scroll" id="slide_to_scroll">
                        <option value="1"><?php echo esc_html__("1", "product-cat-carousel"); ?></option>
                        <option value="2"><?php echo esc_html__("2", "product-cat-carousel"); ?></option>
                        <option value="3" selected><?php echo esc_html__("3", "product-cat-carousel"); ?></option>
                        <option value="4"><?php echo esc_html__("4", "product-cat-carousel"); ?></option>
                        <option value="5"><?php echo esc_html__("5", "product-cat-carousel"); ?></option>
                    </select>
                    <span class="description"><br><?php echo esc_html__("Slide to scroll how many products display per navigation aerrow click.", "product-cat-carousel"); ?></span>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="autoplay"><?php echo esc_html__("Autoplay", "product-cat-carousel"); ?></label></th>
                <td>
                    <select name="autoplay" id="autoplay">
                        <option value="true"><?php echo esc_html__("True", "product-cat-carousel"); ?></option>
                        <option value="false"><?php echo esc_html__("False", "product-cat-carousel"); ?></option>
                    </select>
                    <span class="description"><br><?php echo esc_html__("Slider will autoplay or not. Default is True.", "product-cat-carousel"); ?></span>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="autoplay_speed"><?php echo esc_html__("Autoplay Speed", "product-cat-carousel"); ?></label></th>
                <td>
                    <select name="autoplay_speed" id="autoplay_speed">
                        <option value="1000"><?php echo esc_html__("1000", "product-cat-carousel"); ?></option>
                        <option value="2000"><?php echo esc_html__("2000", "product-cat-carousel"); ?></option>
                        <option value="3000" selected><?php echo esc_html__("3000", "product-cat-carousel"); ?></option>
                        <option value="4000"><?php echo esc_html__("4000", "product-cat-carousel"); ?></option>
                        <option value="5000"><?php echo esc_html__("5000", "product-cat-carousel"); ?></option>
                        <option value="6000"><?php echo esc_html__("6000", "product-cat-carousel"); ?></option>
                        <option value="7000"><?php echo esc_html__("7000", "product-cat-carousel"); ?></option>
                        <option value="8000"><?php echo esc_html__("8000", "product-cat-carousel"); ?></option>
                        <option value="9000"><?php echo esc_html__("9000", "product-cat-carousel"); ?></option>
                        <option value="10000"><?php echo esc_html__("10000", "product-cat-carousel"); ?></option>

                    </select>
                    <span class="description"><br><?php echo esc_html__("Set Slider Autoplay Speed.", "product-cat-carousel"); ?></span>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="arrows"><?php echo esc_html__("Navigation Arrows", "product-cat-carousel"); ?></label></th>
                <td>
                    <select name="arrows" id="arrows">
                        <option value="true"><?php echo esc_html__("True", "product-cat-carousel"); ?></option>
                        <option value="false"><?php echo esc_html__("False", "product-cat-carousel"); ?></option>
                    </select>
                    <span class="description"><br><?php echo esc_html__("Display Slider Navigation Arrows. Default is True.", "product-cat-carousel"); ?></span>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="dots"><?php echo esc_html__("Pagination Dots", "product-cat-carousel"); ?></label></th>
                <td>
                    <select name="dots" id="dots">
                        <option value="true"><?php echo esc_html__("True", "product-cat-carousel"); ?></option>
                        <option value="false"><?php echo esc_html__("False", "product-cat-carousel"); ?></option>
                    </select>
                    <span class="description"><br><?php echo esc_html__("Display Slider Pagination Dots. Default is True.", "product-cat-carousel"); ?></span>
                </td>
            </tr>

        </tbody>
    </table>
    <p class="submit">
        <input type="button" name="submit" id="submit" class="button button-primary" value="<?php echo esc_html__("Generate Shortcode", "product-cat-carousel"); ?>">
        <input type="button" name="reset" id="reset" onclick="location.reload();" class="button button-primary" value="<?php echo esc_html__("Reset To Default", "product-cat-carousel"); ?>">
    </p>

</div>
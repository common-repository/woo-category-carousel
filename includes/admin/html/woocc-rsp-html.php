<div class="wrap">
    <h1><?php echo esc_html__("Recently Sold Products Shortcode Generator", "product-cat-carousel"); ?></h1>

    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="shortcode"><?php echo esc_html__("Copy Shortocde", "product-cat-carousel"); ?></label></th>
                <td><input type="text" id="shortcode" value="[pcc_recently_sold_products_slider]" readonly class="large-text"></td>
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
        <input type="button" name="rsp_submit" id="rsp_submit" class="button button-primary" value="<?php echo esc_html__("Generate Shortcode", "product-cat-carousel"); ?>">
        <input type="button" name="reset" id="reset" onclick="location.reload();" class="button button-primary" value="<?php echo esc_html__("Reset To Default", "product-cat-carousel"); ?>">
    </p>

</div>
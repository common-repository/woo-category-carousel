jQuery(document).ready(function($) {
  "use strict";
  if (woocc.error != "") {
    alert(woocc.error);
  }
  $(document).on("click", "#shortcode", function() {
    if (woocc.error != "") {
      alert(woocc.error);
      return false;
    }
    var copyText = document.getElementById("shortcode");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Shortcode Copied to clipboard");
  });
  var $attribute_string,
    $product_cats,
    $product_limit,
    $slide_to_show,
    $slide_to_scroll,
    $autoplay,
    $autoplay_speed,
    $arrows,
    $dots,
    $el;
  $(document).on("click", "#submit", function() {
    if (woocc.error != "") {
      alert(woocc.error);
      return false;
    }
    $attribute_string = "";
    $product_cats = $("#product_cats").val();
    if (!$.isEmptyObject($product_cats)) {
      $el = "";
      $.each($product_cats, function(i, j) {
        $el += j + ",";
      });
      $el = $el.replace(/,+$/, "");
      $attribute_string += ' cats="' + $el + '"';
    }

    $product_limit = $("#product_limit").val();
    if ($.trim($product_limit) != "") {
      $attribute_string += ' limit="' + $product_limit + '"';
    }
    $slide_to_show = $("#slide_to_show").val();
    if ($slide_to_show) {
      $attribute_string += ' slide_to_show="' + $slide_to_show + '"';
    }
    $slide_to_scroll = $("#slide_to_scroll").val();
    if ($slide_to_scroll) {
      $attribute_string += ' slide_to_scroll="' + $slide_to_scroll + '"';
    }
    $autoplay = $("#autoplay").val();
    if ($autoplay) {
      $attribute_string += ' autoplay="' + $autoplay + '"';
    }
    $autoplay_speed = $("#autoplay_speed").val();
    if ($autoplay_speed) {
      $attribute_string += ' autoplay_speed="' + $autoplay_speed + '"';
    }
    $arrows = $("#arrows").val();
    if ($arrows) {
      $attribute_string += ' arrows="' + $arrows + '"';
    }
    $dots = $("#dots").val();
    if ($dots) {
      $attribute_string += ' dots="' + $dots + '"';
    }
    $("#shortcode").val("[product_catgory_carousel" + $attribute_string + "]");

    var copyText = document.getElementById("shortcode");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Shortcode Copied to clipboard");
  });

  $(document).on("click", "#bsp_submit", function() {
    if (woocc.error != "") {
      alert(woocc.error);
      return false;
    }
    $attribute_string = "";
    $product_cats = $("#product_cats").val();
    if (!$.isEmptyObject($product_cats)) {
      $el = "";
      $.each($product_cats, function(i, j) {
        $el += j + ",";
      });
      $el = $el.replace(/,+$/, "");
      $attribute_string += ' cats="' + $el + '"';
    }

    $product_limit = $("#product_limit").val();
    if ($.trim($product_limit) != "") {
      $attribute_string += ' limit="' + $product_limit + '"';
    }
    $slide_to_show = $("#slide_to_show").val();
    if ($slide_to_show) {
      $attribute_string += ' slide_to_show="' + $slide_to_show + '"';
    }
    $slide_to_scroll = $("#slide_to_scroll").val();
    if ($slide_to_scroll) {
      $attribute_string += ' slide_to_scroll="' + $slide_to_scroll + '"';
    }
    $autoplay = $("#autoplay").val();
    if ($autoplay) {
      $attribute_string += ' autoplay="' + $autoplay + '"';
    }
    $autoplay_speed = $("#autoplay_speed").val();
    if ($autoplay_speed) {
      $attribute_string += ' autoplay_speed="' + $autoplay_speed + '"';
    }
    $arrows = $("#arrows").val();
    if ($arrows) {
      $attribute_string += ' arrows="' + $arrows + '"';
    }
    $dots = $("#dots").val();
    if ($dots) {
      $attribute_string += ' dots="' + $dots + '"';
    }
    $("#shortcode").val(
      "[pcc_bestselling_products_slider" + $attribute_string + "]"
    );

    var copyText = document.getElementById("shortcode");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Shortcode Copied to clipboard");
  });
  $(document).on("click", "#fp_submit", function() {
    if (woocc.error != "") {
      alert(woocc.error);
      return false;
    }
    $attribute_string = "";
    $product_cats = $("#product_cats").val();
    if (!$.isEmptyObject($product_cats)) {
      $el = "";
      $.each($product_cats, function(i, j) {
        $el += j + ",";
      });
      $el = $el.replace(/,+$/, "");
      $attribute_string += ' cats="' + $el + '"';
    }

    $product_limit = $("#product_limit").val();
    if ($.trim($product_limit) != "") {
      $attribute_string += ' limit="' + $product_limit + '"';
    }
    $slide_to_show = $("#slide_to_show").val();
    if ($slide_to_show) {
      $attribute_string += ' slide_to_show="' + $slide_to_show + '"';
    }
    $slide_to_scroll = $("#slide_to_scroll").val();
    if ($slide_to_scroll) {
      $attribute_string += ' slide_to_scroll="' + $slide_to_scroll + '"';
    }
    $autoplay = $("#autoplay").val();
    if ($autoplay) {
      $attribute_string += ' autoplay="' + $autoplay + '"';
    }
    $autoplay_speed = $("#autoplay_speed").val();
    if ($autoplay_speed) {
      $attribute_string += ' autoplay_speed="' + $autoplay_speed + '"';
    }
    $arrows = $("#arrows").val();
    if ($arrows) {
      $attribute_string += ' arrows="' + $arrows + '"';
    }
    $dots = $("#dots").val();
    if ($dots) {
      $attribute_string += ' dots="' + $dots + '"';
    }
    $("#shortcode").val(
      "[pcc_featured_products_slider" + $attribute_string + "]"
    );

    var copyText = document.getElementById("shortcode");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Shortcode Copied to clipboard");
  });
  $(document).on("click", "#masonry_submit", function() {
    if (woocc.error != "") {
      alert(woocc.error);
      return false;
    }
    $attribute_string = "";
    $product_cats = $("#product_cats").val();
    if (!$.isEmptyObject($product_cats)) {
      $el = "";
      $.each($product_cats, function(i, j) {
        $el += j + ",";
      });
      $el = $el.replace(/,+$/, "");
      $attribute_string += ' cats="' + $el + '"';
    }

    $("#shortcode").val("[pcc_masonry_grid" + $attribute_string + "]");

    var copyText = document.getElementById("shortcode");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Shortcode Copied to clipboard");
  });

  $(document).on("click", "#rsp_submit", function() {
    if (woocc.error != "") {
      alert(woocc.error);
      return false;
    }
    $attribute_string = "";
    
    $product_limit = $("#product_limit").val();
    if ($.trim($product_limit) != "") {
      $attribute_string += ' limit="' + $product_limit + '"';
    }
    $slide_to_show = $("#slide_to_show").val();
    if ($slide_to_show) {
      $attribute_string += ' slide_to_show="' + $slide_to_show + '"';
    }
    $slide_to_scroll = $("#slide_to_scroll").val();
    if ($slide_to_scroll) {
      $attribute_string += ' slide_to_scroll="' + $slide_to_scroll + '"';
    }
    $autoplay = $("#autoplay").val();
    if ($autoplay) {
      $attribute_string += ' autoplay="' + $autoplay + '"';
    }
    $autoplay_speed = $("#autoplay_speed").val();
    if ($autoplay_speed) {
      $attribute_string += ' autoplay_speed="' + $autoplay_speed + '"';
    }
    $arrows = $("#arrows").val();
    if ($arrows) {
      $attribute_string += ' arrows="' + $arrows + '"';
    }
    $dots = $("#dots").val();
    if ($dots) {
      $attribute_string += ' dots="' + $dots + '"';
    }
    $("#shortcode").val(
      "[pcc_recently_sold_products_slider" + $attribute_string + "]"
    );

    var copyText = document.getElementById("shortcode");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Shortcode Copied to clipboard");
  });
});

(function(blocks, editor, components, i18n, element) {
  var el = element.createElement;
  var registerBlockType = blocks.registerBlockType;
  var BlockControls = editor.BlockControls;
  var InspectorControls = editor.InspectorControls;
  var TextControl = components.TextControl;
  var SelectControl = components.SelectControl;
  var CheckboxControl = components.CheckboxControl;
  var ServerSideRender = components.ServerSideRender;

  // custom block icon
  const iconEl = el(
    "svg",
    { viewBox: "0 0 24 24", xmlns: "http://www.w3.org/2000/svg" },
    el("path", {
      d:
        "M8.5,21.4l1.9,0.5l5.2-19.3l-1.9-0.5L8.5,21.4z M3,19h4v-2H5V7h2V5H3V19z M17,5v2h2v10h-2v2h4V5H17z"
    })
  );
  const { __ } = i18n;

  // register dynamic custom block from js
  registerBlockType("wpexpertplugins/pro-cat-carousel", {
    title: i18n.__("Product Category Carousel Shortcode"),
    description: i18n.__("Product Category Carousel Shortcode"),
    icon: iconEl,
    category: "common",
    attributes: {
      // Necessary for saving block content.
      cats: {
        type: "array",
        default: "",
        multiple: true
      },
      product_limit: {
        type: "string",
        default: ""
      },
      slide_to_show: {
        type: "string",
        default: "3"
      },
      slide_to_scroll: {
        type: "string",
        default: "3"
      },
      autoplay: {
        type: "string",
        default: "true"
      },
      autoplay_speed: {
        type: "string",
        default: "3000"
      },
      arrows: {
        type: "string",
        default: "true"
      },
      dots: {
        type: "string",
        default: "true"
      }
    },

    edit: function(props) {
      var attributes = props.attributes;
      var cats = props.attributes.cats;
      var product_limit = props.attributes.product_limit;
      var slide_to_show = props.attributes.slide_to_show;
      var slide_to_scroll = props.attributes.slide_to_scroll;
      var autoplay = props.attributes.autoplay;
      var autoplay_speed = props.attributes.autoplay_speed;
      var arrows = props.attributes.arrows;
      var dots = props.attributes.dots;
      var localize_cats = pro_cat_carousel_block_localize.pcc_categories,
        cat_options = [];
      cat_options.push({ label: i18n.__("Select"), value: "" });
      for (category in localize_cats) {
        cat_options.push({
          label: i18n.__(localize_cats[category]),
          value: category
        });
      }

      return [
        el(
          BlockControls,
          { key: "controls" } // Display controls when the block is clicked on.
        ),
        el(
          InspectorControls,
          { key: "inspector" }, // Display the block options in the inspector panel.
          el(
            components.PanelBody,
            {
              title: i18n.__("Product category carousel shortcode settings"),
              className: "pcc-block-settings",
              initialOpen: true
            },
            // Select A Shortcode
            el(SelectControl, {
              label: i18n.__("Select categories"),
              help: i18n.__(
                "Select one or multiple categories. ( To select multiple: Use Command key (Mac), or Ctrl key (PC) and click. )"
              ),
              value: cats,
              options: cat_options,
              multiple: true,
              onChange: function(response_cats) {
                props.setAttributes({ cats: response_cats });
              }
            }),
            el(TextControl, {
              label: i18n.__("Product Limit"),
              help: i18n.__("Default blank for dispaly all products."),
              value: product_limit,
              onChange: function(response_product_limit) {
                props.setAttributes({ product_limit: response_product_limit });
              }
            }),
            el(SelectControl, {
              label: i18n.__("Slide to show"),
              help: i18n.__(
                "Slide to show display how many products slide show."
              ),
              value: slide_to_show,
              options: [
                { label: i18n.__("1"), value: "1" },
                { label: i18n.__("2"), value: "2" },
                { label: i18n.__("3"), value: "3" },
                { label: i18n.__("4"), value: "4" },
                { label: i18n.__("5"), value: "5" }
              ],
              onChange: function(response_slide_to_show) {
                props.setAttributes({ slide_to_show: response_slide_to_show });
              }
            }),
            el(SelectControl, {
              label: i18n.__("Slide to scroll"),
              help: i18n.__(
                "Slide to scroll how many products display per navigation aerrow click."
              ),
              value: slide_to_scroll,
              options: [
                { label: i18n.__("1"), value: "1" },
                { label: i18n.__("2"), value: "2" },
                { label: i18n.__("3"), value: "3" },
                { label: i18n.__("4"), value: "4" },
                { label: i18n.__("5"), value: "5" }
              ],
              onChange: function(response_slide_to_scroll) {
                props.setAttributes({
                  slide_to_scroll: response_slide_to_scroll
                });
              }
            }),
            el(SelectControl, {
              label: i18n.__("Autoplay"),
              help: i18n.__("Slider will autoplay or not. Default is True."),
              value: autoplay,
              options: [
                { label: i18n.__("True"), value: "true" },
                { label: i18n.__("False"), value: "false" }
              ],
              onChange: function(response_autoplay) {
                props.setAttributes({ autoplay: response_autoplay });
              }
            }),
            el(SelectControl, {
              label: i18n.__("Autoplay Speed"),
              help: i18n.__("Set Slider Autoplay Speed."),
              value: autoplay_speed,
              options: [
                { label: i18n.__("1000"), value: "1000" },
                { label: i18n.__("2000"), value: "2000" },
                { label: i18n.__("3000"), value: "3000" },
                { label: i18n.__("4000"), value: "4000" },
                { label: i18n.__("5000"), value: "5000" },
                { label: i18n.__("6000"), value: "6000" },
                { label: i18n.__("7000"), value: "7000" },
                { label: i18n.__("8000"), value: "8000" },
                { label: i18n.__("9000"), value: "9000" },
                { label: i18n.__("10000"), value: "10000" }
              ],
              onChange: function(response_autoplay_speed) {
                props.setAttributes({
                  autoplay_speed: response_autoplay_speed
                });
              }
            }),
            el(SelectControl, {
              label: i18n.__("Navigation Arrows"),
              help: i18n.__(
                "Display Slider Navigation Arrows. Default is True."
              ),
              value: arrows,
              options: [
                { label: i18n.__("True"), value: "true" },
                { label: i18n.__("False"), value: "false" }
              ],
              onChange: function(response_arrows) {
                props.setAttributes({ arrows: response_arrows });
              }
            }),
            el(SelectControl, {
              label: i18n.__("Pagination Dots"),
              help: i18n.__("Display Slider Pagination Dots. Default is True."),
              value: dots,
              options: [
                { label: i18n.__("True"), value: "true" },
                { label: i18n.__("False"), value: "false" }
              ],
              onChange: function(response_dots) {
                props.setAttributes({ dots: response_dots });
              }
            })
          )
        ),
        el(ServerSideRender, {
          block: "wpexpertplugins/pro-cat-carousel",
          attributes: attributes
        })
      ];
    },

    save: function(props) {
      var attributes = props.attributes;
      var cats = props.attributes.cats;
      var product_limit = props.attributes.product_limit;
      var slide_to_show = props.attributes.slide_to_show;
      var slide_to_scroll = props.attributes.slide_to_scroll;
      var autoplay = props.attributes.autoplay;
      var autoplay_speed = props.attributes.autoplay_speed;
      var arrows = props.attributes.arrows;
      var dots = props.attributes.dots;

      return null;
    }
  });
})(
  window.wp.blocks,
  window.wp.editor,
  window.wp.components,
  window.wp.i18n,
  window.wp.element
);

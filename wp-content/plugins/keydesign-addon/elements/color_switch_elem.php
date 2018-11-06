<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_color_swtich extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_color_swtich_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_color_swtich')) {
    class tek_color_swtich extends KEYDESIGN_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'kd_color_swtich_init'));
            add_shortcode('tek_color_swtich', array($this, 'kd_color_swtich_container'));
            add_shortcode('tek_color_swtich_single', array($this, 'kd_color_swtich_single'));
        }
        // Element configuration in admin
        function kd_color_swtich_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Color Switcher", "keydesign"),
                    "description" => esc_html__("Carousel color picker", "keydesign"),
                    "base" => "tek_color_swtich",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_color_swtich_single'),
                    "icon" => plugins_url('assets/element_icons/color-switcher.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "color_switch_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => __("Child Image", "keydesign"),
                    "base" => "tek_color_swtich_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_color_swtich'),
                    "icon" => plugins_url('assets/element_icons/child-image.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "attach_image",
                            "heading" => esc_html__("Upload image", "keydesign"),
                            "param_name" => "color_switch_image",
                            "admin_label" => true,
                            "description" => esc_html__("Upload new image here.", "keydesign")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Element Color", "keydesign"),
                            "param_name" => "color_switch_color",
                            "value" => "",
                            "description" => esc_html__("Choose color.", "keydesign")
                        )
                    )
                ));
            }
        }

        public function kd_color_swtich_container($atts, $content = null) {
            extract(shortcode_atts(array(
                'color_switch_class'		=> ''
            ), $atts));

			$output = '<div class="slider color-swtich '.$color_switch_class.'">'.do_shortcode($content).'</div>';

			return $output;
        }

        public function kd_color_swtich_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'color_switch_image'          => '',
                'color_switch_color'          => ''
            ), $atts));

            $image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $color_switch_image,
                'thumb_size' => 'full',
                'class' => ""
            ));

            $output = '<div class="color-swtich-content" data-color="'.$color_switch_color.'">'.$image['thumbnail'].'</div>';

			return $output;
        }
    }
}
if (class_exists('tek_color_swtich')) {
    $tek_color_swtich = new tek_color_swtich;
}
?>

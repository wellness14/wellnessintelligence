<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_testimonials extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_testimonials_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_testimonials')) {
    class tek_testimonials extends KEYDESIGN_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'kd_testimonials_init'));
            add_shortcode('tek_testimonials', array($this, 'kd_testimonials_container'));
            add_shortcode('tek_testimonials_single', array($this, 'kd_testimonials_single'));
        }
        // Element configuration in admin
        function kd_testimonials_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Testimonials", "keydesign"),
                    "description" => esc_html__("Sliding testimonials with author image.", "keydesign"),
                    "base" => "tek_testimonials",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_testimonials_single'),
                    "icon" => plugins_url('assets/element_icons/testimonials.png', dirname(__FILE__)),
                    "category" => esc_html("KeyDesign Elements", "keydesign"),
                    "params" => array(
                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Testimonials layout","keydesign"),
                            "param_name"    =>  "tt_image_layout",
                            "value"         =>  array(
                                    "With Image" => "",
                                    "Without Image" => "without-image",
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Select layout - with or without image.", "keydesign")
                        ),

                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Navigation arrows color", "keydesign"),
                            "param_name" => "tt_navigation_color",
                            "value" => array(
                                "Black" => "black-navigation",
                                "White" => "white-navigation",
                            ),
                            "save_always" => true,
                            "description" => esc_html__("Select the navigation dots color.", "keydesign"),
                         ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Enable autoplay","keydesign"),
                            "param_name"    =>  "tt_autoplay",
                            "value"         =>  array(
                                    "Off"   => "auto_off",
                                    "On"    => "auto_on"
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Carousel autoplay settings.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Autoplay speed","keydesign"),
                            "param_name"    =>  "tt_autoplay_speed",
                            "value"         =>  array(
                                    "10s"   => "10000",
                                    "9s"   => "9000",
                                    "8s"   => "8000",
                                    "7s"   => "7000",
                                    "6s"   => "6000",
                                    "5s"   => "5000",
                                    "4s"   => "4000",
                                    "3s"   => "3000",
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "tt_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Carousel autoplay speed.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Stop on hover","keydesign"),
                            "param_name"    =>  "tt_stoponhover",
                            "value"         =>  array(
                                    "Off"   => "hover_off",
                                    "On"    => "hover_on"
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "tt_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Stop sliding carousel on mouse over.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Enable touch drag","keydesign"),
                            "param_name"    =>  "tt_touchdrag",
                            "value"         =>  array(
                                    "Off"   => "touchdrag_off",
                                    "On"    => "touchdrag_on"
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Enable touch drag feature on mobile devices.", "keydesign")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "tt_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),

                    ),
                    "js_view" => 'VcColumnView'
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => esc_html__("Testimonial", "keydesign"),
                    "base" => "tek_testimonials_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_testimonials'),
                    "icon" => plugins_url('assets/element_icons/testimonials.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "heading" => esc_html__("Testimonial title", "keydesign"),
                            "param_name" => "tt_heading",
                            "description" => esc_html__("Testimonial heading title.", "keydesign")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Title color", "keydesign"),
                            "param_name" => "tt_title_color",
                            "value" => "",
                            "description" => esc_html__("Select title color. If none selected, the default theme color will be used.", "keydesign"),
                            "group" => esc_html__("Color Options", "keydesign"),
                        ),
                        array(
                            "type" => "textfield",
                            "heading" => esc_html__("Testimonial text", "keydesign"),
                            "param_name" => "tt_quote",
                            "description" => esc_html__("Testimonial author quote.", "keydesign")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Text color", "keydesign"),
                            "param_name" => "tt_quote_color",
                            "value" => "",
                            "description" => esc_html__("Select testimonial text color. If none selected, the default theme color will be used.", "keydesign"),
                            "group" => esc_html__("Color Options", "keydesign"),
                        ),
                        array(
                            "type" => "textfield",
                            "heading" => esc_html__("Author name", "keydesign"),
                            "param_name" => "tt_title",
                            "description" => esc_html__("Testimonial author name.", "keydesign")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Author name color", "keydesign"),
                            "param_name" => "author_name_color",
                            "value" => "",
                            "description" => esc_html__("Select author name text color. If none selected, the default theme color will be used.", "keydesign"),
                            "group" => esc_html__("Color Options", "keydesign"),
                        ),
                        array(
                            "type" => "textfield",
                            "heading" => esc_html__("Author job", "keydesign"),
                            "param_name" => "tt_position",
                            "description" => esc_html__("Testimonial author position in company.", "keydesign")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Author job color", "keydesign"),
                            "param_name" => "author_position_color",
                            "value" => "",
                            "description" => esc_html__("Select author job text color. If none selected, the default theme color will be used.", "keydesign"),
                            "group" => esc_html__("Color Options", "keydesign"),
                        ),
                        array(
                            "type" => "attach_image",
                            "heading" => esc_html__("Author image", "keydesign"),
                            "param_name" => "tt_image",
                            "description" => esc_html__("Display testimonial author image.", "keydesign")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "ttc_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
            }
        }

        public function kd_testimonials_container($atts, $content = null) {
            extract(shortcode_atts(array(
                'tt_image_layout'         => '',
                'tt_navigation_color'     => '',
                'tt_autoplay'             => '',
                'tt_autoplay_speed'       => '',
                'tt_stoponhover'          => '',
                'tt_touchdrag'            => '',
                'tt_extra_class'          => '',
              ), $atts));

            $output = '';

            $kd_ttunique_id = "kd-testimonial-".uniqid();

            $output .= '
            <div class="slider testimonials '.$tt_navigation_color.' '.$kd_ttunique_id.' '.$tt_extra_class . $tt_image_layout.'">'.do_shortcode($content).'</div>';

            $output .= '<script type="text/javascript">
              jQuery(document).ready(function($){
                if ($(".slider.testimonials.'.$kd_ttunique_id.'").length) {
                  $(".slider.testimonials.'.$kd_ttunique_id.'").owlCarousel({
                    navigation: true,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: true,
                    mouseDrag: true,';

                    if($tt_touchdrag == "touchdrag_on") {
                      $output .= 'touchDrag: true,';
                    } else {
                      $output .= 'touchDrag: false,';
                    }

                    if($tt_autoplay == "auto_on" && $tt_autoplay_speed !== "") {
                      $output .= 'autoPlay: '.$tt_autoplay_speed.',';
                    } else {
                      $output .= 'autoPlay: false,';
                    }

                    if($tt_autoplay == "auto_on" && $tt_stoponhover == "hover_on") {
                      $output .= 'stopOnHover: true,';
                    } else {
                      $output .= 'stopOnHover: false,';
                    }

                    $output .='
                    addClassActive: true,
                  });
                }
              });
            </script>';

            return $output;
        }

        public function kd_testimonials_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'tt_heading' => '',
                'tt_title_color' => '',
                'tt_title' => '',
                'author_name_color' => '',
                'tt_quote' => '',
                'tt_quote_color' => '',
                'tt_position' => '',
                'author_position_color' => '',
                'tt_image' => '',
                'ttc_extra_class' => '',
            ), $atts));

            $image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $tt_image,
                'thumb_size' => 'full',
                'class' => ""
            ));

            $output = '<div class="tt-content '.$ttc_extra_class.'">
              <div class="container">
                <div class="tt-container">
                <h3 '.(!empty($tt_title_color) ? 'style="color: '.$tt_title_color.';"' : '').'>'.$tt_heading.'</h3>
                <h6 '.(!empty($tt_quote_color) ? 'style="color: '.$tt_quote_color.';"' : '').'><span class="tt-quote"></span><span class="tt-quote tt-quote-right"></span>'.$tt_quote.'</h6>
                    <span class="author" '.(!empty($author_name_color) ? 'style="color: '.$author_name_color.';"' : '').'>'.$tt_title.'</span>
                    <span class="testimonial-spacing">-</span>
                    <span class="content" '.(!empty($author_position_color) ? 'style="color: '.$author_position_color.';"' : '').'>'.$tt_position.'</span>
                </div>
                <div class="tt-image">'.$image['thumbnail'].'</div>
                </div>
            </div>';
            return $output;
        }
    }
}
if (class_exists('tek_testimonials')) {
    $tek_testimonials = new tek_testimonials;
}
?>

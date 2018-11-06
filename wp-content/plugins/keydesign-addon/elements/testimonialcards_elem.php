<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_testimonialcards extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_testimonialcards_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_testimonialcards')) {
    class tek_testimonialcards extends KEYDESIGN_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'kd_testimonialcards_init'));
            add_shortcode('tek_testimonialcards', array($this, 'kd_testimonialcards_container'));
            add_shortcode('tek_testimonialcards_single', array($this, 'kd_testimonialcards_single'));
        }
        // Element configuration in admin
        function kd_testimonialcards_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Testimonial Cards", "keydesign"),
                    "description" => esc_html__("List all your client testimonials in a carousel.", "keydesign"),
                    "base" => "tek_testimonialcards",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_testimonialcards_single'),
                    "icon" => plugins_url('assets/element_icons/testimonial-cards.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Enable autoplay","keydesign"),
                            "param_name"    =>  "tcard_autoplay",
                            "value"         =>  array(
                                    "Off"   => "auto_off",
                                    "On"   => "auto_on"
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Carousel autoplay settings.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Autoplay speed","keydesign"),
                            "param_name"    =>  "tcard_autoplay_speed",
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
                                "element" => "tcard_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Carousel autoplay speed.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Stop on hover","keydesign"),
                            "param_name"    =>  "tcard_stoponhover",
                            "value"         =>  array(
                                    "Off"   => "hover_off",
                                    "On"   => "hover_on"
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "tcard_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Stop sliding carousel on mouse over.", "keydesign")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "tcard_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style a particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => esc_html__("Testimonial card", "keydesign"),
                    "base" => "tek_testimonialcards_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_testimonialcards'),
                    "icon" => plugins_url('assets/element_icons/testimonial-card.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Author name", "keydesign"),
                            "param_name" => "tcards_author_name",
                            "admin_label" => true,
                            "value" => "",
	                          "description" => esc_html__("Write the testimonial author name.", "keydesign"),
                         ),

                         array(
                             "type" => "textfield",
                             "class" => "",
                             "heading" => esc_html__("Author job", "keydesign"),
                             "param_name" => "tcards_author_job",
                             "value" => "",
			                       "description" => esc_html__("Write the testimonial author job.", "keydesign"),
                        ),

                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Author profile image", "keydesign"),
                            "param_name" => "tcards_author_image",
                            "value" => "",
                            "description" => esc_html__("Upload author profile image.", "keydesign"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Testimonial title", "keydesign"),
                            "param_name" => "tcards_testimonial_title",
                            "value" => "",
                            "description" => esc_html__("Write the testimonial title here.", "keydesign"),
                       ),

                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Testimonial text", "keydesign"),
                            "param_name" => "tcards_testimonial_text",
                            "value" => "",
                            "description" => esc_html__("Write the testimonial message here.", "keydesign")
                        ),

                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("CSS Animation", "keydesign"),
                            "param_name" => "css_animation",
                            "value" => array(
                                "No"              => "no_animation",
                                "Fade In"         => "kd-animated fadeIn",
                                "Fade In Down"    => "kd-animated fadeInDown",
                                "Fade In Left"    => "kd-animated fadeInLeft",
                                "Fade In Right"   => "kd-animated fadeInRight",
                                "Fade In Up"      => "kd-animated fadeInUp",
                                "Zoom In"         => "kd-animated zoomIn",
                            ),
                            "description" => esc_html__("Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).", "keydesign"),
                         ),

                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Animation Delay:", "keydesign"),
                            "param_name" => "elem_animation_delay",
                            "value" => array(
                                  "0s"              => "",
                                  "0.2s"            => "200",
                                  "0.4s"            => "400",
                                  "0.6s"            => "600",
                                  "0.8s"            => "800",
                                  "1s"              => "1000",
                            ),
                            "dependency" =>	array(
                                "element" => "css_animation",
                                "value" => array("kd-animated fadeIn", "kd-animated fadeInDown", "kd-animated fadeInLeft", "kd-animated fadeInRight", "kd-animated fadeInUp", "kd-animated zoomIn")
                            ),
                            "description" => esc_html__("Enter animation delay in ms", "keydesign")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "tcards_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),

                    )
                ));
            }
        }

        public function kd_testimonialcards_container($atts, $content = null) {
            extract(shortcode_atts(array(
                'tcard_extra_class'                 => '',
                'tcard_autoplay'                    => '',
                'tcard_autoplay_speed'              => '',
                'tcard_stoponhover'                 => '',
                ), $atts));

                $output = '';

                $kd_tcardsunique_id = "kd-tcards-".uniqid();

                $output .= '
                <div class="testimonial-cards tcards-parent '.$kd_tcardsunique_id.' '.$tcard_extra_class.'">
                    <div class="tcards-content">'.do_shortcode($content).'</div>
                </div>';

                $output .= '<script type="text/javascript">
          				jQuery(document).ready(function($){
                    if ($(".testimonial-cards.'.$kd_tcardsunique_id.' .tcards-content").length) {
                      $(".testimonial-cards.'.$kd_tcardsunique_id.' .tcards-content").owlCarousel({
                  	  itemsDesktop: [1199,3],
                  	  itemsTablet: [768,2],
                  	  itemsMobile: [479,1],
                        navigation: false,
                        pagination: true,';

                        if($tcard_autoplay == "auto_on" && $tcard_autoplay_speed !== "") {
                  				$output .= 'autoPlay: '.$tcard_autoplay_speed.',';
                  			} else {
                  				$output .= 'autoPlay: false,';
                        }

                        if($tcard_autoplay == "auto_on" && $tcard_stoponhover == "hover_on") {
                          $output .= 'stopOnHover: true,';
                        } else {
                  				$output .= 'stopOnHover: false,';
                        }

                        $output .='
                        addClassActive: true,
                        items: 3,
                      });
                    }
          				});
          			</script>';
                return $output;
        }

        public function kd_testimonialcards_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'tcards_author_name'		            => '',
                'tcards_author_job' 			          => '',
                'tcards_author_image'			          => '',
                'tcards_testimonial_title'			    => '',
                'tcards_testimonial_text'		        => '',
                'css_animation'                     => '',
                'elem_animation_delay'              => '',
                'tcards_extra_class'                    => '',
            ), $atts));

            $author_img = $tcards_author_img_array = $author_image = $animation_delay = '';

      			if(!empty($tcards_author_image)){
      				$tcards_author_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $tcards_author_image, 'thumb_size' => 'full', 'class' => "" ) );
              $author_image = $tcards_author_img_array['thumbnail'];
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '
                <div class="key-tcards '.$css_animation.' '.$tcards_extra_class.'" '.$animation_delay.'>
                    <div class="tcards_header">
                        <div class="tcards-image">'.$author_image.'</div>
                        <h4 class="tcards-name">'.$tcards_author_name.'</h4>
                        <p class="tcards-job">'.$tcards_author_job.'</p>
                    </div>
                    <div class="tcards_message">
                        <h5 class="tcards-title">'.$tcards_testimonial_title.'</h5>
                        <p>'.$tcards_testimonial_text.'</p>
                    </div>
                </div>';

            return $output;
        }
    }
}
if (class_exists('tek_testimonialcards')) {
    $tek_testimonialcards = new tek_testimonialcards;
}
?>

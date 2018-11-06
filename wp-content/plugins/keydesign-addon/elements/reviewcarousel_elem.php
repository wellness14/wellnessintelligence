<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_reviewcarousel extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_reviewcarousel_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_reviewcarousel')) {
    class tek_reviewcarousel extends KEYDESIGN_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'kd_reviewcarousel_init'));
            add_shortcode('tek_reviewcarousel', array($this, 'kd_reviewcarousel_container'));
            add_shortcode('tek_reviewcarousel_single', array($this, 'kd_reviewcarousel_single'));
        }
        // Element configuration in admin
        function kd_reviewcarousel_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Reviews Carousel", "keydesign"),
                    "description" => esc_html__("List all your client reviews in a carousel.", "keydesign"),
                    "base" => "tek_reviewcarousel",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_reviewcarousel_single'),
                    "icon" => plugins_url('assets/element_icons/review-carousel.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Elements per row", "keydesign"),
                            "param_name"	=>	"rwp_elements",
                            "value"			=>	array(
                                    "1 item" => "1",
                                    "2 items" => "2",
                                    "3 items" => "3",
                                    "4 items" => "4",
                                ),
                            "save_always" => true,
                            "description" => esc_html__("Amount of items displayed at a time with the widest browser width.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Enable autoplay","keydesign"),
                            "param_name"    =>  "rwp_autoplay",
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
                            "param_name"    =>  "rwp_autoplay_speed",
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
                                "element" => "rwp_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Carousel autoplay speed.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Stop on hover","keydesign"),
                            "param_name"    =>  "rwp_stoponhover",
                            "value"         =>  array(
                                    "Off"   => "hover_off",
                                    "On"   => "hover_on"
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "rwp_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Stop sliding carousel on mouse over.", "keydesign")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "rwp_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => esc_html__("Review item", "keydesign"),
                    "base" => "tek_reviewcarousel_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_reviewcarousel'),
                    "icon" => plugins_url('assets/element_icons/reviews.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Author name", "keydesign"),
                            "param_name" => "rw_author_name",
                            "admin_label" => true,
                            "value" => "",
	                          "description" => esc_html__("Write the review author name.", "keydesign"),
                         ),

                         array(
                             "type" => "colorpicker",
                             "class" => "",
                             "heading" => esc_html__("Author name text color", "keydesign"),
                             "param_name" => "rw_author_name_color",
                             "value" => "",
                             "description" => esc_html__("Choose author name text color. If none selected, the default theme color will be used.", "keydesign"),
                         ),

                         array(
                             "type" => "textfield",
                             "class" => "",
                             "heading" => esc_html__("Author description", "keydesign"),
                             "param_name" => "rw_author_desc",
                             "value" => "",
			                       "description" => esc_html__("Write the review author description.", "keydesign"),
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Author description text color", "keydesign"),
                            "param_name" => "rw_author_desc_color",
                            "value" => "",
                            "description" => esc_html__("Choose author description text color. If none selected, the default theme color will be used.", "keydesign"),
                        ),

                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Author profile image", "keydesign"),
                            "param_name" => "rw_author_image",
                            "value" => "",
                            "description" => esc_html__("Upload author profile image.", "keydesign"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Review title", "keydesign"),
                            "param_name" => "rw_review_title",
                            "value" => "",
                            "description" => esc_html__("This message will be displayed under the rating stars.", "keydesign"),
                       ),

                       array(
                           "type" => "colorpicker",
                           "class" => "",
                           "heading" => esc_html__("Review title text color", "keydesign"),
                           "param_name" => "rw_review_title_color",
                           "value" => "",
                           "description" => esc_html__("Choose review title text color. If none selected, the default theme color will be used.", "keydesign"),
                       ),

                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Review message", "keydesign"),
                            "param_name" => "rw_review_message",
                            "value" => "",
                            "description" => esc_html__("Write the review message.", "keydesign")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Review message text color", "keydesign"),
                            "param_name" => "rw_review_message_color",
                            "value" => "",
                            "description" => esc_html__("Choose review message text color. If none selected, the default theme color will be used.", "keydesign"),
                        ),

                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Link type", "keydesign"),
                             "param_name" => "rw_custom_link",
                             "value" =>	array(
                                    esc_html__( "No link", "keydesign" ) => "disable-link",
                                    esc_html__( "Add a custom link", "keydesign" )	=> "enable-link",
                                ),
                             "save_always" => true,
                             "description" => esc_html__("Enable box link from here.", "keydesign"),
                        ),

                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "keydesign"),
                             "param_name" => "rw_link_settings",
                             "value" =>	"",
                             "description" => esc_html__("The link will be added below the review message.", "keydesign"),
                             "dependency" => array(
                                "element" => "rw_custom_link",
                                "value"	=> array( "enable-link" ),
                            ),
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Show star rating","keydesign"),
                            "param_name"    =>  "rw_show_review_rating",
                            "value"         =>  array(
                                    "Show star rating"   => "show_stars",
                                    "Hide star rating"   => "hide_stars"
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Display stars rating.", "keydesign")
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Review rating","keydesign"),
                            "param_name"	=>	"rw_review_rating",
                            "value"			=>	array(
                                    "1 star"   => "one_star",
                                    "2 stars"  => "two_stars",
                                    "3 stars"  => "three_stars",
                                    "4 stars"  => "four_stars",
                                    "5 stars"  => "five_stars",
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "rw_show_review_rating",
                                "value" => array("show_stars")
                            ),
                            "description"	=>	esc_html__("Select review rating.", "keydesign")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Star color", "keydesign"),
                            "param_name" => "rw_star_color",
                            "value" => "",
                            "dependency" =>	array(
                                "element" => "rw_show_review_rating",
                                "value" => array("show_stars")
                            ),
                            "description" => esc_html__("Choose star color.", "keydesign")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Box background color", "keydesign"),
                            "param_name" => "rw_box_background",
                            "value" => "",
                            "description" => esc_html__("Choose review box background color. If none selected, the default theme color will be used.", "keydesign")
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
                            "param_name" => "rw_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),

                    )
                ));
            }
        }

        public function kd_reviewcarousel_container($atts, $content = null) {
            extract(shortcode_atts(array(
                'rwp_elements'                    => '',
                'rwp_extra_class'                 => '',
                'rwp_autoplay'                    => '',
                'rwp_autoplay_speed'              => '',
                'rwp_stoponhover'                 => '',
                ), $atts));

                $output = '';

                $kd_rwpunique_id = "kd-rwc-".uniqid();

                $output .= '
                <div class="review-carousel rc-parent '.$kd_rwpunique_id.' '.$rwp_extra_class.'">
                    <div class="rc-content">'.do_shortcode($content).'</div>
                </div>';

                $output .= '<script type="text/javascript">
          				jQuery(document).ready(function($){
                    if ($(".review-carousel.'.$kd_rwpunique_id.' .rc-content").length) {
                      $(".review-carousel.'.$kd_rwpunique_id.' .rc-content").owlCarousel({
                  	  itemsDesktop: [1199,3],
                  	  itemsTablet: [768,2],
                  	  itemsMobile: [479,1],
                        navigation: false,
                        pagination: true,';

                        if($rwp_autoplay == "auto_on" && $rwp_autoplay_speed !== "") {
                  				$output .= 'autoPlay: '.$rwp_autoplay_speed.',';
                  			} else {
                  				$output .= 'autoPlay: false,';
                        }

                        if($rwp_autoplay == "auto_on" && $rwp_stoponhover == "hover_on") {
                          $output .= 'stopOnHover: true,';
                        } else {
                  				$output .= 'stopOnHover: false,';
                        }

                        if($rwp_elements !== "") {
                          $output .= 'items: '.$rwp_elements.',';
                        }

                        $output .='
                        addClassActive: true,
                      });
                    }
          				});
          			</script>';
                return $output;
        }

        public function kd_reviewcarousel_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'rw_author_name' => '',
                'rw_author_name_color' => '',
                'rw_author_desc' => '',
                'rw_author_desc_color' => '',
                'rw_author_image' => '',
                'rw_review_title' => '',
                'rw_review_title_color' => '',
                'rw_review_message' => '',
                'rw_review_message_color' => '',
                'rw_custom_link' => '',
                'rw_link_settings' => '',
                'rw_review_rating' => '',
                'rw_star_color' => '',
                'rw_box_background' => '',
                'rw_show_review_rating' => '',
                'css_animation' => '',
                'elem_animation_delay' => '',
                'rw_extra_class' => '',
            ), $atts));

            $author_img = $full_star = $empty_star = $rating_stars = $rw_author_img_array = $author_image = $animation_delay = '';

            $full_star = '<span class="fa fa-star" '.(!empty($rw_star_color) ? 'style="color: '.$rw_star_color.';"' : '').'></span>';
            $empty_star = '<span class="fa fa-star-o" '.(!empty($rw_star_color) ? 'style="color: '.$rw_star_color.';"' : '').'></span>';

            switch($rw_review_rating){
      				case 'one_star':
      					$rating_stars = $full_star.str_repeat($empty_star, 4);
      				break;

                      case 'two_stars':
      					$rating_stars = str_repeat($full_star, 2).str_repeat($empty_star, 3);
      				break;

                      case 'three_stars':
      					$rating_stars = str_repeat($full_star, 3).str_repeat($empty_star, 2);
      				break;

                      case 'four_stars':
      					$rating_stars = str_repeat($full_star, 4).$empty_star;
      				break;

                      case 'five_stars':
      					$rating_stars = str_repeat($full_star, 5);
      				break;

      				default:
      			}

      			if(!empty($rw_author_image)){
      				$rw_author_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $rw_author_image, 'thumb_size' => 'full', 'class' => "" ) );
                      $author_image = $rw_author_img_array['thumbnail'];
      			}

            /* Link settings */
            if ($rw_custom_link  == 'enable-link') {
              $href = vc_build_link($rw_link_settings);
              if ($href['target'] == "") { $href['target'] = "_self"; }

        			if($href['url'] !== '') {
        				$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : 'target="_self"';
        				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
        			}
            }

            /* CSS Animation */
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            /* Animation delay */
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '
                <div class="key-reviews '.$css_animation.' '.$rw_extra_class.'" '.(!empty($rw_box_background) ? 'style="background-color: '.$rw_box_background.';"' : '').' '.$animation_delay.'>
                    <div class="rw_header">
                        <div class="rw-authorimg">'.$author_image.'</div>
                        <div class="rw-author-details">
                            <h4 '.(!empty($rw_author_name_color) ? 'style="color: '.$rw_author_name_color.';"' : '').'>'.$rw_author_name.'</h4>
                            <p '.(!empty($rw_author_desc_color) ? 'style="color: '.$rw_author_desc_color.';"' : '').'>'.$rw_author_desc.'</p>
                        </div>
                    </div>
                    <div class="rw_message" '.(!empty($rw_review_message_color) ? 'style="color: '.$rw_review_message_color.';"' : '').'>'.$rw_review_message;
                    if ($rw_custom_link == "enable-link" && $href['title'] != '') {
                      $output .= '<div class="rw-link"><a href="'.$href['url'].'"'.$link_target.''.$link_title.'>'.$href['title'].'</a></div>';
                    }
                    $output .= '</div>';
                    if ( $rw_show_review_rating !== "hide_stars" ) {
                      $output .= '<div class="rw_rating">
                         '.$rating_stars.'
                         <p class="rw-title" '.(!empty($rw_review_title_color) ? 'style="color: '.$rw_review_title_color.';"' : '').'>'.$rw_review_title.'</p>
                      </div>';
                    }
                $output .= '</div>';

            return $output;
        }
    }
}
if (class_exists('tek_reviewcarousel')) {
    $tek_reviewcarousel = new tek_reviewcarousel;
}
?>

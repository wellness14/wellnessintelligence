<?php

if (!class_exists('KD_ELEM_COUNTER')) {

    class KD_ELEM_COUNTER extends KEYDESIGN_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'kd_counter_init'));
            add_shortcode('tek_counter', array($this, 'kd_counter_shrt'));
        }

        // Element configuration in admin

        function kd_counter_init() {

            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Counter", "keydesign"),
                    "description" => esc_html__("Animated counter.", "keydesign"),
                    "base" => "tek_counter",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/counter.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "params" => array(

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Display icon","keydesign"),
                            "param_name"	=>	"count_icon_type",
                            "value"			=>	array(
                                    "No" => "no_icon",
                                    "Icon Browser" => "icon_browser",
                                    "Custom Icon" => "custom_icon",
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select icon source.", "keydesign")
                        ),

                        array(
                    				"type" => "dropdown",
                    				"heading" => esc_html__( "Icon library", "keydesign" ),
                    				"value" => array(
                      					esc_html__( "Font Awesome", "keydesign" ) => "fontawesome",
                      					esc_html__( "Linecons", "keydesign" ) => "linecons",
                      					esc_html__( "Mono Social", "keydesign" ) => "monosocial",
                    				),
                    				"param_name" => "count_icon_library",
                            "dependency" =>	array(
                                "element" => "count_icon_type",
                                "value" => array("icon_browser")
                            ),
                    				"description" => esc_html__( "Select icon library.", "keydesign" ),
          			        ),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "keydesign" ),
                      				"param_name" => "icon_fontawesome",
                      				"settings" => array(
                  					     "emptyIcon" => false,
                  					     "iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                      					"element" => "count_icon_library",
                      					"value" => "fontawesome",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "keydesign" ),
                  			),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "keydesign" ),
                      				"param_name" => "icon_linecons",
                      				"settings" => array(
                          					"emptyIcon" => false,
                          					"type" => "linecons",
                          					"iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                          					"element" => "count_icon_library",
                          					"value" => "linecons",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "keydesign" ),
                  			),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "keydesign" ),
                      				"param_name" => "icon_monosocial",
                      				"settings" => array(
                          					"emptyIcon" => false,
                          					"type" => "monosocial",
                          					"iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                          					"element" => "count_icon_library",
                          					"value" => "monosocial",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "keydesign" ),
                  			),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Icon color", "keydesign"),
                            "param_name" => "count_icon_color",
                            "value" => "",
                            "dependency" =>	array(
                                "element" => "count_icon_type",
                                "value" => array("icon_browser")
                            ),
                            "description" => esc_html__("Choose counter description color. If none selected, the default theme color will be used.", "keydesign"),
                        ),

                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload image icon", "keydesign"),
                            "param_name" => "count_image",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "keydesign"),
                            "dependency" => array(
                                "element" => "count_icon_type",
                                "value" => array("custom_icon"),
                            ),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Counter Size", "keydesign"),
                            "param_name"	=>	"count_size",
                            "value"			=>	array(
                                    "Normal"			=>	"normal-counter",
                                    "Large"			=>	"large-counter",
                                ),
                            "description"	=>	esc_html__("Select counter size","keydesign"),
                            "save_always" 	=>	true,
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Counter number", "keydesign"),
                            "param_name" => "count_number",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Only numerical values allowed.", "keydesign")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Counter number color", "keydesign"),
                            "param_name" => "count_number_color",
                            "value" => "",
                            "description" => esc_html__("Choose counter number color. If none selected, the default theme color will be used.", "keydesign"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Counter units", "keydesign"),
                            "param_name" => "count_units",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Ex: coffees, projects, clients.", "keydesign")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Counter units color", "keydesign"),
                            "param_name" => "count_units_color",
                            "value" => "",
                            "description" => esc_html__("Choose counter units color. If none selected, the default theme color will be used.", "keydesign"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Counter description", "keydesign"),
                            "param_name" => "count_description",
                            "value" => "",
                            "description" => esc_html__("This additional text will be displayed near the counter.", "keydesign")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Counter description color", "keydesign"),
                            "param_name" => "count_description_color",
                            "value" => "",
                            "description" => esc_html__("Choose counter description color. If none selected, the default theme color will be used.", "keydesign"),
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
                           "param_name" => "count_extra_class",
                           "value" => "",
                           "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                       ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function kd_counter_shrt($atts, $content = null)
        {

            // Include required JS files
    		wp_enqueue_script('kd_jquery_appear');
    		wp_enqueue_script('kd_countto');

            // Declare empty vars
            $output = $content_icon = $counter_id = $kd_counter_img_array = $js = $animation_delay = '';

            extract(shortcode_atts(array(
                'count_icon_type'                   => '',
                'count_icon_library'                => '',
                'icon_fontawesome' 			            => '',
                'icon_linecons' 			              => '',
                'icon_monosocial' 			            => '',
                'count_icon_color'                  => '',
                'count_image'                       => '',
                'count_size'          			        => '',
                'count_number'                      => '',
                'count_number_color'                => '',
                'count_units'                       => '',
                'count_units_color'                 => '',
                'count_description'                 => '',
                'count_description_color'           => '',
                'css_animation'                     => '',
                'elem_animation_delay'              => '',
                'count_extra_class'                 => '',
            ), $atts));

            // Enqueue needed icon font.
            vc_icon_element_fonts_enqueue( $count_icon_library );

            if (strlen($icon_fontawesome) > 0) {
                $count_icon = $icon_fontawesome;
            } elseif (strlen($icon_linecons) > 0) {
                $count_icon = $icon_linecons;
            } elseif (strlen($icon_monosocial) > 0) {
                $count_icon = $icon_monosocial;
            }

            $counter_id .= 'kd-counterelem-'.uniqid();
            $js = '<script type="text/javascript">
            				jQuery(document).ready(function() {
            					jQuery(function($) {
            						$(".'.$counter_id.'").appear(function() {
            							$(this).countTo();
            						});
            					});
            				});
            			</script>';

        		$output .= $js;

            if( $count_icon_type == 'icon_browser' && !empty($count_icon) ) {
      				$content_icon = '<div class="kd-counter-icon"><i class="'.$count_icon.' fa"></i></div>';
      			}	elseif($count_icon_type == 'custom_icon' && !empty($count_image)){
      				$kd_counter_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $count_image, 'thumb_size' => 'full', 'class' => "" ) );
      				$content_icon = '<div class="kd-counter-customimg">'.$kd_counter_img_array['thumbnail'].'</div>';
    			  }

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            switch($count_size){

      				case 'large-counter':
      					$output .= '<div class="kd_counter '. $count_size . (!empty($count_extra_class) ? $count_extra_class : '').' '.$css_animation.'" '.$animation_delay.'>';
      						$output .= '<div class="kd_counter_content">';
      							$output .= '<h4 class="kd_counter_number">';
      							$output .= '<span class="kd_number_string '.$counter_id.'" '.(!empty($count_number_color) ? 'style="color: '.$count_number_color.';"' : '').' data-from="0" data-to="'.$count_number.'" data-refresh-interval="50">0</span>
                                  <span class="kd_counter_units" '.(!empty($count_units_color) ? 'style="color: '.$count_units_color.';"' : '').'>'.$count_units.'</span>';
      							$output .= '</h4>';
      							$output .= '<div class="kd_counter_text" '.(!empty($count_description_color) ? 'style="color: '.$count_description_color.';"' : '').'>'.$count_description.'</div>';
      						$output .= '</div>';
      						if(!empty($content_icon)) {
      							$output .= '<div class="kd_counter_icon">';
      							$output .= $content_icon;
      							$output .= '</div>';
      						}
      					$output .= '</div>';
      				break;

      				case 'normal-counter':
      					$output .= '<div class="kd_counter '.(!empty($count_extra_class) ? $count_extra_class : '').' '.$css_animation.'" '.$animation_delay.'>';
      						$output .= '<div class="kd_counter_content">';
      								if(!empty($content_icon)) {
      								$output .= '<div class="kd_counter_icon">';
      								$output .= $content_icon;
      								$output .= '</div>';
      								}
      							$output .= '<h4 class="kd_counter_number">';
      							$output .= '<span class="kd_number_string '.$counter_id.'" '.(!empty($count_number_color) ? 'style="color: '.$count_number_color.';"' : '').' data-from="0" data-to="'.$count_number.'" data-refresh-interval="50">0</span>
                                  <span class="kd_counter_units" '.(!empty($count_units_color) ? 'style="color: '.$count_units_color.';"' : '').'>'.$count_units.'</span>';
      							$output .= '</h4>';
      							$output .= '<div class="kd_counter_text" '.(!empty($count_description_color) ? 'style="color: '.$count_description_color.';"' : '').'>'.$count_description.'</div>';
      						$output .= '</div>';
      					$output .= '</div>';
      				break;
	         }

            return $output;

        }
    }
}

if (class_exists('KD_ELEM_COUNTER')) {
    $KD_ELEM_COUNTER = new KD_ELEM_COUNTER;
}

?>

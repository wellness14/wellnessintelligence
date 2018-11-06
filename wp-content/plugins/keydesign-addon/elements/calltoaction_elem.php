<?php

if (!class_exists('KD_ELEM_CALL_TO_ACTION')) {

    class KD_ELEM_CALL_TO_ACTION extends KEYDESIGN_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'kd_calltoaction_init'));
            add_shortcode('tek_calltoaction', array($this, 'kd_calltoaction_shrt'));
        }

        // Element configuration in admin

        function kd_calltoaction_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Call to Action Box", "keydesign"),
                    "description" => esc_html__("Call to action section with button.", "keydesign"),
                    "base" => "tek_calltoaction",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/calltoaction-box.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "params" => array(
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Display icon","keydesign"),
                            "param_name"	=>	"cta_icon_type",
                            "value"			=>	array(
                                    "No" => "no_icon",
                                    "Icon Browser" => "icon_browser",
                                    "Custom Icon" => "custom_image",
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
                    				"param_name" => "icon_library",
                            "dependency" =>	array(
                                "element" => "cta_icon_type",
                                "value" => array("icon_browser")
                            ),
                    				"description" => esc_html__( "Select icon library.", "keydesign" ),
                  			),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "keydesign" ),
                      				"param_name" => "icon_fontawesome",
                      				"settings" => array(
                  					     "iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                      					"element" => "icon_library",
                      					"value" => "fontawesome",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "keydesign" ),
                  			),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "keydesign" ),
                      				"param_name" => "icon_linecons",
                      				"settings" => array(
                          					"type" => "linecons",
                          					"iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                          					"element" => "icon_library",
                          					"value" => "linecons",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "keydesign" ),
                  			),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "keydesign" ),
                      				"param_name" => "icon_monosocial",
                      				"settings" => array(
                          					"type" => "monosocial",
                          					"iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                          					"element" => "icon_library",
                          					"value" => "monosocial",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "keydesign" ),
                  			),
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload custom image", "keydesign"),
                            "param_name" => "cta_image",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "keydesign"),
                            "dependency" => array(
                                "element" => "cta_icon_type",
                                "value" => array("custom_image"),
                            ),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Call to action title", "keydesign"),
                            "param_name" => "cta_title",
                            "value" => "",
                            "description" => esc_html__("Enter call to action title here.", "keydesign")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Call to action subtitle", "keydesign"),
                            "param_name" => "cta_subtitle",
                            "value" => "",
                            "description" => esc_html__("This text will be displayed under the title.", "keydesign")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Text color", "keydesign"),
                            "param_name" => "cta_text_color",
                            "value" => "",
                            "description" => esc_html__("Choose text color.", "keydesign")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Box color", "keydesign"),
                            "param_name" => "cta_box_color",
                            "value" => "",
                            "description" => esc_html__("Choose box color.", "keydesign")
                        ),
                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Button link", "keydesign"),
                             "param_name" => "cta_button_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "keydesign"),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button text", "keydesign"),
                            "param_name" => "cta_button_text",
                            "value" => "",
                            "description" => esc_html__("Write the text displayed on the button.", "keydesign")
                        ),
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Button style","keydesign"),
                            "param_name"	=>	"cta_button_style",
                            "value"			=>	array(
                                    "Primary color" => "tt_primary_button",
                                    "Secondary color" => "tt_secondary_button"
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select button color style.", "keydesign")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "cta_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function kd_calltoaction_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'cta_icon_type'             => '',
                'icon_library'              => '',
                'icon_fontawesome' 			    => '',
                'icon_linecons' 			      => '',
                'icon_monosocial' 			    => '',
                'cta_image'                 => '',
                'cta_title'                 => '',
                'cta_subtitle'              => '',
                'cta_text_color'            => '',
                'cta_box_color'             => '',
                'cta_button_link'           => '',
                'cta_button_text'           => '',
                'cta_button_style'          => '',
                'cta_extra_class'           => '',
            ), $atts));

            $content_icon = $cta_img_array = $href = $link_target = $link_title = '';

            // Enqueue needed icon font.
            vc_icon_element_fonts_enqueue( $icon_library );

            if (strlen($icon_fontawesome) > 0) {
                $cta_icon = $icon_fontawesome;
            } elseif (strlen($icon_linecons) > 0) {
                $cta_icon = $icon_linecons;
            } elseif (strlen($icon_monosocial) > 0) {
                $cta_icon = $icon_monosocial;
            }

            if( $cta_icon_type == 'icon_browser' && !empty($cta_icon) ) {
		            $content_icon = '<i class="'.$cta_icon.' fa" style="color:'.$cta_text_color.';"></i> ';
			      }
      			elseif($cta_icon_type == 'custom_image' && !empty($cta_image)){
        				$cta_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $cta_image, 'thumb_size' => 'full', 'class' => "" ) );
        				$content_icon = $cta_img_array['thumbnail'];
      			}

            $href = vc_build_link($cta_button_link);
      			if($href['url'] !== '') {
                $link_target = (trim($href['target']) !== '') ? ' target="' . trim($href['target']) . '"' : 'target="_self"';
        				$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
      			}

            $output = '<div class="kd-calltoaction '.$cta_icon_type.' '.$cta_extra_class.'" style="background-color: '.$cta_box_color.';">
                <div class="container">';
                if ($cta_icon_type != "no_icon") {
                    $output .= '<div class="cta-icon">'.$content_icon.'</div>';
                }
                    $output .= '<div class="cta-text" style="color:'.$cta_text_color.';">
                        <h4>'.$cta_title.'</h4>
                        <p>'.$cta_subtitle.'</p>
                    </div>
                    <div class="cta-btncontainer">
                        <a href="'.$href['url'].'"'.$link_target.''.$link_title.' class="tt_button '.$cta_button_style.' kd-animated zoomIn" data-animation-delay="200">'.$cta_button_text.'</a>
                    </div>
                </div>
            </div>';

            return $output;

        }
    }
}

if (class_exists('KD_ELEM_CALL_TO_ACTION')) {
    $KD_ELEM_CALL_TO_ACTION = new KD_ELEM_CALL_TO_ACTION;
}

?>

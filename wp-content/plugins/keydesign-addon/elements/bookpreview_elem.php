<?php

if (!class_exists('KD_ELEM_BOOK_PREVIEW')) {

    class KD_ELEM_BOOK_PREVIEW extends KEYDESIGN_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'kd_bookpreview_init'));
            add_shortcode('tek_bookpreview', array($this, 'kd_bookpreview_shrt'));
        }

        // Element configuration in admin

        function kd_bookpreview_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Book Preview", "keydesign"),
                    "description" => esc_html__("Book chapter preview in a device mockup.", "keydesign"),
                    "base" => "tek_bookpreview",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/book-preview.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "params" => array(
                        array(
                            "type" =>	"dropdown",
                            "class" =>	"",
                            "heading" =>	esc_html__("Enable content scrolling", "keydesign"),
                            "param_name" =>	"bp_scroll",
                            "value"	 =>	array(
                                    "On" => "scroll-on",
                                    "Off" => "scroll-off",
                                ),
                            "save_always" => true,
                            "description" => esc_html__("When active the content in the book mockup area will smoothly scroll down.", "keydesign")
                        ),

                        array(
                            "type" => "attach_image",
			                      "class" => "",
                            "heading" => esc_html__("Upload device mockup", "keydesign"),
                            "param_name" => "bp_mockup",
	                          "value" => "",
                            "description" => esc_html__("Upload container mockup.", "keydesign")
                        ),

                        array(
                            "type" => "textarea_html",
                            "class" => "",
                            "heading" => esc_html__("Book text", "keydesign"),
                            "param_name" => "content",
                            "value" => "",
                            "description" => esc_html__("Enter a short presentation of the book. HTML tags are allowed.", "keydesign"),
                        ),
                    )
                ));
            }
        }



		// Render the element on front-end

        public function kd_bookpreview_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'bp_mockup'			=> '',
                'bp_scroll'     => '',
            ), $atts));

            $mockup_img = $output = '';

      			if ( !empty($bp_mockup) ) {
      				$mockup_img = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $bp_mockup, 'thumb_size' => 'full', 'class' => "" ) );
      			}

            if ( $bp_scroll != "scroll-off" ) {
              $output .= '<script type="text/javascript">
                jQuery(document).ready(function($){
                  if ($(".bp-content").length) {
                    setInterval(function(){
                      var pos = $(".bp-content").scrollTop();
                      $(".bp-content").scrollTop(pos + 1);
                    }, 30)
                  }
                });</script>';
            }

            $output .= '<div class="bp-container">
      				<div class="bp-device">'.$mockup_img['thumbnail'].'</div>
      				<div class="bp-content">'.do_shortcode($content).'</div>
      			</div>';

            return $output;

        }
    }
}

if (class_exists('KD_ELEM_BOOK_PREVIEW')) {
    $KD_ELEM_BOOK_PREVIEW = new KD_ELEM_BOOK_PREVIEW;
}

?>

<?php
  if (class_exists('WPBakeryShortCodesContainer')) {
	class WPBakeryShortCode_tek_extended_tabs extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_tek_extended_tabs_single extends WPBakeryShortCode {
    }
}if (!class_exists('tek_extended_tabs')) {
    class tek_extended_tabs extends KEYDESIGN_ADDON_CLASS {
		function __construct() {
			add_action('admin_init', array($this, 'kd_extended_tabs_init'));
			add_shortcode('tek_extended_tabs', array($this, 'kd_extended_tabs_container'));
			add_shortcode('tek_extended_tabs_single', array( $this, 'kd_extended_tabs_single'));
		}

      /* VC Elements render in admin */
		function kd_extended_tabs_init() {
			if (function_exists('vc_map')) {
				vc_map(array(
					"name" => esc_html__("Extended tabs", "keydesign"),
					"description" => __("Vertical tabs with extended features.", "keydesign"),
					"base" => "tek_extended_tabs",
					"class" => "",
					"show_settings_on_create" => true,
					"content_element" => true,
					"as_parent" => array('only' => 'tek_extended_tabs_single'),
					"icon" => plugins_url('assets/element_icons/extended-tabs.png', dirname(__FILE__)),
					"category" => esc_html__("KeyDesign Elements", "keydesign"),
					"js_view" => 'VcColumnView',
					"params" => array(
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Tabs alignment","keydesign"),
							"param_name" => "services_tabs_alignment",
							"value" => array(
								"Image Left" => "tabs-image-left",
								"Image Right" => "tabs-image-right",
							),
							"save_always" => true,
							"description" => esc_html__("Select tabs image alignment.", "keydesign"),
						),

						array(
							"type" => "textfield",
							"class" => "",
							"heading" => esc_html__("Extra class name", "keydesign"),
							"param_name" => "services_extra_class",
							"value" => "",
							"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign"),
						),
					)
				));

				vc_map(array(
					"name" => esc_html__("Tab", "keydesign"),
					"base" => "tek_extended_tabs_single",
					"content_element" => true,
					"as_child" => array('only' => 'tek_extended_tabs'),
					"icon" => plugins_url('assets/element_icons/child-tabs.png', dirname(__FILE__)),
					"params" => array(
						array(
							"type" => "textfield",
							"heading" => esc_html__("Tab Title", "keydesign"),
							"param_name" => "services_title",
							"holder" => "tab_title",
							"value" => "",
							"description" => esc_html__("Enter tab title / tab anchor here.", "keydesign")
						),

						array(
							"type" => "exploded_textarea",
							"heading" => esc_html__("Tab Content", "keydesign"),
							"param_name" => "services_content",
							"value" => "",
							"description" => esc_html__("Content as list (Enter one feature per line)", "keydesign")
						),

						array(
							"type" => "dropdown",
							"class" =>	"",
							"heading" => esc_html__("Display icon","keydesign"),
							"param_name" => "icon_type",
							"value" => array(
								"Icon Browser" => "icon_browser",
								"Custom Icon" => "custom_icon",
							),
							"save_always" => true,
							"description"	=>	esc_html__("Select icon source.", "keydesign"),
						),

						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Icon library", "keydesign" ),
							"value" => array(
								esc_html__( "Font Awesome", "keydesign" ) => "fontawesome",
								esc_html__( "Linecons", "keydesign" ) => "linecons",
							),
							"param_name" => "icon_library",
							"dependency" =>	array(
								"element" => "icon_type",
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
							"type" => "attach_image",
							"class" => "",
							"heading" => esc_html__("Upload image icon", "keydesign"),
							"param_name" => "icon_img",
							"admin_label" => true,
							"value" => "",
							"description" => esc_html__("Upload your own custom image.", "keydesign"),
							"dependency" => array(
								"element" => "icon_type",
								"value" => array("custom_icon"),
							),
						),
						array(
							"type" => "attach_image",
							"heading" => esc_html__("Tab Image", "keydesign"),
							"param_name" => "services_image",
							"value" => "",
							"description" => esc_html__("You can display one image per tab.", "keydesign"),
						),
					)
				));
			}
		}

		public function kd_extended_tabs_container($atts, $content = null) {
			extract(shortcode_atts(array(
				'services_extra_class' => '',
				'services_tabs_alignment' => '',
			), $atts));

			$output = '			<div class="features-tabs '.$services_tabs_alignment.' '.$services_extra_class.'">'.do_shortcode($content).'
				<ul class="tabs"></ul>
			</div>';
			return $output;
		}

		public function kd_extended_tabs_single($atts, $content = null) {
			extract(shortcode_atts(array(
				'services_title' => '',
				'services_content' => '',
				'icon_type' => '',
				'icon_library' => '',
				'icon_fontawesome' => '',
				'icon_linecons' => '',
				'icon_img' => '',
				'services_image' => '',
			), $atts));

			$content_icon = $icons = $service_title_trim = '';

			$image  = wpb_getImageBySize($params = array( 'post_id' => NULL, 'attach_id' => $services_image, 'thumb_size' => 'full', 'class' => ""));

			if( $icon_type == 'icon_browser' ) {
				vc_icon_element_fonts_enqueue( $icon_library );
				if (strlen($icon_fontawesome) > 0) {
					$icons = $icon_fontawesome;
				} elseif (strlen($icon_linecons) > 0) {
					$icons = $icon_linecons;
				}
			}

      $service_title_trim .= "kd-extendtabs-".uniqid();

			if( $icon_type == 'icon_browser' && !empty($icons) ) {
				$content_icon = '<i class="'.$icons .' fa"></i> ';
			} elseif( $icon_type == 'custom_icon' && !empty($icon_img) ) {
				$tt_tab_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
				$content_icon = '<div class="tt-tab-customimg">'.$tt_tab_img_array['thumbnail'].'</div>';
			}

			$output = '<div id="'.$service_title_trim.'">
				<div class="tab-image-container">'.$image['thumbnail'].'</div>
				<li class="tab col-md-4">
					<a href="#'.$service_title_trim.'">
						<span class="triangle"></span>
						'.$content_icon.'
						<h5>'.$services_title.'</h5>
						<p>'.$services_content.'</p>
					</a>
				</li>
			</div>';

        return $output;
      }
    }
  }

if (class_exists('tek_extended_tabs')) {
	$tek_extended_tabs = new tek_extended_tabs; }
?>

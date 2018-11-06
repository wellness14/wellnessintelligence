<?php

if (!class_exists('KD_ELEM_TEAM')) {

    class KD_ELEM_TEAM extends KEYDESIGN_ADDON_CLASS {
        function __construct() {
            add_action('init', array($this, 'kd_team_init'));
            add_shortcode('tek_team', array($this, 'kd_team_shrt'));
        }

        // Element configuration in admin

        function kd_team_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Team Member", "keydesign"),
                    "description" => esc_html__("Team member element", "keydesign"),
                    "base" => "tek_team",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/team-member.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Team member name", "keydesign"),
                            "param_name" => "title",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Enter Team member name.", "keydesign")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Team member position", "keydesign"),
                            "param_name" => "position",
                            "value" => "",
                            "description" => esc_html__("Enter Team member position.", "keydesign")
                        ),

                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Team member description", "keydesign"),
                            "param_name" => "description",
                            "value" => "",
                            "description" => esc_html__("Enter Team member description.", "keydesign")

                        ),

                        array(
                             "type" => "vc_link",
                             "class" => "",
                             "heading" => esc_html__("View More Link", "keydesign"),
                             "param_name" => "more_link_url",
                             "value" => "",
                             "description" => esc_html__("Add extra link button", "keydesign"),
                        ),

                        array(
                            "type" => "attach_image",
                            "heading" => esc_html__("Team member image", "keydesign"),
                            "param_name" => "image",
                            "description" => esc_html__("Upload Team member image.")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Team member color", "keydesign"),
                            "param_name" => "hover_color",
                            "value" => "",
                            "description" => esc_html__("Choose team member color ( default is theme main color )", "keydesign")
                        ),

                        array(
                             "type" => "vc_link",
                             "class" => "",
                             "heading" => esc_html__("Facebook Link", "keydesign"),
                             "param_name" => "facebook_url",
                             "value" => "",
                             "description" => esc_html__("Set Facebook address and target.", "keydesign"),
                        ),

                        array(
                             "type" => "vc_link",
                             "class" => "",
                             "heading" => esc_html__("Twitter Link", "keydesign"),
                             "param_name" => "twitter_url",
                             "value" => "",
                             "description" => esc_html__("Set Twitter address and target.", "keydesign"),
                        ),

                        array(
                             "type" => "vc_link",
                             "class" => "",
                             "heading" => esc_html__("Google Link", "keydesign"),
                             "param_name" => "google_url",
                             "value" => "",
                             "description" => esc_html__("Set Google Plus address and target.", "keydesign"),
                        ),

                        array(
                             "type" => "vc_link",
                             "class" => "",
                             "heading" => esc_html__("Linkedin Link", "keydesign"),
                             "param_name" => "linkedin_url",
                             "value" => "",
                             "description" => esc_html__("Set Linkedin address and target.", "keydesign"),
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
                            "param_name" => "team_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
            }
        }



        // Render the element on front-end

        public function kd_team_shrt($atts, $content = null)

        {
            extract(shortcode_atts(array(
                'description'                           => '',
                'title'                                 => '',
                'position'                              => '',
                'hover_color'                                 => '',
                'more_link_url'                                 => '',
                'image'                                 => '',
                'facebook_url'                          => '',
                'twitter_url'                           => '',
                'google_url'                            => '',
                'linkedin_url'                          => '',
                'css_animation'                         => '',
                'elem_animation_delay'                  => '',
                'team_extra_class'                      => '',
            ), $atts));

            $link_target_fb = $link_title_fb = $link_target_tw = $link_title_tw = $link_target_go = $link_title_go = $link_target_li = $link_title_li = $href_facebook = $href_twitter = $href_google = $href_linkedin = $animation_delay = $href_more = '';

            $image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $image,
                'thumb_size' => 'full',
                'class' => ""
            ));



            $href_more = vc_build_link($more_link_url);
            if($href_more['url'] !== '') {
              $link_target_more = (isset($href_more['target'])) ? 'target="'.$href_more['target'].'"' : '';
              $link_title_more = (isset($href_more['title'])) ? 'title="'.$href_more['title'].'"' : '';
            }

      			$href_facebook = vc_build_link($facebook_url);
      			if($href_facebook['url'] !== '') {
      				$link_target_fb = (isset($href_facebook['target'])) ? 'target="'.$href_facebook['target'].'"' : '';
      				$link_title_fb = (isset($href_facebook['title'])) ? 'title="'.$href_facebook['title'].'"' : '';
      			}

            $href_twitter = vc_build_link($twitter_url);
      			if($href_twitter['url'] !== '') {
      				$link_target_tw = (isset($href_twitter['target'])) ? 'target="'.$href_twitter['target'].'"' : '';
      				$link_title_tw = (isset($href_twitter['title'])) ? 'title="'.$href_twitter['title'].'"' : '';
      			}

            $href_google = vc_build_link($google_url);
      			if($href_google['url'] !== '') {
      				$link_target_go = (isset($href_google['target'])) ? 'target="'.$href_google['target'].'"' : '';
      				$link_title_go = (isset($href_google['title'])) ? 'title="'.$href_google['title'].'"' : '';
      			}

            $href_linkedin = vc_build_link($linkedin_url);
      			if($href_linkedin['url'] !== '') {
      				$link_target_li = (isset($href_linkedin['target'])) ? 'target="'.$href_linkedin['target'].'"' : '';
      				$link_title_li = (isset($href_linkedin['title'])) ? 'title="'.$href_linkedin['title'].'"' : '';
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '<div class="team-member '.$css_animation.' '.$team_extra_class.'" '.$animation_delay.'>
                            <div class="team-content">
                                <div class="team-image">'.$image['thumbnail'].'
                                <div class="team-content-hover" style="background:'.$hover_color.';">
                                <div class="gradient-overlay"></div>
                                <h5>'.$title.'</h5>
                                <span class="team-subtitle">'.$position.'</span>
                                <p>'.$description.'</p>';
                   if(isset($more_link_url) && $more_link_url !== '' &&  $href_more['url'] !== '') {
                    $output .='<a class="team-more-link" href="'.$href_more['url'].'"'.$link_target_more.''.$link_title_more.'>'.$href_more['title'].'</a>';
                    }
                              $output .='<div class="team-socials">';
									if(isset($facebook_url) && $facebook_url !== '' &&  $href_facebook['url'] !== '') {
										$output .='<a href="'.$href_facebook['url'].'"'.$link_target_fb.''.$link_title_fb.'><span class="fa fa-facebook"></span></a>';
										}
									if(isset($twitter_url) && $twitter_url !== '' &&  $href_twitter['url'] !== '') {
										$output .='<a href="'.$href_twitter['url'].'"'.$link_target_tw.''.$link_title_tw.'><span class="fa fa-twitter"></span></a>';
										}
									if(isset($google_url) && $google_url !== '' &&  $href_google['url'] !== '') {
										$output .='<a href="'.$href_google['url'].'"'.$link_target_go.''.$link_title_go.'><span class="fa fa-google-plus"></span></a>';
										}
									if(isset($linkedin_url) && $linkedin_url !== '' &&  $href_linkedin['url'] !== '') {
										$output .='<a href="'.$href_linkedin['url'].'"'.$link_target_li.''.$link_title_li.'><span class="fa fa-linkedin"></span></a>';
										}
                                $output .='</div>
                            </div></div>
                                <h5>'.$title.'</h5>
                                <span class="team-subtitle">'.$position.'</span>
                            </div>
                        </div>';
            return $output;
        }
    }
}

if (class_exists('KD_ELEM_TEAM')) {
    $KD_ELEM_TEAM = new KD_ELEM_TEAM;
}
?>

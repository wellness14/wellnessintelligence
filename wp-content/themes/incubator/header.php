<?php
/**
 * Theme header
 * @package incubator
 * by KeyDesign
 */
 ?>

<?php $redux_ThemeTek = get_option( 'redux_ThemeTek' ); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <?php if (isset($redux_ThemeTek['tek-main-color']) && $redux_ThemeTek['tek-main-color'] != '' ) : ?>
        <meta name="theme-color" content="<?php echo esc_attr($redux_ThemeTek['tek-main-color']); ?>" />
      <?php endif; ?>
      <link rel="profile" href="http://gmpg.org/xfn/11">
      <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() && $redux_ThemeTek['tek-favicon']['url'] != '' ) { ?>
        <link href="<?php echo esc_url($redux_ThemeTek['tek-favicon']['url']); ?>" rel="icon">
      <?php } ?>
      <link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>" />
      <?php wp_head(); ?>
   </head>
   <body <?php body_class();?>>
      <?php if( !empty($redux_ThemeTek['tek-preloader']) && $redux_ThemeTek['tek-preloader'] == 1 ) : ?>
        <div id="preloader">
           <div class="spinner"></div>
        </div>
      <?php endif; ?>

      <!-- Contact Modal template -->
      <?php if (isset($redux_ThemeTek['tek-header-button'])) {
        if ($redux_ThemeTek['tek-header-button'] && ($redux_ThemeTek['tek-header-button-action'] == '1')) {
          get_template_part( 'core/templates/header/content', 'contact-modal' );
        }
      } ?>
      <!-- END Contact Modal template -->

      <?php if (!isset($redux_ThemeTek['tek-coming-soon-page'])) $redux_ThemeTek['tek-coming-soon-page'] = '';
      if (is_page($redux_ThemeTek['tek-coming-soon-page']) && $redux_ThemeTek['tek-coming-soon-page'] != '') { ?> <div class="maintenance"> <?php } ?>
      <nav class="navbar navbar-default navbar-fixed-top <?php if (isset($redux_ThemeTek['tek-menu-style'])) { if ($redux_ThemeTek['tek-menu-style'] == '1') { echo esc_html('fullwidth'); }} ?> <?php if (isset($redux_ThemeTek['tek-menu-behaviour'])) { if ($redux_ThemeTek['tek-menu-behaviour'] == '2') { echo esc_html('fixed-menu'); }} ?>" >
         <div class="container">
            <div id="logo">
               <a class="logo" href="<?php echo esc_url(home_url()); ?>">
               <?php if (isset($redux_ThemeTek['tek-logo']['url'])) { ?>
                 <img class="fixed-logo" src="<?php echo esc_url($redux_ThemeTek['tek-logo']['url']); ?>" width="<?php  if (isset($redux_ThemeTek['tek-logo-size']['width'])) { echo esc_html($redux_ThemeTek['tek-logo-size']['width']); }?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                 <img class="nav-logo" src="<?php echo esc_url($redux_ThemeTek['tek-logo2']['url']); ?>" width="<?php if (isset($redux_ThemeTek['tek-logo-size']['width'])) { echo esc_html($redux_ThemeTek['tek-logo-size']['width']); }?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
               <?php } else { ?>
                 <img class="fixed-logo" src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.png'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                 <img class="nav-logo" src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-2.png'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                <?php } ?></a>
            </div>
           <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <?php if (isset($redux_ThemeTek['tek-woo-cart'])) {
                      if ($redux_ThemeTek['tek-woo-cart'] && ($redux_ThemeTek['tek-woo-cart'] == '1')) {
                    ?>
                    <div class="mobile-cart">
                        <?php
                          if( !class_exists( 'WooCommerce' ) )  {
                              function is_woocommerce() {}
                          }
                          if( class_exists( 'WooCommerce' ) ) {
                              $keydesign_minicart = '';
                              $keydesign_minicart = keydesign_add_cart_in_menu();
                              echo do_shortcode( shortcode_unautop( $keydesign_minicart ) );
                          }
                        ?>
                    </div>
                  <?php } } ?>
            </div>
            <div id="main-menu" class="collapse navbar-collapse  navbar-right">
               <?php
                  wp_nav_menu( array( 'theme_location' => 'keydesign-header-menu', 'depth' => 2, 'container' => false, 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker()) );
               ?>
               <?php if (isset($redux_ThemeTek['tek-header-button'])) {
                      get_template_part( 'core/templates/header/content', 'header-button' );
                } ?>
              <!-- WooCommerce Cart -->
              <?php
                if( class_exists( 'WooCommerce' ) ) {
                  if (isset($redux_ThemeTek['tek-woo-cart'])) {
                    if ($redux_ThemeTek['tek-woo-cart'] && ($redux_ThemeTek['tek-woo-cart'] == '1')) {
                      $keydesign_minicart = '';
                      $keydesign_minicart = keydesign_add_cart_in_menu();
                      echo do_shortcode( shortcode_unautop( $keydesign_minicart ) );
                    }
                  }
                }
              ?>
              <!-- END WooCommerce Cart -->
            </div>
         </div>
      </nav>


      <div id="wrapper" class="<?php if (isset($redux_ThemeTek['tek-disable-animations']) && $redux_ThemeTek['tek-disable-animations'] == true ) { echo 'no-mobile-animation'; } ?>">
      <?php if(is_front_page()) { ?>
      <header id="header">
         <?php if (isset($redux_ThemeTek['tek-slider']) && $redux_ThemeTek['tek-slider'] != '' ) : ?>
               <div id="incubator-slider" class="fullwidth">
                  <?php echo do_shortcode('[rev_slider alias="'. esc_attr($redux_ThemeTek['tek-slider']). '"]' ); ?>
                  <?php if (isset($redux_ThemeTek['tek-slider-scroll'])) : ?>
                    <?php if ($redux_ThemeTek['tek-slider-scroll']) : ?>
                     <div class="slider-scroll-down">
                        <a href="#" title="Scroll down">Scroll down</a>
                     </div>
                  <?php endif; ?>
                <?php endif; ?>
               </div>
         <?php endif; ?>
      </header>
      <?php } else if (!is_404() && !is_singular( 'themetek_portfolio' ) && !is_single() && !is_page() && !is_woocommerce()) {
      $keydesign_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_option('page_for_posts')), 'full', false )  ?>
      <header id="header" class="blog-header">
         <div class="header-overlay parallax-overlay" style="background-image:url('<?php echo esc_url($keydesign_header_image[0]); ?>')"></div>
         <div class="container">
            <div class="intro-text">
               <?php if ( is_category() ) { ?>
               <h2 class="section-heading">
                  <?php esc_html_e('Currently browsing', 'incubator') ?>: <?php single_cat_title(); ?>
               </h2>
               <?php } elseif ( is_search() ) { ?>
               <h2 class="section-heading">
                  <?php esc_html_e('Search result for', 'incubator') ?>: <?php the_search_query();  ?>
               </h2>
               <?php } elseif ( is_tag() ) { ?>
               <h2 class="section-heading">
                  <?php esc_html_e('All posts tagged', 'incubator') ?>: <?php single_tag_title(); ?>
               </h2>
               <?php } elseif ( is_author() ) { ?>
               <h2 class="section-heading">
                  <?php esc_html_e('All posts by', 'incubator') ?> <?php echo esc_attr(get_userdata(get_query_var('author'))->display_name); ?>
               </h2>
               <?php } elseif ( is_day() ) { ?>
               <h2 class="section-heading">
                  <?php esc_html_e('Posts archive for', 'incubator') ?> <?php echo get_the_date('F jS, Y'); ?>
               </h2>
               <?php } elseif ( is_month() ) { ?>
               <h2 class="section-heading">
                  <?php esc_html_e('Posts archive for', 'incubator') ?> <?php echo get_the_date('F, Y'); ?>
               </h2>
               <?php } elseif ( is_year() ) { ?>
               <h2 class="section-heading">
               <?php esc_html_e('Posts archive for', 'incubator') ?> <?php echo get_the_date('Y'); ?>
               </h2>
               <?php } elseif ( is_front_page() && is_home() ) { ?>
               <h2 class="section-heading">
                  <?php echo get_bloginfo( 'name' ); ?>
               </h2>
               <?php } elseif ( get_page( get_option('page_for_posts') ) ) { ?>
               <h2 class="section-heading">
                  <?php echo apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title); ?>
               </h2>
               <?php  } else { ?>
               <h1 class="section-heading"><?php echo esc_html(get_the_title(get_queried_object_id())); ?></h1>
               <?php  } ?>
               <p class="section-subheading"><?php echo isset($redux_ThemeTek['tek-blog-subtitle']) ? esc_attr($redux_ThemeTek['tek-blog-subtitle']) : ''; ?> </p>
            </div>
         </div>
      </header>
      <?php } ?>

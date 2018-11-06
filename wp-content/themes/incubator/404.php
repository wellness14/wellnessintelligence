<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package incubator
 * by KeyDesign
 */
?>

<?php get_header(); ?>
<section class="page-404">
<div class="page404-overlay" style="background-image:url('<?php echo esc_url($redux_ThemeTek['tek-404-img']['url']); ?>')"></div>
<div class="container">
   <div class="row" >
      <h2 class="section-heading"><?php  if (isset($redux_ThemeTek['tek-404-title'])) { echo esc_attr($redux_ThemeTek['tek-404-title']); } else { echo "Page 404"; } ?></h2>
      <span class="separator"></span>
      <p class="section-subheading"><?php echo esc_attr($redux_ThemeTek['tek-404-subtitle']) ?></p>
      <a href="<?php echo esc_url(get_site_url()); ?>" class="tt_button"><?php if (isset($redux_ThemeTek['tek-404-back'])) { echo esc_attr($redux_ThemeTek['tek-404-back']); } else { echo "Back to Homepage"; } ?></a>
   </div>
   </div>
</section>
<?php get_footer(); ?>

<?php
/**
 * Home template file.
 *
 * The template file home.php is used to render the blog posts index,
 * whether it is being used as the front page or on separate static page.
 * If home.php does not exist, WordPress will use index.php.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package incubator
 * by KeyDesign
 */
?>

<?php
$redux_ThemeTek = get_option( 'redux_ThemeTek' );
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if (strpos($url,'blog-fullwidth') !== false)
{
    $redux_ThemeTek['tek-blog-sidebar'] = 0;
}
if (strpos($url,'blog-minimal') !== false)
{
    $redux_ThemeTek['tek-blog-minimal'] = 1;
}

   get_header();
   ?>
<?php if( is_home() ) : ?>
<div id="posts-content" class="container" >
   <?php if (($redux_ThemeTek['tek-blog-sidebar']) && ($redux_ThemeTek['tek-blog-minimal']) == 0) { ?>
   <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
      <?php } else { ?>
      <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 BlogFullWidth">
         <?php } ?>
      <?php
         if (have_posts()) :
         while (have_posts()) :
         the_post();
         ?>
      <?php if (($redux_ThemeTek['tek-blog-minimal']) == 1) { $post_class = "BlogMinimal"; } else { $post_class = "section"; }?>
      <div <?php post_class($post_class); ?> id="post-<?php  the_ID(); ?>" >
         <?php if (($redux_ThemeTek['tek-blog-minimal']) == 0) { ?>
         <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('large'); ?></a>
         <?php } ?>
         <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><h2 class="blog-single-title"><?php  the_title(); ?></h2></a>
         <div class="entry-content">
            <?php if(has_excerpt()) : ?>
            <?php the_excerpt(); ?>
            <?php else : ?>
            <div class="page-content"><?php the_content(); ?></div>
            <?php endif; ?>
            <?php wp_link_pages(); ?>
         </div>
         <div class="entry-meta">
            <?php if ( is_sticky() ) echo '<span class="fa fa-thumb-tack"></span> Sticky <span class="blog-separator">|</span>  '; ?>
            <span class="published"><span class="fa fa-clock-o"></span><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php  the_time( get_option('date_format') ); ?></a></span>
            <span class="author"><span class="fa fa-keyboard-o"></span><?php  the_author_posts_link(); ?></span>
            <span class="blog-label"><span class="fa fa-folder-open-o"></span><?php  the_category(', '); ?></span>
            <span class="comment-count"><span class="fa fa-comment-o"></span><?php  comments_popup_link( esc_html__('No comments yet', 'incubator'), esc_html__('1 comment', 'incubator'), esc_html__('% comments', 'incubator') ); ?></span>
         </div>
      </div>
      <?php endwhile; ?>
      <?php the_posts_pagination( array('mid_size' => 1,'prev_text' => esc_html__( 'Previous', 'incubator' ),'next_text' => esc_html__( 'Next', 'incubator' ),) ); ?>
   </div>
   <?php if (($redux_ThemeTek['tek-blog-sidebar']) && ($redux_ThemeTek['tek-blog-minimal']) == 0) { ?>
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <?php get_sidebar(); ?>
   </div>
   <?php } ?>
</div>
<?php  else : ?>
<div id="posts-content" class="container" >
   <div id="post-not-found" <?php post_class(); ?>>
      <h2 class="entry-title"><?php esc_html_e('Error 404 - Not Found', 'incubator') ?></h2>
      <div class="entry-content">
         <p><?php esc_html_e("Sorry, no posts matched your criteria.", "incubator") ?></p>
      </div>
   </div>
</div>
<?php endif; ?>
<?php else : ?>
<?php
   $keydesign_homePageID=get_the_ID();
   $keydesign_args=array('post_type'=>'page','posts_per_page'=>-1,'post_parent'=>$keydesign_homePageID,'post__not_in'=>array($keydesign_homePageID),'order'=>'ASC','orderby'=>'menu_order');
   $keydesign_parent=new WP_Query($keydesign_args);
?>
<?php if($keydesign_parent->have_posts()): ?>
<?php
   while($keydesign_parent->have_posts()):
   $keydesign_parent->the_post();
?>
<?php $keydesign_page_template=str_replace('page_','',str_replace('.php','',basename(get_page_template()))); ?>
<?php if($keydesign_page_template&&$keydesign_page_template!='page'): ?>
<?php get_template_part($keydesign_page_template,get_post_format()); ?>
<?php wp_reset_postdata(); ?>
<?php else : ?>
<?php get_template_part('loop',get_post_format()); ?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>

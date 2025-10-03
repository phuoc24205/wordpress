<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class('danh-sach'); ?> id="post-<?php the_ID(); ?>">


    <div class="post-right">

   <div class ="header">
	 <div class="post-date">
        <span class="day"><?php echo get_the_date('d'); ?></span>
        <div class="month-year">
            <span class="month">
                <?php echo 'Tháng ' . date_i18n( 'n', strtotime( get_the_date() ) ); ?>
            </span>
            <span class="year"><?php echo get_the_date('Y'); ?></span>
        </div>
    </div>
		  <header class="entry-header">
        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
        
        <!-- <div class="entry-categories">
            <?php the_category( ', ' ); ?>
        </div> -->
        
    <div class="entry-content">
        <?php
        if ( is_search() || ( ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) ) {
            the_excerpt();
        } else {
            the_content( __( 'Continue reading', 'twentytwenty' ) );
        }
        ?>
    </div>
    </header>
   </div>

</div>

</article>
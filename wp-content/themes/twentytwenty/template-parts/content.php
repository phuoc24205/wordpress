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

    <?php if (!is_single()) : ?>
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
    <?php else : ?>
        <div class="post-single">
        	<!-- Nếu đang ở trang chi tiết -->
         <div class="post-title-row">
         <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<div class="circle-date">
			<div class="left">
				<div class="day"><?php echo get_the_date('d', $post->ID); ?></div>
				<div class="month"><?php echo get_the_date('m', $post->ID); ?></div>
			</div>
			<div class="year"><?php echo get_the_date('y', $post->ID); ?></div>
		</div>
         </div>
        <div class="line">
        <div class="line-container">
           <svg viewBox="0 0 800 60" preserveAspectRatio="none">
            <polyline 
                points="0,30 150,30 155,35 160,30 800,30" 
                fill="none" 
                stroke="#333" 
                stroke-width="1"
                stroke-linejoin="miter"
            />
            </svg>

        </div>
		<?php get_template_part('template-parts/featured-image'); ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>
        </div>
	<?php endif; ?>
    </header>
   </div>

</div>

</article>
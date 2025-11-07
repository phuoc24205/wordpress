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
        <?php
     if ( is_search() ) {
                ?>
                <div class="custom-post-thumbnail">
                    <?php
                    the_post_thumbnail( 'thumbnail' );
                    ?>
                </div>
                <?php
            }
            ?>
	 <div class="post-date">
        <span class="day"><?php echo get_the_date('d'); ?></span>
        <div class="month-year">
            <span class="month">
                <?php echo 'Tháng ' . date_i18n( 'n', strtotime( get_the_date() ) ); ?>
            </span>
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
    <?php else : ?>
        <div class="post-single">
        	<!-- Nếu đang ở trang chi tiết -->
         
        <!-- START: Wrapper cho bố cục 3 cột -->
        <div class="post-layout-wrapper-3-col">

            <!-- Cột 1: HIỂN THỊ TẤT CẢ categories (sẽ cố định hoặc nằm bên trái) -->
            <div class="post-sidebar-categories post-col-1">
                <div class="all-categories-list-container">
                    <h2 class="categories-list-header">Categories</h2>
                    <ul class="categories-list-ul">
                        <?php
                        // Lấy danh sách tất cả các danh mục
                        $args = array(
                            'orderby'    => 'name',
                            'show_count' => 0, // Không hiển thị số lượng bài viết
                            'title_li'   => '', // Không hiển thị tiêu đề mặc định
                            'echo'       => 0,  // Trả về chuỗi thay vì in ra
                        );

                        // Hiển thị danh sách categories dưới dạng <li> và <a>
                        $category_list = wp_list_categories( $args );

                        echo $category_list;
                        ?>
                    </ul>
                </div>
            </div>
            <!-- END: Cột 1 Categories -->

            <!-- Cột 2 (Giữa): NỘI DUNG BÀI VIẾT -->
            <div class="post-content-main post-col-2">
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
                <!-- END .line -->
                
                <div class="section-inner">
                    <?php
                    wp_link_pages(array(/* ... */));
                    edit_post_link();
                    twentytwenty_the_post_meta(get_the_ID(), 'single-bottom');
                    if (post_type_supports(get_post_type(get_the_ID()), 'author') && is_single()) {
                        get_template_part('template-parts/entry-author-bio');
                    }
                    ?>
                </div>
                <!-- END .section-inner -->
                
                <?php
                if (is_single()) {
                    get_template_part('template-parts/navigation');
                }
                if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
                    ?>
                    <div class="comments-wrapper section-inner"><?php comments_template(); ?></div>
                    <?php
                }
                ?>
            </div>
            <!-- END: Cột 2 Content -->
            
            <!-- START: Cột 3 Recent Post -->
            <div class="post-sidebar-next post-col-3">
                <?php
                $current_post_id = get_the_ID();
                // Lấy 3 bài viết gần đây nhất, loại trừ bài viết hiện tại
                $recent_posts = get_posts(array(
                    'numberposts'  => 3,
                    'post_status'  => 'publish',
                    'post__not_in' => array($current_post_id)
                ));

                if ( $recent_posts ) :
                    ?>
                    <!-- Khối tin tức mới nhất (Áp dụng CSS để tạo màu nền xanh teal và bố cục) -->
                    <div class="latest-news-block">
                        <!-- Bạn có thể thêm tiêu đề ở đây nếu cần, ví dụ: <h3 class="block-title">Tin tức mới nhất</h3> -->

                        <?php foreach ( $recent_posts as $post ) : setup_postdata( $post ); ?>
                            <a href="<?php the_permalink(); ?>" class="news-item-link">
                                <div class="news-item-row">
                                    <!-- Date Group: Ngày / Tháng - Năm -->
                                    <div class="date-group">
                                        <div class="date-info">
                                            <div class="date-d-m">
                                                <span class="date-day"><?php echo get_the_date('d'); ?></span>
                                                <!-- Dấu gạch ngang dọc được mô phỏng bằng border-bottom của date-d-m -->
                                                <span class="date-month"><?php echo get_the_date('m'); ?></span>
                                            </div>
                                            <span class="date-separator"></span> <!-- Dấu gạch ngang ngang (—) -->
                                            <span class="date-year-display"><?php echo get_the_date('y'); ?></span>
                                        </div>
                                    </div>
                                    <!-- POST TITLE (Lấy lại tiêu đề bài viết) -->
                                    <div class="post-title category-heading">
                                        <?php the_title(); ?>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; wp_reset_postdata(); ?>

                        <!-- Nút Xem Tất Cả Tin Tức -->
                        <?php
                        // Lấy URL của trang tin tức/blog chính (Page for Posts)
                        $news_page_id = get_option('page_for_posts');
                        $news_archive_url = $news_page_id ? get_permalink($news_page_id) : get_home_url();
                        ?>
                        <a href="<?php echo esc_url($news_archive_url); ?>" class="view-all-news-button">
                            XEM TẤT CẢ TIN TỨC
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <!-- END: Cột 3 Recent Post -->

        </div>
        <!-- END: .post-layout-wrapper-3-col -->
        
        </div>
        <!-- END: .post-single -->

<?php endif; ?>
</article>
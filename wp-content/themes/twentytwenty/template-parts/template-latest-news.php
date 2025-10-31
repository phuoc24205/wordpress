<?php
/**
 * Template part: Latest news / posts
 * This template displays a timeline-style block of latest posts.
 */
?>

<div class="latest-news-timeline">
    <h2 class="latest-news-title">Latest News</h2>

    <?php
    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 3,
        'post_status' => 'publish'
    ));

    if ( ! empty( $recent_posts ) ) :
        ?>
        <div class="timeline-container">
            <?php foreach ( $recent_posts as $post ) : ?>
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <div class="timeline-circle"></div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h3 class="timeline-post-title">
                                <a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>">
                                    <?php echo esc_html( $post['post_title'] ); ?>
                                </a>
                            </h3>
                            <span class="timeline-date">
                                <?php echo date( 'd F, Y', strtotime( $post['post_date'] ) ); ?>
                            </span>
                        </div>
                        <p class="timeline-excerpt">
                            <?php echo esc_html( wp_trim_words( $post['post_content'], 100, '...' ) ); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        wp_reset_postdata();
    else :
        ?>
        <p><?php esc_html_e( 'Không có bài viết nào.', 'twentytwenty' ); ?></p>
    <?php endif; ?>

</div>

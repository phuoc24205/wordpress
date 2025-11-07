<?php
/**
 * Displays the menus and widgets at the end of the main element.
 * Visually, this output is presented as part of the footer element.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$has_footer_menu = has_nav_menu( 'footer' );
$has_social_menu = has_nav_menu( 'social' );

$has_sidebar_1 = is_active_sidebar( 'sidebar-1' );
$has_sidebar_2 = is_active_sidebar( 'sidebar-2' );
$has_sidebar_3 = is_active_sidebar( 'sidebar-3' );

// Debug - remove this after testing
// echo '<!-- Debug: sidebar-3 status: ' . ($has_sidebar_3 ? 'true' : 'false') . ' -->';
// Only output the container if there are elements to display.
if ( $has_footer_menu || $has_social_menu || $has_sidebar_1 || $has_sidebar_2 || $has_sidebar_3 ) {
	?>

	<div class="footer-nav-widgets-wrapper header-footer-group">

		<div class="footer-inner section-inner">

			

			<?php if ( $has_sidebar_1 || $has_sidebar_2 || $has_sidebar_3 ) { ?>

				<aside class="footer-widgets-outer-wrapper">

					<div class="footer-widgets-wrapper">

						<?php if ( $has_sidebar_1 ) { ?>

							<div class="footer-widgets column-one grid-item">
								<?php dynamic_sidebar( 'sidebar-1' ); ?>
							</div>

						<?php } ?>

						<?php if ( $has_sidebar_2 ) { ?>

							<div class="footer-widgets column-two grid-item">
								<?php dynamic_sidebar( 'sidebar-2' ); ?>
							</div>

						<?php } ?>

						<?php if ( $has_sidebar_3 ) { ?>

							<div class="footer-widgets column-three grid-item">
								<?php dynamic_sidebar( 'sidebar-3' ); ?>
							</div>

						<?php } else { ?>

							<!-- Sidebar-3 is registered but has no widgets -->
							<div class="footer-widgets column-three grid-item">
								<p>No widgets in Footer #3</p>
							</div>

						<?php } ?>
						

					</div><!-- .footer-widgets-wrapper -->

				</aside><!-- .footer-widgets-outer-wrapper -->
				<?php

			$footer_top_classes = '';

			$footer_top_classes .= $has_footer_menu ? ' has-footer-menu' : '';
			$footer_top_classes .= $has_social_menu ? ' has-social-menu' : '';

			if ( $has_footer_menu || $has_social_menu ) {
				?>
				<div class="footer-top<?php echo $footer_top_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
					<?php if ( $has_footer_menu ) { ?>

						<nav aria-label="<?php esc_attr_e( 'Footer', 'twentytwenty' ); ?>" class="footer-menu-wrapper">

							<ul class="footer-menu reset-list-style">
								<?php
								wp_nav_menu(
									array(
										'container'      => '',
										'depth'          => 1,
										'items_wrap'     => '%3$s',
										'theme_location' => 'footer',
									)
								);
								?>
							</ul>

						</nav><!-- .site-nav -->

					<?php } ?>
					<?php if ( $has_social_menu ) { ?>

						<nav aria-label="<?php esc_attr_e( 'Social links', 'twentytwenty' ); ?>" class="footer-social-wrapper">

							<ul class="social-menu footer-social reset-list-style social-icons">

								<?php
								// Custom walker để thêm Font Awesome icons
								class Social_Walker extends Walker_Nav_Menu {
									function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
										$url = $item->url;
										// Use Font Awesome 6: brands use the "fab" prefix. Use a solid link icon as fallback.
										$icon_class = 'fas fa-link'; // Default icon (solid link)

										// Detect social platform from URL and assign appropriate brand icon
										if ( strpos( $url, 'facebook.com' ) !== false ) {
											// facebook brand icon
											$icon_class = 'fab fa-facebook-f';
										} elseif ( strpos( $url, 'twitter.com' ) !== false ) {
											$icon_class = 'fab fa-twitter';
										} elseif ( strpos( $url, 'instagram.com' ) !== false ) {
											$icon_class = 'fab fa-instagram';
										} elseif ( strpos( $url, 'linkedin.com' ) !== false ) {
											$icon_class = 'fab fa-linkedin-in';
										} elseif ( strpos( $url, 'youtube.com' ) !== false ) {
											$icon_class = 'fab fa-youtube';
										} elseif ( strpos( $url, 'github.com' ) !== false ) {
											$icon_class = 'fab fa-github';
										} elseif ( strpos( $url, 'pinterest.com' ) !== false ) {
											$icon_class = 'fab fa-pinterest';
										} elseif ( strpos( $url, 'tiktok.com' ) !== false ) {
											// TikTok is a brand icon in newer Font Awesome versions
											$icon_class = 'fab fa-tiktok';
										}
										
										$output .= '<li class="menu-item">';
										$output .= '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer">';
										$output .= '<i class="' . $icon_class . '" aria-hidden="true"></i>';
										$output .= '<span class="screen-reader-text">' . esc_html( $item->title ) . '</span>';
										$output .= '</a>';
									}
									
									function end_el( &$output, $item, $depth = 0, $args = null ) {
										$output .= '</li>';
									}
								}
								
								wp_nav_menu(
									array(
										'theme_location'  => 'social',
										'container'       => '',
										'container_class' => '',
										'items_wrap'      => '%3$s',
										'menu_id'         => '',
										'menu_class'      => '',
										'depth'           => 1,
										'walker'          => new Social_Walker(),
										'fallback_cb'     => '',
									)
								);
								?>

							</ul><!-- .footer-social -->

						</nav><!-- .footer-social-wrapper -->

					<?php } ?>
				</div><!-- .footer-top -->

			<?php } ?>

			<?php } ?>

		</div><!-- .footer-inner -->

	</div><!-- .footer-nav-widgets-wrapper -->

	<?php
}

<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		?>

		<header id="site-header" class="header-footer-group">

			<div class="header-inner section-inner">
				<div class="header-left">
					<div class="header-titles-wrapper">

					<?php

					// Check whether the header search is activated in the customizer.
					$enable_header_search = get_theme_mod( 'enable_header_search', true );

					if ( true === $enable_header_search ) {

						?>

						<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
							<span class="toggle-inner">
								<span class="toggle-icon">
									<i class="fa-solid fa-search" aria-hidden="true"></i>
								</span>
								<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
							</span>
						</button><!-- .search-toggle -->

					<?php } ?>

					<div class="header-titles">

						<?php
							// Site title or logo.
							twentytwenty_site_logo();
							
							// Site description.
							twentytwenty_site_description();
						?>

					</div><!-- .header-titles -->
					
					
					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
													<i class="fa-solid fa-bars" aria-hidden="true"></i>
							</span>
							<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
						</span>
					</button><!-- .nav-toggle -->

				</div><!-- .header-titles-wrapper -->
					<div class="header-actions">
					<!-- Home button -->
					<a class="button-home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<span class="toggle-text"><?php _e( 'Home', 'twentytwenty' ); ?></span>
					</a>

					<!-- Search form -->
					<form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'twentytwenty' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
						<button type="submit" class="search-submit">
							Submit
						</button>
					</form>
				</div>
				</div>
				<div class="header-navigation-wrapper">

					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>

							<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>">

								<ul class="primary-menu reset-list-style">

								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);

								}
								?>

								</ul>
					
								</nav><!-- .primary-menu-wrapper -->

							<!-- Icon row: Menu / Search / Account (icon above text) -->
							<nav class="primary-menu-icons" aria-hidden="false" aria-label="<?php esc_attr_e( 'Icon Menu', 'twentytwenty' ); ?>">
								<ul class="icon-list reset-list-style">

									<li class="icon-menu-item icon-account">
										<button class="icon-link toggle " data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
											<span class="toggle-icon">
												<i class="fa-solid fa-ellipsis" aria-hidden="true"></i>
					
											</span>
											<span class="icon-text">
												<?php _e( 'Menu', 'twentytwenty' ); ?>
											</span>
										</button>
									</li>

									<li class="icon-menu-item">
										<a class="icon-link" href="<?php echo esc_url( home_url( '/?s=' ) ); ?>">
											<span class="toggle-icon">
												<i class="fa-solid fa-search" aria-hidden="true"></i>
											</span>
											<span class="icon-text">
												<?php _e( 'Search', 'twentytwenty' ); ?>
											</span>
										</a>
									</li>

									<li class="icon-menu-item icon-account dropdown">
										<?php if ( is_user_logged_in() ) : ?>
											<button class="icon-link btn dropdown-toggle" id="headerAccountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
												<span class="toggle-icon"><i class="fa-solid fa-circle-user" aria-hidden="true"></i></span>
												<span class="icon-text"><?php _e( 'Account', 'twentytwenty' ); ?></span>
											</button>
											<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="headerAccountDropdown">
												<li><a class="dropdown-item" href="<?php echo esc_url( get_edit_profile_url( get_current_user_id() ) ); ?>"><?php _e( 'Profile', 'twentytwenty' ); ?></a></li>
												<?php if ( current_user_can( 'edit_posts' ) ) : ?>
													<li><a class="dropdown-item" href="<?php echo esc_url( admin_url() ); ?>"><?php _e( 'Dashboard', 'twentytwenty' ); ?></a></li>
												<?php endif; ?>
												<li><hr class="dropdown-divider"></li>
												<li><a class="dropdown-item" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><?php _e( 'Logout', 'twentytwenty' ); ?></a></li>
											</ul>
										<?php else : ?>
											<button class="icon-link btn dropdown-toggle" id="headerAccountDropdownGuest" data-bs-toggle="dropdown" aria-expanded="false">
												<span class="toggle-icon"><i class="fa-solid fa-user" aria-hidden="true"></i></span>
												<span class="icon-text"><?php _e( 'Account', 'twentytwenty' ); ?></span>
											</button>
											<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="headerAccountDropdownGuest">
												<li><a class="dropdown-item" href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Login', 'twentytwenty' ); ?></a></li>
												<li><a class="dropdown-item" href="<?php echo esc_url( wp_registration_url() ); ?>"><?php _e( 'Register', 'twentytwenty' ); ?></a></li>
											</ul>
										<?php endif; ?>
									</li>

								</ul>
							</nav>

						<?php
					}



						
						?>

					<?php
				
					?>

				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->

			<?php
			
			?>

		</header><!-- #site-header -->

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );

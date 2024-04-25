<?php

/* Headers */

function disle_cac_header_elementor_builder() {
	if (get_theme_mod('header_site_style', '1') == '1') {
		return false;
	} else {
		return true;
	}
}

function disle_cac_header_basic() {
	if (get_theme_mod('header_site_style', '1') == '1') {
		return true;
	} else {
		return false;
	}
}

function disle_cac_has_header_socials() {
	if (get_theme_mod('header_site_style', '1') == '1') {
		return get_theme_mod( 'header_socials', true );
	} else {
		return false;
	}
}

function disle_cac_header_search_icon() {
	return get_theme_mod( 'header_search_icon', true );
}


function disle_cac_header_cart_icon() {
	if ( class_exists( 'woocommerce' ) && get_theme_mod( 'header_cart_icon', true ) && disle_cac_header_basic() ) {
		return true;	
	} else {
		return false;
	}
}

/* Footer */
function disle_cac_footer_elementor_builder() {
	if (get_theme_mod('footer_site_style', '1') == '1') {
		return false;
	} else {
		return true;
	}
}

/* Custom Cursor */
function disle_cac_has_cursor() {
	return get_theme_mod('cursor', false);
}

function disle_cac_has_cursor_1() {
	if ( '' !== get_theme_mod('disle_cursor1_target', '') ) {
		return true;
	} else {
		return false;
	}
}

function disle_cac_has_cursor_2() {
	if ( '' !== get_theme_mod('disle_cursor2_target', '') ) {
		return true;
	} else {
		return false;
	}
}

function disle_cac_has_cursor_3() {
	if ( '' !== get_theme_mod('disle_cursor3_target', '') ) {
		return true;
	} else {
		return false;
	}
}

function disle_cac_has_cursor_4() {
	if ( '' !== get_theme_mod('disle_cursor4_target', '') ) {
		return true;
	} else {
		return false;
	}
}

function disle_cac_has_cursor_5() {
	if ( '' !== get_theme_mod('disle_cursor5_target', '') ) {
		return true;
	} else {
		return false;
	}
}

/* WooCommerce */
function disle_cac_has_woo() {
	if ( class_exists( 'woocommerce' ) ) { 
		return true;
	} else { 
		return false; 
	}
}

/* Scroll Top Button */
function disle_cac_has_scroll_top() {
	return get_theme_mod( 'scroll_top', true );
}

/* Layout */
function disle_cac_has_boxed_layout() {
	if ( 'boxed' == get_theme_mod( 'site_layout_style', 'full-width' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Featured Title */
function disle_cac_has_featured_title() {
	return get_theme_mod( 'featured_title', true );
}

function disle_cac_has_featured_title_center() {
	if ( disle_cac_has_featured_title_heading()
		&& 'centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function disle_cac_has_featured_title_breadcrumbs() {
	if ( disle_cac_has_featured_title() && get_theme_mod( 'featured_title_breadcrumbs' ) ) {
		return true;
	} else {
		return false;
	}
}

function disle_cac_has_featured_title_heading() {
	if ( disle_cac_has_featured_title() && get_theme_mod( 'featured_title_heading' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Post Single */
function disle_cac_has_related_post() {
	if ( disle_get_mod( 'blog_single_related', false ) ) {
		return true;
	};
}

/* Project Single */
function disle_cac_has_single_project() {
	if ( is_singular( 'project' ) ) {
		return true;
	} else {
		return false;
	}
}

function disle_cac_has_related_project() {
	if ( disle_get_mod( 'project_related', true ) && disle_cac_has_single_project() ) {
		return true;
	};
}

/* Service Single */
function disle_cac_has_single_service() {
	if ( is_singular( 'service' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Give Forms */
function disle_cac_has_give_forms() {
	if ( class_exists('Give') ) {
		return true;
	} else {
		return false;
	}
}

/* Footer */
function disle_cac_footer_basic() {
	if (get_theme_mod('footer_site_style', 1) == 1) {
		return true;
	} else {
		return false;
	}
}

function disle_cac_has_footer_widgets() {
	if (get_theme_mod('footer_site_style', 1) == 1) {
		return get_theme_mod( 'footer_widgets', true );
	} else {
		return false;
	}
}

/* Bottom Bar */
function disle_cac_has_bottombar() {
	if (get_theme_mod('footer_site_style', 1) == 1) {
		return get_theme_mod( 'bottom_bar', true );
	} else {
		return false;
	}
}

/* Accent Color */
function disle_cac_no_elementor_accent_color() {
	if ( class_exists( '\Elementor\Plugin' ) ) {
		$elementor_accent = false;
		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
		$colors = $kit->get_settings_for_display( 'custom_colors' );

		foreach( $colors as $key => $arr ) {
			if ( $arr['_id'] == 'disle_accent' ) {
				$custom_accent = strtoupper( $arr['color'] );
				$elementor_accent = true;
			}
		}

		if ($elementor_accent) {
			return false;
		} else {
			return true;
		}
	} else {
		return true;
	}
}

/* Preloader */
function disle_cac_preloader_default() {
	if (get_theme_mod('preloader', 'animsition') == 'animsition') {
		if (get_theme_mod('preloader_style', 'default') == 'default') {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function disle_cac_preloader_image() {
	if (get_theme_mod('preloader', 'animsition') == 'animsition') {
		if (get_theme_mod('preloader_style', 'default') == 'image') {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

/* WP Social */
function disle_cac_has_wp_social() {
	if(class_exists('\WP_Social')) {
		return true;
	} else {
		return false;
	}
}
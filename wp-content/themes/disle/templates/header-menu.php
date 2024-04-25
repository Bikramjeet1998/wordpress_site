<?php
/**
 * Header / Menu
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Menu
if ( has_nav_menu( 'primary' ) || has_nav_menu( 'onepage' ) ) {
	$cls = '';
	if ( disle_get_mod( 'menu_show_current' ) ) $cls .= 'show-current';
	$menu = is_page_template( 'templates/page-onepage.php' )
		? 'onepage'
		: 'primary';
	?>

	<nav id="main-nav" class="disle-menu <?php echo esc_attr( $cls ); ?>">
		<?php
		wp_nav_menu( array(
			'theme_location' => $menu,
			'link_before' => '<span>',
			'link_after'=>'</span>',
			'fallback_cb' => false,
			'container' => false
		) );
		?>
	</nav>
<?php }

// Search Icon
if ( disle_get_mod( 'header_search_icon', false ) ) {
	echo '<div class="disle-search"><a href="#" class="search-trigger"><i class="ci-magnifying-glass"></i></a></div>';
} 

// Cart Icon
if ( disle_get_mod( 'header_cart_icon', false ) && class_exists( 'woocommerce' ) ) { ?>
    <div class="disle-cart">
        <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
        	<i class="ci-shopping-cart"></i>
            <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                <span class="shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
            <?php else: ?>
                <span class="shopping-cart-items-count">0</span>
            <?php endif ?>
        </a>

        <div class="nav-shop-cart">
            <div class="widget_shopping_cart_content">      	
                <?php woocommerce_mini_cart() ?>
            </div>
        </div>
    </div>

<?php }

// Side menu for mobile
if ( has_nav_menu( 'primary' ) || has_nav_menu( 'onepage' ) ) {
	$cls = '';
	if ( disle_get_mod( 'menu_show_current' ) ) $cls .= 'show-current';
	$menu = is_page_template( 'templates/page-onepage.php' )
		? 'onepage'
		: 'primary';
	?>

	<div class="disle-hamburger-icon">
	    <i class="ci-menu"></i>
	</div>

	<div class="disle-menu-panel">
	    <div class="menu-panel-overlay"></div>
	    <div class="menu-panel-wrap">
	        <div class="close-menu"></div>
	        <?php
	        wp_nav_menu( array(
				'theme_location' => $menu,
				'link_before' => '<span>',
				'link_after'=>'</span>',
				'fallback_cb' => false,
				'container' => false
			) );
	        ?>
	    </div>
	</div>
<?php }

<?php
/**
 * Bottom Bar
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! disle_get_mod( 'bottom_bar', true ) ) return false;

$copyright = disle_get_mod( 'bottom_copyright', '&copy; Copyrights, 2023 Company.com' );

$css = disle_element_bg_css( 'bottom_background_img' );
?>

<div id="bottom" style="<?php echo esc_attr( $css ); ?>">
    <div class="disle-container">
        <div class="bottom-bar-inner-wrap">
            <div class="inner-wrap">
                <?php if ( $copyright ) : ?>
                    <div id="copyright">
                        <?php printf( '%s', do_shortcode( $copyright ) ); ?>
                    </div>
                <?php endif; ?>
            </div><!-- /.bottom-bar-copyright -->

            <?php get_template_part( 'templates/scroll-top'); ?>
        </div>
    </div>
</div><!-- /#bottom -->
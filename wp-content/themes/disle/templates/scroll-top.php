<?php
/**
 * Scroll Top Button
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! disle_get_mod( 'scroll_top', true ) ) return false;
?>

<div id="scroll-top"></div>
<?php

// Add new image size
function mae_custom_image_sizes() {	
	add_image_size( 'mae-news', 370, 320, true );
	add_image_size( 'mae-news-1', 370, 440, true );
	add_image_size( 'mae-project', 370, 396, true );
	add_image_size( 'mae-project-1', 370, 446, true );
	add_image_size( 'mae-project-2', 370, 414, true );
	add_image_size( 'mae-project-3', 370, 254, true );
}
add_action( 'after_setup_theme', 'mae_custom_image_sizes' );

// Add new animation
function mea_add_animation_elementor() {
	return $animations = [
		'Fading' => [
			'fadeIn' => 'Fade In',
			'fadeInDown' => 'Fade In Down',
			'fadeInLeft' => 'Fade In Left',
			'fadeInRight' => 'Fade In Right',
			'fadeInUp' => 'Fade In Up',
			'fadeInUpSmall' => 'Fade In Up Small',
			'fadeInDownSmall' => 'Fade In Down Small',
			'fadeInLeftSmall' => 'Fade In Left Small',
			'fadeInRightSmall' => 'Fade In Right Small',
		],
		'Reveal' => [
			'revealTop' => 'reveal Top',
			'revealBottom' => 'reveal Bottom',
			'revealLeft' => 'reveal Left',
			'revealRight' => 'reveal Right',
			'reveal revealTop2' => 'reveal Top 2',
			'reveal revealBottom2' => 'reveal Bottom 2',
			'reveal revealLeft2' => 'reveal Left 2',
			'reveal revealRight2' => 'reveal Right 2',
		]
	];

}
add_filter( 'elementor/controls/animations/additional_animations', 'mea_add_animation_elementor');


// JS for editor mode
add_action('wp_footer', 'mae_elementor_editor');
function mae_elementor_editor() {   
    if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
        wp_enqueue_style('flickity-fade');
        wp_enqueue_script('flickity-fade');
    ?>
        <script>
            /* Flexbox Container */
            (function($){
                $(window).on("elementor/frontend/init", function() {
                    elementorFrontend.hooks.addAction("frontend/element_ready/container", 
                        function( $scope ) {
                            if ($scope.index() == 0) {
                                $('.disle-container').each(function(idx, el) {
                                    if ($(el).find('.e-con-full').length) {
                                        $(el).addClass('con-full');
                                    }
                                }); 
                            }
                        });
                })
            })(jQuery);
        </script>
    <?php
    }
}
<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'disle' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'disle' ); ?>" />
	<button type="submit" class="search-submit" title="<?php echo esc_attr__('Search', 'disle'); ?>"><?php echo esc_html__('SEARCH', 'disle'); ?><i class="ci-magnifying-glass"></i></button>
</form>

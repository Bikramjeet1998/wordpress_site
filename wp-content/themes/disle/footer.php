		</div><!-- /.main-content -->
		<?php if (disle_get_elementor_option('footer_hide') !== 'yes') { 
			if ( disle_footer_style() == '1' ) {
				// Basic Footer
				get_template_part( 'templates/footer-widgets');
				get_template_part( 'templates/bottom');
			} else { 
				// Elementor Footer 
				?>
				<footer class="disle-footer footer">
					<div class="disle-container">
		        		<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display(disle_footer_style(), false); ?>
		        	</div>
		        </footer>
			<?php } 
		} ?>

		<?php get_template_part( 'templates/scroll-top'); ?>
	</div><!-- /#page -->
</div><!-- /#wrapper -->

<?php wp_footer(); ?>

</body>
</html>
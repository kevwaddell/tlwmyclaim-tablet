	<?php get_template_part( 'parts/global/freephone', 'number' ); ?>
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container-fluid">
			<div class="col-xs-12">
				<?php wp_nav_menu(array( 'container_class' => 'footer-links', 'theme_location' => 'footer-menu', 'fallback_cb' => false ) ); ?>
			</div>
			<div class="col-xs-6 col-md-4 col-md-offset-2">
				<div id="tlw-footer-logo" target="_blank"><span class="sr-only">TLW Solicitors</span></div>
				<div class="copyright-legal text-center">&copy; 2016 TLW Solicitors. All rights reserved.<br>Authorised and regulated by the <a href="http://www.sra.org.uk/home/home.page" target="_blank">Solicitors Regulation Authority</a></div>
			</div>
			<div class="col-xs-6 col-md-4">
				<a href="https://www.tlwsolicitors.co.uk" class="visit-site-btn btn btn-block btn-lg" target="_blank">Visit the <span>TLW Solicitors</span> website</a>
			</div>
		</div>
	</footer><!-- .site-footer -->

	
	</main><!-- .site-main -->
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
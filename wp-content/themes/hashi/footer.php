	
	<footer>
		<?php
			$hashi_customFooterText = get_theme_mod('custom_footer_text');
			if(!empty($hashi_customFooterText)) {
				print($hashi_customFooterText);
			} else  {
				print('WordPress ' . $wp_version . ' with Hashi theme');
			}
		?>
	</footer>

<?php wp_footer(); ?>

</body>

</html>

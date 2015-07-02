<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package brlcad
 */
?>
	</div><!-- #content -->

	<footer id="site-footer">
		<div class="row">
			<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
			</aside>
		</div>
		<?php if(is_active_sidebar('footer-sidebar-left')): ?>
			<div class="row">
				<div class="columns large-4">
					<?php 
						dynamic_sidebar('footer-sidebar-left'); 
					?>
				</div>
				<div class="columns large-4">
					<?php 
						dynamic_sidebar('footer-sidebar-center');
					?>
				</div>
				<div class="columns large-4">
					<?php 
						dynamic_sidebar('footer-sidebar-center');
					?>
				</div>
			</div>
		<?php endif; ?>
	</footer>

	<!-- <footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'brlcad_credits' ); ?>
		</div> 
	</footer>-->

	<footer>
	</footer>
</div>

<?php wp_footer(); ?>
<script>
$(function(){
        $(".itemizedlist").treemenu({delay:300}).openActive();
    });
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>
 <?php
 /*Template Name: BRL-CAD Main Menu
* Description: The template for documentation.
*/
get_header(); ?>
<div id="content-side">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="row">
				<?php main_menu();?>
			</div>
		</main>
	</div>
</div>
<div id="content-side2">
 	<div class="row">
		<div id="secondary" class="widget-area" role="complementary">
		<?php search_document();?>
			<?php main_menu();?>
		</div>
	</div>
</div>
<?php get_footer();?>

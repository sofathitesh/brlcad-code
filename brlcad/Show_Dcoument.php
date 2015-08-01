 <?php
 /*Template Name: Show Document
* Description: The template for documentation.
*/
      require('wp-blog-header.php'); 
      class MyPost { var $post_title = "About BRL-CAD"; }
      $wp_query->is_home = false;
      $wp_query->is_single = true;
      $wp_query->queried_object = new MyPost();
?>
<link rel="stylesheet" type="text/css" href="jquery.treemenu.css"></link>
<frameset cols="150,*">

<frame src="example_t04a.html" name="side">

<frameset rows="150,*">
<frame src="article/en/main.html" name="top">
<frame src="example_t04c.html" name="main">
</frameset>

<noframes>
<body>
<h1>Frame example page</h1>
<p><a href="index.html">Frame index</a></p>
</body>
</noframes>

</frameset>
<?php
get_footer();
?>
<?php 
/*         S E A R C H - D O C U M E N T . P H P
 * BRL-CAD
 *
 * Copyright (c) 1995-2013 United States Government as represented by
 * the U.S. Army Research Laboratory.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License
 * version 2.1 as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this file; see the file named COPYING for more
 * information.
 */

/**
* Load the Theme style into the page
*/
      require('../../../wp-blog-header.php'); 
      class MyPost { var $post_title = "BRL-CAD MAIN MENU"; }
      $wp_query->is_home = false;
      $wp_query->is_single = true;
      $wp_query->queried_object = new MyPost();
      get_header();
?>
<div id="content-side"><div id="primary" class="content-area"><main id="main" class="site-main" role="main"><div class="row">
<?php
/** 
* This code used for searching the document according to user needs using keywords in file name.
*/ 
    $document_folder = array();
    array_push($document_folder, "articles");
    array_push($document_folder, "books");
    array_push($document_folder, "lessons");
    array_push($document_folder, "man1");
    array_push($document_folder, "man3");
    array_push($document_folder, "man5");
    array_push($document_folder, "mann");
    array_push($document_folder, "presentations");
    array_push($document_folder, "specifications");
    echo " <h1> Your Searched Documents are:-</h1>";
    echo "<ol>";
    global $count;
if ($_POST['s']) {
    foreach ($document_folder as $directory) {
	    $language_directory = scandir("../../../".$directory);
	    foreach ($language_directory as $files_directory) {
	    	if ($files_directory == "." OR $files_directory == '..') {
	    	} else {
	    		$files = scandir("../../../".$directory."/".$files_directory);
    			foreach ($files as $filename) {
	                if ($filename == "." OR $filename == "..") {
	                } else {
	                	$extension = explode(".", $filename);
        	        	if ($extension[1] != "html" and $extension[0] !="images") {
	                		$remove_extension = explode(".", $filename);
        		                if (preg_match("/".strtolower($_POST['s'])."/",strtolower($remove_extension[0]))) {
		                             $count="ok";
                		            echo "<li><a href='".home_url()."/".$directory."/".$files_directory."/".$remove_extension[0].".php'>".$remove_extension[0]."</a></li>";
                        		}
                		}
                	}
    		}
	}
    }
}
}
echo "</ol>";
if ($count == "ok") {
}
else {
    echo "<h1>Nothing Found</h1>";
}
?>	
</div>
</main>
</div>
</div>
<div id="content-side2"><div class="row"><div id="secondary" class="widget-area" role="complementary"></div></div></div>
<?php 
      get_footer(); 
?>
</body>
</html>
<?php
/*
 * Local Variables:
 * mode: PHP
 * tab-width: 8
 * End:
 * ex: shiftwidth=4 tabstop=8
 */
?>
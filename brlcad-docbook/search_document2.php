<!DOCTYPE div PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php 
      require('../../../wp-blog-header.php'); 
      class MyPost { var $post_title = "BRL-CAD MAIN MENU"; }
      $wp_query->is_home = false;
      $wp_query->is_single = true;
      $wp_query->queried_object = new MyPost();
      get_header();
    ?><div id="content-side"><div id="primary" class="content-area"><main id="main" class="site-main" role="main"><div class="row">
<?php
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
if($_POST['document'])
{
foreach ($document_folder as $directory) {
    $language_directory = scandir("../../../".$directory);
    foreach ($language_directory as $files_directory) {
    	if($files_directory == "." OR $files_directory == '..')
    	{
    	}else
    	{
    		$files = scandir("../../../".$directory."/".$files_directory);
    		foreach ($files as $filename)
    		{
                if($filename == "." OR $filename == "..")
                {

                }
                else
                {
                	$extension = explode(".", $filename);
                	if($extension[1] != "html" and $extension[0] !="images")
                	{
                		$remove_extension = explode(".", $filename);
                        if(preg_match("/^".$_POST['document']."/",$remove_extension[0]))
                        {
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
?>	
</div>
</main>
</div>
</div>
<div id="content-side2"><div class="row"><div id="secondary" class="widget-area" role="complementary"><?php 
    ?></div></div></div><?php 
      get_footer(); 
    ?>
</body>
</html>

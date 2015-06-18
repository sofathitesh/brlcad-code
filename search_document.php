<html>
<body>
<form action="<?php echo home_url();?>/search_document2.php" method="post">
	<input list="document" name="document" placeholder="Search Document">
</form>
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
echo "<datalist id='document'>";
foreach ($document_folder as $directory) {
    $language_directory = scandir(dirname(__FILE__)."/".$directory);
    foreach ($language_directory as $files_directory) {
    	if($files_directory == "." OR $files_directory == '..')
    	{
    	}else
    	{
    		$files = scandir(dirname(__FILE__)."/".$directory."/".$files_directory);
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
                		echo "<option value='".$remove_extension[0]."'>";
                	}
                }
    		}

    	}
    }
}
echo "</datalist>";
?>	
</body>
</html>

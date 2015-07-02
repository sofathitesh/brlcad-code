<?php
      require('../../../wp-blog-header.php'); 
?>
<?php
if(isset($_GET['articleget']))
{
	echo file_get_contents("../../../review/".$_GET['articleget']);
}
if(isset($_GET['article']))
{
$filename = explode("/", $_GET['article']);
$length = sizeof($filename);
$file_according_category = explode(wordpress_folder, $_GET['article']);
$filename_in_xml = str_replace("php", "xml",$filename[$length-1]);
$editable_file = str_replace("/", "123", $file_according_category[1]);
if(array_search("man1", $filename) or array_search("man3", $filename) or array_search("man5", $filename) or array_search("mann", $filename))
{
	{
		$editable_file = "123system".$editable_file;
	}
}
echo $editable_file  = str_replace("php", "xml", $editable_file);
xml_edit();
$url = explode(wordpress_folder,$_GET['article']);
$url_with_hash_key = home_url()."/wp-content/plugins/brlcad-docbook/ace.php?article=".$editable_file."#".md5($url[1]);
wp_redirect($url_with_hash_key);
}
if(strlen($_GET['newarticles'])>2 && $_GET['method']=="edit")
{
		submit_editing();
}
if(strlen($_GET['newarticles'])>2 && $_GET['method']=="preview")
{
	login_preview();
}

?>

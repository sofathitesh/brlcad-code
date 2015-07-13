<?php
require_once("config.php");

$dir = glob(brlcad_source.$_POST['catname']."/*", GLOB_ONLYDIR);
foreach ($dir as $language) {
if(is_dir($language))
{
$dir_name = explode("/", $language);
$length = sizeof($dir_name);
if($dir_name[$length-1]=="CMakeFiles")
{

}else
{
	echo "<option value='".$dir_name[$length-1]."'>".$dir_name[$length-1]."</option>";
}
}
}
?>
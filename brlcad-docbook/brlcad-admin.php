<?php
ini_set('default_charset', 'utf-8');
require_once(dirname(__FILE__)."/config.php");
$document_folder = array();
array_push($document_folder, "articles");
array_push($document_folder, "books");
array_push($document_folder, "lessons");
array_push($document_folder, "system/man1");
array_push($document_folder, "system/man3");
array_push($document_folder, "system/man5");
array_push($document_folder, "system/mann");
array_push($document_folder, "presentations");
array_push($document_folder, "specifications");
$count = 0;
$files_array = array();
$directory_name = array();
?>
<form action="<?php echo home_url();?>/wp-admin/admin.php?page=brlcad-docbook%2Fbrlcad-admin.php" method="post">
<div id="searchbox">
    <input list="document" name="document" placeholder="Search Document" type="search">
    </div>
</form>

<?php
echo "<datalist id='document'>";
foreach ($document_folder as $directory) {
    $language_directory = scandir(brlcad_source.$directory);
    foreach ($language_directory as $files_directory) {
        if($files_directory == "." OR $files_directory == '..')
        {
        }else
        {
            if(is_dir(brlcad_source.$directory."/".$files_directory))
            {
            $files = scandir(brlcad_source.$directory."/".$files_directory);
            foreach ($files as $filename)
            {
                if($filename == "." OR $filename == "..")
                {

                }
                else
                {
                    $extension = explode(".", $filename);
                    if($extension[1] == "xml" and $extension[0] !="images")
                    {

                       echo "<option value='".$extension[0]."'>";
                    }
                }
            }
        }

        }
    }
}
echo "</datalist>";
if($_POST['document'])
{
echo "<table class='wp-list-table widefat fixed striped posts'>";
echo "<tr class='inline-edit-row inline-edit-row-post inline-edit-post quick-edit-row quick-edit-row-post inline-edit-post'><th>File name</th><th>Category</th><th>Option</th></tr>";
foreach ($document_folder as $directory) {
    $language_directory = scandir(brlcad_source.$directory);
    foreach ($language_directory as $files_directory) {
        if($files_directory == "." OR $files_directory == '..')
        {
        }else
        {
            if(is_dir(brlcad_source.$directory."/".$files_directory))
            {
            $files = scandir(brlcad_source.$directory."/".$files_directory);
            foreach ($files as $filename)
            {
                if($filename == "." OR $filename == "..")
                {

                }
                else
                {
                    $extension = explode(".", $filename);
                    if($extension[1] == "xml")
                    {
                        $remove_extension = explode(".", $filename);
                        if(preg_match("/^".$_POST['document']."/",$remove_extension[0]))
                        {
                            echo "<form action='".home_url()."/wp-content/plugins/brlcad-docbook/edit.php?&article=".str_replace("system/","",str_replace("docbook",wordpress_folder,brlcad_source.$directory))."/".$files_directory."/".str_replace("xml","php",$filename)."' method='post'>";
                            echo "<tr><td>".$filename."</td><td>".$directory."</td><td><input type='submit' class='button button-primary' value='Edit'></td></tr>";
                            echo "</form>";
                        }
                    }
                }
            }
        }

        }
    }
}
echo "</table>";
}
else
{

foreach ($document_folder as $directory) {
    $language_directory = scandir(brlcad_source.$directory);
    foreach ($language_directory as $files_directory) {
    	if($files_directory == "." OR $files_directory == '..')
    	{
    	}else
    	{
    		if(is_dir(brlcad_source.$directory."/".$files_directory))
    		{
    		$files = scandir(brlcad_source.$directory."/".$files_directory);
    		foreach ($files as $filename)
    		{
                if($filename == "." OR $filename == "..")
                {

                }
                else
                {
                	$extension = explode(".", $filename);
                	if($extension[1] == "xml" and $extension[0] !="images")
                	{
                		$files_array[$count] = $filename;
                		$directory_name[$count] = $directory;
                		$languages[$count] = $files_directory;
                		$count++;
                	}
                }
    		}
    	}

    	}
    }
}
if(isset($_GET['pv']))
{
		$pv = $_GET['pv']*20;
		$pn = $pv + 20;
}
else
{
	$pv = 1;
	$pn =20;
}
echo "<table class='wp-list-table widefat fixed striped posts'>";
echo "<tr class='inline-edit-row inline-edit-row-post inline-edit-post quick-edit-row quick-edit-row-post inline-edit-post'><th>File name</th><th>Category</th><th>Option</th></tr>";
for($pv; $pv<$pn;$pv++)
{
	echo "<form action='".home_url()."/wp-content/plugins/brlcad-docbook/edit.php?&article=".str_replace("system/","",str_replace("docbook",wordpress_folder,brlcad_source.$directory_name[$pv]))."/".$languages[$pv]."/".str_replace("xml","php",$files_array[$pv])."' method='post'>";
	echo "<tr><td>".$files_array[$pv]."</td><td>".$directory_name[$pv]."</td><td><input type='submit' class='button button-primary' value='Edit'></td></tr>";
	echo "</form>";
}
echo "</table>";
$pages = abs(sizeof($files_array)/20);
echo "<table><tr>";
for($i = 0;$i<$pages;$i++)
{
	echo "<td><a href='".home_url()."/wp-admin/admin.php?page=brlcad-docbook%2Fbrlcad-admin.php&pv=".$i."&pn=".$i."' class='button button-primary'>".$i."</a></td>";
}
echo "</tr></table>";
}
?>	
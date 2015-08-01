<?php
      require('../../../wp-blog-header.php'); 
?>
<?php
if(isset($_GET['articleget']))
{
	echo file_get_contents("../../../review/".$_GET['articleget']);
}
if(isset($_GET['new_document']))
{
	echo file_get_contents("../../../new_document/".$_GET['new_document']);
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
$url = explode("docbook",$_GET['article']);
$url_with_hash_key = home_url()."/wp-content/plugins/brlcad-docbook/ace.php?article=".$editable_file."&url=".$_GET['url']."#".md5($url[1]);
wp_redirect($url_with_hash_key);
}
if(strlen($_GET['newarticles'])>2 && $_GET['methods']=="edit")
{
		submit_editing();
}
if(strlen($_GET['newarticles'])>2 && $_GET['methods']=="preview")
{
	login_preview();
}
if(isset($_GET['method']))
{
	new_document_xml_edit();
global $current_user;
get_currentuserinfo();
$editable_file = $current_user->user_login."123".$_POST['s1']."123".$_POST['s2']."123".$_POST['t1'].".xml";
$url_with_hash_key = home_url()."/wp-content/plugins/brlcad-docbook/new_document.php?new_document=".$editable_file."&url=".$_GET['url']."#".md5($_POST['t1']);
	wp_redirect($url_with_hash_key);
}

if($_GET['edit']=="new_document_edit")
{
	echo  $_GET['new_document'];
	new_document_submit_editing($_GET['new_document']);
}
if(strlen($_GET['new_document'])>0 && $_GET['preview']=="preview")
{
	new_document_login_preview();

}
if(strlen($_GET['new_document'])>0 && $_GET['preview_other']=="preview")
{
	new_document_login_preview_for_other_work();

}


if($_GET['submit'])
{
submit();
wp_redirect(home_url()."/wp-admin/admin.php?page=all_document&msg=yes");	
}
if($_GET['delete'])
{
delete_doc();
wp_redirect(home_url()."/wp-admin/admin.php?page=all_document&delete=yes");	
}
if($_GET['delete'] && $_GET['admin'])
{
delete_doc();
wp_redirect(home_url()."/wp-admin/admin.php?page=Review_New_Document&delete=yes");	
}
if($_GET['rename'])
{
rename_new_doc();
wp_redirect(home_url()."/wp-admin/admin.php?page=all_document&rename=yes");	
}
if($_GET['invite'])
{
sent_mails();
wp_redirect(home_url()."/wp-admin/admin.php?page=all_document&invite=yes");	
}
?>

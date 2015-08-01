<?php
/*
Plugin Name:Brlcad-Docbook
Url:hiteshkumarsofat.docbook.com
*/
ini_set('default_charset', 'utf-8');
require_once(dirname(__FILE__)."/config.php");
require_once(dirname(__FILE__)."/brlcad-functions.php");
require_once(dirname(__FILE__)."/brlcad-functions-new-document.php");
add_action("admin_menu","brlcad_menu");
function brlcad_menu(){
add_menu_page('XML files', 'XML Files', 'read', 'brlcad-docbook/brlcad-admin.php', '','', 6 );
add_submenu_page( NULL, 'Review', 'Review', 'manage_options', 'review','review');
add_submenu_page( 'brlcad-docbook/brlcad-admin.php', 'Review Edit', 'Review Edit', 'manage_options', 'review_edit','review_edit');
add_submenu_page( 'brlcad-docbook/brlcad-admin.php', 'New_Document', 'Add New Document', 'read', 'new_document','new_document');
add_submenu_page( 'brlcad-docbook/brlcad-admin.php', 'ALL_Documents', 'All Document', 'read', 'all_document','all_document');
add_submenu_page( NULL, 'Rename', 'Rename', 'read', 'rename','rename_doc');
add_submenu_page( NULL, 'Invite', 'Invite', 'read', 'invite_user','invite_user');
add_submenu_page( NULL, 'cmake', 'cmake', 'manage_options', 'cmake','cmake');
add_submenu_page( NULL, 'add', 'add', 'manage_options', 'add','add');
add_submenu_page( NULL, 'reject', 'reject', 'manage_options', 'reject','reject');
add_submenu_page( NULL, 'delete', 'delete', 'read', 'delete','delete');
add_submenu_page( NULL, 'full_delete', 'full_delete', 'read', 'full_delete','full_delete');
add_submenu_page( 'brlcad-docbook/brlcad-admin.php', 'Review_New_Document', 'Review_New_Document', 'manage_options', 'Review_New_Document','Review_New_Document');
}
function my_script_method()
 {
 	wp_enqueue_script('doc_category',plugins_url('/js/jquery.min.js',__FILE__));
 }

add_action('admin_init','my_script_method');


function review()
{
	if($_GET['dif']=="ok")
	{
		$get_real_file = explode("123", $_GET['newarticles']);
		$length = sizeof($get_real_file);
		$real_name = $get_real_file[$length-1];
		if(array_search("man1", $get_real_file) OR array_search("man3", $get_real_file) OR array_search("man5", $get_real_file) OR array_search("mann", $get_real_file))
		{
			$real_file_with_path = $get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3]."/".$get_real_file[4];
		}
		else
		{
			$real_file_with_path = $get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3];			
		}
		$file = fopen(review_queue_directory.$_GET['newarticles'], "r");
		$data = fread($file, filesize(review_queue_directory.$_GET['newarticles']));
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two, str_replace(brlcad_source,"../../",$data));
		fclose($file_two);
		fclose($file);
		echo "<textarea rows='25' cols='100' readonly>";
		echo "diff -u -b ".brlcad_source.$real_file_with_path." ".review_queue_directory.$_GET['newarticles'];
		echo htmlentities(shell_exec("diff -u -b ".brlcad_source.$real_file_with_path." ".review_queue_directory.$_GET['newarticles']." 2>&1"));
		echo "</textarea>";
		echo "<form action='".home_url()."/wp-admin/admin.php?page=review_edit&newarticles=".$_GET['newarticles']."&dif=yes' method='post'>";
		echo "<br><input  type='submit' value='Accept'></form>";
		echo "<form action='".home_url()."/wp-admin/admin.php?page=review_edit&newarticles=".$_GET['newarticles']."&dif=no&detect=yes' method='post'>";
		echo "<br><input  type='submit' value='Discard'></form>";
	}
}
function review_edit(){
	$get_real_file = explode("123", $_GET['newarticles']);
	$length = sizeof($get_real_file);
	$real_name = $get_real_file[$length-1];
	if(array_search("man1", $get_real_file) OR array_search("man3", $get_real_file) OR array_search("man5", $get_real_file) OR array_search("mann", $get_real_file))
	{
		$real_file_with_path = $get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3]."/".$get_real_file[4];
	}
	else
	{
		$real_file_with_path = $get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3];			
	}
	if($_GET['dif']=='yes')
	{	
		if(array_search("man1", $get_real_file) OR array_search("man3", $get_real_file) OR array_search("man5", $get_real_file) OR array_search("mann", $get_real_file))
		{
			shell_exec("diff -u -b ".brlcad_source.$real_file_with_path." ".review_queue_directory.$_GET['newarticles']. "> "  .brlcad_source.$get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3]."/".str_replace("xml", "patch", $real_name));
			shell_exec("patch ".brlcad_source.$real_file_with_path." < ".brlcad_source.str_replace("xml", "patch", $real_file_with_path)." ");
			shell_exec("rm -r ".review_queue_directory.$_GET['newarticles']);
			shell_exec("rm -r ".brlcad_source.str_replace("xml", "patch", $real_file_with_path));
			echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Changes has applied</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
		}
		else
		{
			shell_exec("diff -u -b ".brlcad_source.$real_file_with_path." ".review_queue_directory.$_GET['newarticles']. "> "  .brlcad_source.$get_real_file[1]."/".$get_real_file[2]."/".str_replace("xml", "patch", $real_name));
			shell_exec("patch ".brlcad_source.$real_file_with_path." < ".brlcad_source.str_replace("xml", "patch", $real_file_with_path)." ");
			shell_exec("rm -r ".review_queue_directory.$_GET['newarticles']);
			shell_exec("rm -r ".brlcad_source.str_replace("xml", "patch", $real_file_with_path));
			echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Changes has applied</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
		}
	}
	elseif($_GET['dif']=='no')
	{
			shell_exec("rm -r ".review_queue_directory.$_GET['newarticles']);
			shell_exec("rm -r ".brlcad_source.str_replace("xml", "patch", $real_file_with_path));
			echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Changes has discarded</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
	}
	else
	{
		echo "<table class='wp-list-table widefat fixed striped posts'>";
		echo "<tr class='inline-edit-row inline-edit-row-post inline-edit-post quick-edit-row quick-edit-row-post inline-edit-post'><th>File name</th><th>Option</th></tr>";

		$review_dir = scandir(review_queue_directory);
		$edit_files_name = array();
		$edit_files = array();
		$count = 0;
		foreach ($review_dir as $name) 
		{
			if(is_dir($name))
			{

			}
			else
			{
				$get_real_file = explode("123", $name);
				$length = sizeof($get_real_file);
				$real_name = $get_real_file[$length-1];
				if(array_search("man1", $get_real_file) OR array_search("man3", $get_real_file) OR array_search("man5", $get_real_file) OR array_search("mann", $get_real_file))
				{
				 	$real_file_with_path = $get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3]."/".$get_real_file[4];
				}
				else
				{
					$real_file_with_path = $get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3];			
				}
				$file = fopen(review_queue_directory.$name, "r");
				$data = fread($file, filesize(review_queue_directory.$name));
				$file_two = fopen(review_queue_directory.$name,"w+");
				$file_two_data = fwrite($file_two, str_replace(brlcad_source,"../../",$data));
				fclose($file_two);
				fclose($file);
				if(strlen(shell_exec("diff -u -b ".brlcad_source.$real_file_with_path." ".review_queue_directory.$name))=="")
				{
					shell_exec("rm -r ".review_queue_directory.$name);
				}
				elseif(strlen(shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$name." 2>&1"))>100)
				{
                    shell_exec("rm -r ".review_queue_directory.$name);
				}
				else
				{
					$filename_of_original_file = explode("-*", $name);
					$length = sizeof($filename_of_original_file);
					if(strpos($name, "xml"))
					{
						$edit_files[$count] = $name;
						$count++;
					}
				}
			}

		}
		echo "</table>";
		echo "<table class='wp-list-table widefat fixed striped posts'>";
		if(isset($_GET['pv']))
		{
			$pv = $_GET['pv']*10;
			$pn = $pv + 10;			
		}
		else
		{
			$pv = 1;
			$pn =10;
		}
		for($pv; $pv<$pn;$pv++)
		{
			if(isset($edit_files[$pv]))
			{
				echo "<tr><td>".str_replace("123","_",$edit_files[$pv])."</td><td><a href='".home_url()."/wp-admin/admin.php?page=review&newarticles=".$edit_files[$pv]."&dif=ok' class='button button-primary'>Review</a></td></tr>";
			}
		}
		echo "</table>";
		$pages = abs(sizeof($edit_files)/10);
		echo "<table><tr>";
		for($i = 0;$i<$pages;$i++)
		{
			echo "<td><a href='".home_url()."/wp-admin/admin.php?page=review_edit&pv=".$i."&pn=".$i."' class='button button-primary'>".$i."</a></td>";
		}
		echo "</tr></table>";
		}
	
}

/*Without Login Edit Logic*/

function xml_edit(){
	if(strlen($_GET['article'])>2)	
	{
		$filename = explode("/", $_GET['article']);
		$length = sizeof($filename);
		$file_according_category = explode(wordpress_folder, $_GET['article']);
		$filename_in_xml = str_replace("php", "xml",$filename[$length-1]);
		$editable_file = str_replace("/", "123", $file_according_category[1]);
		if(!$_GET['detect'])
		{
	 		if(array_search("man1", $filename) or array_search("man3", $filename) or array_search("man5", $filename) or array_search("mann", $filename))
	 		{
	 			$editable_file = "123system".$editable_file;
	 		}
	 	}
		$editable_file  = str_replace("php", "xml", $editable_file);
		if(file_exists(review_queue_directory.$_GET['article']))
		{
			$original_file = explode("123", $editable_file);
			for($i = 1; $i < sizeof($original_file); $i++)
			{
				$file_path =$file_path.$original_file[$i]."/"; 
			}
			$original_filename = str_replace("xml/", "xml", $file_path);
			$file = fopen(review_queue_directory.$_GET['article'], "r");
			$data = fread($file, filesize(review_queue_directory.$_GET['article']));
			$file_two = fopen(review_queue_directory.$_GET['article'],"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", brlcad_source,$data));
//			echo str_replace("../../", brlcad_source,htmlentities($data));
			fclose($file);
			fclose($file_two); 
		}else
		{
			$original_file = explode("123", $editable_file);
			for($i = 1; $i < sizeof($original_file); $i++)
			{
		echo		$file_path =$file_path.$original_file[$i]."/"; 
			}
			$original_filename = str_replace("xml/", "xml", $file_path);
			echo "cp ".brlcad_source.$original_filename." ".review_queue_directory.$editable_file;
			shell_exec("cp ".brlcad_source.$original_filename." ".review_queue_directory.$editable_file);
			$file = fopen(brlcad_source.$original_filename, "r");
			$data = fread($file, filesize(brlcad_source.$original_filename));
			$file_two = fopen(review_queue_directory.$editable_file,"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", brlcad_source,$data));
//			echo str_replace("../../", brlcad_source,htmlentities($data));
			fclose($file);
			setcookie("filename",$editable_file,time()+(60*40));
			setcookie("filenameexit",$_GET['article'],time()+(60*40));			
			fclose($file_two); 
		}
	}
	if(strlen($_GET['newarticles'])>2)
	{
		if($_POST['submit'])
		{
			submit_editing();
		}
		if($_POST['preview'])
		{
			login_preview();
		}
	}
	if(isset($_GET['msg']))
	{
		echo "Thanks for contribution in our documents your changes is under review";
	}
}

function new_document(){
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<script type="text/javascript">
$(document).ready(function(){
$("#s1").change(function(){
$.post("<?php echo plugins_url('language.php',__FILE__);?>",{catname:$("#s1").val()}).done(function(data){
	$("#s2 option").remove();
$("#s2").append(data);
});
});
});
</script>

<form action="<?php echo plugins_url('edit.php',__FILE__);?>?method=new_document&url=<?php echo $url;?>" method='post'>
<table>
	<tr>
		<td>Document Name</td>
		<td><input type="text" name="t1" required>(use underscope in filename)</td>
	</tr>
	<tr>
	<td>Select Category</td>
	<td><select name="s1" required id="s1">
	<option>.............</option>
	<option value='articles'>Articles</option>
	<option value='books'>Books</option>
	<option value='lessons'>Lessons</option>
	<option value='system/man1'>Man 1</option>
	<option value='system/man3'>Man 3</option>
	<option value='system/man5'>Man 5</option>
	<option value='system/mann'>Mann</option>
	<option value='presentations'>Presentations</option>
	<option value='specifications'>Specifications</option>
	</select></td>
	</tr>
	<tr>
	<td>Select Language</td>
	<td><select name="s2" id="s2" required></select>(Supported language are:- en,es,it,hy,ru)</td>
	</tr>
	<tr>
	<td><input type="submit" name="Create" value="Create"></td>
	</tr>
</table> 
</form>
<?php
}

function new_document_xml_edit(){
	global $current_user;
	get_currentuserinfo();
	if(strlen($_POST['t1'])>0)	
	{

 		$editable_file  = $current_user->user_login."123".$_POST['s1']."123".$_POST['s2']."123".$_POST['t1'].".xml";
		if(file_exists(new_document_directory.$editable_file))
		{
			$file_two = fopen(new_document_directory.$editable_file,"w+"); 
			fclose($file_two); 
		}else
		{
			if($_POST['s1']=="books")
			{
				$file_two = fopen(new_document_directory."book_template.xml","r");
				$data = fread($file_two, filesize(new_document_directory."book_template.xml"));
				fclose($file_two); 				
				$file_two = fopen(new_document_directory.$editable_file,"w+");
				$fwrite = fwrite($file_two, $data);
				fclose($file_two); 
			}else
			{
				$file_two = fopen(new_document_directory."all_template.xml","r") or die("not open");
				$data = fread($file_two, filesize(new_document_directory."all_template.xml"));
				fclose($file_two); 				
				$file_two = fopen(new_document_directory.$editable_file,"w+");
				$fwrite = fwrite($file_two, $data);
				fclose($file_two); 
			}
		}
	}
	if(strlen($_GET['new_document'])>2)
	{
		if($_POST['submit'])
		{
			new_document_submit_editing();
		}
		if($_POST['preview'])
		{
			new_document_login_preview();
		}
	}
	if(isset($_GET['msg']))
	{
		echo "Thanks for contribution in our documents your changes is under review";
	}
}

function all_document()
{
	$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	if($_GET['msg'])
	{
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully Submit </p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
	}
	if($_GET['delete'])
	{
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully Delete </p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
	} 
	if($_GET['rename'])
	{
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully renamed </p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
	}
	if($_GET['invite'])
	{
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Emails successfully Sent </p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
	}
	global $current_user;
	get_currentuserinfo();
echo "<table class='wp-list-table widefat fixed striped posts'>";
echo "<tr class='inline-edit-row inline-edit-row-post inline-edit-post quick-edit-row quick-edit-row-post inline-edit-post'><th>File name</th><th>Category</th><th>Language</th><th>Submit for Review</th><th>Edit</th>
<th>Invitations</th>
<th>Rename</th>
<th>Delete</th></tr>";
 $language_directory = scandir(new_document_directory);
    foreach ($language_directory as $files_directory) {
                if($files_directory == "." OR $files_directory == "..")
                {

                }
                else
                {
                $extension = explode(".", $files_directory);
                if($extension[1] == "xml")
                {
                	$user = explode("123", $files_directory); 
                	$length = sizeof($user);
                   if($current_user->user_login == $user[0])
                {
                    echo "<form action='".plugins_url()."/brlcad-docbook/edit.php?submit=".$files_directory."' method='post'><tr><td>".$user[$length-1]."</td><td>".$user[1]."</td><td>".$user[2]."</td><td><input type='submit' class='button button-primary' value='Submit For Review'></td></form>
                    <form action='".plugins_url()."/brlcad-docbook/new_document.php?new_document=".$files_directory."&url=".$url."' method='post'><td><input type='submit' class='button button-primary' value='Edit'></td></form>
                    <form action='".home_url()."/wp-admin/admin.php?page=invite_user&new_document=".$files_directory."' method='post'><td><input type='submit' class='button button-primary' value='Invite users'></td></form>
                    <form action='".home_url()."/wp-admin/admin.php?page=rename&new_document=".$files_directory."' method='post'><td><input type='submit' class='button button-primary' value='Rename'></td></form>
                    <form action='".plugins_url()."/brlcad-docbook/edit.php?delete=".$files_directory."' method='post'><td><input type='submit' class='button button-primary' value='Delete'></td></form></tr>";
                    echo "</form>";
                }
            }
        }
    
	}
echo "</table>";
}

function rename_doc(){
$filename = explode("123", $_GET['new_document']);
$length = sizeof($filename);

?>

<form action="<?php echo home_url();?>/wp-content/plugins/brlcad-docbook/edit.php?rename=<?php echo $_GET['new_document'];?>" method="post">
<input type="text" name='rename' value="<?php echo $filename[$length-1];?>">
<input type="submit" name='r' value="Submit">
</form>
<?php
}
function invite_user()
{
$filename = explode("123", $_GET['new_document']);
$length = sizeof($filename);
$url_with_hash_key = home_url()."/wp-content/plugins/brlcad-docbook/new_document.php?new_document=".$_GET['new_document']."#".md5($filename[$length-1]);

	?>
	<form action="<?php echo home_url();?>/wp-content/plugins/brlcad-docbook/edit.php?invite=<?php echo $_GET['new_document'];?>" method="post">
	<table>
		<tr>
			<td>Email Id's</td><td><input type='text' name='email' required>(please use comma between the Email id's)</td>
		</tr>
		<tr>
			<td>Message</td><td><textarea name='t1' rows="15" cols="100"><?php echo $url_with_hash_key ?></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" value="Send"></td>
		</tr>
	</table>
	</form>
	<?php

}
function Review_New_Document()
{
	if($_GET['delete'])
	{
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully Delete </p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
	}
	if($_GET['email'])
	{
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Mail successfully Send to user </p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
	}
echo "<table class='wp-list-table widefat fixed striped posts'>";
echo "<tr class='inline-edit-row inline-edit-row-post inline-edit-post quick-edit-row quick-edit-row-post inline-edit-post'><th>File name</th><th>Category</th><th>Language</th><th>Preview</th>
<th>Delete</th>
<th>Accept</th>
<th>Reject</th>
</tr>";
 $language_directory = scandir(new_document_directory);
    foreach ($language_directory as $files_directory) {
                if($files_directory == "." OR $files_directory == "..")
                {

                }
                else
                {
                $extension = explode(".", $files_directory);
                if($extension[1] == "xml")
                {
                	$user = explode("123", $files_directory); 
                	$length = sizeof($user);
                   if("submit" == $user[0])
                {
                    echo "<form action='".plugins_url()."/brlcad-docbook/edit.php?preview_other=preview&new_document=".$files_directory."' method='post'><tr><td>".$user[$length-1]."</td><td>".$user[2]."</td><td>".$user[3]."</td><td><input type='submit' class='button button-primary' value='Preview'></td></form>
                    <form action='".plugins_url()."/brlcad-docbook/edit.php?delete=".$files_directory."&admin=yes' method='post'><td><input type='submit' class='button button-primary' value='Delete'></td></form>
                    <form action='".home_url()."/wp-admin/admin.php?page=cmake&file=".$files_directory."' method='post'><td><input type='submit' class='button button-primary' value='Accpet'></td></form>
                    <form action='".home_url()."/wp-admin/admin.php?page=reject&file=".$files_directory."' method='post'><td><input type='submit' class='button button-primary' value='Reject'></td>
                    </form></tr>";
                    echo "</form>";
                }
            }
        }
    
	}
echo "</table>";
}
function cmake(){
	$get_cmakefile_path = explode("123", $_GET['file']);
	shell_exec("cp ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.txt"." ".new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt");
	$cmake_file_open = fopen(new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt","r");
	$cmake_read = fread($cmake_file_open, filesize(new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt"));
	echo "<form action='".home_url()."/wp-admin/admin.php?page=add&file=".$_GET['file']."' method='post'>";
	echo "<textarea cols='60' rows='25' name='update_cmake'>".$cmake_read."</textarea><br>";
	echo "<input type='submit' value='Add'>";
	fclose($cmake_file_open);
}
function add(){
	$get_cmakefile_path = explode("123", $_GET['file']);
	$length = sizeof($get_cmakefile_path);
	$write_cmake_file = fopen(new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt", "w+");
	$write = fwrite($write_cmake_file, $_POST['update_cmake']);
	fclose($write_cmake_file);
	shell_exec("mv ".new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt"." ".new_document_directory."CMakeLists.txt");
	shell_exec("diff -u -b ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.txt"." ".new_document_directory."CMakeLists.txt". "> "  .brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.patch");
	shell_exec("patch ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.txt"." < ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.patch"." ");
	shell_exec("mv ".new_document_directory.$_GET['file']." ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[$length-1]);
	shell_exec("svn add ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[$length-1]);
	shell_exec("rm -r ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.patch");
	shell_exec("rm -r ".new_document_directory.$_GET['file']);
	shell_exec("rm -r ".new_document_directory.str_replace(".xml", ".html", $_GET['file']));
	shell_exec("rm -r ".new_document_directory."CMakeLists.txt");
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully Added </p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
}
function reject(){
	global $current_user;
	get_currentuserinfo();
	if(isset($_POST['send']))
	{
		mail($_POST['t1'],$_POST['t2'],$_POST['t3']);
		wp_redirect(home_url()."/wp-admin/admin.php?page=Review_New_Document&email=yes");
	}
shell_exec("mv ".new_document_directory.$_GET['file']." ".new_document_directory.str_replace("submit123","",$_GET['file']));
$connect  = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
mysql_select_db(DB_NAME,$connect);
$result = mysql_query("select * from wp_users where user_login='".$current_user->user_login."'");
$data = mysql_fetch_array($result);
echo "<h4>Reply to user write down reason for reject document or any error</h4>";
echo "<form action='' method='Post'><table><tr>
		<td>Email-id</td><td><input type='email' name='t1' value=".$data['user_email']."></td></tr><tr>
		<td>Subject</td><td><input type='text' name='t2'></td></tr>
		<td>Message</td><td><textarea cols='40' rows='20' name='t3'>Message</textarea></td>
		</tr><tr><td><input type='submit' value='Send Mail' name='send'></td></tr></table></form>";

}
function delete(){
echo "<h3>Please remove the name of file from CMakeLists file</h3>";
$cmake = explode("/", $_GET['article']);
$length = sizeof($cmake);
echo "<form action='".home_url()."/wp-admin/admin.php?page=full_delete&article=".$_GET['article']."' method='Post'>";
$cmake_file = str_replace($cmake[$length-1], "CMakeLists.txt", $_GET['article']);
shell_exec("cp ".$cmake_file." ".review_queue_directory.str_replace("/","123",$cmake_file));
$cmake_open = fopen(review_queue_directory.str_replace("/", "123", $cmake_file),"r");
$file_data = fread($cmake_open, filesize($cmake_file));
echo "<textarea cols='60' rows='20' name='data'>".$file_data."</textarea> <br> ";
fclose($cmake_open);
echo "<input type='submit' value='Delete'>";
}

function full_delete( ){ 
$cmake = explode("/", $_GET['article']);
$length = sizeof($cmake);
$cmake_file = str_replace($cmake[$length-1], "CMakeLists.txt", $_GET['article']);
$cmake_open = fopen(review_queue_directory.str_replace("/", "123", $cmake_file),"w+");
$file_data = fwrite($cmake_open, $_POST['data']);
fclose($cmake_open);
shell_exec("diff -u -b ".$cmake_file." ".review_queue_directory.str_replace("/", "123",$cmake_file). "> "  .str_replace("CMakeLists.txt","",$cmake_file)."CMakeLists.patch");
shell_exec("patch ".$cmake_file." < ".str_replace("CMakeLists.txt", "CMakeLists.patch", $cmake_file)." ");
shell_exec("rm -r ".str_replace("CMakeLists.txt", "CMakeLists.patch", $cmake_file));
shell_exec("rm -r ".review_queue_directory.str_replace("/", "123", $cmake_file));
shell_exec("rm -r ".$_GET['article']);
shell_exec("svn remove ".$_GET['article']);
echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully Deleted </p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
}
?>

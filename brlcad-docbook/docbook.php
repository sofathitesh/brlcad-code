<?php
/*
Plugin Name:Brlcad-Docbook
Url:hiteshkumarsofat.docbook.com
*/
ini_set('default_charset', 'utf-8');
require_once(dirname(__FILE__)."/config.php");
require_once(dirname(__FILE__)."/brlcad-functions.php");
add_action("admin_menu","brlcad_menu");
function brlcad_menu(){
add_menu_page('XML files', 'XML Files', 'read', 'brlcad-docbook/brlcad-admin.php', '','', 6 );
add_submenu_page( NULL, 'Review', 'Review', 'manage_options', 'review','review');
add_submenu_page( 'brlcad-docbook/brlcad-admin.php', 'Review Edit', 'Review Edit', 'manage_options', 'review_edit','review_edit');
}

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
		echo "<table class='wp-list-table widefat fixed striped posts'><tr>
	        	<th>Filename</th>
	        	<th>Option</th>
	        	</tr>";
		$review_dir = scandir(review_queue_directory);
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
				$file_two_data = fwrite($file_two, str_replace("../../", brlcad_source,$data));
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
	        			echo "<tr>
	        			<td>".str_replace("123","-",$filename_of_original_file[$length-1])."</td>
						<td>
							<a href='".home_url()."/wp-admin/admin.php?page=review&newarticles=".$name."&dif=ok' class='button button-primary'>Review</a>
						</td>
						</tr>";					
					}
				}
			}
		}
	echo "</table>";

	}	
}

/*Without Login Edit Logic*/

function xml_edit(){
	if(strlen($_GET['article'])>2)	
	{
	
		$filename = explode("/", $_GET['article']);
		$length = sizeof($filename);
		$file_according_category = explode(wordpress_folder, $_GET['article']);
		print_r($file_according_category);
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
			shell_exec("cp ".brlcad_source.$original_filename." ".review_queue_directory.$editable_file);
			$file = fopen(brlcad_source.$original_filename, "r");
			$data = fread($file, filesize(brlcad_source.$original_filename));
			$file_two = fopen(review_queue_directory.$editable_file,"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", brlcad_source,$data));
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
?>

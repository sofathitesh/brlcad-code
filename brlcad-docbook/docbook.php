<?php
/*         D O C B O O K . P H P
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
* @mainpage Description about project
* @author Hitesh Sofat (Nouhra)
* @section Introduction
BRL-CAD has more than a million words of documentation (thousands of pages) in a variety of formats. We have a long-term goal to consolidate as much as possible into the Docbook format so that it can be more directly managed by our revision control system and integrated with the source code. At the same time, we have a user-editable pages that is really easy for users and developers a like to keep up to date. The two, however, are not immediately compatible with one another. Data is not shared or synchronized.
The main goal of this project would be to synchronize the two so that edits to either are reflected in the other without loss of data. One of the main challenges is how to retain the more expressive Docbook markup within Website so that edits via the pages are not "dumbed down" to the more simple Mediawiki syntax.

The initial thoughts on our end are to implement a wordpresss Plugin that understands how to translate to/from the Docbook format that faithfully preserves all Docbook tagging. You're welcome to suggest another approach.

A great starting point for this project are our existing command sets for BRL-CAD and MGED (our main geometry editor). They respectively constitute approximately 400 and 700 commands that have a page of documentation each.
* 
* @section Requirements
* @subsection Procedure 
1) Install Apache server

2) Install window or Linux

3) Install Mysql Database

4) Install Wordpress
*
* @section Setup Project on your server
*
* @subsection Procedure
1) Download the code using "git clone command"

2) Copy these plugins "brlcad-docbook" , "google_Language_Translator" folder to your wordpress plugin directroy ex:- wordpress/wp-content/plugins/

3) Copy the "brlcad" folder to Theme directroy of wordpress ex:- wordpress/wp-content/themes/

4) Download the brlcad code using this command

svn checkout https://svn.code.sf.net/p/brlcad/code/brlcad/trunk brlcad_resource

5) Copy the copy_document.sh script file to brlcad resource code "brlcad_resource"
* 
* @section Now for activating the theme and plugin
*
* @subsection Procedure
1) Open your wordpress account as wordpress admin

2) Go in plugin section and click on active brlcad-docbook, google_Language_Translator plugin

3) Go in appearance and then click on theme.

4) Now click on brlcad theme active button so then your theme is activated.
* 
* @section Now for plugin settings
* @subsection Procedure
 1) Go to plugin directory

 "wordpress/wp-content/plugins/brlcad-docbook"

 2) open config.php file

 3) Set you brlcad source code path

 4) set your review directory path (which are placed in wordpress folder if there is not placed then make one directory there and set the name of directory is review)

 5) Set your "new_document" directory path which are placed in wordpress root. ex:- wordpress/new_document/ 
*
* @section Now for copy_document.sh script settings.
* @subsection Procedure
1) Copy the script and place in brlcad source folder ex:- mybrlcadsource/brlcad/trunk/

2) Open copy_document.sh in editor and do some settings

3) set the brlcad source code directory path

4) set the wordpress directory path
*
* @section How to run the project
* @subsection Procedure
1) give appropriate permissions to copy_document.sh file using: chmod 775 copy_document.sh

2) run ./copy_document.sh

3) Open wordpress control Panal. Click on create new Page and make the new page.

4) Select "BRL-CAD Manual" theme for new page which you created. From "page Attributes section".

5) Click on settings and click on "Reading" under the setting section.

6) Click on static page option and set your new created page as default "front page".

7) Now make the two folder with these names "review" and "new_document" in your wordpress root forlder. ex:- wordpress/

8) Copy the these xml files from resource which you downloaded from github "all_template.xml" and "book_template.xml" into new_document folder.

9) open you browser and type link like:-  
*
http://servername/wordpress_folder_name/articles/en/about.php
*
Here servername can be replaced with localhost if you are trying to run the project on your own computer.
*/
/*
Plugin Name:Brlcad-Docbook
Url:hiteshkumarsofat.wordpress.com
*/

/**
* @file brlcad-docbook/docbook.php
*
*/
/**
* @details This file contains the all function which are used for wordpress integration as well as docbook work
 Include the header files for using different functions like brlcad-functions.php for read & write the data in files Search the files from   directories so I am using this files for this purpose.
 Next files is stroe the configurations settings  for plugin and brlcad resources
 Next header files stroe the function for new document read and write
*
* @file
* @ingroup Plugins
* @author Hitesh Sofat (Nouhra)
*/ 

ini_set('default_charset', 'utf-8');
require_once(dirname(__FILE__)."/config.php");
require_once(dirname(__FILE__)."/brlcad-functions.php");
require_once(dirname(__FILE__)."/brlcad-functions-new-document.php");

/**
* @param admin_menu, brlcad_menu are the parameters for this function. 
* This function used for adding new feature in wordpress control panel and also create the control panel for our plugin 
* These function also used for adding menu oprions in wordpress menu.
*/

add_action("admin_menu","brlcad_menu");

function brlcad_menu() {
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
    add_submenu_page( NULL, 'edit_menu', 'edit_menu', 'read', 'edit_menu','edit_menu');
    add_submenu_page( 'brlcad-docbook/brlcad-admin.php', 'Review_New_Document', 'Review_New_Document', 'manage_options',    'Review_New_Document','Review_New_Document');
}

/**
* @fn my_script_method() is function used for adding scritp file in wordpress.
* This function used for adding the new javascript file in plugin 
*/

function my_script_method() {
    wp_enqueue_script('doc_category',plugins_url('/js/jquery.min.js',__FILE__));
}
add_action('admin_init','my_script_method');

/**
* @fn review() This function cantains the logic of form. With help admin see the changes.
* This function made the interface for admin to see the all changes which are done by user.
*/
function review() 
{
    if ($_GET['dif'] == "ok") {
	$get_real_file = explode("123", $_GET['newarticles']);
	$length = sizeof($get_real_file);
	$real_name = $get_real_file[$length-1];
	if (array_search("man1", $get_real_file) OR array_search("man3", $get_real_file) OR array_search("man5", $get_real_file) OR array_search("mann", $get_real_file)) {
		$real_file_with_path = $get_real_file[0]."/".$get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3];
	} else {
		$real_file_with_path = $get_real_file[0]."/".$get_real_file[1]."/".$get_real_file[2];			
	}
	$file = fopen(review_queue_directory.$_GET['newarticles'], "r");
	$data = fread($file, filesize(review_queue_directory.$_GET['newarticles']));
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$file_two_data = fwrite($file_two, str_replace(brlcad_source,"../../",$data));
	fclose($file_two);
	fclose($file);
	echo "<div><textarea rows = '25' cols = '100' readonly>";
	echo htmlentities(shell_exec("diff -u -b ".brlcad_source.$real_file_with_path." ".review_queue_directory.$_GET['newarticles']." 2>&1"));
	echo "</textarea>";
	echo "<form action = '".home_url()."/wp-admin/admin.php?page=review_edit&newarticles=".$_GET['newarticles']."&dif=yes' method = 'post'>";
	echo "<br><input  type = 'submit' value = 'Accept'></form>";
	echo "<form action = '".home_url()."/wp-admin/admin.php?page=review_edit&newarticles=".$_GET['newarticles']."&dif=no&detect = yes' method = 'post'>";
	echo "<br><input type = 'submit' value = 'Discard'></form></div>";
	}
}

/**
* @fn review_edit() 
* This function used for review the changes which are done by user.
* This function also made the patches for changes and allpied the patch on original file
* This function also provide interface to admin with admin see the all patches 
* This function also hold the delete operations After patch applied the patch file automatically deleted and edit file also.
*/

function review_edit() 
{
    $get_real_file = explode("123", $_GET['newarticles']);
    $length = sizeof($get_real_file);
    $real_name = $get_real_file[$length-1];
    if (array_search("man1", $get_real_file) OR array_search("man3", $get_real_file) OR array_search("man5", $get_real_file) OR array_search("mann", $get_real_file)) {
	$real_file_with_path = $get_real_file[0]."/".$get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3];
    } else {
	$real_file_with_path = $get_real_file[0]."/".$get_real_file[1]."/".$get_real_file[2];			
    }
    if ($_GET['dif'] == 'yes') {	
	if (array_search("man1", $get_real_file) OR array_search("man3", $get_real_file) OR array_search("man5", $get_real_file) OR array_search("mann", $get_real_file)) {
		shell_exec("diff -u -b ".brlcad_source.$real_file_with_path." ".review_queue_directory.$_GET['newarticles']. "> "  .brlcad_source.$get_real_file[0]."/".$get_real_file[1]."/".$get_real_file[2]."/".str_replace("xml", "patch", $real_name));
		shell_exec("patch ".brlcad_source.$real_file_with_path." < ".brlcad_source.str_replace("xml", "patch", $real_file_with_path)." ");
		shell_exec("rm -r ".review_queue_directory.$_GET['newarticles']);
		shell_exec("rm -r ".brlcad_source.str_replace("xml", "patch", $real_file_with_path));
		echo "<div id = 'message' class = 'updated notice notice-success is-dismissible below-h2'><p>Changes has applied</p><button type = 'button' class = 'notice-dismiss'><span class = 'screen-reader-text'>Dismiss this notice.</span></button></div>";
		} else {
		shell_exec("diff -u -b ".brlcad_source.$real_file_with_path." ".review_queue_directory.$_GET['newarticles']. "> "  .brlcad_source.$get_real_file[0]."/".$get_real_file[1]."/".str_replace("xml", "patch", $real_name));
		shell_exec("patch ".brlcad_source.$real_file_with_path." < ".brlcad_source.str_replace("xml", "patch", $real_file_with_path)." ");
		shell_exec("rm -r ".review_queue_directory.$_GET['newarticles']);
		shell_exec("rm -r ".brlcad_source.str_replace("xml", "patch", $real_file_with_path));
		echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Changes has applied</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
		}
    } elseif($_GET['dif'] == 'no') {
	shell_exec("rm -r ".review_queue_directory.$_GET['newarticles']);
	shell_exec("rm -r ".brlcad_source.str_replace("xml", "patch", $real_file_with_path));
	echo "<div id = 'message' class = 'updated notice notice-success is-dismissible below-h2'><p>Changes has discarded</p><button type = 'button' class = 'notice-dismiss'><span class = 'screen-reader-text'>Dismiss this notice.</span></button></div>";
    } else {
	echo "<table class = 'wp-list-table widefat fixed striped posts'>";
	echo "<tr class = 'inline-edit-row inline-edit-row-post inline-edit-post quick-edit-row quick-edit-row-post inline-edit-post'><th>File name</th><th>Option</th></tr>";
	$review_dir = scandir(review_queue_directory);
	$edit_files_name = array();
	$edit_files = array();
	$count = 0;
	foreach ($review_dir as $name) {
	    if (is_dir($name)) {

	    } else {
		$get_real_file = explode("123", $name);
		$length = sizeof($get_real_file);
		$real_name = $get_real_file[$length-1];
		if (array_search("man1", $get_real_file) OR array_search("man3", $get_real_file) OR array_search("man5", $get_real_file) OR array_search("mann", $get_real_file)) {
			$real_file_with_path = $get_real_file[0]."/".$get_real_file[1]."/".$get_real_file[2]."/".$get_real_file[3];
		} else {
			$real_file_with_path = $get_real_file[0]."/".$get_real_file[1]."/".$get_real_file[2];			
			}
			$file = fopen(review_queue_directory.$name, "r");
			$data = fread($file, filesize(review_queue_directory.$name));
			$file_two = fopen(review_queue_directory.$name,"w+");
			$file_two_data = fwrite($file_two, str_replace(brlcad_source,"../../",$data));
			fclose($file_two);
			fclose($file);
			if (strlen(shell_exec("diff -u -b ".brlcad_source.$real_file_with_path." ".review_queue_directory.$name)) == "")
			{
				shell_exec("rm -r ".review_queue_directory.$name);
			} else {
				$filename_of_original_file = explode("-*", $name);
				$length = sizeof($filename_of_original_file);
				if(strpos($name, "xml")){
					$edit_files[$count] = $name;
					$count++;
				}
			}
		}

	}
	echo "</table>";
	echo "<table class = 'wp-list-table widefat fixed striped posts'>";
	if(isset($_GET['pv'])){
	    $pv = $_GET['pv']*10;
	    $pn = $pv + 10;			
	} else {
	    $pv = 0;
	    $pn = 10;
	}
	for($pv; $pv < $pn; $pv++){
	    if (isset($edit_files[$pv])){
	    echo "<tr><td>".str_replace("123","_",$edit_files[$pv])."</td><td><a href='".home_url()."/wp-admin/admin.php?page=review&newarticles=".$edit_files[$pv]."&dif=ok' class = 'button button-primary'>Review</a></td></tr>";
	}
    }
    echo "</table>";
    $pages = abs(sizeof($edit_files)/10);
    echo "<table><tr>";
    for ($i = 0;$i<$pages;$i++){
	echo "<td><a href = '".home_url()."/wp-admin/admin.php?page=review_edit&pv=".$i."&pn=".$i."' class='button button-primary'>".$i."</a></td>";
    }
    echo "</tr></table>";
    }
	
}

/**
* This function used for editing the file
* This function used for create the new file for editing
*/

function xml_edit() 
{
    if (strlen($_GET['article']) > 2){
	$filename = explode("/", $_GET['article']);
	$length = sizeof($filename);
	$file_according_category = $filename[$length-3]."/".$filename[$length-2]."/".$filename[$length-1];
	$filename_in_xml = str_replace("php", "xml",$filename[$length-1]);
	$editable_file = str_replace("/", "123", $file_according_category);
	if (!$_GET['detect']) {
	 	if (array_search("man1", $filename) or array_search("man3", $filename) or array_search("man5", $filename) or array_search("mann", $filename)) {
	 		$editable_file = "system123".$editable_file;
	 	}
	 }
	$editable_file  = str_replace("php", "xml", $editable_file);
	if (file_exists(review_queue_directory.$_GET['article'])) {
		$original_file = explode("123", $editable_file);
		for ($i = 1; $i < sizeof($original_file); $i++) {
			$file_path =$file_path.$original_file[$i]."/"; 
		}
		$original_filename = str_replace("xml/", "xml", $file_path);
		$file = fopen(review_queue_directory.$_GET['article'], "r");
		$data = fread($file, filesize(review_queue_directory.$_GET['article']));
		$file_two = fopen(review_queue_directory.$_GET['article'],"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", brlcad_source,$data));
		fclose($file);
		fclose($file_two); 
		} else {
		$original_file = explode("123", $editable_file);
		for ($i = 0; $i < sizeof($original_file); $i++) {
			$file_path =$file_path.$original_file[$i]."/"; 
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
    if (strlen($_GET['newarticles'])>2) {
	if ($_POST['submit']) {
	    submit_editing();
	}
	    if ($_POST['preview']) {
		   login_preview();
	    }
	}
	if (isset($_GET['msg'])) {
	    echo "Thanks for contribution in our documents your changes is under review";
    }
}

/**
* This function used for creating the new document  form with help user enter the name of document and category as well as language
*/
 
function new_document() 
{
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
    <form action = "<?php echo plugins_url('edit.php',__FILE__);?>?method=new_document&url=<?php echo $url;?>" method = 'post'>
    <table>
	<tr>
	    <td>Document Name</td>
	    <td><input type = "text" name = "t1" required>(use underscope in filename)</td>
	</tr>
	<tr>
        	<td>Select Category</td>
		<td><select name = "s1" required id = "s1">
		<option>.............</option>
		<option value = 'articles'>Articles</option>
		<option value = 'books'>Books</option>
		<option value = 'lessons'>Lessons</option>
		<option value = 'system/man1'>Man 1</option>
		<option value = 'system/man3'>Man 3</option>
		<option value = 'system/man5'>Man 5</option>
		<option value = 'system/mann'>Mann</option>
		<option value = 'presentations'>Presentations</option>
		<option value = 'specifications'>Specifications</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>Select Language</td>
		<td><select name = "s2" id = "s2" required></select>(Supported language are:- en,es,it,hy,ru)</td>
	</tr>
	<tr>
		<td><input type = "submit" name = "Create" value = "Create"></td>
	</tr>
        </table> 
	</form>
	<?php
	}

/**
* This function used for creating new file 
* This function used for write the data
* This function used for make perview of edited file
*/

function new_document_xml_edit() 
{
    global $current_user;
    get_currentuserinfo();
    if (strlen($_POST['t1'])>0) {
	$editable_file  = $current_user->user_login."123".$_POST['s1']."123".$_POST['s2']."123".$_POST['t1'].".xml";
	$editable_file = str_replace("/", "123", $editable_file);
	if (file_exists(new_document_directory.$editable_file)) {
		$file_two = fopen(new_document_directory.$editable_file,"w+"); 
		fclose($file_two); 
	} else {
		if ($_POST['s1']=="books") {
			$file_two = fopen(new_document_directory."book_template.xml","r");
			$data = fread($file_two, filesize(new_document_directory."book_template.xml"));
			fclose($file_two); 				
			$file_two = fopen(new_document_directory.$editable_file,"w+");
			$fwrite = fwrite($file_two, $data);
			fclose($file_two); 
		} else {
			$file_two = fopen(new_document_directory."all_template.xml","r") or die("not open");
			$data = fread($file_two, filesize(new_document_directory."all_template.xml"));
			fclose($file_two); 				
			$file_two = fopen(new_document_directory.$editable_file,"w+");
			$fwrite = fwrite($file_two, $data);
			fclose($file_two); 
			}
		}
	}
	if (strlen($_GET['new_document'])>2) {
		if ($_POST['submit']) { 
			new_document_submit_editing();
		}
		if ($_POST['preview']) {
			new_document_login_preview();
		}
	}
	if (isset($_GET['msg'])) {
		echo "Thanks for contribution in our documents your changes is under review";
	}
}

/**
* This function show the all document which are created by user
*/

function all_document() 
{
    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if ($_GET['msg']) {
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully Submit </p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
    }
    if ($_GET['delete']) {
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully Delete </p><button      		type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
    } 
    if ($_GET['rename']) {
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully renamed </p><button 		type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
    }
    if ($_GET['invite']) {
	echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Emails successfully Sent </p><button 			type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";		
    }
    global $current_user;
    get_currentuserinfo();
    echo "<table class='wp-list-table widefat fixed striped posts'>";
    echo "<tr class='inline-edit-row inline-edit-row-post inline-edit-post quick-edit-row quick-edit-row-post inline-edit-post'><th>File name
	</th><th>Category</th><th>Language</th><th>Submit for Review</th><th>Edit</th><th>Invitations</th><th>Rename</th><th>Delete</th></tr>";
    $language_directory = scandir(new_document_directory);
    foreach ($language_directory as $files_directory) {
    	if($files_directory == "." OR $files_directory == "..") {
        } else {
        	$extension = explode(".", $files_directory);
                if ($extension[1] == "xml") {
			$user = explode("123", $files_directory); 
                	$length = sizeof($user);
                   	if ($current_user->user_login == $user[0]) {
	                    echo "<form action='".plugins_url()."/brlcad-docbook/edit.php?submit=".$files_directory."' method='post'><tr><td>
				".$user[$length-1]."</td><td>".$user[1]."</td><td>".$user[2]."</td><td>
				<input type='submit' class='button button-primary' value='Submit For Review'></td></form>
	                     <form action='".plugins_url()."/brlcad-docbook/new_document.php?new_document=".$files_directory."&url=".$url."' 					method='post'><td><input type='submit' class='button button-primary' value='Edit'></td></form>
                    		<form action='".home_url()."/wp-admin/admin.php?page=invite_user&new_document=".$files_directory."' 					method='post'><td><input type='submit' class='button button-primary' value='Invite users'></td></form>
                    		<form action='".home_url()."/wp-admin/admin.php?page=rename&new_document=".$files_directory."' 					method='post'><td><input type='submit' class='button button-primary' value='Rename'></td></form>
                    		<form action='".plugins_url()."/brlcad-docbook/edit.php?delete=".$files_directory."' method='post'><td>
				<input type='submit' class='button button-primary' value='Delete'></td></form></tr>";
		                    echo "</form>";
			}
		}
    	}
    }
    echo "</table>";
}

/**
* This function used for rename the file 
*/

function rename_doc() 
{
    $filename = explode("123", $_GET['new_document']);
    $length = sizeof($filename);
?>
    <form action = "<?php echo home_url();?>/wp-content/plugins/brlcad-docbook/edit.php?rename=<?php echo $_GET['new_document'];?>" method = "post">
    <input type = "text" name = 'rename' value = "<?php echo $filename[$length-1];?>">
    <input type = "submit" name = 'r' value = "Submit">
    </form>
<?php
}

/**
* This function used for invite the users to edit the file using mail
*/

function invite_user() 
{
    $filename = explode("123", $_GET['new_document']);
    $length = sizeof($filename);
    $url_with_hash_key = home_url()."/wp-content/plugins/brlcad-docbook/new_document.php?new_document=".$_GET['new_document']."#".md5($filename[$length-1]);

?>
     <form action = "<?php echo home_url();?>/wp-content/plugins/brlcad-docbook/edit.php?invite=<?php echo $_GET['new_document'];?>" method = "post">
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

/**
* This function used for review the new document this function show the all list of new document which document needed review
*/

function Review_New_Document() 
{
    if ($_GET['delete']) {
	echo "<div id = 'message' class = 'updated notice notice-success is-dismissible below-h2'><p>Document successfully Delete </p>
	<button type = 'button' class = 'notice-dismiss'><span class = 'screen-reader-text'>Dismiss this notice.</span></button></div>";		
    }
    if ($_GET['email']) {
	echo "<div id = 'message' class = 'updated notice notice-success is-dismissible below-h2'><p>Mail successfully Send to user </p>
	<button type = 'button' class = 'notice-dismiss'><span class = 'screen-reader-text'>Dismiss this notice.</span></button></div>";		
    }
    echo "<table class = 'wp-list-table widefat fixed striped posts'>";
    echo "<tr class = 'inline-edit-row inline-edit-row-post inline-edit-post quick-edit-row quick-edit-row-post inline-edit-post'><th>File name
    </th><th>Category</th><th>Language</th><th>Preview</th>
    <th>Delete</th>
    <th>Accept</th>
    <th>Reject</th>
    </tr>";
    $language_directory = scandir(new_document_directory);
    foreach ($language_directory as $files_directory) {
	if ($files_directory == "." OR $files_directory == "..") {
        } else {
		$extension = explode(".", $files_directory);
		if($extension[1] == "xml"){
			$user = explode("123", $files_directory); 
                	$length = sizeof($user);
			if("submit" == $user[0]){
				echo "<form action ='".plugins_url()."/brlcad-docbook/edit.php?preview_other=preview&new_document=".$files_directory."' method = 'post'><tr><td>".$user[$length-1]."</td><td>".$user[2]."</td><td>".$user[3]."</td><td><input type = 'submit' class = 'button button-primary' value = 'Preview'></td></form>
                    <form action ='".plugins_url()."/brlcad-docbook/edit.php?delete=".$files_directory."&admin=yes' method = 'post'><td><input type = 'submit' class = 'button button-primary' value = 'Delete'></td></form>
                    <form action='".home_url()."/wp-admin/admin.php?page=cmake&file=".$files_directory."' method = 'post'><td><input type = 'submit' class = 'button button-primary' value = 'Accpet'></td></form>
                    <form action ='".home_url()."/wp-admin/admin.php?page=reject&file=".$files_directory."' method = 'post'><td><input type = 'submit' class = 'button button-primary' value = 'Reject'></td>
                    </form></tr>";
                    echo "</form>";
                }
            }
        }
    }
    echo "</table>";
}

/**
* This function used for editing the CMakeList.txt file for admin to add new document in this file
*/

function cmake() 
{
    $get_cmakefile_path = explode("123", $_GET['file']);
    if(array_search("system",$get_cmakefile_path))
    {
    shell_exec("cp ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[4]."/CMakeLists.txt"." ".new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123".$get_cmakefile_path[4]."123CMakeLists.txt");
    $cmake_file_open = fopen(new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123".$get_cmakefile_path[4]."123CMakeLists.txt","r");
    $cmake_read = fread($cmake_file_open, filesize(new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123".$get_cmakefile_path[4]."123CMakeLists.txt"));
    echo "<form action ='".home_url()."/wp-admin/admin.php?page=add&file=".$_GET['file']."' method='post'>";
    echo "<textarea cols = '60' rows = '25' name = 'update_cmake'>".$cmake_read."</textarea><br>";
    echo "<input type = 'submit' value = 'Add'>";
    fclose($cmake_file_open);
    } else {
    shell_exec("cp ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.txt"." ".new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt");
    $cmake_file_open = fopen(new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt","r");
    $cmake_read = fread($cmake_file_open, filesize(new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt"));
    echo "<form action ='".home_url()."/wp-admin/admin.php?page=add&file=".$_GET['file']."' method='post'>";
    echo "<textarea cols = '60' rows = '25' name = 'update_cmake'>".$cmake_read."</textarea><br>";
    echo "<input type = 'submit' value = 'Add'>";
    fclose($cmake_file_open);
    }
}

/**
* This function used for review the changes which are done by user.
* This function also made the patches for changes and allpied the patch on original file
* This function also provide interface to admin with admin see the all patches 
* This function also hold the delete operations After patch applied the patch file automatically deleted and edit file also.
*/


function add() 
{
    $get_cmakefile_path = explode("123", $_GET['file']);
    $length = sizeof($get_cmakefile_path);
    if(array_search("system", $get_cmakefile_path))
    {
    $write_cmake_file = fopen(new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123".$get_cmakefile_path[4]."123CMakeLists.txt", "w+");
    $write = fwrite($write_cmake_file, stripslashes($_POST['update_cmake']));
    fclose($write_cmake_file);
    shell_exec("mv ".new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123".$get_cmakefile_path[4]."123CMakeLists.txt"." ".new_document_directory."CMakeLists.txt");

    shell_exec("diff -u -b ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[4]."/CMakeLists.txt"." ".new_document_directory."CMakeLists.txt". "> "  .brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[4]."/CMakeLists.patch");
    shell_exec("patch ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[4]."/CMakeLists.txt"." < ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[4]."/CMakeLists.patch"." ");
    shell_exec("mv ".review_queue_directory."123articles123en123main_menu.xml"." ".new_document_directory."main_menu.xml");
    shell_exec("diff -u -b ".brlcad_source."articles/en/main_menu.xml"." ".review_queue_directory."main_menu.xml". "> "  .brlcad_source."/articles/en/main_menu.patch");
    shell_exec("patch ".brlcad_source."articles/en/main_menu.xml"." < ".brlcad_source."articles/en/main_menu.patch"." ");
    shell_exec("mv ".new_document_directory.$_GET['file']." ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[4]."/".$get_cmakefile_path[$length-1]);
    shell_exec("svn add ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[4]."/".$get_cmakefile_path[$length-1]);
    shell_exec("rm -r ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[4]."/CMakeLists.patch");
    shell_exec("rm -r ".new_document_directory.$_GET['file']);
    shell_exec("rm -r ".review_queue_directory."articles/en/main_menu.xml");
    shell_exec("rm -r ".new_document_directory.str_replace(".xml", ".html", $_GET['file']));
    shell_exec("rm -r ".new_document_directory."CMakeLists.txt");
    echo "<div id = 'message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully Added </p><button type = 'button' class = 'notice-dismiss'><span class = 'screen-reader-text'>Dismiss this notice.</span></button></div>";		
    } else {
    $write_cmake_file = fopen(new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt", "w+");
    $write = fwrite($write_cmake_file, $_POST['update_cmake']);
    fclose($write_cmake_file);
    shell_exec("mv ".new_document_directory.$get_cmakefile_path[2]."123".$get_cmakefile_path[3]."123CMakeLists.txt"." ".new_document_directory."CMakeLists.txt");
    shell_exec("diff -u -b ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.txt"." ".new_document_directory."CMakeLists.txt". "> "  .brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.patch");
    shell_exec("patch ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.txt"." < ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.patch"." ");
    shell_exec("mv ".review_queue_directory."123articles123en123main_menu.xml"." ".new_document_directory."main_menu.xml");
    shell_exec("diff -u -b ".brlcad_source."articles/en/main_menu.xml"." ".review_queue_directory."main_menu.xml". "> "  .brlcad_source."/articles/en/main_menu.patch");
    shell_exec("patch ".brlcad_source."articles/en/main_menu.xml"." < ".brlcad_source."articles/en/main_menu.patch"." ");
    shell_exec("mv ".new_document_directory.$_GET['file']." ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[$length-1]);
    shell_exec("svn add ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/".$get_cmakefile_path[$length-1]);
    shell_exec("rm -r ".brlcad_source.$get_cmakefile_path[2]."/".$get_cmakefile_path[3]."/CMakeLists.patch");
    shell_exec("rm -r ".new_document_directory.$_GET['file']);
    shell_exec("rm -r ".review_queue_directory."articles/en/main_menu.xml");
    shell_exec("rm -r ".new_document_directory.str_replace(".xml", ".html", $_GET['file']));
    shell_exec("rm -r ".new_document_directory."CMakeLists.txt");
    echo "<div id = 'message' class='updated notice notice-success is-dismissible below-h2'><p>Document successfully Added </p><button type = 'button' class = 'notice-dismiss'><span class = 'screen-reader-text'>Dismiss this notice.</span></button></div>";		
    }
}

/**
* This function provide the rejection option to admin.
* If admin not want accept the docuemnt then admin reject the document and send the reason of rejection to user for futher improvement 
*/

function reject() 
{
    global $current_user;
    get_currentuserinfo();
    if (isset($_POST['send'])) {
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
    <td>Email-id</td><td><input type = 'email' name = 't1' value = ".$data['user_email']."></td></tr><tr>
    <td>Subject</td><td><input type = 'text' name = 't2'></td></tr>
    <td>Message</td><td><textarea cols = '40' rows = '20' name = 't3'>Message</textarea></td>
    </tr><tr><td><input type = 'submit' value = 'Send Mail' name = 'send'></td></tr></table></form>";
}

/**
* This function usecd for delete the document 
*/

function delete() 
{
    echo "<h3>Please remove the name of file from CMakeLists file</h3>";
    $cmake = explode("/", $_GET['article']);
    $length = sizeof($cmake);
    echo "<form action ='".home_url()."/wp-admin/admin.php?page=full_delete&article=".$_GET['article']."' method='Post'>";
    $cmake_file = str_replace($cmake[$length-1], "CMakeLists.txt", $_GET['article']);
    shell_exec("cp ".$cmake_file." ".review_queue_directory.str_replace("/","123",$cmake_file));
    $cmake_open = fopen(review_queue_directory.str_replace("/", "123", $cmake_file),"r");
    $file_data = fread($cmake_open, filesize($cmake_file));
    echo "<textarea cols = '60' rows = '20' name = 'data'>".$file_data."</textarea> <br> ";
    fclose($cmake_open);
    echo "<input type = 'submit' value = 'Delete'>";
}

/**
* This function used for delete the all data related with new document like:- patch, edited file etc.
*/

function full_delete( ) 
{ 
    $cmake = explode("/", $_GET['article']);
    $length = sizeof($cmake);
    $cmake_file = str_replace($cmake[$length-1], "CMakeLists.txt", $_GET['article']);
    $cmake_open = fopen(review_queue_directory.str_replace("/", "123", $cmake_file),"w+");
    $file_data = fwrite($cmake_open, stripcslashes($_POST['data']));
    fclose($cmake_open);
    shell_exec("diff -u -b ".$cmake_file." ".review_queue_directory.str_replace("/", "123",$cmake_file). "> "  .str_replace("CMakeLists.txt","",$cmake_file)."CMakeLists.patch");
    shell_exec("patch ".$cmake_file." < ".str_replace("CMakeLists.txt", "CMakeLists.patch", $cmake_file)." ");
    shell_exec("rm -r ".str_replace("CMakeLists.txt", "CMakeLists.patch", $cmake_file));
    shell_exec("rm -r ".review_queue_directory.str_replace("/", "123", $cmake_file));
    shell_exec("rm -r ".$_GET['article']);
    shell_exec("svn remove ".$_GET['article']);
    echo "<div id = 'message' class = 'updated notice notice-success is-dismissible below-h2'><p>Document successfully Deleted </p><button type = 'button' class = 'notice-dismiss'><span class = 'screen-reader-text'>Dismiss this notice.</span></button></div>";		
}

/**
* This function provide the help to edit the menu file so user it self add the new menu options
*/

function edit_menu() 
{
    echo "<h2>Before submission of document you need to update the menu file. In this file you need to define your document table of content as tree structure under document category (article,book,lesson,presentation,specifications).</h2>";
    echo "<h3>For example</h3>";
    echo "<ul>";
    echo "<li>name of chapter";
    echo "<ul style = 'margin-left:6px'>"; 
    echo "<li>name of section";
    echo "<ul style = 'margin-left:6px'>";
    echo "<li>name of sub section </li>";
    echo "</ul>";
    echo "</li>";
    echo "</ul>";
    echo "</li>";
    echo "</ul>";
    echo "<h2>Made the link between chapters, section, sub sections with its own id's(xmls:id). so they easy to point the document online </h2>";
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo "<form action='".plugins_url()."/brlcad-docbook/edit.php?article=".home_url()."/articles/en/main_menu.php&url=".$url."' method='post'>";
    echo "<input type = 'submit' value = 'Edit menu'>";
    if ($_GET['msg'] == "yes") {
	wp_redirect(home_url()."/wp-admin/admin.php?page=all_document&msg=yes");	
    }
}

/*
 * Local Variables:
 * mode: PHP
 * tab-width: 8
 * End:
 * ex: shiftwidth=4 tabstop=8
 */
?>


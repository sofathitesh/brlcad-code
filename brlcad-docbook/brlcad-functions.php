<?php
/*         B R L C A D - F U N C T I O N S . P H P
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
* @file brlcad-docbook/brlcad-functions.php
* Using utf-8 format to represent the content
*/

ini_set('default_charset', 'utf-8');

/**
* This function used for store the data after write by user in file
* This function used the xmllint function to check the validation of document
**/

function submit_editing() {
    $filename = explode("/", $_GET['newarticles']);
    $file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
    $file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
    $check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
    fclose($file_two);
    $file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
    $file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
    fclose($file_two);
    if (strlen($check) < 100) {
    } else {
    	echo "<div class='error below-h2'><p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
    }												
}

/**
* This function used for convert the xml document into HTML for preview the changes to user
* This function used xsltproc and brlcad stylesheet for conversion the xml to html
*/

function login_preview() {
    $filename = explode("/", $_GET['newarticles']);
    if (array_search("articles",$filename)) {
    	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
 	fclose($file_two);
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
	fclose($file_two);
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
		$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
		$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
		fclose($file);
		$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
		fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";
		} else {
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}
    } elseif (array_search("books",$filename)) {
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
	fclose($file_two);
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-book-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
	$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
	fclose($file_two);
	if(strlen($check) < 100) {
		shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-book-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
		$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
		$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
		fclose($file);
		$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
		fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";
	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}				
    } elseif (array_search("man1",$filename) or array_search("man3",$filename) or array_search("man5",$filename)) {
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
	fclose($file_two);
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
	fclose($file_two);
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
		$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
		$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
		fclose($file);
		$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
		fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";

	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}								
    } elseif (array_search("presentations",$filename)) {
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
	fclose($file_two);
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
	fclose($file_two);
	if (strlen($check)<100) {
		shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-presentations-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
		$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
		$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
		fclose($file);
		$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
		fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";

	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}								
    } else {
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
	fclose($file_two);
	$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
	$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
	fclose($file_two);
	if (strlen($check)<100) {		
		shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-specification-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
		$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
		$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
		fclose($file);
		$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
		fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";

	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}												
    }	
}

/**
* This function used for searching the files from the resource 
*/

function search_document() {
?>
    <form  action="<?php echo home_url();?>/wp-content/plugins/brlcad-docbook/search_document2.php" method="post">
    <div id = "searchbox">
    <center>
    <div style = "padding:0%;width:100%;padding-left:0%;float:left;font-size:0.7em;"><a href="<?php echo home_url();?>"><h5><img src = "<?php echo home_url();?>/wp-content/themes/brlcad/img/icons/home.png" style="padding-right:1%;width:7%">BRL-CAD Reference Manual</h5></div></a>
    </center>
    <br>
    <input list = "document" placeholder = "Search docs" maxlength = "35" type = "search" name = "s" style = "padding-right:15%">
    </form>
    </div>
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
	$language_directory = scandir("../../".$directory);
    	foreach ($language_directory as $files_directory) {
	    	if ($files_directory == "." OR $files_directory == '..') {
	    	} else {
	    		$files = scandir("../../".$directory."/".$files_directory);
    		foreach ($files as $filename) {
	                if ($filename == "." OR $filename == "..") {
	                } else {
	                	$extension = explode(".", $filename);
        	        	if ($extension[1] != "html" and $extension[0] !="images") {
	                		$remove_extension = explode(".", $filename);
        	        		echo "<option value='".$remove_extension[0]."'>";
	       	        	}
        	        }
    		}
	}
   }
}
echo "</datalist>";
}
function main_menu_editor()
{
	$file = fopen('../../../articles/en/main_menu.html','r');
	$fr = fread($file, filesize('../../../articles/en/main_menu.html'));
	$_COOKIE['main_menu'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url = explode("/",$_COOKIE["main_menu"]);
	$get_url_size = sizeof($url);
	$original = 'href="../../'.$url[$get_url_size-3].'/'.$url[$get_url_size-2].'/'.$url[$get_url_size-1].'"';
	$replaced = 'id="unique" href="../../'.$url[$get_url_size-3].'/'.$url[$get_url_size-2].'/'.$url[$get_url_size-1].'"';
	$fr =str_replace($original, $replaced, $fr);
	$fr =str_replace('class="menu"','class="menuu"' , $fr);
	$fr =str_replace("../x.php","#" , $fr);
	$fr =str_replace("../xx.php","##" , $fr);
	$fr =str_replace("../xxx.php","###" , $fr);
	$fr =str_replace("../xxxx.php","####" , $fr);
	$fr =str_replace("../xxxxx.php","#####" , $fr);
	$fr =str_replace("../xxxxxx.php","######" , $fr);
	$fr =str_replace("../xxxxxxx.php","#######" , $fr);
	$fr =str_replace("../xxxxxxxx.php","########" , $fr);
	$fr =str_replace("../xxxxxxxxx.php","#########" , $fr);
	$fr =str_replace("../../","../../../" , $fr);	
	$fr = str_replace("<a","<a onclick='TreeMenu.toggle(this)'", $fr);
	echo $fr;
}
/*
 * Local Variables:
 * mode: PHP
 * tab-width: 8
 * End:
 * ex: shiftwidth=4 tabstop=8
 */
?>

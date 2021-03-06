<?php
/*         B R L C A D - F U N C T I O N - N E W - D O C U M E N T . P H P
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


ini_set('default_charset', 'utf-8');

/**
* This function used for store the data after write by user in file
* This function used the xmllint function to check the validation of document
**/

function new_document_submit_editing($file) {
    echo new_document_directory.$file;
    $file_two = fopen(new_document_directory.$file,"w+");
    $file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
    $check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
    fclose($file_two);
    $file_two = fopen(new_document_directory.$file,"w+");
    $file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
    fclose($file_two);
    if (strlen($check) < 100) {
    } else {
	echo "<div class='error below-h2'>
	<p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
	}												
}

/**
* This function used for convert the xml document into HTML for preview the changes to user
* This function used xsltproc and brlcad stylesheet for conversion the xml to html
*/

function new_document_login_preview() {
    $filename = explode("/", $_GET['new_document']);
    if (array_search("articles",$filename)) {
	$file_two = fopen(new_document_directory.$_GET['new_document'],"w+");
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	fclose($file_two);
	$file_two = fopen(new_document_directory.$_GET['new_document'],"w+");
	$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
	fclose($file_two);
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		$file = fopen(new_document_directory.str_replace('xml','html', $_GET['new_document']), "r");
		$data = fread($file, filesize(new_document_directory.str_replace('xml','html', $_GET['new_document'])));
		fclose($file);
		$file_two = fopen(new_document_directory.str_replace('xml','html', $_GET['new_document']),"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
		fclose($file_two);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}
    } elseif (array_search("books",$filename)) {
	$file_two = fopen(new_document_directory.$_GET['new_document'],"w+");
	$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	fclose($file_two);
	$file_two = fopen(new_document_directory.$_GET['new_document'],"w+");
	shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-book-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
	$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
	fclose($file_two);
	if(strlen($check) < 100){
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-book-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		$file = fopen(new_document_directory.str_replace('xml','html', $_GET['new_document']), "r");
		$data = fread($file, filesize(new_document_directory.str_replace('xml','html', $_GET['new_document'])));
		fclose($file);
		$file_two = fopen(new_document_directory.str_replace('xml','html', $_GET['new_document']),"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
		fclose($file_two);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
		} else {
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}				
	} elseif (array_search("presentations",$filename)) {
	$file_two = fopen(new_document_directory.$_GET['new_document'],"w+");
	$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	fclose($file_two);
	$file_two = fopen(new_document_directory.$_GET['new_document'],"w+");
	$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
	fclose($file_two);
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-presentations-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		$file = fopen(new_document_directory.str_replace('xml','html', $_GET['new_document']), "r");
		$data = fread($file, filesize(new_document_directory.str_replace('xml','html', $_GET['new_document'])));
		fclose($file);
		$file_two = fopen(new_document_directory.str_replace('xml','html', $_GET['new_document']),"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
		fclose($file_two);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}								
    } else {
	$file_two = fopen(new_document_directory.$_GET['new_document'],"w+");
	$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	fclose($file_two);
	$file_two = fopen(new_document_directory.$_GET['new_document'],"w+");
	$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
	fclose($file_two);
	if (strlen($check) < 100) {		
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-specification-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		$file = fopen(new_document_directory.str_replace('xml','html', $_GET['new_document']), "r");
		$data = fread($file, filesize(new_document_directory.str_replace('xml','html', $_GET['new_document'])));
		fclose($file);
		$file_two = fopen(new_document_directory.str_replace('xml','html', $_GET['new_document']),"w+");
		$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
		fclose($file_two);		
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
		} else {
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}												
	}	
}

/**
* This function used for convert the xml document into HTML for preview the changes to user when user login
* This function used xsltproc and brlcad stylesheet for conversion the xml to html
*/


function new_document_login_preview_for_other_work() {
    $filename = explode("/", $_GET['new_document']);
    if (array_search("articles",$filename)) {
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}
    } elseif (array_search("books",$filename)) {
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-book-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
		} else {
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}				
	} elseif (array_search("man1",$filename)) {
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}								
    } elseif (array_search("man3",$filename)) {
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}								
    } elseif (array_search("man5",$filename)) {
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}						
    }		
    elseif (array_search("presentations",$filename)) {
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	if (strlen($check) < 100) {
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-presentations-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}								
    } else {
	$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".new_document_directory.$_GET['new_document']." 2>&1");
	if (strlen($check) < 100) {	
		shell_exec("xsltproc -o ".new_document_directory.str_replace('xml','html', $_GET['new_document'])." ".brlcad_source."resources/brlcad/brlcad-specification-xhtml-stylesheet.xsl ".new_document_directory.$_GET['new_document']);
		echo "<a href='".home_url()."/new_document/".str_replace('xml','html', $_GET['new_document'])."'>".str_replace('xml','html', $_GET['new_document'])."</a>";
	} else {
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
	}												
    }	
}

/**
* This function change the status of file . review to submit
*/

function submit() {
    shell_exec("mv ".new_document_directory.$_GET['submit']." ".new_document_directory."submit123".$_GET['submit']);
}

/** 
* This function used for delete the new document
*/

function delete_doc() {
    shell_exec("rm -r ".new_document_directory.$_GET['delete']);	
}

/**
* This function provide the help to rename the file
*/

function rename_new_doc() {
    $file = explode("123", $_GET['rename']);
    $length = sizeof($file);
    shell_exec("mv ".new_document_directory.$_GET['rename']." ".new_document_directory.str_replace($file[$length-1], $_POST['rename'], $_GET['rename']));	
}

/**
* This function used for sending the emails
*/

function sent_mails() {
    $id = explode(",",$_POST['email']);
    $message = $_POST['t1'];
    $length = sizeof($id);
    for ($i=0; $i<$length; $i++) {
	mail($id[$i],'Inviting for edit the document',$message);
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

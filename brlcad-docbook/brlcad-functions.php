<?php
ini_set('default_charset', 'utf-8');
function submit_editing()
{
		$filename = explode("/", $_GET['newarticles']);
		if(array_search("articles",$filename))
		{
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
				echo "ok";
			}
			else
			{
				echo "<div class='error below-h2'>
				<p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
			}
		}
		elseif(array_search("books",$filename))
		{
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
			}
			else
			{
				echo "<div class='error below-h2'>
				<p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
			}				
		}
		elseif(array_search("man1",$filename))
		{
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
			}
			else
			{
				echo "<div class='error below-h2'>
				<p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
			}								
		}
		elseif(array_search("man3",$filename))
		{
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
			}
			else
			{
				echo "<div class='error below-h2'>
				<p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
			}								
		}
		elseif(array_search("man5",$filename))
		{
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
			}
			else
			{
				echo "<div class='error below-h2'>
				<p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
			}						
		}		
		elseif(array_search("presentations",$filename))
		{
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
			}
			else
			{
				echo "<div class='error below-h2'>
				<p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
			}								
		}
		else 
		{
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
			}
			else
			{
				echo "<div class='error below-h2'>
				<p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
			}												
	}

}
function login_preview()
{
	$filename = explode("/", $_GET['newarticles']);
	if(array_search("articles",$filename))
	{
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		if(strlen($check)<100)
		{
			shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
			$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
			$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
			fclose($file);
			$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
			fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";
		}
		else
		{
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}
	}
	elseif(array_search("books",$filename))
	{
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
		$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-book-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		if(strlen($check)<100)
		{
			shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-book-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
			$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
			$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
			fclose($file);
			$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
			fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";

		}
		else
		{
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}				
	}
	elseif(array_search("man1",$filename))
	{
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
		$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		if(strlen($check)<100)
		{
			shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
			$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
			$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
			fclose($file);
			$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
			fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";

		}
		else
		{
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}								
	}
	elseif(array_search("man3",$filename))
	{
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
		$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		if(strlen($check)<100)
		{
			shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
			$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
			$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
			fclose($file);
			$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
			fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";

		}
		else
		{
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}								
	}
	elseif(array_search("man5",$filename))
	{
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
		$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		if(strlen($check)<100)
		{
			shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-article-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
			$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
			$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
			fclose($file);
			$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
			fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";

		}
		else
		{
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}						
	}		
	elseif(array_search("presentations",$filename))
	{
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
		$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		if(strlen($check)<100)
		{
			shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-presentations-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
			$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
			$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
			fclose($file);
			$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
			fclose($file_two);
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";

		}
		else
		{
			echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}								
	}
	else
	{
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
		$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		if(strlen($check)<100)
		{		
			shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-specification-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
			$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
			$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
			fclose($file);
			$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
			fclose($file_two);
		
		echo "<a href='".home_url()."/review/".str_replace('xml','html', $_GET['newarticles'])."'>".str_replace('xml','html', $_GET['newarticles'])."</a>";

		}
		else
		{
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}												
	}	
}

function search_document()
{
	?>

	<form  action="<?php echo home_url();?>/wp-content/plugins/brlcad-docbook/search_document2.php" method="get" id="searchform" id="searchbox_011789835326516392534:qmtejlm4yda">
<input value="011789835326516392534:qmtejlm4yda" name="cx" type="hidden"/>
<input value="FORID:11" name="cof" type="hidden"/>
<div id="searchbox">

<div style="padding:5%;width:100%;padding-left:12%;float:left;font-size:14px;"><a href="<?php echo home_url();?>/index.php/?page_id=216"><h5><img src="<?php echo home_url();?>/wp-content/themes/brlcad/img/icons/home.png" align="left">BRL-CAD Reference Manual</h5></div></a><br>
	<input placeholder="Search docs" type="search" name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)">
    </div>
<?php
/*$document_folder = array();
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
    	if($files_directory == "." OR $files_directory == '..')
    	{
    	}else
    	{
    		$files = scandir("../../".$directory."/".$files_directory);
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
*/
}



?>

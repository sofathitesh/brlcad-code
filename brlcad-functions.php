<?php
ini_set('default_charset', 'utf-8');
function submit_editing()
{
		$filename = explode("/", $_GET['newarticles']);
		if(array_search("articles",$filename))
		{
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w");
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
				setcookie("filename",$editable_file,time()-(60*40));
				setcookie("filenameexit",$_GET['article'],time()-(60*40));			
				echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Your changes is saved for review</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
			}
			else
			{
				echo "<div class='error below-h2'>
				<p><strong>ERROR</strong>: ".$check.".</p>	</div>";
			}
		}
		elseif(array_search("books",$filename))
		{
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace("../../",brlcad_source, stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
				setcookie("filename",$editable_file,time()-(60*40));
				setcookie("filenameexit",$_GET['article'],time()-(60*40));			
				echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Your changes is saved for review</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
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
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace("../../",brlcad_source, stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
				setcookie("filename",$editable_file,time()-(60*40));
				setcookie("filenameexit",$_GET['article'],time()-(60*40));			
				echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Your changes is saved for review</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
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
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace("../../",brlcad_source, stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
				setcookie("filename",$editable_file,time()-(60*40));
				setcookie("filenameexit",$_GET['article'],time()-(60*40));			
				echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Your changes is saved for review</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
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
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace("../../",brlcad_source, stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
				setcookie("filename",$editable_file,time()-(60*40));
				setcookie("filenameexit",$_GET['article'],time()-(60*40));			
				echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Your changes is saved for review</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
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
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace("../../",brlcad_source, stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
				setcookie("filename",$editable_file,time()-(60*40));
				setcookie("filenameexit",$_GET['article'],time()-(60*40));			
				echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Your changes is saved for review</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
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
			$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
			$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
			fclose($file_two);
			$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
			$file_two_data = fwrite($file_two,str_replace("../../",brlcad_source, stripcslashes($_POST['t1'])));
			fclose($file_two);
			if(strlen($check)<100)
			{
				setcookie("filename",$editable_file,time()-(60*40));
				setcookie("filenameexit",$_GET['article'],time()-(60*40));			
				echo "<div id='message' class='updated notice notice-success is-dismissible below-h2'><p>Your changes is saved for review</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
			}
			else
			{
				echo "<div class='error below-h2'>
				<p><strong>ERROR</strong>: ".$check.".</p>	</div>";;
			}												
	}

}
function preview()
{
	$filename = explode("/", $_GET['newarticles']);
	if(array_search("articles",$filename))
	{
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,stripcslashes($_POST['t1']));
		$check = shell_exec("xmllint  --xinclude --schema ".brlcad_source."resources/other/docbook-schema/xsd/docbook.xsd --noout --nonet ".review_queue_directory.$_GET['newarticles']." 2>&1");
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
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
			wp_redirect(home_url()."/review/".str_replace('xml','html', $_GET['newarticles']));
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
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
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
			wp_redirect(home_url()."/review/".str_replace('xml','html', $_GET['newarticles']));
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
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
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
			fclose($file);
			fclose($file_two);
			wp_redirect(home_url()."/review/".str_replace('xml','html', $_GET['newarticles']));
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
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
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
			wp_redirect(home_url()."/review/".str_replace('xml','html', $_GET['newarticles']));
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
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
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
			wp_redirect(home_url()."/review/".str_replace('xml','html', $_GET['newarticles']));
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
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		if(strlen($check)<100)
		{
			shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-presentation-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
			$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
			$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
			fclose($file);
			$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
			fclose($file_two);
			wp_redirect(home_url()."/review/".str_replace('xml','html', $_GET['newarticles']));
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
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		$file_two = fopen(review_queue_directory.$_GET['newarticles'],"w+");
		$file_two_data = fwrite($file_two,str_replace(brlcad_source,"../../", stripcslashes($_POST['t1'])));
		fclose($file_two);
		if(strlen($check)<100)
		{		
			shell_exec("xsltproc -o ".review_queue_directory.str_replace('xml','html', $_GET['newarticles'])." ".brlcad_source."resources/brlcad/brlcad-specificaion-xhtml-stylesheet.xsl ".review_queue_directory.$_GET['newarticles']);
			$file = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']), "r");
			$data = fread($file, filesize(review_queue_directory.str_replace('xml','html', $_GET['newarticles'])));
			fclose($file);
			$file_two = fopen(review_queue_directory.str_replace('xml','html', $_GET['newarticles']),"w+");
			$file_two_data = fwrite($file_two, str_replace("../../", "../",$data));
			fclose($file_two);
			wp_redirect(home_url()."/review/".str_replace('xml','html', $_GET['newarticles']));
		}
		else
		{
		echo "<div class='upload-errors'><span class='upload-error-message'>".$check."</span></div>";;
		}												
	}	
}

/* Without Login Editing */

function without_submit_editing()
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
function without_login_preview()
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
?>

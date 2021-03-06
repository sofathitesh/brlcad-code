 <?php
/*         N E W - D O C U M E N T . P H P
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
* @file brlcad-docbook/new_document.php
* This file contains the code of editor which are used for editing the new documents
* This file contains the javascript code for firepad editor and php code for call back urls
*/
ini_set('default_charset', 'utf-8');
      require('../../../wp-blog-header.php'); 
      class MyPost { var $post_title = "BRL-CAD MAIN MENU"; }
      $wp_query->is_home = false;
      $wp_query->is_single = true;
      $wp_query->queried_object = new MyPost();
      get_header();
?>
<html>
<head>
  <!-- Firebase -->
<link rel="stylesheet" href="css/show-hint.css">
<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/codemirror.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/mode/javascript/javascript.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/codemirror.css" />
<link rel="stylesheet" href="https://cdn.firebase.com/libs/firepad/1.1.0/firepad.css" />
<script src="https://cdn.firebase.com/libs/firepad/1.1.0/firepad.min.js"></script>
<script src="js/show-hint.js"></script>
<script src="js/xml-hint.js"></script>
<script src="js/xml.js"></script>
<script src="js/jquery.treemenu.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>  
<script src="js/doc.js"></script>
<style>
    html { height: 100%; }
	#controls{
		margin-left:50%;
		float:right;
		z-index:10000;
		width:100%;
		height:10%; 
	}
		#controls #msg{
		width:20%; 	
		font-size:12px;
		color:green;
	}
	#controls #link{	
		width:20%;
		font-size:12px;
		color:blue;	
	}
	body { 
		margin: 0; 	
		height: 100%;
		position: relative;
	}
	#firepad-container {
	        width: 100%;	
	      	height: 700px;
      		float:left;
    	}
</style>
</head>
<body bgcolor="#404040">
     <div class="row4">
     </div>
     <div id="content-side">
        <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		        <div class="row3">
		          <div id="firepad-container"></div>
        		</div>  
      		</main>
    	</div>
  </div>  
  <div id="content-side4">
    <div class="row5">
      <div id="secondary" class="widget-area" role="complementary">
  	<center>
  	<table>
  		<tr>
    			<td>
    				<input type="submit" value="Save" id='save'>
    			</td>
  		</tr>
  		<tr>
    			<td>
    				<input type="submit" value="Preview" id='preview'>
    			</td>
  		</tr>
  		<tr>
    			<td>
    				<input type="button" id="del" value="Main Website">
    			</td>
  		</tr>
  	</table>

    		<div id="link"></div>
    		<div id="msg"></div>
 		 </center>
	  </div>
  </div>
<script type="text/javascript">make_tree_menu('itemizedlist');</script>  
<script>
       var dummy = {
        attrs: {
          color: ["red", "green", "blue", "purple", "white", "black", "yellow"],
          size: ["large", "medium", "small"],
          description: null
        },
        children: []
      };

      var tags = {
        "article": ["article"],
        "attrs": {
          id: null,
          class: ["A", "B", "C"]
        },
        section: {
          attrs: {
            name: null,
          },
          children: ["para", "literallayout", "emphasis", "programlisting", "title","link"]
        },
        book: {
          attrs: {
            name: null,
          },
          children: ["info", "title", "firstname", "author", "surname","personname"]
        },
        article: {
          attrs: {
            name: null,
          },
          children: ["info", "title", "firstname", "author", "surname","personname"]
        },
        chapter: {
          attrs: {name: null},
          children: ["info", "title"]
        },
        figure: {
          attrs: {name: null},
          children: ["mediaobject", "imageobject", "imagedata", "textobject","phrase"]
        },
        wings: dummy, feet: dummy, body: dummy, head: dummy, tail: dummy,
        leaves: dummy, stem: dummy, flowers: dummy
      };

      function completeAfter(cm, pred) {
        var cur = cm.getCursor();
        if (!pred || pred()) setTimeout(function() {
          if (!cm.state.completionActive)
            cm.showHint({completeSingle: false});
        }, 100);
        return CodeMirror.Pass;
      }

      function completeIfAfterLt(cm) {
        return completeAfter(cm, function() {
          var cur = cm.getCursor();
          return cm.getRange(CodeMirror.Pos(cur.line, cur.ch - 1), cur) == "<";
        });
      }

      function completeIfInTag(cm) {
        return completeAfter(cm, function() {
          var tok = cm.getTokenAt(cm.getCursor());
          if (tok.type == "string" && (!/['"]/.test(tok.string.charAt(tok.string.length - 1)) || tok.string.length == 1)) return false;
          var inner = CodeMirror.innerMode(cm.getMode(), tok.state).state;
          return inner.tagName;
        });
      } 
    function init() {
      //// Initialize Firebase.
      var firepadRef = getExampleRef();
      // TODO: Replace above line with:
      // var firepadRef = new Firebase('<YOUR FIREBASE URL>');

      //// Create CodeMirror (with line numbers and the JavaScript mode).
      var codeMirror = CodeMirror(document.getElementById('firepad-container'), {
        mode: "xml",
        lineNumbers: true,
        extraKeys: {
          "'<'": completeAfter,
          "'/'": completeIfAfterLt,
          "' '": completeIfInTag,
          "'='": completeIfInTag,
          "Ctrl-Space": "autocomplete"
        },
        hintOptions: {schemaInfo: tags}
      });
      var data;
      //// Create Firepad.
      $.get('edit.php?write=ok&new_document=<?php echo $_GET['new_document'];?>',function(data){
      var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror, {
        defaultText: data
      });
 //`     alert(data);
	setInterval(function(){
	$.post('edit.php?method=edit&newarticles=<?php echo $_GET['article'];?>',{'t1':codeMirror.getValue()},function(data,error){
		$("#msg").show();
		document.getElementById('msg').innerHTML="<p>Data Is Saved</p>";
		$("#msg").hide(10000);
		});
		firepadRef.remove();
		},40000);
	});
	$("#preview").click(function(){
		$.post('edit.php?preview=preview&new_document=<?php echo $_GET['new_document'];?>',{'t1':codeMirror.getValue()},function(data,error){
		$("#link").show();
		document.getElementById('link').innerHTML=data;
		$("#link").hide(1000);
		});
	});
	$("#save").click(function(){
		$.post('edit.php?edit=new_document_edit&new_document=<?php echo $_GET['new_document'];?>',{'t1':codeMirror.getValue()},function(data,error){
		$("#msg").show();
		firepadRef.remove();
		document.getElementById('msg').innerHTML="<p>Data Is Saved</p>";
		$("#msg").hide(10000);
		});
	});
	$("#del").click(function(){
		firepadRef.remove();
		window.location.href="<?php echo $_GET['url'];?>";
	});
	setInterval(function(){
		location.reload(); 
		},100000);
	}
    function getExampleRef() {
      var ref = new Firebase('https://firepad.firebaseio-demo.com');
      var hash = window.location.hash.replace(/#/g, '');
      if (hash) {
        ref = ref.child(hash);
      } else {
        ref = ref.push(); // generate unique location.
        window.location = window.location + '#' + ref.key(); // add it as a hash to the URL.
      }
      if (typeof console !== 'undefined')
        console.log('Firebase data: ', ref.toString());
      return ref;
    }
    init();
  </script>
</body>
</html>

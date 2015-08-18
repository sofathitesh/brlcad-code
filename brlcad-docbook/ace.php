 <?php
/*         A C E . P H P
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
* @file brlcad-docbook/ace.php
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
  <?php
  /**
  * This lines of code used for include the JS libraries files as well as Styles Sheet(css) Files
  */
  ?>
  <!-- Firebase -->
  <link rel="stylesheet" href="css/show-hint.css">
  <script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
  <!-- CodeMirror and its JavaScript mode file -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/codemirror.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/mode/javascript/javascript.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/codemirror.css" />
  <!-- Firepad -->
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
    body { margin: 0; height: 100%; position: relative; }
    /* Height / width / positioning can be customized for your use case.
       For demo purposes, we make firepad fill the entire browser. */
    #firepad-container {
        width: 100%;
        height: 700px;
        float:left;
      }
  </style>
</head>

<body bgcolor="#404040">
    <div class="row4">
    <?php 
    search_document(); 
    main_menu_editor();
    ?>
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
  </div>
  <script type="text/javascript">make_tree_menu('itemizedlist');</script>  
  <script>
  /**
  * These function used for store the all tags formats for auto complete like :- arricle, book etc
  */
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
    /**
    * This function used for auto complete the tag name when used write down the tag name. 
    * This function help them to complete the name of tag.
    */
      function completeAfter(cm, pred) 
      {
        var cur = cm.getCursor();
        if (!pred || pred()) setTimeout(function() 
        {
          if (!cm.state.completionActive)
            cm.showHint({completeSingle: false});
        }, 100);
        return CodeMirror.Pass;
      }
    /**
    * This function used for auto complete the tag name when used write down the tag name. 
    * This function help them to complete the name of tag.
    */
      function completeIfAfterLt(cm) 
      {
        return completeAfter(cm, function() 
        {
          var cur = cm.getCursor();
          return cm.getRange(CodeMirror.Pos(cur.line, cur.ch - 1), cur) == "<";
        });
      }
    /**
    * This function used for auto complete the tag name when used write down the tag name. 
    * This function help them to complete the name of tag.
    */
      function completeIfInTag(cm) 
      {
        return completeAfter(cm, function()   
        {
          var tok = cm.getTokenAt(cm.getCursor());
          if (tok.type == "string" && (!/['"]/.test(tok.string.charAt(tok.string.length - 1)) || tok.string.length == 1)) return false;
          var inner = CodeMirror.innerMode(cm.getMode(), tok.state).state;
          return inner.tagName;
        });
      } 
    /**
    * This function used for Intigrate the editor in web site. 
    * This function help to user to save the all content which written by user.
    * This function provide the help to save the all content into file
    * This function used for preview the page when user in written mode.
    * This function used for save the data in firebase database.
    */
    function init() 
    {
      var firepadRef = getExampleRef();
      var codeMirror = CodeMirror(document.getElementById('firepad-container'), 
      {
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
      $.get('edit.php?articleget=<?php echo $_GET['article'];?>',function(data)
      {
      var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror, 
      {
        defaultText: data
      });
    setInterval(function()
    {
        $.post('edit.php?method=edit&newarticles=<?php echo $_GET['article'];?>',{'t1':codeMirror.getValue()},function(data,error){
        $("#msg").show();
        document.getElementById('msg').innerHTML="<p>Data Is Saved</p>";
        $("#msg").hide();
        });
        firepadRef.remove();
        },40000);
      });
      $("#preview").click(function()
      {
      $.post('edit.php?methods=preview&newarticles=<?php echo $_GET['article'];?>',{'t1':codeMirror.getValue()},function(data,error){
      $("#link").show();
      document.getElementById('link').innerHTML=data;
      $("#link").hide(20000);
      }); 
  });
    $("#save").click(function()
    {
        $.post('edit.php?methods=edit&newarticles=<?php echo $_GET['article'];?>',{'t1':codeMirror.getValue()},function(data,error){
        $("#msg").show();
        firepadRef.remove();
        document.getElementById('msg').innerHTML="<p>Data Is Saved</p>";  
        $("#msg").hide(5000);
      });
  });
    $("#del").click(function()
    {
        firepadRef.remove();
        window.location.href="<?php if(strpos($_GET['url'],'?')){
          echo $_GET['url'].'&msg=ok';
        } else {
          echo $_GET['url'];
        } ;?>";
      });
    setInterval(function()
    {
      	location.reload();   
      },100000);
    }
    // Helper to get hash from end of URL or generate a random one.
    function getExampleRef() 
    {
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
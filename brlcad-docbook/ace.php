 <?php
ini_set('default_charset', 'utf-8');
?>
<html>
<head>
  <!-- Firebase -->
  <script src="js/firebase.js"></script>

  <!-- ACE and its JavaScript mode and theme files -->
  <script src="js/ace.js"></script>
  <script src="js/mode-javascript.js"></script>
  <script src="js/theme-textmate.js"></script>

  <!-- Firepad -->
  <link rel="stylesheet" href="css/firepad.css" />
  <link rel="stylesheet" href="css/jquery.treemenu.css" />
  <script src="js/firepad.min.js"></script>

  <style>
    html { height: 100%; }
	#controls{
position:fixed;
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
	padding-top:20%;
      width: 100%;
      height: 100%;
    }
  </style>
</head>

<body>
<div id="controls">
<input type="submit" value="Save" id='save'>
<input type="submit" value="Preview" id='preview'>
<input type="button" id="del" value="Main Website">
<div id="link"></div>
<div id="msg"></div>

</div>

<div id="firepad-container"></div>
<div class="main_menu">
<?php
$file = fopen('../../../articles/en/main_menu.html','r');
$fr = fread($file, filesize('../../../articles/en/main_menu.html'));
$fr = str_replace(".php", ".php?mode=edit", $fr);
$fr = str_replace("../../", "../../../", $fr);
echo $fr;
?>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.treemenu.js"></script>
  <script>
make_tree_menu('itemizedlist');
  var editor;
	var firepadRef;
    function init() {
      //// Initialize Firebase.
  firepadRef = getExampleRef();
      // TODO: Replace above line with:
//       var firepadRef = new Firebase('hiteshsofat.firebaseIO.com');
      //// Create ACE
      editor = ace.edit("firepad-container");
      editor.setTheme("ace/theme/textmate");
      var session = editor.getSession();
      session.setUseWrapMode(true);
      session.setUseWorker(false);
      session.setMode("ace/mode/javascript");
      var data;
      //// Create Firepad.
$.get('edit.php?articleget=<?php echo $_GET['article'];?>',function(data){
      var firepad = Firepad.fromACE(firepadRef, editor, {
        defaultText: data
      });
 //`     alert(data);
setInterval(function(){
$.post('edit.php?method=edit&newarticles=<?php echo $_GET['article'];?>',{'t1':editor.getValue()},function(data,error){
$("#msg").show();
document.getElementById('msg').innerHTML="<p>Data Is Saved</p>";
$("#msg").hide(10000);
});
firepadRef.remove();
},40000);
});

$("#preview").click(function(){
$.post('edit.php?methods=preview&newarticles=<?php echo $_GET['article'];?>',{'t1':editor.getValue()},function(data,error){
$("#link").show();
document.getElementById('link').innerHTML=data;
});
});
$("#save").click(function(){
$.post('edit.php?methods=edit&newarticles=<?php echo $_GET['article'];?>',{'t1':editor.getValue()},function(data,error){
$("#msg").show();
firepadRef.remove();
document.getElementById('msg').innerHTML="<p>Data Is Saved</p>";
$("#msg").hide(10000);
});
});
$("#del").click(function(){
firepadRef.remove();
window.location.href="../../../index.php";
});
setInterval(function(){
	location.reload(); 
},100000);

}

    // Helper to get hash from end of URL or generate a random one.
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
    window.onload = init;

  </script>
</body>
</html>

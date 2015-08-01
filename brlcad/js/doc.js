$(document).ready(function(){
$(".toc").hide();
$("#content-side3").hide();
$("#flags").hide();
$("#up").hide();
$("#down").click(function(){
	$("#up").show();
	$("#down").hide();
	$("#flags").toggle(1000);
	$("#flags").css('visibility','visible');
});
$("#up").click(function(){
	$("#down").show();
	$("#up").hide();
	$("#flags").toggle(1000);
});
	$("#menu").click(function(){
		$("#flags").toggle(1000);
	$("#flags").css('visibility','visible');
	});
	$(".menu a").click(function(){
		$(".menu a").css("color","#ee3b5b");
		$(this).css("color","black");
	})
});

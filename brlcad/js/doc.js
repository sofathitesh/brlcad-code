$(document).ready(function(){
	var expire_date=new Date((new Date().getTime())-1000);
	document.cookie="main_menu="+window.location.href+";"+expire_date+";path=/";
	$('.menu li hello').css('background','url(../img/page.png)');
function menu(url)
{
	if(url == "empty")
	{
	var url = window.location.href;
	url = url.replace("http://202.164.53.122/wordpress/","../../");
	}
	else
	{
		var url = url;
	}
	var count = 0;
	var li;
	var ul;
	var span;
	var position = Array();
	var anch;
	var anch_elements;
	var ul_elements;
	var li_elememts = $(".menu li");
	$(".menu").find("li").each(function(){
		var self = $(this);
	$(this).find("span").each(function(){
		span = $(this);
	});
	$(this).find("a").each(function(){
	var a =	$(this).attr("href");
	var url_two = url.split("#");
	if(a == url_two[0]){

		$(this).css('background','#FAF9F9');
		$(this).css('color','#404040');
		self.find("ul").first().show();
//		self.find("a").first().css('background','#FAF9F9');
		self.find("a").first().css('color','#404040');
//		$(this).css('border-bottom','solid 10px #c9c9c9');
		self.find("span").first().removeClass('symbol-close').addClass('symbol-open');
	}
	var full_url = url_two[0]+"#"+url_two[1];
	if(a == full_url){
		$(this).css('color','#404040');
		self.find("ul").hide();
		self.find("a").first().css('color','#404040');
		self.find("ul").first().show();
		self.find("span").first().removeClass('symbol-close').addClass('symbol-open');
	}
	});
	});
}
menu("empty");
	var toc;
	toc=$(".toc dt").length;
	if(toc < 3){
	$(".toc").css('visibility','hidden');
   	$(".toc").hide();
	$(".list-of-figures").css('visibility','hidden');
	$(".list-of-figures").hide();
}
	$("#content-side3").hide();
	$("#flags").hide();
	$("#up").hide();
	$("#down").click(function(){
		$("#up").show();
		$("#down").hide();
		$("#flags").toggle(1000);
		$("#flags").css('visibility','visible');});
	$("#up").click(function(){
		$("#down").show();
		$("#up").hide();
		$("#flags").toggle(1000);});
	$("#menu").click(function(){
		$("#flags").toggle(1000);
		$("#flags").css('visibility','visible');});
	$(".menu li").click(function(){
		$(this).show();
	});

	$(".menu li ul li a").click(function(){
		$(".menu li ul li a").css('color','#808086');
//		$(".menu a").css('border','none');
		$(this).css('color','#404040');
		$(".menu li ul li span").removeClass('symbol-open');
		$(".menu li ul li span").addClass('symbol-close');
		menu($(this).attr("href"));
	});
		$(".menu span").click(function(){
//			$(this).next("a").css('color','#B93344');
	});
});

$(document).ready(function(){
	$("#topp").css('visibility','hidden');
	$( window ).scroll(function() {
  	$("#topp").css('visibility','visible');
});
	var expire_date=new Date((new Date().getTime())-1000);
	document.cookie="main_menu="+window.location.href+";"+expire_date+";path=/";
function menu(url)
{
	if(url == "empty")
	{
	var url = window.location.href;
	var original_url = url.split("/");
	var length_url = original_url.length;
	original_url = "http://"+original_url[length_url-5]+"/"+original_url[length_url-4];
	url = url.replace(original_url,"../..");
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
	var li_elememts = $(".menuu li");
	$(".menuu").find("li").each(function(){
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
		self.find("ul").first().show().css('display','block');
		self.find("a").first().css('color','#eee');
		self.find("span").first().removeClass('symbol-close').addClass('symbol-open');

	}
	var full_url = url_two[0]+"#"+url_two[1];
	if(a == full_url){
		$(this).css('color','#404040');
		self.find("ul").hide();
		self.find("a").first().css('color','#eee');
		self.find("ul").first().show();
		self.find("span").first().removeClass('symbol-close').addClass('symbol-open');
	}
	});
	});

	$(".menuu li ul").find("li").each(function(){
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
		self.find("ul").first().show().css('display','block');
		self.find("a").first().css('color','#404040');
		self.find("span").first().removeClass('symbol-close').addClass('symbol-open');

	}
	var full_url = url_two[0]+"#"+url_two[1];
	if(a == full_url){
		$(this).css('color','#404040');
		self.find("ul").hide();
		self.find("a").first().css('color','#404040');
		self.find("ul").first().show();
		self.find("ul").first().show().css('display','block');
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
	$(".menuu li").click(function(){
		$(this).show();
	});

	$(".menuu li ul li a").click(function(){
		$(".menuu li ul li a").css('color','#808086');
		$(this).css('color','#404040');
		$(".menuu li ul li span").removeClass('symbol-open');
		$(".menuu li ul li span").addClass('symbol-close');
		menu($(this).attr("href"));
		$("#itemizedlist").css("color","#eee");

	});
		$(".menuu li span").click(function(){
			if($(this).hasClass('symbol-close'))
			{
				$(this).next("a").css('color','#A9A9A9');
			}else
			{
				$(this).next("a").css('color','#eee');
			}
	});
		$(".menuu li ul span").click(function(){
			if($(this).hasClass('symbol-close'))
			{
				$(this).next("a").css('color','#808086');
			}else
			{
				$(this).next("a").css('color','#404040');
			}
	});
});

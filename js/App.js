jQuery.easing.def = "easeInOutQuint";

function App(options){
	
	$.windowWidth = window.innerWidth;
	$.windowHeight = window.innerHeight;
	
	$.mobile = Utils.checkMobile();
	$.tablet = Utils.checkTablet();
	if($.mobile || $.tablet){
		 $("body").removeClass("desktop");
	}
	
	$.window = $(window);
	
	this.init();
	
}

App.prototype = {
	
	init:function(){
		$(".gallery-icon a").colorbox({rel:"gallery"});
	}

}

function trace(str){
	$("#trace").append(str + "<br/>");	
}
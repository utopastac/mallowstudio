Utils = {
	
	trackHover: function (element){
		$(element).mousemove(function(e){
			if((Utils.getHalf($(this), e) == 1)){
				$('#nextImage').stop().animate({opacity:1}, 100, 'easeOutQuad');
				$('#previousImage').stop().animate({opacity:0}, 400);
			} else {
				$('#nextImage').stop().animate({opacity:0}, 400);
				$('#previousImage').stop().animate({opacity:1}, 100, 'easeOutQuad');
			}
		});
	},
	
	getHalf: function (element, e){
		var half = 1;
		var x = e.pageX - $(element).offset().left;
		if(x < $(element).width()/2) half = -1;
		return half;
	},
	
	getImage: function (activeImage, parentElement, half){
		var index = $('img', parentElement).index($(activeImage));
		var image = $(activeImage).prev('.fader').length ? index - 1 : $('img', parentElement).length-1;
		if(half) image = $(activeImage).next('.fader').length ? index + 1 : 0;
		return image;
	},

	maxscreen: function(imageHolder, image){
		var imageRatio = $(image).width() / $(image).height();
		var wt = $(window).width();
		var ht = wt / imageRatio;
	
		if(ht < $(window).height()){
			ht = $(window).height();
			wt = ht * imageRatio;
		}
		$(image).css({width: wt, height:ht});
	},
	
	maxscreenContainer: function(image, container, center){
		
		var imageRatio = image[0].naturalWidth / image[0].naturalHeight;
		
		var wt = Math.ceil($(container).width()) + 2;
		var ht = Math.ceil(wt / imageRatio);
	
		if(ht < $(container).height()){
			ht = Math.ceil($(container).height()) + 2;
			wt = Math.ceil(ht * imageRatio);
		}
		if(center){
			var xt = ($(container).width() - wt) / 2;
			var yt = ($(container).height() - ht) / 2;
			$(image).css({width: wt, height:ht, "margin-left":-Math.abs(xt), "margin-top":-Math.abs(yt)});
		} else {
			$(image).css({width: wt, height:ht});
		}
	},
	
	verticalCentre: function(element){
		var parent = element.parent();
		element.css({"margin-top": parent.height()/2 - element.height()/2});
	},
	
	randRange: function (start, end) {
		return Math.floor(start+(Math.random()*(end-start)));
	},
	
	stringEndsWith: function (str, substr) {
		return str.substr(0 - substr.length) == substr;
	},
	
	degreesToRadians: function (degrees){
		return degrees * Math.PI / 180;
	},
	
	distanceFromVisibleEdge: function(element) {
        var allHeight = $(window).height() + $(window).scrollTop();
        return allHeight - element.offset().top;
    },
	
	putInRange: function(min, max, current, addition){
		var value = current + addition;
		if(value > max) value = min;
		if(value < min) value = max;
		return value;
	},
	
	distanceFromIndex: function(index, currentIndex, range){
		var up = currentIndex + range;
		var down = currentIndex - range;
		return index > up || index < down ? true : false;
	},
	
	getElementIndex: function(element){
		return element.parent().children().index(element);
	},
	
	endScroll: function(offset){
		return $(window).scrollTop() + $(window).height() >= $(document).height() - offset;
	},
    
    underView: function(element) {
		return (($(window).height()/2 + $(window).scrollTop()) <= element.offset().top);
    },
        
    aboveView: function(element) {
		return ($(window).scrollTop() >= element.offset().top + element.height());
    },
    
    inView: function(element) {
		return (Utils.aboveView(element)!=true && Utils.underView(element)!=true);
    },
	
	topView: function(element, offset) {
		return ($(window).scrollTop() + offset >= element.offset().top);
    },
	
	endOfPage: function(){
		return (window.innerHeight + window.scrollY) >= $(document).height();	
	},
	
	endOfElement: function(element){
		return (window.innerHeight + window.scrollY) >= ($(element).outerHeight() + $(element).offset().top);	
	},
	
	topOfPage: function(){
		return window.scrollY == 0;
	},
	
	removeClasses: function(element, classes){
		if(element.hasClass(classes)) element.removeClass(classes);
	},
	
	drawGrid: function(ctx, cols, rows){
		
		ctx.clearRect (0, 0, $.ww, $.wh);
		ctx.canvas.width  = $.ww;
		ctx.canvas.height = $.wh;
		ctx.strokeStyle = "rgba(0, 255, 30, 1)";
		ctx.lineWidth = (1);
		ctx.beginPath();
		
		var i = 0;
		for(i = 0; i < cols; i++){
			var left = ($.ww / cols) * (i+1);
			ctx.moveTo(left, 0);
			ctx.lineTo(left, $.wh);
		}
		for(i = 0; i < rows; i++){
			var top = ($.wh / rows) * (i+1);
			ctx.moveTo(0, top);
			ctx.lineTo($.ww, top);
		}
		ctx.stroke();
		
	},
	
	getContext: function(element){
		var canvas = document.getElementById(element);
		return canvas.getContext("2d");
	},
	
	checkMobile: function(){
		var mobile = false
		if ($.ww < 500 ||
			navigator.userAgent.match(/Android/i) ||
	        navigator.userAgent.match(/webOS/i) ||
	        navigator.userAgent.match(/iPhone/i) ||
	        navigator.userAgent.match(/iPod/i) ||
	        navigator.userAgent.match(/BlackBerry/) || 
	        navigator.userAgent.match(/Windows Phone/i) || 
	        navigator.userAgent.match(/ZuneWP7/i)
	        ) mobile = true;
		return mobile;
	},
	
	checkTablet: function(){
		var tablet = false
		if (navigator.userAgent.match(/iPad/i)) tablet = true;
		return tablet;
	},
	
	iOSversion: function() {
		if (/iP(hone|od|ad)/.test(navigator.platform)) {
			// supports iOS 2.0 and later: <http://bit.ly/TJjs1V>
			var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
			return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
		} else {
			return false;	
		}
	},
	
	trace: function(str){
		$("#trace").html(" ")
		$("#trace").append(str + "<br/>");	
	}

}

// Plugins

/*(function( $ ){

	$.fn.maxscreenContainer = function(center) {
		
		var image = this[0];
		var container = this.parent();
		
		var imageRatio = image.naturalWidth / image.naturalHeight;
		
		var wt = Math.ceil(container.width()) + 1;
		var ht = Math.ceil(wt / imageRatio);
		
		if(ht < container.height()){
			ht = Math.ceil(container.height()) + 1;
			wt = Math.ceil(ht * imageRatio);
		}
		if(center){
			var xt = (container.width() - wt) / 2;
			var yt = (container.height() - ht) / 2;
			this.css({width: wt, height:ht, "margin-left":-Math.abs(xt), "margin-top":-Math.abs(yt)});
		} else {
			this.css({width: wt, height:ht});
		}
	
	};
	
})( jQuery );*/
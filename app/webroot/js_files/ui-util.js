/*

jQuery Fancy Gestures
Copyright (c) 2009 Anant Garg (http://anantgarg.com)

Version: 1.0
Url: http://anantgarg.com/2009/05/21/jquery-fancy-gestures

Original ActionScript Version: Didier Brun (http://www.bytearray.org/?p=91) (didier@bytearray.org)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

(function($){   
  
	$.fn.fancygestures = function(callbackfunction){   
	
		var gestures = new Array();

		// Add new gestures here
		// gestures["RETURNDATA"] = "MOUSESEQUENCE";

		gestures["A"] = "53";
		gestures["B"] = "260123401234";
		gestures["C"] = "43210";
		gestures["D"] = "26701234";
		gestures["E"] = "4321043210";
		gestures["F"] = "42";
		gestures["G"] = "432107650";
		gestures["H"] = "267012";
		gestures["I"] = "6";
		gestures["J"] = "234";
		gestures["K"] = "3456701";
		gestures["L"] = "46";
		gestures["M"] = "6172";
		gestures["N"] = "616";
		gestures["O"] = "432107654";
		gestures["P"] = "670123456";
		gestures["Q"] = "4321076540";
		gestures["R"] = "267012341";
		gestures["S"] = "432101234";
		gestures["T"] = "02";
		gestures["U"] = "21076";
		gestures["V"] = "35";
		gestures["W"] = "2716";
		gestures["X"] = "1076543";
		gestures["Y"] = "21076234567";
		gestures["Z"] = "030";
		gestures[" "] = "0";
		gestures["?"] = "6701232";
		
		// Color & Width of Stroke
		var color = "#666666";
		var strokeWidth = 4;

		var element = this;   
		var graphics;
		var position;

		var recording = false;
		var lastPositionX = 0;
		var lastPositionY = 0;
		var moves = new Array;
		 
		var sectorRad = Math.PI*2/8;
		var anglesMap = new Array;
		var step = Math.PI*2/100;
		var sector;

		for (var i = -sectorRad/2; i<=Math.PI*2-sectorRad/2; i+=step){
			sector=Math.floor((i+sectorRad/2)/sectorRad);
			anglesMap.push(sector);
		}
		
		function initialize() {
			graphics = new jsGraphics($(element).attr('id')); 
			position = $(element).offset();
		}

		initialize();

		$(element).mousedown(function(event) {
			recording = true;
			graphics.clear();
			graphics.paint();

			lastPositionX = event.clientX-position.left;
			lastPositionY = event.clientY-position.top;	
		});

		$(element).mousemove(function(event) {
			if(recording == true) {
				var msx = (event.clientX-position.left);
				var msy = (event.clientY-position.top);
				
				var difx = (msx-lastPositionX);
				var dify = (msy-lastPositionY);

				var sqDist = (difx*difx+dify*dify);
				var sqPrec= (8*8);
						
				if (sqDist>sqPrec){
					graphics.setStroke(strokeWidth);
					graphics.setColor(color);
					graphics.drawLine(lastPositionX, lastPositionY, msx,msy);
					graphics.paint();
					lastPositionX=msx;
					lastPositionY=msy;
					addMove(difx,dify);
				}
			}
		});

		$(element).mouseup(function(e) {
			recording = false;
			result = 100000;
			letter = '';

			for (x in gestures) {
				matchMove = gestures[x].split('');
				res = costLeven (matchMove,moves);

				if (res < result && res < 30) {		
					result = res;
					letter = x;
				}
			}

			callbackfunction(letter);

			moves = new Array(0);
			lastPositionX = 0;
			lastPositionY = 0;
		});


		function addMove(dx,dy) {
			var angle = Math.atan2(dy,dx)+sectorRad/2;
			if (angle<0) angle+=Math.PI*2;
			var no = Math.floor(angle/(Math.PI*2)*100);
			moves.push(anglesMap[no]);	
		}

		function difAngle(a,b) {
			var dif =Math.abs(a-b);
			if (dif>8/2)dif=8-dif;
			return dif;
		}

		function fill2DTable(w,h,f){
			var o = new Array(w);
			for (var x=0;x<w;x++){
				o[x]=new Array(h);
				for (var y=0;y<h;y++)o[x][y]=f;
			}
			return o;
		}
				
		function costLeven(a,b){
			
			if (a[0]==-1){
				return b.length==0 ? 0 : 100000;
			}

			var d = fill2DTable(a.length+1,b.length+1,0);
			var w = d.slice();

			for (var x=1;x<=a.length;x++){
				for (var y=1;y<b.length;y++){
					d[x][y]=difAngle(a[x-1],b[y-1]);
				}
			}

			for (y=1;y<=b.length;y++)w[0][y]=100000;
			for (x=1;x<=a.length;x++)w[x][0]=100000;
			w[0][0]=0;

			var cost=0;
			var pa;
			var pb;
			var pc;

			for (x=1;x<=a.length;x++){
				for (y=1;y<b.length;y++){
					cost=d[x][y];
					pa=w[x-1][y]+cost;
					pb=w[x][y-1]+cost;
					pc=w[x-1][y-1]+cost;
					w[x][y]=Math.min(Math.min(pa,pb),pc)
				}
			}

			return w[x-1][y-1];
		}		
	};   
  
})(jQuery); /*!
 * Buttons helper for fancyBox
 * version: 1.0.2
 * @requires fancyBox v2.0 or later
 *
 * Usage: 
 *     $(".fancybox").fancybox({
 *         buttons: {
 *             position : 'top'
 *         }
 *     });
 * 
 * Options:
 *     tpl - HTML template
 *     position - 'top' or 'bottom'
 * 
 */
(function ($) {
	//Shortcut for fancyBox object
	var F = $.fancybox;

	//Add helper object
	F.helpers.buttons = {
		tpl: '<div id="fancybox-buttons"><ul><li><a class="btnPrev" title="Previous" href="javascript:;"></a></li><li><a class="btnPlay" title="Start slideshow" href="javascript:;"></a></li><li><a class="btnNext" title="Next" href="javascript:;"></a></li><li><a class="btnToggle" title="Toggle size" href="javascript:;"></a></li><li><a class="btnClose" title="Close" href="javascript:jQuery.fancybox.close();"></a></li></ul></div>',
		list: null,
		buttons: {},

		update: function () {
			var toggle = this.buttons.toggle.removeClass('btnDisabled btnToggleOn');

			//Size toggle button
			if (F.current.canShrink) {
				toggle.addClass('btnToggleOn');

			} else if (!F.current.canExpand) {
				toggle.addClass('btnDisabled');
			}
		},

		beforeLoad: function (opts) {
			//Remove self if gallery do not have at least two items
			if (F.group.length < 2) {
				F.coming.helpers.buttons = false;
				F.coming.closeBtn = true;

				return;
			}

			//Increase top margin to give space for buttons
			F.coming.margin[ opts.position === 'bottom' ? 2 : 0 ] += 30;
		},

		onPlayStart: function () {
			if (this.list) {
				this.buttons.play.attr('title', 'Pause slideshow').addClass('btnPlayOn');
			}
		},

		onPlayEnd: function () {
			if (this.list) {
				this.buttons.play.attr('title', 'Start slideshow').removeClass('btnPlayOn');
			}
		},

		afterShow: function (opts) {
			var buttons;

			if (!this.list) {
				this.list = $(opts.tpl || this.tpl).addClass(opts.position || 'top').appendTo('body');

				this.buttons = {
					prev : this.list.find('.btnPrev').click( F.prev ),
					next : this.list.find('.btnNext').click( F.next ),
					play : this.list.find('.btnPlay').click( F.play ),
					toggle : this.list.find('.btnToggle').click( F.toggle )
				}
			}

			buttons = this.buttons;

			//Prev
			if (F.current.index > 0 || F.current.loop) {
				buttons.prev.removeClass('btnDisabled');
			} else {
				buttons.prev.addClass('btnDisabled');
			}

			//Next / Play
			if (F.current.loop || F.current.index < F.group.length - 1) {
				buttons.next.removeClass('btnDisabled');
				buttons.play.removeClass('btnDisabled');

			} else {
				buttons.next.addClass('btnDisabled');
				buttons.play.addClass('btnDisabled');
			}

			this.update();
		},

		onUpdate: function () {
			this.update();
		},

		beforeClose: function () {
			if (this.list) {
				this.list.remove();
			}

			this.list = null;
			this.buttons = {};
		}
	};

}(jQuery)); /*!
 * Thumbnail helper for fancyBox
 * version: 1.0.2
 * @requires fancyBox v2.0 or later
 *
 * Usage: 
 *     $(".fancybox").fancybox({
 *         thumbs: {
 *             width	: 50,
 *             height	: 50
 *         }
 *     });
 * 
 * Options:
 *     width - thumbnail width
 *     height - thumbnail height
 *     source - function to obtain the URL of the thumbnail image
 *     position - 'top' or 'bottom'
 * 
 */
(function ($) {
	//Shortcut for fancyBox object
	var F = $.fancybox;

	//Add helper object
	F.helpers.thumbs = {
		wrap: null,
		list: null,
		width: 0,

		//Default function to obtain the URL of the thumbnail image
		source: function (el) {
			var img = $(el).find('img');

			return img.length ? img.attr('src') : el.href;
		},

		init: function (opts) {
			var that = this,
				list,
				thumbWidth = opts.width || 50,
				thumbHeight = opts.height || 50,
				thumbSource = opts.source || this.source;

			//Build list structure
			list = '';

			for (var n = 0; n < F.group.length; n++) {
				list += '<li><a style="width:' + thumbWidth + 'px;height:' + thumbHeight + 'px;" href="javascript:jQuery.fancybox.jumpto(' + n + ');"></a></li>';
			}

			this.wrap = $('<div id="fancybox-thumbs"></div>').addClass(opts.position || 'bottom').appendTo('body');
			this.list = $('<ul>' + list + '</ul>').appendTo(this.wrap);

			//Load each thumbnail
			$.each(F.group, function (i) {
				$("<img />").load(function () {
					var width = this.width,
						height = this.height,
						widthRatio, heightRatio, parent;

					if (!that.list || !width || !height) {
						return;
					}

					//Calculate thumbnail width/height and center it
					widthRatio = width / thumbWidth;
					heightRatio = height / thumbHeight;
					parent = that.list.children().eq(i).find('a');

					if (widthRatio >= 1 && heightRatio >= 1) {
						if (widthRatio > heightRatio) {
							width = Math.floor(width / heightRatio);
							height = thumbHeight;

						} else {
							width = thumbWidth;
							height = Math.floor(height / widthRatio);
						}
					}

					$(this).css({
						width: width,
						height: height,
						top: Math.floor(thumbHeight / 2 - height / 2),
						left: Math.floor(thumbWidth / 2 - width / 2)
					});

					parent.width(thumbWidth).height(thumbHeight);

					$(this).hide().appendTo(parent).fadeIn(300);

				}).attr('src', thumbSource(this));
			});

			//Set initial width
			this.width = this.list.children().eq(0).outerWidth();

			this.list.width(this.width * (F.group.length + 1)).css('left', Math.floor($(window).width() * 0.5 - (F.current.index * this.width + this.width * 0.5)));
		},

		//Center list
		update: function (opts) {
			if (this.list) {
				this.list.stop(true).animate({
					'left': Math.floor($(window).width() * 0.5 - (F.current.index * this.width + this.width * 0.5))
				}, 150);
			}
		},

		beforeLoad: function (opts) {
			//Remove self if gallery do not have at least two items 
			if (F.group.length < 2) {
				F.coming.helpers.thumbs = false;

				return;
			}

			//Increase bottom margin to give space for thumbs
			F.coming.margin[ opts.position === 'top' ? 0 : 2 ] = opts.height + 30;
		},

		afterShow: function (opts) {
			//Check if exists and create or update list
			if (this.list) {
				this.update(opts);

			} else {
				this.init(opts);
			}

			//Set active element
			this.list.children().removeClass('active').eq(F.current.index).addClass('active');
		},

		onUpdate: function () {
			this.update();
		},

		beforeClose: function () {
			if (this.wrap) {
				this.wrap.remove();
			}

			this.wrap = null;
			this.list = null;
			this.width = 0;
		}
	}

}(jQuery));(function(a){"use strict",typeof define=="function"&&define.amd?define(["jquery","load-image","bootstrap"],a):a(window.jQuery,window.loadImage)})(function(a,b){"use strict",a.extend(a.fn.modal.defaults,{delegate:document,selector:null,filter:"*",index:0,href:null,preloadRange:2,offsetWidth:100,offsetHeight:200,canvas:!1,slideshow:0,imageClickDivision:.5});var c=a.fn.modal.Constructor.prototype.show,d=a.fn.modal.Constructor.prototype.hide;a.extend(a.fn.modal.Constructor.prototype,{initLinks:function(){var b=this,c=this.options,d=c.selector||"a[data-target="+c.target+"]";this.$links=a(c.delegate).find(d).filter(c.filter).each(function(a){b.getUrl(this)===c.href&&(c.index=a)}),this.$links[c.index]||(c.index=0)},getUrl:function(b){return b.href||a(b).data("href")},startSlideShow:function(){var a=this;this.options.slideshow&&(this._slideShow=window.setTimeout(function(){a.next()},this.options.slideshow))},stopSlideShow:function(){window.clearTimeout(this._slideShow)},toggleSlideShow:function(){var a=this.$element.find(".modal-slideshow");this.options.slideshow?(this.options.slideshow=0,this.stopSlideShow()):(this.options.slideshow=a.data("slideshow")||5e3,this.startSlideShow()),a.find("i").toggleClass("icon-play icon-pause")},preloadImages:function(){var b=this.options,c=b.index+b.preloadRange+1,d,e;for(e=b.index-b.preloadRange;e<c;e+=1)d=this.$links[e],d&&e!==b.index&&a("<img>").prop("src",this.getUrl(d))},loadImage:function(){var a=this,c=this.$element,d=this.options.index,e=this.getUrl(this.$links[d]),f;this.abortLoad(),this.stopSlideShow(),c.trigger("beforeLoad"),this._loadingTimeout=window.setTimeout(function(){c.addClass("modal-loading")},100),f=c.find(".modal-image").children().removeClass("in"),window.setTimeout(function(){f.remove()},3e3),c.find(".modal-title").text(this.$links[d].title),c.find(".modal-download").prop("href",e),this._loadingImage=b(e,function(b){a.img=b,window.clearTimeout(a._loadingTimeout),c.removeClass("modal-loading"),c.trigger("load"),a.showImage(b),a.startSlideShow()},this._loadImageOptions),this.preloadImages()},showImage:function(b){var c=this.$element,d=a.support.transition&&c.hasClass("fade"),e=d?c.animate:c.css,f=c.find(".modal-image"),g,h;f.css({width:b.width,height:b.height}),c.find(".modal-title").css({width:Math.max(b.width,380)}),d&&(g=c.clone().hide().appendTo(document.body)),a(window).width()>767?e.call(c.stop(),{"margin-top":-((g||c).outerHeight()/2),"margin-left":-((g||c).outerWidth()/2)}):c.css({top:(a(window).height()-(g||c).outerHeight())/2}),g&&g.remove(),f.append(b),h=b.offsetWidth,c.trigger("display"),d?c.is(":visible")?a(b).on(a.support.transition.end,function(d){d.target===b&&(a(b).off(a.support.transition.end),c.trigger("displayed"))}).addClass("in"):(a(b).addClass("in"),c.one("shown",function(){c.trigger("displayed")})):(a(b).addClass("in"),c.trigger("displayed"))},abortLoad:function(){this._loadingImage&&(this._loadingImage.onload=this._loadingImage.onerror=null),window.clearTimeout(this._loadingTimeout)},prev:function(){var a=this.options;a.index-=1,a.index<0&&(a.index=this.$links.length-1),this.loadImage()},next:function(){var a=this.options;a.index+=1,a.index>this.$links.length-1&&(a.index=0),this.loadImage()},keyHandler:function(a){switch(a.which){case 37:case 38:a.preventDefault(),this.prev();break;case 39:case 40:a.preventDefault(),this.next()}},wheelHandler:function(a){a.preventDefault(),a=a.originalEvent,this._wheelCounter=this._wheelCounter||0,this._wheelCounter+=a.wheelDelta||a.detail||0;if(a.wheelDelta&&this._wheelCounter>=120||!a.wheelDelta&&this._wheelCounter<0)this.prev(),this._wheelCounter=0;else if(a.wheelDelta&&this._wheelCounter<=-120||!a.wheelDelta&&this._wheelCounter>0)this.next(),this._wheelCounter=0},initGalleryEvents:function(){var b=this,c=this.$element;c.find(".modal-image").on("click.modal-gallery",function(c){var d=a(this);b.$links.length===1?b.hide():(c.pageX-d.offset().left)/d.width()<b.options.imageClickDivision?b.prev(c):b.next(c)}),c.find(".modal-prev").on("click.modal-gallery",function(a){b.prev(a)}),c.find(".modal-next").on("click.modal-gallery",function(a){b.next(a)}),c.find(".modal-slideshow").on("click.modal-gallery",function(a){b.toggleSlideShow(a)}),a(document).on("keydown.modal-gallery",function(a){b.keyHandler(a)}).on("mousewheel.modal-gallery, DOMMouseScroll.modal-gallery",function(a){b.wheelHandler(a)})},destroyGalleryEvents:function(){var b=this.$element;this.abortLoad(),this.stopSlideShow(),b.find(".modal-image, .modal-prev, .modal-next, .modal-slideshow").off("click.modal-gallery"),a(document).off("keydown.modal-gallery").off("mousewheel.modal-gallery, DOMMouseScroll.modal-gallery")},show:function(){if(!this.isShown&&this.$element.hasClass("modal-gallery")){var b=this.$element,d=this.options,e=a(window).width(),f=a(window).height();b.hasClass("modal-fullscreen")?(this._loadImageOptions={maxWidth:e,maxHeight:f,canvas:d.canvas},b.hasClass("modal-fullscreen-stretch")&&(this._loadImageOptions.minWidth=e,this._loadImageOptions.minHeight=f)):this._loadImageOptions={maxWidth:e-d.offsetWidth,maxHeight:f-d.offsetHeight,canvas:d.canvas},e>767?b.css({"margin-top":-(b.outerHeight()/2),"margin-left":-(b.outerWidth()/2)}):b.css({top:(a(window).height()-b.outerHeight())/2}),this.initGalleryEvents(),this.initLinks(),this.$links.length&&(b.find(".modal-slideshow, .modal-prev, .modal-next").toggle(this.$links.length!==1),b.toggleClass("modal-single",this.$links.length===1),this.loadImage())}c.apply(this,arguments)},hide:function(){this.isShown&&this.$element.hasClass("modal-gallery")&&(this.options.delegate=document,this.options.href=null,this.destroyGalleryEvents()),d.apply(this,arguments)}}),a(function(){a(document.body).on("click.modal-gallery.data-api",'[data-toggle="modal-gallery"]',function(b){var c=a(this),d=c.data(),e=a(d.target),f=e.data("modal"),g;f||(d=a.extend(e.data(),d)),d.selector||(d.selector="a[rel=gallery]"),g=a(b.target).closest(d.selector),g.length&&e.length&&(b.preventDefault(),d.href=g.prop("href")||g.data("href"),d.delegate=g[0]!==this?this:document,f&&a.extend(f.options,d),e.modal(d))})})});
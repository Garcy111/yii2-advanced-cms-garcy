/**
 * demo.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2016, Codrops
 * http://www.codrops.com
 */
;(function(window) {

	'use strict';

	// taken from mo.js demos
	function isIOSSafari() {
		var userAgent;
		userAgent = window.navigator.userAgent;
		return userAgent.match(/iPad/i) || userAgent.match(/iPhone/i);
	};

	// taken from mo.js demos
	function isTouch() {
		var isIETouch;
		isIETouch = navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
		return [].indexOf.call(window, 'ontouchstart') >= 0 || isIETouch;
	};
	
	// taken from mo.js demos
	var isIOS = isIOSSafari(),
		clickHandler = isIOS || isTouch() ? 'touchstart' : 'click';

	function extend( a, b ) {
		for( var key in b ) { 
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function Animocon(el, options) {
		this.el = el;
		this.options = extend( {}, this.options );
		extend( this.options, options );

		this.timeline = new mojs.Timeline();
		
		for(var i = 0, len = this.options.tweens.length; i < len; ++i) {
			this.timeline.add(this.options.tweens[i]);
		}

		var self = this;
		this.el.addEventListener(clickHandler, function() {
			var id = this.querySelector('.like').getAttribute('data-post-id');
			var idLS = localStorage.getItem(id);
			if( !idLS ) {
				self.options.onUnCheck();
			}
			else {
				self.options.onCheck();
				self.timeline.start();
			}
		});
	}

	Animocon.prototype.options = {
		tweens : [
			new mojs.Burst({
				shape : 'circle',
				isRunLess: true
			})
		],
		onCheck : function() { return false; },
		onUnCheck : function() { return false; }
	};

	// grid items:
	var items = [].slice.call(document.querySelectorAll('.item-heart'));

	function init() {
		/* Icon 1 */
		var el = [];
		var elspan = [];
		for (var i=0; items.length > i; i++) {
			el[i] = items[i].querySelector('button.icobutton');
			elspan[i] = el[i].querySelector('span');
			new Animocon(el[i], {
				tweens : [
					// burst animation
					new mojs.Burst({
						parent: el[i],
						duration: 900,
						shape : 'circle',
						fill: '#DE433F',
						x: '18%',
						y: '50%',
						opacity: 0.5,
						childOptions: { radius: {15:0} },
						radius: {30:40},
						count: 6,
						isRunLess: true,
						easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
					}),
					// ring animation
					new mojs.Transit({
						parent: el[i],
						duration: 700,
						type: 'circle',
						radius: {0: 60},
						fill: 'transparent',
						stroke: '#DE433F',
						strokeWidth: {20:0},
						opacity: 0.6,
						x: '18%',     
						y: '50%',
						isRunLess: true,
						easing: mojs.easing.sin.out
					}),
					// icon scale animation
					new mojs.Tween({
						duration : 1100,
						onUpdate: function(progress) {
							if(progress > 0.3) {
								var elasticOutProgress = mojs.easing.elastic.out(1.43*progress-0.43);
								elspan[0].style.WebkitTransform = elspan[0].style.transform = 'scale3d(' + elasticOutProgress + ',' + elasticOutProgress + ',1)';
							}
							else {
								elspan[0].style.WebkitTransform = elspan[0].style.transform = 'scale3d(0,0,1)';
							}
						}
					})
				],
				onCheck : function() {
					// el[0].style.color = '#F05F5F';
				},
				onUnCheck : function() {
					// el[0].style.color = '#000';	
				}
			});
			/* Icon 1 */
		}
	}

	init();

})(window);
var paper = Raphael('logo', 50, 50).setViewBox(0,0, 363, 363, true);

var path1 = paper.path('M349.53,168.03c0,32.54-9.25,62.91-25.26,88.64c-29.65,47.67-82.5,79.4-142.77,79.4s-113.12-31.73-142.77-79.4c-16.01-25.73-25.26-56.1-25.26-88.64C13.47,75.23,88.7,0,181.5,0S349.53,75.23,349.53,168.03z');
path1.attr("fill", "#8777B7");
path1.attr("stroke", "#8777B7");

var circle1 = paper.circle(181.5, 168.035, 98.508);
circle1.attr("fill", "#7367A5");
circle1.attr("stroke", "#7367A5");

var circle2 = paper.circle(181.5, 168.035, 31.252);
circle2.attr("fill", "#5A5188");
circle2.attr("stroke", "#5A5188");

var path2 = paper.path('M329.146,199.921c-0.729,3.38-1.572,6.718-2.524,10.01');
path2.attr("fill", "none");
path2.attr("stroke", "#FFF");
path2.attr("stroke-width", "10");
path2.attr("stroke-linecap", "round");
path2.attr("stroke-miterlimit", "10");

var path3 = paper.path('M236.048,27.188c56.402,21.919,96.486,76.789,96.486,140.845c0,3.725-0.136,7.418-0.402,11.076');
path3.attr("fill", "none");
path3.attr("stroke", "#FFF");
path3.attr("stroke-width", "10");
path3.attr("stroke-linecap", "round");
path3.attr("stroke-miterlimit", "10");

var path4 = paper.path('M181.5,17c6.341,0,12.591,0.393,18.729,1.155');
path4.attr("fill", "none");
path4.attr("stroke", "#FFF");
path4.attr("stroke-width", "10");
path4.attr("stroke-linecap", "round");
path4.attr("stroke-miterlimit", "10");

var path5 = paper.path('M324.27,256.67c-29.65,47.67-82.5,79.4-142.77,79.4s-113.12-31.73-142.77-79.4H324.27z');
path5.attr("fill", "#7367A5");
path5.attr("stroke", "#7367A5");

var path6 = paper.path('M323.741,363H39.259c-4.866,0-8.643-4.243-8.08-9.076l9.217-79.122c0.478-4.101,3.952-7.193,8.08-7.193h266.048c4.129,0,7.602,3.093,8.08,7.193l9.217,79.122C332.384,358.757,328.607,363,323.741,363z');
path6.attr("fill", "#4D4D4D");
path6.attr("stroke", "#4D4D4D");

// small circles
var smallCircle = [];
smallCircle[0] = paper.circle(117.5, 133, 9).attr({"fill": "#FFF", "stroke": "#FFF"});
smallCircle[1] = paper.circle(198, 188, 9).attr({"fill": "#FFF", "stroke": "#FFF"});
smallCircle[2] = paper.circle(254, 218, 9).attr({"fill": "#FFF", "stroke": "#FFF"});
smallCircle[3] = paper.circle(137, 201, 9).attr({"fill": "#FFF", "stroke": "#FFF"});
smallCircle[4] = paper.circle(194, 74, 9).attr({"fill": "#FFF", "stroke": "#FFF"});
smallCircle[5] = paper.circle(247, 115, 9).attr({"fill": "#FFF", "stroke": "#FFF"});

var line = paper.path("M 305,295 L310,340");
line.attr("fill", "none");
line.attr("stroke", "#FFF");
line.attr("stroke-width", "10");
line.attr("stroke-linecap", "round");
line.attr("stroke-miterlimit", "10");

$(function(){

	function getRandomInt(min, max) {
  		return Math.floor(Math.random() * (max - min)) + min;
	}

	function setAnimateCircle(el, x, y) {
		el.animate({ 
			cx: x,
			cy: y,
		}, 1000, 'ease-out');
	}

	function getPositionCircle() {
		var pos = [];
		pos['x'] = getRandomInt(50, 280);
		pos['y'] = getRandomInt(50, 250);
		return pos;
	}

	var colors = [
		['#B462B7', '#9A559C', '#7F4681'],
		['#43B78C', '#3AA17A', '#328C6A'],
		['#8777B7', '#7367A5', '#5A5188'],
		['#C29D16', '#A38412', '#79620D'],
		['#F7548D', '#D1477A', '#AC3A66'],
		['#14E4E7', '#11C5C5', '#0EABAB'],
	],
	repeat = -1;
	$('#logo').mouseenter(function(){

		for (var i=0; i < smallCircle.length; i++) {
			var pos = getPositionCircle();
			setAnimateCircle(smallCircle[i], pos['x'], pos['y']);
		}

		var i = getRandomInt(0, colors.length);
		if (repeat === i) {
			if (repeat == colors.length) {
				--i;
			} else ++i;
			
		}
		path1.attr("fill", colors[i][0]);
		path5.attr("fill", colors[i][0]);
		circle1.attr("fill", colors[i][1]);
		circle2.attr("fill", colors[i][2]);
		repeat = i;
	});
});
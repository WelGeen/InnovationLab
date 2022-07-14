<!DOCTYPE html>
<html lang="en">

	<head>
		<title>logo</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'">
		<link rel="stylesheet" href="temp/style.css" />
		<script src="temp/cpide_scripts.js"></script>	
		
	</head>
	
	<body onclick="location.reload();" ondblclick="window.open(location.href);">

		<code id="txt" class="big-letters" >		
var cpide = function () { return {
	_self : null,
	path: null,	
	current: 0,
	target: 0,
	svg: null,
	l: 61,
	bufferPercent : 1,
	bigletters: document.querySelector('.big-letters'),
	
	ini : function(){
		var w = window.innerWidth;
		var h = window.innerHeight;
		this.svg.setAttribute("width", w +'px');
		this.svg.setAttribute("height", h +'px');
		this.svg.setAttribute("viewBox", '0 0 '+w+' '+h );
		
		this.minX = parseFloat(this.svg.getAttribute("width"));
		this.minY = parseFloat(this.svg.getAttribute("height"));
		this.maxX = parseFloat(this.svg.getAttribute("width"))  - this.minX,
		this.maxY = parseFloat(this.svg.getAttribute("height")) - this.minY,
		this.rangeX = this.maxX - this.minX,
		this.rangeY = this.maxY - this.minY,
		
		this.path = document.createElementNS('http://www.w3.org/2000/svg','path');  
		this.current = this.calNewPoints();
		this.target = this.calNewPoints();
		
		this.setPoints( this.current );
		
		this.path.setAttribute("stroke", "rgb(0,0,0)");  
		this.path.setAttribute("stroke-width", 1);  
		this.path.setAttribute("opacity", 1);  
		this.path.setAttribute("fill", "black");
		this.svg.appendChild(this.path);
		

	},
	step : function() {
		
		var ready = 0;
		for( i=0; ithis.current.length; i++){
			if (Math.round(this.current[i]) == Math.round(this.target[i]) ){
				++ready;
			}
		}
		if(ready == this.current.length){
			this.current = this.target;
			this.target = this.calNewPoints();
		}
		this.movePoints();
		window.requestAnimationFrame( function(){logo.step();});
	},

	ranNum: function (range,base){
		var r = range || 1,
		b = base || 0;
		return b + Math.floor(Math.random()*(r+1));
	},

	movePoints : function(){
		//console.log(this.target);
		for( i=0; ithis.l; i++){
			this.current[i] = this.current[i] + (this.target[i] -this.current[i]) * 0.05;
		}
		
		this.bigletters.style.fontSize = this.current[6]+'px';
		this.bigletters.style.lineHeight = this.current[34]+'px';
		this.bigletters.style.letterSpacing  = this.current[34]/2+'px';
		
		
		this.current[this.current.length-2] = this.current[0] ;// last key;
		this.current[this.current.length-1] = this.current[1] ;
		this.setPoints( this.current );
	},

	calNewPoints: function(){
		var p = [];
		for( i=0; ithis.l; i++){
			p.push( this.ranNum(this.rangeX,this.minX) ); i++;
			p.push( this.ranNum(this.rangeY,this.minY) );
		}
		p[p.length-2] = p[0] ;// last key;
		p[p.length-1] = p[1] ;
		return p;
	},

	setPoints:function(p){
		var str = [];
		str.push( 'M ' + p[0] + ' ' + p[1]);
		for( j=2; j(this.l-2); j++){
			str.push( 'C ' +p[j]+ ' ' +p[j+1]+', '+p[j+2]+ ' ' +p[j+3]+', '+p[j+4]+ ' ' +p[j+5] );
			j=j+5;
		}
		this.path.setAttribute('d', str.join(' '));
	}
}}

		</code>
		<div id="logo">
			<svg id="svgEl" xmlns="http://www.w3.org/2000/svg" width="400px"  height="400px" viewBox="0 0 400 400" >
			</svg>
		</div>
		
		<script>
			logo = new cpide();
			logo.svg = document.getElementById("svgEl");
			logo.ini();
			window.requestAnimationFrame( function(){logo.step();});
	
		function onWindowResize() {
		
			var WH = logo.config();
			
			document.querySelector('#txt').style.width = WH.w +'px';
			document.querySelector('#txt').style.height = WH.h +'px';
			document.querySelector('#logo').style.width = WH.w +'px';
			document.querySelector('#logo').style.height = WH.h +'px';
		}
		

	
		onWindowResize();
		window.addEventListener( 'resize', onWindowResize, false );
	</script>
	</body>
</html>

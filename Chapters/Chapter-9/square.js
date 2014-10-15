(function(){ 
	"use strict";

	var maxZ = 1000;

	window.onload = function(){

		setInterval(addSquare, 100000000000); //412
		var add = document.getElementById("add");
		add.onclick = addSquare;
		add.onmouseover = addSquare;
		var colors = document.getElementById("colors");
		colors.onclick = changeColors;

		// create several squares
		var squareCount = parseInt(Math.random() * 21) + 30;
		for(var i = 0; i < squareCount; i++){
			addSquare();
		}
	};

	function changeColors(){
		var squares = document.querySelectorAll("#squarearea div");
		for(var i = 0; i < squares.length; i++){
			squares[i].style.backgroundColor = getRandomColor();
		}
	}

	function getRandomColor(){
		var letters = "0123456789abcdef"; //hexa
		var result = "#";
		for(var i = 0; i < 6; i++){
			result += letters.charAt(parseInt(Math.random() * letters.length));
		}
		return result;
	}

	function squareClick(){
		this.parentNode.removeChild(this);
	}

	function addSquare(){
		var square = document.createElement("div");
		square.onclick = squareClick;
		square.className = "square";
		square.style.left = parseInt(Math.random() * 650) + "px";
		square.style.top = parseInt(Math.random() * 250) + "px";
		square.style.backgroundColor = getRandomColor();
		var squareArea = document.getElementById("squarearea");
		squareArea.appendChild(square);
	}
})();
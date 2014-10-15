(function(){
	window.onload = function(){
		document.getElementById("bold").onclick = boldClick;
		document.getElementById("italic").onclick = italicClick;
		document.getElementById("serif").onclick = fontClick;
		document.getElementById("fantasy").onclick = fontClick;
		document.getElementById("monospace").onclick = fontClick;
		//getElementById
		//getElementByName
		//getElementByTagName
	};

	function boldClick(){
		var lyrics = document.getElementById("lyrics");
		if(this.checked){
			lyrics.style.fontWeight = "bold";
			var oldSize = parseInt(lyrics.style.fontSize) || 12;
			lyrics.style.fontSize = (oldSize + 10) + "pt";
		}else {
			//lyrics.style.fontWeight = "normal";
			//lyrics.style.className = "clickedbutton";
			// HTML5 -> element.classList.methodName("class")
			// methods - add, contains, remove, toggle(remove if currently applied, else applies it)
			lyrics.style.id = "clickedbutton";
		}
	}

	function italicClick(){
		var lyrics = document.getElementById("lyrics");
		if(this.checked){
			lyrics.style.fontStyle = "italic";
		}else{
			lyrics.style.fontStyle = "normal";
		}
	}

	function fontClick(){
		var lyrics = document.getElementById("lyrics");
		lyrics.style.fontFamily = this.id;
	}

})();


function test(){

	var h2 = document.createElement("h2");
	h2.style.color = "red";
	h2.innerHTML = "TEST";

	var allDivs = document.getElementsByTagName("div");
	for(var i = 0; i < allDivs.length; i++){
		allDivs[i].style.border = "solid";
		allDivs[i].appendChild(h2);
	}
}
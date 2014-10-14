//(function(){
	window.onload = function(){
		document.getElementById("text").style.backgroundColor = "blue";
		document.getElementById("text").style.border = "0.5em solid red";
		document.getElementById("shuffle").onclick = shuffleClick;
	};

	function shuffleClick(){
		var items = document.getElementById("items");
		var lines = items.value.split('\n');
		shuffler(lines);
		items.value = lines.join('\n');
	}

	function shuffler(a){
		for(var i = 0; i < a.length; i++){
			//pick a random index j such that i <= j <= a.length - 1
			var j = i +  parseInt(Math.random() * (a.length - i));
			var swap = a[i];
			a[i] = a[j];
			a[j] = swap;			
		}
	}
//})();
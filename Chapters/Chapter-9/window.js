// Module pattern
// encapsulate global variables
(function() {
	function getInfo(){

		var span = document.getElementById("output");
		span.innerHTML = "Browser: " + window.navigator.appName + 
						 "; System: " + window.navigator.platform;

	}

	function goBack(){
		window.history.back();
	}

	/*function load(){
		var getInfoButton = document.getElementById("info");
		var getBackButton = document.getElementById("back");

		getInfoButton.onclick = getInfo;
		getBackButton.onclick = goBack;
	}*/

	// this is the first thing to load

	/*
	var getInfoButton = document.getElementById("info");
	var getBackButton = document.getElementById("back");

	getInfoButton.onclick = getInfo;
	getBackButton.onclick = goBack;
	*/

	//window.onunload
	//window.onresize
	//window.onerror

	// Anonymous functions and event handlers
	window.onload = function(){
		document.getElementById("info").onclick = getInfo;
		document.getElementById("back").onclick = goBack; // no parameters
	};
})();
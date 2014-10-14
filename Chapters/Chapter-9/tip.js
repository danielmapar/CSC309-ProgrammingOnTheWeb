(function() {

	function computeTip(){
		var subtotal = parseInt(document.getElementById("subtotal").value);
		var tipPercent = parseInt(this.innerHTML);
		var tipAmount = subtotal * tipPercent / 100.0;
		document.getElementById("total").innerHTML = "Tip: $" + tipAmount;
	}


	// event handler
	window.onload = function(){
		document.getElementById("tenpercent").onclick = computeTip;
		document.getElementById("fifthpercent").onclick = computeTip;
		document.getElementById("twentypercent").onclick = computeTip;
	};
})();
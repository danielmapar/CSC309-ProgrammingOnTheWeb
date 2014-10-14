function sayMagicWorld(){
	// returns null if empty
	/* multi line */
	var ret = document.getElementById("result")
	alert(ret.className);
	alert(ret.id);
	alert(ret.style);
	alert(ret.tagName);

	// Other ones
	alert(ret.checked);
	alert(ret.disabled);
	alert(ret.href);
	alert(ret.src);
	alert(ret.value); // inout or textarea

	var test = "daniel";
	var test = "pedro";
	ret.innerHTML = test;
	ret.innerHTML += "DANIEL";

	var img = document.getElementById("fight");
	img.src = "img/wolf.jpg";
}
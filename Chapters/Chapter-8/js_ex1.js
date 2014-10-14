function convert(){
	var first_name = document.getElementById("first_name").value;
	var last_name = document.getElementById("last_name").value;
	var compute = last_name.toUpperCase() + " " + first_name.charAt(0);
	var result = document.getElementById("result");
	var output = document.getElementById("output");
	output.style.display = 'inline';
	result.innerHTML = compute;
}

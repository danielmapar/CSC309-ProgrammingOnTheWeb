var list = [];

function addToList(){
	var band = document.getElementById("band");
	list.push(band.value);
	band.value = "";
	update();
}

function reverseList(){
	list.reverse();
	update();
}

function clearList(){
	list = [];
	update();
}

function update(){
	var output = document.getElementById("list");
	//output.innerHTML = list.toString();
	output.innerHTML = "[" + list.join(", ") + "]";
}

function test(param1, param2){
	if(param1 !== null && param1 !== undefined){
		ret = param1.toString() + param2.toString(); 
	}else{
		ret = prompt("Please enter a value:", "test");
		conf = confirm("You're sure?");
		if(conf){
			alert("Success!");
		}
	}

	return ret; // if no return --> return undefined
}
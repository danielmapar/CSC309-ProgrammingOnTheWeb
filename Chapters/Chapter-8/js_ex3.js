function capitalize(){
	var input = document.getElementById("name");
	var name = input.value;
	var newName = "";

	for(var i = 0; i < name.length; i++){
		if(i % 2){
			newName += name.charAt(i).toUpperCase();
		}else{
			newName += name.charAt(i).toLowerCase();
		}
	}
	input.value = newName;

	var x = 0;
	var y = null;
	if(x || y){
		alert(x);
		alert(y);
	}
	var test = "";
	if(test != null && test != undefined){ // if(test)
		alert("defined");
	}

	// cannot convert 15 to false, so 
	// it returns the right hand operator
	// && and || return left if convertible (|| true/&& false), else it returns right
	var a = 15 && 20; // a is 20
	var b = "Tea" && "Coffee"; // b is Coffee
	var c = null && "Coffee"; // c is null
	var d = "Coffee" && ""; // d is ""

	// Example
	//var donation = value || 5.00

	// && is higher precendence than ||
	// Pag 311 - precence table

	while(true){
		alert("while");
		break;
	}

	do{
		alert("do while");
		break;
	}while(true);

	/*  
		falsey values:
		0
		NaN
		" ", empty string
		null 
		undefined
	
	*/
}
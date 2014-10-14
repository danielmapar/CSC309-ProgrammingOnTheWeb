function factorial(){

	var num = document.getElementById("num");
	var result = 1;
	for(var i = 1; i <= num.value; i++){
		result = i * result;
	}	
	alert(i); // i exists out of scope
	num.value = result;
	document.getElementById("result").innerHTML = result;
}

function circle(){

	var r = 5;
	var circleArea = Math.PI * Math.pow(r, 2);
	var randNum = Math.random() * 10;
	var smaller = Math.min(circleArea, randNum);

	if(smaller > 1){


	}else if (smaller < 1){

	}else{
		
	}

}

// == test if value matchs
// === test if value and type matches
// !=== value or types not match
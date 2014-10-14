"use strict";

function compute(){
	var input_1 = document.getElementById("input_1");
	var input_2 = document.getElementById("input_2");
	var result = input_1.value * input_2.value;
	var output = document.getElementById("result_mul");
	var sign = document.getElementById("sign");
	sign.innerHTML = "+";
	var sum = parseInt(input_1.value) + parseInt(input_2.value);
	// parseInt - parseFloat
	var octal = parseInt("031", 10); // pass base 10 
	var size_of_text = "text".length;
	alert(size_of_text);
	// charAt(index) -- return the character at the specified position
	// charCodeAt(index) -- return ASCII numeric value of character
	// indexOf(string, fromIndex) -- return the index within the calling string first occurence
	// split(delimter, howMany) -- return list with splitted elements
	// substring (start, stop)
	// toLowerCase
	// toUpperCase
	// trim() -- return string withouth leading/trailing whitespace
	
	output.innerHTML = sum;
}

function test(){
	var text = "daniel\"asd\\\n\t";
	var text2 = 'daniel\'asd\\\n\t';
	var concat = "daniel" + 2;
}


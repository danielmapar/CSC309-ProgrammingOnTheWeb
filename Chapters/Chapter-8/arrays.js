function arrays(){
	var arr = [1,2,3,4];
	var arr2 = [5,7,8,9];
	alert(arr.length);
	alert(arr.concat(arr2));
	alert(arr.indexOf(2)); // index of first vale occurance
	alert(arr2.join('-')); // generate a string separated by -
	alert(arr.pop()); // remove last element and return it
	alert(arr.push(99));
	alert(arr.reverse());
	alert(arr.shift()); // remove first element and return it
	alert(arr2.slice(0, 3)); // return and array from start, end (3 not inclusive)
	alert(arr2.sort());
	alert(arr2.toString());
	alert(arr2.unshift(88,77,66,55)); // add element to the front of array

	arr3 = [1,3,4,5,6];
	alert(arr3.slice(2, 5));
	alert(arr3.splice(2, 3)); // get element 0 and 1 --> remove 3 elements after 1
	
}
arrays();
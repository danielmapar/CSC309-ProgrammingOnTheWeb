global_var = "global";

function global_local(){
	arr = [1,2,3,4,5,6,7,8,9];
	var local_variable = "test";
	global_2 = "global 2";
}

function printf(){
	alert(global_var);
	alert(global_2);
	arr[0] = 123;
	alert(arr);
	alert(arr.length);
}

global_local();
printf();
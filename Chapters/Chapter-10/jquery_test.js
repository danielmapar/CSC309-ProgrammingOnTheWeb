$(document).ready(function(){
	$("#toggle").click(toggle);
	$("#hide").click(hide);
	$("#show").click(show);
	$("#slide_toggle").click(slide_toggle);
	$("#slide_up").click(slide_up);
	$("#slide_down").click(slide_down);
	$("#fade_in").click(fade_in);
	$("#fade_out").click(fade_out);
	$("#fade_to").click(fade_to);
	
});

function toggle(){
	$("#text").toggle(1000);
}


function hide(){
	$("#text").hide(1000);
}

function show(){
	$("#text").show(1000);
}


function slide_toggle(){
	$("#text").slideToggle();
}


function slide_up(){
	$("#text").slideUp();
}

function slide_down(){
	$("#text").slideDown();
}


function fade_in(){
	$("#text").fadeIn();
}

function fade_out(){
	$("#text").fadeOut();
}

function fade_to(){
	$("#text").fadeTo();
}
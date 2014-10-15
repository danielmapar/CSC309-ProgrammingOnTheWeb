function Shape(canvas, x, y){
	if(canvas){
		this.context = canvas.getContext("2d");
		this.x = x;
		this.y = y;
	}
}

Shape.prototype.getColor = function(){
	if(this.color == undefined){
		this.color = "green";
	}
	return this.color;
}

function Square(canvas, x, y, side, rotation) {
	Shape.call(this, canvas, x, y);
	this.side = side;
	this.rotation = rotation;
}

Square.prototype = new Shape(); // clone(Shape.prototype);
Square.prototype.constructor = Square;

Square.prototype.draw = function () {
    // Draw the circle.
    this.context.save();
    this.context.beginPath();
    // Rotation
    this.context.translate((this.x)/2, (this.y)/2);
    this.context.rotate(this.rotation * Math.PI / 180);
    this.context.rect(0, 0, this.side, this.side);
    // Style
    this.context.fillStyle = this.getColor();
    this.context.strokeStyle = "black";
    this.context.lineWidth = 1;
    this.context.fill();
    this.context.stroke();   

    this.context.restore();
};

// This array hold all the circles on the canvas.
var shapes = [];

var canvas;
var context;

$(document).ready(function() {
  /*

  canvas = $('#canvas');
  context = canvas.getContext("2d");
  $('#start').click = startAnimation;
  $('#stop').click = stopAnimation;
  initCanvas();
  */
  canvas = $("#canvas")[0];
  context = canvas.getContext("2d");
  $("#start").click(startAnimation);
  $("#stop").click(stopAnimation);
  initCanvas();
});

function initCanvas(){
	addShape(100, 100);
  	addShape(150, 100);
}

function addShape(x, y) {
	var size = 20, rotation = 0;
	if(shapes.length >= 2){
		size = shapes[shapes.length-2].side * 1.25;
		rotation = shapes[shapes.length-2].rotation + 25;
	}

  	// Create the new shape.
  	var shape = new Square(canvas, x, y, size, rotation);
  	// Store it in the array.
	shapes.push(shape);
	// Draw the canvas.
	drawShapes();
}


function drawShapes() {
  // Clear the canvas.
  context.clearRect(0, 0, canvas.width, canvas.height);

  // Go through all the shapes.
  for(var i = 0; i < shapes.length; i++) {
    var shape = shapes[i];
    shape.draw();
  }
}

var interval1;
var interval2;
var interval3;

function startAnimation(){
	interval1 = setInterval("addShape(100, 100)", 1000);
	interval2 = setInterval("addShape(150, 100)", 1000);
	interval3 = setInterval("restartAnimation()", 8000);
}

function restartAnimation(){
	clearInterval(interval1);
	clearInterval(interval2);
	clearInterval(interval3);
	shapes = [];
	initCanvas();
	startAnimation();
}

function stopAnimation(){
	clearInterval(interval1);
	clearInterval(interval2);
	clearInterval(interval3);
}

function randomFromTo(from, to) {
  return Math.floor(Math.random() * (to - from + 1) + from);
}

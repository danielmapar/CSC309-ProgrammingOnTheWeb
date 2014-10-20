(function(){

	// Canvas information
	var canvas;
	var context;

	// Game status
	var paused;
	var gameOver;
	var score;
	var lives;
	var nextStage;
	var wonGame;

	// Elements information
	var blocks;
	
	// Block information
	var spacingBlocksToPaddle;
	var blockWidth;
	var blockHeight;
	var blockImage;

	// Paddle information
	var paddle;
	var paddleWidth;
	var paddleVerticalPosition;
	var paddleHorizontalPosition;
	var paddleSpeed = 10;
	var paddleImage;
	var paddleShrink;

	// Ball information
	var ball;
	var ballInterval;
	var ballMoveDirection; // values = up, down, up-left, up-right, down-left, down-right
	var ballSpeed;
	var ballImage;
	var numberOfCollisions;
	var redCollision;
	var orangeCollision;


	window.onload = function(){
		canvas = document.getElementById("canvas");
  		context = canvas.getContext("2d");

  		// Show game menu
  		gameMenu();

  		// Event to handle both left and right arrow keys (move paddle)
  		canvas.tabIndex = 1000;
  		canvas.addEventListener('keydown',canvasKeyEvent,false);
  		canvas.addEventListener('mousedown',canvasMouseEvent,false);

  		// Load block images
  		redBlockImage = new Image();
      	redBlockImage.src = 'img/red_block.jpg';
		orangeBlockImage = new Image();
      	orangeBlockImage.src = 'img/orange_block.jpg';
      	greenBlockImage = new Image();
      	greenBlockImage.src = 'img/green_block.jpg';
      	yellowBlockImage = new Image();
      	yellowBlockImage.src = 'img/yellow_block.jpg';

      	// Load paddle image
  		paddleImage = new Image();
      	paddleImage.src = 'img/paddle.jpg';
	    
	    // Load ball image
  		ballImage = new Image();
      	ballImage.src = 'img/ball.jpg';
	};

	function gameMenu(){
		clearCanvas();

		if(gameOver == true){
			context.fillStyle = "red";
 			context.font = "bold 12px Arial";
  			context.fillText("Game over!", canvas.width/2.8, canvas.height/8);			
		}
		context.fillStyle = "blue";
 		context.font = "bold 12px Arial";
  		context.fillText("Click on the canvas to start the game.", canvas.width/8, canvas.height/4);
  		context.fillStyle = "black";
 		context.font = "bold 10px Arial";
  		context.fillText("Instructions:", canvas.width/8, canvas.height/2);
  		context.fillText("Click 'Spacebar' to pause/unpause the game.", canvas.width/8, canvas.height/2+10);
  		context.fillText("Click on the canvas to reset the game.", canvas.width/8, canvas.height/2+20);

  		document.getElementById("game_data").style.display="";
	};

	function Shape(canvas, x, y, width, height){
		if(canvas){
			this.context = canvas.getContext("2d");
			this.x = x;
			this.y = y;
			this.width = width;
			this.height = height;
		}
	}

	function Block(canvas, x, y, width, height, color){
		Shape.call(this, canvas, x, y, width, height);
		this.color = color;
	}

	Block.prototype = new Shape();
	Block.prototype.constructor = Block;

	Block.prototype.draw = function () {
	    // Draw a block.
	    var x = this.x;
	    var y = this.y;
	    var width = this.width;
	    var height = this.height;

	    // Choose block color
	    if(this.color == 'red'){
	    	context.drawImage(redBlockImage, x, y, width, height);	
	    }else if(this.color == 'orange'){
	    	context.drawImage(orangeBlockImage, x, y, width, height);	
	    }else if(this.color == 'green'){
	    	context.drawImage(greenBlockImage, x, y, width, height);	
	    }else if(this.color == 'yellow'){
	    	context.drawImage(yellowBlockImage, x, y, width, height);	
	    }
	};

	function Ball(canvas, x, y, width, height){
		Shape.call(this, canvas, x, y, width, height);
	}

	Ball.prototype = new Shape();
	Ball.prototype.constructor = Ball;

	Ball.prototype.draw = function() {
	    // Draw a paddle.
	    var x = this.x;
	    var y = this.y;

	    var width = this.width;
	    var height = this.height;

        context.drawImage(ballImage, x, y, width, height);
	};

	Ball.prototype.move = function() {
	    // Move the ball.
	    clearCanvas();	    

	    if(ballMoveDirection.substring(0,2) == "up"){
	    	this.y -= ballSpeed;	
	        if(ballMoveDirection.substring(3,7) == "left"){
	    		this.x -= ballSpeed;
	    	}else if(ballMoveDirection.substring(3,8) == "right"){
	    		this.x += ballSpeed;
	    	}
	    }else if(ballMoveDirection.substring(0,4) == "down"){
	    	this.y += ballSpeed;
	    	if(ballMoveDirection.substring(5,9) == "left"){
	    		this.x -= ballSpeed;
	    	}else if(ballMoveDirection.substring(5,10) == "right"){
	    		this.x += ballSpeed;
	    	}
	    }
	    checkCollision();
	    if(gameOver == false){
	    	renderAllElements();
		}
	};

	function Paddle(canvas, x, y, width, height){
		Shape.call(this, canvas, x, y, width, height);
	}

	Paddle.prototype = new Shape();
	Paddle.prototype.constructor = Paddle;

	Paddle.prototype.draw = function() {
	    // Draw a paddle.
	    var x = this.x;
	    var y = this.y;

	    var width = this.width;
	    var height = this.height;

        context.drawImage(paddleImage, x, y, width, height);
	};

	Paddle.prototype.move = function(x) {
	    // Move the paddle.
	    clearCanvas();
	    renderAllElements();
	};

	function checkCollision(){

	 	// Check collision with the bottom of the screen 
	    if(ball.y >= canvas.height){
	    	if(wonGame == false){
	    		livesUpdate();
	    	}else{
		    	if(ballMoveDirection == "down"){
					ballMoveDirection = "up";
				}else if(ballMoveDirection == "down-right"){
					ballMoveDirection = "up-left";
				}else if(ballMoveDirection == "down-left"){
					ballMoveDirection = "up-right";
				}
		    }
	    // Ball collision with paddle
	    }else if(paddle.y <= (ball.y+ball.height) && 
		  (ball.x+ball.width) >= paddle.x && ball.x <= (paddle.x+paddle.width)){
			if(paddle.x+paddle.width/2-ball.width/2 == ball.x){
				ballMoveDirection = "up";
			}else if(paddle.x+(paddle.width/2) <= ball.x){
				ballMoveDirection = "up-right";
			}else{
				ballMoveDirection = "up-left";
			}
		// Check collision with screen edges 
		}else if(ball.x <= 0 || (ball.x+ball.width) >= canvas.width){
			if(ballMoveDirection == "up-left"){
				ballMoveDirection = "up-right";
			}else if(ballMoveDirection == "up-right"){
				ballMoveDirection = "up-left";
			}else if(ballMoveDirection == "down-left"){
				ballMoveDirection = "down-right";
			}else if(ballMoveDirection == "down-right"){
				ballMoveDirection = "down-left";
			}
		// Check collision with screen top
		}else if(ball.y <= 0){
			// Shrink paddle by half
			if(paddleShrink == false){
				paddle.width = paddle.width/2; 
				paddleShrink = true;
			}
			if(ballMoveDirection == "up"){
				ballMoveDirection = "down";
			}else if(ballMoveDirection == "up-right"){
				ballMoveDirection = "down-right";
			}else if(ballMoveDirection == "up-left"){
				ballMoveDirection = "down-left";
			}
		// Check collision with blocks
		}else{
			var ballMoveAlreadyDetermined = false;
			var emptyBlocks = 0;
			for(var i = 0; i < blocks.length; i++){
				if(blocks[i] !== undefined && blocks[i] !== null){		
					// Lateral collision
					if((
					   (ball.x >= blocks[i].x+blocks[i].width-1 && ball.x-1 <= blocks[i].x+blocks[i].width) ||
					   (ball.x+ball.width-1.5 <= blocks[i].x && ball.x+ball.width >= blocks[i].x)
					   ) 
					   &&
				   	   (
				   	   	(ball.y >= blocks[i].y && ball.y <= blocks[i].y+blocks[i].height) 
				   	   )
				   	  ){
				   	  	if(!ballMoveAlreadyDetermined){
							if(ballMoveDirection == "up-right"){
								ballMoveDirection = "up-left";
							}else if(ballMoveDirection == "up-left"){
								ballMoveDirection = "up-right";
							}else if(ballMoveDirection == "down-right"){
								ballMoveDirection = "down-left";
							}else if(ballMoveDirection == "down-left"){
								ballMoveDirection = "down-right";
							}
							ballMoveAlreadyDetermined = true;
						}
						numberOfCollisions++;
						// Increment ball speed after touching the red/orange row
						speedBallMovement(blocks[i].color);
						incrementScore(blocks[i].color);
						delete blocks[i];
					// Frontal collision
					}else if(ball.y <= (blocks[i].y+blocks[i].height) && 
				   	  ((ball.x >= blocks[i].x && ball.x <= (blocks[i].x+blocks[i].width)) || 
				       (ball.x+ball.width >= blocks[i].x && ball.x+ball.width <= (blocks[i].x+blocks[i].width)))){
						if(!ballMoveAlreadyDetermined){
							if(ballMoveDirection == "up"){
								ballMoveDirection = "down";
							}else if(ballMoveDirection == "down"){
								ballMoveDirection = "up";
							}else if(ballMoveDirection == "up-right"){
								ballMoveDirection = "down-right";
							}else if(ballMoveDirection == "up-left"){
								ballMoveDirection = "down-left";
							}
							ballMoveAlreadyDetermined = true;
						}
						numberOfCollisions++;
						// Increment ball speed after touching the red/orange row
						speedBallMovement(blocks[i].color);
						incrementScore(blocks[i].color);
						delete blocks[i];
				   	}
				}else{
					emptyBlocks++;
				}
			}

			// Check for next stage, or end of game
			if(emptyBlocks == blocks.length){
				if(nextStage == false){	
					startGame(true);
				}else{
					wonGame = true;
				}
			}
		}
	}

	function speedBallMovement(color){
		// Speed up ball after touching the red/orange row
		if(color !== undefined && color !== null){
			if(color == 'red' && redCollision == false){
				ballSpeed += 0.1;
				redCollision = true;
			}else if(color == 'orange' && orangeCollision == false){
				ballSpeed += 0.1;
				orangeCollision = true;
			}
		}
		// Speed up ball movement after 4 and 12 collisions
		if(numberOfCollisions == 4){
			ballSpeed += 0.1;
		}else if(numberOfCollisions == 12){
			ballSpeed += 0.1;
		}
	}

	function incrementScore(color){
		if(color == 'yellow'){
			score += 1;
		}else if(color == 'green'){
			score += 3;
		}else if(color == 'orange'){
			score += 5;
		}else if(color == 'red'){
			score += 7;
		}
		setScore();
	}

	function renderAllElements(){
		ball.draw();
		paddle.draw();
		for(var i = 0; i < blocks.length; i++){
			if(blocks[i] !== undefined && blocks[i] !== null){
				blocks[i].draw();	
			}
		}
	}

	function canvasMouseEvent(e){
		clearInterval(ballInterval);
		clearCanvas();
		startGame(false);
	}

	function canvasKeyEvent(e){
		var code = e.keyCode;
		if(gameOver == false){
			if(paused == false){
				// Paddle should not move when touching the edges
				if(paddle.x <= 0){
					paddle.x = 0.1;
				}else if(paddle.x+paddle.width >= canvas.width){
					paddle.x = canvas.width - paddle.width;
				}

			    // Left arrow click
			    if(code == 37){
			    	paddle.x -= paddleSpeed;
			    	paddle.move();
			    }	
			    // Right arrow click
			    else if(code == 39){
			    	paddle.x += paddleSpeed;
			    	paddle.move();
			    }
			}
		    // Space bar click
		    if(code == 32){
		    	if(paused == true){
		    		unPauseGame();
		    	}else{
		    		pauseGame();
		    	}
		    }
		}

	}

	function initBlocks(numBlocksLine, numBlocksLevel){
		// Draw lines of blocks in the canvas		
		// 50% of canvas space is dedicated to separate the paddle and the blocks
		spacingBlocksToPaddle = (canvas.height*50)/100;

		blockWidth = canvas.width / numBlocksLine;
		blockHeight = (canvas.height-spacingBlocksToPaddle) / numBlocksLevel;

		var blockVerticalSpacing = 0, blockHorizontalSpacing;
		for(var i = numBlocksLevel; i > 0; i--){
			blockHorizontalSpacing = 0;
			for(var j = numBlocksLine; j > 0; j--){
				var blockColor;
				if(i >= numBlocksLevel-1 && i <= numBlocksLevel){
					blockColor = 'red';
				}else if(i >= numBlocksLevel-3 && i <= numBlocksLevel-2){
					blockColor = 'orange';
				}else if(i >= numBlocksLevel-5 && i <= numBlocksLevel-4){
					blockColor = 'green';
				}else{
					blockColor = 'yellow';
				}
				var block = new Block(canvas, blockHorizontalSpacing, blockVerticalSpacing, blockWidth, blockHeight, blockColor);
				block.draw();
				blocks.push(block);
				blockHorizontalSpacing += blockWidth;
			}
			blockVerticalSpacing += blockHeight;
		}
	}

	function initPaddleAndBall(paddleWidth, paddleHeight){
		// Draw paddle below blocks
		// Paddle is centralized based on canvas width and paddles width
		paddleHorizontalPosition = (canvas.width/2)-(paddleWidth/2);
		// 10% of canvas space is dedicated to paddle horizontal floating 
		paddleVerticalPosition = canvas.height - (canvas.height*10)/100;
		paddle = new Paddle(canvas, paddleHorizontalPosition, paddleVerticalPosition, paddleWidth, paddleHeight);
		paddle.draw();

		// Draw ball on canvas
		var ballWidth = 5;
		var ballHeight = 5;
		initBall(paddleHorizontalPosition+(paddleWidth/2-ballWidth/2), paddleVerticalPosition-ballHeight, ballWidth, ballHeight);
	}

	function initBall(ballHorizontalPosition, ballVerticalPosition, ballWidth, ballHeight){
		ball = new Ball(canvas, ballHorizontalPosition, ballVerticalPosition, ballWidth, ballHeight);
		ball.draw();
	}

	function startGame(nextLevel){
		
		// Setup global status variables
		ballMoveDirection = "up";
		ballSpeed = 0.3;
		paused = false;
		gameOver = false;
		wonGame = false;
		blocks = [];
		orangeCollision = false;
		redCollision = false;
		numberOfCollisions = 0;
		paddleShrink = false;
		if(nextLevel == false){
			score = 0;
			lives = 3;
			nextStage = false;
		}else{
			nextStage = true;
		}
		// Set data on screen
		setGameInformation();

		// Initialize list of blocks and draw all of them  
		initBlocks(14, 8);
		// Initialize a paddle object and draw it on the screen
		initPaddleAndBall(canvas.width/8, 10);
		ballInterval = setInterval(moveBall, 10);
	}

	function livesUpdate(){
		if(lives == 1){
	    	gameOver = true;
			clearInterval(ballInterval);
			gameMenu();
		}else{
			lives--;
			setHearts();
			ball.x = paddle.x+(paddle.width/2-ball.width/2);
			ball.y = paddle.y-ball.height;
			ballMoveDirection = "up";
		}
	}

	function setHearts(){
		var livesDOM = document.getElementById("lives");
		while (livesDOM.hasChildNodes()) {
    		livesDOM.removeChild(livesDOM.lastChild);
		}
		for(var i = 0; i < lives; i++){
			var heartDOM = document.createElement("img");
			heartDOM.setAttribute("src", "img/heart.png");
			heartDOM.setAttribute("height", "10");
			heartDOM.setAttribute("width", "10");
			heartDOM.setAttribute("alt", "Heart");
			livesDOM.appendChild(heartDOM);
		}
	}

	function setGameInformation(){
		setScore();
		setHearts();
		document.getElementById("game_data").style.display="block";
	}

	function setScore(){
		var scoreDOM = document.getElementById("score");
		scoreDOM.innerHTML = score.toString();
	}

	function moveBall(){
		ball.move();
	}

	function pauseGame(){
		paused = true;
		clearInterval(ballInterval);
	}

	function unPauseGame(){
		paused = false;
		ballInterval = setInterval(moveBall, 10);	
	}

	function clearCanvas(){
		context.clearRect (0, 0, canvas.width, canvas.height);
	}

})();
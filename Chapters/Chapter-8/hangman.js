// list of possible words to be choose from
var POSSIBLE_WORDS = ['daniel', 'test', 'pedro'];
var word = "";
var guesses = "";
var MAX_GUESSES = 10;
var guessCount = 0;

// Chooses a new random word and displays ots clue on the page.
function newGame(){

	var guess_area = document.getElementById("guess_area");
	guess_area.style.display = 'inline';
	// choose a random word
	var randomIndex = parseInt(Math.random() * POSSIBLE_WORDS.length);
	word = POSSIBLE_WORDS[randomIndex];
	guesses = "";
	guessCount = MAX_GUESSES;
	updatePage(); // show initial word clue - all underscores
}

function guessLetter(){

	var input = document.getElementById("guess");
	var letter = input.value;
	if(word.indexOf(letter) < 0){
		guessCount--;
	}
	guesses += letter;
	updatePage(); // rebuild word clue
}

function updatePage(){


	var image = document.getElementById("hangmanpic");
	var index = (MAX_GUESSES - guessCount);
	image.src = "hang/hang" + index + ".gif";

	var clueString = "";
	for(var i = 0; i < word.length; i++){
		var letter = word.charAt(i);
		if(guesses.indexOf(letter) >= 0){
			clueString += letter + " ";
		}else {
			clueString += "_ ";
		}
	}
	var clue = document.getElementById("clue");
	clue.innerHTML = clueString;

	// show guesses made by player
	var guessArea = document.getElementById("guesses");

	if(guessCount == 0){
		guessArea.innerHTML = "You lose.";
		document.getElementById("guess_area").style.display = 'none';
	} else if(clueString.indexOf("_") < 0){
		guessArea.innerHTML = "You win!!!";
		document.getElementById("guess_area").style.display = 'none';
	}else{
		guessArea.innerHTML = "Guesses: " + guesses;
	}
}
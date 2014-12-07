var timer;
var run;
var count = 0;


$('document').ready( function (){
   $('[id="tbgame"] td').click(function (e){
      run = 0;
	  timer = setInterval(function() {
           callFunctionEffect(e)
		}, 200);
	});
	
	setInterval(function() {
           GetUserGame()
		}, 400);

});


function GetUserGame()
{
	$.ajax({
		type: "POST",
		url: url + "index.php/board/GetGame",
		contentType: "application/json",
		success: function(data){ 
			var data = $.parseJSON(data);
			
			$.each(data, function (a,b) {
				$('[id="tbgame"]').find('tr#' + b.tr).find('td#' + b.td).addClass( (b.user == user) ? 'red' : 'blue').attr({'clicked-game' : 'true', "user" : b.user});
			    if ( b.last == 'true' && b.user != user)
			    	myApp.hidePleaseWait();
			});
			stopGame(data);  
			
			
			},
		error: function(errMsg) {
			alert(errMsg);
		}
  });
  count = 0;
	
}

function stopGame(data){
   
    var c = 0;

	// olha por itens na mesma linha
	$('[id="tbgame"] tr').find('.red').each(function (i,item){ 
		if ( c < 3 ){
			if(item.nextElementSibling.className == 'red')
				c++;
			else
				c = 0;
		}
	});

	if (c == 3){
		c = 0;
		alert('winner   1');
		window.location=url + "index.php/arcade/index";
	}
	
	
	c = 0;
	
	// olha vertical
	$('[id="tbgame"] tr').find('.red').each(function (i,item){
		 if(c != 4){
			c = 0;
			//alert(item.parentNode);
			for (i=0; i <4; i++)
			{
				if(c < 4){
				//alert(item.parentNode+'   -  id:'+ item.parentNode.id);
				
					if($(tbgame).find('tr#'+ (item.parentNode.id - i) +' td#'+item.id).attr('class') == 'red') 
					//($(item).find('tr#' + ( item.parentNode.id + i) + ' td#' + item.id).attr('class') == 'red')
					{	
						//alert(item.parentNode);
						c++; 
					}			
					else
					{ 
						c = 0;
					}
				}
			}
		 }
	});
	if (c == 4){
		c = 0;
		alert('winner   2');
		window.location=url + "index.php/arcade/index";
	}
	c = 0;
}

function callFunctionEffect(e)
{
	if ($('[id="tbgame"]').find('tr#' + (run)).find('td#' + e.target.id).attr('clicked-game') == 'true')
	{
	    $('[id="tbgame"]').find('tr#' + (run - 1)).find('td#' + e.target.id).attr({'clicked-game' : 'true', "user" : user, "lastClicked" : "true"}).addClass("red");
		callServerWithJson();
		clearInterval(timer); 
		myApp.showPleaseWait();
	}
	else{
	    $('[id="tbgame"]').find('tr#' + run).find('td#' + e.target.id).addClass("red");
		if (run <= 6)
		{
			$('[id="tbgame"]').find('tr#' + ( run - 1)).find('td#' + e.target.id).removeClass('red').attr({'clicked-game' : 'false'});
			
		}
		else
		{
			$('[id="tbgame"]').find('tr#' + (run-1)).find('td#' + e.target.id).attr({'clicked-game' : 'true', "user" : user, "lastClicked" : "true"}).addClass("red");
		    callServerWithJson();
			clearInterval(timer); 
			myApp.showPleaseWait();
		}
	}
	run ++;
}

function callServerWithJson(){
	var game = [];
	var games = new Object();
	
	$('[id="tbgame"] td ').each(function(i,item) { 
			if ($(item).attr('clicked-game') == 'true')
			{
			    games = new Object();
			    games.tr = $(item).parent().attr("id");
				games.td = item.id;
				games.user =  $(item).attr("user");
				games.last = $(item).attr("lastClicked");
				game.push(games);
			}
		});
	var arguments = JSON.stringify(game);
	
	$.post(url + "index.php/board/SendGame",{ name: JSON.stringify(game)}, function (data,textStatus,jqXHR){
		
	});

}
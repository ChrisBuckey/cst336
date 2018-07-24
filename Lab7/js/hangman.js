console.log("JS loaded!");

var selectedWord = "";
var selectedHint = "";
var board = [];
var remainingGuesses = 6;
var words = [{ word: "snake", hint: "It's a reptile"},
             { word: "monkey", hint: "It's a mammal"},
             { word: "beetle", hint: "It's an insect"}];
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
var randomInt = Math.floor(Math.random() * words.length);
var guessedWords = [];

//Listeners
window.onload = startGame();

//Handlers
$(".letter").click(function() {
    console.log($(this).attr("id"));
});

$(".letter").click(function() {
    checkLetter($(this).attr("id"));
    disableButton($(this));
});

$(".replayBtn").on("click", function(){
        location.reload(true);
});

$(".hintButton").click(function(){
    showHint(true);
    $(this).hide();
    remainingGuesses -= 1;
    updateMan();
});

$(".guessButton").click(function(){
    var guess = $("#guessBox").val().toUpperCase();
    guessWords(guess);
});

//Functions
function startGame(){
    pickWord();
    initBoard();
    updateBoard();
    createLetters();
    createHintButton();
    createGuessBox();
}

function initBoard(){
    for (var letter in selectedWord){
        board.push("_");
    }
}

function pickWord(){	    	    
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}

function updateBoard(){
    $("#word").empty();
    
    for (var i = 0; i < board.length; i++){
        $("#word").append(board[i] + " ");
    }
}

function createHintButton() {
    $("#hint").append("<button class='hintButton btn btn-success'>Hint</button");
}

function createGuessBox() {
    $("#guesstheword").append("<textarea rows='1' cols='10' id='guessBox' value=''></textarea>");
    $("#guesstheword").append("<button class='guessButton btn btn-success'>Guess The Word</button");
}

function showHint(showtheHint){
    if(showtheHint==true){
    $("#hint").append("<span class='hint'>Hint: " + selectedHint + "</span>");
    }
}

function createLetters(){
    for(var letter of alphabet){
        $("#letters").append("<button class='letter btn btn-success' id='" + letter + "'>" + letter + "</button");
    }
}


function checkLetter(letter){
    var positions = new Array();
    
    //put all positions the letter exists in an array
    for (var i = 0; i < selectedWord.length; i++){
        if (letter == selectedWord[i]){
            positions.push(i);
        }
    }
    
    if (positions.length > 0){
        updateWord(positions, letter);
        if(!board.includes('_')){
            endGame(true);
        }
    }
    else{
        remainingGuesses -= 1;
        updateMan();
    }
    if(remainingGuesses <= 0){
        endGame(false);
    }
    console.log(remainingGuesses);
}

function updateWord(positions, letter){
    for (var pos of positions){
        board[pos] = letter;
    }
    updateBoard();
}

function updateMan(){
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}

function endGame(win){
    $("#letters").hide();
    if(win){
        $('#won').show();
    }
    else{
        $('#lost').show();
    }
}

function disableButton(btn){
    btn.prop("disabled", true);
    btn.attr("class", "btn btn-danger");
}

//display the wrong guessed words at the bottom
function wrongGuess(word){
    guessedWords.push(word);
    $("#guessedWords").append("<span class='guessed'>" + word + "</span>     ");
}

//take in the guesses
function guessWords(word){
    if (word == selectedWord){
        endGame(true);
    }
    else {
    remainingGuesses -= 1;
    updateMan();
    wrongGuess(word);
    }
}
<?php
function makeCards(){
    $suits = array('Clubs', 'Diamonds', 'Hearts', 'Spades');
    $cardvalues = array('2','3','4','5','6','7','8','9','10','Jack','Queen','King','Ace'); 
    $allcards = array();

    for($i=0; $i <4; $i++){  //all cards in one array
        for($j=0; $j < 13; $j++){
            $allcards[] = $cardvalues[$j].$suits[$i];
        }
    }
    shuffle($allcards);  //randomizes order of cards - used instead of rand() in order to prevent repeat cards
    return $allcards;
}

      
function displayCards(){
    $cards=makeCards();
    $hand = array();
        
    for($i=0; $i < 5; $i++){ //takes the top 5 cards and puts them into a hand
        $newcard = $cards[$i];
        $hand[] = $newcard;
    }
    
    for($i=0; $i < 5; $i++){  //displays the cards in the hand array
        echo "<img src='img/".$hand[$i].".png' alt='card' width='200'/>";
    }
}
?>


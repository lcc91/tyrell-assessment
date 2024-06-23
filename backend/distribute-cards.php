<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); //allow origins

//generate 52 cards into deck
function generateDeck() {
    $types = ['S', 'H', 'D', 'C'];
    $numbers = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K'];
    $deck = [];

    foreach ($types as $type) {
        foreach ($numbers as $number) {
            $deck[] = "$type-$number";
        }
    }

    return $deck;
}

//validate the input, if is not numeric and less than 0 then trigger error
function validateInput($inputValue) {
    if (!is_numeric($inputValue)) {
        throw new Exception("Input value does not exist or value is invalid");
    }

    $noOfPeople = intval($inputValue);
    if ($noOfPeople <= 0) {
        throw new Exception("Input value does not exist or value is invalid");
    }

    return $noOfPeople;
}

//shuffle desk and distribute to each people
function distributeCards($noOfPeople, array $deck) {
    if ($noOfPeople == 0) {
        return [];
    }

    $distributedCards = [];
    for($i=0; $i<$noOfPeople; $i++) {
        $distributedCards[$i] =  [];
    }

    shuffle($deck);
    
    foreach ($deck as $i => $card) {
        $distributedCards[$i%$noOfPeople][] = $card;
    }
    
    return $distributedCards;
}

try {
    $noOfPeople = validateInput($_GET['noOfPeople']);
    $deck = generateDeck();
    $distributedCards = distributeCards($noOfPeople, $deck);

    echo json_encode(['status' => 'success', 'data' => $distributedCards]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
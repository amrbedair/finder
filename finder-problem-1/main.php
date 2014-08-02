#!/usr/bin/php -q
<?php
/**
 * run this program using the command "php main.php AS 2D" or 
 * change its mod to +x and just run it using the command "./main.php AS 2D"
 * use any card combinations you want 
 */

	if(isset($argv[1]))
		$card1 = $argv[1];
	if(isset($argv[2]))
		$card2 = $argv[2];
	
	if(!($card1 && $card2)) {
		echo "you have to pass two cards!\n";
		die();
	}
	
	if(strlen($card1) != 2 || strlen($card1) != 2 ) {
		echo "cards can only be two letters!\n";
		die();
	}

	// $faces = [2, 3, 4, 5, 6, 7, 8, 9, 10, A, K, Q, J];
	$value_map = [
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		'A' => 11,
		'K' => 10,
		'Q' => 10,
		'J' => 10
	];
	
	if(!in_array($card1[0], array_keys($value_map)) || !in_array($card2[0], array_keys($value_map))) {
		echo "first part of the card is incorrect!\n";
		die();
	}
	
	$suits = ['S', 'C', 'D', 'H'];
	if(!in_array($card1[1], $suits) || !in_array($card2[1], $suits)) {
		echo "second part of the card is incorrect!\n";
		die();
	}
	
  
  echo "result: " . ($value_map[$card1[0]]+$value_map[$card2[0]]) . "\n";
  
?>
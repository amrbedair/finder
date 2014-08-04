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
	
	if(!preg_match('/^([2-9]|10|A|K|Q|J)([SCDH])$/i', $card1) || !preg_match('/^([0-9AKQJ]{1,2})([SCDH])$/i', $card2)) {
		echo "card are not formatted correctly!\n";
		exit;
	}
	
	$face_1 = substr($card1, 0, strlen($card1) - 1);
	$face_2 = substr($card2, 0, strlen($card2) - 1);
  
	echo "result: " . ($value_map[$face_1]+$value_map[$face_2]) . "\n";
  
?>
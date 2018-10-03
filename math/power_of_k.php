<?php

	/*
		Name: Power of K
		Description: Check if a given number is a power of k.
		Date: 2018-10-03
	*/

	function isPowerOf($number, $k) {
		$check = false;

		while($number > 0) {
			$digit = $number % $k;

			if($digit > 1) return false;

			if($digit == 1) {
				if($check) return false;
				$check = true;
			}

			$number /= $k;
		}

		return true;
	}


	// Examples

	$n = 20;
	$k = 5;
	var_dump(isPowerOf($n, $k)); // bool(false)

	$n = 81;
	$k = 3;
	var_dump(isPowerOf($n, $k)); // bool(true)

	$n = 64;
	$k = 4;
	var_dump(isPowerOf($n, $k)); // bool(true)

?>
#!/usr/local/bin/php
<?php
/*
 * @Author: Alex Smoliankin 
 * @Email: ashustrich@gmail.com
 */

function fibonacci($number){
	$sign = $number < 0 ? (-1) ** ($number + 1) : 1;
	
	return $sign * fib_loop(abs($number));
}

function fib_loop($number) {
	$previous = 1;
	$current = 0;

	while ($number-- > 0) {
		// Work since php 4
		// list($previous, $current) = array($current, $previous + $current);

		// Work since php 7.1
		[$previous, $current] = [$current, $previous + $current];
	}

	return $current;
}

// Test on range from negative to positive values.
foreach (range(-10, 10) as $num) {
	printf("Fib(%d) -> %s %s", $num, fibonacci($num), PHP_EOL);
}

// Stress test
print PHP_EOL . "Stress test:" . PHP_EOL;
$num = 1000;
$start = microtime_usec();

$res = fibonacci($num);

$time = microtime_usec() - $start;
printf("Fib(%d) -> %s %s", $num, $res, PHP_EOL);
printf("Test pass for %f seconds.", $time);

function microtime_usec()
{
    list($usec,) = explode(" ", microtime());
    return (float) $usec;
}

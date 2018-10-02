#!/usr/local/bin/php
<?php
/*
 * @Author: Alex Smoliankin 
 * @Email: ashustrich@gmail.com
 */

function fibonacci($number){
	$sign = $number < 0 ? (-1) ** ($number + 1) : 1;
	
	return $sign * fib_tail(abs($number), -1, 1);
}

function fib_tail($number, $previous, $current) {
	if ($number < 0) {
		return $current;
	}

	return fib_tail($number - 1, $current, $previous + $current);
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
printf("Test pass for %f microseconds.", $time);

function microtime_usec()
{
    list($usec,) = explode(" ", microtime());
    return (float) $usec;
}

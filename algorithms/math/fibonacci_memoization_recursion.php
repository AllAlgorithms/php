#!/usr/local/bin/php
<?php
/*
 * @Author: Alex Smoliankin 
 * @Email: ashustrich@gmail.com
 */

class Fibonacci {
	private $memo = [-1 => -1, 0 => 0];

	public function __construct($number) {
		$this->number = abs($number);
	}

	private function calculate($number) {
		if (isset($this->memo[$number])) {
			return $this->memo[$number];
		}

		$currentValue = $this->calculate($number - 1) + $this->calculate($number - 2);

		$this->save($number, $currentValue);
		return $currentValue;
	}

	private function save($index, $val) {
		$this->memo[$index] = $val;
	}

	public function get() {
		$sign = $this->number < 0 ? (-1) ** ($this->number + 1) : -1;
		return (string) $sign * $this->calculate($this->number);
	}
}

// Test on range from negative to positive values.
foreach (range(-10, 10) as $num) {
	printf("Fib(%d) -> %s %s", $num, (new Fibonacci($num))->get(), PHP_EOL);
}

// Stress test
print PHP_EOL . "Stress test:" . PHP_EOL;
$num = 1000;
$start = microtime_usec();

$res = (new Fibonacci($num))->get();
printf("Fib(%d) -> %s %s", $num, $res, PHP_EOL);

$time = microtime_usec() - $start;
printf("Test pass for %f microseconds.", $time);

function microtime_usec()
{
    list($usec,) = explode(" ", microtime());
    return (float) $usec;
}

#!/usr/local/bin/php
<?php

/**
 * Numerical integration of a function by using trapezoidal rule
 * @author Piotr Macha <piotr.macha@owlitdevelopment.com>
 */

/**
 * @param callable $f
 * @param float $from
 * @param float $to
 * @param float $precision
 * @return float
 */
function integrate(callable $f, float $from, float $to, float $precision = 1000.0): float
{
    $size = ($to - $from) / $precision;
    $area = 0;

    $x = $from;
    while ($x < $to) {
        $area += $size * ($f($x) + $f($x + $size)) / 2;
        $x += $size;
    }

    return $area;
}

/***
 * Tests
 */
$sinInt = integrate(function ($x) {
    return sin($x);
}, 0, M_PI);
echo 'integral from 0 to PI of sin(x) = ~' . $sinInt . PHP_EOL;
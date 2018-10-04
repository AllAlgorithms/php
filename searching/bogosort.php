#!/usr/local/bin/php
<?php

/**
 * bogosort algorithm sorts an array by generating random permutations of the array
 *
 * WARNING: This algorithm is meant to be highly ineffective and should not be used in serious projects
 * @see https://en.wikipedia.org/wiki/Bogosort
 *
 * @author Piotr Macha <piotr.macha@owlitdevelopment.com>
 */

/**
 * @param array $input
 * @param callable $compare
 * @return array
 */
function bogosort(array $input, callable $compare): array {
    $isSorted = function (array $input) use ($compare) {
        for ($i = 0; $i < count($input) - 1; ++$i) {
            if ($compare($input[$i], $input[$i + 1]) === 1) {
                return false;
            }
        }
        return true;
    };

    $array = $input;
    while (!$isSorted($array)) {
        shuffle($array);
    }

    return $array;
}

/**
 * Tests
 */
function runTest(array $input) {
    $startTime = microtime(true);

    $result = bogosort($input, function ($a, $b) {
        return $a <=> $b;
    });

    $executionTime = microtime(true) - $startTime;

    echo 'INPUT: ' . join(', ', $input) . PHP_EOL;
    echo 'OUTPUT: ' . join(', ', $result) . PHP_EOL;
    echo 'TIME: ' . sprintf('%.6f ms', $executionTime / 1000) . PHP_EOL . PHP_EOL;
}

runTest([1, 0]);
runTest([2, -1, 4]);
runTest([7, 5, 4, -3, 7]);
runTest([7, 6, 4, -3, 7, -1, 5, 7, -4, 12]);
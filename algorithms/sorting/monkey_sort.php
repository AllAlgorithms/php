<?php

/**
 * PHP implementation of MonkeySort
 *
 * This sorting algorithm should not be used in production as it might take a very long time.
 * But this is per design. BongoSort randomizes order of elements in the input array and checks
 * if it sorted the array by chance. 
 * You could say this is an anti-pattern of sorting algorithms.
 *
 * Alternative names are BogoSort, permutation sort, stupid sort, slowsort, shotgun sort. [1]
 *
 * Sources:
 * [1] Wikipedia article about BogoSort https://en.wikipedia.org/wiki/Bogosort
 *
 * @author DBX12
 *
 */
/**
 * @var bool determines if the array is printed each iteration of the sort function
 */
const PRINT_ARRAY = false;

/**
 * Determines if the input array is sorted
 * @param array $array input array
 * @return bool true - is correctly sorted; false is not sorted
 */
function is_sorted($array) {
    $prev = $array[0];
    for ($i = 0; $i < count($array); $i++) {
        if ($prev > $array[$i]) return false;
        $prev = $array[$i];
    }
    return true;
}

/**
 * The actual sort function. After each iteration, the array can be printed by setting PRINT_ARRAY to true
 */
function monkey_sort($array) {
    while (!is_sorted($array)) {
        if (PRINT_ARRAY)
            echo implode(', ', $array) . PHP_EOL;
        shuffle($array);
    }
    return $array;
}

$sorted = monkey_sort([3, 1, 2]);
echo implode(', ', $sorted);
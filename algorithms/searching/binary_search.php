#!/usr/local/bin/php
<?php

/**
 * @source: Wikipedia
 * Definition:
 * Binary search, also known as half-interval search,[1] logarithmic search,[2] or binary chop,[3] is a search algorithm
 * that finds the position of a target value within a sorted array.[4][5] Binary search compares the target value to the
 * middle element of the array. If they are not equal, the half in which the target cannot lie is eliminated and the
 * search continues on the remaining half, again taking the middle element to compare to the target value, and repeating
 * this until the target value is found. If the search ends with the remaining half being empty, the target is not in
 * the array. Even though the idea is simple, implementing binary search correctly requires attention to some subtleties
 * about its exit conditions and midpoint calculation.
 */

/**
 * @param array $list
 * @param $item
 * @return int|null
 */
function binary_search(array $list, $item)
{
    $low = 0;
    $high = sizeof($list) - 1;

    while ($low <= $high) {
        $mid = $low + $high;
        $guess = $list[$mid];

        if ($guess == $item) {
            return $mid;
        }

        if ($guess > $item) {
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }
    }

    return null;
}


/**
 * Usage
 */
print(binary_search([1, 3, 5, 7, 9], 3));   // => 1
print(binary_search([1, 3, 5, 7, 9], -1));   // => null
<?php

/*
  Source: Wikipedia

  linear search or sequential search is a method for finding a target value within a list. It sequentially checks each element of the list for the target value until a match is found or until all the elements have been searched.
*/

/**
 * Search for a given item in a list of items
 *
 * @param array $list
 * @param string $toFind
 * @return int|string
 */
function linear_search(array $list, $toFind) {
    foreach ($list as $index => $item) {
        if ($item === $toFind) {
            return $index;
        }
    }

    return -1;
}

/*
 * Example
 */

$items = [1,2,3,4,5];
$toFind = 6;
echo linear_search($items, $toFind);


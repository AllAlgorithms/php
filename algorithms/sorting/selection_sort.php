#!/usr/local/bin/php
<?php

/**
 * @source: Wikipedia
 *
 * In computer science, selection sort is a sorting algorithm, specifically an in-place comparison sort. It has O(n2)
 * time complexity, making it inefficient on large lists, and generally performs worse than the similar insertion sort.
 * Selection sort is noted for its simplicity, and it has performance advantages over more complicated algorithms in
 * certain situations, particularly where auxiliary memory is limited.
 */

/**
* @param array $list
 * @return array
 */
function selection_sort(array $list)
{
    $newList = [];

    $listSize = sizeof($list);

    for ($i = 0; $i < $listSize; $i++) {
        $smallest = find_smallest($list);
        array_push($newList, $list[$smallest]);
        array_splice($list, $smallest, 1);
    }

    return $newList;
}


/**
 * @param array $list
 * @return int|string
 */
function find_smallest(array $list)
{
    $smallest = $list[0];
    $smallestIndex = 0;

    foreach ($list as $key => $item) {
        if ($list[$key] < $smallest) {
            $smallest = $list[$key];
            $smallestIndex = $key;
        }
    }

    return $smallestIndex;
}

/**
 * Usage
 */
var_dump(selection_sort([5, 3, 6, 2, 10])); // => [2, 3, 5, 6, 10]

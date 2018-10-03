<?php

/**
 * quickSort will sort an unsorted dataset by creating a pivot value and two
 * storage arrays. The algorithm will then move through the unsorted values
 * and place them on either left or right of the pivot value to sort them
 * before recursively repeating until all values are sorted.
 * 
 * @param array $unsorted an unsorted dataset
 * 
 * @return array
 */
function quickSort(array $unsorted) 
{
    $length = count($unsorted);
    if ($length <= 1) {
        return $unsorted;
    }
    
    $pivot = $unsorted[0];
    $left  = [];
    $right = [];
    
    for ($i = 1; $i < $length; ++$i) {
        if ($unsorted[$i] < $pivot) {
            $left[] = $unsorted[$i];
        } else {
            $right[] = $unsorted[$i];
        }
    }
    
    return array_merge(quickSort($left), [$pivot], quickSort($right));
}


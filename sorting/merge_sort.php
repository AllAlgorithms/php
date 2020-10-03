<?php

function merge_sort(array $left, array $right) {
    $result = [];
    while (count($left) && count($right)) 
        ($left[0] < $right[0]) ? $result[] = array_shift($left) : $result[] = array_shift($right);
    return array_merge($result, $left, $right);
}

function merge(array $arrayToSort) {
    if (count($arrayToSort) == 1)
        return $arrayToSort;

    $left = merge(array_slice($arrayToSort, 0, count($arrayToSort) / 2));
    $right = merge(array_slice($arrayToSort, count($arrayToSort) / 2, count($arrayToSort)));

    return merge_sort($left, $right);
}

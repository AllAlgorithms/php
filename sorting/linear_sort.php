#!/usr/local/bin/php
<?php

// PHP implementation of linear sort
//
// Author: Filip Marek

function linearSort(array $array) {
    do {
        $interationSorted = false;

        for ($index = 0, $count = count($array) - 1; $index < $count; $index++) {
            if ($array[$index] > $array[$index + 1]) {
                $temp              = $array[$index];
                $array[$index]     = $array[$index + 1];
                $array[$index + 1] = $temp;

                $interationSorted = true;
            }
        }
    } while ($interationSorted);

    return $array;
}

// Test
$array = array(46, 24, 33, 10, 2, 81, 50);
print "Unsorted array\n";
print_r($array);
print "Sorted array\n";
print_r(linearSort($array));
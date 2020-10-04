#!/usr/local/bin/php
<?php

// PHP implementation of cycle sort
//
// Author: Filip Marek

function cycleSort(array $array)
{
    for ($index = 0, $count = count($array) - 1; $index < $count; ++$index) {
        $element = $array[$index];
        $position = $index;

        for ($i = $index + 1, $iCount = count($array); $i < $iCount; ++$i) {
            if ($array[$i] < $element) {
                ++$position;
            }
        }

        if ($position == $index) {
            continue;
        }

        while ($element == $array[$position]) {
            ++$position;
        }

        if ($position != $index) {
            $tmp = $array[$position];
            $array[$position] = $element;
            $element = $tmp;
        }

        while ($position != $index) {
            $position = $index;

            for ($i = $index + 1, $iCount = count($array); $i < $iCount; ++$i) {
                if ($array[$i] < $element) {
                    ++$position;
                }
            }

            while ($element == $array[$position]) {
                ++$position;
            }

            if ($element != $array[$position]) {
                $tmp = $array[$position];
                $array[$position] = $element;
                $element = $tmp;
            }
        }
    }

    return $array;
}

function printArray(array $array)
{
    for ($i = 0; $i < count($array); ++$i) {
        echo $array[$i].' ';
    }
    echo "\n";
}

// Test
$array = array(46, 24, 33, 10, 2, 81, 50);
echo "Unsorted array\n";
printArray($array);
echo "Sorted array\n";
printArray(cycleSort($array));

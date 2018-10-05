#!/usr/local/bin/php
<?php

// PHP implementation Factorial of n (recursive implementation)

function factorial($n) {
    if ($n <= 0) {
        return 1;
    }

    return $n * factorial($n - 1);
}


// Test
$number = 110;

echo "$number! = " . factorial($number);